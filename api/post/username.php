<?php
$userId = isset($_POST["user_id"]) ? $_POST["user_id"]:null;
$username = isset($_POST["username"]) ? $_POST["username"]:null;
if($userId && $username) {
    $strQuery = "SELECT id, username, user_id FROM ".TABLE_USER_NAME." WHERE username='{$username}' AND user_id != '{$userId}' LIMIT 0,1";
    $item = $db->db_array($strQuery);
    if($item) {
        $code = 201;
        $errors = $language["usernameNotAvailable"];
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
