<?php
$rowCompany["im"] = isset($rowCompany["im"]) && count($rowCompany["im"])? $rowCompany["im"] : "";
$small_cover = isset($companyInfoPage["companybanner"]) && count($companyInfoPage["companybanner"]) ? '' : 'scover';


if ($isPageOfCompany) {
    $strImgLogo = '<div class="update-item-image-logo"
        data-copy-template
        data-elm-data=\'{"urlPost":"/api/post/image/company",
        "urlPostDel":"/api/post/imagedelete",
        "imgName":"'.$rowCompany["im"].'",
        "maxSize":"'.maxSizeUpload.'",
        "imgPath":"'.FOLDERIMAGECOMPANY.'",
        "module":"user",
        "ui":"'.$sessionUserId.'",
        "disabledDelete":"1",
        "nocol":"1",
        "itemId":"'.$rowCompany["id"].'"}\'
        data-view-template=".update-item-image-logo"
        data-template-id="entryItemImage">
    </div>';

    $strImgBanner = '<div class="update-banner-image"
        data-copy-template
        data-elm-data=\'{"urlPost":"/api/post/image/companybanner",
        "urlPostDel":"/api/post/imagedelete",
        "maxSize":"'.maxSizeUpload.'",
        "imgName":"'.$companybanner.'",
        "imgPath":"'.FOLDERIMAGECOMPANY.'",
        "module":"banner",
        "ui":"'.$sessionUserId.'",
        "disabledDelete":"1",
        "nocol":"1",
        "itemId":"'.$rowCompany["id"].'"}\'
        data-view-template=".update-banner-image"
        data-template-id="entryItemImage">
    </div>';
} else {

    $avatar_cmp = isset($rowCompany["im"]) && count($rowCompany["im"]) && $rowCompany["im"] ? '/'.FOLDERIMAGECOMPANY.'thumbnail/'.$rowCompany["im"] : UDATAIMAGE.'style/user.png';
    $cover_cmp = isset($companyInfoPage["companybanner"]) && count($companyInfoPage["companybanner"]) ? '/'.FOLDERIMAGECOMPANY.$companybanner : UDATAIMAGE.'style/cover-default.jpg';

    $strImgBanner = '  <div class="update-banner-image in">
                        <div class="form-horizontal post-form">
                            <div class="form-group no-margin">
                                <div class="nocol col-xs-12">
                                    <div class="image-preview transition v-center">
                                        <img src="'.$cover_cmp .'">
                                        <div class="img-with-css b-cover transition" style="background:url('.$cover_cmp.') no-repeat"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';


    $strImgLogo =  '<div class="image-preview transition b-r-4 c-center">
                        <img src="'.$avatar_cmp .'">
                        <div class="img-with-css b-cover transition" style="background:url('.$avatar_cmp.') no-repeat"></div>
                        
                    </div>';

}
?>
<div class="cmp-more no-padding cover-section no-border">
    <div class="cover-photo <?=$small_cover?>">
         <?php echo $strImgBanner; ?>
    </div>
</div>

