<?php 
$message_id    = isset($_GET['mid']) ? intval($_GET["mid"]) : null;

if(isset($_SESSION["userlog"]) && isset($sessionUserId) && $message_id != null){
	$user_id = intval($sessionUserId);
	# check id belong to this company
	$strWhere = isset($_GET['type']) ? " AND   messages.sender_id = {$user_id} " : " AND messages.receiver_id = {$user_id} ";

	$strQueryCheckCo = "SELECT messages.*,
							   company.name AS company_name,
							   company.url AS company_url,
							   company.im AS company_image
						FROM ".TABLE_MESSAGES." AS messages,
							 ".TABLE_COMPANY." AS company
						WHERE messages.id={$message_id} 
						AND   messages.company_id = company.id
						AND   messages.employer_id = company.ui
						{$strWhere}
						AND   messages.user_id={$user_id}";

	$message_detail = $db->db_array($strQueryCheckCo);

	if($message_detail){
		if($message_detail["message_id"] == 0){
			$strUpdateView = "UPDATE ".TABLE_MESSAGES." SET status = 1, message_id = $message_id WHERE id = $message_id AND user_id = $user_id AND receiver_id = $user_id";
		}else{
			$strUpdateView = "UPDATE ".TABLE_MESSAGES." SET status = 1 WHERE id = $message_id AND user_id = $user_id AND receiver_id = $user_id";
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
									AND   messages.employer_id = {$message_detail['employer_id']}
									AND   messages.user_id = user.id
									AND   messages.user_id = {$user_id}
									ORDER BY messages.id ASC ";
			$old_message_array  = $db->db_arrayList($strQueryOldMessage);
		}

	}else{
		die();
	}

}else{
	die();
}