<?php 

$fileDistrict =  dirname(__FILE__) . '/country/vn/';

$arrayDistrict = array();

if(isset($_GET["district"]) && $_GET["district"] ){
    $fileDistrict .= strtolower($_GET["district"])."_".$langcode .".php";
    if(is_file($fileDistrict)) {
        require $fileDistrict;
    }else{
    	$arrayDistrict = array(array("id"=>"100","ti" => "Other"));
    }
}

$dataResponse = $arrayDistrict;
