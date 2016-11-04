<?php
$language = $_POST["lang"];


if (isset($language)) {

	$_SESSION["lang"] = $language;
	
	$code = 200;
} else {
	$code = 400;
	$errors = $language["error"];
}

?>
