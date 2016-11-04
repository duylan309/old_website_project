<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["ui"]) ? $post["db"]["ui"] : null;

$isUserAddJob    = false;
$isComopanyUser  = false;
$unlimitedStatus = 3;
$isPermission    = 0;

# check user jobleft before create job
$strQueryUser = "SELECT id, status, jobleft, dayleft FROM ".TABLE_USER." WHERE id= $uid";
$rowUser = $db->db_array ($strQueryUser);

if($rowUser["jobleft"] > 0 || $rowUser["status"]== $unlimitedStatus) {
    $isUserAddJob = true;
    $isPermission = 100;
}

if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
    $isPermission = 100;
}

if(isset($_SESSION["usersub"]["id"]) && $_SESSION["usersub"]["id"] != $post["db"]["ci"]) {
    if($nodeUpdate && $nodeUpdate=="db" && $sessionUserId == $uid){
        $isPermission = 100;
    }
}

# check company id of user
if( isset($post["db"]["ci"]) && $post["db"]["ci"] ) {
    $strQueryCompany = "SELECT id FROM ".TABLE_COMPANY." WHERE ui={$uid} AND id={$post["db"]["ci"]}";
    $isComopanyUser = $db->db_array($strQueryCompany);
    $isPermission = 100;
}

if($isPermission == 0) {
    die();
}

