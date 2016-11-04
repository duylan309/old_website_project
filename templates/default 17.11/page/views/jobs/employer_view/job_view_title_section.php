<?php 
if($isJobOfUser) :

    $strElmLinkMore = ',"linkMore":"/'.$_GET["q"].'?statistics=1&"';

    if(isset($_GET["cid"]) && $_GET["cid"] ) {
        $uid = intval($_GET["cid"]);
        $jid;

        $strSelectAwS = "ja.ti AS aw1, ja.de AS aw2, ja.cr AS cr ";
        $strWhereAwS  = "WHERE ja.ui = $uid AND ja.jo = $jid";
        
        $strQueryAwS  = "SELECT $strSelectAwS
                         FROM ".TABLE_JOB_APPLIED." AS ja {$strWhereAwS} ORDER BY ja.id DESC";
        $user_answer = $db->db_array($strQueryAwS);

        $strElementData = "data-elm-data='{\"viewCV\":\"{$_GET["cid"]}\",\"viewAW\":\"1\",\"jID\":\"{$infoJob["db"]["id"]}}\"}'";
        $strGetScript   = '<script src="'.APIGETCV.'/'.$_GET["cid"].'/'.$jid.'?type=db&var=window.cvDetail"></script>';

    }
    
endif;?>

<?php if(isset($_GET["statistics"]) && $_GET["statistics"]==1) :?>
<div class="hidden">
    <script src="<?=$getUrl.$paramUrl?>"></script>
</div>
<?php 

// CHECK TO VIEW USER DETAIL INSIDE JOB
if(isset($_GET["cid"]) && $_GET["cid"] ) {
    #update view
    $strUpdateView = "UPDATE ".TABLE_JOB_APPLIED." SET st = 7 WHERE jo = $jid AND ui = {$uid} AND ei = {$_SESSION["userlog"]["id"]}";
    $db->db_query($strUpdateView);

    // ECHO USER DETAIL
    echo  $strGetScript;
    echo '<h3 class="t-s-17 m-l-10 hidden" style="margin:12px 0 10px 15px">'.$language["questionAnswer"].'</h3>
        <div class="cmp-more bg-color7">
            <div class="j-view-option row">
                <label class="col-xs-12 col-sm-12 text-bold">'.$language['questionOne'].'</label>
                <span class="col-xs-12 col-sm-12"><i class="fa fa-caret-right text-color3"></i> '.$user_answer['aw1'].'</span>
            </div>
            <div class="j-view-option row hidden">
                <label class="col-xs-4 col-sm-3">'.$language['questionTwo'].'</label>
                <span class="col-xs-8 col-sm-9"><i class="fa fa-caret-right text-color3"></i> '.$user_answer['aw2'].'</span>
            </div>
        </div>';
    echo ' <div class="view-cv-detail m-t-15"
    '.$strElementData.'
    data-option-local="cvDetail"
    data-copy-template
    data-view-template=".view-cv-detail"
    data-template-id="entryCvView">&nbsp;</div>';

   
}
else {
?>

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
<?php
} 
endif;
?>