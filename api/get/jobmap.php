<?php
try {
    if(isset($url_data[3]) && $url_data[3] ) {
        $iId = intval($url_data[3]);
        $file   = FOLDERJOB.$iId.".xml";
        if(is_file($file)) {
            $fileInfo = simplexml_load_file($file);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);
            // get company post job
            if(1==1){
                $uid = $information["db"]["ui"];
                $filecmp   = FOLDERUSER.$uid.".xml";
                if(is_file($filecmp)) {
                    $fileInfo = simplexml_load_file($filecmp);
                    $informationCmp = json_encode($fileInfo);
                    $informationCmp = json_decode($informationCmp, true);
                }
                $information["company"] = $informationCmp;
            }
            $dataResponse = $information;
            $code = 200;
        }
        else {
            $dataResponse = $language["unknownErrors"];
            $code = 201;
        }
    }
    else {
        $strWhere = null;
        $strGroupBy = null;
        $strLimit = null;
        $strOrder = " ORDER BY j.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {

        } elseif(isset($_SESSION["userlog"]["id"]) ) {

            if(isset($get["uid"]) && $get["uid"]==$_SESSION["userlog"]["id"]) {

            } else {
                $strWhere .= " AND u.deactive = 0 ";
                $strWhere .= " AND j.st = 2 ";
            }

        } else {
            $strWhere .= " AND u.deactive = 0 ";
            $strWhere .= " AND j.st = 2 ";
        }

        if (isset($get["title"]) && !empty($get["title"])) {
            $title_search = null;
            $order_value  = null;
            $title = trim($get["title"]);
            $title = explode(' ', $title);

            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                     $title_search .= $key == 0 ? " CONCAT(j.ti,' ',c.name) LIKE '%{$value}%' " : " OR CONCAT(j.ti,' ',c.name) LIKE '%{$value}%' ";
                     $order_value  .= " WHEN c.name = '".$value."' THEN ".$key;
                    }
                }
            }

            $strWhere .= " AND ( ".$title_search." ) ";

            if(isset($get["distinct"])){
                unset($get["distinct"]);
            }

            $strOrder = " ORDER BY c.id DESC, CASE ".$order_value." END ";
        }

        if(isset($get["deadline"])) {
            $strWhere .= " AND j.de >= CURDATE() ";
        }

        if(isset($get["loc"]) && !empty($get["loc"])) {
            // $strWhere .= " AND CONCAT(',',j.lo,',')  LIKE '%{$get["loc"]}%' ";
            $strWhere .= " AND co.city={$get["loc"]} ";
        }

        if(isset($get["nat"]) && !empty($get["nat"])) {
            $strWhere .= " AND CONCAT(',',j.co,',')  LIKE '%{$get["nat"]}%' ";
        }

        if(isset($get["cat"]) && !empty($get["cat"])) {
            $strWhere .= " AND CONCAT(',',j.ca,',')  LIKE '%{$get["cat"]}%' ";
        }

        if (isset($get["le"]) && !empty($get["le"])) {
            $str_le = null;
            $title = explode(',',$get["le"]);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_le .= $key == 0 ? " j.le LIKE '%{$value}%' " : " OR j.le LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_le." ) ";
        }

        if (isset($get["ex"]) && !empty($get["ex"])) {
            $str_ex = null;
            $title = explode(',',$get["ex"]);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_ex .= $key == 0 ? " j.ex LIKE '%{$value}%' " : " OR j.ex LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_ex." ) ";
        }

        if (isset($get["ty"]) && !empty($get["ty"])) {
            $str_ty = null;
            $title = explode(',',$get["ty"]);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_ty .= $key == 0 ? " j.ty LIKE '%{$value}%' " : " OR j.ty LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_ty." ) ";
        }

        if (isset($get["la"]) && !empty($get["la"])) {
            $str_la = null;
            $title  = explode(',',$get["la"]);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_la .= $key == 0 ? " j.la LIKE '%{$value}%' " : " OR j.la LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_la." ) ";
        }

        if(isset($get["sa"])) {
            $strSalary = str_replace(',','', $get["sa"]);
            $strSalary = str_replace('.','', $get["sa"]);
            $salary = intval($strSalary);
        }    

        if (isset($get["uid"]) && $get["uid"]) {
            if($get["uid"]<0){
                $strWhere .= " AND j.ui != " . abs($get["uid"]);
            }
            else {
                $strWhere .= " AND j.ui = " . $get["uid"];
            }
        }

        if (isset($get["cid"]) && !empty($get["cid"])) {
            if($get["cid"]<0){
                $strWhere .= " AND j.ci != " . abs($get["cid"]);
            }
            else {
                $strWhere .= " AND j.ci = " . $get["cid"];
            }
        }

        if(isset($get["st"]) && !empty($get["st"])) {
            $strWhere .= " AND j.st = {$get["st"]} ";
        }

        if(isset($get["stg"])) {
            $strWhere .= " AND j.st >= {$get["stg"]} ";
        }

        if(isset($get["sti"])) {
            $strWhere .= " AND j.st IN ({$get["sti"]}) ";
        }

       # echo $strWhere;

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        if(isset($get["distinct"])) {
           // $strGroupBy = " GROUP BY co.id ";
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND j.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND j.cr <= " . $get["to"];
        }

        // if(isset($get["di"]) && $get["di"]!= 0) {
        //     $strWhere .= " AND c.district = {$get["di"]} "; 
        // }

        if(isset($get["fromlat"]) && isset($get["tolat"]) && isset($get["fromlng"]) && isset($get["tolng"]) && !empty($get["fromlat"]) && !empty($get["tolat"]) && !empty($get["fromlng"]) && !empty($get["tolng"])){
            $strWhere .= " AND ( co.lat <=".$get["tolat"]." AND co.lat >=".$get["fromlat"]." AND co.lng <=".$get["tolng"]." AND co.lng >=".$get["fromlng"]." ) ";
        }   

        if(isset($get["noId"]) && !empty($get["noId"])){
            $array_not_in_id = is_array($get["noId"]) ? implode(',', $get["noId"]) : $get["noId"];
            $strWhere .= " AND j.ci NOT IN ({$array_not_in_id})";
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;
        $strSelect = "j.id AS id, j.ui AS ui, j.ci AS ci, j.ti AS ti, j.le AS le, j.ty AS ty, j.ex AS ex, j.sa AS sa, j.sn AS sn, j.s1 AS s1, j.s2 AS s2, j.s3 AS s3, j.s4 AS s4, j.co AS co, j.ca AS ca, j.st AS st, j.la AS la, j.location_id AS location_id, j.de AS de, j.cr AS cr,
                      c.name AS na, c.im AS im, c.url AS us, co.city AS cci, co.lat AS lat, co.lng AS lng, co.city AS lo ";



        if(isset($get["ne"]) && $get["ne"]){
            $strSelect .= ", (SELECT COUNT(jd.id) FROM ".TABLE_JOB_APPLIED." AS jd WHERE jd.ei=".intval($get["uid"])." AND jd.jo = j.id AND jd.st = 0 ) AS ne ";
            $strOrder  = "ORDER BY ne DESC, j.id DESC  ";
        }

        $strJoin = "LEFT JOIN ".TABLE_COMPANY." AS c
                    ON co.company_id=c.id ";


        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_JOB." AS j, ".TABLE_USER." AS u, ".TABLE_COMPANY_LOCATION." AS co 
                        {$strJoin}
                        WHERE   u.id      = co.ui 
                                AND co.id = j.location_id 
                                AND u.dayleft > {$currentTime} 
                                {$strWhere} 
                        {$strGroupBy} 
                        {$strOrder} 
                        {$strLimit} ";
       
        # echo $strQuery; 
        $dataResponse = $db->objJson($strQuery);
    }
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
