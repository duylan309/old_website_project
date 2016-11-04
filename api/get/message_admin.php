<?php 
try{
	$isPermission = 0;
	if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
	    $isPermission = 100;
	}

	if($isPermission == 100){
			# Get list blog
			$strWhere = null;
			$strLimit = null;
			$strGroupBy = null;
			$strOrder = " ORDER BY messages.id DESC ";
			$get = isset($_REQUEST) ? $_REQUEST : null;

			$strSelect = "  messages.*,
							CONCAT(company.name,' ',user.name,' ',user.email,' ',user.phone) AS receiver,
							CONCAT(company.name,' ',user.name,' ',user.email,' ',user.phone) AS sender,
							company.name AS company_name,
							company.url AS company_url,
							company.im AS company_image,
							user.name AS user_name,
							user.im AS user_image";

			if (isset($get["limit"]) && $get["limit"]) {
			    $strLimit .= " LIMIT 0,{$get["limit"]}";
			}

			$strWhere .= "  AND messages.user_id = user.id
							AND messages.company_id = company.id ";

			# SHOW STATUS
			$strQuery  = "  SELECT $strSelect
			                FROM ".TABLE_MESSAGES." AS messages,
		                	 	 ".TABLE_USER." AS user,
		                	 	 ".TABLE_COMPANY." AS company
			                WHERE 1 = 1 {$strWhere} {$strLimit} {$strOrder}";

			# echo $strQuery;
			$dataResponse = $db->objJson($strQuery);
			$code = 200;
	}else{
		die();
	}

	
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}

?>