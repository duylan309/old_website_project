<?php
$str_q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "";
$url_data = explode("/", $str_q);
$pageUserId = null;

# init template for website
$cgf_site["temp"] = "templates/default/";
# end Config template

$fileConfig = FOLDERHOME . "config.xml";
$informationConfig = null;
if (is_file($fileConfig)) {
    $informationConfig = simplexml_load_file($fileConfig);
    $informationConfig = json_encode($informationConfig);
    $informationConfig = json_decode($informationConfig, true);
}


require "{$cgf_site["temp"]}website.php";
?>
