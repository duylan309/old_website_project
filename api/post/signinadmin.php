<?php
if( $sessionUserId && isset($_SESSION["userlog"]["email"]) && isset($post["db"]["email"]) && $post["db"]["email"] == $_SESSION["userlog"]["email"] ) {
    $password = md5($post["db"]["password"]);
   
    $str_query = "SELECT id, user_id, permission FROM user_manager
                WHERE user_id=$sessionUserId  AND password='$password' LIMIT 0,1";
   
    $row = $db->db_array($str_query);

    if ($row) {
        
        $_SESSION["adminlog"] = $row;
        $post = $_SESSION["adminlog"];
        $code = 200;

    } else {
        $code = 401;
        $errors = $language["signinError"];

        if(!isset($_SESSION["adminlogfail"])) {
            $_SESSION["adminlogfail"] = 1;
        } else {
            $_SESSION["adminlogfail"] = $_SESSION["adminlogfail"] + 1;
        }

        if($_SESSION["adminlogfail"] > 3) {
            unset($_SESSION["adminlogfail"]);
            unset($_SESSION["userlog"]);
            
            $code = 200;
            $errors = null;

            $message ="Warning login";
            $dataResponse = array("urlRedirect" => "/");
        }
    }
} else {
    $code = 403;
    $errors = $language["signinError"];
}

?>
