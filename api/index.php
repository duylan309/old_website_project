<?php

if( !empty($_SERVER['HTTP_ORIGIN']) ){
// Enable CORS
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Cache-Control, Content-Range, Content-Disposition, Content-Type, X-FILE-NAME, X-FILE-SIZE, X-FILE-TYPE');
    header('Access-Control-Allow-Credentials: true');
}

$data = $code = $message = $errors = $file = $information = null;
if (isset($url_data[1])) {
	if ($url_data[1] == 'post') {
		require_once 'api/post.php';
	} elseif ($url_data[1] == 'get') {
		require_once 'api/get.php';
	}
} else {
	die();
}
?>
