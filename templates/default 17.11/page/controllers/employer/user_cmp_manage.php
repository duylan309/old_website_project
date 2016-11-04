<?php 

$totalCompany = count($yourCompany);

if(isset($_SESSION["userlog"]["page"]) && $_SESSION["userlog"]["page"]) {
    
    $templateId = "entryCmpPageSetting";

    if( isset($_GET["create"]) && $_GET["create"] ) {
        if($_SESSION["userlog"]["page"] > $totalCompany) {
            $strElementData = "data-elm-data='{\"title\":\"Create page/company\"}'";
            $templateId = "entryCmpCreate";
            require_once dirname(__FILE__) . "/../js/facebook_auto_complete_js.php";
            require_once dirname(__FILE__) . "/../js/google_auto_complete_address_js.php";
        } else {
            $strElementData = "data-elm-data='{\"title\":\"Create page/company\"}'";
            $templateId = "entryCmpCreateWarning";
        }
    }

    if( isset($_GET["pid"]) && $_GET["pid"] ) {
        $strElementData = "data-elm-data='{\"title\":\"Edit page/company\"}'";
        $strGetScript = '<script src="'.APIGETCOMPANY.'/'.$_GET["pid"].'&var=window.companyInfomation"></script>';
        $templateId = "entryCmpEditInfo";
    }

}

?>



