<?php
if(!isset($url_data[3])) {
    die();
}

if(!$url_data[3]) {

}

else {

    $uid = intval($url_data[3]);
    $file   = FOLDERUSER.$uid.".xml";

    /*if(!isset($_SESSION["userlog"]["id"]) || $_SESSION["userlog"]["id"] != $uid || !is_file($file)){
        die();
    }*/

    if(!isset($_SESSION["userlog"]["id"]) || !is_file($file)){
        die();
    }

    # kiem tra xem user nay da apply job cua uid nay roi phai k
    // if($_SESSION["userlog"]["id"] != $uid && !isset($_SESSION["adminlog"]) ) {
    //     die();
    // }

    $fileInfo = simplexml_load_file($file);
    $information = json_encode($fileInfo);
    $information = json_decode($information, true);

    if(!isset($url_data[3]) || !$url_data[3] || isset($url_data[4]) ){
        $dataResponse = array();
       
        if(isset($url_data[5])) {
            $dataResponse = $information[$url_data[4]]["n_{$url_data[5]}"];
        } elseif(isset($information[$url_data[4]])) {
            foreach ($information[$url_data[4]] as $key => $value) {
                array_push($dataResponse, $value);
            }
        }
    
    } else {
        
        if(isset($_SESSION["adminlog"]) && count($_SESSION["adminlog"])) {
            $information["adminlog"] = $_SESSION["adminlog"];
        }

        if( isset($information["userinfo"]["db"]["dayleft"]) ) {
            $information["userinfo"]["db"]["dayleftshow"] = round( ($information["userinfo"]["db"]["dayleft"] - time())/(3600*24) ) + 1;
            if($information["userinfo"]["db"]["dayleftshow"]<0) {
                unset($information["userinfo"]["db"]["dayleftshow"]);
            }
        }

        if(isset($_SESSION["usersub"]) && $_SESSION["usersub"]) {
            # $information["usersub"] = $_SESSION["usersub"];
            # get latest data
            $strQuery = "SELECT c.*, u.id AS subid, u.uid AS uid, u.username AS username, u.name AS subname
                FROM ".TABLE_USERSUB." AS u, ".TABLE_COMPANY." AS c
                WHERE c.id = u.cid AND u.id = {$_SESSION["usersub"]["subid"]} LIMIT 0,1";
            $information["usersub"] = $db->db_array($strQuery);
        }

        $dataResponse = $information;
        $code = 200;
    }
}

if(!isset($url_data[4])) { # todo recheck
    if(isset($_SESSION["signupWithPromocode"])) {
        $dataResponse["optionService"] = $_SESSION["signupWithPromocode"];
    }
    elseif(isset($_SESSION["optionService"])) {
        $dataResponse["optionService"] = $_SESSION["optionService"];
    }
}


?>
