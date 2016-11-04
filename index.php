<?php
// print_r(get_loaded_extensions()); 

session_start();
include_once("config/database.php");
include_once("config/setting.php");
include_once("config/functions.php");


if(isset($_GET["hl"]) ) {
    if($_GET["hl"]== "vi") {
        $_SESSION["lang"] = "vi";
    } else {
        $_SESSION["lang"] = "en";
    }
}

if(!isset($_SESSION["lang"])){
    $_SESSION["lang"] = "vi";
}

$langcode = $_SESSION["lang"];
$currency = " vnd";
$sessionUserId = null;
$formatCurrency = ' data-format-currency data-currency=" vnd" data-format = "1" ';

if (isset($_SESSION["userlog"]) && isset($_SESSION["userlog"]["id"])) {
    $sessionUserId = isset($_SESSION["userlog"]["id"])?$_SESSION["userlog"]["id"]:null;
}else{
	if(isset($_COOKIE[COOKIENAME]) && count($_COOKIE[COOKIENAME]) > 0 ){

		$get_key = decrypt($_COOKIE[COOKIENAME],KEYSECURE);

		$a_User = explode('&', $get_key);
		parse_str($get_key,$userlog);
		$_SESSION["userlog"] = $userlog;
    	$sessionUserId = isset($_SESSION["userlog"]["id"])?$_SESSION["userlog"]["id"]:null;
	}
}

# get Device 

if(!isset($device)){
   if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipaq|ipod|j2me|java|midp|mini|mmp|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])){
      $_SESSION["device"] = "mobile";
   }else{
      $_SESSION["device"] = "pc";
   } 
}

include_once("config/array_to_xml.php");
include_once("lang/{$langcode}.php") ;
include_once("lang/setting.php") ;
include_once("site.php");
?>

