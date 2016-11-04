<?php 
$user_id    = isset($_GET['uid']) ? intval($_GET["uid"]) : null;
$company_id = isset($_SESSION['userlog']['id']) ? intval($_SESSION['userlog']['id']) : null;

if($user_id && $company_id){
	

	$fileUser = FOLDERUSER."{$user_id}.xml";
    if(is_file($fileUser)) {
        $userinfo = simplexml_load_file($fileUser);
        $userinfo = json_encode($userinfo);
        $userinfo = json_decode($userinfo, true);
        $userinfo = $userinfo["userinfo"];
    }

}

?>