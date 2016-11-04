<?php
$strQuery = "SELECT id, id AS ui, name, username AS url, im, category, phone,
    address, city, website, skype, facebook, size, status, dayleft, jobleft,
    fb_load_newfeed, fb_load_photo, created, deactive FROM ".TABLE_USER." WHERE type = 1";

$list = $db->db_arrayList($strQuery);

if($list) {
    foreach ($list as $key => $value) {
        $fileUser = FOLDERUSER.$value["id"].".xml";
        $fileCmp = FOLDERCOMPANY.$value["id"].".xml";

        if(is_file($fileUser)) {
            $fileInfo = simplexml_load_file($fileUser);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);
            if(isset($information["userinfo"])) {
                unset($information["userinfo"]) ;
            }
        }
        $information["db"] = $value;

        if ($db->db_insert($value, TABLE_COMPANY)) {
            saveXMLFile($fileCmp, $information);
        }
    }
}

?>
