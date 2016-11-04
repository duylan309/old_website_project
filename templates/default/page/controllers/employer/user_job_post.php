<?php 
$templateId = "entryCmpPostJob";

$pid = isset($_GET["pid"]) ? ",\"pid\":\"{$_GET["pid"]}\"" : null;


# check before postjob
$isUserAddJob    = false;
$isComopanyUser  = false;
$unlimitedStatus = 3;

# check user jobleft before create job

$strQueryUserCheck = "SELECT id, status, jobleft, dayleft FROM ".TABLE_USER." WHERE id= {$sessionUserId}";
$rowUserCheck = $db->db_array ($strQueryUserCheck);

if($rowUserCheck["jobleft"] > 0 || $rowUserCheck["status"]== $unlimitedStatus) {
    $isUserAddJob = true;
}

# end check before post job

if($isUserAddJob == true): # OPEN CHECK JOB

    if(isset($_POST["autofilejob"]) && isset($_POST["jobsuggest"])) {
        $strElementData = "data-elm-data='{\"autofilejob\":\"{$_POST["autofilejob"]}\",\"jobsuggest\":\"{$_POST["jobsuggest"]}\"}'";
        $strGetUrl = 'data-get-url="'.APIGETCATEGORY.'/'.$_POST["autofilejob"].'?jobSuggestId='.$_POST["jobsuggest"].'"';
    }
    else {
        $strElementData = "data-elm-data='{\"autofilejob\":\"true\"{$pid} }'";
    }

    if(isset($_GET["jid"]) && $_GET["jid"] ) {
        $strElementData = "data-elm-data='{\"autofilejob\":\"false\" {$pid} }'";
        $strGetUrl = 'data-get-url="'.APIGETJOB.'/'.$_GET["jid"].'"';
    }

    if(!$pid){
        $strElementData = "data-elm-data='{\"nopopup\":true}'";
        $templateId = "entryPostJobOptionCompany";
    }else{

        $strGetScript = '<script src="'.APIGETCOMPANY.'/'.$_GET["pid"].'&var=window.companyInfomation"></script>';
        $strQueryisCompany = "SELECT COUNT(id) AS listid, category AS cat FROM ".TABLE_COMPANY." WHERE id=".intval($_GET['pid']);
        $rowTotal = $db->db_array($strQueryisCompany);
        $isCompany = isset($rowTotal["listid"])?$rowTotal["listid"]:null;

        $strElementData = "data-elm-data='{\"autofilejob\":\"true\"{$pid} , \"cat\":\"".$rowTotal["cat"]."\" }'";

        if(!$isCompany){
            $strElementData = "data-elm-data='{\"nopopup\":true}'";
            $templateId = "entryPostJobOptionCompany";
        }
    }

else:
    $strElementData = "data-elm-data='{\"title\":\"Create page/company\"}'";
    $templateId = "entryCmpPostJobWarning";
endif;


echo '<script>
$(function() {
   
    function CheckValidateSalary(){
         
       var n = $(".check-nego input:checked" ).length;
       if(n == 1){
            $(".from-salary").removeClass("invalid");
            $(".salary-input").removeAttr("data-validate");
       }else{
            $(".from-salary").addClass("invalid");
            $(".salary-input").attr("data-validate","");
       }
    }

    $(document).on("click", ".check-nego input[type=checkbox]", CheckValidateSalary);

   
});
</script>';

require dirname(__FILE__) . "/../js/google_auto_complete_address_js.php";
