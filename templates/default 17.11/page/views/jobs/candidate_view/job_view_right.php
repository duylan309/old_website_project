<?php
if($sessionUserId != $infoCmp["ui"]) {
    $strQueryJobCmp = "SELECT id FROM ".TABLE_JOB." WHERE ci = {$infoCmp["id"]} AND id <> {$jid} AND st=2 LIMIT 0,3 ";
    $listJobCmp = $db->db_arrayList($strQueryJobCmp);
    $strQueryJobCmp = null;
    if($listJobCmp) {
        foreach ($listJobCmp as $key => $value) {
            $strQueryJobCmp[] .= $value["id"];
        }
        $strQueryJobCmp = APIGETJOBLISTID."?listID=".implode(",", $strQueryJobCmp);
    }

    if($strQueryJobCmp){
?>

<div class="list-side-r">
    <h2 class="title-box text-color5"><?=$language["jobSameEmployment"];?></h2>
    <div class="side-bar"
        data-view-list-by-handlebar
        data-init-obj="jobOtherOfCmp"
        data-ignore-hash="true"
        data-url="<?=$strQueryJobCmp;?>"
        data-method="get"
        data-show-page="3"
        data-show-item="10"
        data-show-all="false"
        data-scroll-view="false"
        data-template-id="viewItemJobClientRight" >
        <div data-content>
            <div class="style-loadding">...</div>
        </div>
        <a href="<?=$strUrlCmp.'/'.$seo_name["page"]["jobs"]?>" class="btn btn-block bg-color5 text-uppercase btn-save transition"><?=$language["viewMore"]?></a>
    </div>
</div>
<?php }?>

<?php 

$title = trim($infoJob["db"]["ti"]);
$SameJobsLink = '/'.$seo_name["page"]["search"].'?distinct=1&random=1&title='.$title;

 $title = explode(' ', $title);
 $strWhere = NULL;
 if($title) {
     foreach ($title as $key => $value) {
         if($value) {
             $value = urlFriendly($value);
             $strWhere .= $key == 0 ? " ti LIKE '%{$value}%' " : " OR ti LIKE '%{$value}%' ";
         }
     }
 }

 $strQueryJobOther = "SELECT id FROM ".TABLE_JOB." WHERE ci <> {$infoCmp["id"]} AND ( {$strWhere} ) AND st=2 LIMIT 0,3 ";
 $listJobCmp = $db->db_arrayList($strQueryJobOther);
# echo $strQueryJobOther;
 $strQueryJobOther = null;
 if($listJobCmp) {
     foreach ($listJobCmp as $key => $value) {
         $strQueryJobOther[] .= $value["id"];
     }
     $strQueryJobOther = APIGETJOBLISTID."?listID=".implode(",", $strQueryJobOther);
 }

if($strQueryJobOther):?>
<div class="list-side-r">
    <h2 class="title-box text-color5"><?=$language["jobSame"];?></h2>
    <div class="side-bar m-t-15"
        data-view-list-by-handlebar
        data-init-obj="jobOtherSame"
        data-init-button-magic=".item [data-button-magic]"
        data-url="<?=$strQueryJobOther?>"
        data-method="get"
        data-ignore-hash="true"
        data-elm-data='{"showCmp":1}'
        data-show-page="10"
        data-show-item="10"
        data-show-all="false"
        data-scroll-view="false"
        data-template-id="viewItemJobClientRight" >
        <div data-content>
            <div class="style-loadding"></div>
        </div>
    <a href="<?=$SameJobsLink?>" class="btn btn-block bg-color5 text-uppercase btn-save transition"><?=$language["viewMore"]?></a>
    </div>
</div>
<?php endif;?>
<?php }?>
