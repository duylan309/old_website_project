<?php
try {

    if(isset($url_data[3]) && $url_data[3] && !isset($url_data[4])) {
        $iId = intval($url_data[3]);
        $file   = FOLDERCOMPANY.$iId.".xml";
        if(is_file($file)) {
            $fileInfo = simplexml_load_file($file);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);
            $dataResponse = $information;

            $dataResponse["userinfo"]["db"] = $information["db"];
            #hard code to user template entryViewEmploymentDetail
            $code = 200;
        }
        else {
            $dataResponse = $language["unknownErrors"];
            $code = 201;
        }
    }elseif(isset($url_data[3]) && $url_data[3] && isset($url_data[4]) && isset($url_data[5])){

        if($url_data[4] === "location"){

            $uid         = intval($url_data[5]);
            $company_id  = intval($url_data[3]);
            $location_id = isset($url_data[6]) ? intval($url_data[6]) : 0;

            $strWhere = null;
            $strLimit = null;
            $strOrder = " ORDER BY cl.id DESC ";

            if($location_id != 0){
               $strWhere = ' AND cl.id = '.$location_id ; 
            }

            $strQuery   =  "SELECT id, location_name, lat, lng, address, city, company_id
                            FROM ".TABLE_COMPANY_LOCATION." AS cl
                            WHERE cl.company_id = {$company_id} AND cl.ui = {$uid} {$strWhere} {$strOrder}";

            # echo $strQuery;
            $code = 990;
            if($location_id!=0){
                $dataResponse = $db->db_array($strQuery);
            }else{
                $dataResponse = $db->objJson($strQuery);
            }

        }else{
            die();
        }

    }elseif(isset($url_data[3]) && $url_data[3] && isset($url_data[4])){
        if($url_data[4] === "location"){

            $company_id  = intval($url_data[3]);

            $strWhere = null;
            $strLimit = null;
            $strOrder = " ORDER BY cl.id DESC ";

            $strQuery   =  "SELECT id, location_name, lat, lng, address, city, company_id
                            FROM ".TABLE_COMPANY_LOCATION." AS cl
                            WHERE cl.company_id = {$company_id} {$strWhere} {$strOrder}";

            $code = 200;
            $dataResponse = $db->objJson($strQuery);

        }else{
            die();
        }
    }else {

        # Get list blog
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY c.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {

        } else {
            $strWhere .= " AND u.deactive = 0 ";
        }

        if (isset($get["title"])) {
            $title = trim($get["title"]);
            $title = explode(' ', $title);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $strWhere .= " AND c.name LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if(isset($get["loc"])) {
            $strWhere .= " AND c.city == %{$get["loc"]}% ";
        }

        if(isset($get["status"])) {
            $strWhere .= " AND c.status = {$get["status"]} ";
        }

        if(isset($get["statusg"])) {
            $strWhere .= " AND c.status >= {$get["statusg"]} ";
        }

        if(isset($get["statusi"])) {
            $strWhere .= " AND c.status IN ({$get["statusi"]}) ";
        }

        if(isset($get["idi"])) {
            $strWhere .= " AND c.id IN ({$get["idi"]}) ";
        }

        if(isset($get["cat"])) {
            $strWhere .= " AND CONCAT(',',c.category,',')  LIKE '%{$get["cat"]}%' ";
        }

        if (isset($get["uid"]) && $get["uid"]) {
            $strWhere .= " AND u.id = " . $get["uid"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND c.created <= " . $get["to"];
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT {$get["limit"]}";
        }

        if (isset($get["kind"]) && $get["kind"]) {
            $strWhere .= " AND u.status = {$get["kind"]}";
        }
       
        if(isset($get["cmpid"]) && $get["cmpid"] && !is_array($get["cmpid"])){
            if($get["cmpid"] != "Array"){
                $strWhere  = " AND c.id IN ({$get["cmpid"]})";
            }
        }

        if(isset($get["random"])){
            $strOrder = " ORDER BY RAND() ";
        }
       
        $strSelect = "c.id AS id, u.id AS ui, c.name AS na, u.name AS n, c.url AS us, c.im AS im, c.address AS ad,
            c.city AS ci, c.category AS ca, c.phone AS p, u.status AS s, c.created AS cr , u.deactive AS deactive";
         
        $strQuery  = "SELECT $strSelect
                        FROM ".TABLE_COMPANY." AS c, ".TABLE_USER." AS u
                        WHERE u.type = 1 AND u.id = c.ui {$strWhere} {$strOrder} {$strLimit} ";

        # echo $strQuery;
          $code = 200;
        $dataResponse = $db->objJson($strQuery);
    }
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
