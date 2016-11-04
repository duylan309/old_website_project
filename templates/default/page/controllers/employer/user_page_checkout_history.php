<?php

if(isset($_GET["view"]) && $_GET["view"]) {
    # view Detail
    $templateId = "entryCheckoutViewDetail";
    # $strGetUrl = 'data-get-url="'.APIGETCHECKOUT.'/'.$_GET["view"].'"';
    $strGetScript = '<script src="'.APIGETCHECKOUT.'/'.$_GET["view"].'&var=window.viewCheckoutDetail"></script>';
} else {
    # view List
    $tmpFrom = explode("-" , date("Y-m-01"));
    $tmpTo = explode("-" , date("Y-m-d"));
    if(isset($_POST["dayFrom"])) {
        $tmpFrom =  explode("-",$_POST["dayFrom"]);
    }
    if(isset($_POST["dayTo"])) {
        $tmpTo =  explode("-",$_POST["dayTo"]);
    }
    $intFrom = mktime(0, 0, 0, $tmpFrom[1], $tmpFrom[2],$tmpFrom[0]);
    $intTo = mktime(23, 59, 59, $tmpTo[1], $tmpTo[2],$tmpTo[0]);
    $tmpFrom = implode("-", $tmpFrom);
    $tmpTo = implode("-", $tmpTo);

    $strAjaxUrl = APIGETCHECKOUT."?uid={$sessionUserId}&from={$intFrom}&to={$intTo}";
    $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\",\"dayFrom\":\"{$tmpFrom}\", \"dayTo\":\"{$tmpTo}\"}'";

    $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.userManageCheckout"></script>';
    $templateId = "entryUserCheckout";
    $strGetUrl = null;
}