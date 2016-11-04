<?php
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    if(isset($post["db"])) {
        if(isset($post["db"]["id"]) && $post["db"]["id"]) {
            #Update Promo Code

            if ($db->db_update($post["db"], TABLE_PROMO, array("id" => $post["db"]["id"])) ) {
                $code = 200;
                $message = $language["updateSuccess"];
            }
        } else {
            #Create new Promocode
            /*$post["db"]["created"] = $currentTime;
            if ($db->db_insert($post["db"], TABLE_PROMO)) {
                $code = 200;
                $message = $language["insertSuccess"];
            }*/
            if(isset($post["db"]["number"])) {
                $n = intval($post["db"]["number"]) > 100 ? 100 : intval($post["db"]["number"]) ;
                $strInsertPromo = array();
                for($i=0; $i<$n; $i++) {
                    $strCode = generateRandomString(30);
                    $strInsertPromo[]= " ('{$strCode}', {$post["db"]["service_id"]}, {$currentTime}, 1,'{$post["db"]["note"]}') ";
                }

                $db->db_query( "INSERT INTO ".TABLE_PROMO." (`code`,`service_id`,`created`,`status`,`note`) VALUES ".implode(',', $strInsertPromo));

                # echo "INSERT INTO ".TABLE_PROMO." (`code`,`service_id`,`created`,`status`) VALUES ".implode(',', $strInsertPromo);
                $code = 200;
                $message = $language["insertSuccess"];
            }
        }
    }
} else {
    # missing session
    $errors = $language["sessionExpiration"];
    $code = 401;
}

?>