<div class="cmp-more no-radius header-profile">
        <div class="row">
            <div class="col-sm-2">
                <div class="cmp-logo">
                    <?php echo $strImgLogo; ?>
                </div>
            </div>
            <div class="col-sm-10 text-left">
                <div class="cmp-info">
                    <h1><?=$rowCompany["name"]?></h1>

                    <table class="short-text">
                        <colgroup>
                          <col class="col-xs-8 col-sm-10">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td><span class="view-local-category c-list t-s-16"
                                            data-copy-template
                                            data-view-template=".view-local-category"
                                            data-elm-data='{"key":"","value":"","obj":"menuList","str":"<?=$rowCompany["category"]?>"}'
                                            data-template-id="entryViewLocalOption">&nbsp;</span></td>
                            </tr>
                            <tr>
                                <td><p class="short-text"><?=$rowCompany["address"]?></p></td>
                            </tr>

                            <?php if (isset($rowCompany["website"])):?>
                            <tr class="hidden">
                                <td><label><?=$language["website"]?></label></td>
                                <td><p class="short-text"><?=$rowCompany["website"]?></p></td>
                            </tr>
                            <?php else:?>
                            <tr class="hidden">
                                <td><label><?=$language["email"]?></label></td>
                                <td><p class="short-text"><?=$rowCompany["email"]?></p></td>
                            </tr>
                            <?php endif;?>


                        </tbody>
                    </table>

                    <?php if(isset($_SESSION["userlog"]["type"]) &&  $_SESSION["userlog"]["type"]== 1):?>
                        <?php if($_SESSION["userlog"]["id"] === $rowCompany["ui"]):?>
                        <a href="<?="/".$seo_name["page"]["user"]."?manage=pagecmp&setting=info&pid={$pid}";?>"
                            class="btn bg-color4 pull-right btn-edit">
                           <i class="fa fa-pencil"></i>
                        </a>

                        <a  href="#"
                            class="btn bg-color4 pull-right btn-edit-facebook text-facebook"
                            data-update-facebook-photo
                            data-co-id="<?=$rowCompany["id"]?>"
                            data-ui-id="<?=$_SESSION["userlog"]["id"]?>"
                            data-facebook-url="<?=$rowCompany["facebook"] ? $rowCompany["facebook"] : ""?>"
                            >
                            <i class="fa fa-facebook-square"></i> <span><?=$language["updatePhotoFromFacebook"]?></span>
                        </a>

                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>

    <div class="header-ui-tab hidden-xs"
     data-fixed-stop="#footer"
     data-fixed-class="cl-fixed"
     data-fixed=".ui-cmp-bars">
        <div class="container">
            <div class="ui-tabs row hidden" data-copy-obj=".ui-cmp-bars ul">
            </div>
        </div>

    </div>
</div>

<?php $urlCmp = isset($rowCompany["url"]) && count($rowCompany["url"]) ? $rowCompany["url"] : $seo_name["page"]["cmp"].'/'.$rowCompany["id"].'/'.urlFriendly($rowCompany["name"])?>

<div class="ui-tabs ui-cmp-bars">
    <ul>
        <?php if(isset($rowCompany['facebook']) && !is_array($rowCompany['facebook']) && count($rowCompany['facebook'])):?>
        <li class="<?=!isset($tab) || $tab == $seo_name["page"]["newfeed"] ? "current" : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["newfeed"]?>" ><?=$language["newfeed"]?></a></li>
        <li class="<?=isset($tab) ? ($tab == $seo_name["page"]["about"] ? "current" : '') : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["about"]?>" ><?=$language["about"]?></a></li>
        <li class="<?=isset($tab) ? ($tab == $seo_name["page"]["photo"] ? "current" : '') : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["photo"]?>" ><?=$language["photos"]?></a></li>
        <li class="<?=isset($tab) ? ($tab == $seo_name["page"]["jobs"] ? "current" : '') : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["jobs"]?>" ><?=$language["companyJob"]?></a></li>
        <?php else:?>
        <li class="<?=isset($tab) ? ($tab == $seo_name["page"]["about"] ? "current" : '') : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["about"]?>" ><?=$language["about"]?></a></li>
        <li class="<?=isset($tab) ? ($tab == $seo_name["page"]["jobs"] ? "current" : '') : ''?>"><a href="/<?=$urlCmp?>/<?=$seo_name["page"]["jobs"]?>" ><?=$language["companyJob"]?></a></li>
        <?php endif;?> 
        <?php if(isset($_SESSION["userlog"]["type"]) &&  $_SESSION["userlog"]["type"]== 1):?>
            <?php if($_SESSION["userlog"]["id"] === $rowCompany["ui"]):?>
            <li><a href="<?="/".$seo_name["page"]["user"]."?manage=postjob&pid={$pid}";?>"
                        class="text-color3"
                        data-button-magics
                        data-elm-data='{"urlRedirect":"/<?=$rowCompany["url"]?>"}'
                        data-view-template-local="true"
                        data-elm-data='{
                             "missingSession":"true",
                             "hideObj":"[data-quick-view-item1]"
                        }'
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="jobsAdd"><span><?=$language["btnPostJob"]?></span></a></li>
            <?php endif;?>
        <?php endif;?>
    </ul>
    <div class="clearfix"></div>
</div>

<div class="error-facebook">
<?=$language["errorFacebookNotFound"]?>
</div>
