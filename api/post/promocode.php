<?php
$id = isset($_POST["id"]) ? $_POST["id"]:null;
$strCode = isset($_POST["code"]) ? $_POST["code"]:null;
if($strCode) {
    $strQuery = "SELECT id, code FROM ".TABLE_PROMO."
    WHERE code='{$strCode}' AND id != '{$id}' LIMIT 0,1";
    $item = $db->db_array($strQuery);
    if($item) {
        $code = 201;
        $errors = "Post invalid";
    }
    else {
        $code = 200;
        $message = $strQuery;
    }
}
else {
    $code = 202;
    $errors = "Post invalid";
}

?>
