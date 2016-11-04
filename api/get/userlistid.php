<?php
if( !isset($_GET["listID"]) ) {
    return false;
}
if($_GET["listID"]) {
    $listID = explode(',', $_GET["listID"]);
    try {
        foreach ($listID as $key => $id) {
            
            $file   = FOLDERUSER.$id.".xml";
            if(is_file($file)){
                $fileInfo = simplexml_load_file($file);
                $information = json_encode($fileInfo);
                $information = json_decode($information, true);
                $dataResponse[$key] = $information["userinfo"];
                $dataResponse[$key]["db"]["title"] = isset($information["user_cv"]["db"]["title"]) ? $information["user_cv"]["db"]["title"] : '';
                $dataResponse[$key]["db"]["level"] = isset($information["user_cv"]["db"]["level"]) ? $information["user_cv"]["db"]["level"] : '';

            }
            else {
                $dataResponse[$key] = array();
            }
        }
    } catch (Exception $ex) {
        $code = 501;
        $errors = $language["unknownErrors"];
    }
}
else {

    $dataResponse = array();
}
?>
