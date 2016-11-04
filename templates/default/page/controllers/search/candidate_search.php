<?php
$getUrl = APIGETCV."?";
$hasFilter = 1;
$web_title = null;


if(isset($_GET["lev"]) && $_GET["lev"]) {
    $hasFilter++;
    $web_title[0] = $language["jobLevelOption"][$_GET["lev"]];
}
if(isset($_GET["title"]) && $_GET["title"]) {
    $hasFilter++;
    $web_title[1] = $_GET["title"];
}
if(isset($_GET["cat"]) && $_GET["cat"]) {
    $hasFilter++;
}
if(isset($_GET["loc"]) && $_GET["loc"]) {
    $hasFilter++;
    $web_title[2] = $language["locationOption"][$_GET["loc"]];
}

if($web_title){
    $web_title = implode(' ', $web_title);
}

function main() {
    global $db, $language, $seo_name, $url_data, $getUrl, $sessionUserId;

    $getParams =  $_GET;
    unset($getParams["q"]);
    #save history search
    if(count($getParams)>0) {
        if(isset($getParams["ty"])) {
            $getParams["ty"] = implode($getParams["ty"], ',');
        }
        if(isset($getParams["le"])) {
            $getParams["le"] = implode($getParams["le"], ',');
        }
        if(isset($getParams["ex"])) {
            $getParams["ex"] = implode($getParams["ex"], ',');
        }
        if(isset($getParams["la"])) {
            $getParams["la"] = implode($getParams["la"], ',');
        }
    }
    foreach ($getParams as $key => $value) {
        if(!$value) {
            unset($getParams[$key]);
        }
    }

    /*$originalDate = "2010-03-21";
    $newDate = date("d-m-Y", strtotime($originalDate));*/


    if(isset($_SERVER["REQUEST_URI"]) && count($getParams)>0) {

        $getParams["ui"] = $sessionUserId ? $sessionUserId : 0;
        $getParams["page"] = 2;
        $getParams["cr"] = date("Y-m-d");

        if(!isset($_SESSION["historySearch"])) {
            $_SESSION["historySearch"] = null;
        }

        if($_SERVER["REQUEST_URI"] != $_SESSION["historySearch"]) {
            #storaged search
            if($db->db_insert($getParams, TABLE_USER_SEARCH)) {
                #do something
            }
        }
        $_SESSION["historySearch"] = $_SERVER["REQUEST_URI"];
    }


    $get = isset($_GET) ? $_GET : null;

    $levelOption = isset($get["le"]) ? $get["le"] : array();
    $experienceOption = isset($get["ex"]) ? $get["ex"] : array();
    $languageOption = isset($get["la"]) ? $get["la"] : array();
    $timeOption = isset($get["ty"]) ? $get["ty"] : array();

    $get["le"] = isset($get["le"]) ? implode($get["le"], ',') : null;
    $get["ex"] = isset($get["ex"]) ? implode($get["ex"], ',') : null;
    $get["la"] = isset($get["la"]) ? implode($get["la"], ',') : null;
    $get["ty"] = isset($get["ty"]) ? implode($get["ty"], ',') : null;

    if(isset($get["q"])) {
        unset($get["q"]);
    }

    $placeholderText = $language["placeholderSearch"];

    $paramUrl = "&var=window.viewSearchCv";

    $strLayout = "page/location/default.php";
    if(isset($locationInfo["more"]["textSearch"]) && count($locationInfo["more"]["textSearch"])) {
        $placeholderText = $locationInfo["more"]["textSearch"];
    }

    foreach ($get as $key => $value) {
        if($value) {
            $getUrl .= "&{$key}={$value}";
        }
    }

    // CALL VIEW
    require dirname(__FILE__) . "/../../views/search/candidate_search.php";
}
?>
