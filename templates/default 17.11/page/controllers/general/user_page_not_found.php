<?php
$code = 404;
$data = $message = null;

function main() {
    global $seo_name, $language, $informationConfig,$url_data;
    $about = isset($informationConfig["config"]["about"])? $informationConfig["config"]["about"] : null;
    $errors = isset($about["pageNotfound"]) && count($about["pageNotfound"]) ? $about["pageNotfound"] : "page not found";
    if($url_data[0] != $seo_name["page"]["error"]){
   		echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
    }

    require dirname(__FILE__) . "/../../views/general/user_page_not_found.php";

}
?>
