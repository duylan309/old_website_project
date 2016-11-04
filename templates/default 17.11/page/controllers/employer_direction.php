<?php 

$fileUserLogin = FOLDERUSER.$sessionUserId.".xml";
if(is_file($fileUserLogin)) {
    $fileinfo = simplexml_load_file($fileUserLogin);
    $informationUserLogin = json_encode($fileinfo);
    $informationUserLogin = json_decode($informationUserLogin, true);
}

$isActiveUser  = false;

$dayleft = isset($informationUserLogin["userinfo"]["db"]["dayleft"]) ? $informationUserLogin["userinfo"]["db"]["dayleft"] : 0;

if($dayleft > time() ) {
    $isActiveUser  = true;
}

if(!$isActiveUser) {
    $templateId = "entryUserNotifyUpgradeAccount";
    $strGetUrl = null;
} else {
    if($strFeature == "blog") {
       
        $templateId = "entryUserManageBlog";
    
    } else if($strFeature == "messages") {

        require_once dirname(__FILE__) . "/employer/user_manage_messages.php";

    } else if($strFeature == "pagecmp") {

        require_once dirname(__FILE__) . "/employer/user_cmp_manage.php";
        require_once dirname(__FILE__) . "/js/google_auto_complete_address_js.php";
        
       
    } else if($strFeature == "jobs") {

        require_once dirname(__FILE__) . "/employer/user_job_manage.php";

    } else if($strFeature == "postjob") {

        require_once dirname(__FILE__) . "/employer/user_job_post.php";

    } else if($strFeature == "usersub") {

        require_once dirname(__FILE__) . "/employer/user_usersub_manage.php"; 

    } else if($strFeature == "userall") {

        $folderFile = dirname(__FILE__) . "/employer/user_application_manage.php";
        $noHandbar = 1;
    
    } else if($strFeature == "usersave" || $strFeature == "interview" || $strFeature == "hire" || $strFeature == "deny") {

        $folderFile = dirname(__FILE__) . "/employer/user_application_manage.php";
        $noHandbar = 1;

    } else if($strFeature == "userapply") {

        $folderFile = dirname(__FILE__) . "/employer/user_application_manage.php";
        $noHandbar = 1;

    } else if($strFeature == "userdeny") {
    
        $templateId = "entryCmpUserDenied";
        $strGetUrl = null;
    
    } else if($strFeature == "userhire") {
    
        $templateId = "entryCmpUserHired";
        $strGetUrl = null;
    
    } else if($strFeature == "checkout") {
        
        require dirname(__FILE__) . "/employer/user_page_checkout_history.php";
   
    }

    if(! $yourCompany ) {
        
        $strElementData = "data-elm-data='{\"title\":\"Create page/company\"}'";
        $templateId = "entryCmpCreate";
        require_once dirname(__FILE__) . "/js/facebook_auto_complete_js.php";
        require_once dirname(__FILE__) . "/js/google_auto_complete_address_js.php";

    }
}

if($strFeature == "promoapplied") {
    $templateId = "entryPromoApplied";
    $strGetUrl = null;
} else if($strFeature == "info") {
    
    require dirname(__FILE__) . "/employer_candidate/user_setting.php";

}

# function width usersub
if(isset($_SESSION["usersub"]["subid"]) && $_SESSION["usersub"]["subid"] ) {
    #check mod access
    if($strFeature == "pagecmp" || $strFeature == "info" || $strFeature == "jobs" || $strFeature == "postjob" || $strFeature == "userapply") {
        #access
        if($strFeature == "pagecmp") {
            if(!isset($_GET["pid"]) || $_GET["pid"] != $_SESSION["usersub"]["id"] ) {
                $templateId = "entryUserNotifyDonotAccess";
                $strGetUrl  = null;
            }
        }
    } else {
        $templateId = "entryUserNotifyDonotAccess";
        $strGetUrl  = null;
    }
}