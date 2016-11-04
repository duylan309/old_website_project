<?php

if(isset($_GET["accessToken"]) && $_GET["accessToken"]) {
	$code = 200;
	$message = md5($_GET["accessToken"]);
	$_SESSION["createAccessTokenFB"] = $message;

} else {

	$strLinkReferer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

	# get value from json post
	$data_get_json = json_decode(file_get_contents('php://input'), true);

	$accessToken = $data_get_json['accessToken'];


	if($_SERVER['HTTP_HOST'] == $strLinkReferer && isset($_SESSION["createAccessTokenFB"]) && $_SESSION["createAccessTokenFB"] == $accessToken) {

		$email = $data_get_json["email"];
		$uid   = $data_get_json["uid"];

		$post["email"]     = $email;
		$post["name"]      = $data_get_json['name'];
		$post["im"]        = $data_get_json["uim"];
		$post["gender"]    = $data_get_json["gender"] == "female" ? 2 : 1;
		
		$education         = $data_get_json["education"];
		$work              = $data_get_json["work"];

		if(isset($data_get_json["birthday"]) && $data_get_json["birthday"]!= "undefined")
		$post["dob"]      = isset($data_get_json["birthday"]) ? date('Y-m-d', strtotime($data_get_json["birthday"])) : "";

		$str_query  = " SELECT id, email, username, name, im, gender, dob, deactive, type, status, created, DAY(dob) AS day, MONTH(dob) AS month, YEAR(dob) AS year
						FROM ".TABLE_USER." 
						WHERE fb_email='$email' AND type=2 AND signupby='FB' LIMIT 0,1";

		$row = $db->db_array($str_query);

		unset($data_get_json["accessToken"]);
		unset($_SESSION["createAccessTokenFB"]);

		# IS USER
		if ($row ) {
			$userId = $row["id"];
			$file = FOLDERUSER . "$userId.xml";
			if (is_file($file)) {
				$readXML = simplexml_load_file($file);
				$information = json_encode($readXML);
				$information = json_decode($information, true);
				$_SESSION["userlog"] = $row;
			}
			unset($post);
			$message = "sigin in ok";
			$code = 600;
		} else {
		
			$post["created"]  = $currentTime;
			$post["type"]     = 2;
			$post["status"]   = 1;
			$post["signupby"] = 'FB';

			$url_img_facebook = $data_get_json["uim"];
			$name_one         = basename($url_img_facebook);
			$na_question      = explode('.',$name_one);
			$type_img   	  = explode('?',$na_question[1]);

			$img_rename       = $uid.'_'.preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($data_get_json['name']))));

			$img_final        = FOLDERIMAGEUSER.$img_rename.'.'.$type_img[0];
		
			$post["im"]       = $img_rename.'.'.$type_img[0]; 

			unset($post['education']);
			unset($post['work']);
			unset($post['uim']);
			unset($post['accessToken']);
			unset($post['uid']);
			unset($post['birthday']);

			$post['fb_email'] = $post["email"];

			if ($db->db_insert($post, TABLE_USER)) {

				$str_query = "  SELECT id, email, username, name, im, gender, dob, deactive, type, status, created, DAY(dob) AS day, MONTH(dob) AS month, YEAR(dob) AS year
								FROM user
		                	    WHERE email='" . $email. "' AND created=$currentTime LIMIT 0,1";
				
				$row = $db->db_array($str_query);

				file_put_contents($img_final,file_get_contents("https://graph.facebook.com/".$uid."/picture?type=large"));

				#get work history information
				if($work && count($work)){
					for($i=0;$i<count($work);$i++){
						$post_work[$i]['city']         = isset($work[$i]['location']['name']) ? explode(',', $work[$i]['location']['name'])[0] : ''; 
						$post_work[$i]['country']      = isset($work[$i]['location']['name']) ? ( explode(',', $work[$i]['location']['name'])[1] ? explode(',', $work[$i]['location']['name'])[1] : '' ) : '';
						$post_work[$i]['company_name'] = isset($work[$i]["employer"]['name']) ? $work[$i]["employer"]['name'] :''; 
						$post_work[$i]['title']        = isset($work[$i]['position']['name']) ? $work[$i]['position']['name'] :''; 
						$post_work[$i]['from_year']    = isset($work[$i]['start_date']) ? explode('-', $work[$i]['start_date'])[0]: ''; 
						$post_work[$i]['to_year']      = isset($work[$i]['end_date']) ? explode('-', $work[$i]['end_date'])[0]:''; 
						$post_work[$i]['user_id']      = $row["id"]; 
						
						$info_work[$i]['id']		   = $db->db_insert_return_id($post_work[$i],TABLE_USER_WORK_HISTORY);
						$info_work[$i]['title']        = $post_work[$i]['title']        ;
						$info_work[$i]['level']        = ''       ;
						$info_work[$i]['cmpname']      = $post_work[$i]['company_name'] ;
						$info_work[$i]['city']         = $post_work[$i]['city']         ;
						$info_work[$i]['country']      = $post_work[$i]['country']      ;
						$info_work[$i]['from']         = $post_work[$i]['from_year']    ; 
						$info_work[$i]['to']           = $post_work[$i]['to_year']      ;

						$information['experience']["n_{$info_work[$i]['id']}"] = $info_work[$i];
					}
				}

				#get work history information
				if($education && count($education)){
					for($j=0;$j<count($education);$j++){
						$post_education[$j]['school_name']  = isset($education[$j]["school"]['name']) ? $education[$j]["school"]['name'] :''; 
						$post_education[$j]['degrees']      = isset($education[$j]['type']) ? $education[$j]['type'] :''; 
						$post_education[$j]['fieldofstudy'] = isset($education[$j]['concentration'][0]['name']) ? $education[$j]['concentration'][0]['name'] : '';
						$post_education[$j]['from_year']    = isset($education[$j]['year']['name']) ? $education[$j]['year']['name'] : ''; 
						$post_education[$j]['to_year']      = ''; 
						$post_education[$j]['user_id']      = $row["id"]; 
						
						$info_education[$j]['id']		    = $db->db_insert_return_id($post_education[$j],TABLE_USER_EDUCATION_HISTORY);
						$info_education[$j]['school']       = $post_education[$j]['school_name'] ;
						$info_education[$j]['degrees']      = $post_education[$j]['degrees']     ;
						$info_education[$j]['fieldofstudy'] = $post_education[$j]['fieldofstudy'];
						$info_education[$j]['from']         = $post_education[$j]['from_year']   ;
						$info_education[$j]['to']           = $post_education[$j]['to_year']     ;

						$information['education']["n_{$info_education[$j]['id']}"] = $info_education[$j];
					}
				}

				if ($row) {
					$file = FOLDERUSER . $row["id"] . ".xml";
					$information["userinfo"] = array(
						"db" => $row,
					);
					saveXMLFile($file, $information);
					$_SESSION["userlog"] = $row;
				}


				$code = 610;
				$message = $language["signupSuccess"];
			}else{
				$code = 401;
				$message = $language["signupErrors"];
			}
		}

	} else {
		$code = 201;
		$message = "access token wrong";
	}
}
?>