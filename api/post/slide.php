<?php
# check is admin and user is admin
$path = null;
$id= isset($_POST["id"]) ? $_POST["id"] : null;
$maxSize = isset($_POST["db_size"]) ? intval($_POST["db_size"]):100000;
$uid = isset($_POST["ui"]) ? $_POST["ui"] : null;
$company_id = isset($_POST['company_id']) ? $_POST['company_id'] : null;

if ($uid && $id && $sessionUserId == $uid ) {
    if($url_data[3] == "company") {
        $path = FOLDERSLIDECOMPANY.$company_id;
    } elseif($url_data[3] == "user") {
        $path = FOLDERSLIDEUSER.$id;
    }
} elseif (isset($url_data[3]) && isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    if($id) {
        if($url_data[3] == "category") {
            $path = FOLDERSLIDECATEGORY.$id;
        }
        elseif($url_data[3] == "product"){
            $path = FOLDERSLIDEPRODUCT.$id;
        }
        elseif($url_data[3] == "company"){
            $path = FOLDERSLIDECOMPANY.$company_id;
        }
        elseif($url_data[3] == "blog"){
            $path = FOLDERSLIDEBLOG.$id;
        }
    }
}

if($path) {
    if(!is_dir($path)) {
        mkdir($path);
    }
    $filterFiles = null;
    if(isset($_POST["filesoptioned"])&& $_POST["filesoptioned"] ) {
        $filterFiles = explode('::::', $_POST["filesoptioned"]);
    }
  
    $validextensions = array("size"=>$maxSize, "type" => array("jpeg", "jpg", "png") );
    $img = multiUploadFile($_FILES["file"], $validextensions, $path, $filterFiles);
} else {
    $code = 404;
    $errors = "not found path";

}

?>
