<?php
if( !isset($_GET["listID"]) ) {
    return false;
}
if($_GET["listID"]) {

    $listID = explode(',', $_GET["listID"]);
    if($listID) {
        try {
            foreach ($listID as $id) {
                $file   = FOLDERJOB.$id.".xml";
                if(is_file($file)){
                    $fileInfo = simplexml_load_file($file);
                    $information = json_encode($fileInfo);
                    $information = json_decode($information, true);

                    if(isset($information["db"]["ci"])) {
                        $cmpId = intval($information["db"]["ci"]);
                        $cmpFile  = FOLDERCOMPANY.$cmpId.".xml";
                        if(is_file($cmpFile)){
                            $cmpInfo = simplexml_load_file($cmpFile);
                            $cmpInfo = json_encode($cmpInfo);
                            $cmpInfo = json_decode($cmpInfo, true);
                            $information["cmp"] =  isset($cmpInfo["db"]) ? $cmpInfo["db"]:array();
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
} else {
    $dataResponse = array();
}
?>
