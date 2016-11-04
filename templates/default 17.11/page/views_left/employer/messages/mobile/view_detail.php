<div class="col-sm-9">
	<div class="message-detail">
		<div class="row">
			<div class="col-sm-3 col-xs-8">
				<a class="text-color2" href="/<?=$seo_name["page"]["user"]?>?manage=messages">
					<i class="fa fa-caret-left text-color2"></i> <span><?=$language["back"]?></span>
				</a>
			</div>
			<div class="col-sm-3 col-xs-4 text-right">
				<button class="btn bg-color7"
				        type="submit"
				        data-button-magic
						data-method="post"
						data-format-json="true"
				        data-ajax-url="<?=APIPOSTMESSAGES?>"
						data-params='{  "db":{  "employer_id" : "<?=$sessionUserId?>",
				                                "mid"         : { "<?=$message_detail["id"]?>" : "<?=$message_detail["id"].".".$message_detail["employer_id"].".".$message_detail["user_id"].".".$message_detail["company_id"]?>"},
				                                "post_id"     : "<?=$sessionUserId?>" },
				                        "action" : "delete"
				                    }'
				        data-show-success=".alert-footer.alert"
				        data-show-errors=".alert-footer.alert-error"
				        data-redirect="/<?=$seo_name["page"]["user"]."?manage=messages"?>"
				        value="{{d.l10n.btnSave}}">
				    <i class="fa fa-trash"></i> <span><?=$language["btnDelete"]?></span>
				</button>
			</div>
		</div>
		<div class="content b-r-4 b-b">
			
			<?php if(isset($old_message_array) && count($old_message_array)){?>

			

			<?php $i = 1; foreach($old_message_array as $old_message){?>
			<?php if(count($old_message_array) > 2  && $i == 3){?>
			<div class="load-old-messages b-r-4 m-t-10">
				<div class="text-color2"><?=$language["loadoldmessage"]?></div>
			</div>
			<?php }?>
			<?php if($old_message["receiver_id"] != $sessionUserId){?>
			<div data-old-message class="cmp-more">
				<div data-header class="row">
					<div data-thumbnail-image class="col-sm-1 col-xs-2">
						<?php if($old_message["company_image"] != null && $old_message["company_image"] != ""):?>
						<img alt="<?=$old_message["company_name"]?>"
						class="img-responsive b-r-4"
						src="/<?=FOLDERIMAGECOMPANY?>thumbnail/<?=$old_message["company_image"]?>">
						<?php else:?>
						<img alt="<?=$old_message["company_name"]?>"
						class="img-responsive b-r-4"
						src="/media/images/style/user.png">
						<?php endif;?>
					</div>
					<div class="col-sm-9 col-xs-7">
						<h4 class="no-margin text-color1 text-bold t-s-16">
						<?=$old_message["subject"]?>
						</h4>
						<p class="short-text"><span class="text-color4"><?=$language["from"]?>:</span> <?=$old_message["company_name"]?></p>
					</div> 
					<div class="col-xs-3 text-right">
						<span class="t-s-11"><?=strDate($old_message["created_date"])?></span>
						<div data-message-item>
							<div class="btn-favorite show-unfavorite-<?=$old_message["id"]?> <?=$old_message["important"] == 1 ? "active" : ""?>">
							    <span class="unfavorite text-color2"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-success-toggle-class=".show-unfavorite-<?=$old_message["id"]?>,active"
							            data-params='{  "db":{  "employer_id" : "<?=$old_message["employer_id"]?>",
							                                    "company_id"  : "<?=$old_message["company_id"]?>",  
							                                    "user_id"     : "<?=$old_message["user_id"]?>",
							                                    "sender_id"   : "<?=$old_message["sender_id"]?>",
							                                    "receiver_id" : "<?=$old_message["receiver_id"]?>",
							                                    "message_id"  : "<?=$old_message["id"]?>" },
							                            "action" : "unimportant" 
							                        }'
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-redirects="."><i class="fa fa-star"></i></span>
							    <span class="favorite"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-params='{  "db":{  "employer_id" : "<?=$old_message["employer_id"]?>",
							                                    "company_id"  : "<?=$old_message["company_id"]?>",  
							                                    "user_id"     : "<?=$old_message["user_id"]?>",
							                                    "sender_id"   : "<?=$old_message["sender_id"]?>",
							                                    "receiver_id" : "<?=$old_message["receiver_id"]?>",
							                                    "message_id"  : "<?=$old_message["id"]?>" },
							                            "action" : "important" 
							                        }'
							            data-success-toggle-class=".show-unfavorite-<?=$old_message["id"]?>,active"
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-show-hide=""
							            data-redirects="."><i class="fa fa-star-o"></i></span>
							</div>
						</div>

					</div>
				</div>
				<div data-content class="row">
					<div class="col-sm-offset-1 col-sm-11 col-xs-12">
						<div class="textarea-content-line"><?=$old_message['message']?></div>
					</div>
				</div>
			</div>
			<?php }else{?>
			<div data-old-message class="cmp-more">
				<div data-header class="row">
					<div data-thumbnail-image class="col-sm-1 col-xs-2">
						<?php if($old_message["user_name"] != null && $old_message["user_name"] != ""):?>
						<img alt="<?=$old_message["user_name"]?>"
						class="img-responsive b-r-4"
						src="/<?=FOLDERIMAGEUSER?>thumbnail/<?=$old_message["user_image"]?>">
						<?php else:?>
						<img alt="<?=$old_message["user_name"]?>"
						class="img-responsive b-r-4"
						src="/media/images/style/user.png">
						<?php endif;?>
					</div>
					<div class="col-sm-9 col-xs-7">
						<h4 class="no-margin text-color1 text-bold t-s-16">
						<?=$old_message["subject"]?>
						</h4>
						<p class="short-text"><span class="text-color4"><?=$language["from"]?>:</span> <?=$old_message["user_name"]?></p>
					</div>
					<div class="col-xs-3 text-right">
						<span class="t-s-11"><?=strDate($old_message["created_date"])?></span>
						
						<div data-message-item>
							<div class="btn-favorite show-unfavorite-<?=$old_message["id"]?> <?=$old_message["important"] == 1 ? "active" : ""?>">
							    <span class="unfavorite text-color2"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-success-toggle-class=".show-unfavorite-<?=$old_message["id"]?>,active"
							            data-params='{  "db":{  "employer_id" : "<?=$old_message["employer_id"]?>",
							                                    "company_id"  : "<?=$old_message["company_id"]?>",  
							                                    "user_id"     : "<?=$old_message["user_id"]?>",
							                                    "sender_id"   : "<?=$old_message["sender_id"]?>",
							                                    "receiver_id" : "<?=$old_message["receiver_id"]?>",
							                                    "message_id"  : "<?=$old_message["id"]?>" },
							                            "action" : "unimportant" 
							                        }'
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-redirects="."><i class="fa fa-star"></i></span>
							    <span class="favorite"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-params='{  "db":{  "employer_id" : "<?=$old_message["employer_id"]?>",
							                                    "company_id"  : "<?=$old_message["company_id"]?>",  
							                                    "user_id"     : "<?=$old_message["user_id"]?>",
							                                    "sender_id"   : "<?=$old_message["sender_id"]?>",
							                                    "receiver_id" : "<?=$old_message["receiver_id"]?>",
							                                    "message_id"  : "<?=$old_message["id"]?>" },
							                            "action" : "important" 
							                        }'
							            data-success-toggle-class=".show-unfavorite-<?=$old_message["id"]?>,active"
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-show-hide=""
							            data-redirects="."><i class="fa fa-star-o"></i></span>
							</div>
						</div>

					</div>
				</div>
				<div data-content class="row">
					<div class="col-sm-offset-1 col-sm-11 col-xs-12">
						<div class="textarea-content-line"><?=$old_message['message']?></div>
					</div>
				</div>
			</div>
			<?php } $i++;}}else{?>
			<div data-old-message class="cmp-more">
				<div data-header class="row">
					<div data-thumbnail-image class="col-sm-1 col-xs-2">
						<?php if($message_detail["user_image"] != null && $message_detail["user_image"] != ""):?>
						<img alt="<?=$message_detail["user_name"]?>"
						class="img-responsive b-r-4"
						src="/<?=FOLDERIMAGEUSER?>thumbnail/<?=$message_detail["user_image"]?>">
						<?php else:?>
						<img alt="<?=$message_detail["user_name"]?>"
						class="img-responsive b-r-4"
						src="/media/images/style/user.png">
						<?php endif;?>
					</div>
					<div class="col-sm-9 col-xs-7">
						<h4 class="no-margin text-color1 text-bold t-s-16">
						<?=$message_detail["subject"]?>
						</h4>
						<p class="short-text"><span class="text-color4"><?=$language["from"]?>:</span> <?=$message_detail["user_name"]?></p>
					</div>
					<div class="col-xs-3 text-right">
						<span class="t-s-11"><?=strDate($message_detail["created_date"])?></span>
						<div data-message-item>
							<div class="btn-favorite show-unfavorite-<?=$message_detail["id"]?> <?=$message_detail["important"] == 1 ? "active" : ""?>">
							    <span class="unfavorite text-color2"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-success-toggle-class=".show-unfavorite-<?=$message_detail["id"]?>,active"
							            data-params='{  "db":{  "employer_id" : "<?=$message_detail["employer_id"]?>",
							                                    "company_id"  : "<?=$message_detail["company_id"]?>",  
							                                    "user_id"     : "<?=$message_detail["user_id"]?>",
							                                    "sender_id"   : "<?=$message_detail["sender_id"]?>",
							                                    "receiver_id" : "<?=$message_detail["receiver_id"]?>",
							                                    "message_id"  : "<?=$message_detail["id"]?>" },
							                            "action" : "unimportant" 
							                        }'
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-redirects="."><i class="fa fa-star"></i></span>
							    <span class="favorite"
							            data-button-magic
							            data-method="post"
							            data-format-json="true"
							            data-ajax-url="<?=APIPOSTMESSAGES?>"
							            data-params='{  "db":{  "employer_id" : "<?=$message_detail["employer_id"]?>",
							                                    "company_id"  : "<?=$message_detail["company_id"]?>",  
							                                    "user_id"     : "<?=$message_detail["user_id"]?>",
							                                    "sender_id"   : "<?=$message_detail["sender_id"]?>",
							                                    "receiver_id" : "<?=$message_detail["receiver_id"]?>",
							                                    "message_id"  : "<?=$message_detail["id"]?>" },
							                            "action" : "important" 
							                        }'
							            data-success-toggle-class=".show-unfavorite-<?=$message_detail["id"]?>,active"
							            data-show-success=".alert-footer.alert"
							            data-show-errors=".alert-footer.alert-error"
							            data-show-errors-template="entrySigninPopup"
							            data-view-template="[data-quick-view-item1]"
							            data-show-hide=""
							            data-redirects="."><i class="fa fa-star-o"></i></span>
							</div>
						</div>
					</div>
				</div>
				<div data-content class="row b-b">
					<div class="col-sm-offset-1 col-sm-11 col-xs-12">
						<div class="textarea-content-line"><?=$message_detail['message']?></div>
					</div>
				</div>
			</div>
			<?php }?>
			<div data-reply>
				<div data-header class="row">
					<div data-thumbnail-image class="col-sm-1 col-xs-2">
						<?php if($message_detail["company_image"] != null && $message_detail["company_image"] != ""):?>
						<img alt="<?=$message_detail["company_name"]?>"
						class="img-responsive b-r-4"
						src="/<?=FOLDERIMAGECOMPANY?>thumbnail/<?=$message_detail["company_image"]?>">
						<?php else:?>
						<img alt="<?=$message_detail["company_name"]?>"
						class="img-responsive b-r-4"
						src="/media/images/style/user-profile.png">
						<?php endif;?>
					</div>
					
					<div class="col-sm-9 col-xs-9">
						<h4 class="no-margin text-color1 text-bold t-s-16 short-text">
							<?=$message_detail["company_name"]?>
						</h4>
					</div>
				</div>
				
				<div class="row" data-content>
					<div class="col-sm-11 col-xs-12">
						<form data-submit-message method="post" class="form-horizontal post-form">
							
							<div class="hidden">
								<input data-user-id name="db.user_id" type="text" value="<?=isset($message_detail["user_id"]) ? intval($message_detail["user_id"]) : "" ?>">
								<input name="db.company_id" type="text" value="<?=$message_detail["company_id"]?>">
								<input name="db.sender_id" type="text" value="<?=isset($_SESSION["userlog"]["id"]) ? intval($_SESSION["userlog"]["id"]) : "" ?>">
								<input name="db.employer_id" type="text" value="<?=isset($_SESSION["userlog"]["id"]) ? intval($_SESSION["userlog"]["id"]) : "" ?>">
								<input name="db.receiver_id" type="text" value="<?=$message_detail["user_id"]?>">
								<input name="updateNode" type="text" value="db">
								<input name="db.message_id" type="text" value="<?=$message_detail["message_id"] != 0 ? $message_detail["message_id"] : $message_detail["id"]?>">
								<input name="db.subject" type="text" value="<?=$message_detail["subject"]?>">
								<input name="action" type="text" value="send">
							</div>
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<div class="form-group">
										<textarea   name="db.message"
										data-required="<?=$language['require']?>"
										data-validate
										data-message
										placeholder="<?=$language['typeamessage']?>"
										data-required="<?=$language["require"]?>"
										class="form-control more"></textarea>
										<span class="error"><?=$language["require"]?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-xs-8">
									<button class="bg-color1 btn m-r-10"
									type="submit"
									data-submit
									class="btn bg-color1 text-uppercase"
									data-button-magic
									data-params-form=".post-form"
									data-format-json="true"
									data-ajax-url="<?=APIPOSTMESSAGES?>"
									data-show-success=".message-report"
									data-show-errors=".message-report"
									value="{{d.l10n.btnSave}}">
									<i class="fa fa-send"></i> <span><?=$language['send']?></span>
									</button>
									<!-- <button class="bg-color2 btn">
									<i class="fa fa-save"></i> <span><?=$language['btnSave']?></span>
									</button> -->
								</div>
								<div class="col-sm-6 text-right col-xs-4">
									<button data-reset type="reset" value="Reset" class="bg-color5 btn">
									<i class="fa fa-refresh"></i> <span><?=$language["btnClear"]?></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="message-report alert" data-fade="4500">
		    <div class="sms-content"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('[data-submit]').click(function() {
		var $error = $('[data-submit-message]').find('.form-group.invalid').length;
	    if($error == 0){
	        $(".message-report.alert").addClass('loading').find('.sms-content').html('<span class="style-loadding"></span> <span><?=$language["sending"]?></span>');
	        $( document ).ajaxStop(function() {
	            $(".message-report.alert").removeClass('loading');
	        })
	    }
		$('[data-message]').val("");
	});
});
</script>