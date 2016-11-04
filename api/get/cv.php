<?php
try {
    $get_require = isset($_GET['type']) && count($_GET['type']) ? ($_GET['type']=="db" ? 1 : 0) : 0;
    if(isset($url_data[3]) && $url_data[3] && $get_require == 0) {
        $iId = intval($url_data[3]);
        $file   = FOLDERUSER.$iId.".xml";

        if(is_file($file)) {
            $fileInfo = simplexml_load_file($file);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);

            $dataResponse = $information;
            $code = 200;
        }
        else {
            $dataResponse = $language["unknownErrors"];
            $code = 201;
        }
    } elseif(isset($url_data[3]) && $url_data[3] && $get_require == 1) {
       
        $iId = intval($url_data[3]);
        $file   = FOLDERUSER.$iId.".xml";

        if(is_file($file)) {
            $fileInfo = simplexml_load_file($file);
            $information  = json_encode($fileInfo);
            $information  = json_decode($information, true);

            # get action for user
            $table_more = '';
            if(isset($_SESSION["userlog"]) && isset($_SESSION["userlog"]['type']) ){
                if($_SESSION["userlog"]['type']==1){
                    $employer_id = $_SESSION["userlog"]["id"];
                    $co         = $employer_id.'_'.$iId;
                    $str_query  = " SELECT usersave.status AS employer_status 
                                    FROM ".TABLE_USER_SAVED." AS usersave
                                    WHERE usersave.fo = {$employer_id} 
                                    AND usersave.ui   = {$iId} 
                                    AND usersave.co   = '".$co."' ";
                    # echo $str_query;
                    $row = $db->db_array($str_query);
                    $information["employer_status"] = $row["employer_status"];
                }
            }     

            $dataResponse = $information;
            $code = 200;
        }
        else {
            $dataResponse = $language["unknownErrors"];
            $code = 201;
        }
    }

     else {

        # Get list blog
        $strWhere = null;
        $strLimit = null;
        $strOrder = null;
        $strSelect = null;
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {

        } else {
            $strWhere .= " AND user.deactive = 0 ";
        }

        if (isset($get["title"])) {
            $title_search = null;
            $order_value  = null;

            $title = trim($get["title"]);
            $title = explode(' ', $title);

            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $title_search .= $key == 0 ? " CONCAT ( user.title,' ',userinfo.email,' ', userinfo.name ) LIKE '%{$value}%' " : " OR CONCAT ( userinfo.email,' ',user.title,' ',userinfo.name ) LIKE '%{$value}%' ";
                        $order_value  .= " WHEN user.title = '".$value."' THEN ".$key;

                    }
                }
            }

            $strWhere .= " AND ( ".$title_search." ) ";
            $strOrder = " ORDER BY CASE ".$order_value." END ";
        }

        if(isset($get["loc"])) {
            $strWhere .= " AND CONCAT(',',user.location,',')  LIKE '%{$get["loc"]}%' ";
        }

        if(isset($get["cat"])) {
            $strWhere .= " AND CONCAT(',',user.category,',')  LIKE '%{$get["cat"]}%' ";
        }

        if(isset($get["uco"])) {
            if($get["uco"] == "for"){
                $strWhere .= " AND CONCAT(',',userinfo.country,',')  NOT LIKE '%vn%' ";
            }else{
                $strWhere .= " AND CONCAT(',',userinfo.country,',')  LIKE '%{$get["uco"]}%' ";
            }
              }

        if(isset($get["sa"])) {
            $strSalary = str_replace(',','', $get["sa"]);
            $strSalary = str_replace('.','', $get["sa"]);
            $salary = intval($strSalary);
            $strWhere .= " AND (user.s1 >= {$salary} OR user.s2 >= {$salary} )";
        }

        if(isset($get["ex"])) {
            $listcheck = explode(",", $get["ex"]);
            $strTmp = array();
            foreach ($listcheck as $key => $value) {
                $strTmp[] = "user.experience = {$value}";
            }
            $strWhere .= " AND ( ".implode($strTmp, " || ")." ) ";
        }

        if(isset($get["ty"])) {

            $listcheck = explode(",", $get["ty"]);
            $strTmp = array();
            foreach ($listcheck as $key => $value) {
                $strTmp[] = " FIND_IN_SET( {$value}, user.type) ";
            }

            $strWhere .= "AND ( ".implode($strTmp, " OR ")."  )";
        }

        if(isset($get["la"])) {

            $listcheck = explode(",", $get["la"]);
            $strTmp = array();
            foreach ($listcheck as $key => $value) {
                $strTmp[] = " FIND_IN_SET( '{$value}' , user.lang) ";
            }

            $strWhere .= "AND ( ".implode($strTmp, " OR ")."  )";
        }


        if(isset($get["le"])) {

            $listcheck = explode(",", $get["le"]);
            $strTmp = array();
            foreach ($listcheck as $key => $value) {
                $strTmp[] = " FIND_IN_SET( {$value}, user.level) ";
            }

            $strWhere .= "AND ( ".implode($strTmp, " OR ")."  )";
        }


        if (isset($get["uid"]) && $get["uid"]) {

            if($get["uid"] < 0) {
                $strWhere .= " AND user.ui != " . abs($get["uid"]);
                $strOrder = " ORDER BY RAND() ";
            }
            else {
                $strWhere .= " AND user.ui = " . $get["uid"];
            }
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;
        $strSelect = "  user.ui AS ui  , 
                        user.title AS t,
                        user.level AS l, 
                        user.experience AS e,
                        user.salary AS sa, 
                        user.category AS c, 
                        user.location AS lo,
                        user.skill AS s, 
                        user.type AS ty , 
                        IF( userinfo.country = 'vn', userinfo.country, CONCAT('for',',',userinfo.country) ) as uco,
                        FROM_UNIXTIME(userinfo.dob, '%e') AS day, 
                        FROM_UNIXTIME(userinfo.dob, '%m') AS month, 
                        FROM_UNIXTIME(userinfo.dob, '%Y') AS year ";

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER." AS user , 
                             ".TABLE_USER." AS userinfo
                        WHERE 1 = 1 AND userinfo.id = user.ui 
                        {$strWhere} 
                        {$strOrder} 
                        {$strLimit}";



        # echo $strQuery;

        $dataResponse = $db->objJson($strQuery);

    }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}


?>
