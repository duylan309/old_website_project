<?php
$yourCompany = null;
if($sessionUserId):
    if($_SESSION["userlog"]["type"] == 1) {

        $strQueryCompany = "SELECT * FROM ".TABLE_COMPANY." WHERE ui={$sessionUserId}";
        $yourCompany = $db->db_arrayList($strQueryCompany);
        $totalCompany = count($yourCompany);

        $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($_SESSION["userlog"]["name"]))) );

        if($_SESSION["userlog"]["username"]){
            $cmp_link = '/'.$_SESSION["userlog"]["username"];
        }else{
            $cmp_link = '/'.$seo_name["page"]["cmp"].'/'.$_SESSION["userlog"]["id"].'/'.$linkFriendly;
        }

        $strSelectNoti = "CONCAT ( u.name , ' ', uc.title, ' ', j.ti) AS na, u.name AS na, uc.ui AS ui, uc.title AS t, u.im AS im,
        ja.jo AS ji, j.ti AS jt, ja.st AS jas, ja.id AS jai, ja.ti AS aw1, ja.de AS aw2, ja.cr AS cr ";
        
        if($_SESSION["userlog"] && isset($_SESSION["usersub"])){
            $strWhereNoti  = "WHERE u.id = uc.ui AND uc.ui = ja.ui AND ja.ei={$_SESSION["userlog"]["id"]} AND j.id=ja.jo AND j.ci={$_SESSION["usersub"]["id"]} ";
        }else{
            $strWhereNoti  = "WHERE u.id = uc.ui AND uc.ui = ja.ui AND ja.ei={$_SESSION["userlog"]["id"]} AND j.id=ja.jo ";
        }
        
        $strQueryNoti  = "  SELECT $strSelectNoti
                            FROM ".TABLE_USER_CV." AS uc, 
                                 ".TABLE_USER." AS u, 
                                 ".TABLE_JOB_APPLIED." AS ja, 
                                 ".TABLE_JOB." AS j 
                            {$strWhereNoti} 
                            ORDER BY ja.id DESC limit 10";
        $listNotification = $db->db_arrayList($strQueryNoti);

        if($_SESSION["userlog"] && isset($_SESSION["usersub"])){
            $strQueryTotal = "SELECT COUNT(ja.id) AS total FROM ".TABLE_JOB_APPLIED." AS ja, ".TABLE_JOB." AS j WHERE  ja.jo=j.id AND j.ci={$_SESSION["usersub"]["id"]} AND ja.st = 0";
        }else{
            $strQueryTotal = "SELECT COUNT(*) AS total FROM ".TABLE_JOB_APPLIED." WHERE ei={$_SESSION["userlog"]["id"]} AND st = 0";
        }
        # echo $strQueryTotal;
        $totalNotification = $db->db_array($strQueryTotal);
        $totalNotification["total"] = count($totalNotification) == 0 ? 0 : $totalNotification["total"];

    }

    $strWhere = null;          
    $strOrder = " ORDER BY messages.status ASC, messages.id DESC ";
    $get = isset($_REQUEST) ? $_REQUEST : null;

    $strSelect = "  messages.*,
                    CONCAT(messages.subject,' ',company.name,' ',user.name) AS ti,
                    company.name AS company_name,
                    company.url AS company_url,
                    company.im AS company_image,
                    user.name AS user_name,
                    user.im AS user_image";

    if (isset($get["limit"]) && $get["limit"]) {
        $strLimit .= " LIMIT 0,{$get["limit"]}";
    }
    
    if($_SESSION["userlog"]["type"] == 2){
        $strWhere .= "  AND messages.user_status != 9
                        AND messages.user_id = user.id
                        AND messages.status = 0
                        AND messages.company_id = company.id
                        AND messages.user_id = {$sessionUserId} 
                        AND messages.receiver_id = {$sessionUserId}
                        AND messages.id IN ( SELECT MAX(id)
                        FROM ".TABLE_MESSAGES." AS mess
                        WHERE receiver_id = {$sessionUserId}
                        GROUP BY mess.message_id ) ";
    }elseif($_SESSION["userlog"]["type"] == 1){
        $strWhere .= "  AND messages.employer_status != 9
                        AND messages.user_id = user.id
                        AND messages.status = 0
                        AND messages.company_id = company.id
                        AND messages.employer_id = {$sessionUserId} 
                        AND messages.receiver_id = {$sessionUserId}
                        AND messages.id IN ( SELECT MAX(id)
                        FROM ".TABLE_MESSAGES." AS mess
                        WHERE receiver_id = {$sessionUserId}
                        GROUP BY mess.message_id ) ";
    }
    

    # SHOW STATUS
    $strQuery  = "  SELECT $strSelect
                    FROM ".TABLE_MESSAGES." AS messages,
                         ".TABLE_USER." AS user,
                         ".TABLE_COMPANY." AS company
                    WHERE 1 = 1 {$strWhere} {$strOrder}";

    $listNotificationMessages = $db->db_arrayList($strQuery);
    $totalNotificationMessage['total'] = count($listNotificationMessages);

endif;

