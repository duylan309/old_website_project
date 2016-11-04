<?php
if(isset($url_data[1]) && isset($url_data[2])) {
    $jid = $url_data[1];
    $fileItemInfo = FOLDERNEWS.$jid.".xml";
    if(is_file($fileItemInfo)) {
        $itemInfo = simplexml_load_file($fileItemInfo);
        $itemInfo = json_encode($itemInfo);
        $itemInfo = json_decode($itemInfo, true);

        $seo = isset($itemInfo["meta"])?$itemInfo["meta"]: null;

        $web_title = isset($seo["title"][$langcode]) && count($seo["title"][$langcode]) ? $seo["title"][$langcode]: isset($itemInfo["db"]["ti_{$langcode}"]) ? $itemInfo["db"]["ti_{$langcode}"] : null;
        $web_description = isset($seo["keyword"][$langcode]) && count($seo["keyword"][$langcode]) ? $seo["keyword"][$langcode]:null;
        $web_description = isset($seo["description"][$langcode]) && count($seo["description"][$langcode]) ? $seo["description"][$langcode]:null;
    }
 
}

function main() {
    global $seo_name, $language, $langcode, $itemInfo, $fileId;

    var_dump($itemInfo);
    # description
    if(isset($itemInfo["more"]["description"][$langcode]))
        echo $itemInfo["more"]["description"][$langcode];
}