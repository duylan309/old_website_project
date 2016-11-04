<?php

if(isset($_SESSION["userlog"])) {
    unset($_SESSION["userlog"]);
    unset($_SESSION["optionService"]);
    unset($_SESSION["signupWithPromocode"]);
    unset($_SESSION["adminlog"]);

    if(isset($_COOKIE[COOKIENAME])){

    	unset($_COOKIE[COOKIENAME]);
    	$time = time()- 60*60*24*365;

        setcookie(COOKIENAME, '', $time, "/", COOKIEDOMAIN,TRUE,TRUE);
    }
    
}
$code = 200;
$message = $language["updateSuccess"];
?>
