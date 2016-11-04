<?php
$strLayout = "home";
$linkGotoPage = null;
$permissionAccountCmp = 1;
$pageEmployer = '';
$header    = "normal";
if(isset($_SESSION["userlog"]) && $_SESSION["userlog"]["type"] == 1 && $_SESSION["userlog"]["status"] > 1) {
    $permissionAccountCmp = $_SESSION["userlog"]["status"];
}

if (isset($url_data[0])) {
    $strFirstPage = $url_data[0];
    $pageEmployer = isset($url_data[1]) ? $url_data[1] : '';
    if($strFirstPage == $seo_name["api"]) {
        require "api/index.php";
    } else{
        
        require_once dirname(__FILE__) ."/website_direction.php";

        if($linkGotoPage) {
            function main() {
                global $linkGotoPage;
                echo $linkGotoPage;
            }
        }
        require_once dirname(__FILE__) . "/layout/{$strLayout}.php";
    }
}
else {
    require dirname(__FILE__) . "/page/home.php";
    require_once dirname(__FILE__) . "/layout/{$strLayout}.php";
}
?>
