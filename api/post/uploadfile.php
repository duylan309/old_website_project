<?php
#if (!$sessionUserId)
if (!isset($_SESSION["adminlog"])) {
    $code = 401;
    $message = $language["sessionExpiration"];
} else {
    if(isset($_POST["folder"])) {
        $path = FOLDERUPLOAD.$_POST["folder"];
        $maxSize = isset($_POST["size"]) ? intval($_POST["size"]):100000;
        if($path && is_dir($path)) {
            $filterFiles = null;
            if(isset($_POST["filesoptioned"])&& $_POST["filesoptioned"] ) {
                $filterFiles = explode('::::', $_POST["filesoptioned"]);
            }
            $validextensions = array("size"=>$maxSize, "type" => array("jpeg", "jpg", "png") );
            $img = multiUploadFile($_FILES["file"], $validextensions, $path, $filterFiles);
        }
        else {
            $code = 404;
            $errors = "not found path";
        }
    }
}
?>
