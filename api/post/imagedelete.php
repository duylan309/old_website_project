<?php
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    if(!isset($post["id"]) || !isset($post["m"]) || !isset($post["name"]) ) {
        die();
    }

    $id = $post["id"];

    $filedata = $filedetail = $fileImage = null;

    if($post["m"] == "category") {
        $table = TABLE_CATEGORY;
        $filedetail = FOLDERCATEGORY."{$id}.xml";
        $fileImage = FOLDERIMAGECATEGORY.$post["name"];
    }

    if(is_file($fileImage) && is_file($filedetail) && isset($table)) {

        $strQueryUpdate = "SELECT * FROM {$table} WHERE id={$id} AND im = '{$post["name"]}' LIMIT 0,1";
        $rowUpdate = $db->db_array($strQueryUpdate);

        // update table
        if($rowUpdate && $db->db_update(array("im" => ""), $table, array("id" => $id)) ){
            // delefile image
            unlink($fileImage);

            $information = simplexml_load_file($filedetail);
            $information = json_encode($information);
            $information = json_decode($information, true);

            if(isset($information["db"]["im"])){
                unset($information["db"]["im"]);
            }
            // save file detail
            saveXMLFile($filedetail, $information);

            $code = 200;
            $message = "image was deleted";
        }
        else {
            $code = 201;
            $message = "image was not deleted";
        }

    }
    else {
        $code = 401;
        $errors = "file not found";
    }
} else {
    $code = 401;
    $errors = $language["sessionExpiration"];
}
?>
