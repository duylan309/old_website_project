<?php
$db = new Database();
$seo_name["page"]["admin"] = "thuelanadmin";
$seo_name["page"]["user"] = "user";
$seo_name["page"]["social"] = "social";
$seo_name["page"]["home"] = "";
$seo_name["page"]["password"] = "pw";
$seo_name["page"]["search"] = "q";
$seo_name["page"]["searchcv"] = "sc";
$seo_name["page"]["blog"] = "blog";
$seo_name["page"]["news"] = "news";
$seo_name["page"]["category"] = "page";
$seo_name["page"]["cmp"] = "cmp";
$seo_name["page"]["facebook"] = "fb";
$seo_name["page"]['promotion_signup_get'] = "token"; 
$seo_name["page"]["job"] = "tuyen-dung";
$seo_name["page"]["signup"] = "rg";
$seo_name["page"]["signin"] = "sg";
$seo_name["page"]["cv"] = "c";
$seo_name["page"]["checkout"] = "co";
$seo_name["api"] = "api";
$seo_name["apiGet"] = "/api/get/";
$seo_name["page"]["payment"]    = "pm";
$seo_name["page"]["error"] = "404error.html";
$seo_name["page"]["newfeed"] = "newfeed";
$seo_name["page"]["photo"] = "photo";
$seo_name["page"]["about"] = "about";
$seo_name["page"]["jobs"] = "jobs";
$seo_name['page']['employer'] = "page/employer";
$seo_name["page"]["vi"]["newfeed"] = "bang-tin";
$seo_name["page"]["vi"]["photo"]   = "hinh-anh";
$seo_name["page"]["vi"]["about"]   = "gioi-thieu";
$seo_name["page"]["vi"]["jobs"]    = "tuyen-dung";

$urlDoNotUpdate = array(
    $seo_name["page"]["admin"],
    $seo_name["page"]["user"],
    $seo_name["page"]["password"],
    $seo_name["page"]["search"],
    $seo_name["page"]["searchcv"],
    $seo_name["page"]["facebook"],
    $seo_name["page"]["blog"],
    $seo_name["page"]["social"],
    $seo_name["page"]['promotion_signup_get'],
    $seo_name["page"]["news"],
    $seo_name["page"]["category"],
    $seo_name["page"]["cmp"],
    $seo_name["page"]["newfeed"],
    $seo_name["page"]["photo"],
    $seo_name["page"]["about"],
    $seo_name["page"]["jobs"],
    $seo_name["page"]["job"],
    $seo_name["page"]["signup"],
    $seo_name["page"]["signin"],
    $seo_name["page"]["cv"],
    $seo_name["page"]["checkout"],
    $seo_name["api"],
    $seo_name["page"]["newfeed"],
    $seo_name["page"]["payment"],
    "config",
    "js",
    "dataxml",
    "templates",
    "img",
    "media",
    "lang",
    "phpmailer",
    "www.thue.today",
    "thue.today"
);


$userAccess[0] = "banned";
$userAccess[1] = "Pending";
$userAccess[2] = "Active";
$userAccess[100] = "Supper Admin";

$paymentSetting = array(
    "paypal" => array(
        "sandbox" => true,
        "username" =>"124phn-facilitator_api1.gmail.com",
        "password" =>"87U9LFTHUSG3PDU9",
        "signature" =>"AiPC9BjkCyDFQXbSkoZcgqH3hpacAdI2Fak8rEJFnWkIEsdpYtUFYpI7"
    ),
    "smartlink" => array(
        "enable" => 0,
        "test" => 1,
        "merchantID" => "SMLTEST",
        "accessCode" => "ECAFAB",
        "secure" => "198BE3F2E8C75A53F38C1C4A5B6DBA27",
        "resultURL" => "/",
        "backURL" => "/",
    ),
);

// setting
define('FBAPPID',"619270441560752");//DEV
define('TOKENFB', FBAPPID."|r9zBR35jLAE44dnb0yySWCEQnFk"); // DEV

define('APIURLCAPTCHA', 'https://www.google.com/recaptcha/api/siteverify');
define('SITEKEYCAPTCHA', '6LfHDSATAAAAAEz0Kx-Dc79pluY2Hb2W1huWPBQ-');
define('SECRETKEYCAPTCHA', '6LfHDSATAAAAAPf9IUfYwZGpBVaBu4ZFdYWYkzMl');

define('GOOGLEAPIKEY', 'AIzaSyCfZPN2GJqbE6c8Cfg7a6kdgr71VGbVMGY');
define('KEYSECURE', 'AIzaSyCfZPN2GJqbE6c8Cfg7a6kdgr71VGbVMGY');
define('COOKIENAME', 'thuser');
define('LIBRARY', 'libraries');
define('COOKIEDOMAIN','thue.today');

define('SITEURL', 'http://d.thue.today/');
define('EXCHANGECURRENCY', 22000);
define('imgMaxWidth', 960);
define('imgMaxHeight', 960);
define('imgMaxWidthThumb', 200);
define('imgMaxHeightThumb', 200);
define('maxSizeUpload',10000000);

require_once 'setting_define.php';


