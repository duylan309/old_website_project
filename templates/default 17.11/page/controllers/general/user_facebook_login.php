<?php
function main() {
    global $informationConfig,$db, $language, $seo_name, $url_data, $getUrl, $langcode;

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
			$('.progress-bar').animate({width: "100%"});
		});
	});

	</script>

<?php
}

