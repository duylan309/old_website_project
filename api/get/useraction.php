<?php
$uid = isset($_GET["uid"]) ? $_GET["uid"] : null;
$action = isset($_GET["action"]) ? $_GET["action"] : null;
$jid = isset($_GET["jid"]) ? $_GET["jid"] : null;


if($uid && $action) {
    $fileUser   = FOLDERUSER.$uid.".xml";

    if($action == "savejob") {

        $strSelect = "js.*, j.lo AS lo, j.ca AS ca, j.ex AS ex, j.la AS la, j.ti AS na ";

        $strWhere = "WHERE js.ui = $uid AND js.jo = j.id ";

        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strTotal = "SELECT $strSelect FROM ".TABLE_JOB_SAVED." AS js , ".TABLE_JOB." AS j ".$strWhere." ORDER BY js.cr DESC {$strLimit} ";

        # echo $strTotal;

        $dataResponse = $db->objJson($strTotal);

    } elseif($action == "applyjob") {
        $strSelect = "ja.*, j.lo AS lo, j.ca AS ca, j.ex AS ex, j.la AS la, j.ti AS na ";

        $strWhere = "WHERE ja.ui = $uid AND ja.jo = j.id ";

        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        #$strTotal = "SELECT * FROM ".TABLE_JOB_APPLIED." WHERE ui=$uid";
        $strTotal = "SELECT $strSelect FROM ".TABLE_JOB_APPLIED." AS ja , ".TABLE_JOB." AS j ".$strWhere." ORDER BY ja.cr DESC {$strLimit} ";

        $dataResponse = $db->objJson($strTotal);

    }elseif ($action == "userall"){


        $strSelect = "CONCAT ( u.name , ' ', uc.title, ' ', j.ti) AS na, uc.ui AS ui, uc.title AS t,
                    uc.level AS l, uc.experience AS e, u.email AS ue, u.phone AS up, u.city AS uci, u.country AS uco, IF(u.country = 'vn', u.country, CONCAT('for',',',u.country) ) as uco,
                    uc.salary AS sa, uc.s1 AS s1, uc.s2 AS s2, uc.category AS c, uc.location AS lo,
                    uc.skill AS s, ja.jo AS ji, j.ti AS jt, ja.st AS jas, ja.id AS jai, ja.ti AS aw1, ja.de AS aw2, ja.cr AS cr  ";

        $strWhere = "WHERE ( uc.ui = us.ui AND us.fo = $uid AND u.id = uc.ui ) OR (u.id = uc.ui AND uc.ui = ja.ui AND ja.ei=$uid AND j.id=ja.jo )";

        $strLimit = null;

        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }


        $strQuery = "SELECT $strSelect
                        FROM ".TABLE_USER_CV." AS uc, ".TABLE_USER." AS u, ".TABLE_USER_SAVED." AS us, ".TABLE_JOB_APPLIED." AS ja ,".TABLE_JOB." AS j {$strWhere} GROUP BY u.id ORDER BY u.name ASC {$strLimit} ";


        $dataResponse = $db->objJson($strQuery);


    } elseif ($action == "userapply") {

        $strSelect = "  CONCAT (user.name, ' ', user_cv.title,' ', job.ti) AS na,
                        user.email AS ue, 
                        user.name AS name, 
                        user.im AS im, 
                        user.phone AS up, 
                        user.city AS uci, 
                        IF(user.country = 'vn', user.country, CONCAT('for',',',user.country) ) as uco,
                        user_cv.ui AS ui, 
                        user_cv.title AS title, 
                        user_cv.lang AS la,
                        user_cv.level AS l, 
                        user_cv.experience AS e, 
                        user_cv.salary AS sa, 
                        user_cv.s1 AS s1, 
                        user_cv.s2 AS s2,
                        user_cv.category AS c, 
                        user_cv.location AS lo,
                        user_cv.skill AS s, 
                        job_applied.jo AS ji, 
                        job.ti AS t, 
                        job.id AS jid, 
                        job.ci AS pid, 
                        job_applied.st AS jas, 
                        job_applied.id AS jai, 
                        job_applied.ti AS aw1, 
                        job_applied.de AS aw2, 
                        job_applied.cr AS cr,
                        user_save.status AS employer_status ";

        $strWhere = "WHERE user.id   = user_cv.ui 
                     AND user_cv.ui  = job_applied.ui 
                     AND job_applied.ei  = {$uid} 
                     AND job.id   = job_applied.jo ";


        #where table user saved
        $strWhere .= " AND user_save.ui = user.id 
                       AND user_save.fo = {$uid} ";

        if($jid != null) {
            $strWhere .= " AND job_applied.jo={$_GET["jid"]} ";
        }

        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";

        }

        if (isset($get["title"])) {
            $title = trim($get["title"]);
            $title = explode(' ', $title);
            if($title) {
                foreach ($title as $key => $value) {
                    if($value) {
                        $strWhere .= " AND user_cv.title LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if(isset($_GET["jid"]) && $_GET["jid"]) {
            $strWhere .= " AND job_applied.jo={$_GET["jid"]} ";
        }

        if(isset($get["loc"])) {
            $strWhere .= " AND CONCAT(',',user_cv.location,',')  LIKE '%{$get["loc"]}%' ";
        }

        if(isset($get["cat"])) {
            $strWhere .= " AND CONCAT(',',user.category,',')  LIKE '%{$get["cat"]}%' ";
        }

        if(isset($get["ex"])) {
            $strWhere .= " AND CONCAT(',',user_cv.experience,',')  LIKE '%{$get["ex"]}%' ";
        }

        if(isset($get["cid"])) {
            $strWhere .= " AND job.ci={$get["cid"]} ";
        }

      #  echo $strWhere;

        if(isset($get["sa"])) {
            $strSalary = str_replace(',','', $get["sa"]);
            $strSalary = str_replace('.','', $get["sa"]);
            $salary = intval($strSalary);
            $strWhere .= " AND (user.s1 >= {$salary} OR user.s2 >= {$salary} )";
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_CV." AS user_cv, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_JOB_APPLIED." AS job_applied, 
                             ".TABLE_JOB." AS job,
                             ".TABLE_USER_SAVED." AS user_save  
                        {$strWhere} 
                        GROUP BY user.id
                        ORDER BY job_applied.id DESC 
                        {$strLimit} ";

        # echo $strWhere;

        $dataResponse = $db->objJson($strQuery);

    } elseif ($action == "userhire") {
        $strSelect = "CONCAT ( u.name , ' ', uc.title, ' ', j.ti) AS na, uc.ui AS ui, uc.title AS t, IF(u.country = 'vn', u.country, CONCAT('for',',',u.country) ) as uco,
                    uc.level AS l, uc.experience AS e,
                    uc.salary AS sa, uc.s1 AS s1, uc.s2 AS s2, uc.category AS c, uc.location AS lo,
                    uc.skill AS s, ja.jo AS ji, j.ti AS jt, ja.st AS jas, ja.id AS jai  ";

        $strWhere = "WHERE u.id = uc.ui AND uc.ui = ja.ui AND ja.ei=$uid AND j.id=ja.jo AND ja.st=2 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "SELECT $strSelect
                        FROM ".TABLE_USER_CV." AS uc, ".TABLE_USER." AS u, ".TABLE_JOB_APPLIED." AS ja, ".TABLE_JOB." AS j ".$strWhere. " ORDER BY ja.id DESC {$strLimit}";
        # echo $strQuery;
        $dataResponse = $db->objJson($strQuery);
    } elseif ($action == "userdeny") {
        $strSelect = "CONCAT ( u.name , ' ', uc.title, ' ', j.ti) AS na, uc.ui AS ui, uc.title AS t, IF(u.country = 'vn', u.country, CONCAT('for',',',u.country) ) as uco,
                    uc.level AS l, uc.experience AS e,
                    uc.salary AS sa, uc.s1 AS s1, uc.s2 AS s2, uc.category AS c, uc.location AS lo,
                    uc.skill AS s, ja.jo AS ji, j.ti AS jt, ja.st AS jas, ja.id AS jai  ";

        $strWhere = "WHERE u.id = uc.ui AND uc.ui = ja.ui AND ja.ei=$uid AND j.id=ja.jo AND ja.st > 2 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "SELECT $strSelect
                        FROM ".TABLE_USER_CV." AS uc, ".TABLE_USER." AS u, ".TABLE_JOB_APPLIED." AS ja, ".TABLE_JOB." AS j ".$strWhere. " ORDER BY ja.id DESC {$strLimit}";
        // echo $strQuery;
        $dataResponse = $db->objJson($strQuery);
    } elseif ($action == "usersave") {

        $strSelect = "CONCAT ( user.name , ' | ' , user_cv.title) AS na,
                       user_cv.ui AS ui,
                       user_cv.title AS t,
                       user.email AS ue, 
                       user.phone AS up,
                       IF(user.country = 'vn', user.country, CONCAT('for',',',user.country) ) as uco,
                       user_cv.level AS l,
                       user_cv.experience AS e,
                       user_cv.salary AS sa, 
                       user_cv.s1 AS s1, 
                       user_cv.s2 AS s2, 
                       user_cv.category AS c, 
                       user_cv.location AS lo,
                       user_cv.skill AS s, 
                       usersave.cr AS cr, 
                       usersave.status AS employer_status ";

        $strWhere = " WHERE user_cv.ui = usersave.ui AND usersave.fo = $uid AND user.id = user_cv.ui AND usersave.status = 1 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_SAVED." AS usersave, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_USER_CV." AS user_cv 
                             ".$strWhere. "ORDER BY usersave.id DESC {$strLimit}";

        $dataResponse = $db->objJson($strQuery);
    } elseif ($action == "interview") {

        $strSelect = "CONCAT ( user.name , ' | ' , user_cv.title) AS na,
                    user_cv.ui AS ui, 
                    user_cv.title AS t, 
                    user.email AS ue, 
                    user.phone AS up,
                    IF(user.country = 'vn', user.country, CONCAT('for',',',user.country) ) as uco,
                    user_cv.level AS l, 
                    user_cv.experience AS e,
                    user_cv.salary AS sa, 
                    user_cv.s1 AS s1, 
                    user_cv.s2 AS s2, 
                    user_cv.category AS c, 
                    user_cv.location AS lo,
                    user_cv.skill AS s, 
                    usersave.cr AS cr, 
                    usersave.status AS employer_status ";

        $strWhere = " WHERE user_cv.ui = usersave.ui AND usersave.fo = $uid AND user.id = user_cv.ui AND usersave.status = 3 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_SAVED." AS usersave, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_USER_CV." AS user_cv 
                             ".$strWhere. "ORDER BY usersave.id DESC {$strLimit}";

        $dataResponse = $db->objJson($strQuery);
    } elseif ($action == "hire") {

        $strSelect = "CONCAT ( user.name , ' | ' , user_cv.title) AS na,
                    user_cv.ui AS ui, 
                    user_cv.title AS t, 
                    user.email AS ue, 
                    user.phone AS up,
                    IF(user.country = 'vn', user.country, CONCAT('for',',',user.country) ) as uco,
                    user_cv.level AS l, 
                    user_cv.experience AS e,
                    user_cv.salary AS sa, 
                    user_cv.s1 AS s1, 
                    user_cv.s2 AS s2, 
                    user_cv.category AS c, 
                    user_cv.location AS lo,
                    user_cv.skill AS s, 
                    usersave.cr AS cr, 
                    usersave.status AS employer_status ";

        $strWhere = " WHERE user_cv.ui = usersave.ui AND usersave.fo = $uid AND user.id = user_cv.ui AND usersave.status = 4 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_SAVED." AS usersave, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_USER_CV." AS user_cv 
                             ".$strWhere. "ORDER BY usersave.id DESC {$strLimit}";

        $dataResponse = $db->objJson($strQuery);
    } elseif ($action == "deny") {

        $strSelect = "CONCAT ( user.name , ' | ' , user_cv.title) AS na,
                    user_cv.ui AS ui, 
                    user_cv.title AS t, 
                    user.email AS ue, 
                    user.phone AS up,
                    IF(user.country = 'vn', user.country, CONCAT('for',',',user.country) ) as uco,
                    user_cv.level AS l, 
                    user_cv.experience AS e,
                    user_cv.salary AS sa, 
                    user_cv.s1 AS s1, 
                    user_cv.s2 AS s2, 
                    user_cv.category AS c, 
                    user_cv.location AS lo,
                    user_cv.skill AS s, 
                    usersave.cr AS cr, 
                    usersave.status AS employer_status ";

        $strWhere = " WHERE user_cv.ui = usersave.ui AND usersave.fo = $uid AND user.id = user_cv.ui AND usersave.status = 5 ";
        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_SAVED." AS usersave, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_USER_CV." AS user_cv 
                             ".$strWhere. "ORDER BY usersave.id DESC {$strLimit}";

        $dataResponse = $db->objJson($strQuery);
    
    } elseif ($action == "userapplicants") {

        $strSelect = "  CONCAT ( user.name ,' ', user.email,' ',user.phone) AS na,
                        user.email AS ue, 
                        user.name AS name, 
                        user.im AS im, 
                        user.phone AS up, 
                        user.city AS uci, 
                        user_cv.ui AS ui, 
                        user_cv.title AS title, 
                        user_cv.location AS lo,
                        job_applied.jo AS ji";

        $strWhere = "WHERE  user.id = user_cv.ui 
                            AND user_cv.ui  = job_applied.ui 
                            AND job_applied.ei  = {$uid} ";

        $strLimit = null;
        if(isset($_GET["limit"]) && $_GET["limit"]) {
            $strLimit .=" LIMIT 0 , {$_GET["limit"]} ";

        }

        if (isset($get["name"])) {
            $name = trim($get["name"]);
            $name = explode(' ', $name);
            if($name) {
                foreach ($name as $key => $value) {
                    if($value) {
                        $strWhere .= " AND user.name LIKE '%{$value}%' ";
                    }
                }
            }
        }

        if (isset($get["search"])) {
            $search = trim($get["search"]);
            $search = explode(' ', $search);
            if($search) {
                foreach ($search as $key => $value) {
                    if($value) {
                        $strWhere .= " AND (CONCAT (user.name ,' ', user.email,' ',user.phone) LIKE '%{$value}%' )  ";
                    }
                }
            }
        }

        $strQuery = "   SELECT $strSelect
                        FROM ".TABLE_USER_CV." AS user_cv, 
                             ".TABLE_USER." AS user, 
                             ".TABLE_JOB_APPLIED." AS job_applied 
                        {$strWhere} 
                        GROUP BY user.id
                        ORDER BY job_applied.id DESC 
                        {$strLimit} ";

        # echo $strQuery;

        $dataResponse = $db->objJson($strQuery);
        $code = 200;
        
    }
}
?>
