<?php
$facebook_share_content = '';
$avatar_cmp  = SITEURL.'img/style/thue-today.jpg';

$web_title = isset($informationConfig["config"]["seo"]["title"]) ? $informationConfig["config"]["seo"]["title"][$langcode] : "";
$web_description = isset($informationConfig["config"]["seo"]["description"]) ? $informationConfig["config"]["seo"]["description"][$langcode]: "";

$facebook_share_content .= '<meta property="fb:app_id"       content="'.FBAPPID.'"/>';
$facebook_share_content .= '<meta property="og:url"          content="'.SITEURL.'"/>';
$facebook_share_content .= '<meta property="og:type"         content="website"/>';
$facebook_share_content .= '<meta property="og:title"        content="'.$web_title.'"/>';
$facebook_share_content .= '<meta property="og:description"  content="'.$web_description.'"/>';
$facebook_share_content .= '<meta property="og:image"        content="'.SITEURL.'media/images/style/thue-today-find-work-today.jpg"/>';
$facebook_share_content .= '<meta property="og:image:width"  content="476"/>';
$facebook_share_content .= '<meta property="og:image:height" content="246"/>';

function main() {
    global $informationConfig,$db, $language, $seo_name, $url_data, $getUrl, $langcode;
    $description = isset($informationConfig["config"]["description"][$langcode])?$informationConfig["config"]["description"][$langcode]:null;

    require dirname(__FILE__) . "/../../views/general/user_page_home.php";

}
?>
