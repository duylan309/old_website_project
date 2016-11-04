<?php 
try{
	$sessionPermission = 0;
	$sessionPermission = isset($_SESSION["userlog"]) ? ( $_SESSION["userlog"]["type"] == 1 ? 100 : 0) : 0;

	if ($sessionPermission == 100) {
		$isAllow     = false;

		$nodeUpdate  = isset($post["updateNode"])? $post["updateNode"]:null;
		$company_id  = isset($post["db"]["pid"]) ? $post["db"]["pid"] : null;
		$employer_id = isset($post["db"]["eid"]) ? $post["db"]["eid"] : null;
		$user_id     = isset($post["db"]["uid"]) ? $post["db"]["uid"] : null;
		$action      = isset($post["action"])    ? $post["action"] : null;
		$comment_id  = isset($post["db"]["comment_id"]) ? intval($post["db"]["comment_id"]) : null;
		
		$post["db"]["created_date"] = $currentTime;

		if($action == "delete"){

        	if(isset($post["db"]["current_id"]) && intval($post["db"]["current_id"])==intval($_SESSION["userlog"]["id"])){
        		$rows_info =  $post["db"][$_SESSION["userlog"]["id"]];
				if($rows_info != null ){
					
					$array_permission = explode('.',$rows_info);
					$where['id']      = $array_permission[0];
					$where['uid']     = $array_permission[2];
					$where['eid']     = $array_permission[1];
					$where['pid']     = $array_permission[3];
					
					if($_SESSION["userlog"]["type"] == 2){
						$updateRow["db"]["status"] = 9;
					}else if($_SESSION["userlog"]["type"] == 1){
						$updateRow["db"]["status"] = 10;
					}else{
						die();
					}

        			if($db->db_update($updateRow["db"], TABLE_COMMENT, $where ) ) {
        				$code = 200;
        				$message = $language["updateSuccess"];
        			}else{
        				$code = 502;
						$errors = $language["unknownErrors"];
        			}

				}
        	}else{
        		die();
        	} 
            
		}else if($action == "comment"){

			if($employer_id && $user_id && $company_id && $action){
				
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
					
					if($action == "comment"){
						
						$comment_id = isset($post["db"]["comment_id"]) ? intval($post["db"]["comment_id"]) : null;
						
						#update
						if($comment_id){
							
							if($comment_id != 0){
								unset($post["db"]["comment_id"]);
								$rowUpdate["content"] = $post["db"]["content"];
								if($db->db_update($rowUpdate, TABLE_COMMENT, array("id"=>$comment_id) ) ) {
									$code = 200;
									$message = $language["sendCommentSuccessful"];
								}else{
			            			$code = 503;
									$errors = $language["unknownErrors"];
								}
							}
						
						}else{ # insert
						
							$post["db"]["status"] = 1;
							$new_comment_id = $db->db_insert_return_id($post["db"], TABLE_COMMENT);
		            		
		            		if($new_comment_id) {
		            			
		            			$code = 200;
		            			$message = $language["sendCommentSuccessful"];
		            		
		            		}else{
		            			$code = 503;
								$errors = $language["unknownErrors"];
		            		}
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