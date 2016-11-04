<?php
$id = isset($_POST["id"]) ? $_POST["id"]:null;
$cid = isset($_POST["cid"]) ? $_POST["cid"]:null;
$hid = isset($_POST["hid"]) ? $_POST["hid"]:null;
$url = isset($_POST["url"]) ? $_POST["url"]:null;

if($url && !in_array($url, $urlDoNotUpdate, true)) {
    if($cid) {
        $strQuery = "SELECT id, url FROM ".TABLE_URL."
        WHERE url='{$url}' AND cid != '{$cid}' LIMIT 0,1";
    } elseif($hid) {
        $strQuery = "SELECT id, url FROM ".TABLE_URL."
        WHERE url='{$url}' AND hid != '{$hid}' LIMIT 0,1";
    } else {
        $strQuery = "SELECT id, url FROM ".TABLE_URL."
        WHERE url='{$url}' LIMIT 0,1";
    }

    $item = $db->db_array($strQuery);
    if($item) {
        $code = 201;
        $errors = $language["urlNotAvailable"];
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
