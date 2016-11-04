<?php
$isApplicant = false;

if(isset($url_data[1])) {
    $strParamUrl = explode(".",$url_data[1]);
    $uid = $strParamUrl[count($strParamUrl)-1];
    $fileUser = FOLDERUSER."{$uid}.xml";
    if(is_file($fileUser)) {
        $cvInfoPage = simplexml_load_file($fileUser);
        $cvInfoPage = json_encode($cvInfoPage);
        $cvInfoPage = json_decode($cvInfoPage, true);
        if(isset($cvInfoPage["userinfo"]["db"]["type"]) && $cvInfoPage["userinfo"]["db"]["type"]==2)
        {
            $isApplicant = true;
        }
    }
}

if($isApplicant) {
   
    $isPageOfCompany = $uid == $sessionUserId ? true :false;
    
    function main() {
       
        global $language, $cvInfo, $sessionUserId, $jid, $db, $cvInfoPage,$seo_name,$isPermission;
        $strUserTab = null;
        $isCandidateOfUser = false;

        $cvInfo          = isset($cvInfoPage["user_cv"]) ? $cvInfoPage["user_cv"] : null;
        $cvInfoWork      = isset($cvInfoPage["experience"]) ? $cvInfoPage["experience"] : null;
        $cvInfoEducation = isset($cvInfoPage["education"]) ? $cvInfoPage["education"] : null;

        $infoUser        = $cvInfoPage["userinfo"]["db"];
        $seekerId        = $infoUser["id"];

        $isCvOfUser      = $seekerId == $sessionUserId ? true : false;

        if(isset($_SESSION["userlog"]) && isset($_SESSION["userlog"]['type']) ){
            if($_SESSION["userlog"]['type']==1){
                $employer_id = $_SESSION["userlog"]["id"];
                $co          = $employer_id.'_'.$seekerId;
               
                $str_query  = " SELECT *
                                FROM ".TABLE_JOB_APPLIED." 
                                WHERE ei={$employer_id} 
                                AND   ui={$seekerId}
                                ORDER BY id DESC";

                $row = $db->db_array($str_query);

                if($row && count($row)){
                    $str_query_status   = " SELECT usersave.status AS employer_status 
                                            FROM ".TABLE_USER_SAVED." AS usersave
                                            WHERE usersave.fo = {$employer_id} 
                                            AND usersave.ui   = {$seekerId} 
                                            AND usersave.co   = '".$co."' ";
                    $row_status = $db->db_array($str_query_status);
                    $infoUser["employer_status"] = isset($row_status["employer_status"]) ? ( $row_status["employer_status"] ? $row_status["employer_status"] : 0 ) : 0;
                    $isCvOfUser = true;
                    $isCandidateOfUser = true;
                }
            }else if($_SESSION["userlog"]["type"] == 2){
                $strUpdateView = "UPDATE ".TABLE_COMMENT." SET readed = 1 WHERE uid = {$seekerId}";
                $db->db_query($strUpdateView);
            }
        }     

        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
            $isCvOfUser = true;
        }


        if($isCvOfUser){
            // Get missing data from candidate's profile
            require_once dirname(__FILE__) . "/user_profile_check_missing_content.php";

            // Get $strGetScript to show on left side
            require_once dirname(__FILE__) . "/user_profile_left_control.php";

            // Load view candidate
            require_once dirname(__FILE__) . "/../../views/candidate/user_profile.php"; 
        
        }else{
            echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
        }

    }

}
else {
    require dirname(__FILE__) . '/../general/user_page_not_found.php';
}
?>

