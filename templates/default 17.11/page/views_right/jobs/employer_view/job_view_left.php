<div class="user-menu-action"
    data-elm-data='{"managejob":"1"}'
    data-copy-template
    data-view-template=".user-menu-action"
    data-template-id="entryUserMenuSetting"></div>

<div class="block block-statistics hidden-xs m-t-15"
  data-copy-template
  data-view-template=".block-statistics"
  data-elm-data='{"viewed":"<?=$isViewed["vi"]?>", "applied": "<?=isset($infoJob["userapplied"]["total"]) ? $infoJob["userapplied"]["total"] : 0?>" , "hired":"<?=isset($infoJob["userhired"]["total"]) ? $infoJob["userhired"]["total"] : 0?>" }'
data-template-id="entryJobStatistics">&nbsp;</div>

<?php if(isset($_GET["cid"]) && $_GET["cid"] ) {?>
<div class="list-side-r hidden-xs">
  <h2 class="title-box text-color2"><?=$language["jobOtherEmployee"]?></h2>
  <div class="item-view-more"
    data-view-list-by-handlebar
    data-init-button-magic=".item [data-button-magic]"
    data-init-object="userManageApplied"
    data-url="<?=$getUrl?>"
    data-params="uid=<?=$sessionUserId?>&action=userapply&limit=5"
    data-elm-data='{"userapply":"1", "userManageAction":"1", "minusUser" : "<?=$_GET['cid']?>"}'
    data-method="get"
    data-show-page="10"
    data-show-item="20"
    data-show-all="false"
    data-scroll-view="false"
    data-form-filter=".form-filter"
    data-is-reload-page="true"
    data-reload-base-on-id="ui"
    data-reload-base-set-params="listID"
    data-reload-url="<?=APIGETUSERLISTID?>"
    data-template-id="entryCvItemApplied" >
    <div class="view-items" data-content>
      <div class="style-loadding">...</div>
    </div>

    <div data-footer></div>
  </div>
</div>
<?php }?>

<?php $strQueryJobCmp = "SELECT id FROM ".TABLE_JOB." WHERE ui = {$infoCmp["id"]} AND id <> {$jid} LIMIT 0,3 ";
$listJobCmp = $db->db_arrayList($strQueryJobCmp);
$strQueryJobCmp = null;
if($listJobCmp) {
  foreach ($listJobCmp as $key => $value) {
    $strQueryJobCmp[] .= $value["id"];
  }
  // $strQueryJobCmp = APIGETJOBLISTID."?listID=".implode(",", $strQueryJobCmp);

?>
<script src="<?=APIGETJOBLISTID?>?listID=<?=implode(",", $strQueryJobCmp)?>&var=window.strQueryJobCmp"></script>

<div class="list-side-r hidden-xs">
  <h2 class="title-box text-color2"><?=$language["jobOther"];?></h2>
  <div class="side-bar"
    data-view-list-by-handlebar
    data-init-object="strQueryJobCmp"
    data-method="get"
    data-elm-data='{"userapply":"1", "userManageJobInSide":"1"}'
    data-show-page="3"
    data-show-item="10"
    data-show-all="false"
    data-scroll-view="false"
    data-ignore-hash="true"
    data-template-id="viewItemJobClientRight" >
    <div data-content>
      <div class="style-loadding">...</div>
    </div>

  </div>
</div>
<?php }?>
