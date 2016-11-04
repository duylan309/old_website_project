<?php
if(isset($_SESSION["adminlog"]["permission"]) && $_SESSION["adminlog"]["permission"] == 100 ) {
    if(isset($url_data[3]) && $url_data[3] ) {
        # Get Detail
        $iId = intval($url_data[3]);
        $code = 200;
        $strQueryDetail = "SELECT * FROM ".TABLE_USER_MANAGER." WHERE user_id={$iId}";

        $rowDetail = $db->db_array($strQueryDetail);
        if($rowDetail) {
            $dataResponse = $rowDetail;
        } else {
            $dataResponse = array();
        }

    }
    else {
        # Get list
        $strSelect = "u.id AS i, u.email AS e, u.username AS u, u.im AS im,
                    u.name AS n, u.gender AS g, u.dob AS d, u.address AS ad, u.city AS ci, u.type AS t,
                    u.status AS s, FROM_UNIXTIME(u.created, '%d-%m-%Y') AS c, um.permission AS pe, um.id AS umi ";

        $strQuery = "SELECT {$strSelect} FROM ".TABLE_USER." AS u, ".TABLE_USER_MANAGER." AS um WHERE u.id = um.user_id";

        $dataResponse = $db->objJson($strQuery);
        $message = "list data";
        $code = 200;
    }
}
?>
