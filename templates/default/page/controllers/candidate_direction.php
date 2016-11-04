<?php 

if($strFeature == "cv") {

    $templateId = "entryUserManageCv";

} else if ( $strFeature == "menu") {

    $templateId = "entryUserManageMenu";

} else if ( $strFeature == "jobsuggest") {

    require dirname(__FILE__) . "/candidate/user_profile_job_suggest.php";

} else if ( $strFeature == "messages") {

    require dirname(__FILE__) . "/candidate/user_manage_messages.php";

} else if ( $strFeature == "jobsave") {

    $templateId = "entryUserManageJobsave";

} else if ( $strFeature == "jobapply") {

    $templateId = "entryUserManageJobapply";

} else if($strFeature == "info") {

    $templateId = "entryUserInfoSetting";
    $strGetUrl = null;

}else if($strFeature == "deactive"){

    $templateId = "entryUserDeactive";

}else{
    echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
}