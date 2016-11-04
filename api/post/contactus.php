<?php
$site_key_post = $post['g-recaptcha-response'];

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $remoteip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $remoteip = $_SERVER['REMOTE_ADDR'];
}

$api_url = APIURLCAPTCHA.'?secret='.SECRETKEYCAPTCHA.'&response='.$site_key_post.'&remoteip='.$remoteip;
$response = file_get_contents($api_url);
$response = json_decode($response);

if(!isset($response->success))
{
    $code = 402;
    $errors = "Not Captcha";
}

if(isset($_SESSION["captcha"])){
  $response->success = $_SESSION["captcha"];
}

if($response->success == true)
{

    $nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
    if(isset($post["db"]) && $post["db"] ) {
        $_SESSION["captcha"] = $response->success;
        unset($post["captcha"]);
        unset($post['g-recaptcha-response']);
        if(isset($post["db"]["id"]) && $post["db"]["id"] ) {
            $db->db_update($post["db"], TABLE_CONTACTUS, array("id" => $post["db"]["id"]));
            $code = 200;
            $message = $language["updateSuccess"];
        } else {
            #INSERT DATA
            $post["db"]["cr"] = $currentTime;
            $date_create = strDate($currentTime);
            $post["db"]["st"] = 1;
            
            #SEND MAIL
            require $cgf_site["temp"] . "newsletter/contact.php";

            $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
                "from" => $post["db"]["em"],
                "to" => "team@thue.today",
                "sender" => $post["db"]["na"],
                "receiver" => "Thue today",
                "reply" => $post["db"]["em"],
                "replyInfo" => $post["db"]["na"],
                "subject" => $post["db"]["su"],
                "content" => $strBody,
                # "smtp" => $smtpConfig,
            );
            
            // require dirname(__FILE__) . "/sendmail.php";

            if($code == 500){
              $code    = 500;
              $errors = $language["mailFakeErrors"];
            }else{
                if ($db->db_insert($post["db"], TABLE_CONTACTUS)) {
                    $isDone = true;
                    $dataResponse = array("urlRedirect" => "/page/thank-you");

                }
            }    
        }
    } elseif($nodeUpdate && $nodeUpdate == "del") {
            # delete item
        $iId = isset($post["id"]) ? $post["id"]:null;
        if($iId) {
            if($db->db_delete(TABLE_CONTACTUS, array("id"=>$iId)) ){
                $code = 200;
                $message = $language["apiResponseSuccess"];
            }
        }
    }
  
}else{
    $code = 402;
    $errors = "Limit Permission Captcha";
}

?>
