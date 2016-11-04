<?php
$isSuccessPost = true;
$code = 200;
$urlInfo = "http://{$_SERVER['HTTP_HOST']}/{$seo_name["page"]["checkout"]}/transfertobank/{$getRowJustInsert["id"]}";
$message = '<img src="/img/style/ajax-loader.gif" class="img-payment"/>';
$dataResponse = array("urlRedirect" => $urlInfo);
?>
