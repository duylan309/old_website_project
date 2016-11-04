<?php
$email    = isset($_POST["email"]) ? $_POST["email"]       : null;
$uid      = isset($_POST["uid"])   ? intval($_POST["uid"]) : null;
$email_id = isset($_POST["email_id"]) ? $_POST["email_id"] : null;

if($email && count($email) > 0 ) {

    $where = '';
    if($email_id){

        $strQuery = "SELECT id, email FROM ".TABLE_RECEIVE_EMAIL."
                     WHERE user_id='{$uid}' AND email = '{$email}' AND id !='{$email_id}' LIMIT 0,1";
    }else{
        $strQuery = "SELECT id, email FROM ".TABLE_RECEIVE_EMAIL."
                     WHERE user_id='{$uid}' AND email = '{$email}' LIMIT 0,1";
    }

    
   
    $item = $db->db_array($strQuery);

    if($item) {
        $code = 201;
        $errors = $language["signupErrors"];
    }
    else {
        $code = 200;
        $message = 'ok';
    }
}
else {
    $code = 202;
    $errors = "Post invalid";
}

?>
