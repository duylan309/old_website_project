<?php 
try{
	$sessionPermission = 0;
	$sessionPermission = isset($_SESSION["adminlog"]) && $_SESSION["adminlog"] ? 100 : 0;

	if ($sessionPermission == 100) {
		$isAllow     = false;

		$user_id = isset($post["db"]["user_id"]) ? intval($post["db"]["user_id"]) : 0;
		$day_more = isset($post["db"]["day_more"]) ? intval($post["db"]["day_more"]) : 0;

		$strQuery = "SELECT * FROM ".TABLE_USER." WHERE id='{$user_id}' LIMIT 0,1";
		$row = $db->db_array($strQuery);
		
		if($row && $day_more!=0){
		    $isAllow = true;
		}

		if($isAllow == true){
			
			$userId = $row["id"];
			$file = FOLDERUSER . "$userId.xml";

			if (is_file($file)) {
				$readXML     = simplexml_load_file($file);
				$information = json_encode($readXML);
				$information = json_decode($information, true);

				$user_update["dayleft"] = isset($information["userinfo"]["db"]["dayleft"]) ? $information["userinfo"]["db"]["dayleft"] : 0;

				if($user_update["dayleft"] > $currentTime) {
				    $user_update["dayleft"] += $day_more*(60*60*24);
				}else {
				    $user_update["dayleft"] = $currentTime + $day_more*(60*60*24);
				}

				if ($db->db_update($user_update, TABLE_USER, array("id" => $userId))) {
                    $information["userinfo"]["db"]["dayleft"] = $user_update["dayleft"];
					
					if(saveXMLFile($file, $information)){

						$admin_row["user_admin_id"] = isset($_SESSION["adminlog"]["user_id"]) ? intval($_SESSION["adminlog"]["user_id"]) : 0;
						$admin_row["date_update"] = date("Y-m-d",$currentTime);
						$admin_row["employer_id"] = $userId;
						$admin_row["days"] = $day_more;
						$admin_row["note"] = isset($post["db"]["note"]) ? $post["db"]["note"] : "";

						if($admin_row["user_admin_id"]!=0){
							
							$strQueryAdmin = "SELECT * FROM ".TABLE_USER." WHERE id={$_SESSION["adminlog"]["user_id"]} LIMIT 0,1";
							$row_admin = $db->db_array($strQueryAdmin);
							if($row_admin){
								$admin_row["name"] = isset($row_admin["name"]) ? $row_admin["name"] : '';

								if($db->db_insert($admin_row, TABLE_ADMIN_UPDATE_EMPLOYER_DAY)) {
									$code = 200;
									$message = $language["updateSuccess"];
								}
							}	
							
						}
                		
					}

				}
				
			}else{
				$code = 502;
  				$errors = $language["unknownErrors"];
			}	
		}else{
			$code = 502;
  			$errors = $language["unknownErrors"];
		}
	}
		
}catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}