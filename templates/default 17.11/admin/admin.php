<?php
$titlePage = isset($_GET["fun"]) ? $_GET["fun"] : "daskboard";
function main() {
    global $db, $language, $url_data, $sessionUserId, $informationConfig, $titlePage, $seo_name;
    $functionTemplate = null;
    $strPostElm = null;
    $strLocalOption = null;

    # $_SESSION["adminlog"] =1;

    $tmpFrom = explode("-" , date("2016-01-01"));
    $tmpTo = explode("-" , date("Y-m-d"));
    if(isset($_POST["dayFrom"])) {
        $tmpFrom =  explode("-",$_POST["dayFrom"]);
    }
    if(isset($_POST["dayTo"])) {
        $tmpTo =  explode("-",$_POST["dayTo"]);
    }
    $intFrom = mktime(0, 0, 0, $tmpFrom[1], $tmpFrom[2],$tmpFrom[0]);
    $intTo = mktime(23, 59, 59, $tmpTo[1], $tmpTo[2],$tmpTo[0]);
    $tmpFrom = implode("-", $tmpFrom);
    $tmpTo = implode("-", $tmpTo);
    $strReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;



    if(!$_POST) {
        $_POST["dayFrom"] = $tmpFrom;
        $_POST["dayTo"] = $tmpTo;
    }

    foreach ($_POST as $key => $value) {
        $strPostElm.= ', "'.$key.'":"'.$value.'"';
    }

    if(isset($_SESSION["userlog"])) {
        $mod = isset($_GET["mod"]) ? $_GET["mod"] : null;
        if (!isset($_SESSION["adminlog"]) || !$sessionUserId) {
            echo '<div class="g-item user-update-address"
                data-copy-template
                data-view-template=".user-update-address"
                data-template-id="entryAdminLogin">&nbsp;</div>';
        } else {
            $strGetUrl = null;
            $strGetScript = null;
            $strElementData = null;
            if($mod && is_file(dirname(__FILE__) . "/{$mod}.php")) {
                $titlePage = $mod;
                require dirname(__FILE__) .  "/{$mod}.php";
            }
            else {
                if($titlePage == "config") {
                    $strGetUrl = 'data-get-url="'.APIGETCONFIGPAGE.'"';
                    $functionTemplate = "entryAdminConfig";
                } elseif($titlePage == "jobs") {

                    $strAjaxUrl = "api/get/job?from={$intFrom}&to={$intTo}&gettotaljob=1";
                   
                    $strElementData = "data-elm-data='{
                                \"strUrlList\":\"{$strAjaxUrl}\"
                                {$strPostElm}
                            }'";

                    $functionTemplate = "entryManageJobs";
                    $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.manageJobs"></script>';
                
                } elseif($titlePage == "jobapply") {

                    $strAjaxUrl = "api/get/jobapply?from={$intFrom}&to={$intTo}&gettotaljob=1";
                   
                    $strElementData = "data-elm-data='{
                                \"strUrlList\":\"{$strAjaxUrl}\"
                                {$strPostElm}
                            }'";

                    $functionTemplate = "entryManageJobsApply";
                    $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.manageJobsApply"></script>';
                
                } elseif($titlePage == "cv") {
                  
                    $functionTemplate = "entryAdminManageCv";
                
                } elseif($titlePage == "cmp") {
                    
                    if(isset($_GET["uid"]) && $_GET["uid"]) {
                        # view Detail
                        $strElementData = "data-elm-data='{
                            \"referer\":\"{$strReferer}\",
                            \"view\":\"info\"
                            {$strPostElm}
                        }'";
                        $functionTemplate = "entryViewEmploymentDetail";
                        $strAjaxUrl = APIGETUSERINFO."/{$_GET["uid"]}";
                        $strGetScript = '<script src="'.$strAjaxUrl.'?var=window.employmentDetail"></script>';
                        $strLocalOption = 'data-option-local="employmentDetail"';

                        $strGetScript .='<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsDxYLtt1WGS-_BkdFZlg5CboNuLWhcYw">
    </script>';
                        if(isset($_GET["view"]) && $_GET["view"]) {
                            $strElementData = "data-elm-data='{
                                \"referer\":\"{$strReferer}\",
                                \"view\":\"{$_GET["view"]}\"
                                {$strPostElm}
                            }'";

                            if($_GET["view"]=="checkout") {
                                $strGetScript .= '<script src="'.APIGETCHECKOUT.'?uid='.$_GET["uid"].'&var=window.userManageCheckout"></script>';
                            } elseif($_GET["view"]=="promocode") {
                                $strGetScript .= '<script src="'.APIGETPROMOAPPLIED.'?uid='.$_GET["uid"].'&var=window.userAppliedPromocode"></script>';
                            } elseif($_GET["view"]=="page") {
                                $strGetScript .= '<script src="'.APIGETCOMPANY.'?uid='.$_GET["uid"].'&var=window.userCompany"></script>';
                            } elseif($_GET["view"]=="blog") {
                                $strGetScript .= '<script src="'.APIGETBLOG.'?uid='.$_GET["uid"].'&var=window.userBlog"></script>';
                            } elseif($_GET["view"]=="jobs") {
                            
                                if(isset($_GET["detail"]) && $_GET["detail"] ) {
                                    $strGetScript .= '<script src="'.APIGETJOB.'/'.$_GET["detail"].'?var=window.jobDetail"></script>';
                                    $strElementData = "data-elm-data='{
                                        \"referer\":\"{$strReferer}\",
                                        \"view\":\"{$_GET["view"]}\",
                                        \"jobDetail\":\"{$_GET["detail"]}\"
                                        {$strPostElm}
                                    }'";
                                }

                            } else {

                            }
                        }

                    } else {
                        # view List
                        $strAjaxUrl = APIGETCMP."?checktotal=1&from={$intFrom}&to={$intTo}";

                        if(isset($_GET['dayleft']) && $_GET['dayleft']){
                            $strAjaxUrl = APIGETCMP."?checktotal=1&from={$intFrom}&to={$intTo}&dayleft=".$_GET['dayleft'];
                            $strPostElm.= $_GET['dayleft'] == 1 ? ', "dayleft":"2"' :', "dayleft":"1"';
                        }else{
                            $strPostElm.= ', "dayleft":"1"';
                        }

                        # view List
                        if(isset($_GET['last_signin']) && $_GET['last_signin']){
                            $strAjaxUrl = APIGETCMP."?checktotal=1&from={$intFrom}&to={$intTo}&last_signin=".$_GET['last_signin'];
                            $strPostElm.= $_GET['last_signin'] == 1 ? ', "last_signin":"2"' :', "last_signin":"1"';
                        }else{
                            $strPostElm.= ', "last_signin":"2"';
                        }

                        # get total like - hire - ...
                        $strSelectAction = "SUM(us.status = 1) AS totalLike,
                                            SUM(us.status = 3) AS totalInterview,
                                            SUM(us.status = 4) AS totalHire,
                                            SUM(us.status = 5) AS totalDeny ";

                        $strQueryAction= "SELECT $strSelectAction
                                                FROM ".TABLE_USER_SAVED." AS us ";
                        $rowTotalAction= $db->db_array($strQueryAction);

                        $strPostElm .= ' , "totalLike":"'.$rowTotalAction["totalLike"].'" ';
                        $strPostElm .= ' , "totalInterview":"'.$rowTotalAction["totalInterview"].'" ';
                        $strPostElm .= ' , "totalHire":"'.$rowTotalAction["totalHire"].'" ';
                        $strPostElm .= ' , "totalDeny":"'.$rowTotalAction["totalDeny"].'" ';

                        $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                        $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManageEmployment"></script>';
                        $functionTemplate = "entryAdminManageEmployment";
                    }

                } elseif($titlePage == "cmppage") {

                    if(isset($_GET["pid"]) && $_GET["pid"]) {
                        # view Detail
                        $strElementData = "data-elm-data='{
                            \"pid\":\"{$_GET["pid"]}\",
                            \"referer\":\"{$strReferer}\",
                            \"view\":\"info\"
                            {$strPostElm}
                        }'";

                        $functionTemplate = "entryViewCmpPageDetail";
                        $strAjaxUrl = APIGETCOMPANY."/{$_GET["pid"]}";
                        $strGetScript = '<script src="'.$strAjaxUrl.'?var=window.employmentDetail"></script>';
                        $strLocalOption = 'data-option-local="employmentDetail"';
                        $strGetScript .='<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsDxYLtt1WGS-_BkdFZlg5CboNuLWhcYw">
    </script>';

                        if(isset($_GET["view"]) && $_GET["view"]) {

                            $strElementData = "data-elm-data='{
                                \"pid\":\"{$_GET["pid"]}\",
                                \"referer\":\"{$strReferer}\",
                                \"view\":\"{$_GET["view"]}\"
                                {$strPostElm}
                            }'";

                            if($_GET["view"]=="blog") {
                                $strGetScript .= '<script src="'.APIGETBLOG.'?uid='.$_GET["pid"].'&var=window.userBlog"></script>';
                            } elseif($_GET["view"]=="jobs") {
                                if(isset($_GET["detail"]) && $_GET["detail"] ) {
                                    $strGetScript .= '<script src="'.APIGETJOB.'/'.$_GET["detail"].'?var=window.jobDetail"></script>';
                                    $strElementData = "data-elm-data='{
                                        \"referer\":\"{$strReferer}\",
                                        \"view\":\"{$_GET["view"]}\",
                                        \"jobDetail\":\"{$_GET["detail"]}\"
                                        {$strPostElm}
                                    }'";
                                }

                            }
                        }

                    } else {
                        # view List Company Page
                        $strAjaxUrl = APIGETCOMPANY."?from={$intFrom}&to={$intTo}";
                        $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                        $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManageCmpPage"></script>';
                        $functionTemplate = "entryAdminManageCmpPage";
                    }

                } elseif($titlePage == "user") {
                    
                    if(isset($_GET["view"]) && $_GET["view"]) {
                        # view Detail
                        $strReferer = "/{$seo_name["page"]["admin"]}?fun=user";
                        $strElementData = "data-elm-data='{\"referer\":\"{$strReferer}\"}'";
                        $functionTemplate = "entryViewApplicantDetail";
                        # $strGetUrl = 'data-get-url="'.APIGETCV.'/'.$_GET["view"].'"';
                        $strAjaxUrl = APIGETCV."/{$_GET["view"]}";
                        $strGetScript = '<script src="'.$strAjaxUrl.'?var=window.cvDetail"></script>';
                   
                    } else {
                        # view List
                        if(isset($_GET['last_signin']) && $_GET['last_signin']){
                            $strAjaxUrl = APIGETUSER."?from={$intFrom}&to={$intTo}&last_signin=".$_GET['last_signin'];
                            $strPostElm.= $_GET['last_signin'] == 1 ? ', "last_signin":"2"' :', "last_signin":"1"';
                        }else{
                            $strPostElm.= ', "last_signin":"1"';
                            $strAjaxUrl = APIGETUSER."?from={$intFrom}&to={$intTo}";
                        }

                        // $strAjaxUrl = APIGETUSER."?from={$intFrom}&to={$intTo}";
                        $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                        $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManageUser"></script>';
                        $functionTemplate = "entryAdminManageApplicant";
                    }

                } elseif($titlePage == "managerweb") {
                    # view List
                    $strAjaxUrl = APIGETUSERMANAGER."?from={$intFrom}&to={$intTo}";
                    $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                    # $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManagerWebsite"></script>';
                    $functionTemplate = "entryAdminManagerWebsite";

                } elseif($titlePage == "news") {
                    $strAjaxUrl = APIGETNEWS."?from={$intFrom}&to={$intTo}";

                    $strElementData = "data-elm-data='{
                                        \"strUrlList\":\"{$strAjaxUrl}\"
                                        {$strPostElm}
                                    }'";

                    $functionTemplate = "entryAdminManageNews";
                } elseif($titlePage == "promo") {
                    $strAjaxUrl = APIGETPROMO."?from={$intFrom}&to={$intTo}";
                    $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                    # $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.userManagePromoCode"></script>';

                    $functionTemplate = "entryAdminManagePromo";
                } elseif($titlePage == "checkout") {

                    if(isset($_GET["view"]) && $_GET["view"]) {
                        # view Detail
                        $strReferer = "/{$seo_name["page"]["admin"]}?fun=checkout";
                        $strElementData = "data-elm-data='{\"referer\":\"{$strReferer}\"}'";
                        $functionTemplate = "entryViewCheckoutDetail";
                        $strGetUrl = 'data-get-url="'.APIGETCHECKOUT.'/'.$_GET["view"].'"';

                    } else {
                        # view List
                        $strAjaxUrl = APIGETCHECKOUT."?from={$intFrom}&to={$intTo}";
                        $strElementData = "data-elm-data='{\"referer\":\"{$strReferer}\", \"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                        $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManageCheckout"></script>';
                        $functionTemplate = "entryAdminManageCheckout";
                        $strGetUrl = null;
                    }
                } elseif($titlePage == "contact") {
                    $strAjaxUrl = APIGETCONTACTUS."?from={$intFrom}&to={$intTo}";
                    $strElementData = "data-elm-data='{\"strUrlList\":\"{$strAjaxUrl}\" {$strPostElm} }'";
                    # $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.adminManageContact"></script>';
                    $functionTemplate = "entryAdminManageContactus";
                } elseif($titlePage == "category") {
                    $functionTemplate = "entryAdminManageCategory";
                } elseif($titlePage == "pagehtml") {
                    $functionTemplate = "entryAdminManagePagehtml";
                } elseif($titlePage == "image") {
                    $functionTemplate = "entryAdminManageImage";
                } elseif($titlePage == "history") {
                    # view List
                    $strAjaxUrl = APIGETHISTORYSEARCH."?from={$intFrom}&to={$intTo}";
                    $strElementData = "data-elm-data='{
                        \"referer\":\"{$strReferer}\",
                        \"formAction\":\"/{$seo_name["page"]["admin"]}?fun=history\",
                        \"strUrlList\":\"{$strAjaxUrl}\"
                        {$strPostElm}
                    }'";
                    $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.manageHistorySearch"></script>';
                    $functionTemplate = "entryAdminManageHistorySearch";
                    $strGetUrl = null;

                } elseif($titlePage == "password") {
                    # view List
                    $functionTemplate = "entryAdminChangePassword";

                } elseif($titlePage == "sendedm") {
                    # view List
                    $functionTemplate = "entryAdminManageEmailEdm";

                } elseif($titlePage == "messages") {
                    # view List
                    $functionTemplate = "entryAdminManageMessages";

                } else {
                    $strAjaxUrl = APIGETCHECKOUT."?limit=10";
                    $strGetScript .= '<script src="'.$strAjaxUrl.'&var=window.daskboardCheckout"></script>';

                    $strAjaxUrl = APIGETUSER."?limit=10";
                    $strGetScript .= '<script src="'.$strAjaxUrl.'&var=window.daskboardUser"></script>';

                    $strAjaxUrl = APIGETCMP."?limit=10";
                    $strGetScript .= '<script src="'.$strAjaxUrl.'&var=window.daskboardEmployment"></script>';

                    $strAjaxUrl = APIGETJOB."?limit=10";
                    $strGetScript .= '<script src="'.$strAjaxUrl.'&var=window.daskboardJobs"></script>';

                    $strAjaxUrl = APIGETCONTACTUS."?limit=10";
                    $strGetScript .= '<script src="'.$strAjaxUrl.'&var=window.daskboardContact"></script>';

                    $functionTemplate = "entryAdminManageDaskboard";
                }

                echo $strGetScript;

                if($titlePage == "daskboard") {
                ?>
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-6 daskboard-jobs"
                        data-option-local="daskboardJobs"
                        data-copy-template
                        data-view-template=".daskboard-jobs"
                        data-template-id="AdminDaskboardJob">
                    </div>
                    <div class="col-xs-12 col-sm-6 daskboard-employment"
                        data-option-local="daskboardEmployment"
                        data-copy-template
                        data-view-template=".daskboard-employment"
                        data-template-id="AdminDaskboardEmployment">
                    </div>
                    <div class="col-xs-12 col-sm-6 daskboard-user"
                        data-option-local="daskboardUser"
                        data-copy-template
                        data-view-template=".daskboard-user"
                        data-template-id="AdminDaskboardUser">
                    </div>
                    <div class="col-xs-12 col-sm-6 daskboard-contact"
                        data-option-local="daskboardContact"
                        data-copy-template
                        data-view-template=".daskboard-contact"
                        data-template-id="AdminDaskboardContact">
                    </div>
                </div>
                <?php
                } else {
                ?>
                <div class="admin-management"
                    <?=$strGetUrl?>
                    <?=$strElementData?>
                    <?=$strLocalOption?>
                    data-copy-template
                    data-view-template=".admin-management"
                    data-template-id="<?=$functionTemplate?>">
                </div>
                <?php
                }
            }
        }
    } else {
        echo '<span data-goto-link data-url="/"></span>';
    }
}
?>
