<?php if ($isPageOfCompany):?>
<div class="update-slide-image text-right photo-function"
    data-copy-template
    data-elm-data='{"urlPost":"<?=APIPOSTSLIDE?>/company",
    "maxSize":"<?=maxSizeUpload?>",
    "ui":"<?=$sessionUserId?>",
    "itemId":"<?=$sessionUserId?>",
    "hidCancel":"1",
    "company_id":"<?=$rowCompany["id"]?>"
    }'
    data-view-template=".update-slide-image"
    data-template-id="entrySlideImage">
</div>
<div class="clearfix"></div>
<?php endif;?>


<div class="photos-container">
<?php if ($isPageOfCompany):?>
<div data-total-item="0" class="fb-noti m-b-15 ">
    <div class="no-data">
        <div class="no-data-content"><?=$language["notiCanGetFbPhoto"]?><a class="text-uppercase" href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info&pid=<?=$companyInfoPage["db"]["id"]?>"><?=$language["notiCanGetFbNewfeedEditFacebook"]?></a></div>
    </div>
</div>
<?php endif;?>
     <div class="item-view-slide-image"
         data-view-list-by-handlebar
         data-elm-data='{"uid":"<?=$sessionUserId?>"}'
         data-ignore-hash="true"
         data-init-button-magic=".item-view-slide-image [data-button-magic]"
         data-url="<?=APIGETSLIDE.'/company/'.$rowCompany["id"]?>"
         data-params="dir=<?=$rowCompany["id"]?>"
         data-method="GET"
         data-show-page="10"
         data-show-item="5"
         data-show-all="false"
         data-scroll-view="false"
         data-img-lightbox=".item-view-slide-image [data-lightbox]"
         data-template-id="entrySlideItemTwo" >
         <div class="view-items" data-content><div class="style-loadding">...</div></div>
         <div class="no-data">
              <div class="no-data-content"><?=$language['noPhotosAndComingSoon']?></div>
         </div>
         <div data-footer></div>
     </div>
</div>

