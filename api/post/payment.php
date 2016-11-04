<?php
$isSuccessPost = false;

if(isset($post["db"]["ui"]) && $post["db"]["ui"] == $sessionUserId) {
    $insertData = $post["db"];
    $insertData["cr"] = $currentTime;

    if(isset($insertData["pm"]) && $insertData["pm"]==5) {
        # Check Cash On Delivery And save content to note
        if(isset($post["cod"])) {
            $insertData["no"] = implode(' - ', $post["cod"]);
        }
    }

    if($db->db_insert($insertData, TABLE_USER_PAYMENT)) {
        # update somthing
        $payMethod =  $insertData["pm"];

        $strRowJustInsert = "SELECT * from ".TABLE_USER_PAYMENT." WHERE ui = {$sessionUserId}
                            AND si = {$insertData["si"]}
                            AND pm = {$insertData["pm"]}
                            AND cr = {$insertData["cr"]}
                            ORDER BY id DESC LIMIT 0,1 ";

        $getRowJustInsert = $db->db_array($strRowJustInsert);

        if($getRowJustInsert) {
            $orderAmt = isset($insertData["am"])?$insertData["am"]:0;
            $orderTitle = "service id # {$insertData["si"]}";
            $orderMore = "service id # {$insertData["si"]}";
            $strPayFile = dirname(__FILE__)."/paymentmethod/{$payMethod}/checkout.php";
            if(is_file($strPayFile)) {
                require $strPayFile;
            }
        }
        #$isSuccessPost = true;
    }
}

if(! $isSuccessPost) {
    $code = $code ? $code : 404;
    $errors = "invalidate payment method";
}

?>
