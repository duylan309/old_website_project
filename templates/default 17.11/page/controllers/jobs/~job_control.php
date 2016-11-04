<?php
$isJob = false;

if(isset($url_data[1]) && $url_data[1]) {
    $strParamUrl = explode(".",$url_data[1]);
    $jid = intval($strParamUrl[count($strParamUrl)-1]);
    $fileJob = FOLDERJOB.$jid.".xml";
    $infoJob = null;
    $infoCmp = null;
    if(is_file($fileJob)) {
        $infoJob = simplexml_load_file($fileJob);
        $infoJob = json_encode($infoJob);
        $infoJob = json_decode($infoJob, true);
        // is_array($infoJob["db"]["ci"]);
        $infoJob["db"]["ci"] = is_array($infoJob["db"]["ci"]) ? $infoJob["db"]["ci"][0] : $infoJob["db"]["ci"];
        $fileCompany = FOLDERCOMPANY.$infoJob["db"]["ci"].".xml";

        //SEO
        $strPrice = $language["negotiable"];

        if(isset($infoJob["db"]["s1"]) && isset($infoJob["db"]["s2"]) && isset($infoJob["db"]["sa"]) ) {
            if($infoJob["db"]["s1"] != 0 && $infoJob["db"]["s2"] != 0 && $infoJob["db"]["sa"] != 0){
                $strPrice = "{$infoJob["db"]["s1"]} - {$infoJob["db"]["s2"]}";
                if($infoJob["db"]["sa"]==2) {
                    $strPrice .= " {$language["currencyOption"][2]}";
                }
                else {
                    $strPrice .= " {$language["currencyOption"][1]}";
                }
            }
        }

        if(is_file($fileCompany)) {
            $fileInfo     = simplexml_load_file($fileCompany);
            $companyInfoPage = json_encode($fileInfo);
            $companyInfoPage = json_decode($companyInfoPage, true);
        }

        $CompanyName = isset($companyInfoPage["db"]["name"]) ? $companyInfoPage["db"]["name"]." - " : "";

        $web_title = $infoJob["db"]["ti"]." - ".$CompanyName. $language["jobSalary"]." ".$strPrice;
        $web_description = isset($infoJob["more"]["requirement"]) && count($infoJob["more"]["requirement"]) ? substr($infoJob["more"]["requirement"], 0, 350) : '';
        $web_keyword = $web_title." ".$web_description;

        $facebook_share_content = '';
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $avatar_cmp = isset($companyInfoPage["db"]["im"]) && count($companyInfoPage["db"]["im"]) && $companyInfoPage["db"]["im"] ? 'http://'.$_SERVER["HTTP_HOST"].'/'.FOLDERIMAGECOMPANY.$companyInfoPage["db"]["im"] : 'http://'.$_SERVER["HTTP_HOST"].'/img/style/user.png';
        $facebook_share_content .= '<meta property="fb:app_id"   content="'.FBAPPID.'" />';
        $facebook_share_content .= '<meta property="og:url"   content="'.$actual_link .'" />';
        $facebook_share_content .= '<meta property="og:type"  content="website" />';
        $facebook_share_content .= '<meta property="og:title" content="'.$web_title.'" />';
        $facebook_share_content .= '<meta property="og:description" content="'.$web_description.'" />';
        $facebook_share_content .= '<meta property="og:image" content="'.$avatar_cmp.'" />';
        $facebook_share_content .= '<meta property="og:image:width" content="450" />';
        $facebook_share_content .= '<meta property="og:image:height" content="298" />';

        $isJob = true;
    }
}

