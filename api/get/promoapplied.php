<?php
$uid = isset($get["uid"]) ? $get["uid"] : null;

if ($uid && $sessionUserId == $uid ) {
    $strQuery = "SELECT p.code AS c, p.service_id AS s, pa.cr AS cr FROM ".TABLE_PROMO_APPLIED." AS pa, ".TABLE_PROMO." AS p WHERE pa.ui={$uid} AND pa.pr = p.code ";
    $dataResponse = $db->objJson($strQuery);
    $code = 200;
} else {
    # missing session
    $errors = $language["sessionExpiration"];
    $code = 401;
}
?>
