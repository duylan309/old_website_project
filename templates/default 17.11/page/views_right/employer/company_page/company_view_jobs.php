<div class="item-content">
    <h3 class="icon hidden tab-title hidden-sm hidden-md hidden-lg"><?=$language["companyJob"]?></h3>
    <div class="tab-content">
        <div class="item-view-more"
            data-view-list-by-handlebar
            data-init-button-magic=".item [data-button-magic]"
            data-init-object="viewListJobCmp"
            data-url="<?=APIGETJOB;?>"
            data-params="cid=<?=$pid?>"
            data-method="get"
            data-show-page="10"
            data-show-item="10"
            data-show-all="true"
            data-scroll-view="false"
            data-form-filter=".form-filter"
            data-object-reverse="true"
            data-ignore-visible="true"
            data-ignore-hash="true"
            data-is-reload-page="true"
            data-reload-base-on-id="id"
            data-reload-base-set-params="listID"
            data-reload-url="<?=APIGETJOBLISTID?>"
            data-template-id="viewItemJobClientBigBox" >

            <div class="col-sm-12 no-padding">
                <div  data-content
                    class="view-items"
                    data-center-items
                    data-center-width="[data-ui-tabs]"
                    data-class-name="item-job"
                    data-item-class=".item"
                    data-responsive="true"
                    data-items-custom="[800, 1]" >
                    <div class="style-loadding">...</div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
        </div>
    </div>
</div>
