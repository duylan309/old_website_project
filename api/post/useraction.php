<?php
if(isset($post["employmentAction"]) && $post["employmentAction"]) {
    # Employment Action
    $mod = $post["employmentAction"];

    if($mod=="applied") {
        if(isset($post["db"]["id"]) && isset($post["db"]["ei"]) && isset($post["db"]["st"])) {
            $strUpdate = "UPDATE ".TABLE_JOB_APPLIED." SET st = {$post["db"]["st"]} WHERE ei={$post["db"]["ei"]} AND id={$post["db"]["id"]}";
            $db->db_query($strUpdate);

            #update total applied to job
            $jobId = $post["db"]["jo"];
            $fileJob = FOLDERJOB . "{$jobId}.xml";
            if(is_file($fileJob)) {
               
                $readXML = simplexml_load_file($fileJob);
                $informationJob = json_encode($readXML);
                $informationJob = json_decode($informationJob, true);
               
                $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(ui SEPARATOR ',') AS strui FROM ".TABLE_JOB_APPLIED." WHERE jo=$jobId AND st=2 GROUP BY jo ORDER BY id DESC";
                $rowTotal = $db->db_array($strTotal);
               
                if($rowTotal) {
                    $informationJob["userhired"] = array(
                        "total" => $rowTotal["total"],
                        "strui"=>$rowTotal["strui"]
                    );
                }
                else {
                    $informationJob["userhired"] = array();
                }
                saveXMLFile($fileJob, $informationJob);
            }
        }
    } elseif($mod=="saveuser" || $mod == "unsaveuser" || $mod == "interview" || $mod == "hire" || $mod == "deny") {

        $isSaved = false;


        if(isset($post["db"]["fo"]) && isset($post["db"]["ui"])) {
            $co = $post["db"]["fo"]."_".$post["db"]["ui"];
            if($sessionUserId == $post["db"]["fo"] && $co == $post["db"]["co"]) {

                if($mod=="saveuser") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 1 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                } elseif($mod == "unsaveuser") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 2 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                } elseif($mod == "interview") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 3 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                } elseif($mod == "hire") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 4 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                } elseif($mod == "deny") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 5 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                } elseif($mod == "remove") {
                    $strUpdate = "UPDATE ".TABLE_USER_SAVED." SET status = 6 WHERE co = '$co' ";
                    if($db->db_query($strUpdate)){
                        $isSaved = true;
                    }
                }
            }
        }

        if($isSaved) {

            $uid = $post["db"]["fo"];
            $fileUser = FOLDERUSER . "{$uid}.xml";
           
            $readXML         = simplexml_load_file($fileUser);
            $informationUser = json_encode($readXML);
            $informationUser = json_decode($informationUser, true);
           
            $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(ui SEPARATOR ',') AS strui FROM ".TABLE_USER_SAVED." WHERE fo={$uid} GROUP BY fo ORDER BY id DESC";
            $rowTotal = $db->db_array($strTotal);

            if($rowTotal) {
                $informationUser["saveuser"] = array(
                        "total" => $rowTotal["total"],
                        "strui" => $rowTotal["strui"]
                    );
            }
            else {
                $informationUser["saveuser"] = array();
            }

            saveXMLFile($fileUser, $informationUser);
        }
    }

    $code = 200;
    $message = $language["updateSuccess"];

} else {
    
    # User Action
    $uid = isset($post["db"]["ui"]) ? $post["db"]["ui"] : null;
    if ( $uid && $sessionUserId == $uid ) {
        $fileUser = FOLDERUSER . "$uid.xml";

        if(isset($url_data[3]) && is_file($fileUser)) {
            $mod = $url_data[3];

            $readXML = simplexml_load_file($fileUser);
            $informationUser = json_encode($readXML);
            $informationUser = json_decode($informationUser, true);


            if($mod == "savejob" || $mod == "unsavejob") {

                $isSaved = false;
                $jobId = isset($post["db"]["jo"]) ? $post["db"]["jo"] : null;
                $co = isset($post["db"]["co"]) ? $post["db"]["co"] : null;
		
                if($jobId && $co == $uid."_".$jobId ) {
                    #check and save to database
                    if($mod == "savejob") {
                        $post["db"]["cr"] = $currentTime;
                        
                        if($db->db_insert($post["db"], TABLE_JOB_SAVED)) {
                            $isSaved = true;
                            $code = 200;
                            $message = $language["addToFavorite"];
                        }
                    } else {
                        $strDelQuery = "DELETE FROM ".TABLE_JOB_SAVED." WHERE co = '$co' ";
                        $db->db_query($strDelQuery);
                        $isSaved = true;
                        $code = 200;
                        $message = $language["removeFromYourFavorites"];
                    }
                }

                if($isSaved) {
                    $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(jo SEPARATOR ',') AS strjo FROM ".TABLE_JOB_SAVED." WHERE ui={$uid} GROUP BY ui ";
                    $rowTotal = $db->db_array($strTotal);
                   
                    if($rowTotal) {
                        $informationUser["savedjob"] = array(
                            "total" => $rowTotal["total"],
                            "strjo"=>$rowTotal["strjo"]
                        );
                    }
                    else {
                        $informationUser["savedjob"] = array();
                    }
                   
                    saveXMLFile($fileUser, $informationUser);

                } else {
                    $code = 201;
                    $error = $language["jobSaveErrors"];
                }

            } elseif ($mod == "applyjob") {
                $isApplied = false;

                $jobId = isset($post["db"]["jo"]) ? $post["db"]["jo"] : null;
                $co = isset($post["db"]["co"]) ? $post["db"]["co"] : null;
                $employer_id = isset($post["db"]["ei"]) ? $post["db"]["ei"] : null;

                if($jobId && $co == $uid."_".$jobId ) {
                    $post["db"]["cr"] = $currentTime;
                    if($db->db_insert($post["db"], TABLE_JOB_APPLIED)) {
                        $isApplied = true;
                    }
                    # $isApplied = true;
                }

                if($isApplied) {
                    $code = 200;
                    $message = $language["applyJobSuccess"];

                    #send email to employer
                    $employer_id = $post["db"]['ei'];
                    $user_id     = $post["db"]['ui'];
                    $job_id      = $post["db"]['jo'];

                    #save user to user_saved
                    $user_save["db"]["fo"] = $employer_id;
                    $user_save["db"]["ui"] = $post["db"]['ui'];
                    $user_save["db"]["co"] = $user_save["db"]["fo"].'_'.$user_save["db"]["ui"];

                    if($user_save["db"]["co"] == $employer_id.'_'.$user_id) {
                        $user_save["db"]["cr"] = $currentTime;
                        if($db->db_insert($user_save["db"], TABLE_USER_SAVED)) {
                            $isSaved = true;
                        }
                    }

                    #save job to user
                    $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(jo SEPARATOR ',') AS strjo FROM ".TABLE_JOB_APPLIED." WHERE ui=$uid GROUP BY ui ";
                    $rowTotal = $db->db_array($strTotal);
                    if($rowTotal) {
                        $informationUser["appliedjob"] = array(
                            "total" => $rowTotal["total"],
                            "strjo"=>$rowTotal["strjo"]
                        );
                        saveXMLFile($fileUser, $informationUser);
                    }

                    $strUpdate = "UPDATE ".TABLE_JOB_SAVED." SET st = 1 WHERE ui=$uid AND jo=$jobId ";
                    $db->db_query($strUpdate);

                    #update total applied to job
                    $fileJob = FOLDERJOB . "$jobId.xml";
                    if(is_file($fileJob)) {
                        $readXML = simplexml_load_file($fileJob);
                        $informationJob = json_encode($readXML);
                        $informationJob = json_decode($informationJob, true);

                        $strTotal = "SELECT count(id) AS total, GROUP_CONCAT(ui SEPARATOR ',') AS strui FROM ".TABLE_JOB_APPLIED." WHERE jo=$jobId GROUP BY jo";
                        $rowTotal = $db->db_array($strTotal);

                        if($rowTotal) {
                            $informationJob["userapplied"] = array(
                                "total" => $rowTotal["total"],
                                "strui"=>$rowTotal["strui"]
                            );
                            saveXMLFile($fileJob, $informationJob);
                        }
                    }

                    ### Send email

                    #get user information
                    $candidate['name']       = $informationUser["userinfo"]['db']['name'];
                    $candidate['image']      = isset($informationUser["userinfo"]['db']["im"]) && count($informationUser["userinfo"]['db']["im"]) && is_file(FOLDERIMAGEUSER.$informationUser["userinfo"]['db']["im"]) ? SITEURL.FOLDERIMAGEUSER.$informationUser["userinfo"]['db']['im'] : SITEURL.UDATAIMAGE."style/user-profile.png";
                    $candidate['email']      = $informationUser["userinfo"]['db']['email'];
                    $candidate['job_title']  = $informationUser["user_cv"]['db']['title'];
                    $candidate['experience'] = isset($informationUser["user_cv"]["db"]["experience"]) && !is_array($informationUser["user_cv"]["db"]["experience"]) ? $language["yearOfExperienceOption"][$informationUser["user_cv"]["db"]["experience"]] : '';
                    
                    // $candidate['link_candidate'] = SITEURL.$seo_name["page"]["cv"]."/".urlFriendly($informationUser["userinfo"]['db']['name']).'.'.$informationUser["userinfo"]['db']['id'];
                     
                    #get employer infomation
                    $fileEmployer = FOLDERUSER . "$employer_id.xml";
                    if(is_file($fileEmployer)){
                       $readXMLEmployer = simplexml_load_file($fileEmployer);
                       $informationEmployer    = json_encode($readXMLEmployer);
                       $informationEmployer    = json_decode($informationEmployer, true); 
                    }
                    
                    #get job information
                    $fileJob = FOLDERJOB . "$jobId.xml";
                    if(is_file($fileJob)) {
                        $readXML = simplexml_load_file($fileJob);
                        $informationJob = json_encode($readXML);
                        $informationJob = json_decode($informationJob, true);

                        $company_id =  isset($informationJob['db']['ci']) ? $informationJob['db']['ci'] : null;
                    }    

                    $job['title'] = $informationJob['db']['ti'];
                    $candidate['link_candidate'] = SITEURL.$seo_name["page"]["job"]."/".urlFriendly($job["title"]).'.'.$jobId.'?statistics=1';
                    
                    #get company information
                    $fileCompany = FOLDERCOMPANY . "$company_id.xml";
                    if(is_file($fileCompany)){
                       $readXMLCompany = simplexml_load_file($fileCompany);
                       $informationCompany    = json_encode($readXMLCompany);
                       $informationCompany    = json_decode($informationCompany, true); 
                    }

                    $company['name'] = $informationCompany['db']['name'];
                    $company['url']  = $informationCompany['db']['url'];
                    $company['im']   = $informationCompany['db']['im'];

                    #get list company email
                    $company_id;
                    $strQueryEmail   =  "SELECT id,user_id,email,name,status,company_id
                                        FROM ".TABLE_RECEIVE_EMAIL." AS em
                                        WHERE em.company_id = {$company_id} AND em.user_id = {$employer_id} AND em.status = 2 ";
                    $resultCompanyEmail =  $db->db_arrayList($strQueryEmail);
                    
                    $to = null; 

                    if(isset($informationEmployer["userinfo"]["db"]["is_received_email"])){
                        if($informationEmployer["userinfo"]["db"]["is_received_email"] == 1){
                            $to[0]['email'] = $informationEmployer["userinfo"]["db"]["email"];
                            $to[0]['name']  = $informationEmployer["userinfo"]["db"]["name"];
                        } 
                    }
                    

                    if($resultCompanyEmail && count($resultCompanyEmail)){
                        $i = isset($informationEmployer["userinfo"]["db"]["is_received_email"]) ? ($informationEmployer["userinfo"]["db"]["is_received_email"] == 1 ? 1 : 0) : 0;
                        foreach($resultCompanyEmail as $email){
                            $to[$i]['email'] = $email["email"];
                            $to[$i]['name']  = $email["name"];
                            $i++;
                        }
                    }

                    if($informationCompany && $informationJob && $informationUser){
                       #send email to employer
                        require $cgf_site["temp"] . "newsletter/application_alert_update.php";

                        $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
                           "from" => "no-reply@thue.today",
                           "to" => $to,
                           "sender" => "Thue Today",
                           "receiver" => $informationEmployer["userinfo"]["db"]["name"],
                           "reply" => "team@thue.today",
                           "replyInfo" => "Thue Today",
                           "subject" => "You have a new applicant",
                           "content" => $strBody,
                        ); 

                        if($to){
                            // require dirname(__FILE__) . "/sendmanyemail.php";
                        } 

                    }

                } else {
                    $code = 201;
                    $errors = $language['applyJobErrors'];
                }
            }
        }
    } else {
        $code = 401;
        $errors = $language["sessionExpiration"];
    }
}
?>
