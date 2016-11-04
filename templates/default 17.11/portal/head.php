<?php
    $seo = isset($informationConfig["config"]["seo"])? $informationConfig["config"]["seo"]: null;
    $seoTitle = isset($seo["title"][$langcode]) && strval($seo["title"][$langcode]) ? $seo["title"][$langcode] : "";
    $seoKeyword = isset($seo["keyword"][$langcode]) ? $seo["keyword"][$langcode] : "";
    $seoDescription = isset($seo["description"][$langcode]) ? $seo["description"][$langcode] : "";
    $googleAnalyticsCode = isset($seo["googleAnalyticsCode"]) ? $seo["googleAnalyticsCode"] : "";
    $cssStyle = isset($informationConfig["config"]["css"])?$informationConfig["config"]["css"]:null;
?>
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="" />
    <meta name="description" content="<?=isset($web_description) && count($web_description) ? $web_description:"";?>" />
    <meta name="keywords" content="<?=isset($web_keyword)?$web_keyword:$seoKeyword;?>"/>
    <title><?=isset($web_title) && count($web_title)>0?$web_title: $seoTitle;?></title>
    <?=isset($facebook_share_content) && count($facebook_share_content) ? $facebook_share_content : ''?>
    
    <link id="page_favicon" href="/media/images/icon/favicon.ico" rel="icon" type="image/x-icon">
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&subset=vietnamese" rel="stylesheet"> -->
   
    <link rel="stylesheet" href="/media/style/daterangepicker.css" />
    <link rel="stylesheet" href="/media/style/style.css" />
    <link rel="stylesheet" href="/media/style/fonticon.css" />
    <link rel="stylesheet" href="/media/style/thue.min.css" />
    <link rel="stylesheet" href="/media/style/thue.mobile.min.css" />
    <style>
        <?= isset($cssStyle["style"]) && count($cssStyle["style"])? $cssStyle["style"]:'';?>
    </style>

    <script type="text/javascript" src="<?=APIGETUSERINFO.'/'.$sessionUserId;?>?var=window.userAccess"></script>
    
    <script type="text/javascript" src="/api/get/optionlocal?var=window.optionLocal<?=$pageUserId?>"></script>
    <script type="text/javascript" src="/api/get/lang?var=window.languageText"></script>
    <script type="text/javascript" src="/api/get/cmplisttxt?action=load&var=window.listCmpListTXT"></script>

    <script type="text/javascript" src="/media/js/modernizr.js"></script>
    <!--<script type="text/javascript" src="/media/js/template.frontend.js"></script>-->
    <script type="text/javascript" src="/media/js/clientlibs.js"></script>
    <script type="text/javascript" src="/media/js/facebook_plugin.js"></script>
    <script type="text/javascript" src="/media/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/media/js/thuetoday.min.js"></script>
    <script type="text/javascript" src="/media/js/thue.min.js"></script>
    
    <script type="text/javascript" src="/media/plugins/tinymce/tinymce.min.js"type="text/javascript" ></script>
    <script type="text/javascript" src="/media/plugins/tinymce/init.js"></script>

</head>
