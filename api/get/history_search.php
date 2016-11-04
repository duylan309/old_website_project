<?php
try {
    # Get list blog
    $strWhere = null;
    $strLimit = null;
    $strOrder = " ORDER BY us.id DESC ";
    $strGroupBy = null;

    $get = isset($_REQUEST) ? $_REQUEST : null;
    // $post = isset($_POST)?$_POST:null;

    if (isset($get["from"]) && $get["from"]) {
        $strDate = date("Y-m-d", $get["from"]);

        $strWhere .= " AND us.cr >= '{$strDate}'";
    }

    if (isset($get["to"]) && $get["to"]) {
        $strDate = date("Y-m-d", $get["to"]);
        $strWhere .= " AND us.cr <= '{$strDate}'";
    }

    $getSelect = isset($get["select"]) ? $get["select"]: null;
    $strSelect = "us.*";
    #echo $strWhere;
    $strQuery = "   SELECT $strSelect
                    FROM ".TABLE_USER_SEARCH." AS us
                    WHERE 1=1 {$strWhere} {$strGroupBy} {$strOrder} {$strLimit} ";
    # echo $strQuery;
    $dataResponse = $db->objJson($strQuery);

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
