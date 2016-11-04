<?php 

$fileUser = FOLDERUSER.$sessionUserId.".xml";

if(is_file($fileUser)) {
    $fileInfo     = simplexml_load_file($fileUser);
    $userInfoPage = json_encode($fileInfo);
    $userInfoPage = json_decode($userInfoPage, true);
}
$userbanner = isset($userInfoPage["userbanner"]) && $userInfoPage["userbanner"] ? $userInfoPage["userbanner"] : null;

$strElementData = "data-elm-data='{\"userBaner\":\"{$userbanner}\"}'";



$templateId = "entryUserInfoSetting";
$strGetUrl  = null;