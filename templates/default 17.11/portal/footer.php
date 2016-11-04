<?php
$strFooter = isset($informationConfig["config"]["footer"][$langcode]) ? $informationConfig["config"]["footer"][$langcode]:null;
?>


<div class="alert-footer alert" data-fade="4500">
	<div class="sms-content"></div>
</div>

<div class="alert-footer alert-error" data-fade="4500">
	<div class="sms-content"></div>
</div> 

<div id="footer" class="bg-color1">
    <?=count($strFooter) ? $strFooter:null;?>
</div>

<div class="backtotop" data-goto-top></div>

