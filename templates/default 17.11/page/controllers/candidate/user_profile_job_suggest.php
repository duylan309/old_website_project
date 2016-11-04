<?php
$getUrl = APIGETJOBSUGGEST."?";
$hasFilter = 1;
$web_title = null;
$web_title = $_SESSION["lang"]=="vi" ? "Việc Làm Bán Thời Gian - Việc Làm Hấp Dẫn" : "Part-time Jobs - Suggested Jobs";

$getParams =  $_GET;
unset($getParams["q"]);
unset($getParams['distinct']);
$get = null;

$get["title"] = isset($_SESSION['userlog']['cv']['title']) ? htmlspecialchars($_SESSION['userlog']['cv']['title']) : null;

$get["le"] = isset($_SESSION['userlog']['cv']['level']) ? $_SESSION['userlog']['cv']['level']      : null;
$get["ex"] = isset($_SESSION['userlog']['cv']['experience']) ? $_SESSION['userlog']['cv']['experience']      : null;
$get["la"] = isset($_SESSION['userlog']['cv']['lang']) ? $_SESSION['userlog']['cv']['lang']      : null;
$get["ty"] = isset($_SESSION['userlog']['cv']['type']) ? $_SESSION['userlog']['cv']['type']      : null;
$get["cati"]= isset($_SESSION['userlog']['cv']['category']) ? $_SESSION['userlog']['cv']['category'] : null;

$levelOption = isset($_SESSION['userlog']['cv']['level']) ? explode(",",$_SESSION['userlog']['cv']['level']) : array();
$experienceOption = isset($_SESSION['userlog']['cv']['experience']) ? explode(",",$_SESSION['userlog']['cv']['experience']) : array();
$languageOption = isset($_SESSION['userlog']['cv']['lang']) ? explode(",",$_SESSION['userlog']['cv']['lang']) : array();
$timeOption = isset($_SESSION['userlog']['cv']['type']) ? explode(",",$_SESSION['userlog']['cv']['type']) : array();
$catOption = isset($_SESSION['userlog']['cv']['category']) ? explode(",",$_SESSION['userlog']['cv']['category']) : array();


$paramUrl = "&var=window.viewSearchJobs";

// CALL VIEW
require dirname(__FILE__) . "/../../views/search/job_search.php";
