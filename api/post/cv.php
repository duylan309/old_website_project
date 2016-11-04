<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["ui"]) ? $post["db"]["ui"] : null;
if($nodeUpdate && $nodeUpdate=="db" && $sessionUserId == $uid) {
    $rowUpdate = $post["db"];
    $category = $rowUpdate["ca"];
    $location = $rowUpdate["lo"];
    $rowUpdate["ca"] = implode(',', $category);
    $rowUpdate["lo"] = implode(',', $location);
    $rowUpdate["cr"] = $currentTime;

    unset($rowUpdate["de"]);


    if(isset($rowUpdate["id"]) && $rowUpdate["id"]) {

        $iId = $rowUpdate["id"];

        if($db->db_update($rowUpdate, TABLE_CV, array("id"=>$iId) ) ) {

            # update Job
            $file = FOLDERCV . "{$iId}.xml";

            if (is_file($file)) {
                $information = simplexml_load_file($file);
                $information = json_encode($information);
                $information = json_decode($information, true);
            }

            foreach ($rowUpdate as $key => $value) {
                $information["db"][$key] = $value;
            }

            $information["more"] = $post["more"];
            saveXMLFile($file, $information);
            $code = 200;
            $message = $language["updateSuccess"];
        }

    } elseif ($db->db_insert($rowUpdate, TABLE_CV)) {
        /* insert jobs*/
        $str_query = "SELECT * FROM ".TABLE_CV."
                            WHERE cr={$currentTime} AND ui = $sessionUserId LIMIT 0,1";
        $row_insert = $db->db_array($str_query);
        if ($row_insert) {
            foreach ($category as $value):
                $strInsertCategory[]= "({$row_insert["id"]},{$value})";
            endforeach;

            foreach ($location as $value):
                $strInsertLocation[]= "({$row_insert["id"]},{$value})";
            endforeach;

            $db->db_query("INSERT INTO ".TABLE_CV_CATEGORY." (`ji`,`ci`) VALUES ".implode(',', $strInsertCategory));
            $db->db_query("INSERT INTO ".TABLE_CV_LOCATION." (`ji`,`li`) VALUES ".implode(',', $strInsertLocation));

            /* update job category, location*/
            $file = FOLDERCV . "{$row_insert["id"]}.xml";
            $information = array(
                "db" => $row_insert,
                "more"=> isset($post["more"]) ? $post["more"] : null
            );

            saveXMLFile($file, $information);
            $code = 200;
            $message = $language["insertSuccess"];
        }
        else {
            $code = 401;
            $errors = $language["insertErrors"];
        }
    }

    #update total CV
    $fileUser = FOLDERUSER . "$uid.xml";
    if(is_file($fileUser)) {
        $strTotal = "SELECT count(id) AS total FROM ".TABLE_CV." WHERE ui=$uid";
        $rowTotal = $db->db_array($strTotal);

        $readXML = simplexml_load_file($fileUser);
        $informationUser = json_encode($readXML);
        $informationUser = json_decode($informationUser, true);
        $informationUser["totalCv"] = $rowTotal["total"];
        saveXMLFile($fileUser, $informationUser);
    }

} elseif( $nodeUpdate=="status" && isset($_SESSION["adminlog"]) && isset($post["db"])) {

    $rowUpdate = $post["db"];
    $iId = $rowUpdate["id"];
    if($db->db_update($rowUpdate, TABLE_CV, array("id"=>$iId) ) ) {
        # update CV
        $file = FOLDERCV . "{$iId}.xml";
        if (is_file($file)) {
            $information = simplexml_load_file($file);
            $information = json_encode($information);
            $information = json_decode($information, true);
        }
        foreach ($rowUpdate as $key => $value) {
            $information["db"][$key] = $value;
        }

        $uid = $information["db"]["ui"];
        #update total CV
        $fileUser = FOLDERUSER . "$uid.xml";
        if(is_file($fileUser)) {
            $strCv = "SELECT * FROM ".TABLE_CV." WHERE ui=$uid AND st > 1";
            $listCV = $db->db_arrayList($strCv);
            if($listCV) {
                $nodeCV = array();
                foreach ($listCV as $key => $value) {
                    $nodeCV["i_".$value["id"]] = $value;
                }
                $readXML = simplexml_load_file($fileUser);
                $informationUser = json_encode($readXML);
                $informationUser = json_decode($informationUser, true);
                $informationUser["cv"] = $nodeCV;
                saveXMLFile($fileUser, $informationUser);
            }
        }

        saveXMLFile($file, $information);
        $code = 200;
        $message = $language["updateSuccess"];
    }
}
?>
