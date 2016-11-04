<?php
$site_key_post = $post['g-recaptcha-response'];

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $remoteip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $remoteip = $_SERVER['REMOTE_ADDR'];
}

$api_url = APIURLCAPTCHA.'?secret='.SECRETKEYCAPTCHA.'&response='.$site_key_post.'&remoteip='.$remoteip;
$response = file_get_contents($api_url);
$response = json_decode($response);

if(!isset($response->success))
{
    $code = 402;
    $errors = "Not Captcha";
}

if(isset($_SESSION["captcha"])){
  $response->success = $_SESSION["captcha"];
}


if($response->success == true)
{
  	if(isset($post["password"]) && $post["password"] &&  isset($post["email"]) && $post["email"]) {

        $_SESSION["captcha"] = $response->success;
      
  		unset($post["captcha"]);
  		unset($post['g-recaptcha-response']);

  		$post["password"] = md5($post["password"]);
      $post["created"] = $currentTime;
  		$post["last_signin"] = $currentTime;
  		$post["status"] = 1;

	    if($post["type"] == 1) {
        $post["is_received_email"] = 1;
		    $promocode = isset($_SESSION["signupWithPromocode"]["promo_code"]) ? $_SESSION["signupWithPromocode"]["promo_code"]:null;

		    if( $promocode  ){
  				$post["page"]    = isset($_SESSION["signupWithPromocode"]["page"])? $_SESSION["signupWithPromocode"]["page"]:1;
          $post["status"]  = isset($_SESSION["signupWithPromocode"]["category"])? $_SESSION["signupWithPromocode"]["category"]:1;
  	      $post["jobleft"] = isset($_SESSION["signupWithPromocode"]["jobleft"])? $_SESSION["signupWithPromocode"]["jobleft"]:5;
  				$post["dayleft"] = isset($_SESSION["signupWithPromocode"]["day"]) ? intval($_SESSION["signupWithPromocode"]["day"]*(60*60*24)) + $currentTime : $currentTime;
          $dataResponse    = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=pagecmp');
  			}else{
          $service = isset($_SESSION["optionService"]) ? $_SESSION["optionService"]:null;
          if( $service  ){
            if($_SESSION["optionService"]["category"] == "2"){
              $post["page"]    = isset($_SESSION["optionService"]["page"])? $_SESSION["optionService"]["page"]:1;
              $post["status"]  = isset($_SESSION["optionService"]["category"])? $_SESSION["optionService"]["category"]:1;
              $post["jobleft"] = isset($_SESSION["optionService"]["jobleft"])? $_SESSION["optionService"]["jobleft"]:5;
              $post["dayleft"] = isset($_SESSION["optionService"]["day"]) ? intval($_SESSION["optionService"]["day"]*(60*60*24)) + $currentTime : $currentTime;
              $dataResponse    = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=pagecmp');
            }
          }
        }
	    }

      $name = $post["name"];
      $email = strtolower($post["email"]);
      
      $strBody = null;

      #doto 2 email template for type = 1 type =2
      $subject_email = "Welcome to thue.today!";
      if($post["type"] == 1){
        require $cgf_site["temp"] . "newsletter/register_employer.php";
        $subject_email = "Start hiring today!";
      }else{
        require $cgf_site["temp"] . "newsletter/register_employee.php";
        $subject_email = "Welcome to thue.today!";
      }

      $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
          "from" => "team@thue.today",
          "to" => $email,
          "sender" => "Thue Today",
          "receiver" => $name,
          "reply" => "team@thue.today",
          "replyInfo" => "Thue Today",
          "subject" => $subject_email ,
          "content" => $strBody,
      );

      if($code == 500){
        $code    = 500;
        $errors = $language["mailFakeErrors"];
      }else{
        // INSER DATA
        if ($db->db_insert($post, TABLE_USER)) { 
          
          $str_query = "SELECT  id,
                                email,
                                username,
                                name,
                                im,
                                gender,
                                phone,
                                address,
                                city,
                                dob,
                                type,
                                status,
                                created,
                                dayleft,
                                jobleft,
                                page,
                                is_received_email,
                                last_signin 
                        FROM user
                        WHERE email='" . $post["email"] . "' 
                              AND created=$currentTime LIMIT 0,1";

          $row = $db->db_array($str_query);

          if ($row) {
            
            $file = FOLDERUSER . $row["id"] . ".xml";
            $information["userinfo"] = array(
              "db" => $row,
            );
            saveXMLFile($file, $information);
            $_SESSION["userlog"] = $row;

            #update applied promocode
            if( isset($promocode) )
            {
              $db->db_insert(array("ui"=>$row["id"], "pr"=>$promocode, "cr"=>$currentTime), TABLE_PROMO_APPLIED);
              $db->db_update(array("status"=>3), TABLE_PROMO, array("code" => $promocode));
            }

            // require dirname(__FILE__) . "/sendmail.php";
	          $code = 200;
      	 
            $message = $language["signupSuccess"];
         
          }

          $isDone = true;

        } else {
          $code = 401;
          $errors = $language["signupErrors"];
        }
      }
      
  	}
  	else {
  		$code = 401;
  		$errors = $language["signupErrors"];
  	}

}else{
    $code = 402;
    $errors = "Limit Permission Captcha";
}


?>
