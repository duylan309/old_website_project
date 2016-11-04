<?php 

$fileCity =  dirname(__FILE__) . '/country/';

$cityArray = array();

if(isset($_GET["country"]) && $_GET["country"] ){
    $fileCity .= strtolower($_GET["country"]).".php";
    if(is_file($fileCity)) {
        require $fileCity;
    }else{
    	$cityArray = array(array("id"=>"100","ti" => "Other"));
    }
}

$dataResponse = $cityArray;
