<?php
$isDone = false;
// echo $post["your-email"];
if(isset($post["your-email"]) && $post["your-email"]) {
    $strEmail = $post["your-email"];
    $str_query = "SELECT id, email, name FROM ".TABLE_USER." WHERE email='{$strEmail}' LIMIT 0,1";

    $row = $db->db_array($str_query);
    # var_dump($row);

    if($row) {
        # create url access to reset password
        # var_dump($row);
        $arrayInsert =  array(
            "ui" => $row["id"],
            "url" =>$row["id"]."-".md5($currentTime),
            "st" => 0,
            "cr" =>$currentTime,
        );

        if ($db->db_insert($arrayInsert, TABLE_USER_RECOVERYPW)) {
            # send url access to email user
            $link = $_SERVER['HTTP_HOST']."/".$seo_name["page"]["password"]."/".$arrayInsert["url"];
            $name = $row["name"];

            require $cgf_site["temp"] . "newsletter/forgotpassword_update.php";

            $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
                "from" => "team@thue.today",
                "to" => $post["your-email"],
                "sender" => "Thue Today",
                "receiver" => $name,
                "reply" => "team@thue.today",
                "replyInfo" => "Thue Today",
                "subject" => "Recovery Password from thue.today",
                "content" => $strBody,
                # "smtp" => $smtpConfig,
            );
            // require dirname(__FILE__) . "/sendmail.php";

            $isDone = true;
            $dataResponse = array("urlRedirect" => SITEURL.$seo_name["page"]["password"].'?st=1&str='.str_shuffle('1234567890abcefghiklmnopqrstuvxyz1234567890abcefghiklmnopqrstuvxyz1234567890abcefghiklmnopqrstuvxyz').'&em='.$post["your-email"]);
            $message = "Please check mail to change password";
        }
    }else{
        $code = "401";
        $message = $language["noEmailExist"];
    }
} elseif (isset($post["password"])) {
    #update password
    $pw = $post["password"];

    $str_query = "SELECT * FROM ".TABLE_USER_RECOVERYPW." WHERE url='{$pw["reset"]}' AND st=0 LIMIT 0,1";
    $row = $db->db_array($str_query);
    if($row) {
        $update["password"] = md5($pw["passwordNew"]);
        if( $db->db_update($update, TABLE_USER, array("id" => $row["ui"]) ) ) {
            $db->db_update(array("st"=>1), TABLE_USER_RECOVERYPW, array("id" => $row["id"]) );
            $isDone = true;
            $code = 200;
            $dataResponse = array("urlRedirect" => SITEURL.$seo_name["page"]["password"].'?st=2&str='.str_shuffle('1234567890abcefghiklmnopqrstuvxyz1234567890abcefghiklmnopqrstuvxyz1234567890abcefghiklmnopqrstuvxyz').'&em='.$row["email"]);
            $message = "Password updated";
        } else {
            $code = 201;
            $message = "Link update password is used";
        }
    }
    else {
        $code = 401;
        $message = "Link update password is invalid";
    }
}else {
        $code = 401;
        $message = "Link update password is invalid";
    }

?>
