<?php
try {
    if(isset($url_data[3]) && $url_data[3] ) {
        $strQuery  = "SELECT *
                        FROM ".TABLE_CONTACTUS." AS co
                        WHERE id= {$url_data[3]}";

        $dataResponse = $db->db_array($strQuery);
        if($dataResponse) {
            $code = 200;
        } else {
            $code = 201;
        }
    } else {
        # Get list blog
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        $strSelect = "* ";

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND co.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND co.cr <= " . $get["to"];
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        $strQuery  = "SELECT $strSelect
                        FROM ".TABLE_CONTACTUS." AS co
                        WHERE 1 = 1 {$strWhere} {$strOrder} {$strLimit}";

        // echo $strQuery;
        $dataResponse = $db->objJson($strQuery);
    }
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
