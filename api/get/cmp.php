<?php
try {
    # Get list blog
    $strWhere = null;
    $strLimit = null;
    $strSelectAction = null;
    $strJoin = null;
    $strOrder = " ORDER BY u.id DESC ";
    $get = isset($_REQUEST) ? $_REQUEST : null;

    if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {

    } else {
        $strWhere .= " AND u.deactive = 0 ";
    }

    if (isset($get["title"])) {
        $title = trim($get["title"]);
        $title = explode(' ', $title);
        if($title) {
            foreach ($title as $key => $value) {
                if($value) {
                    $strWhere .= " AND u.name LIKE '%{$value}%' ";
                }
            }
        }
    }

    if(isset($get["loc"])) {
        $strWhere .= " AND u.city == %{$get["loc"]}% ";
    }

    if(isset($get["status"])) {
        $strWhere .= " AND u.status = {$get["status"]} ";
    }
    if(isset($get["statusg"])) {
        $strWhere .= " AND u.status >= {$get["statusg"]} ";
    }
    if(isset($get["statusi"])) {
        $strWhere .= " AND u.status IN ({$get["statusi"]}) ";
    }

    if(isset($get["idi"])) {
        $strWhere .= " AND u.id IN ({$get["idi"]}) ";
    }

    if(isset($get["cat"])) {
        $strWhere .= " AND CONCAT(',',u.category,',')  LIKE '%{$get["cat"]}%' ";
    }

    /*if (isset($get["from"]) && $get["from"]) {
        $strWhere .= " AND u.created >= " . $get["from"];
    }

    if (isset($get["to"]) && $get["to"]) {
        $strWhere .= " AND u.created <= " . $get["to"];
    }*/

    if (isset($get["limit"]) && $get["limit"]) {
        $strLimit .= " LIMIT {$get["limit"]}";
    }

    if (isset($get["dayleft"]) && $get["dayleft"]) {
        $strOrder = $get["dayleft"] == 1 ? " ORDER BY tc ASC " : " ORDER BY tc DESC ";
    }

    if (isset($get["last_signin"]) && $get["last_signin"]) {
        $strOrder = $get["last_signin"] == 1 ? " ORDER BY last_signin ASC " : " ORDER BY last_signin DESC ";
    }

    if(isset($get["cmpid"]) && $get["cmpid"] && !is_array($get["cmpid"])){
        if($get["cmpid"] != "Array"){
            $strWhere  = " AND u.id IN ({$get["cmpid"]})";
        }
    }

    $strSelect = "  u.id AS id,
                    u.id AS i,
                    u.name AS na,
                    u.username AS us,
                    u.im AS im,
                    u.address AS ad,
                    u.city AS ci,
                    u.email AS e,
                    u.phone AS p,
                    u.last_signin AS last_signin,
                    CONCAT(u.email, ' ', u.phone) AS ep,
                    u.status AS s,
                    u.dayleft AS dl,
                    u.page AS pa,
                    u.jobleft AS jl,
                    u.dayleft - {$currentTime} AS tc, 
                    u.created AS cr";
    
    if(isset($get["checktotal"]) && $get["checktotal"] && !is_array($get["checktotal"])){
        if($get["checktotal"] != "Array" && $get["checktotal"]==1){

            $strSelect .= ", (SELECT COUNT(jd.id) FROM ".TABLE_JOB_APPLIED." AS jd WHERE u.id=jd.ei) AS totalCandidates ";
            $strSelect .= ", (SELECT COUNT(us.id) FROM ".TABLE_USER_SAVED." AS us WHERE u.id=us.fo AND us.status=1 ) AS totalLike ";
            $strSelect .= ", (SELECT COUNT(us.id) FROM ".TABLE_USER_SAVED." AS us WHERE u.id=us.fo AND us.status=3 ) AS totalInterview ";
            $strSelect .= ", (SELECT COUNT(us.id) FROM ".TABLE_USER_SAVED." AS us WHERE u.id=us.fo AND us.status=4 ) AS totalHire ";
            $strSelect .= ", (SELECT COUNT(us.id) FROM ".TABLE_USER_SAVED." AS us WHERE u.id=us.fo AND us.status=5 ) AS totalDeny ";
            $strSelect .= ", (SELECT c.name FROM ".TABLE_COMPANY." AS c WHERE u.id=c.ui LIMIT 1) AS company_name ";

        }
    }

    $strQuery  = "SELECT $strSelect 
                    FROM ".TABLE_USER." AS u {$strJoin}
                    WHERE u.type = 1 {$strWhere} {$strOrder} {$strLimit}";

    // echo $strQuery;
    $dataResponse = $db->objJson($strQuery);
} catch (Exception $ex) {
   $code = 501;
   $errors = $language["unknownErrors"];
}
?>
