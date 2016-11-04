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

        // if (isset($get["title"])) {
           
        //     $title_search = null;
        //     $title_array  = null;
        //     $order_value  = null;

        //     $title = trim($get["title"]);

        //     $title_group = get_string_between(html_entity_decode($title),'"');
           
        //     if($title_group){
        //         $title  = str_replace(array(' "'.trim($title_group).'"','"'.trim($title_group).'"'),'', htmlspecialchars_decode($title));
        //     }

        //     if(strlen($title)){
        //         $title_array  = explode(' ', $title);
        //     }
            
        //     if($title_group){
        //         $title_array[]=$title_group;
        //     }

        //     if($title_array) {
        //         foreach ($title_array as $key => $value) {
        //             if(strlen($value) != 0){
        //                 $title_search .= $key == 0 ? " CONCAT(j.ti,' ',c.name) LIKE '%{$value}%' " : " OR CONCAT(j.ti,' ',c.name) LIKE '%{$value}%' ";
        //                 $order_value  .= " WHEN c.name = '".$value."' THEN ".$key;    
        //             }
        //         }
        //     }


        //     $strWhere .= " AND ( ".$title_search." ) ";

        //     if(isset($get["distinct"])){
        //         unset($get["distinct"]);
        //     }

        //     $strOrder = " ORDER BY c.id DESC, CASE ".$order_value." END ";
        // } else {

        // }

        if (isset($get["title"])) {
           
            $title_search = null;
            $title_array  = null;
            $order_value  = null;
            $title_group  = null;

            $title = trim($get["title"]);

            $title_group = get_string_between(html_entity_decode($title),'"');

            if(!empty($title_group) && $title_group != ''){
                
                if($title_group){
                    $title  = str_replace(array(' "'.trim($title_group).'"','"'.trim($title_group).'"'),'', htmlspecialchars_decode($title));
                }


                $title_search .= " j.ti LIKE '%{$title_group}%' ";
                $title_search .= " OR c.name LIKE '%{$title_group}%' ";
                $title_search .= " OR c.address LIKE '%{$title_group}%' ";

                if(!empty($title) && $title!=''  ){
                    $title_search .= " OR j.ti LIKE '%{$title}%' ";
                    $title_search .= " OR c.name LIKE '%{$title}%' ";
                    $title_search .= " OR c.address LIKE '%{$title}%'";
                }

            }else{
                $title_search .= " j.ti LIKE '%{$title}%' ";
                $title_search .= " OR c.name LIKE '%{$title}%' ";
                $title_search .= " OR c.address LIKE '%{$title}%' ";
            }

            if(isset($get["distinct"])){
                unset($get["distinct"]);
            }

            $strWhere .= " AND ( ".$title_search." ) ";

            // $strOrder = " ORDER BY c.id DESC, CASE ".$order_value." END ";
        } else {

        }
       

        if(isset($get["random"])){
            $strOrder = " ORDER BY RAND() ";
        }

        if(isset($get["loc"])) {
            $strWhere .= " AND co.city={$get["loc"]} ";
        }
        
        if (isset($get["le"])) {
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

        if (isset($get["ex"])) {
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

        if (isset($get["ty"])) {
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

        if (isset($get["la"])) {
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
            $strWhere .= " AND ( j.sn = 1 || ( j.s1 >= {$salary} || j.s3 >= {$salary} ))  ";
        }

        if(isset($get["cati"])) {
            $cati = explode(',',$get["cati"]);
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

        if(isset($get["nojobid"]) && $get["nojobid"] && !is_array($get["nojobid"])){
            if($get["nojobid"] != "Array"){
                $strWhere  .= " AND j.id NOT IN ({$get["nojobid"]}) ";
            }
        }

        $strJoin = "LEFT JOIN ".TABLE_COMPANY." AS c
                    ON co.company_id=c.id ";

        $strGroupBy .= " GROUP BY j.id ";

        if(isset($get["order"]) && $get["order"]){
            if($get["order"] == 1){
                $strOrder = " ORDER BY RAND() ";
            }else if($get["order"] == 2){
                $strOrder = " ORDER BY j.id DESC ";
            }else if($get["order"] == 3){
                $strOrder = " ORDER BY j.vi DESC ";
            }
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_JOB." AS j, 
                             ".TABLE_USER." AS u, 
                             ".TABLE_COMPANY_LOCATION." AS co
                        {$strJoin}
                        WHERE u.id = c.ui 
                        AND c.id = j.ci 
                        AND u.id= j.ui 
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
