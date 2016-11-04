<?php
if (!isset($url_data[3]) || !isset($url_data[4]) ) {
    $code = 404;
    $errors = "not found slide";
} else {
    $id = $url_data[4];
    $slide = $url_data[3];
    $path = null;

    if($slide == "category") {
        $path = FOLDERSLIDECATEGORY.$id;
    } elseif($slide == "user") {
        $path = FOLDERSLIDEUSER.$id;
    } elseif($slide == "company") {
        $path = FOLDERSLIDECOMPANY.$id;
    } elseif($slide == "product"){
        $path = FOLDERSLIDEPRODUCT.$id;
    } elseif($slide == "blog"){
        $path = FOLDERSLIDEBLOG.$id;
    }
     // echo $path;
    if($path) {

        $list_file = readImageInfoInDir($path);
        $dataResponse =$list_file;
    } else {
        $code = 404;
        $errors = "not found slide";
    }
}

