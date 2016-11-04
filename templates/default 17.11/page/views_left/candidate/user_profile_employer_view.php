<div class="item-view-more hidden"
    data-view-list-by-handlebar
    data-init-button-magic=".item [data-button-magic]"
    data-init-object="userCvSame"
    data-url="<?=APIGETCV;?>"
    data-params="uid=-<?=$seekerId?>&limit=10"
    data-method="get"
    data-show-page="10"
    data-show-item="20"
    data-show-all="true"
    data-scroll-view="false"
    data-is-reload-page="true"
    data-ignore-hash="true"
    data-reload-base-on-id="ui"
    data-reload-base-set-params="listID"
    data-reload-url="<?=APIGETUSERLISTID?>"
    data-template-id="entryCvItem" >
    <div class="list-side-r hidden-xs">
    
    <h2 class="title-box text-color2"><?=$language["cvSame"];?></h2>

    <div class="view-items" data-content><div class="style-loadding">...</div></div>
    <div data-footer></div>
    </div>
</div>