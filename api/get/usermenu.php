<?php
if(isset($url_data[3]) && $url_data[3]) {
    $uid = $url_data[3];
    if( isset($_GET["mid"]) && $_GET["mid"] ) {
        $mid = $_GET["mid"];
        $filemenuDetail = FOLDERUDATA."/{$uid}".UDATAMENU."{$mid}.xml";
        $information = null;

        if (is_file($filemenuDetail)) {
            $information = simplexml_load_file($filemenuDetail);
            $information = json_encode($information);
            $information = json_decode($information, true);
            if(isset($_GET["detail"])) {
                $detailList = isset($information["detail"])?$information["detail"] : null;
                $json = array();
                if($detailList){
                    foreach($detailList as $key=> $value){
                        $value["menuid"] = $mid;
                        $json[] = $value;
                    }
                }
                $code = 200;
                $dataResponse = $json;
            } elseif(isset($_GET["detailId"])) {
                $detailId  = $_GET["detailId"];
                $node = "n_{$detailId}";
                if(isset($information["detail"][$node])) {
                    $code = 200;
                    $information["detail"][$node]["menuid"] = $mid;
                    $dataResponse["detail"] = $information["detail"][$node];
                } else {
                    die();
                }
            } else {
                $code = 200;
                $dataResponse = $information;
            }
        }

    } else {

        $filemenu = FOLDERUDATA."/{$uid}".UDATAMENU."menu.xml";
        $information = null;
        if (is_file($filemenu)) {
            $information = simplexml_load_file($filemenu);
            $information = json_encode($information);
            $information = json_decode($information, true);
        }

        if (!$information) {
            $dataResponse = array();
        }
        else {
            $dataList = $information["table"];
            if (isset($_GET["opp"]) && $_GET["opp"]) {
                $dataList = arrSearch($dataList, "opp=={$_GET["opp"]}");
            }

            if (isset($_GET["pa"]) && $_GET["pa"]) {
                $dataList = arrSearch($dataList, "pa=={$_GET["pa"]}");
            }

            if (isset($_GET["st"]) && $_GET["st"]) {
                $dataList = arrSearch($dataList, "st=={$_GET["st"]}");
            }

            if (isset($_GET["st_l"]) ) {
                $_GET["st_l"] = intval($_GET["st_l"])>0 ? intval($_GET["st_l"]):0;
                $dataList = arrSearch($dataList, "st<={$_GET["st_l"]}");
            }
            if (isset($_GET["st_g"]) ) {
                $_GET["st_g"] = intval($_GET["st_g"])>0 ? intval($_GET["st_g"]):0;
                $dataList = arrSearch($dataList, "st>={$_GET["st_g"]}");
            }
            $dataResponse = array_values($dataList);
        }
    }
} else {
    $dataResponse = null;
}
?>
