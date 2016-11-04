<?php
$isPageNotFound = false;

if(!isset($url_data[1]) || isset($url_data[3]) ){
    require dirname(__FILE__) . '/notfound.php';
}
else {
    $strQuery = "SELECT * FROM ".TABLE_CATEGORY." WHERE url='".$url_data[1]."' AND st>0 LIMIT 0,1";
    $item = $db->db_array($strQuery);
    if($item) {
        $fileId = $item["id"];
        $file = FOLDERCATEGORY . $fileId . ".xml";
        $pageInfo = null;
        if (is_file($file)) {
            $pageInfo = simplexml_load_file($file);
            $pageInfo = json_encode($pageInfo);
            $pageInfo = json_decode($pageInfo, true);
            $seo = isset($pageInfo["meta"])?$pageInfo["meta"]: null;

            $web_title = isset($seo["title"][$langcode]) && count($seo["title"][$langcode]) ? $seo["title"][$langcode]:null;
            $web_ = isset($seo["keyword"][$langcode]) && count($seo["keyword"][$langcode]) ? $seo["keyword"][$langcode]:null;
            $web_description = isset($seo["desc"][$langcode]) && count($seo["desc"][$langcode]) ? $seo["desc"][$langcode]:null;

            $path_img = FOLDERSLIDEMENU . $pageInfo["db"]["id"] . "/";
        }

         # facebook set up #

        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $cover_cmp  = isset($pageInfo["db"]["im"]) && count($pageInfo["db"]["im"]) ? 'https://'.$_SERVER["HTTP_HOST"].UDATAIMAGE.'images/category/'.$pageInfo["db"]["im"] : 'https://'.$_SERVER["HTTP_HOST"].UDATAIMAGE.'style/cover-default.jpg';

        $facebook_share_content = '';

        $facebook_share_content .= '<meta property="fb:app_id"   content="'.FBAPPID.'" />';
        $facebook_share_content .= '<meta property="og:url"   content="'.$actual_link .'" />';
        $facebook_share_content .= '<meta property="og:type"  content="website" />';
        $facebook_share_content .= '<meta property="og:title" content="'.$web_title.'" />';
        $facebook_share_content .= '<meta property="og:description" content="'.$web_description.'" />';
        $facebook_share_content .= '<meta property="og:image" content="'.$cover_cmp.'" />';
        $facebook_share_content .= '<meta property="og:image:width" content="450" />';
        $facebook_share_content .= '<meta property="og:image:height" content="298" />';

        # end facebook set up #

        # page type
        $optionPage = $item["opp"];
        if(is_file(dirname(__FILE__) .  "/page_category{$optionPage}.php")) {
            require dirname(__FILE__) .  "/page_category{$optionPage}.php";
        }
        else {
            require dirname(__FILE__) . '/../general/user_page_not_found.php';
        }

    }
    else {
        require dirname(__FILE__) . '/../general/user_page_not_found.php';
    }
}
