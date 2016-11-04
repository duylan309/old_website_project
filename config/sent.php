<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form</title>
<style type="text/css">
#formsend {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#formsend .title {
	font-weight:bold;
	font-size:16px;
	color:#8B0000;
}
</style>

</head>

<body>
<?php
require 'class.phpmailer.php';
$mail = new PHPMailer();

$mailBody = 'Email test';

// Defined yourself
$hostMail = 'mail.sieuthinhanh.com';
$portMail = '25'; // or port 25
//$sslMail	= 'ssl';
$userMail = 'ads@sieuthinhanh.com';
$userPass = 'zE4ztEcfivb7';

$sendFrom = "phaphn@gmail.com";
$nameFrom = "Ho Ngoc Phap";
$sendTo = '124phn@gmail.com';
$nameTo = 'ANGELWINGS';
$subject = 'ANGELWINGS';
// End defined

//$mailBody             = eregi_replace("[\]",'',$mailBody);
//echo $mailBody;
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = $sslMail; // sets the prefix to the servier
$mail->Host = $hostMail; // sets GMAIL as the SMTP server
$mail->Port = $portMail; // set the SMTP port for the GMAIL server
$mail->Username = $userMail; // GMAIL username
$mail->Password = $userPass; // GMAIL password

$mail->SetFrom($sendFrom, $nameFrom);
$mail->AddReplyTo($sendFrom, $nameFrom);
$mail->Subject = $subject;
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($mailBody);
$mail->AddAddress($sendTo, $nameTo);

if (!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "Message sent!";
}
?>
</body>
</html>
