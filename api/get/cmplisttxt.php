<?php
try {
  
  $action = isset($_GET["action"]) ? $_GET["action"] : null;
  
  if($action == "get"){
  	#init category into localoption
  	$strQueryClientName = "SELECT name FROM ".TABLE_COMPANY." ORDER BY name ASC";
  	$arrayList = $db->db_arrayList($strQueryClientName);
  	
  	$str = null;
  	foreach ($arrayList as $key => $value) {
  			$str .= $key == 0 ? $value["name"] : ','.$value["name"];
  	}

  	if(isset($str) && count($str)){
  		 $file = FOLDERCOMPANY . "cmplist.xml";
  		 $information = array(
  		     "db" => $str
  		 );

  		 saveXMLFile($file, $information);
  		
  	}

  	$dataResponse = "thue.today";
  	$code = 200;
  	$message = "done";
  }elseif($action == "load"){
  	$file = FOLDERCOMPANY . "cmplist.xml";
  	
  	if(is_file($file)) {
  	    $fileInfo = simplexml_load_file($file);
  	    $information = json_encode($fileInfo);
  	    $information = json_decode($information, true);

  	    $dataResponse = $information;
  	    $code = 200;
  	}
  	else {
  	    $dataResponse = $language["unknownErrors"];
  	    $code = 201;
  	}
  	 
  }else{
  	$code = 501;
    $errors = $language["unknownErrors"];
  }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>