<?php
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    if(isset($url_data[3]) && $url_data[3] ) {
        $iId = intval($url_data[3]);
        $strQuery = "SELECT p.id AS i, p.code AS c, p.service_id AS s, p.created AS r, p.status AS t FROM ".TABLE_PROMO." AS p WHERE p.id={$iId} LIMIT 0,1";
        $dataResponse["db"] = $db->db_array($strQuery);
        $code = 200;
    } else {

        # Get list
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY p.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND p.created >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND p.created <= " . $get["to"];
        }

        // $strWhere .= " AND ".TABLE_PROMO.".created <= " . $get["to"];

        $strJoin = "LEFT JOIN ".TABLE_PROMO_APPLIED." AS pa
                    ON p.code=pa.pr 
                    LEFT JOIN ".TABLE_USER." AS u
                    ON pa.ui=u.id";

        $strQuery = "SELECT p.id AS i, p.code AS c, p.service_id AS s, p.created AS r, p.status AS t, p.note AS n, u.name AS na
            FROM ".TABLE_PROMO." AS p {$strJoin} WHERE 1=1 {$strWhere} ORDER BY p.id DESC";

        # echo $strQuery;


        $dataResponse = $db->objJson($strQuery);
        $code = 200;
    }

} else {
    # missing session
    $errors = $language["sessionExpiration"];
    $code = 401;
}
?>
