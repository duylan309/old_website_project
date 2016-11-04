<?php
try{
    if(isset($url_data[3]) && $url_data[3] ) {
        # Get blog detail
        $iId = $url_data[3];
        $file = FOLDERNEWS . "{$iId}.xml";
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
            }
            else {
                $code = 200;
                $dataResponse = $information;
            }

        } else {
            die();
        }
    }
    else {
        # Get list news
        $strWhere = null;
        $strLimit = null;
        $strOrder = " ORDER BY b.id DESC ";

        $get = isset($_GET) ? $_GET : null;

        // $post = isset($_POST)?$_POST:null;
        if (isset($get["title"])) {
            $title = trim($get["title"]);
            $title = explode(' ', $title);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $strWhere .= " AND b.ti LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["uid"]) && $get["uid"]) {
            $strWhere .= " AND b.ui = " . $get["uid"];
        }

        if (isset($get["catId"]) && $get["catId"]) {
            $strWhere .= " AND CONCAT(',',b.ca,',') LIKE '%,{$get["catId"]},%'";
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND b.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND b.cr <= " . $get["to"];
        }

        if(isset($get["limit"]) && $get["limit"]){
            $strLimit .= " LIMIT 0,".intval($get["limit"]);
        }

        if (isset($get["status"]) && $get["status"]) {
            $status = explode(',', $get["status"]);
            if(count($status)>1) {
                $strWhere .= " AND b.st in (".implode($status, ",").") ";
            }
            else {
                $strWhere .= " AND b.st >= {$get["status"]} ";
            }
        }
        else {
            $strWhere .= " AND b.st >= 0 ";
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;


        $strSelect = "b.id AS id, b.ti_{$langcode} AS ti, b.co_{$langcode} AS co, b.me AS me, b.nf AS nf, b.im AS im, b.cr AS cr, UNIX_TIMESTAMP(NOW())-b.cr AS ag, b.st AS st ";

        $strQuery = "SELECT $strSelect
                        FROM ".TABLE_NEWS." AS b
                        WHERE 1= 1 {$strWhere} {$strOrder} {$strLimit}";
        $dataResponse = $db->objJson($strQuery);
    }

} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
