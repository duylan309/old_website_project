 <?php if((isset($_GET["cid"]) && $_GET["cid"]) || $jid):?>
 <div class="breadcrumb cmp-more no-radius"
 data-copy-template
 data-view-template=".breadcrumb"
 data-elm-data='{"currenturl" : "<?=$_GET['q']?>", 
                 "jobtitle" : "", 
                 "username" : "<?=isset($_GET["uname"]) ? $_GET["uname"] : null?>" , 
                 "totalNumber" : "<?=isset($total["applications"]) ? $total["applications"] : '' ?>"}'
 data-template-id="viewBreadCrumbEmployee">&nbsp;</div>
<?php endif;?>
