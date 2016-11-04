<?php
$strGetSriptViewBlog = null;
$strDataParam = null;
$strDateElement = null;

$companyInfoPage["db"]["im"] = isset($companyInfoPage["db"]["im"]) && count($companyInfoPage["db"]["im"]) ? $companyInfoPage["db"]["im"] : '../../style/user.png';

$strDateElement = "data-elm-data='{\"cmpim\":\"{$companyInfoPage["db"]["im"]}\",\"cmpname\":\"{$companyInfoPage["db"]["name"]}\"}'";
if($isPageOfCompany) {
    $strDateElement = "data-elm-data='{\"cmpim\":\"{$companyInfoPage["db"]["im"]}\",\"cmpname\":\"{$companyInfoPage["db"]["name"]}\",\"myblog\":{$pid}}'";
    $strDataParam = 'data-params="pid='.$pid.'"';
    $strElmBlog = "data-elm-data='{\"cid\":\"{$pid}\"}'";

    echo '<div class="form-add-blog side-bar"
            data-copy-template
            '.$strElmBlog.'
            data-view-template=".form-add-blog"
            data-template-id="entryFormBlogAdd">&nbsp;</div>';
}
else {
    $strDataParam = 'data-params="pid='.$pid.'&status=2"';
}

$strSuggestFb = $isPageOfCompany ? '<div data-total-item="0" class="fb-noti m-b-15 ">
    <div class="no-data">
        <div class="no-data-content">'.$language["notiCanGetFbNewfeed"].' <a class="text-uppercase text-color1" href="/'.$seo_name["page"]["user"].'/?manage=pagecmp&setting=info&pid='.$companyInfoPage["db"]["id"].'">'.$language["notiCanGetFbNewfeedEditFacebook"].'</a></div>
    </div>
</div>' : '';

$strViewBlog = $strSuggestFb.'
<div class="item-view-more side-bar"
    data-view-list-by-handlebar
    data-init-button-magic=".item [data-button-magic]"
    data-url="'.APIGETBLOG.'"
    '.$strDataParam.'
    '.$strDateElement.'
    data-method="get"
    data-show-page="10"
    data-show-item="10"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".form-filter"
    data-template-id="viewItemBlog" >

    <div class="view-items" data-content>
        <div class="style-loadding">...</div>
    </div>

    <div class="no-data">
        <div class="no-data-content">'.$language['noArticlesAndComingSoon'].'</div>
    </div>

    <div data-footer>...</div>
</div>';
echo $strViewBlog;
?>
<!-- <script type="text/javascript" src="http://dev.thue.today/api/get/blog?pid=185&var=window.aaa"></script> -->
