<?php
$uid = isset($post["db"]["uid"]) ? $post["db"]["uid"] : null;
$isUpdate = true;

if ($sessionUserId  && isset($post["updateNode"])) {
    $nodeUpdate = $post["updateNode"];

    if($nodeUpdate == "db") {
        if(!isset($post[$nodeUpdate])) {
            die();
        }

        $infoUpdate = $post[$nodeUpdate];
        $iId = isset($post["db"]["id"]) ? $post["db"]["id"] : null;
        if($iId) {
            #update DB
            if(isset($infoUpdate["password"])) {
                $infoUpdate["password"] = md5($infoUpdate["password"]);
            }
            if ($db->db_update($infoUpdate, TABLE_USERSUB, array("id"=>$iId ))) {
                $message = $language["updateSuccess"];
            } else {
                $isUpdate = false;
                $errors = "updateErrors";
            }
        } else {
            #insert DB
            $infoUpdate["created"] = $currentTime;
            $infoUpdate["password"] = md5($infoUpdate["password"]);
            if ($db->db_insert($infoUpdate, TABLE_USERSUB)) {
                $message = $language["insertSuccess"];
            } else {
                $isUpdate = false;
                $errors = $language["insertErrors"];
            }
        }

    } elseif( $nodeUpdate == "checkcid") {
        $id = isset($post["db"]["id"]) ? $post["db"]["id"] : null ;
        if($id) {
            $strQuery = "SELECT * FROM ".TABLE_USERSUB." WHERE id != {$id} AND cid = {$post["cid"]} LIMIT 0,1";
        } else {
            $strQuery = "SELECT * FROM ".TABLE_USERSUB." WHERE cid = {$post["cid"]} LIMIT 0,1";
        }

        if($db->db_array($strQuery)) {
            $code = 201;
            $errors = $strQuery;
        } else {
            $code = 200;
            $message=$strQuery;
        }

    } elseif( $nodeUpdate == "password") {

        $infoUpdate = $post[$nodeUpdate];

        $id = isset($post["db"]["id"]) ? $post["db"]["id"] : null;

        if(!$id)
        {
            die();
        }

        $isOldPassword = false;
        $strQuery  = "SELECT id, password FROM ".TABLE_USERSUB." WHERE id={$id}";
        $row = $db->db_array($strQuery);

        if($row && $row["password"] == md5($infoUpdate["passwordOld"]) ) {
            $row["password"] = md5($infoUpdate["passwordNew"]);
            if( $db->db_update($row, TABLE_USERSUB, array("id" => $id) ) ) {
                $isOldPassword = true;
            }
        }

        if($isOldPassword == true) {
            $code = 200;
            $message = $language["passwordChangeSuccess"];
        }
        else {
            $code = 201;
            $message = $language["passwordDonotChange"];
        }
    }
    else {
        $isUpdate = false;
    }

} else {

    $nodeUpdate = $post["updateNode"];

    if($nodeUpdate == "signin"){
        if( isset($post["password"]) && isset($post["username"]) && isset($post["cid"]) ) {
            $password = md5($post["password"]);
            $cid = $post["cid"];
            $username = $post["username"];
            $strQuery = "SELECT c.*, u.id AS subid, u.uid AS uid, u.username AS username, u.name AS subname
                FROM ".TABLE_USERSUB." AS u, ".TABLE_COMPANY." AS c
                WHERE c.id = u.cid AND username='{$username}' AND u.password='{$password}' AND u.cid = {$cid} LIMIT 0,1";
            # echo $strQuery;
            $rowUsersub = $db->db_array($strQuery);
            if($rowUsersub) {
                #session for main user + subuser;
                $str_query = "SELECT id, email, username, name, im, gender, dob, fb_load_newfeed, fb_load_photo, deactive, is_newletter, type, status, created, dayleft, jobleft, page
                FROM ".TABLE_USER."
                WHERE id={$rowUsersub["uid"]} LIMIT 0,1";
                $rowUser = $db->db_array($str_query);
                if ($rowUser) {
                    $_SESSION["userlog"] = $rowUser;
                    $_SESSION["usersub"] = $rowUsersub;
                    $message = "Login in success";
                    $code = 200;
                    $dataResponse = array("urlRedirect" => "/".$seo_name["page"]["user"].'?manage=jobs');
                } else {
                    $errors = $language["loginError"];
                    $code = 401;
                }
            } else {
                $errors = $language["loginError"];
                $code = 401;
            }
        }

    } else {
        $errors = "missing session";
        $code = 401;
    }
}
?>
