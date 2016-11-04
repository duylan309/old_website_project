<div class="hidden">
<?=$strGetScript?>
</div>

<div class="user-manage-feature">
	<div class="row">
	    <div class="col-sm-3">
	         <?php require dirname(__FILE__) . "/../../general/user_menu_dashboard.php";?>
	     </div>

	    <div class="col-sm-9">

	        <?php if(!isset($_GET["cid"])) :?>

			<div class="admin-title no-padding m-t-10">
				<div class="row n-m-bottom">
					<h2 class="no-margin text-color5 col-sm-4"><?=$language["applicantManagements"]?></h2>

					<div class="user-menu-left user-menu-header-h col-sm-8 text-right"
					     data-elm-data='{"headTitle"  : "<?=$strFeature == 'userapply' ? $language['applications'] : $language['interested']?>",
										 "headId"     : "<?=$strFeature?>",
										 "<?=$strFeature?>" : 1,
										 "totalapp"   : "<?=$rowTotalAction['total']?>",
										 "totalsaved" : "<?=$rowTotalAction['totalLike']?>",
										 "totalinterview" : "<?=$rowTotalAction['totalInterview']?>",
										 "totalhire" : "<?=$rowTotalAction['totalHire']?>",
										 "totaldeny" : "<?=$rowTotalAction['totalDeny']?>" }'
					     data-copy-template
					     data-view-template=".user-menu-left"
					     data-template-id="entryUserMenuAction"></div>

				</div>
			</div>
			<?php endif;?>

	        <?php if(isset($_GET["cid"]) && $_GET["cid"]) :?>

	            <?php require dirname(__FILE__) . "/../../general/user_candidate_breadcrumb.php";?>
				
	            <div class="view-cv-detail m-t-15"
	                data-option-local="cvDetail"
	                data-copy-template
	                data-elm-data='{"viewCV":"<?=$_GET["cid"]?>","isComment":"1","isTypeOfView":"1","pid":"<?=$_GET["pid"]?>"}'
	                data-view-template=".view-cv-detail"
	                data-template-id="entryCvView">
	            </div>

	        <?php else:?>

			 <div class="item-view-more"
	            data-view-list-by-handlebar
	            data-init-button-magic=".item [data-button-magic]"
	            data-url="<?=APIGETUSERACTION;?>"
	            <?php if(isset($_SESSION["usersub"]["id"]) && $_SESSION["usersub"]["id"]) { ?>
	            data-params="uid=<?=$sessionUserId?>&cid=<?=$_SESSION["usersub"]["id"]?>&action=<?=$strFeature?>&jid=<?=$jid?>"
	            <?php } else { ?>
	            data-params="uid=<?=$sessionUserId?>&action=<?=$strFeature?>&jid=<?=$jid?>"
	            <?php } ?>
	            data-elm-data='{
	                "<?=$strFeature?>":"1", "userManageAction":"1",
	                "linkMore":"<?=$seo_name["page"]["user"]?>?manage=<?=$strFeature?>&"
	            	}'
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
	            data-template-id="entryCvItemActionApplied">
	            <!-- data-template-id="<?=$strFeature == 'userapply' ? 'entryCvItemActionApplied' : 'entryCvItemAction'?>" -->

				<div class="row">
				    <div class="col-sm-12">
				    <div class="filter-hori"
				      data-copy-template
				      data-view-template=".filter-hori"
				      data-template-id="entryCmpFilterHorizontal">&nbsp;</div>
				    </div>
				</div>

				<div class="total-result t-s-12"><?=$language["weFound"]?> <label class="text-bold text-color3" data-total-item></label> <?=$language["applicationsforyou"]?></div>


	            <div class="view-items" data-content><div class="style-loadding">...</div>

	            </div>
	            <div class="no-data">
	                <div class="no-data-content"><?=$language['noDataFound']?></div>
	            </div>
	            <div data-footer></div>
	        </div>

	        <?php endif;?>

	    </div>
	</div>
</div>