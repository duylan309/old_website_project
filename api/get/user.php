<?php
try{
    if(isset($url_data[3]) && $url_data[3] ) {
        # Get detail
        $uid = intval($url_data[3]);
        $file   = FOLDERUSER.$uid.".xml";
        if(!isset($_SESSION["userlog"]["id"]) || $_SESSION["userlog"]["id"] != $uid || !is_file($file)){
            die();
        }

        $fileInfo = simplexml_load_file($file);
        $information = json_encode($fileInfo);
        $information = json_decode($information, true);

        if(isset($_SESSION["adminlog"]) && count($_SESSION["adminlog"])) {
            $information["adminlog"] = $_SESSION["adminlog"];
        }

        $dataResponse = $information;
        $code = 200;
    }
    else {
        # Get list only admin
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY u.id DESC ";

        $get = isset($_REQUEST) ? $_REQUEST : null;

        if (isset($get["title"])) {
            $title = trim($get["title"]);
            $title = explode(' ', $title);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $strWhere .= " AND u.ti LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND u.created >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND u.created <= " . $get["to"];
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        if (isset($get["last_signin"]) && $get["last_signin"]) {
            $strOrder = $get["last_signin"] == 1 ? " ORDER BY last_signin ASC " : " ORDER BY last_signin DESC ";
        }
        
        $strSelect = "u.id AS i, u.email AS e, u.username AS u, u.im AS im,
                    u.name AS n, u.gender AS g, u.dob AS d, u.type AS t,
                    u.status AS s, FROM_UNIXTIME(u.created, '%d-%m-%Y') AS c, u.last_signin AS last_signin ";

        $strQuery = "SELECT {$strSelect}
                        FROM ".TABLE_USER." AS u
                        WHERE type = 2 {$strWhere} {$strOrder} {$strLimit}";
        $dataResponse = $db->objJson($strQuery);
        $message = "list data";
    }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