if($isComopanyUser) {

    if($isPermission == 100) {
      
        $rowUpdate = $post["db"];
        $category  = $rowUpdate["ca"];
        $category  = is_array($category) ? implode(',', $category) : explode(',', $category);

        $location  = $rowUpdate["lo"];
        $location  = is_array($location) ? implode(',', $location) : explode(',', $location);

        $time      = $rowUpdate["ty"];
        $level     = $rowUpdate["le"];
        $lang      = $rowUpdate["la"];
        $exp       = $rowUpdate["ex"];
        $country   = $rowUpdate["co"];

        $rowUpdate["ca"] = is_array($category) ? implode(',', $category) : $category;
        $rowUpdate["lo"] = is_array($location) ? implode(',', $location) : $location;
        $rowUpdate["ty"] = is_array($time) ? implode(',', $time) : $time;
        $rowUpdate["le"] = is_array($level) ? implode(',', $level) : $level;
        $rowUpdate["la"] = is_array($lang) ? implode(',', $lang) : $lang;
        $rowUpdate["ex"] = is_array($exp) ? implode(',', $exp) : $exp;
        $rowUpdate["co"] = is_array($country) ? implode(',', $country) : $country;
        $rowUpdate["cr"] = $currentTime;

        $rowUpdate["de"] = date("Y-m-d",strtotime($rowUpdate["de"]));
        
        if(!isset($rowUpdate["sn"]) ){
            $rowUpdate["sn"] = 0;
        }

        if(isset($rowUpdate["s1"])) {
            $strSalary       = str_replace(',','', $rowUpdate["s1"]);
            $strSalary       = str_replace('.','', $rowUpdate["s1"]);
            $rowUpdate["s1"] = intval($strSalary);
        }
        if(isset($rowUpdate["s2"])) {
            $strSalary       = str_replace(',','', $rowUpdate["s2"]);
            $strSalary       = str_replace('.','', $rowUpdate["s2"]);
            $rowUpdate["s2"] = intval($strSalary);
        }


        if(isset($rowUpdate["sa"]) && $rowUpdate["sa"]==2 ) {
            $rowUpdate["s3"] = $rowUpdate["s1"]*EXCHANGECURRENCY;
            $rowUpdate["s4"] = $rowUpdate["s2"]*EXCHANGECURRENCY;
        }
        else {
            $rowUpdate["s3"] = intval($rowUpdate["s1"]/EXCHANGECURRENCY);
            $rowUpdate["s4"] = intval($rowUpdate["s2"]/EXCHANGECURRENCY);
        }

        if(isset($rowUpdate["id"]) && $rowUpdate["id"]) {

            $iId = $rowUpdate["id"];

            $rowUpdate['description'] = isset($post["more"]['description']) ? mysql_real_escape_string($post["more"]['description']) : '';
            $rowUpdate['requirement'] = isset($post["more"]['requirement']) ? mysql_real_escape_string($post["more"]['requirement']) : '';
            $rowUpdate['benefit']     = isset($post["more"]['benefit'])     ? mysql_real_escape_string($post["more"]['benefit']) : '';
            $rowUpdate['keyword']     = isset($post["more"]['keyword'])     ? mysql_real_escape_string($post["more"]['keyword']) : '';

            if($db->db_update($rowUpdate, TABLE_JOB, array("id"=>$iId) ) ) {

                # update Job
                $file = FOLDERJOB . "{$iId}.xml";

                if (is_file($file)) {
                    $information = simplexml_load_file($file);
                    $information = json_encode($information);
                    $information = json_decode($information, true);
                }


                foreach ($rowUpdate as $key => $value) {
                    $information["db"][$key] = $value;
                }

                if(isset($post["more"]) && $post["more"] ) {
                    $information["more"] = $post["more"];
                }

                if($rowUpdate['st'] == 9){
                    #update jobleft -1 ;
                    $strUpdateView = "UPDATE ".TABLE_USER." SET jobleft = jobleft+1 WHERE id = $uid";
                    $db->db_query($strUpdateView);
                }

                saveXMLFile($file, $information);

              
                $code = 200;
                $message = $language["updateSuccess"];
            }

        } elseif($isUserAddJob) {

            if($db->db_insert($rowUpdate, TABLE_JOB)) {

                # Insert Job
                $str_query = "SELECT * FROM ".TABLE_JOB."
                                    WHERE cr={$currentTime} AND ui = $sessionUserId LIMIT 0,1";
                $row_insert = $db->db_array($str_query);

                if ($row_insert) {

                    foreach ($category as $value):
                        $strInsertCategory[]= "({$row_insert["id"]},{$value})";
                    endforeach;

                    if(is_array($location)){
                    foreach ($location as $value):
                        $strInsertLocation[]= "({$row_insert["id"]},{$value})";
                    endforeach;
                    }

                    $db->db_query("INSERT INTO ".TABLE_JOB_CATEGORY." (`ji`,`ci`) VALUES ".implode(',', $strInsertCategory));
                    $db->db_query("INSERT INTO ".TABLE_JOB_LOCATION." (`ji`,`li`) VALUES ".implode(',', $strInsertLocation));

                    /* update job category, location*/
                    $file = FOLDERJOB . "{$row_insert["id"]}.xml";
                    $information = array(
                        "db" => $row_insert,
                        "more"=> isset($post["more"]) ? $post["more"] : null
                    );

                    saveXMLFile($file, $information);
                    $code = 200;
                    $message = $language["insertSuccess"];

                    if($rowUser["status"] == $unlimitedStatus) {

                    } else {
                        #update jobleft -1 ;
                        $strUpdateView = "UPDATE ".TABLE_USER." SET jobleft = jobleft-1 WHERE id = $uid";
                        $db->db_query($strUpdateView);
                    }

                }
                else {
                    $code = 401;
                    $errors = "not found row insert";
                }
            } else {
                $code = 401;
                $errors = $language["insertErrors"];
            }
        } else {
            $code = 401;
            $errors = "you can't post new job.";
        }

        #update total Job into user
        $fileUser = FOLDERUSER . "$uid.xml";
        if(is_file($fileUser)) {
            $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(id SEPARATOR ',') AS strji FROM ".TABLE_JOB." WHERE ui={$uid} GROUP BY ui ORDER BY id DESC";
            $rowTotal = $db->db_array($strTotal);

            $readXML = simplexml_load_file($fileUser);
            $informationUser = json_encode($readXML);
            $informationUser = json_decode($informationUser, true);

            if($rowTotal) {
                $informationUser["totalJob"] = array(
                        "total" => $rowTotal["total"],
                        "strji"=>$rowTotal["strji"]
                    );
            }
            else {
                $informationUser["totalJob"] = array();
            }
            saveXMLFile($fileUser, $informationUser);
        }

        #update total Job into company
        $cid = isset($rowUpdate["ci"]) ? $rowUpdate["ci"] : null;
        $fileCmp = FOLDERCOMPANY . "{$cid}.xml";
        if($cid && is_file($fileCmp)) {

            $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(id SEPARATOR ',') AS strji FROM ".TABLE_JOB." WHERE ci={$cid} GROUP BY ci ORDER BY id DESC";
            $rowTotal = $db->db_array($strTotal);

            $readXML = simplexml_load_file($fileCmp);
            $informationCmp = json_encode($readXML);
            $informationCmp = json_decode($informationCmp, true);

            if($rowTotal) {
                $informationCmp["totalJob"] = array(
                        "total" => $rowTotal["total"],
                        "strji"=>$rowTotal["strji"]
                    );
            }
            else {
                $informationCmp["totalJob"] = array();
            }

            saveXMLFile($fileCmp, $informationCmp);
        }
    }
    elseif( $nodeUpdate=="status" && isset($_SESSION["adminlog"]) && isset($post["db"])) {

        $rowUpdate = $post["db"];
        $iId = $rowUpdate["id"];
        if($db->db_update($rowUpdate, TABLE_JOB, array("id"=>$iId) ) ) {
            # update Job
            $file = FOLDERJOB . "{$iId}.xml";
            
            if (is_file($file)) {
                $information = simplexml_load_file($file);
                $information = json_encode($information);
                $information = json_decode($information, true);
            }
            
            foreach ($rowUpdate as $key => $value) {
                $information["db"][$key] = $value;
            }
            
            saveXMLFile($file, $information);
            $code = 200;
            $message = $language["updateSuccess"];
        }
    }
} else {
    $code = 201;
    $errors = "Company invalid";
}
?>
