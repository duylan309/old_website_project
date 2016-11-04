<?php
$password = md5($post["password"]);
$email    = $post["email"];
$remember = isset($post["rememberlogin"]) ? intval($post["rememberlogin"]) : 0;

$str_query = "  SELECT  id,
						email,
						username,
						name,
						im,
						gender,
						dob,
						fb_load_newfeed,
						fb_load_photo,
						deactive,
						is_newletter,
						is_received_email,
						type,
						status,
						created,
						dayleft,
						jobleft,
						page ,
						FROM_UNIXTIME(dob, '%e') AS day,
						FROM_UNIXTIME(dob, '%m') AS month,
						FROM_UNIXTIME(dob, '%Y') AS year 
				FROM user
                WHERE email='$email' 
                AND password='$password'
                LIMIT 0,1";

$row = $db->db_array($str_query);

if ($row) {
	
	if($row["deactive"] == 2){
		$code = 400;
		$errors = $language["accountLockedContent"];
	}else{
		$userId = $row["id"];
		$file = FOLDERUSER . "$userId.xml";

		if (is_file($file)) {
			$readXML = simplexml_load_file($file);
			$information = json_encode($readXML);
			$information = json_decode($information, true);
			
			$_SESSION["userlog"] = $row;
			if($row["type"]==2){
				$_SESSION["userlog"]["cv"] = $information["user_cv"]["db"];
			}

			if($remember == 1){
				$row['remember'] = 1;
				$set_value_cookie = '';
				
				foreach ($row as $key_db => $value) {
					$set_value_cookie .= $key_db.'='.$value.'&'; 
				}
				
				$key = encrypt($set_value_cookie,KEYSECURE);

				$time = time()+ 60*60*24*365;
				session_set_cookie_params($time);

				setcookie(COOKIENAME, $key , $time, "/",COOKIEDOMAIN);
		
			}else{
				$row['remember'] = 0;
				if(isset($_COOKIE[COOKIENAME])){
					unset($_COOKIE[COOKIENAME]);
				    setcookie(COOKIENAME, '', time() - 3600, '/',COOKIEDOMAIN);
				}
			}

			if( isset($row["dayleft"]) && $row["type"]==1) {
			    $row["dayleftshow"] = round( ($row["dayleft"] - time())/(3600*24) ) + 1;
			    if($row["dayleftshow"]<0) {
			        unset($row["dayleftshow"]);
			    }else{
			    	$_SESSION["userlog"]["dayleftshow"] = $row["dayleftshow"];
			    }
			}
			if(isset($_SESSION["usersub"])) {
				unset($_SESSION["usersub"]);
			}


		}

		if($row["deactive"] == 1){
			$dataResponse = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=deactive');
		}

		if($row["type"]==1){
			$dataResponse = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=jobs');
		}

		if($row["type"] ==2){
            require dirname(__FILE__) . "/action/candidate_get_missing_cv_info.php";
		}

		if(isset($post["urlRedirectLink"]) && count($post["urlRedirectLink"])){
			$dataResponse = array("urlRedirect" =>  $post["urlRedirectLink"]);
		}

		$currentTime = time();
		$strUpdateLastLogin = " UPDATE user 
								SET last_signin=$currentTime
								WHERE id = $userId";

	    if($db->db_query($strUpdateLastLogin)){
	    	$post = $_SESSION;
			$code = 200;
			$message = $language["signinSuccess"];
	    }else{
	    	$code = 400;
			$errors = $language["signinError"];
	    }
	}

} else {
	$code = 400;
	$errors = $language["signinError"];
}
?>
