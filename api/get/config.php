<?php
$file = FOLDERHOME . "config.xml";

/*if(is_file($fileConfigTemplate)) {
    $file = $fileConfigTemplate;
}
*/
$information = null;

if (is_file($file)) {
    $fileInfo = simplexml_load_file($file);
    $information = json_encode($fileInfo);
    $information = json_decode($information, true);
    if(isset($_GET["sidebar"]) && $_GET["sidebar"]=1){
        $detailList = isset($information["sidebar"])?$information["sidebar"] : null;
        if (isset($url_data[3]) && $url_data[3] ) {
            $dataResponse = null;
            if(isset($detailList["n_{$url_data[3]}"])) {
                $dataResponse = $detailList["n_{$url_data[3]}"];
            }
        }
        else {
            $json = array();
            if($detailList){
                foreach($detailList as $key=> $value){
                    $json[] = $value;
                }
            }
            $dataResponse = $json;
        }
    }
    else {
        if(isset($information["sidebar"])) {
            unset($information["sidebar"]);
        }
        $dataResponse = $information;
    }
}
?>
