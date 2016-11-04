<?php
$get = $_GET;
$currentTime = time();
$dataResponse = null;
$str_params = null;

if (isset($url_data[2])) {
	$apiGetFile = "api/get/" . $url_data[2] . ".php";
	if (is_file($apiGetFile)) {
		require $apiGetFile;
	} else {
		$code = 500;
		$errors = "Internal Server Error";
	}
	if (isset($_GET['var']) && ($url_data[2] == "jobs" || "window.userAccess")) {
		$str_params = $_GET['var'] . "=";
	}
}

if(isset($_GET["eventStream"])) {
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	// default is 3s
	$timeResponse = isset($_GET["waiting"])?$_GET["waiting"]:3000;
	$timeResponse = intval($timeResponse)<3000 ? 3000: intval($timeResponse);

	echo "retry: ".$timeResponse."\n"; // set time to reponse d
	echo "data: ".json_encode($dataResponse, true)."\n\n";
	flush();
}
else {

	if ($str_params) {
		echo $str_params . json_encode($dataResponse, true);
	} else {
		response($dataResponse, $code, $message, $errors);
	}
}

?>
