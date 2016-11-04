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

$account_row = $post['db'];

if($response->success == true){
  	
    $enough_requirement = false;

    if(isset($account_row["facebook"])){
      $enough_requirement = true;
    }
        
    if(isset($account_row["password"]) && $account_row["password"] &&  isset($account_row["email"]) && $account_row["email"]){
      $enough_requirement = true;
    }

    if($enough_requirement) {

      $_SESSION["captcha"] = $response;
      
  		unset($post["captcha"]);
  		unset($post['g-recaptcha-response']);

      if(isset($account_row["facebook"])){
        $facebook_sign_up = true;
      }else{
       
        $account_row["password"] = md5($account_row["password"]);
        $account_row["created"]  = $currentTime;
        $account_row["last_signin"]  = $currentTime;
        $account_row["status"]   = 1;

        $name  = $account_row["name"];
        $email = $account_row["email"];
        $strBody = null;
        
        require $cgf_site["temp"] . "newsletter/register_employee.php";

        $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
            "from" => "team@thue.today",
            "to" => $email,
            "sender" => "Thue Today",
            "receiver" => $name,
            "reply" => "team@thue.today",
            "replyInfo" => "Thue Today",
            "subject" => "Welcome to thue.today",
            "content" => $strBody,
        );

        $facebook_sign_up = false;

      }

      if($code == 500){
        $code    = 500;
        $errors = $language["mailFakeErrors"];
      }else{

        if(isset($post["db"]["im"]) && count($post["db"]["im"]) && !empty($post["db"]["im"])){
          $upload_base_image = uploadImageBase64($post["db"]["im"], FOLDERIMAGEUSER, $name, $post["db"]["imsize"]);
              
          if($upload_base_image["code"] == 200){
            $account_row["im"] = $upload_base_image['image_name'];
          }else{
            die();
          }

        }else{
          unset($post["db"]["im"]);
        }

        unset($post["db"]["imsize"]);
        unset($account_row["imsize"]);

        // CREATE ACCOUNT
        $sign_up_result = false;

        if($db->db_insert($account_row, TABLE_USER)){
          $sign_up_result = true;
        }

        if($facebook_sign_up){
          $sign_up_result = true;
        }        

        if($sign_up_result) { 
          

          if($facebook_sign_up){
            $str_query = "SELECT id, email, username, name, im, gender, phone, address, city, dob, type, status, created, dayleft, page FROM user
                          WHERE fb_email='" . $account_row["email"] . "'LIMIT 0,1";

          }else{
            $str_query = "SELECT id, email, username, name, im, gender, phone, address, city, dob, type, status, created, dayleft, page FROM user
                          WHERE email='" . $account_row["email"] . "' AND created=$currentTime LIMIT 0,1";

          }
          
          $row_account_insert = $db->db_array($str_query);

          if ($row_account_insert) {
            
            $file = FOLDERUSER . $row_account_insert["id"] . ".xml";
            $user_insert_id = $row_account_insert["id"];
            
            if($facebook_sign_up){
             
              $readXML     = simplexml_load_file($file);
              $information = json_encode($readXML);
              $information = json_decode($information, true);

            }else{
              $information["userinfo"] = array(
                "db" => $row_account_insert,
              );

              saveXMLFile($file, $information);

              $_SESSION["userlog"] = $row_account_insert;
             
            }

            // require dirname(__FILE__) . "/sendmail.php";
            
	          $code = 200;
            $message = $language["signupSuccess"];
         
          }

          // Add user cv info
          if($code == 200){
              
              // save user cv 
              require dirname(__FILE__) . "/action/saveusercv.php";

              // apply job
              require dirname(__FILE__) . "/action/applyjob.php";

              if($to){
                require $cgf_site["temp"] . "newsletter/application_alert_update.php";
                $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
                    "from" => "team@thue.today",
                    "to" => $to,
                    "sender" => "Thue Today",
                    "receiver" => $informationEmployer["userinfo"]["db"]["name"],
                    "reply" => "team@thue.today",
                    "replyInfo" => "Thue Today",
                    "subject" => "You have a new applicant",
                    "content" => $strBody,
                );   
                // require dirname(__FILE__) . "/sendmanyemailnoloadfile.php";
              }
          }

          $isDone = true;

        } else {
          $code = 401;
          $errors = $language["signupErrors"];
        }
      }
      
  	}else {
  		$code = 401;
  		$errors = $language["signupErrors"];
  	}

}else{
    $code = 402;
    $errors = $language["applyJobErrors"];
}


?>
