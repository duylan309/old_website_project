<?php
$uid = isset($post["db"]["id"]) ? $post["db"]["id"] : null;

if ($uid && $sessionUserId == $uid  && isset($post["updateNode"])) {
    $file = FOLDERUSER . "$uid.xml";
    $row_update = null;
    $is_newletter = isset($post["db"]["is_newletter"]) ? 1 : 0;
    $is_received_email = isset($post["db"]["is_received_email"]) ? 1 : 0;
    if (is_file($file)) {
        $readXML = simplexml_load_file($file);
        $information = json_encode($readXML);
        $information = json_decode($information, true);

        $nodeUpdate = $post["updateNode"];
        if(!isset($post[$nodeUpdate])) {
            die();
        }
        $infoUpdate = $post[$nodeUpdate];

        # update db_update
        if($nodeUpdate == "db") {
            $post["db"]["is_newletter"] = $is_newletter;
            $post["db"]["is_received_email"] = $is_received_email;
            # do not update email
            # unset($post["db"]["email"]);
            if(isset($post["db"]["type"])) {
                unset($post["db"]["type"]);
            }

            $post["db"]["fb_load_newfeed"] = isset($post["db"]["fb_load_newfeed"]) ? $post["db"]["fb_load_newfeed"] : 1;
            $post["db"]["fb_load_photo"]   = isset($post["db"]["fb_load_photo"])   ? $post["db"]["fb_load_photo"] : 1;

            # get currentUsername
            $currentUsername = isset($information["userinfo"]["db"]["username"]) ? $information["userinfo"]["db"]["username"] : null;

            $row_update = $post["db"];


            if(isset($row_update["category"]) ) {
                $row_update["category"] = implode(',', $row_update["category"]);
            }

            $row_update["city"] = isset($row_update["city"]) ? intval($row_update["city"]) : null;

            if(isset($row_update["city"]) && isset($row_update["country"]) && !empty($row_update["city"]) && !empty($row_update["country"])){
                try{

                    if($row_update["country"] === "vn"){
                        $fileCity_vi =  dirname(__FILE__) . '/../get/country/'.$row_update["country"].'_vi.php';
                        $fileCity_en =  dirname(__FILE__) . '/../get/country/'.$row_update["country"].'_en.php';

                        if(is_file($fileCity_vi)) {
                            require $fileCity_vi;
                            $row_update["city_text_vi"] = arrSearch($cityArray, "id=={$row_update["city"]}" )[0]["ti"];
                            unset($cityArray);
                        }

                        if(is_file($fileCity_en)) {
                            require $fileCity_en;
                            $row_update["city_text_en"] = arrSearch($cityArray, "id=={$row_update["city"]}" )[0]["ti"];
                            unset($cityArray);
                        }


                    }else{
                        $fileCity =  dirname(__FILE__) . '/../get/country/'.$row_update["country"].'.php';

                        if(is_file($fileCity)) {
                            require $fileCity;
                            $row_update["city_text_en"] = arrSearch($cityArray, "id=={$row_update["city"]}" )[0]["ti"];
                            $row_update["city_text_vi"] = arrSearch($cityArray, "id=={$row_update["city"]}" )[0]["ti"];

                        }
                    }


                    #LAT - LNG
                    if(isset($row_update["address"]) && count($row_update["address"])){
                        $copy_address = $row_update["address"].','.$row_update["city_text_vi"];

                        $address_google = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($copy_address));
                        $get_json = json_decode($address_google);

                        if(isset($get_json->status) && $get_json->status == "OK"){
                            $row_update["lat"] = $get_json->results[0]->geometry->location->lat;
                            $row_update["lng"] = $get_json->results[0]->geometry->location->lng;
                        }
                    }

                } catch (Exception $ex) {
                   $code = 501;
                   $errors = $language["updateErrors"];
                }

            }

            if(isset($post["db"]["year"]) && isset($post["db"]["month"]) && isset($post["db"]["day"])):
                $row_update["dob"] = $post["db"]["year"].'-'.$post["db"]["month"].'-'.$post["db"]["day"];
            endif;
           
            foreach ($row_update as $key => $value) {
                $information["userinfo"]["db"][$key] = $value;
            }

            unset($row_update["day"]);
            unset($row_update["month"]);
            unset($row_update["year"]);

            if ($row_update) {
                $isUpdate = false;
               
                if(isset( $row_update["username"]) && $currentUsername !== $row_update["username"]) {
                   
                    #check username and update username into user
                    $newUsername = $row_update["username"];

                    $strQueryUsername = "SELECT id, username, user_id FROM ".TABLE_USER_NAME."
                            WHERE user_id = '{$uid}' LIMIT 0,1";

                    $itemUsername = $db->db_array($strQueryUsername);

                    #check init username of user
                    if($itemUsername) {
                       
                        #update new username
                        $arrayUpdate = array("user_id"=>$uid, "username"=>$newUsername);
                        if ($db->db_update($arrayUpdate, TABLE_USER_NAME, array("id" => $itemUsername["id"]))) {
                            
                            if ($db->db_update($row_update, TABLE_USER, array("id" => $uid))) {
                                $isUpdate = true;
                                # saveXMLFile($file, $information);
                            }
                        
                        }
                        else {
                            $code = 201;
                            $message = $language["usernameNotAvailable"];
                        }
                    }
                    else {
                        #insert new username
                        $arrayInsert = array("id"=>NULL, "user_id"=>$uid, "username"=>$newUsername);
                        if($db->db_insert($arrayInsert , TABLE_USER_NAME)) {
                            
                            if ($db->db_update($row_update, TABLE_USER, array("id" => $uid))) {
                                $isUpdate = true;
                                # saveXMLFile($file, $information);
                            }
                        
                        }

                        $code = 200;
                        $message = $language["updateSuccess"];
                    }
                }
                else {

                    if ($db->db_update($row_update, TABLE_USER, array("id" => $uid))) {

                        $isUpdate = true;

                   #     saveXMLFile($file, $information);

                    } else {
                        $code = 201;
                        $errors = $language["updateErrors"];
                    }
                }

                if(isset($post["refertable"]) && isset($post[$post["refertable"]]) ) {

                    $strReferTable = $post["refertable"];

                    $referNode = $post[$strReferTable];

                    if(isset($referNode["db"])) {

                        if(isset($referNode["db"]["category"]) ) {
                            $referNode["db"]["category"] = implode(',', $referNode["db"]["category"]);
                        }

                        if(isset($referNode["db"]["location"])) {
                            $referNode["db"]["location"] = implode(',', $referNode["db"]["location"]);
                        }

                        if(isset($referNode["db"]["level"]) ) {
                            $referNode["db"]["level"] = implode(',', $referNode["db"]["level"]);
                        }

                         if(isset($referNode["db"]["lang"]) ) {
                            $referNode["db"]["lang"] = implode(',', $referNode["db"]["lang"]);
                        }

                        if(isset($referNode["db"]["type"]) ) {
                            $referNode["db"]["type"] = implode(',', $referNode["db"]["type"]);
                        }

                        if(isset($referNode["db"]["s1"])) {
                            $strSalary = str_replace(',','', $referNode["db"]["s1"]);
                            $strSalary = str_replace('.','', $referNode["db"]["s1"]);
                            $referNode["db"]["s1"] = intval($strSalary);
                        }

                        if(isset($referNode["db"]["salary"]) && $referNode["db"]["salary"] == 2 ) {
                            $referNode["db"]["s2"] = intval($referNode["db"]["s1"])*EXCHANGECURRENCY;
                        }
                        elseif(isset($referNode["db"]["s2"]) && isset($referNode["db"]["s1"])) {
                            $referNode["db"]["s2"] = intval($referNode["db"]["s1"])/EXCHANGECURRENCY;
                        }

                        if($db->db_insert($referNode["db"] , $strReferTable)) {
                     
                            $information[$strReferTable] = $referNode;
                     
                        } elseif($db->db_update($referNode["db"], $strReferTable, array("ui" => $referNode["db"]["ui"]))) {

                            #update row referTable
                            foreach ($referNode["db"] as $key => $value) {
                                $information[$strReferTable]["db"][$key] = $value;
                            }

                        }
                    }
                }
                
                if($isUpdate) {
                    if(saveXMLFile($file, $information)){
                        if($_SESSION["userlog"]["type"] ==2){
                            $readXML = simplexml_load_file($file);
                            $information = json_encode($readXML);
                            $information = json_decode($information, true);
                            require dirname(__FILE__) . "/action/candidate_get_missing_cv_info.php";
                        }
                    }
                    
                    
                
                }

            }

        } elseif($nodeUpdate == "experience"){
            
            $listDetail = isset($information[$nodeUpdate]) ? $information[$nodeUpdate]:null;

            if(isset($post[$nodeUpdate]["del"]) && $post[$nodeUpdate]["del"]) {
              
                $strNode = $post[$nodeUpdate]["del"];
               
                if( $db->db_delete(TABLE_USER_WORK_HISTORY, array("id"=>$post[$nodeUpdate]["del"], "user_id"=>$post['db']["id"]))){
                
                    unset($information[$nodeUpdate]["n_{$strNode}"]);
                    saveXMLFile($file, $information);
               
                }else{
                    die();
                }
                
            
            }else{
                #add update experience and education
                $nodeId = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

                $post_exp['city']         = $nodeId['city']; 
                $post_exp['country']      = $nodeId['country']; 
                $post_exp['company_name'] = $nodeId['cmpname']; 
                $post_exp['title']        = $nodeId['title']; 
                $post_exp['level']        = $nodeId['level']; 
                $post_exp['from_year']    = $nodeId['from']; 
                $post_exp['to_year']      = $nodeId['to']; 
                $post_exp['user_id']      = $post['db']['id']; 

                if($nodeId) {

                    $strNode = 1;
                  
                    if(isset($nodeId["id"]) && $nodeId["id"] && count($nodeId['id']) ) {
                       
                        if($db->db_update($post_exp,TABLE_USER_WORK_HISTORY,array("id"=>$nodeId["id"]))){
                             $strNode = $nodeId["id"];
                        }else{
                            die();
                        }

                    } elseif ($listDetail || empty($nodeId['id'])) { # add
                      
                        $new_id = $db->db_insert_return_id($post_exp,TABLE_USER_WORK_HISTORY);
                      
                        if($new_id && $new_id != false){
                            $strNode = $new_id;
                        }
                   
                    }
                    $nodeId["id"] = $strNode;
                    $information[$nodeUpdate]["n_{$strNode}"] = $nodeId;
                    saveXMLFile($file, $information);
                }
            }    


        } elseif( $nodeUpdate == "education") { # add + update experience and education
            
            $listDetail = isset($information[$nodeUpdate]) ? $information[$nodeUpdate] : null;

            if(isset($post[$nodeUpdate]["del"]) && $post[$nodeUpdate]["del"]) {
              
                $strNode = $post[$nodeUpdate]["del"];
               
                if( $db->db_delete(TABLE_USER_EDUCATION_HISTORY, array("id"=>$post[$nodeUpdate]["del"], "user_id"=>$post['db']["id"]))){
                
                    unset($information[$nodeUpdate]["n_{$strNode}"]);
                    saveXMLFile($file, $information);
               
                }else{
                    die();
                }
                
            
            }else{

                # add update experience and education
                $nodeId = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

                $post_exp['school_name']   = $nodeId['school']; 
                $post_exp['degrees']       = $nodeId['degrees']; 
                $post_exp['fieldofstudy']  = $nodeId['fieldofstudy']; 
                $post_exp['from_year']     = $nodeId['from']; 
                $post_exp['to_year']       = $nodeId['to']; 
                $post_exp['user_id']       = $post['db']['id']; 

                if($nodeId) {

                    $strNode = 1;
                  
                    if(isset($nodeId["id"]) && $nodeId["id"] && count($nodeId['id']) ) {
                       
                        if($db->db_update($post_exp,TABLE_USER_EDUCATION_HISTORY,array("id"=>$nodeId["id"]))){
                             $strNode = $nodeId["id"];
                        }else{
                            die();
                        }

                    } elseif ($listDetail || empty($nodeId['id'])) { # add
                      
                        $new_id = $db->db_insert_return_id($post_exp,TABLE_USER_EDUCATION_HISTORY);
                      
                        if($new_id && $new_id != false){
                            $strNode = $new_id;
                        }
                   
                    }
                  
                    $nodeId["id"] = $strNode;
                    $information[$nodeUpdate]["n_{$strNode}"] = $nodeId;
                    saveXMLFile($file, $information);
                }    
            

            }

            
        } elseif($nodeUpdate == "email") { # change received email update
            # add update experience and education

            if(isset($post[$nodeUpdate]["del"]) && $post[$nodeUpdate]["del"]) {
              
                $strNode = $post[$nodeUpdate]["del"];
               
                if( $db->db_delete(TABLE_RECEIVE_EMAIL, array("id"=>$post[$nodeUpdate]["del"], "user_id"=>$post['db']["id"]))){
               
                }else{
                    die();
                }
                
            
            }else{
                #add update experience and education
                $nodeId = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

                $post_email['email']        = $nodeId['email']; 
                $post_email['name']         = $nodeId['name']; 
                $post_email['company_id']   = $nodeId['company_id']; 
                $post_email['user_id']      = $post['db']["id"]; 
                $post_email['status']       = $nodeId['status']; 

                if($nodeId) {

                    $strNode = 1;
                  
                    if(isset($nodeId["id"]) && $nodeId["id"] && count($nodeId['id']) ) {
                       
                        if($db->db_update($post_email,TABLE_RECEIVE_EMAIL,array("id"=>$nodeId["id"]))){
                             $strNode = $nodeId["id"];
                        }else{
                            die();
                        }

                    } elseif (empty($nodeId['id'])) { # add
                      
                        $new_id = $db->db_insert_return_id($post_email,TABLE_RECEIVE_EMAIL);

                        if($new_id && $new_id != false){
                            $strNode = $new_id;
                        }
                   
                    }

                }
            }    


        } elseif($nodeUpdate == "password") { # change password update
            if(!isset($infoUpdate) || !count($infoUpdate) || !isset($infoUpdate["passwordNew"]) || !isset($infoUpdate["passwordOld"]) ) {
                die();
            }
            $isOldPassword = false;


            $strQuery  = "SELECT id, email, password FROM user WHERE id={$uid}";
            $row = $db->db_array($strQuery);
            if($row["password"] == md5($infoUpdate["passwordOld"]) ) {
                $row["password"] = md5($infoUpdate["passwordNew"]);
                if( $db->db_update($row, "user", array("id" => $uid) ) ) {
                    $isOldPassword = true;
                  
                    #update time change password
                    $information["userinfo"][$nodeUpdate]["lastupdate"] = $currentTime;
                    saveXMLFile($file, $information);
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
        elseif(isset($post[$nodeUpdate])) { # update more, not save to database
           
            #update more
            foreach ($post[$nodeUpdate] as $key => $value) {
                $information[$nodeUpdate][$key] = $value;
            }

            saveXMLFile($file, $information);
            $code = 200;
            $message = $language["updateSuccess"];
        }
    }
    if($code > 200) {
        $dataResponse = array();
    }
    else {
        $dataResponse["userinfo"] = $information["userinfo"];
    }
    $message = $message ? $message:$language["updateSuccess"];
} else {
    $code = 401;
    $errors = $language["sessionExpiration"];
}
?>
