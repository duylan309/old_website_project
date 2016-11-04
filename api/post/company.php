<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["ui"]) ? $post["db"]["ui"] : null;

$iId = null;
$information = null;
$isUpdateUrl = true;

$isPermission = 0;

if($uid && $sessionUserId == $uid){
    $isPermission = 100;
}

if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]){
    $isPermission = 100;
}

if ($isPermission == 100 ) {
   
    if(isset($post["db"]["id"]) && $post["db"]["id"]) {
      
        # company file info
        $iId = $post["db"]["id"];
        $file = FOLDERCOMPANY . "{$iId}.xml";

        if (is_file($file)) {
            $information = simplexml_load_file($file);
            $information = json_encode($information);
            $information = json_decode($information, true);
        }
    }

    if($nodeUpdate && $nodeUpdate == "db") {

        if(!isset($post[$nodeUpdate])) {
            die();
        }

        $infoUpdate = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;
       
        # todo reupdate category id to string
        if(isset($infoUpdate["category"]) && count($infoUpdate["category"])) {
            $infoUpdate["category"] = implode(',', $infoUpdate["category"]);
        }

        $infoUpdate["fb_load_newfeed"]  = isset($infoUpdate["fb_load_newfeed"]) ? $infoUpdate["fb_load_newfeed"] : 0;
        $infoUpdate["fb_load_photo"]    = isset($infoUpdate["fb_load_photo"])   ? $infoUpdate["fb_load_photo"]   : 0;
        $information["more"]["about"]   = isset($post["more"]["about"])         ? mysql_real_escape_string($post["more"]["about"])  : '';
       
        #check and update URL
        $currentURL = isset($information["db"]["url"]) ? $information["db"]["url"] : "";

        if( isset($infoUpdate["url"]) && $currentURL != $infoUpdate["url"] ) {
            $dataResponse = array("urlRedirect" => "/{$infoUpdate["url"]}/about");
            
            if($iId) {
                #update URL
                if( $db->db_update(array("url"=>$infoUpdate["url"]), TABLE_URL, array("cid" => $iId, "uid" => $uid) ) ) {

                } else {
                    $isUpdateUrl = false;
                }
            } else {
                $strSelectUrl = "SELECT * FROM ".TABLE_URL." WHERE url='{$infoUpdate["url"]}'";
                $rowUrl = $db->db_array($strSelectUrl);
                if($rowUrl) {
                    $isUpdateUrl = false;
                }
            }
        }
        # end of check and update URL

        if($isUpdateUrl) {

            if(!isset($infoUpdate["lat"]) || $infoUpdate["lat"] == "" || $infoUpdate["lng"] == "" || !isset($infoUpdate['lng']) ){
                try{
                    #LAT - LNG
                    if(isset($infoUpdate["address"]) && count($infoUpdate["address"])){
                        $copy_address = $infoUpdate["address"].', '.$language["locationOption"][$infoUpdate["city"]];
                        $address_google = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($copy_address));
                        $get_json = json_decode($address_google);

                        if(isset($get_json->status) && $get_json->status == "OK"){
                            $infoUpdate["lat"] = $get_json->results[0]->geometry->location->lat;
                            $infoUpdate["lng"] = $get_json->results[0]->geometry->location->lng;
                        }
                        
                    }   

                } catch (Exception $ex) {
                   $code = 501;
                   $errors = $language["unknownErrors"];
                }
            }

            # facebook auto complete controll
            if($infoUpdate['facebookfill'] == 1){

                #get profile picture
                $url_img_facebook = $post["fb"]["im"];
                $name_one         = basename($url_img_facebook);
                $na_question      = explode('.',$name_one);
                $type_img         = explode('?',$na_question[1]);

                $img_rename       = $post["fb"]["facebook_id"].'_'.preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($post['db']['name']))));

                $img_final        = FOLDERIMAGECOMPANY.$img_rename.'.'.$type_img[0];
                $img_final_thumb  = FOLDERIMAGECOMPANY.'thumbnail/'.$img_rename.'.'.$type_img[0];
                
                $infoUpdate["im"] = $img_rename.'.'.$type_img[0]; 

                file_put_contents($img_final,file_get_contents($url_img_facebook));
                file_put_contents($img_final_thumb,file_get_contents($url_img_facebook));

                #get cover picture
                $url_img_banner_facebook = $post["fb"]["im_banner"];
                $name_one_banner         = basename($url_img_banner_facebook);
                $na_question_banner      = explode('.',$name_one_banner);
                $type_img_banner         = explode('?',$na_question_banner[1]);

                $img_rename_banner       = $post["fb"]["facebook_id"].'_'.preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($post['db']['name']))));

                $img_final_banner        = FOLDERIMAGECOMPANY.$img_rename_banner.'-cover.'.$type_img_banner[0];
                $img_final_banner_thumb  = FOLDERIMAGECOMPANY.'thumbnail/'.$img_rename_banner.'-cover.'.$type_img_banner[0];

                $infoUpdate["im_banner"] = $img_rename_banner.'-cover.'.$type_img_banner[0]; 
               
                file_put_contents($img_final_banner,file_get_contents($url_img_banner_facebook));
                file_put_contents($img_final_banner_thumb,file_get_contents($url_img_banner_facebook));
           
            }

            unset($infoUpdate['facebookfill']); # remove delete 

            if(isset($infoUpdate["id"]) && $infoUpdate["id"] ) {

                # update company

                if(isset($_SESSION["usersub"]["id"]) && $_SESSION["usersub"]["id"] !=$infoUpdate["id"]) {
                    die();
                }

                foreach ($infoUpdate as $key => $value) {
                    $information["db"][$key] = $value;
                }

                // add more to db
                $infoUpdate['about'] = isset($post['more']['about']) ? mysql_real_escape_string($post['more']['about']) : '';

                if ($db->db_update($infoUpdate, TABLE_COMPANY, array("id" => $iId, "ui" => $uid))) {
                    $code = 200;
                    $message = $language["updateSuccess"];
                } else {
                    $code = 201;
                    $errors = $language["updateSuccess"];
                }

            }
            else {

                #todo check user allow create new company
                $strQueryCompany = "SELECT * FROM ".TABLE_COMPANY." WHERE ui={$sessionUserId}";
                $yourCompany = $db->db_arrayList($strQueryCompany);
                $totalCompany = count($yourCompany);

                if( $_SESSION["userlog"]["page"] > $totalCompany ) {

                    # insert company
                    $infoUpdate["created"] = $currentTime;
                    
                    if ($db->db_insert($infoUpdate, TABLE_COMPANY)) {
                       
                        $str_query = "SELECT * FROM ".TABLE_COMPANY." WHERE created={$currentTime} AND ui={$uid} ORDER BY id DESC LIMIT 0,1";
                        $row = $db->db_array($str_query);
                        
                        if ($row) {

                            #insert company url
                            $db->db_insert( array("cid" => $row["id"], "uid" => $uid, "url"=>$infoUpdate["url"]), TABLE_URL );

                            #insert location 
                            $post_location["company_id"]    = $row["id"];
                            $post_location["location_name"] = $row["name"];
                            $post_location["address"]       = $post["db"]["address"];
                            $post_location["city"]          = $post["db"]["city"];
                            $post_location["lat"]           = $post["db"]["lat"];
                            $post_location["lng"]           = $post["db"]["lng"];
                            $post_location["ui"]            = $uid;

                            $db->db_insert($post_location, TABLE_COMPANY_LOCATION);

                            $file = FOLDERCOMPANY . "{$row["id"]}.xml";
                            
                            $information = array(
                                "db" => $row,
                            );

                            if(isset($post["more"])) {
                                $information["more"] = $post["more"];
                            }
                
                            $information["companybanner"] = $infoUpdate["im_banner"];

                            $code = 200;
                            $message = $language["insertSuccess"];
                       
                        } else {
                            $code = 401;
                            $errors = $language["insertErrors"];
                        }

                    } else {
                        $code = 402;
                        $errors = $language["insertErrors"];
                    }

                } else {
                    $code = 201;
                    $errors = "do not create page";
                }
            }
        }
        # save to xml (update + add new)
        if( $code == 200 && $file ) {
            saveXMLFile($file, $information);
        } else {
            $dataResponse = $code;
            $code = 403;
        }


    }elseif($nodeUpdate && $nodeUpdate == "location") {

        $infoUpdateLocation["lat"]              = isset($post[$nodeUpdate]["lat"]) ? $post[$nodeUpdate]["lat"] :'';
        $infoUpdateLocation["lng"]              = isset($post[$nodeUpdate]["lng"]) ? $post[$nodeUpdate]["lng"] :'';
        $infoUpdateLocation["company_id"]       = isset($post[$nodeUpdate]["company_id"]) ? $post[$nodeUpdate]["company_id"] : '';
        $infoUpdateLocation["address"]          = isset($post[$nodeUpdate]["address"]) ? $post[$nodeUpdate]["address"] : '';
        $infoUpdateLocation["city"]             = isset($post[$nodeUpdate]["city"]) ? $post[$nodeUpdate]["city"] : '';
        $infoUpdateLocation["location_name"]    = isset($post[$nodeUpdate]["location_name"]) ? $post[$nodeUpdate]["location_name"] : '';
        $infoUpdateLocation["ui"]               = $uid;

        $del = isset($post[$nodeUpdate]["del"]) && count($post[$nodeUpdate]["del"]) ? $post[$nodeUpdate]["del"] : 0;

        if(isset($post[$nodeUpdate]["id"]) && $post[$nodeUpdate]["id"] && $del == 0 ) {

            if ($db->db_update($infoUpdateLocation, TABLE_COMPANY_LOCATION, array("id" => $post[$nodeUpdate]["id"], "ui" => $uid))) {
                $code = 200;
                $message = $language["updateSuccess"];
            } else {
                $code = 402;
                $errors = $language["updateErrors"];
            }

        }elseif($del !=0 ){
            
           if($db->db_delete_where(TABLE_COMPANY_LOCATION, array(  "id"=>$del,"company_id"=>intval($infoUpdateLocation["company_id"]),"ui"=>$uid) )){
               $code = 990;
               $message = $language["updateSuccess"];
           }else{
               $code = 999;
               $errors = $language["updateErrors"];
           } 

        }else{
           
            if ($db->db_insert($infoUpdateLocation, TABLE_COMPANY_LOCATION)) {
               
                $code = 200;
                $message = $language["insertSuccess"];
               
            } else {
                
                $code = 402;
                $errors = $language["insertErrors"];
            
            }
        }

    }elseif(isset($post[$nodeUpdate]) && $information ) {

        #update more

        foreach ($post[$nodeUpdate] as $key => $value) {
            $information[$nodeUpdate][$key] = $value;
        }


       // saveXMLFile($file, $information);
        $code = 200;
        $message = $language["updateSuccess"];
    }
}
else {
    die();
}

?>
