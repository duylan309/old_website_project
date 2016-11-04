<?php
$isOldUser   = null;
$isPromocode = null;
$isPermission = 0;
$code = null;
$unlimitedStatus = 3;
$uid = isset($post["db"]["ui"]) ? $post["db"]["ui"] : null;
$code = isset($post["db"]["pr"]) ? $post["db"]["pr"] : null;

if($uid && $sessionUserId == $uid){
    $isOldUser = true;
}

if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
    $isOldUser = true;
    $isPermission = 100;
}


if($code == null && intval($_POST['token']) == 99 ){

    $code = isset($_POST['pr']) ? mysql_escape_string($_POST['pr']) :null;

    $strQuery = "SELECT * FROM ".TABLE_PROMO." WHERE code='{$code}' AND status=2 LIMIT 0,1";
    $row = $db->db_array($strQuery);
   
    if($row){
        $isPromocode = 1;
        $post["urlregister"] = 1;  
    }
    
}

if($code){

    $promocode = $code;
    $strQuery = "SELECT * FROM ".TABLE_PROMO." WHERE code='{$promocode}' AND status=2 LIMIT 0,1";
    $row = $db->db_array($strQuery);

    if($row) {
        if(isset($post["signupWithPromocode"]) && !$isOldUser) {
            $isPromocode = true;
            $message = $language["promoMessage"];
            $serviceData  = arrSearch ( $language["service"], "id=={$row["service_id"]}" );
            if(isset($serviceData[0])) {
                $serviceData[0]["promo_id"] = $row["id"];
                $serviceData[0]["promo_code"] = $promocode;
            }
            $_SESSION["signupWithPromocode"] = $serviceData ? $serviceData[0] : null;
       
        // } elseif ($uid && $sessionUserId == $uid) {
        } elseif ($isOldUser) {

            $serviceData  = arrSearch ( $language["service"], "id=={$row["service_id"]}" );

            if($serviceData) {
                $post["db"]["cr"] = $currentTime;
                if ($db->db_insert($post["db"], TABLE_PROMO_APPLIED)) {
                    $db->db_update(array("status"=>3), TABLE_PROMO, array("code" => $promocode));
                    $isPromocode = true;
                    $message     = $language["promoMessage"];
                    $file        = FOLDERUSER.$uid.".xml";

                    if (is_file($file)) {
                        #update user status AND dayleft
                        $fileinfo       = simplexml_load_file($file);
                        $information    = json_encode($fileinfo);
                        $information    = json_decode($information, true);

                        $dayleft        = isset($information["userinfo"]["db"]["dayleft"]) ? $information["userinfo"]["db"]["dayleft"] : 0;

                        
                        $status = isset($information["userinfo"]["db"]["status"]) ? $information["userinfo"]["db"]["status"] : 1;
                        $status = isset($serviceData[0]["category"])? $serviceData[0]["category"] : $status;

                        if(isset($serviceData[0]["job"])){

                        }

                        $jobLeftCurrent = isset($information["userinfo"]["db"]["jobleft"]) ? $information["userinfo"]["db"]["jobleft"] : 0;
                        //$jobLeftPlus    = isset($serviceData[0]["job"])? $serviceData[0]["job"] : 5;

                        if($serviceData[0]["category"] >= $status && $dayleft > $currentTime) {
                            $dayleft += $serviceData[0]["day"]*(60*60*24);
                        }
                        else {
                            $dayleft = $currentTime + $serviceData[0]["day"]*(60*60*24);
                        }

                        $user_update["dayleft"] = $dayleft;
                        $user_update["jobleft"] = $jobLeftCurrent;
                        // $user_update["jobleft"] = $jobLeftCurrent + $jobLeftPlus;
                        $user_update["status"]  = $status;
                        $user_update["page"]    = isset($serviceData[0]["page"]) ? $serviceData[0]["page"] : 1;

                        if( $status == $unlimitedStatus ) {
                            $user_update["jobleft"] = 0;
                        }

                        if ($db->db_update($user_update, TABLE_USER, array("id" => $uid))) {
                            $information["userinfo"]["db"]["dayleft"] = $user_update["dayleft"];
                            $information["userinfo"]["db"]["jobleft"] = $user_update["jobleft"];
                            $information["userinfo"]["db"]["status"]  = $user_update["status"];
                            $information["userinfo"]["db"]["page"]    = $user_update["page"];
                            $_SESSION["userlog"]["status"]  = $user_update["status"];
                            $_SESSION["userlog"]["dayleft"] = $user_update["dayleft"];
                            $_SESSION["userlog"]["page"]    = $user_update["page"];
                            saveXMLFile($file, $information);
                        }
                    }
                }
            }
        }
    }
}

if($isPromocode) {
    if(isset($post["urlregister"])){
        $dataResponse = array("urlRedirect" => "/".$seo_name["page"]["payment"].'?step=1');
    }else{
        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
            $dataResponse = array("urlRedirect" => "/".$seo_name["page"]["admin"]."?fun=cmp");
        }else{
            $dataResponse = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=promoapplied');
        }
    }

    $code = 200;
} else {
    $code = 201;
    $errors = $language["promocodeErrors"];
}

?>
