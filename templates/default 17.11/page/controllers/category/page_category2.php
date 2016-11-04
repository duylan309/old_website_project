<?php
function main() {
    global $seo_name, $language, $pageInfo, $item, $langcode;
    if(isset($pageInfo["more"]["description"])){
        ?>
        <div class="more-info">
            <div class="title hidden">
                <h1><?=$pageInfo["db"]["ti_{$langcode}"]?></h1>
            </div>
            <div class="content">
                <?=$pageInfo["more"]["description"]["$langcode"]?>
            </div>
        </div>
        <?php
    } else {
        $strAjaxUrl = APIGETNEWS."?ca={$item["id"]}";
        ?>
        <div class="item-view-more admin-list"
            data-view-list-by-handlebar
            data-init-button-magic="[data-button-magic]"
            data-url="<?=$strAjaxUrl?>"
            data-init-object="newsList"
            data-method="get"
            data-show-page="10"
            data-show-item="10"
            data-show-all="false"
            data-scroll-view="false"
            data-form-filter=".form-filter"
            data-object-reverse="true"
            data-template-id="viewItemNews">
            <div class="view-items" data-content></div>
        </div>
        <?php
    }
}

