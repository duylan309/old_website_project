<?php 
$strQueryJob = "SELECT jobs.* FROM jobs AS jobs, user AS user WHERE jobs.ui = user.id AND user.type = 1 ";
$arrayJobs = $db->db_arrayList($strQueryJob);

foreach($arrayJobs as $job){
	$file   = FOLDERJOB.$job['id'].".xml";
	if(is_file($file)) {
	    $fileInfo = simplexml_load_file($file);
	    $information = json_encode($fileInfo);
	    $information = json_decode($information, true);
	    $information["db"]["de"] = $job["de"];
		saveXMLFile($file, $information);
	}
}

?>