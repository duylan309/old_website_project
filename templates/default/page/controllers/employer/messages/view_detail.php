<?php 
$message_id    = isset($_GET['mid']) ? intval($_GET["mid"]) : null;

if(isset($_SESSION["userlog"]) && isset($_SESSION["userlog"]["id"]) && $message_id != null){
	$employer_id = intval($_SESSION["userlog"]["id"]);
	# check id belong to this company
	$strWhere = isset($_GET['type']) ? " AND   messages.sender_id = {$employer_id} " : " AND messages.sender_id = user.id AND messages.receiver_id = {$employer_id} ";
	$strQueryCheckCo = "SELECT messages.*,
							   user.name AS user_name,
							   user.im AS user_image,
							   user.id AS user_id,
							   company.name AS company_name,
							   company.url AS company_url,
							   company.im AS company_image
						FROM ".TABLE_MESSAGES." AS messages,
							 ".TABLE_COMPANY." AS company,
							 ".TABLE_USER." AS user
						WHERE messages.id={$message_id} 
						AND messages.user_id = user.id
						AND messages.company_id = company.id
						AND messages.employer_id = {$employer_id}
						{$strWhere}
						";

	$message_detail = $db->db_array($strQueryCheckCo);

	if($message_detail){
		if($message_detail["message_id"] == 0){
			$strUpdateView = "UPDATE ".TABLE_MESSAGES." SET status = 1, message_id = $message_id WHERE id = $message_id AND employer_id = $employer_id AND receiver_id = $employer_id";
		}else{
			$strUpdateView = "UPDATE ".TABLE_MESSAGES." SET status = 1 WHERE id = $message_id AND employer_id = $employer_id AND receiver_id = $employer_id";
		}
		$db->db_query($strUpdateView);

		if($message_detail['message_id'] != 0){
			$strQueryOldMessage = " SELECT messages.*,
										   company.name AS company_name,
										   company.url AS company_url,
										   company.im AS company_image,
										   user.name AS user_name,
										   user.im AS user_image
									FROM ".TABLE_MESSAGES." AS messages,
										 ".TABLE_COMPANY." AS company,
										 ".TABLE_USER." AS user
									WHERE messages.message_id={$message_detail['message_id']} 
									AND   messages.company_id = company.id
									AND   messages.employer_id = company.ui
									AND   messages.user_id = user.id
									AND   messages.employer_id={$employer_id}
									ORDER BY messages.id ASC";
			$old_message_array  = $db->db_arrayList($strQueryOldMessage);
		}
	}else{
		die();
	}

}else{
	die();
}