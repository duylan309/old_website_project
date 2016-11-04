<?php
require dirname(__FILE__) . "/PayPal.class.php";
$paypalAPICredentials = isset($paymentSetting["paypal"]) ? $paymentSetting["paypal"] : null ;
$username = isset($paypalAPICredentials["username"]) ? $paypalAPICredentials["username"] : '124phn-facilitator_api1.gmail.com';
$password = isset($paypalAPICredentials["password"]) ? $paypalAPICredentials["password"] :'87U9LFTHUSG3PDU9' ;
$signature = isset($paypalAPICredentials["signature"]) ? $paypalAPICredentials["signature"] :'AiPC9BjkCyDFQXbSkoZcgqH3hpacAdI2Fak8rEJFnWkIEsdpYtUFYpI7';

$environment = "LIVE";
if(isset($paypalAPICredentials["sandbox"]) && $paypalAPICredentials["sandbox"] ) {
    $environment = "SANDBOX";
}

$paypal = new PayPal($environment, $username, $password, $signature);

#exchange currency to USD
$orderAmt = $orderAmt/20000;

// Set the return/cancel URL
$url = "http://{$_SERVER['HTTP_HOST']}/{$seo_name["page"]["checkout"]}/paypal/{$getRowJustInsert["id"]}";
// Add some items to the transaction
$paypal->addItem($orderTitle, $orderMore, $orderAmt, 1);
$paypal->setCurrencyCode('USD');

// Initiate an Express Checkout transaction
$vpcURL = $paypal->setExpressCheckout($url, $url);

$paypalResponse = isset($paypal->response)? $paypal->response : null;
if(isset($paypalResponse["TOKEN"]) && $paypalResponse["TOKEN"] ) {
    #update TOKEN to user_payment
    $db->db_update(array("token"=>$paypalResponse["TOKEN"]), TABLE_USER_PAYMENT, array("id" => $getRowJustInsert["id"]));

    # var_dump($vpcURL);
    if($vpcURL) {
        $isSuccessPost = true;
        $code = 200;
        $message = '<img src="/img/style/ajax-loader.gif" class="img-payment"/>';
        $dataResponse = array("urlRedirect" => $vpcURL);

    } else {
        $code = 201;
        $message = 'invalidate authorization paypal';
    }
    # https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=EC-6HK91804HU732653E
}

