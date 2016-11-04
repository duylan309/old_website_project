<?php
function main(){
	global $language,$seo_name,$db;
	$step = isset($_GET['step']) ? $_GET['step'] : 1;
	$strEleDataStep1 = null;
	$serviceCat = isset($_GET['cat']) ? $_GET['cat'] : null;
	$track_edm_email = isset($_GET['trackingedm']) ? $_GET['trackingedm'] : null;

	if($track_edm_email){
		$current_click = time();
		$strUpdateTrackingEdm = "UPDATE email_edm 
								 SET action_click=action_click+1 , action_click_date = $current_click 
								 WHERE id = $track_edm_email";
        if($db->db_query($strUpdateTrackingEdm)){
        	// echo '<span data-goto-link data-url="/'.$language["employerlink"].'"></span>';
        	?>
			<script type="text/javascript">
			location.href = "<?=SITEURL.$language["employerlink"]?>";
			</script>			
			<?php 
        }
	}
	
	if($serviceCat) {
		$serviceData  = arrSearch ( $language["service"], "category==$serviceCat" );
		$_SESSION["signupWithPromocode"] = $serviceData ? $serviceData[0] : null;
	}

	if(!isset($_SESSION["signupWithPromocode"])) {
		$_SESSION["signupWithPromocode"] = $language["service"][0];
	}

	if($serviceCat) {
		$serviceData  = arrSearch ( $language["service"], "category==$serviceCat" );
		$_SESSION["optionService"] = $serviceData ? $serviceData[0] : null;
	}

	if(!isset($_SESSION["optionService"])) {
		$_SESSION["optionService"] = $language["service"][0];
	}

	$strButtonStep = '<tr class="border" style="border-bottom:1px solid #ddd">
						<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><i class="fa fa-check-circle-o text-color1 t-s-33"></i></td>
						<td  class="vertical-m text-cap" width="">'.$language['yourPackage'].'<br><label>'.$_SESSION["signupWithPromocode"]['title'].'</label></td>
						<td  class="vertical-m" align="right" width="200"><a class="text-color3 text-bold t-s-12" href="/'.$language["employerlink"].'">'.$language["changeYourPackage"].'</a></td>
					  </tr>
				      <tr class="border">
						<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><div class="number-circle text-bold t-s-16 c-center">2</div></td>
						<td  class="vertical-m t-s-17 text-cap" width=""><label>'.$language['setUpYourAccount'].'</label></td>
						<td  class="vertical-m" align="right" width="200"></td>
					  </tr>
					  ';

	$strStep = '
       		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl='.$_SESSION["lang"].'" async defer></script>
			
			<div class="bg-color4 p-10 m-b-10 ">
			<div class="entry-form-signup-payment"
	        data-copy-template
	        data-elm-data=\'{"payment":"1","type":"1"}\'
	        data-view-template=".entry-form-signup-payment"
	        data-template-id="entryFormSignup">&nbsp;</div></div> 
        	
        	<script type="text/javascript">
			var verifyCallback = function(response) {
			  $(".boxcaptcha").attr("checked","checked");
			};
			
			var onloadCallback = function() {
			  grecaptcha.render("captcha", {
			    "sitekey" : "'.SITEKEYCAPTCHA.'",
			    "callback" : verifyCallback,
			  });
			};
			</script>
	        ';



	if(isset($_SESSION["userlog"]["type"]) && $_SESSION["userlog"]["type"] == 1 ) {
		$strStep = null;

		$strButtonStep = '<tr class="border"  style="border-bottom:1px solid #ddd">
						<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><i class="fa fa-check-circle-o text-color1 t-s-33"></i></td>
						<td  class="vertical-m text-cap" width="">'.$language['yourPackage'].'<br><label>'.$_SESSION["optionService"]['title'].'</label></td>
						<td  class="vertical-m" align="right" width="200"><a class="text-color3 text-bold t-s-12" href="/'.$language["employerlink"].'">'.$language["changeYourPackage"].'</a></td>
					  </tr>
				       <tr class="border" style="">
						<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><i class="fa fa-check-circle-o text-color1 t-s-33"></i></td>
						<td  class="vertical-m text-cap" width="">'.$language['yourAccount'].'<br><label>'.$_SESSION["userlog"]["email"].'</label></td>
						<td  class="vertical-m" align="right" width="200"><a class="text-color3 text-bold t-s-12" href="/pm?step=1">'.$language["changeYourAccountDetail"].'</a></td>
					  </tr>
					  ';

		if($step == 1) {
			$strEleDataStep1 = "data-elm-data='{\"step1\":1}'";
			
			$strStep = '<div class="bg-color4 p-10 m-b-10 entry-form-signup-payment"
	            data-copy-template
	            data-elm-data=\'{"payment":"1","type":"1"}\'
	            data-view-template=".entry-form-signup-payment"
	            data-template-id="entryViewUserInfo">&nbsp;</div>';

	    } elseif($step==2) {



	    	$strButtonStep = '<tr class="border" style="border-bottom:1px solid #ddd">
								<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><i class="fa fa-check-circle-o text-color1 t-s-33"></i></td>
								<td  class="vertical-m text-cap" width="">'.$language['yourPackage'].'<br><label>'.$_SESSION["optionService"]['title'].'</label></td>
								<td  class="vertical-m" align="right" width="200"><a class="text-color3 text-bold t-s-12" href="/'.$seo_name["page"]["employer"].'">'.$language["changeYourPackage"].'</a></td>
						      </tr>
						      <tr class="border" style="border-bottom:1px solid #ddd">
								<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><i class="fa fa-check-circle-o text-color1 t-s-33"></i></td>
								<td  class="vertical-m text-cap" width="">'.$language['yourAccount'].'<br><label>'.$_SESSION["userlog"]["email"].'</label></td>
								<td  class="vertical-m" align="right" width="200"><a class="text-color3 text-bold t-s-12" href="/pm?step=1">'.$language["changeYourAccountDetail"].'</a></td>
							  </tr>
							   <tr class="border" style="">
								<td  class="vertical-m text-center" style="padding-left:20px"  width="30"><div class="number-circle text-bold t-s-16 c-center">3</div></td>
								<td  class="vertical-m t-s-17 text-cap" width=""><label>'.$language['chooseYourPayment'].'</label></td>
								<td  class="vertical-m" align="right" width="200"></td>
							  </tr>
					  ';

			$strStep = '<div class="bg-color4 m-b-10 entry-form-signup-payment"
	            data-copy-template
	            data-elm-data=\'{"payment":"1","type":"1"}\'
	            data-view-template=".entry-form-signup-payment"
	            data-template-id="entryPaymentMethodOption">&nbsp;</div>';

	    } elseif( $step==3 ) {

	    	

	    	
	    	echo '<div class="p-10 m-b-10 bg-color4"><div class="entry-payment-success"
	            data-copy-template
	            data-view-template=".entry-payment-success"
	            data-template-id="PayStepThree">&nbsp;</div>
	            <div class="clearfix"></div></div>';

	    }
	}

	if($strStep) {

		echo '<div class="payment-step">';
		echo '<div class="h-tt text-bold text-color1 row p-30 t-s-26 hidden">'.$language["taglineEmployer"].'</div>
	';
		echo '<div class="paymentstep-header table-responsive">
				<table class="table m-t-15">';
		
		echo $strButtonStep;
		
		echo '  </table>
			  </div>';

		echo '<div class="c-j-p row"><div class="col-sm-6">'.$strStep.'</div>
			<div class="col-sm-6">
				<div class="paytable"
					data-update-cart '.$strEleDataStep1.'
		            data-copy-template
		            data-view-template=".paytable"
		            data-template-id="entryPaymentTableCount">&nbsp;</div>
			</div>
		</div>';

		echo '</div>';
	}
}
?>


