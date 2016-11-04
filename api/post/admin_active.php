<?php
if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    $mod = isset($post["mod"]) ? $post["mod"] : null;
    $isUpdate = false;
    $unlimitedStatus = 3;
    $permission = isset($_SESSION["adminlog"]["permission"]) ? $_SESSION["adminlog"]["permission"] : 0;
    $admin_id = $_SESSION["adminlog"]["id"];

    if($mod == "checkout") {
        if(isset($post["db"]["ai"]) && $post["db"]["ai"] == $admin_id ) {
            #get order
            $iId = $post["db"]["id"];
            $strQueryGetOrder = "SELECT * FROM ".TABLE_USER_PAYMENT." WHERE id={$iId} AND ps < 5";
            $rowDetail = $db->db_array($strQueryGetOrder);
            if ($rowDetail) {
                if($db->db_update($post["db"], TABLE_USER_PAYMENT, array("id"=>$iId) ) ) {

                    $updateUid = $rowDetail["ui"];
                    if( $post["db"]["ps"] == 5 ) {
                        #update info and set dayleft jobleft
                        $serviceData  = arrSearch ( $language["service"], "id=={$rowDetail["si"]}" );

                        $file   = FOLDERUSER.$updateUid.".xml";
                        if (is_file($file) && $serviceData) {
                            #update user status AND dayleft job left
                            $fileinfo = simplexml_load_file($file);
                            $information = json_encode($fileinfo);
                            $information = json_decode($information, true);

                            $dayleft = isset($information["userinfo"]["db"]["dayleft"]) ? $information["userinfo"]["db"]["dayleft"] : 0;
                            $jobLeftCurrent = isset($information["userinfo"]["db"]["jobleft"]) ? $information["userinfo"]["db"]["jobleft"] : 0;
                            $jobLeftPlus = isset($serviceData[0]["job"])? $serviceData[0]["job"] : 3;
                            $status = isset($information["userinfo"]["db"]["status"]) ? $information["userinfo"]["db"]["status"] : 1;

                            $status = isset($serviceData[0]["category"])? $serviceData[0]["category"] : $status;


                            if($serviceData[0]["category"] >= $status && $dayleft > $currentTime) {
                                $dayleft += $serviceData[0]["day"]*(60*60*24);
                            }
                            else {
                                $dayleft = $currentTime + $serviceData[0]["day"]*(60*60*24);
                            }

                            $user_update["dayleft"] = $dayleft;
                            $user_update["jobleft"] = $jobLeftCurrent + $jobLeftPlus;;
                            $user_update["status"] = $status;
                            $user_update["page"] = isset($serviceData[0]["page"])? $serviceData[0]["page"]:1;

                            if( $status == $unlimitedStatus ) {
                                $user_update["jobleft"] = 0;
                            }

                            if ($db->db_update($user_update, TABLE_USER, array("id" => $updateUid))) {
                                $information["userinfo"]["db"]["dayleft"] = $user_update["dayleft"];
                                $information["userinfo"]["db"]["jobleft"] = $user_update["jobleft"];
                                $information["userinfo"]["db"]["status"] = $user_update["status"];
                                $information["userinfo"]["db"]["page"] = $user_update["page"];
                                saveXMLFile($file, $information);
                            }
                        }
                    } else {
                        #update info
                    }
                    $code = 200;
                    $message = "update success";
                }
            } else {
                $code = 201;
                $errors = "do not update";
            }

            # echo $strQueryGetOrder;
            #update status order
        }
    } elseif($mod == "lockaccount") {
        if(isset($post["db"]["uid"]) && isset($post["db"]["deactive"])) {
            
            $arrayUpdate = array("deactive"=>$post["db"]["deactive"]);
            
            $uid = $post["db"]["uid"];
            
            if ($db->db_update($arrayUpdate, TABLE_USER, array("id" =>$uid ))) {
                $file = FOLDERUSER.$uid.".xml";
                if( is_file($file) ) {
                    #update node deactive for user
                    $fileinfo = simplexml_load_file($file);
                    $information = json_encode($fileinfo);
                    $information = json_decode($information, true);
                    $information["userinfo"]["db"]["deactive"] = $post["db"]["deactive"];
                    saveXMLFile($file, $information);

                    $code = 200;
                    $message = "Update success";
                }
            }
        }
    } elseif($mod == "manager") {
        if(isset($post["db"]) ) {
            $post["db"]["password"] = md5($post["db"]["password"]);
            $arrayUpdate = $post["db"];
            if(isset($post["db"]["id"]) && $post["db"]["id"]) {
                #update database
                if ($db->db_update($arrayUpdate, TABLE_USER_MANAGER, array("id" => $post["db"]["id"]))) {
                    $isUpdate = true;
                }
            } else {
                #insert database
                if($db->db_insert($arrayUpdate, TABLE_USER_MANAGER));
            }

            $code = 200;
            $message = "Update success";
        }
    } elseif($mod == "removemanager") {
        if(isset($post["uid"]) && isset($post["id"]) && $post["uid"]) {
            $db->db_delete(TABLE_USER_MANAGER, array("id"=>$post["id"], "user_id"=>$post["uid"]));
            $code = 200;
            $message = "delete success";
        }
    } elseif($mod == "password") {

        $uid = $post["db"]["user_id"];
        $id = $post["db"]["id"];
        $oldPassword = isset($post["password"]["passwordOld"]) ? $post["password"]["passwordOld"] : null;
        $strQuery = "SELECT * FROM ".TABLE_USER_MANAGER. " WHERE id = {$id} AND user_id = {$uid} AND password ='".md5($oldPassword)."'";

        $row = $db->db_array($strQuery);
        if($row) {
            $post["db"]["password"] = md5( $post["password"]["passwordConfirm"] );
            if ($db->db_update($post["db"], TABLE_USER_MANAGER, array("id" => $id, "user_id" => $uid ))) {
                $isUpdate = true;
                $code = 200;
                $message = "New Password was updated";
            }
        } else {
            $code = 201;
            $errors = "Old Password was wrong";
        }

    }
}
?>
