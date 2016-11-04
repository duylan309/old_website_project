<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["uid"]) ? $post["db"]["uid"] : null;



# check is admin and user is admin
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    $type = isset($post["db"]["type"]) ? $post["db"]["type"] : null;
   
    if($type) {

        # update more (SEO Content, More detail ...)
        $iId = isset($post["db"]["id"]) ? $post["db"]["id"] : null;
       
        if($iId) {


            $fileDetail = FOLDERCATEGORY . "{$iId}.xml";
           
            if (is_file($fileDetail)) {
                $itemInfo = simplexml_load_file($fileDetail);
                $itemInfo = json_encode($itemInfo);
                $itemInfo = json_decode($itemInfo, true);



                if($type=="detail") {
                    $strNode = 1;
                    $listDetail = isset($itemInfo[$type]) ? $itemInfo[$type]:null;

                    if (isset($post[$type]["id"]) && $post[$type]["id"]) {
                        $strNode = $post[$type]["id"];
                    } elseif ($listDetail) {
                        $lastobj = end($listDetail);
                        $strNode = intval($lastobj["id"]) + 1;
                    }

                    $post[$type]["id"] = $strNode;
                    $itemInfo[$type]["n_{$strNode}"] = $post[$type];

                }
                else { # more
                
                    # save to database
                    $more_info['de_vi'] = isset($post['more']['description']['vi']) ? $post['more']['description']['vi'] : '';
                    $more_info['de_en'] = isset($post['more']['description']['en']) ? $post['more']['description']['en'] : '';

                    if ($db->db_update($more_info, TABLE_CATEGORY, array("id" => $iId))) {
                       $itemInfo[$type] = $post[$type];
                    }else{

                        die();
                    }


                }


                // save file
                saveXMLFile($fileDetail, $itemInfo);
                $code = 200;
                $message = $language["updateSuccess"];
            }
        }
        else {
            die();
        }

    } elseif($nodeUpdate && $nodeUpdate == "db") {

        if(!isset($post[$nodeUpdate])) {
            die();
        }

        $infoUpdate = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

        if(isset($infoUpdate["id"]) && $infoUpdate["id"] ) {
            # update row
            $iId = $infoUpdate["id"];
            $file = FOLDERCATEGORY . "{$iId}.xml";

            if (is_file($file)) {
                $information = simplexml_load_file($file);
                $information = json_encode($information);
                $information = json_decode($information, true);
            }

            foreach ($infoUpdate as $key => $value) {
                $information["db"][$key] = $value;
            }

            if ($db->db_update($infoUpdate, TABLE_CATEGORY, array("id" => $iId))) {
                saveXMLFile($file, $information);
                $code = 200;
                $message = $language["updateSuccess"];
            }

        }
        else {
            # insert row

            if ($db->db_insert($infoUpdate, TABLE_CATEGORY)) {
                $str_query = "SELECT * FROM ".TABLE_CATEGORY." WHERE uid={$uid} AND url='{$infoUpdate["url"]}' LIMIT 0,1";
                $row = $db->db_array($str_query);
                if ($row) {
                    $file = FOLDERCATEGORY . "{$row["id"]}.xml";
                    $information = array(
                        "db" => $row,
                    );
                    saveXMLFile($file, $information);
                    $code = 200;
                    $message = $language["insertSuccess"];
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
    } elseif($nodeUpdate && $nodeUpdate == "del") {
        # delete item
        $iId = isset($post["id"]) ? $post["id"]:null;
        $uid = isset($post["uid"]) ? $post["uid"]:null;
        if($iId) {
            if($db->db_delete(TABLE_CATEGORY, array("id"=>$iId)) ){
                # delete image, xml, slide file
                $fileXml = FOLDERCATEGORY . "{$iId}.xml";
                $fileImage = "";
                // delete xml file
                if (is_file($fileXml)) {
                    unlink($fileXml);
                }
                // delete image file
                if (is_file($fileImage)) {
                    unlink($fileImage);
                }
                $message = $language["apiResponseSuccess"];
            }
        }
    }  elseif($nodeUpdate && $nodeUpdate == "detail" && isset($post["delId"])) {
        # delete node detail of item
        $iId = $post["id"];
        $fileDetail = FOLDERCATEGORY . "{$iId}.xml";
        if (is_file($fileDetail)) {
            $itemInfo = simplexml_load_file($fileDetail);
            $itemInfo = json_encode($itemInfo);
            $itemInfo = json_decode($itemInfo, true);
            $strNode = $post["delId"];
            if(isset($itemInfo[$nodeUpdate]["n_{$strNode}"])) {
                unset($itemInfo[$nodeUpdate]["n_{$strNode}"]);
            }
            saveXMLFile($fileDetail, $itemInfo);
        }
    } elseif($nodeUpdate == "jobSuggest" ) {

        $iId = isset($post["id"]) ? $post["id"] : null;
        $fileDetail = FOLDERCATEGORY . "{$iId}.xml";

        if (is_file($fileDetail)) {
            $itemInfo = simplexml_load_file($fileDetail);
            $itemInfo = json_encode($itemInfo);
            $itemInfo = json_decode($itemInfo, true);

            if(isset($post["delId"]) && $post["delId"]) {
                $strNode = $post["delId"];
                if(isset($itemInfo[$nodeUpdate]["n_{$strNode}"])) {
                    unset($itemInfo[$nodeUpdate]["n_{$strNode}"]);
                }
            } else {
                $strNode = 1;
                $listDetail = isset($itemInfo[$nodeUpdate]) ? $itemInfo[$nodeUpdate]:null;
                if (isset($post["db"]["id"]) && $post["db"]["id"]) {
                    $strNode = $post["db"]["id"];
                } elseif ($listDetail) {
                    $lastobj = end($listDetail);
                    $strNode = intval($lastobj["id"]) + 1;
                }
                $post["db"]["ca"] = implode(',', $post["db"]["ca"]);
                $post["db"]["lo"] = implode(',', $post["db"]["lo"]);
                unset($post["categorylist"]);
                unset($post["locationlist"]);
                unset($post["updateNode"]);
                $post["id"] = $strNode;
                $post["db"]["id"] = $strNode;
                $itemInfo[$nodeUpdate]["n_{$strNode}"] = $post;
            }
            // save file
            saveXMLFile($fileDetail, $itemInfo);
            $code = 200;
            $message = $language["updateSuccess"];
        }
        else {
            die();
        }
    }
}
else {
    # missing session
    $errors = "missing session";
    $code = 401;
}

?>
