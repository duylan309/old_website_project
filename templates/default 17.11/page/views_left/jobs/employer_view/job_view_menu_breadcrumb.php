<?php if($isJobOfUser):?>
	<div class="breadcrumb cmp-more no-radius"
	 data-copy-template
	 data-view-template=".breadcrumb"
	 data-elm-data='{"currenturl" : "<?=$_GET['q']?>", "jobtitle": "<?=$infoJob['db']['ti']?>", "username": "<?=isset($_GET["uname"]) ? $_GET["uname"] : null?>" , "applied" : "<?=isset($infoJob["userapplied"]["total"]) ? $infoJob["userapplied"]["total"] : 0?>"}'
	 data-template-id="viewBreadCrumbJob">&nbsp;</div>
<?php endif;?>	