if($isJob ) {

    function main() {
    global $language, $companyInfoPage, $infoJob, $sessionUserId, $jid, $db, $companyInfoPage, $seo_name;
        $infoCmp = $companyInfoPage["db"];
        $companybanner = isset($companyInfoPage["companybanner"]) && count($companyInfoPage["companybanner"]) ? $companyInfoPage["companybanner"] : null;

        $strQueryIsSave = "SELECT id FROM ".TABLE_JOB_SAVED." WHERE ui={$sessionUserId} AND jo={$jid}";
        $isSave = $db->db_array($strQueryIsSave);

        $strQueryApplied = "SELECT id FROM ".TABLE_JOB_APPLIED." WHERE ui={$sessionUserId} AND jo={$jid}";
        $isApplied = $db->db_array($strQueryApplied);

        #update view
        // $strUpdateView = "UPDATE ".TABLE_JOB." SET vi = vi+1 WHERE id = $jid";
        // $db->db_query($strUpdateView);

        #Show view
        $strQueryViewed = "SELECT vi FROM ".TABLE_JOB." WHERE ui={$sessionUserId} AND id={$jid} ";
        $isViewed = $db->db_array($strQueryViewed);

        $strElementData = null;
        $strBtn = null;
        $isJobOfUser = false;

        if(isset($companyInfoPage["db"]["url"]) && $companyInfoPage["db"]["url"] ) {
            $strUrlCmp =  "/".$companyInfoPage["db"]["url"];
        } else {
            $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($companyInfoPage["db"]["name"]))) );
            $strUrlCmp =  "/".$seo_name["page"]["cmp"]."/".$companyInfoPage["db"]["id"]."/".$linkFriendly;
        }


        if(isset($_GET["statistics"]) && $_GET["statistics"]) {
            $strClassStatics = 'class="current"';
        }else{
            $strClassStatics ='';
        }

        // EXPORT SALARY
        $strPrice = $language["negotiable"];

        if(isset($infoJob["db"]["s1"]) && isset($infoJob["db"]["s2"]) && isset($infoJob["db"]["sa"])) {
            if($infoJob["db"]["s2"] != 0 && $infoJob["db"]["s1"] !=0){
                $strPrice = "<span data-format-currency>{$infoJob["db"]["s1"]}</span> - <span data-format-currency>{$infoJob["db"]["s2"]}</span>";
                if($infoJob["db"]["sa"]==2) {
                    $strPrice .= " {$language["currencyOption"][2]}";
                }
                else {
                    $strPrice .= " {$language["currencyOption"][1]}";
                }
            }
        }


        if($infoJob["db"]["ui"] == $sessionUserId) {
            $postLink = '<li><a href="/'.$seo_name["page"]["user"].'?manage=postjob&pid='.$infoCmp["id"].'"
                        class="text-color3"
                        data-button-magics
                        data-elm-data="{"urlRedirect":"/'.$infoCmp["url"].'"}"
                        data-view-template-local="true"
                        data-elm-data="{
                             "missingSession":"true",
                             "hideObj":"[data-quick-view-item1]"
                        }"
                        data-show-success=".alert-footer.alert"
                        data-show-errors=".alert-footer.alert-error"
                        data-show-errors-template="entrySigninPopup"
                        data-view-template="[data-quick-view-item1]"
                        data-template-id="jobsAdd"><span>'.$language["btnPostJob"].'</span></a></li>';
        }else{
            $postLink = '';
        }        

        $strUserTab = '
            <div class="ui-tabs">
                <ul>
                    <li><a href="'.$strUrlCmp.'" >'.$language["newfeed"].'</a></li>
                    <li><a href="'.$strUrlCmp.'/'.$seo_name["page"]["about"].'" >'.$language["about"].'</a></li>
                    <li><a href="'.$strUrlCmp.'/'.$seo_name["page"]["photo"].'" >'.$language["photos"].'</a></li>
                    <li class="current"><a href="'.$strUrlCmp.'/'.$seo_name["page"]["jobs"].'">'.$language["companyJob"].'</a></li>
                    '.$postLink.'
                </ul>
                <div class="clearfix"></div>
            </div>
        ';

        if(isset($_GET["view"]) && $_GET["view"]) {
            $isJobOfUser = false;
        }

        if($infoJob["db"]["ui"] == $sessionUserId) {
            $isJobOfUser = true;
            
            if(isset($_GET["view"]) && $_GET["view"]) {
                $isJobOfUser = false;
            }

            if($isJobOfUser == true):
            $strUserTab = '<div class="cmp">
                <div class="ui-tabs">
                    <ul>
                        <li><a href="/'.$_GET["q"].'">'.$language["content"].'</a></li>
                        <li '.$strClassStatics.'><a href="/'.$_GET["q"].'?statistics=1">'.$language["applied"].'</a></li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>';
            endif;
        }

        elseif($sessionUserId) {
            $strBtn = $isSave && count($isSave) ? ',"saved":"1"': null;
            $strBtn .= $isApplied && count($isApplied) ? ',"applied":"1"': null;
        }

        if($isJobOfUser == false){
            if($infoJob["db"]["ui"] == $sessionUserId){
                
                $infoCmp["im"] = isset($infoCmp["im"]) && count($infoCmp["im"]) ? $infoCmp["im"] : null;

                $strImgLogo = '<div class="update-item-image-logo"
                    data-copy-template
                    data-elm-data=\'{"urlPost":"/api/post/image/company",
                    "urlPostDel":"/api/post/imagedelete",
                    "imgName":"'.$infoCmp["im"].'",
                    "maxSize":"'.maxSizeUpload.'",
                    "imgPath":"'.FOLDERIMAGECOMPANY.'",
                    "module":"user",
                    "ui":"'.$sessionUserId.'",
                    "disabledDelete":"1",
                    "nocol":"1",
                    "itemId":"'.$infoCmp["id"].'"}\'
                    data-view-template=".update-item-image-logo"
                    data-template-id="entryItemImage">
                </div>';

                $strImgBanner = '
                <div class="cmp-more no-padding cover-section no-border">
                    <div class="cover-photo">
                        <div class="update-banner-image"
                            data-copy-template
                            data-elm-data=\'{"urlPost":"/api/post/image/companybanner",
                            "urlPostDel":"/api/post/imagedelete",
                            "maxSize":"'.maxSizeUpload.'",
                            "imgName":"'.$companybanner.'",
                            "imgPath":"'.FOLDERIMAGECOMPANY.'",
                            "module":"banner",
                            "ui":"'.$sessionUserId.'",
                            "disabledDelete":"1",
                            "nocol":"1",
                            "itemId":"'.$infoCmp["id"].'"}\'
                            data-view-template=".update-banner-image"
                            data-template-id="entryItemImage">
                        </div>
                    </div>
                </div>';
            }else{

                $avatar_cmp = isset($infoCmp["im"]) && count($infoCmp["im"]) && $infoCmp["im"] ? '/'.FOLDERIMAGECOMPANY.$infoCmp["im"] : '/img/style/user.png';
                $cover_cmp = isset($companyInfoPage["companybanner"]) && count($companyInfoPage["companybanner"]) ? '/'.FOLDERIMAGECOMPANY.$companybanner : '/img/style/cover-default.jpg';

                $strImgBanner = '<div class="cmp-more no-padding cover-section no-border">
                                   <div class="cover-photo">
                                       <div class="update-banner-image in">
                                           <div class="form-horizontal post-form">
                                               <div class="form-group no-margin">
                                                   <div class="nocol col-xs-12">
                                                       <div class="image-preview transition b-cover b-r-4 v-center">
                                                           <img src="'.$cover_cmp.'">
                                                           <div class="img-with-css transition b-cover b-r-4 v-center" style="background:url('.$cover_cmp.') no-repeat"></div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>';

                $strImgLogo ='  <div class="image-preview b-cover transition b-r-4 c-center">
                                    <img src="'.$avatar_cmp.'" />
                                    <div class="img-with-css b-cover transition c-center" style="background:url('.$avatar_cmp.') no-repeat"></div>
                                </div>';           
            }    
            
            
          }else{
            $strImgBanner = '';
          }

        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $job_link = str_replace("statistics", "view", $actual_link);
        $strElementData = "data-elm-data='{\"actual_link\":\"{$actual_link}\", \"job_link\":\"{$job_link}\", \"uidview\":\"{$sessionUserId}\",\"pid\":\"{$infoCmp["id"]}\",\"ei\":\"{$infoJob["db"]["ui"]}\",\"id\":\"{$jid}\"{$strBtn} }'";
        $hidden_right = '';
        $hidden_left = '';

        if($isJobOfUser){
            $hidden_right = "hidden";
        }else{
            $hidden_left = "hidden";
        
            $strUpdateView = "UPDATE ".TABLE_JOB." SET vi = vi+1 WHERE id = $jid";
            $db->db_query($strUpdateView);
        }

        require_once dirname(__FILE__) . '/../../views/jobs/job_control.php';

    }
}
else {
    require dirname(__FILE__) . '/../general/user_page_not_found.php';
}
?>
