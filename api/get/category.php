<?php
try{
    if(isset($url_data[3]) && $url_data[3] ) {
        # Get detail
        $iId = $url_data[3];
        $file = FOLDERCATEGORY . "{$iId}.xml";

        if (is_file($file)) {
            $information = simplexml_load_file($file);
            $information = json_encode($information);
            $information = json_decode($information, true);

            if(isset($_GET["detail"])) {
                $detailList = isset($information["detail"])?$information["detail"] : null;
                $json = array();
                if($detailList){
                    foreach($detailList as $key=> $value){
                        $value["blogid"] = $iId;
                        $json[] = $value;
                    }
                }
                $message = $language["apiResponseSuccess"];
                $dataResponse = $json;
            } elseif(isset($_GET["detailId"])) {
                $detailId  = $_GET["detailId"];
                $node = "n_{$detailId}";
                if(isset($information["detail"][$node])) {
                    $code = 200;
                    $information["detail"][$node]["blogid"] = $iId;
                    $dataResponse["detail"] = $information["detail"][$node];
                } else {
                    die();
                }
            } elseif(isset($_GET["jobSuggest"])) {
                $suggestList = isset($information["jobSuggest"])?$information["jobSuggest"] : null;
                $json = array();
                if($suggestList){
                    foreach($suggestList as $key=> $value){
                        $value["blogid"] = $iId;
                        $json[] = $value;
                    }
                }
                $message = $language["apiResponseSuccess"];
                $dataResponse = $json;
            }  elseif(isset($_GET["jobSuggestId"])) {
                $suggestId  = $_GET["jobSuggestId"];
                $node = "n_{$suggestId}";
                if(isset($information["jobSuggest"][$node])) {
                    $code = 200;
                    $dataResponse = $information["jobSuggest"][$node];
                } else {
                    die();
                }
            }
            else {
                $code = 200;
                $dataResponse = $information;
            }
        } else {
            die();
        }
    } elseif(isset($get["jobsuggest"])) {
        $json = array();
        if($get["jobsuggest"]) {
            # Get detail
            $iId = $get["jobsuggest"];
            $file = FOLDERCATEGORY . "{$iId}.xml";
            if (is_file($file)) {
                $information = simplexml_load_file($file);
                $information = json_encode($information);
                $information = json_decode($information, true);

                $suggestList = isset($information["jobSuggest"])?$information["jobSuggest"] : null;

                if($suggestList){
                    foreach($suggestList as $key=> $value){
                        $json[] = array("id"=>$value["db"]["id"], "ti"=>$value["db"]["ti"] );
                    }
                }
            }
        }
        $message = $language["apiResponseSuccess"];
        $dataResponse = $json;
    }
    else {
        # Get list
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY c.id DESC ";

        $get = isset($_REQUEST) ? $_REQUEST : null;
        // $post = isset($_POST)?$_POST:null;
        if (isset($get["title"])) {
            $title = trim($get["title"]);
            $title = explode(' ', $title);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $strWhere .= " AND c.ti LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["uid"]) && $get["uid"]) {
            $strWhere .= " AND c.uid = " . $get["uid"];
        }

        if(isset($get["limit"]) && $get["limit"]){
            $strLimit .= " LIMIT 0,".intval($get["limit"]);
        }

        if (isset($get["status"]) && $get["status"]) {
            $status = explode(',', $get["status"]) ;
        }
        else {
            $strWhere .= " AND c.st >= 0 ";
        }

        $strSelect = "id, im, ti_{$langcode} AS ti, url, link, opp, pa, ism, ct, so, nv, st ";
        $strQuery = "SELECT {$strSelect}
                        FROM ".TABLE_CATEGORY." AS c
                        WHERE 1= 1 {$strWhere} {$strOrder} {$strLimit}";
        $dataResponse = $db->objJson($strQuery);
        $message = "list data";
    }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
