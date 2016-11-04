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
        $strSelect = null;
        $strJoin = null;

        $strOrder = " ORDER BY job.id DESC ";
        $get = isset($_REQUEST) ? $_REQUEST : null;

        if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {

        } elseif(isset($_SESSION["userlog"]["id"]) ) {

            if(isset($get["uid"]) && $get["uid"]==$_SESSION["userlog"]["id"]) {
                $strWhere .= " AND job.st != 9 ";
            } else {
                $strWhere .= " AND user.deactive = 0 ";
                $strWhere .= " AND job.st = 2 ";
                $strWhere .= " AND job.st != 9 ";
            }

        } else {
            $strWhere .= " AND user.deactive = 0 ";
            $strWhere .= " AND job.st = 2 ";
            $strWhere .= " AND job.st != 9 ";
        }

        if (isset($get["title"])) {
            $title_search = null;
            $order_value  = null;
            $title = trim($get["title"]);
            $title = explode(' ', $title);

            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $title_search .= $key == 0 ? " job.ti LIKE '%{$value}%' " : " OR job.ti LIKE '%{$value}%' ";
                    }
                }
            }

            $strWhere .= " AND ( ".$title_search." ) ";

            if(isset($get["distinct"])){
                unset($get["distinct"]);
            }

            $strOrder = " ORDER BY company.id DESC, CASE ".$order_value." END ";
        }

       # echo $strOrder;

        if(isset($get["random"])){
            $strOrder = " ORDER BY RAND() ";
        }

        if (isset($get["uid"]) && $get["uid"]) {
            if($get["uid"]<0){
                $strWhere .= " AND job.ui != " . abs($get["uid"]);
            }
            else {
                $strWhere .= " AND job.ui = " . $get["uid"];
            }
        }

        if (isset($get["limit"]) && $get["limit"]) {
            $strLimit .= " LIMIT 0,{$get["limit"]}";
        }

        if (isset($get["from"]) && $get["from"]) {
            $strWhere .= " AND job.cr >= " . $get["from"];
        }

        if (isset($get["to"]) && $get["to"]) {
            $strWhere .= " AND job.cr <= " . $get["to"];
        }

        if(isset($get["di"])) {
            $strWhere .= " AND company.district = {$get["di"]} ";
        }

        if(isset($get["kind"])){
            $strWhere .= " AND user.status = {$get["kind"]} ";
        }

        $getSelect = isset($get["select"]) ? $get["select"]: null;

        $strWhere .= "  AND job_applied.jo = job.id 
                        AND job_applied.ui = user.id ";

        $strJoin = "LEFT JOIN ".TABLE_COMPANY." AS company
                    ON company.id = job.ci ";

        $strSelect .= "CONCAT ( user.name ,' ', job.ti) AS na,
                        user.email AS ue, 
                        user.name AS name, 
                        user.email AS email, 
                        user.phone AS phone, 
                        user.im AS im, 
                        job_applied.jo AS ji, 
                        job.ti AS t, 
                        job_applied.st AS jas, 
                        job_applied.id AS id, 
                        job_applied.ti AS aw1, 
                        job_applied.de AS aw2, 
                        job_applied.cr AS cr,
                        company.name AS company_name ";

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER." AS user, 
                             ".TABLE_JOB_APPLIED." AS job_applied, 
                             ".TABLE_JOB." AS job
                        {$strJoin}     
                        WHERE 1=1
                        {$strWhere} 
                        ORDER BY job_applied.id DESC 
                        {$strLimit} ";
        # echo $strQuery;
        $dataResponse = $db->objJson($strQuery);
    }
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
