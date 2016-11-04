<?php
$location = array();
foreach ($language["locationOption"] as $key => $value) {
    array_push($location, array("id"=>$key, "ti"=>$value));
}
$dataResponse = $location;
?>
