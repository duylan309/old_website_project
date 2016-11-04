<?php
$isApplied = false;
$to = null;

$uid = $user_insert_id;

$jobId          = isset($post['job']['jo']) ? $post['job']['jo'] : null;
$co             = isset($user_insert_id) ? $user_insert_id.'_'.$jobId : null;
$employer_id    = isset($post['job']['ei']) ? $post['job']['ei'] : null;

$job_company_id = $post['job']['company_id'];
$job_answer     = $post['job']['ti'];

$post_job_apply = $post["job"];
$post_job_apply['ui'] = $uid;
$post_job_apply['co'] = $co;

if($jobId && $co == $uid."_".$jobId ) {
    $post_job_apply["cr"] = $currentTime;
    if($db->db_insert($post_job_apply, TABLE_JOB_APPLIED)) {
        $isApplied = true;
    }
}

if($isApplied) {
    $code = 200;
    $message = $language['applyJobSuccess'];

    #send email to employer
    $user_id     = $user_insert_id;
    $job_id      = $jobId;

    #save user to user_saved
    $user_save["db"]["fo"] = $employer_id;
    $user_save["db"]["ui"] = $uid;
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
    $fileUser = FOLDERUSER . $user_insert_id . ".xml";
    $readXMLUser     = simplexml_load_file($fileUser);
    $informationUser = json_encode($readXMLUser);
    $informationUser = json_decode($informationUser, true);

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
    
   # $candidate['link_candidate'] = SITEURL.$seo_name["page"]["cv"]."/".urlFriendly($informationUser["userinfo"]['db']['name']).'.'.$informationUser["userinfo"]['db']['id'];
     
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
       $send_apply_email = true;  
    }

} else {
    $code = 201;
    $errors = $language['applyJobErrors'];
}


