<?php
$uid = isset($post["uid"]) ? $post["uid"] : null;

$iId = null;
$information = null;

if ($uid && $sessionUserId == $uid ) {
   
        if(isset($post["companyId"]) && $post["companyId"]) {
      
                # company file info
                $iId = $post["companyId"];
                $file = FOLDERCOMPANY . "{$iId}.xml";

                if (is_file($file)) {
                    $information = simplexml_load_file($file);
                    $information = json_encode($information);
                    $information = json_decode($information, true);
                }
        }

        #get profile picture
        $url_img_facebook = $post["profile_picture"];
        $name_one         = basename($url_img_facebook);
        $na_question      = explode('.',$name_one);
        $type_img         = explode('?',$na_question[1]);

        $img_rename       = $post["fbId"].'_'.preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($post['fbName']))));

        $img_final        = FOLDERIMAGECOMPANY.$img_rename.'.'.$type_img[0];
        $img_final_thumb  = FOLDERIMAGECOMPANY.'thumbnail/'.$img_rename.'.'.$type_img[0];

        $infoUpdate["im"] = $img_rename.'.'.$type_img[0]; 

        file_put_contents($img_final,file_get_contents($url_img_facebook));
        file_put_contents($img_final_thumb,file_get_contents($url_img_facebook));

        #get cover picture
        $url_img_banner_facebook = $post["cover_photo"];
        $name_one_banner         = basename($url_img_banner_facebook);
        $na_question_banner      = explode('.',$name_one_banner);
        $type_img_banner         = explode('?',$na_question_banner[1]);

        $img_rename_banner       = $post["fbId"].'_'.preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($post['fbName']))));

        $img_final_banner        = FOLDERIMAGECOMPANY.$img_rename_banner.'-cover.'.$type_img_banner[0];
        $img_final_banner_thumb  = FOLDERIMAGECOMPANY.'thumbnail/'.$img_rename_banner.'-cover.'.$type_img_banner[0];

        $infoUpdate["im_banner"] = $img_rename_banner.'-cover.'.$type_img_banner[0]; 

        file_put_contents($img_final_banner,file_get_contents($url_img_banner_facebook));
        file_put_contents($img_final_banner_thumb,file_get_contents($url_img_banner_facebook));

          
        if(isset($post["companyId"]) && $post["companyId"] ) {

                # update company
                if(isset($_SESSION["usersub"]["id"]) && $_SESSION["usersub"]["id"] !=$infoUpdate["id"]) {
                    die();
                }

                foreach ($infoUpdate as $key => $value) {
                    $information["db"][$key] = $value;
                }
                $information["companybanner"] = $infoUpdate["im_banner"];
               
                if ($db->db_update($infoUpdate, TABLE_COMPANY, array("id" => $iId, "ui" => $uid))) {
                    $code = 200;
                    $message = $language["updateSuccess"];
                } else {
                    $code = 201;
                    $errors = $language["updateSuccess"];
                }

        } else {
                die();
        }

        # save to xml (update + add new)
        if( $code == 200 && $file ) {
            saveXMLFile($file, $information);
            // var_dump($information);
        } else {
            $code = 403;
            $dataResponse = array();
        }

} else {
    die();
}