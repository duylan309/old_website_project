<?php
$getUrl = APIGETJOBS."?";
$hasFilter = 1;
$web_title = null;
$web_title[0] = $_SESSION["lang"]=="vi" ? "Tuyển dụng " : "Jobs - ";

if(isset($_GET["lev"]) && $_GET["lev"]) {
    $hasFilter++;
    $web_title[1] = $language["jobLevelOption"][$_GET["lev"]];
}

if(isset($_GET["title"]) && $_GET["title"]) {
    $hasFilter++;
    $web_title[2] = $_GET["title"];
}

if(isset($_GET["cmp"]) && $_GET["cmp"]) {
    $hasFilter++;
    $web_title[3] = $_GET["cmp"];
}

if(isset($_GET["loc"]) && $_GET["loc"]) {
    $hasFilter++;
    $web_title[4] = $language["locationOption"][$_GET["loc"]];
}

if($web_title){
    $web_title = implode(' ', $web_title);
}

function main() {
    global $db, $language, $seo_name, $url_data, $getUrl, $sessionUserId;
    $getParams =  $_GET;
    unset($getParams["q"]);
    unset($getParams['distinct']);
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
        if(isset($getParams["cati"])) {
            $getParams["cati"] = implode($getParams["cati"], ',');
        }

    }

    foreach ($getParams as $key => $value) {
        if(!$value) {
            unset($getParams[$key]);
        }
    }

    if(isset($_SERVER["REQUEST_URI"]) && count($getParams)>0) {
        if($sessionUserId){
            $insert_search["ui"]    = $_SESSION["userlog"]["id"];
            $insert_search["name"]  = $_SESSION["userlog"]["name"];
            $insert_search["email"] = $_SESSION["userlog"]["email"];

        }else{
            $insert_search["ui"]   = 0;
        }
        $insert_search["page"] = 1;
        $insert_search["cr"]   = date("Y-m-d");

        if(!isset($_SESSION["historySearch"])) {
            $_SESSION["historySearch"] = null;
        }
        if($_SERVER["REQUEST_URI"] != $_SESSION["historySearch"]) {
            #storaged search
           
            $insert_search["cat"]   = isset($getParams["cati"]) ? $getParams["cati"] : "";
            $insert_search["ty"]    = isset($getParams["ty"]) ? $getParams["ty"] : "";
            $insert_search["title"] = isset($getParams["title"]) ? $getParams["title"] : "";
            $insert_search["le"]    = isset($getParams["le"]) ? $getParams["le"] : "";
            $insert_search["la"]    = isset($getParams["la"]) ? $getParams["la"] : "";
            $insert_search["sa"]    = isset($getParams["sa"]) ? $getParams["sa"] : "";
            $insert_search["loc"]   = isset($getParams["loc"]) ? $getParams["loc"] : "";
            if($db->db_insert($insert_search, TABLE_USER_SEARCH)) {
                #do something
            }else{
                // die();
            }
        }
        $_SESSION["historySearch"] = $_SERVER["REQUEST_URI"];
    }

    $get = isset($_GET) ? $_GET : null;

    $get["title"] = isset($get['title']) ? htmlspecialchars($get['title']) : null;

    $levelOption = isset($get["le"]) ? $get["le"] : array();
    $experienceOption = isset($get["ex"]) ? $get["ex"] : array();
    $languageOption = isset($get["la"]) ? $get["la"] : array();
    $timeOption = isset($get["ty"]) ? $get["ty"] : array();
    $catOption = isset($get["cati"]) ? $get["cati"] : array();
    $orderOption = isset($get["order"]) ? $get["order"] : '';

    $get["le"] = isset($get["le"]) ? implode($get["le"], ',')      : null;
    $get["ex"] = isset($get["ex"]) ? implode($get["ex"], ',')      : null;
    $get["la"] = isset($get["la"]) ? implode($get["la"], ',')      : null;
    $get["ty"] = isset($get["ty"]) ? implode($get["ty"], ',')      : null;
    $get["cati"]= isset($get["cati"]) ? implode($get["cati"], ',') : null;
    $get["order"]= isset($get["order"]) ? $get["order"] : null;

    if(isset($get["q"])) {
        unset($get["q"]);
    }

    $placeholderText = $language["placeholderSearch"];


    $paramUrl = "&var=window.viewSearchJobs";

    if(isset($locationInfo["more"]["textSearch"]) && count($locationInfo["more"]["textSearch"])) {
        $placeholderText = $locationInfo["more"]["textSearch"];
    }

    foreach ($get as $key => $value) {
        if($value) {
            $getUrl .= "&{$key}={$value}";
        }
    }

    // CALL VIEW
    require dirname(__FILE__) . "/../../views/search/job_search.php";


}
?>
