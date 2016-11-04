<?php
$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;

if(isset($url_data[3]) && $url_data[3] ) {
    $iId = intval($url_data[3]);
    $strQuery = "SELECT us.id AS id , us.uid AS uid , us.cid AS cid, us.username AS username, us.name AS name, us.gender AS gender, us.created AS created ,
                        c.name AS cname, c.im AS cim, c.district AS cdi
                FROM ".TABLE_USERSUB." AS us ,".TABLE_COMPANY." AS c   WHERE us.id={$iId} AND c.id=us.cid LIMIT 0,1";
    $dataResponse["db"] = $db->db_array($strQuery);
    $code = 200;
} else {

    if ($uid && $uid == $sessionUserId) {
        # Get list
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY us.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        $strQuery = "SELECT us.id AS id , us.uid AS uid , us.cid AS cid, us.username AS username, us.name AS name, us.gender AS gender, us.created AS created ,
                        c.name AS cname, c.im AS cim, c.district AS cdi
                     FROM ".TABLE_USERSUB." AS us, ".TABLE_COMPANY." AS c WHERE us.uid={$uid} AND c.id=us.cid ORDER BY us.id DESC";
        #echo $strQuery;
        $dataResponse = $db->objJson($strQuery);
        $code = 200;
    } else {
        # missing session
        $errors = $language["sessionExpiration"];
        $code = 401;
    }
}
?>
