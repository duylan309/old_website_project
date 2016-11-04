<?php
$isPageNotFound = true;
if(isset($url_data[1]) && $url_data[1] && $sessionUserId) {
    $serviceData = null;
    $isUpdateUserStatus = false;
    $unlimitedStatus = 3;
    $currentTime = time();
    if($url_data[1] == "paypal") {
        // Include and instantiate the API
        require_once "api/post/paymentmethod/3/PayPal.class.php";

        $paypalAPICredentials = isset($paymentSetting["paypal"]) ? $paymentSetting["paypal"] : null ;
        $username = isset($paypalAPICredentials["username"]) ? $paypalAPICredentials["username"] : '124phn-facilitator_api1.gmail.com';
        $password = isset($paypalAPICredentials["password"]) ? $paypalAPICredentials["password"] :'87U9LFTHUSG3PDU9' ;
        $signature = isset($paypalAPICredentials["signature"]) ? $paypalAPICredentials["signature"] :'AiPC9BjkCyDFQXbSkoZcgqH3hpacAdI2Fak8rEJFnWkIEsdpYtUFYpI7';

        $environment = "LIVE";
        if(isset($paypalAPICredentials["sandbox"]) && $paypalAPICredentials["sandbox"] ) {
            $environment = "SANDBOX";
        }

        $paypal = new PayPal($environment, $username, $password, $signature);

        // Complete an Express Checkout transaction
        $payment = $paypal->doExpressCheckoutPayment();

        if( $payment && isset($payment["PAYMENTINFO_0_ACK"]) && isset($payment["TOKEN"])&& $payment["PAYMENTINFO_0_ACK"]=="Success" ) {

            $updatePayment = "SELECT * FROM ".TABLE_USER_PAYMENT." WHERE ui = {$sessionUserId} AND pm = 3 AND ps != 5 AND token = '{$payment["TOKEN"]}' ORDER BY id DESC LIMIT 0,1 ";
            $rowUpdatePayment = $db->db_array($updatePayment);
            if($rowUpdatePayment) {
                #check and update Service if payment status = 5
                $serviceData  = arrSearch ( $language["service"], "id=={$rowUpdatePayment["si"]}" );
                if ($db->db_update(array("ps"=>5), TABLE_USER_PAYMENT, array("id" => $rowUpdatePayment["id"]))) {
                    $isUpdateUserStatus = true;
                }
                # var_dump($serviceData);
            }
        }
    } elseif( $url_data[1] == "transfertobank" && isset($url_data[2]) ) {
        /*$updatePayment = "SELECT * FROM ".TABLE_USER_PAYMENT."
                WHERE ui = {$sessionUserId} AND id = {$url_data[2]}
                AND pm = 4 AND ps=1 ORDER BY id DESC LIMIT 0,1 ";
        $rowUpdatePayment = $db->db_array($updatePayment);
        if( $rowUpdatePayment ) {

        }*/

        $rowUpdatePayment["content"] = $informationConfig["config"]["paymentcontent"]["tranfer"][$langcode];
        $isPageNotFound = false;


    } elseif($url_data[1] == "cashondelivery" && isset($url_data[2]) ) {
        $rowUpdatePayment["content"] = $informationConfig["config"]["paymentcontent"]["cod"][$langcode];
        $isPageNotFound = false;
    }

    $rowUpdatePayment["id"] = $url_data[2];

    $file   = FOLDERUSER.$sessionUserId.".xml";

    if (is_file($file) && $serviceData &&  $isUpdateUserStatus) {
        #update user status AND dayleft job left
        $fileinfo = simplexml_load_file($file);
        $information = json_encode($fileinfo);
        $information = json_decode($information, true);

        $dayleft = isset($information["userinfo"]["db"]["dayleft"]) ? $information["userinfo"]["db"]["dayleft"] : 0;

        $jobLeftCurrent = isset($information["userinfo"]["db"]["jobleft"]) ? $information["userinfo"]["db"]["jobleft"] : 0;

        $jobLeftPlus = isset($serviceData[0]["job"])? $serviceData[0]["job"] : 3;

        $status = isset($information["userinfo"]["db"]["status"]) ? $information["userinfo"]["db"]["status"] : 1;
        $status = isset($serviceData[0]["category"])? $serviceData[0]["category"] : $status;

        if($serviceData[0]["category"] >= $status && $dayleft > $currentTime) {
            $dayleft += $serviceData[0]["day"]*(60*60*24);
        }
        else {
            $dayleft = $currentTime + $serviceData[0]["day"]*(60*60*24);
        }

        $user_update["dayleft"] = $dayleft;
        $user_update["jobleft"] = $jobLeftCurrent + $jobLeftPlus;;
        $user_update["status"] = $status;
        $user_update["page"] = isset($serviceData[0]["page"])? $serviceData[0]["page"]:1;

        if( $status == $unlimitedStatus ) {
            $user_update["jobleft"] = 0;
        }

        if ($db->db_update($user_update, TABLE_USER, array("id" => $sessionUserId))) {
            $information["userinfo"]["db"]["dayleft"] = $user_update["dayleft"];
            $information["userinfo"]["db"]["jobleft"] = $user_update["jobleft"];
            $information["userinfo"]["db"]["status"] = $user_update["status"];
            $information["userinfo"]["db"]["page"] = $user_update["page"];

            $_SESSION["userlog"]["status"] = $user_update["status"];
            $_SESSION["userlog"]["dayleft"] = $user_update["dayleft"];
            $_SESSION["userlog"]["page"] = $user_update["page"];
            saveXMLFile($file, $information);

            $isPageNotFound = false;
        }
    }
}

if($isPageNotFound) {
    require dirname(__FILE__) . '/../general/user_page_not_found.php';
}

else {
    function main() {
        global $seo_name, $language, $langcode, $rowUpdatePayment, $informationConfig;
        
        require dirname(__FILE__) . "/../../views/employer/payment/user_page_checkout_action.php";
        
    }
}
