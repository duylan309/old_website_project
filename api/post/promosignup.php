<?php
$isPromocode = null;
if(isset($post["db"]["code"])) {
    $strQuery = "SELECT * FROM ".TABLE_PROMO." WHERE code='{$post["db"]["code"]}' AND status=2 LIMIT 0,1";
    $row = $db->db_array($strQuery);
    if($row) {
        $isPromocode = true;
        $serviceData  = arrSearch ( $language["service"], "id=={$row["service_id"]}" );
        if(isset($serviceData[0])) {
            $serviceData[0]["promo_id"] = $row["id"];
            $serviceData[0]["promo_code"] = $row["code"];
        }
        $_SESSION["signupWithPromocode"] = $serviceData ? $serviceData[0] : null;
    }
}
if($isPromocode) {
    $code = 200;
} else {
    $code = 201;
    $errors = $language["promocodeErrors"];
}
?>
