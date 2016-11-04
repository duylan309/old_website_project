<?php
function main() {
    global $sessionUserId, $seo_name, $language, $pageUserId, $db, $yourCompany,$url_data;
    $folderUserData = FOLDERUDATA."/".$sessionUserId;

    if( $sessionUserId ) {
        $pageUserId = "&uid={$sessionUserId}";
        if(isset($_GET["manage"])) {
            $strFeature = $_GET["manage"];
            $templateId = null;
            $strGetUrl = null;
            $strOptionLocal = null;
            $strGetScript = null;
            $strElementData = null;

            if($_SESSION["userlog"]["type"]==1) {

                require_once dirname(__FILE__) . "/employer_direction.php";
                
            } elseif($_SESSION["userlog"]["type"]==2) {
                
                require_once dirname(__FILE__) . "/candidate_direction.php";

            }

            if(!isset($noHandbar)):
                echo $strGetScript;
                echo $templateId ? '<div class="user-manage-feature m-t-15"
                        '.$strGetUrl.'
                        '.$strElementData.'
                        '.$strOptionLocal.'
                        data-copy-template
                        data-view-template=".user-manage-feature"
                        data-template-id="'.$templateId.'">&nbsp;</div>':null;
            else:
               require_once $folderFile;
            endif;
        }
        else {
            require_once dirname(__FILE__) . "/candidate/user_profile_update.php";
        }
    } else {
        $strElmData = "{\"seeker\":\"1\", \"type\":\"2\"}";
        if(isset($_GET["signup"]) && $_GET["signup"]=="employment") {
            $strElmData = "{\"employment\":\"1\", \"type\":\"1\"}";
        }
    ?>

    <!-- Signup with Seeker -->
    <div class="u-signup"
        data-copy-template
        data-elm-data='<?=$strElmData?>'
        data-view-template=".u-signup"
        data-template-id="entrySignin"
        >
    </div>
    
<?php
    }
}
