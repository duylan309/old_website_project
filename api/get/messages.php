<?php 
try{
	$session_permission = isset($_SESSION["userlog"]) ? $_SESSION["userlog"] : null;
	if(isset($session_permission) && isset($session_permission["id"])){
		$user_id = isset($_GET["uid"]) ? intval($_GET["uid"]) : null;
		if($user_id == intval($session_permission["id"])){
			$action = isset($_GET["action"]) ? $_GET["action"] : null;

			if($action == 'inbox' || $action == 'sent' || $action == 'important' || $action == 'trash'){

				# Get list blog
				$strWhere = null;
				$strLimit = null;
				$strGroupBy = null;
				$strOrder = " ORDER BY messages.id DESC ";
				$get = isset($_REQUEST) ? $_REQUEST : null;

				$strSelect = "  messages.*,
								CONCAT(messages.subject,' ',company.name,' ',user.name,' ',user.email,' ',user.phone) AS ti,
								company.name AS company_name,
								company.url AS company_url,
								company.im AS company_image,
								user.name AS user_name,
								user.im AS user_image";

				if (isset($get["limit"]) && $get["limit"]) {
				    $strLimit .= " LIMIT 0,{$get["limit"]}";
				}

				$strWhere .= "  AND messages.user_id = user.id
								AND messages.company_id = company.id";


				if($session_permission["type"] == 1){
					$strWhere .= $action != "trash" ? " AND messages.employer_status != 9 " : "";
					$strWhere .= " AND messages.employer_id = {$user_id} ";
				}else if($session_permission["type"] == 2){
					$strWhere .= $action != "trash" ? " AND messages.user_status != 9 " : "";
					$strWhere .= " AND messages.user_id = {$user_id} ";
				}
				
				// var_dump($session_permission["type"]);

				if($action == "inbox"){
					$strWhere .= "  AND messages.receiver_id = {$user_id} ";
					if($session_permission["type"] == 2){
						$strWhere .= "  AND messages.id IN ( SELECT MAX(id)
									FROM ".TABLE_MESSAGES." AS mess
									WHERE receiver_id = {$user_id}
									GROUP BY mess.company_id, mess.message_id ) ";
					}elseif($session_permission["type"] == 1){
						$strWhere .= "  AND messages.id IN ( SELECT MAX(id)
									FROM ".TABLE_MESSAGES." AS mess
									WHERE receiver_id = {$user_id}
									GROUP BY mess.message_id ) ";
					}
					
				}elseif($action == 'sent'){
					$strWhere .= " AND messages.sender_id = {$user_id} ";
					$strWhere .= "  AND messages.id IN ( SELECT MAX(id)
									FROM ".TABLE_MESSAGES." AS mess
									WHERE sender_id = {$user_id}
									GROUP BY mess.message_id ) ";
				}elseif($action == 'important'){
					$strWhere .= " AND messages.receiver_id = {$user_id} ";
					$strWhere .= " AND messages.important = 1";
					// $strWhere .= "  AND messages.id IN ( SELECT MAX(id)
					// 				FROM ".TABLE_MESSAGES." AS mess
					// 				WHERE receiver_id = {$user_id}
					// 				AND important = 1
					// 				GROUP BY mess.message_id  ) ";
				}elseif($action == 'trash'){
					if($session_permission["type"] == 1){
						$strWhere .= "  AND messages.id IN ( SELECT MAX(id)
										FROM ".TABLE_MESSAGES." AS mess
										WHERE employer_id = {$user_id}
										AND employer_status = 9
										GROUP BY mess.message_id  ) ";
					}elseif($session_permission["type"] == 2){
						$strWhere .= "  AND messages.id IN ( SELECT MAX(id)
										FROM ".TABLE_MESSAGES." AS mess
										WHERE user_id = {$user_id}
										AND user_status = 9
										GROUP BY mess.message_id, mess.company_id  ) ";
					}
					
				}

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