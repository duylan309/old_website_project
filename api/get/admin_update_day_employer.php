<?php 
try{
	$permission = 0;
	$permission = isset($_SESSION["adminlog"]) && $_SESSION["adminlog"] ? 100 : 0;


	if($permission == 100){

		$action = isset($_GET["action"]) ? $_GET["action"] : null;

		if($action){
			# Get list blog
			$strWhere = null;
			$strLimit = null;
			$strGroupBy = null;
			$strJoin = null;
			$strOrder = " ORDER BY info.id DESC ";
			$get = isset($_REQUEST) ? $_REQUEST : null;

			$strSelect = "  info.*,
							CONCAT(user.id,' ',user.name,' ',user.email,' ',user.phone) AS ti,
							user.name AS user_name,
							(SELECT c.name FROM ".TABLE_COMPANY." AS c WHERE info.employer_id=c.ui LIMIT 1) AS company_name ";

			if (isset($get["limit"]) && $get["limit"]) {
			    $strLimit .= " LIMIT 0,{$get["limit"]}";
			}

			$strWhere .= "  AND info.employer_id = user.id";

			# SHOW STATUS
			$strQuery  = "  SELECT $strSelect
			                FROM ".TABLE_ADMIN_UPDATE_EMPLOYER_DAY." AS info,
		                	 	 ".TABLE_USER." AS user
			                {$strJoin} 
			                WHERE 1 = 1  
			                {$strWhere} 
			                {$strLimit} 
			                {$strOrder}";

			$dataResponse = $db->objJson($strQuery);
			$code = 200;
		}
		

	}else{
		die();
	}

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}

?>	