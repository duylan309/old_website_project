<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["uid"]) ? $post["db"]["uid"] : null;
$isUpdateUrl = true;
$iId = null;

# check is admin and user is admin
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    $type = isset($post["db"]["type"]) ? $post["db"]["type"] : null;

    if($type && isset($post["{$type}"]) && $type != "db") {
        # update more (SEO Content)
        $iId = isset($post["db"]["id"]) ? $post["db"]["id"] : null;
        $fileDetail = FOLDERHOME . "{$iId}.xml";
        if (is_file($fileDetail)) {
            $itemInfo = simplexml_load_file($fileDetail);
            $itemInfo = json_encode($itemInfo);
            $itemInfo = json_decode($itemInfo, true);
            $itemInfo[$type] = $post[$type];
            // save file
            saveXMLFile($fileDetail, $itemInfo);
            $code = 200;
            $message = $language["updateSuccess"];
        }

    } elseif($nodeUpdate && $nodeUpdate == "db") {

        if(!isset($post[$nodeUpdate])) {
            die();
        }

        if(isset($post["db"]["id"]) && $post["db"]["id"] ) {
            $iId = $post["db"]["id"];
            $file = FOLDERHOME . "{$iId}.xml";

            if (is_file($file)) {
                $information = simplexml_load_file($file);
                $information = json_encode($information);
                $information = json_decode($information, true);
            }
        }


        $rowUpdate = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

        $rowUpdate = $post["db"];
        $category  = $rowUpdate["ca"];

        $rowUpdate["ty"] = isset($rowUpdate["ty"])? implode(',', $rowUpdate["ty"]) : null;
        $rowUpdate["le"] = isset($rowUpdate["le"])? implode(',', $rowUpdate["le"]) : null;
        $rowUpdate["la"] = isset($rowUpdate["la"])? implode(',', $rowUpdate["la"]) : null;
        $rowUpdate["ex"] = isset($rowUpdate["ex"])? implode(',', $rowUpdate["ex"]) : null;


        #check and update URL
        $currentURL = isset($information["db"]["url"]) ? $information["db"]["url"] : "";
        if( isset($rowUpdate["url"]) && $currentURL != $rowUpdate["url"] ) {
            if($iId) {
                #update URL
                if( $db->db_update(array("url"=>$rowUpdate["url"]), TABLE_URL, array("hid" => $iId) ) ) {
                    $isUpdateUrl = true;
                } else {
                    $isUpdateUrl = false;
                }
            } else {
                $strSelectUrl = "SELECT * FROM ".TABLE_URL." WHERE url='{$rowUpdate["url"]}'";
                $rowUrl = $db->db_array($strSelectUrl);
                if($rowUrl) {
                    $isUpdateUrl = false;
                }
            }
        }

        if($isUpdateUrl) {

            if(isset($rowUpdate['subject']) && $rowUpdate['subject']){
                $rowUpdate['subject'] = htmlspecialchars($rowUpdate['subject']);
            }

            if(isset($rowUpdate["id"]) && $rowUpdate["id"] ) {

                # update row
                foreach ($rowUpdate as $key => $value) {
                    $information["db"][$key] = $value;
                }

                if ($db->db_update($rowUpdate, TABLE_PAGEHTML, array("id" => $iId))) {
                    saveXMLFile($file, $information);
                    $code = 200;
                    $message = $language["updateSuccess"];
                }

            }
            else {
                # insert row
                if ($db->db_insert($rowUpdate, TABLE_PAGEHTML)) {
                    $str_query = "SELECT * FROM ".TABLE_PAGEHTML." WHERE url='{$rowUpdate["url"]}' LIMIT 0,1";
                    $row = $db->db_array($str_query);
                    if ($row) {
                        $db->db_insert( array("hid" => $row["id"], "url"=>$rowUpdate["url"]), TABLE_URL );
                        $file = FOLDERHOME . "{$row["id"]}.xml";
                        $information = array(
                            "db" => $row,
                        );
                        $code = 200;
                        $message = $language["insertSuccess"];
                        saveXMLFile($file, $information);
                    }
                    else {
                        $code = 401;
                        $errors = $language["insertErrors"];
                    }

                } else {
                    $code = 401;
                    $errors = $language["insertErrors"];
                }
            }
        } else {
            #do nothing with url invalid
            $code = 302;
        }
    } elseif($nodeUpdate && $nodeUpdate == "del") {
        # delete item
        $iId = isset($post["id"]) ? $post["id"]:null;
        $uid = isset($post["uid"]) ? $post["uid"]:null;

        if($iId) {

            $fileDetail = FOLDERHOME . "{$iId}.xml";
            if (is_file($fileDetail)) {
                $itemInfo = simplexml_load_file($fileDetail);
                $itemInfo = json_encode($itemInfo);
                $itemInfo = json_decode($itemInfo, true);
            }

            if($db->db_delete(TABLE_PAGEHTML, array("id"=>$iId)) ){
                # delete image, xml, slide file
                if (is_file($fileDetail)) {
                    unlink($fileDetail);
                }
                $message = $language["apiResponseSuccess"];
                $strUrl = isset($itemInfo["db"]["url"])? $itemInfo["db"]["url"] : null;
                # delete url
                if(count($strUrl)) {
                    $db->db_delete(TABLE_URL, array("url"=>$strUrl, "hid"=>$iId));
                }

            }
        }
    }
}
else {
    # missing session
    $errors = "missing session";
    $code = 401;
}

?>
