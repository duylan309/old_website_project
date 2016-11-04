<?php 

$isPermission = 0;

if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
    $isPermission = 100;
}


if($isPermission == 100){
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.$language["employerlink"].htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';

	$strQueryCompany = "SELECT * FROM ".TABLE_COMPANY." ORDER BY id";
	$resultCompany = $db->db_arrayList($strQueryCompany);


	if($resultCompany):
	foreach($resultCompany as $Company):
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.strtolower($Company["url"]).htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.strtolower($Company["url"]).'/about'.htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.strtolower($Company["url"]).'/photo'.htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.strtolower($Company["url"]).'/jobs'.htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	endforeach;
	endif;


	$strQueryUrl = "SELECT * FROM ".TABLE_PAGEHTML." ORDER BY id";
	$resultUrl = $db->db_arrayList($strQueryUrl);


	if($resultUrl):
	foreach($resultUrl as $Url):
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.strtolower($Url["url"]).htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	endforeach;
	endif;


	$strQueryJob = "SELECT * FROM ".TABLE_JOB." WHERE st=2 ORDER BY id";
	$resultJob = $db->db_arrayList($strQueryJob);

	

	if($resultJob):
	foreach($resultJob as $job):
	echo htmlspecialchars('<url>').'<br>'.htmlspecialchars('<loc>').SITEURL.$seo_name["page"]["job"].'/'.urlFriendly($job["ti"]).'.'.$job['id'].htmlspecialchars('</loc>').'<br>'.htmlspecialchars('</url>').'<br>';
	endforeach;
	endif;	

	die();
}


if($isPermission == 0){
	$code = 400;
	$dataResponse = array("urlRedirect" =>  SITEURL.$seo_name["page"]["error"]);
	header("Location: ".SITEURL.$seo_name["page"]["error"]);
}



// SITEURL,$seo_name["page"]["job"];
?>