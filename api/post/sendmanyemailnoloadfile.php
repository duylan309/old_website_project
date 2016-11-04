<?php
error_reporting(E_ALL);
$mail = new PHPMailerOAuth;

$smtp = array(
    "host"=>"smtp.gmail.com",
    "port"=>465,
    "secure"=> "ssl", #tls
    "authenticate" => true,
);

$sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
        "from" => "team@thue.today",
        "to" => "team@thue.today",
        "sender" => "Thue.Today",
        "receiver" => "User",
        "reply" => "team@thue.today",
        "replyInfo" => "Thue.today",
        "subject" => "Check Send Mail - PHPMailerAutoload",
        "content" => 'This is the HTML message body <b>in bold!</b>',
        "is_email" => 1
    );

if(isset($sendMailObj["is_email"])){

}else{

    $sendMailObj["smtp"] = $smtp;

    if($sendMailObj) {
         if(isset($sendMailObj["smtp"])) {

            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = $smtp["host"];
            $mail->Port = $smtp["port"];
            $mail->SMTPSecure = $smtp["secure"];
            $mail->SMTPAuth = $smtp["authenticate"];

            $mail->AuthType = 'XOAUTH2';
            $mail->oauthUserEmail    = "team@thue.today";
            $mail->oauthClientId     = "583284923083-0bt7tr17h6dv3jiqtejoabnphbg6ijpo.apps.googleusercontent.com";
            $mail->oauthClientSecret = "7y7KqwcD1Y6eObz7OW0Gj8Ac";
            $mail->oauthRefreshToken = "1/o32RjdoNZThqDEVModT9i2saOB8ya9ajO023reYkR9I";

            $mail->Mailtype         = 'html';
            $mail->CharSet          = "UTF-8";
            $mail->Crlf             = "\r\n";
            $mail->Newline          = "\r\n";
        }

        $mail->setFrom($sendMailObj["from"], $sendMailObj["sender"]);
        $mail->addReplyTo($sendMailObj["reply"], $sendMailObj["replyInfo"]);

        if($to && count($to) > 0){
            foreach ($to as $key) {
                $mail->addAddress($key['email'], $key['name']);
            }
        }

        $mail->isHTML(true);
        $mail->Subject = $sendMailObj["subject"];
        $mail->Body    = $sendMailObj["content"];
        $mail->AltBody = isset($sendMailObj["altBody"]) ? $sendMailObj["altBody"] : $sendMailObj["content"];

        if (!$mail->send()) {
            $code = 500;
            $errors = 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $code = 200;
            $message = $message ? $message : "Message sent !!!";
        }


    }
}    

unset($mail);
unset($sendMailObj);
unset($smtp);

?>
