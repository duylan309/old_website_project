<?php 
try{
	$session_permission = isset($_SESSION["userlog"]) ? $_SESSION["userlog"] : null;
	$isPermission = 0;
	$idCommentId  = isset($_GET["comment_id"]) ? intval($_GET["comment_id"]) : 0;

	if(isset($session_permission) && isset($session_permission["id"])){
		
		$current_view_user_id = isset($_GET["uid"]) ? intval($_GET["uid"]) : null;

		if($session_permission["type"] == 1 && $current_view_user_id){ # employer view

			# check applied
			$strQueryCheckCo = "SELECT *
								FROM ".TABLE_JOB_APPLIED." 
								WHERE ei={$session_permission["id"]} 
								AND   ui={$current_view_user_id}
								ORDER BY id DESC";

			$rowTotal = $db->db_array($strQueryCheckCo);

			if($rowTotal){
				$isPermission = 100;
			}

		}else if($session_permission["type"] == 2 && $current_view_user_id){ # user view
			$isPermission = $session_permission["id"] == $current_view_user_id ? 100 : 0;
		}else{
			die();
		}

		if($isPermission == 100){
		
			$action = isset($_GET["action"]) ? $_GET["action"] : null;

			if($action == 'view'){

				# Get list comment
				$strWhere = null;
				$strLimit = null;
				$strGroupBy = null;
				$strOrder = " ORDER BY comment.id DESC ";
				$get = isset($_REQUEST) ? $_REQUEST : null;

				$strSelect = "  comment.*,
								CONCAT(company.name,' ',user.name,' ',user.email,' ',user.phone) AS ti,
								company.name AS company_name,
								company.url AS company_url,
								company.im AS company_image,
								user.name AS user_name,
								user.im AS user_image";

				if (isset($get["limit"]) && $get["limit"]) {
				    $strLimit .= " LIMIT 0,{$get["limit"]}";
				}

				$strWhere .= "  AND comment.uid = user.id
								AND comment.pid = company.id 
								AND comment.status = 1";

				if($session_permission["type"] == 1){
					$strWhere .= " AND comment.uid = {$current_view_user_id} ";
					$strWhere .= " AND comment.eid = {$session_permission["id"]} ";
				}else if($session_permission["type"] == 2){
					$strWhere .= " AND comment.uid = {$current_view_user_id} ";
					$strWhere .= " AND comment.uid = {$session_permission["id"]} ";
				}

				if($idCommentId != 0){
					$strWhere .= " AND comment.id = {$idCommentId} ";
				}
				
				# SHOW STATUS
				$strQuery  = "  SELECT $strSelect
				                FROM ".TABLE_COMMENT." AS comment,
			                	 	 ".TABLE_USER." AS user,
			                	 	 ".TABLE_COMPANY." AS company
				                WHERE 1 = 1 {$strWhere} {$strLimit} {$strOrder}";

				$code = 200;
                # echo $strQuery;
				if($idCommentId != 0){
                	$dataResponse = $db->db_array($strQuery);
				}else{
					$dataResponse = $db->objJson($strQuery);
				}

			}else{
				$code = 501;
   				$errors = $language["unknownErrors"];
			}

		}else{
			$code = 501;
   			$errors = $language["unknownErrors"];
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