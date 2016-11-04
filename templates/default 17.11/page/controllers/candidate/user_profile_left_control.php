<?php 
$call_file = null;
$getSuggestJobs = APIGETJOB."?";

if($isCvOfUser) {

    $yourCv = isset($cvInfoPage["user_cv"]) ? $cvInfoPage["user_cv"]["db"]:null;
   
    $strGetScript = '<script src="'.APIGETJOBSUGGEST.'?distinct=1&limit=5&var=window.suggestJobs"></script>';
    $call_file    = '/user_profile_candidate_view.php'; 

} else {
   
    $yourCv = isset($cvInfoPage["user_cv"]) ? $cvInfoPage["user_cv"]["db"]:null;
    
    $strGetScript = '<script src="'.$getSuggestJobs.'&title='.$yourCv["title"].'&limit=5&var=window.suggestJobs"></script>';
    $call_file    = '/user_profile_candidate_view.php'; 
    
}
