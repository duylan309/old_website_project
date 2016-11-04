<?php 
try{
	$sessionPermission = isset($_SESSION["userlog"]) ? $_SESSION["userlog"] : null;

	if (isset($sessionPermission) && $sessionPermission) {
		$isAllow     = false;

		$nodeUpdate  = isset($post["updateNode"])? $post["updateNode"]:null;
		$employer_id = isset($post["db"]["employer_id"]) ? $post["db"]["employer_id"] : null;
		$company_id  = isset($post["db"]["company_id"]) ? $post["db"]["company_id"] : null;
		$user_id     = isset($post["db"]["user_id"]) ? $post["db"]["user_id"] : null;
		$action      = isset($post["action"]) ? $post["action"] : null;
		$message_id  = isset($post["db"]["message_id"]) ? intval($post["db"]["message_id"]) : null;
		
		# var_dump($post);
		$post['db']["created_date"] = $currentTime;

		if($action == "delete"){
            $rows_info =  $post["db"]["mid"];

			if($rows_info != null && is_array($rows_info) && count($rows_info)>0 ){
				foreach($rows_info as $row){
					$array_permission = explode('.',$row);
					$where['id']          = $array_permission[0];
					$where['user_id']     = $array_permission[2];
					$where['employer_id'] = $array_permission[1];
					$where['company_id']  = $array_permission[3];
					
					if($sessionPermission["type"] == 2){
						$updateRow["db"]["user_status"] = 9;
					}else if($sessionPermission["type"] == 1){
						$updateRow["db"]["employer_status"] = 9;
					}else{
						die();
					}
					
        			if($db->db_update($updateRow["db"], TABLE_MESSAGES, $where ) ) {
        				$code = 200;
        				$message = $language["updateSuccess"];
        			}else{
        				$code = 502;
						$errors = $language["unknownErrors"];
        			}
				}
			}
			

		}else if($action == "recover"){
	        $rows_info =  $post["db"]["mid"];

			if($rows_info != null && is_array($rows_info) && count($rows_info)>0 ){
				foreach($rows_info as $row){
					$array_permission = explode('.',$row);
					$where['id']          = $array_permission[0];
					$where['user_id']     = $array_permission[2];
					$where['employer_id'] = $array_permission[1];
					$where['company_id']  = $array_permission[3];
					
					if($sessionPermission["type"] == 2){
						$updateRow["db"]["user_status"] = 0;
					}else if($sessionPermission["type"] == 1){
						$updateRow["db"]["employer_status"] = 0;
					}else{
						die();
					}
					
	    			if($db->db_update($updateRow["db"], TABLE_MESSAGES, $where ) ) {
	    				$code = 200;
	    				$message = $language["updateSuccess"];
	    			}else{
	    				$code = 502;
						$errors = $language["unknownErrors"];
	    			}
				}
			}
		}else{
			if($employer_id && $user_id && $action){
				
				# check id belong to this company
				$strQueryCheckCo = "SELECT *
									FROM ".TABLE_JOB_APPLIED." 
									WHERE ei={$employer_id} 
									AND   ui={$user_id}
									ORDER BY id DESC";

				$rowTotal = $db->db_array($strQueryCheckCo);

				if($rowTotal){
					$isAllow = true;
				}

				if($isAllow == true){
					
					if($action == "send"){
						$message_id = isset($post["db"]["message_id"]) ? intval($post["db"]["message_id"]) : null;
						$post["db"]["message"] = isset($post["db"]["message"]) ? trim($post["db"]["message"]) : null;
						if($message_id){
							if($message_id != 0){
								$strUpdateView = "UPDATE ".TABLE_MESSAGES." SET message_id = {$message_id} 
												  WHERE message_id = {$message_id} 
												  AND company_id = {$company_id} 
												  AND employer_id = {$employer_id} 
												  AND user_id = {$user_id}";
								$db->db_query($strUpdateView);
							}
						}

						unset($post["db"]["receiver"]);

						$new_message_id = $db->db_insert_return_id($post["db"], TABLE_MESSAGES);
	            		if($new_message_id) {
	            			
	            			#get user infomation
							$fileUser = FOLDERUSER . "$user_id.xml";
							if(is_file($fileUser)){
							   $readXMLUser = simplexml_load_file($fileUser);
							   $informationUser    = json_encode($readXMLUser);
							   $informationUser    = json_decode($informationUser, true); 
							}
							$candidate['name']       = $informationUser["userinfo"]['db']['name'];
							$candidate['email']      = $informationUser["userinfo"]['db']['email'];

							#get employer infomation
							$fileEmployer = FOLDERUSER . "$employer_id.xml";
							if(is_file($fileEmployer)){
							   $readXMLEmployer = simplexml_load_file($fileEmployer);
							   $informationEmployer    = json_encode($readXMLEmployer);
							   $informationEmployer    = json_decode($informationEmployer, true); 
							}
							$employer['name']       = $informationEmployer["userinfo"]['db']['name'];
							$employer['email']      = $informationEmployer["userinfo"]['db']['email'];
							
							#get company information
		                    $fileCompany = FOLDERCOMPANY . "$company_id.xml";
		                    if(is_file($fileCompany)){
		                       $readXMLCompany = simplexml_load_file($fileCompany);
		                       $informationCompany    = json_encode($readXMLCompany);
		                       $informationCompany    = json_decode($informationCompany, true); 
		                    }
		                    $company['name']  = $informationCompany["db"]["name"];

		                    # message: Subject;
		                    $message["subject"] = $post["db"]["subject"];
		                    $message["message"] = $post["db"]["message"];
						
							if($sessionPermission["type"] == 2){ //User
								
								# select Company Email
								$strQueryEmail   =  "SELECT id,user_id,email,name,status,company_id
								                    FROM ".TABLE_RECEIVE_EMAIL." AS em
								                    WHERE em.company_id = {$company_id} AND em.user_id = {$employer_id} AND em.status = 2 ";
								
								$resultCompanyEmail =  $db->db_arrayList($strQueryEmail);
								
								$to = null; 
								if(isset($informationEmployer["userinfo"]["db"]["is_received_email"])){
								    if($informationEmployer["userinfo"]["db"]["is_received_email"] == 1){
								        $to[0]['email'] = $informationEmployer["userinfo"]["db"]["email"];
								        $to[0]['name']  = $informationEmployer["userinfo"]["db"]["name"];
								    } 
								}
								

								if($resultCompanyEmail && count($resultCompanyEmail)){
								    $i = isset($informationEmployer["userinfo"]["db"]["is_received_email"]) ? ($informationEmployer["userinfo"]["db"]["is_received_email"] == 1 ? 1 : 0) : 0;
								    foreach($resultCompanyEmail as $email){
								        $to[$i]['email'] = $email["email"];
								        $to[$i]['name']  = $email["name"];
								        $i++;
								    }
								}
								$receiver["name"] = $company["name"];
		            			$sender["name"]   = $candidate["name"];
		            			$subject_email    = "[thue.today] You have a new message.";

							}else if($sessionPermission["type"] == 1){ // Employer
								
								$to = null;
								# Type = 1 Send to User
		            			$to[0]["name"]       = $candidate["name"];
		            			$to[0]["email"]      = $candidate["email"];

		            			$receiver["name"] = $candidate["name"];
		            			$sender["name"]   = $company["name"];

		            			$subject_email    = "[thue.today] ".$company["name"]." just sent you a new message.";
								

							}else{
								die();	
							}
	            			
	            			$link = $_SERVER['HTTP_HOST']."/".$seo_name["page"]["user"].'?manage=messages&action=view&mid='.$new_message_id;

	            			if( strlen( $message["message"] ) > 200 ) {
	            			   $message["message"] = substr( $message["message"], 0, 200 ) . '...';
	            			}

            				require $cgf_site["temp"] . "newsletter/message_alert.php";

	            			$sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
	            			   "from" => "team@thue.today",
	            			   "to" => $to,
	            			   "sender" => "Thue Today",
	            			   "receiver" => $receiver["name"],
	            			   "reply" => "team@thue.today",
	            			   "replyInfo" => "Thue Today",
	            			   "subject" => $subject_email,
	            			   "content" => $strBody,
	            			); 

	            			if($to){
	            			    // require dirname(__FILE__) . "/sendmanyemail.php";
	            			} 

	            			$code = 200;
	            			$message = $language["sendMessageSuccessful"];
	            		}else{
	            			$code = 503;
							$errors = $language["unknownErrors"];
	            		}
					}else if($action == "important"){
						if($message_id){
							unset($post["db"]["created_date"]);
							$updateRow["db"]["important"] = 1;
							$where["id"] = $message_id;
							$where["user_id"] = $user_id;
							$where["employer_id"] = $employer_id;
							$where["company_id"]  = $company_id;
							$where["sender_id"]   = $post["db"]["sender_id"];
							$where["receiver_id"] = $post["db"]["receiver_id"];
							
	            			if($db->db_update($updateRow["db"], TABLE_MESSAGES, $where ) ) {
	            				$code = 200;
	            				$message = $language["updateSuccess"];
	            			}else{
	            				$code = 502;
								$errors = $language["unknownErrors"];
	            			}

						}else{
							$code = 502;
							$errors = $language["unknownErrors"];
						}
					}else if($action == "unimportant"){
						if($message_id){
							unset($post["db"]["created_date"]);
							$updateRow["db"]["important"] = 0;
							$where["id"] = $message_id;
							$where["user_id"] = $user_id;
							$where["employer_id"] = $employer_id;
							$where["company_id"]  = $company_id;
							$where["sender_id"]   = $post["db"]["sender_id"];
							$where["receiver_id"] = $post["db"]["receiver_id"];
							
	            			if($db->db_update($updateRow["db"], TABLE_MESSAGES, $where ) ) {
	            				$code = 200;
	            				$message = $language["updateSuccess"];
	            			}else{
	            				$code = 502;
								$errors = $language["unknownErrors"];
	            			}
						}else{
							$code = 502;
							$errors = $language["unknownErrors"];
						}
					}

				}else{
					$code = 502;
					$errors = $language["unknownErrors"];
				}



			}else{
				die();
			}
		}
	}else{
		die();
	}

}catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}