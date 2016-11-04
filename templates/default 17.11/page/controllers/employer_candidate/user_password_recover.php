<?php
$web_title = "Recovery Password";
function main() {
    global $informationConfig, $db, $language, $seo_name, $url_data, $getUrl;
    $strElementData = null;

    $feature = isset($_GET["st"]) ? $_GET["st"] : 0;

    if($feature != 0 ){
        $strElementData = "data-elm-data='{\"st\":\"1\",\"em\":\"".$_GET["em"]."\"}'";
    }


    if(isset($url_data[1])) {
        $str_query = "SELECT * FROM ".TABLE_USER_RECOVERYPW." WHERE url='{$url_data[1]}' AND st=0 LIMIT 0,1";
        $row = $db->db_array($str_query);
        if($row) {
            $strElementData = "data-elm-data='{\"reset\":\"{$url_data[1]}\"}'";
        }
        else {

        }
    }

    require dirname(__FILE__) . "/../../views/general/user_password_recover.php";
    
}
?>
