<?php
$doNotAccess = false;

if(!isset($get["uid"]) ) {
    if(!isset($_SESSION["adminlog"])) {
        $doNotAccess = true;
    }
} elseif($get["uid"] != $sessionUserId) {
    $doNotAccess = true;
}

try {
    if(isset($url_data[3]) && $url_data[3] ) {

        $strQuery = "SELECT * FROM ".TABLE_USER_PAYMENT." AS p
                        WHERE id= {$url_data[3]} ";
        $row = $db->db_array($strQuery);

        if($row) {
            if(isset($_SESSION["adminlog"])) {
                $doNotAccess = false;
            } elseif( $row["ui"] != $sessionUserId ) {
                $doNotAccess = true;
            } else {
                $doNotAccess = false;
            }

            $file   = FOLDERUSER.$row["ui"].".xml";
            $fileInfo = simplexml_load_file($file);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);

            if($doNotAccess) {
                $errors = "do not access";
                $code = 201;
            } else {
                $dataResponse["info"] = $information["userinfo"]["db"];
                $dataResponse["order"] = $row;
                $serviceData  = arrSearch ( $language["service"], "id=={$row["si"]}" );

                if(isset($serviceData[0])) {
                    $dataResponse["service"] = $serviceData[0];
                } else {
                    $dataResponse["service"] = array();
                }
                $code = 200;
            }

        } else {
            $dataResponse = array();
        }
    }
    else {
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY p.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if (isset($get["uid"]) && $get["uid"]) {
            $strWhere .= " AND p.ui = " . $get["uid"];
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND p.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND p.cr <= " . $get["to"];
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;
        $strSelect = "p.* ";

        $strQuery = "SELECT $strSelect
                        FROM ".TABLE_USER_PAYMENT." AS p, ".TABLE_USER." AS u
                        WHERE u.id= p.ui {$strWhere} {$strOrder} {$strLimit} ";

        $dataResponse = $db->objJson($strQuery);
    }
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
