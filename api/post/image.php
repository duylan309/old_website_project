<?php
#if (!$sessionUserId)
$uid = isset($_POST["ui"]) ? $_POST["ui"] : null;
$id = $_POST["db_id"];
$maxSize = isset($_POST["db_size"]) ? intval($_POST["db_size"]):100000;
$strPath = null;
$strXML = null;
$file = null;
$table = null;

if (isset($url_data[3]) && isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
   
    if ($url_data[3] === "blog") {
        $strPath  = FOLDERIMAGEBLOG;
        $strXML   = FOLDERBLOG;
        $table    = TABLE_BLOG;
    } elseif ($url_data[3] === "category") {
        $strPath  = FOLDERIMAGECATEGORY;
        $strXML   = FOLDERCATEGORY;
        $table    = TABLE_CATEGORY;
    } elseif ($url_data[3] === "user" ) {
        $strPath  = FOLDERIMAGEUSER;
        $strXML   = FOLDERUSER;
        $table    = TABLE_USER;
    } elseif ($url_data[3] === "userbanner") {
        $strPath  = FOLDERIMAGEUSER;
        $strXML   = FOLDERUSER;
        $fileInfo = $strXML . $id . ".xml";
    } elseif ($url_data[3] === "company") {
        $strPath  = FOLDERIMAGECOMPANY;
        $strXML   = FOLDERCOMPANY;
        $table    = TABLE_COMPANY;
    } elseif ($url_data[3] === "companybanner") {
        $strPath  = FOLDERIMAGECOMPANY;
        $strXML   = FOLDERCOMPANY;
        $fileInfo = $strXML . $id . ".xml";
    } elseif ($url_data[3] === "pagecmpfacebookcover") {
        $strPath   = FOLDERIMAGECOMPANYFACEBOOK;
        $strXML    = FOLDERCOMPANY;
        $tableInfo = TABLE_COMPANY;
        $fileInfo  = $strXML . $id . ".xml";
    } elseif ($url_data[3] === "pagehtml") {
        $strPath  = FOLDERUPLOAD;
        $strXML   = FOLDERHOME;
        $tableInfo = TABLE_PAGEHTML;
        $fileInfo = $strXML . $id . ".xml";
    } 

} elseif( $sessionUserId == $uid ) {

    if ($url_data[3] === "user" ) {
        $strPath  = FOLDERIMAGEUSER;
        $strXML   = FOLDERUSER;
        $table    = TABLE_USER;
    } elseif ($url_data[3] === "userbanner") {
        $strPath   = FOLDERIMAGEUSER;
        $strXML    = FOLDERUSER;
        $tableInfo = TABLE_USER;
        $fileInfo  = $strXML . $id . ".xml";
    } elseif ($url_data[3] === "company") {
        $strPath  = FOLDERIMAGECOMPANY;
        $strXML   = FOLDERCOMPANY;
        $table    = TABLE_COMPANY;
    } elseif ($url_data[3] === "companybanner") {
        $strPath   = FOLDERIMAGECOMPANY;
        $strXML    = FOLDERCOMPANY;
        $tableInfo = TABLE_COMPANY;
        $fileInfo  = $strXML . $id . ".xml";
    } elseif ($url_data[3] === "blog") {
        $strPath  = FOLDERIMAGEBLOG;
        $strXML   = FOLDERBLOG;
        $table    = TABLE_BLOG;
    }
}

if( $strPath && $strXML ){
    require "api/uploadfile/avatar.php";
} else {
    $code = 401;
    $errors = $language["sessionExpiration"];
}
?>
