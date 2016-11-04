<?php
function main(){
    global $language, $userInfoPage, $infoJob, $sessionUserId, $jid, $db, $userInfoPage, $seo_name;
       
        $strElmData = "{\"seeker\":\"1\", \"type\":\"2\"}";
        
        if($sessionUserId){
            echo '<span data-goto-link data-url="/"></span>';
        }

    // CALL VIEW 
    require dirname(__FILE__) . "/../../views/general/user_register.php";

}




                    