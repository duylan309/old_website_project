<div class="list-side-r hidden-xs">
    <h2 class="title-box text-color2"><?=$language["suggestion"]?></h2>
    <div class="side-bar m-t-15"
        data-view-list-by-handlebar
        data-init-button-magic=".item [data-button-magic]"
        data-init-object="suggestJobs"
        data-url="<?=APIGETJOBSUGGEST?>"
        data-params="limit=5"
        data-method="get"
        data-show-page="10"
        data-elm-data='{"showCmp":"1"}'
        data-show-item="10"
        data-show-all="false"
        data-scroll-view="false"
        data-object-reverse="true"
        data-is-reload-page="true"
        data-reload-base-on-id="id"
        data-ignore-hash="true"
        data-reload-base-set-params="listID"
        data-reload-url="<?=APIGETJOBLISTID?>"
        data-template-id="viewItemJobClientRight" >
        <div data-content>
            <div class="style-loadding">...</div>
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
</div>