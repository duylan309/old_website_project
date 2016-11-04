<div class="item-view-more"
    data-view-list-by-handlebar
    data-init-button-magic=".item [data-button-magic]"
    data-url="<?=$getUrl;?>"
    data-elm-data='{"userapply":"1","userManageAction":"1"<?=$strElmLinkMore?>,"employer_id" : "<?=isset($_SESSION["userlog"]["id"]) ? $_SESSION["userlog"]["id"] : 0?>","company_id" : "<?=$infoCmp['id']?>"}'
    data-method="get"
    data-show-page="10"
    data-show-item="20"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".filter-form"
    data-is-reload-page="true"
    data-reload-base-on-id="ui"
    data-reload-base-set-params="listID"
    data-reload-url="<?=APIGETUSERLISTID?>"
    data-template-id="entryCvItemActionApplied" >
    
    <?php if($isJobOfUser):?>
    <div class="row">
        <div class="col-sm-12 m-b-5">
            <div class="header-nav-in t-s-16 ">
                <label><?=$language["total"]?>:</label> 
                <span class="text-bold text-color3">
                    <span data-total-item></span>
                </span> 
                <?=$language["peopleAppliedJob"]?>
            </div>
        </div>
    </div>

    <div class="filter-hori"
      data-copy-template
      data-view-template=".filter-hori"
      data-elm-data='{"totalNumber":"data-total-item","titleName":"<?=$language["peopleAppliedJob"]?>"}'
      data-template-id="entryCmpFilterHorizontal">&nbsp;</div>
    
    <?php endif;?>

    <div class="view-items" data-content>
        <div class="style-loadding">...</div>
    </div>
    
    <div class="no-data">
        <div class="no-data-content"><?=$language['noAppliedForThisJob']?></div>
    </div>
    <div data-footer></div>
</div>