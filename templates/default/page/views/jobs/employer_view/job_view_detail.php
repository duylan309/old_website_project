<?php 
#update view
$strUpdateView = "UPDATE ".TABLE_JOB_APPLIED." SET st = 7 WHERE jo = $jid AND ui = {$uid} AND ei = {$_SESSION["userlog"]["id"]}";
$db->db_query($strUpdateView);
// ECHO USER DETAIL
echo $strGetScript;
?>
<h3 class="t-s-17 m-l-10 hidden" style="margin:12px 0 10px 15px"><?=$language["questionAnswer"]?></h3>
<div class="cmp-more bg-color7">
    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-12 text-bold"><?=$language['questionOne']?></label>
        <span class="col-xs-12 col-sm-12"><i class="fa fa-caret-right text-color3"></i> <?=$user_answer['aw1']?></span>
    </div>
    <div class="j-view-option row hidden">
        <label class="col-xs-4 col-sm-3"><?=$language['questionTwo']?></label>
        <span class="col-xs-8 col-sm-9"><i class="fa fa-caret-right text-color3"></i> <?=$user_answer['aw2']?></span>
    </div>
</div>

<div class="view-cv-detail m-t-15"
<?=$strElementData?>
data-option-local="cvDetail"
data-copy-template
data-view-template=".view-cv-detail"
data-template-id="entryCvView">&nbsp;</div>