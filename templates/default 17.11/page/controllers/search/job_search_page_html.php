<?php
$web_title = null;
$pageId = $rowURL["hid"];
$file = FOLDERHOME . "{$pageId}.xml";

if (is_file($file)) {
    $information = simplexml_load_file($file);
    $information = json_encode($information);
    $information = json_decode($information, true);
}

$web_title = isset($information["meta"]["title"][$_SESSION["lang"]]) ? $information["meta"]["title"][$_SESSION["lang"]] : $information["db"]["ti_".$_SESSION["lang"]];
$web_description = isset($information["meta"]["desc"][$_SESSION["lang"]]) && !empty($information["meta"]["desc"][$_SESSION["lang"]]) ? substr($information["meta"]["desc"][$_SESSION["lang"]], 0, 350) : '';
$web_keyword     = $web_title." ".$web_description;

$facebook_share_content = '';
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$cover_cmp   = isset($information["pagehtml"]) && count($information["pagehtml"]) ? 'https://'.$_SERVER["HTTP_HOST"].'/'.FOLDERUPLOAD.$information["pagehtml"] : 'http://'.$_SERVER["HTTP_HOST"].UDATAIMAGE.'style/cover-default.jpg';

$facebook_share_content .= '<meta property="fb:app_id"   content="'.FBAPPID.'" />';
$facebook_share_content .= '<meta property="og:url"   content="'.$actual_link .'" />';
$facebook_share_content .= '<meta property="og:type"  content="website" />';
$facebook_share_content .= '<meta property="og:title" content="'.$web_title.'" />';
$facebook_share_content .= '<meta property="og:description" content="'.$web_description.'" />';
$facebook_share_content .= '<meta property="og:image" content="'.$cover_cmp.'" />';
$facebook_share_content .= '<meta property="og:image:width" content="450" />';
$facebook_share_content .= '<meta property="og:image:height" content="298" />';


function main() {
    global $rowURL, $information, $language, $seo_name, $web_title, $pageId;

    $getParams = $information["db"];

    // $getUrl = APIGETJOB."?";
    $getUrl = "/api/get/jobhtml?";


    if($getParams["ca"]) {
        $getUrl .= "&cati[]={$getParams["ca"]}";
    }

    if($getParams["lo"]) {
        $getUrl .= "&loc={$getParams["lo"]}";
    }

    if($getParams["nat"]) {
        $getUrl .= "&nat={$getParams["nat"]}";
    }
    
    if($getParams["di"]) {
        $getUrl .= "&di={$getParams["di"]}";
    }

    if($getParams["subject"]) {
        $getParams["subject"] = html_entity_decode($getParams["subject"]);
        $getUrl .= "&title={$getParams["subject"]}";
    }


    if(isset($getParams["jobid"]) && !is_array($getParams['jobid'])) {
        $getUrl .= "&jobid={$getParams["jobid"]}";
    }


    $getParams["ca"] = implode(',', $getParams["ca"]);

    $timeOption       = $getParams["ty"] ? explode(',', $getParams["ty"]) : array();
    $levelOption      = $getParams["le"] ? explode(',', $getParams["le"]) : array();
    $experienceOption = $getParams["ex"] ? explode(',', $getParams["ex"]) : array();
    $languageOption   = $getParams["la"] ? explode(',', $getParams["la"]) : array();
    $catOption        = $getParams["ca"] ? explode( ',',$getParams["ca"]) : array();
    $orderOption      = isset($get["order"]) ? $get["order"] : '';
   
    $get = array(
            "ty" => $getParams["ty"],
            "ex" => $getParams["ex"],
            "le" => $getParams["le"],
            "la" => $getParams["la"],
            "ca" => $getParams["ca"]
        );

    foreach ($get as $key => $value) {
        if($value) {
            $getUrl .= "&{$key}={$value}";
        }
    }

    $paramUrl = "&random=1";
    
    require dirname(__FILE__) . "/../../views/search/job_search_page_html.php";
  
}
?>
