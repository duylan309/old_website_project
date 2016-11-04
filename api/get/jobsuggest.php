<?php
try {
    if(isset($url_data[3]) && $url_data[3] ) {
        $iId = intval($url_data[3]);
        $file   = FOLDERJOB.$iId.".xml";
        if(is_file($file)) {
            $fileInfo = simplexml_load_file($file);
            $information = json_encode($fileInfo);
            $information = json_decode($information, true);
            
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
        $isPermission =0;


        $strOrder = " ORDER BY j.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;
                        
        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
        
            $isPermission = 1;
        
        } elseif(isset($_SESSION["userlog"]["id"]) ) {

            if(isset($get["uid"]) && $get["uid"]==$_SESSION["userlog"]["id"]) {

                $strWhere .= " AND j.st != 9 ";
            
            } else {
            
                $strWhere .= " AND u.deactive = 0 ";
                $strWhere .= " AND j.st = 2 ";
                $strWhere .= " AND j.st != 9 ";
                
            }

        } else {
       
            $strWhere .= " AND u.deactive = 0 ";
            $strWhere .= " AND j.st = 2 ";
            $strWhere .= " AND j.st != 9 ";
       
        }

        if (isset($_SESSION['userlog']['cv']['title']) && !is_array($_SESSION['userlog']['cv']['title']) && !empty($_SESSION['userlog']['cv']['title'])) {
           
            $title_search = null;
            $title_array  = null;
            $order_value  = null;

            $title = trim($_SESSION['userlog']['cv']['title']);

            if(strlen($title)){
                $title_array  = explode(' ', $title);
            }

            if($title_array) {
                foreach ($title_array as $key => $value) {
                    if(strlen($value) != 0){
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

        $strOrder = " ORDER BY RAND() ";

        if (isset($_SESSION['userlog']['cv']['level']) && !is_array($_SESSION['userlog']['cv']['level']) && !empty($_SESSION['userlog']['cv']['level']) ) {
            $str_le = null;
            $title = explode(',',$_SESSION['userlog']['cv']['level']);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_le .= $key == 0 ? " j.le LIKE '%{$value}%' " : " OR j.le LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_le." ) ";
        }

        if ( isset($_SESSION['userlog']['cv']['experience']) && !is_array($_SESSION['userlog']['cv']['experience']) && !empty($_SESSION['userlog']['cv']['experience']) ) {
            $str_ex = null;
            $title = explode(',',$_SESSION['userlog']['cv']['experience']);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_ex .= $key == 0 ? " j.ex LIKE '%{$value}%' " : " OR j.ex LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_ex." ) ";
        }

        if ( isset($_SESSION['userlog']['cv']['type']) && !is_array($_SESSION['userlog']['cv']['type']) && !empty($_SESSION['userlog']['cv']['type']) ) {
            $str_ty = null;
            $title = explode(',',$_SESSION['userlog']['cv']['type']);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_ty .= $key == 0 ? " j.ty LIKE '%{$value}%' " : " OR j.ty LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_ty." ) ";
        }

        if ( isset($_SESSION['userlog']['cv']['lang']) && !is_array($_SESSION['userlog']['cv']['lang']) && !empty($_SESSION['userlog']['cv']['lang']) ) {
            $str_la = null;
            $title  = explode(',',$_SESSION['userlog']['cv']['lang']);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $str_la .= $key == 0 ? " j.la LIKE '%{$value}%' " : " OR j.la LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_la." ) ";
        }

        if( isset($_SESSION['userlog']['cv']['s1']) && !is_array($_SESSION['userlog']['cv']['s1']) && !empty($_SESSION['userlog']['cv']['s1']) ) {
            $strSalary = str_replace('.','', $_SESSION['userlog']['cv']['s1']);
            $salary = intval($strSalary);
            $strWhere .= " AND ( j.sn = 1 || ( j.s1 >= {$salary} || j.s3 >= {$salary} ))  ";
        }

        if (isset($get["uid"]) && $get["uid"]) {
            if($get["uid"]<0){
                $strWhere .= " AND j.ui != " . abs($get["uid"]);
            }
            else {
                $strWhere .= " AND j.ui = " . $get["uid"];
            }
        }

        if(isset($get["st"])) {
            $strWhere .= " AND j.st = {$get["st"]} ";
        }

        if(isset($_SESSION['userlog']['cv']['category']) && !is_array($_SESSION['userlog']['cv']['category']) && !empty($_SESSION['userlog']['cv']['category'])) {

            $cati = explode(',',$_SESSION['userlog']['cv']['category']);
            $str_cati = null;
            if($cati) {
                foreach ($cati as $key => $value) {
                    if($value) {
                        $str_cati .= $key == 0 ? " j.ca LIKE '%{$value}%' " : " OR j.ca LIKE '%{$value}%' ";
                    }
                }
            }
            $strWhere .= " AND ( ".$str_cati." ) ";
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND j.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND j.cr <= " . $get["to"];
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;
        $strSelect = "j.id AS id,
                      j.ui AS ui,
                      j.ci AS ci,
                      j.ti AS ti,
                      j.le AS le,
                      j.ty AS ty,
                      j.ex AS ex,
                      j.sa AS sa,
                      j.sn AS sn,
                      j.s1 AS s1,
                      j.s2 AS s2,
                      j.s3 AS s3,
                      j.s4 AS s4,
                      j.co AS co,
                      j.ca AS ca,
                      j.st AS st,
                      j.la AS la,
                      j.location_id AS location_id,
                      j.de AS de,
                      j.vi AS vi,
                      c.name AS na,
                      c.im AS im,
                      c.url AS us,
                      co.city AS cci,
                      co.address AS address,
                      co.lat AS lat,
                      co.lng AS lng,
                      co.city AS lo ";

        $strJoin = "LEFT JOIN ".TABLE_COMPANY." AS c
                    ON co.company_id=c.id ";

        $strGroupBy .= " GROUP BY j.id ";

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_JOB." AS j, 
                             ".TABLE_USER." AS u, 
                             ".TABLE_COMPANY_LOCATION." AS co
                        {$strJoin}
                        WHERE u.id = c.ui 
                        AND c.id = j.ci 
                        AND u.id= j.ui 
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
