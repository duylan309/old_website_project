<?php
function main() {
    global $informationConfig,$db, $language, $seo_name, $url_data, $getUrl, $langcode;

	$getcode = isset($_GET['promocode']) ? mysql_real_escape_string($_GET['promocode']) : null;

	if($getcode){
?>
	<center class="fb-progress">
		<div class="progress">
		  <div class="progress-bar progress-bar-info bg-color1" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
		    <span class="sr-only"></span>
		  </div>
		</div>
	</center>

	<script type="text/javascript">
	$(document).ready(function() {
		$('.progress-bar').animate({width: "70%"});

		$(window).load(function() {
			$('.progress-bar').animate({width: "100%"},function() {
		    var xhttp = new XMLHttpRequest();
			
			xhttp.onreadystatechange = function() {

			    if (xhttp.readyState == 4 && xhttp.status == 200) {
				var response = JSON.parse(xhttp.responseText);

					if(response.code == 200){
						location.href = response.data.urlRedirect;
					}else{
						location.href = '<?=SITEURL.$seo_name["page"]["error"]?>';
					}

			    }
			}    

		   	xhttp.open("POST", "<?=APIPOSTPROMOAPPLIED?>", true);
		   	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   	xhttp.send("pr=<?=$getcode?>&token=99");
		
		});

			    

		});
	});

	</script>
<?php		
	}else{
   		echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
	}

}

