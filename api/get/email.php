<?php

if(!isset($url_data[3])) {
    die();
}

if(!$url_data[3]) {
}else {

    $uid = intval($url_data[3]);
    $email_id = isset($url_data[4]) && count($url_data[4]) ? intval($url_data[4]) : 0;
    if($uid && $uid != 0){
        
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY em.id DESC ";

        if($email_id != 0){
            $strWhere = " AND em.id = {$email_id} ";
        }

        $strQuery   =  "SELECT id,user_id,email,name,status,company_id
                        FROM ".TABLE_RECEIVE_EMAIL." AS em
                        WHERE em.user_id = {$uid} {$strWhere} {$strOrder}";

        # echo $strQuery;
        $code = 200;
        if($email_id != 0 ){
            $dataResponse = $db->db_array($strQuery);
        }else{
            $dataResponse = $db->objJson($strQuery);
        }
    }else{
        die();
    }
   
}
?>
