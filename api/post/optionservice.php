<?php
if(isset($post["update"])) {
    $serviceData  = arrSearch ( $language["service"], "id=={$post["update"]}" );
    $_SESSION["optionService"] = $serviceData ? $serviceData[0] : null;
}
else {
    $code = 401;
}
?>
