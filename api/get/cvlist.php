<?php
if( !isset($_GET["listID"]) ) {
    return false;
}
$listID = explode(',', $_GET["listID"]);

if($listID) {
    try {
        foreach ($listID as $id) {
            $file   = FOLDERCV.$id.".xml";
            if(is_file($file)){
                $fileInfo = simplexml_load_file($file);
                $information = json_encode($fileInfo);
                $information = json_decode($information, true);
                if(isset($information["db"]["ui"])) {
                    $userId = intval($information["db"]["ui"]);
                    $userFile  = FOLDERUSER.$userId.".xml";
                    if(is_file($userFile)){
                        $cmpInfo = simplexml_load_file($userFile);
                        $cmpInfo = json_encode($cmpInfo);
                        $cmpInfo = json_decode($cmpInfo, true);
                        $information["cmp"] =  isset($cmpInfo["userinfo"]["db"]) ? $cmpInfo["userinfo"]["db"]:array();
                    }
                }
                $dataResponse[] = $information;
            }
            else {
                $dataResponse[] = array();
            }
        }
    } catch (Exception $ex) {
        $code = 501;
        $errors = $language["unknownErrors"];
    }
}
?>
