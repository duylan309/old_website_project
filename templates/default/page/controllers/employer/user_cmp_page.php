<?php
$tab = isset($url_data[1]) ? $url_data[1] : "newfeed";
$content_job = $_SESSION["lang"]=="vi" ? "Tuyển dụng - " : "Hiring - ";

if(isset($tab)):
    switch ($tab) {
        
        case $seo_name["page"]["newfeed"]:
            $content_job = $_SESSION["lang"]=="vi" ? "Bảng tin - " : "Newfeed - ";
            break;

        case $seo_name["page"]["about"]:
            $content_job = $_SESSION["lang"]=="vi" ? "Giới thiệu - " : "About - ";
            break;
        
        case $seo_name["page"]["photo"]:
            $content_job = $_SESSION["lang"]=="vi" ? "Hình ảnh - " : "Photos - ";
            break;
        
        case $seo_name["page"]["jobs"]:
            $content_job = $_SESSION["lang"]=="vi" ? "Tuyển dụng - " : "Hiring - ";
            break;
        
        default:
            $content_job = $_SESSION["lang"]=="vi" ? "Tuyển dụng - " : "Hiring - ";
            break;
    }
endif;  

$web_title = $companyInfoPage["db"]["name"]." - ".$content_job.$companyInfoPage["db"]["address"].'- thue.today';
$web_description = isset($companyInfoPage["more"]["about"]) && !is_array($companyInfoPage["more"]["about"]) && !empty($companyInfoPage["more"]["about"]) ? substr($companyInfoPage["more"]["about"], 0, 350):'';
$web_description = preg_replace('/[^A-Za-z0-9\-]/', ' ', endcode_vn($web_description));
$web_keyword = $web_title." ".$web_description;


$facebook_share_content = '';
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$avatar_cmp = isset($companyInfoPage["db"]["im"]) && count($companyInfoPage["db"]["im"]) && $companyInfoPage["db"]["im"] ? 'https://'.$_SERVER["HTTP_HOST"].'/'.FOLDERIMAGECOMPANY.$companyInfoPage["db"]["im"] : 'https://'.$_SERVER["HTTP_HOST"].UDATAIMAGE.'style/user.png';
$cover_cmp  = isset($companyInfoPage["companybanner"]) && count($companyInfoPage["companybanner"]) ? 'https://'.$_SERVER["HTTP_HOST"].'/'.FOLDERIMAGECOMPANY.$companyInfoPage["companybanner"] : 'https://'.$_SERVER["HTTP_HOST"].UDATAIMAGE.'style/cover-default.jpg';

$facebook_cover_cmp = isset($companyInfoPage["pagecmpfacebookcover"]) && count($companyInfoPage["pagecmpfacebookcover"]) ? 'https://'.$_SERVER["HTTP_HOST"].'/'.FOLDERIMAGECOMPANYFACEBOOK.$companyInfoPage["pagecmpfacebookcover"] : null;
if($facebook_cover_cmp){
    $cover_cmp = $facebook_cover_cmp;
}

$facebook_share_content .= '<meta property="fb:app_id"   content="'.FBAPPID.'" />';
$facebook_share_content .= '<meta property="og:url"   content="'.$actual_link .'" />';
$facebook_share_content .= '<meta property="og:type"  content="website" />';
$facebook_share_content .= '<meta property="og:title" content="'.$web_title.'" />';
$facebook_share_content .= '<meta property="og:description" content="'.$web_description.'" />';
$facebook_share_content .= '<meta property="og:image" content="'.$cover_cmp.'" />';
$facebook_share_content .= '<meta property="og:image:width" content="470" />';
$facebook_share_content .= '<meta property="og:image:height" content="246" />';

function main(){
    global $language, $companyInfoPage, $sessionUserId, $db, $seo_name, $url_data, $pid,$langcode;

    $rowCompany = $companyInfoPage["db"];
    $uid = $rowCompany["ui"] ;

    $isPageOfCompany = $uid == $sessionUserId ? true :false;

    $companybanner = isset($companyInfoPage["companybanner"])  && $companyInfoPage["companybanner"] && count($companyInfoPage["companybanner"]) ? $companyInfoPage["companybanner"] : null;

    $avatar_cmp = isset($rowCompany["im"]) && count($rowCompany["im"]) && $rowCompany["im"] ? '/'.FOLDERIMAGECOMPANY.'thumbnail/'.$rowCompany["im"] : '/img/style/user.png';
  
    if($isPageOfCompany) {
        # get page info
        # get job list
        # get newfeeds
        require dirname(__FILE__) . "/../js/facebook_auto_complete_js.php";
        require dirname(__FILE__) . "/../js/google_auto_complete_address_js.php";

    } else {

    }
    # CALL VIEW
    require_once dirname(__FILE__) . "/../../views/employer/company_page/company_view_control.php";

}
?>

