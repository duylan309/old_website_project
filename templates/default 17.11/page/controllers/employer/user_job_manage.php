<?php 
$templateId = "entryUserManageJob";

if(isset($_GET["line"]) && count($_GET["line"])){
    $strElementData = "data-elm-data='{\"lineLayout\":\"1\"}'";
}

#get Applied

$strQueryUserApplied = "SELECT ui AS total, GROUP_CONCAT(ui SEPARATOR ',') AS listid FROM ".TABLE_JOB_APPLIED." WHERE ei= {$sessionUserId} GROUP BY ei ORDER BY id DESC";

$rowTotal = $db->db_array($strQueryUserApplied);
$strListIdApplied = isset($rowTotal["listid"])?$rowTotal["listid"]:null;

if(isset($_SESSION["usersub"]["id"]) && $_SESSION["usersub"]["id"]) {
    $strQueryUserApplied = "SELECT ui FROM ".TABLE_JOB_APPLIED."
        WHERE ei= {$sessionUserId} AND jo IN (SELECT id FROM ".TABLE_JOB." WHERE ci = {$_SESSION["usersub"]["id"]})
        GROUP BY ui ORDER BY id DESC LIMIT 0,5 ";
    $strGetScript = '<script src="'.APIGETJOB.'?uid='.$sessionUserId.'&cid='.$_SESSION["usersub"]["id"].'&var=window.userManageJob"></script>';
} else {
    $strQueryUserApplied = "SELECT  user.name AS na,
                                    user.im AS im,
                                    user.dob AS dob,
                                    user.email AS ue, 
                                    user_cv.ui AS ui, 
                                    user_cv.title AS t, 
                                    user_cv.level AS level, 
                                    user_cv.experience AS e, 
                                    user_cv.category AS c, 
                                    user_cv.location AS lo,
                                    job_applied.jo AS ji, 
                                    job.ti AS t
                            
                            FROM    ".TABLE_JOB_APPLIED." AS job_applied,
                                    ".TABLE_JOB." AS job,
                                    ".TABLE_USER_CV." AS user_cv,
                                    ".TABLE_USER." AS user
 
                            WHERE   job_applied.ei = {$sessionUserId} 
                                    AND user.id = job_applied.ui
                                    AND user_cv.ui = user.id 
                                    AND job.id = job_applied.jo 
                            GROUP BY job_applied.ui 
                            ORDER BY job_applied.id DESC 
                            LIMIT 0,5 ";

    $strGetScript = '<script src="'.APIGETJOB.'?uid='.$sessionUserId.'&var=window.userManageJob"></script>';
}

$listUserApplied = $db->db_arrayList($strQueryUserApplied);

$strQueryUserApplied = array();

if($listUserApplied) {
    foreach ($listUserApplied as $key => $value) {
        $strQueryUserApplied[] = $value["ui"];
    }
}

unset($listUserApplied);

#get Save
$strQueryUserSave = "SELECT ui FROM ".TABLE_USER_SAVED." WHERE fo= {$sessionUserId} ORDER BY id DESC LIMIT 0,5 ";
$listUserSave = $db->db_arrayList($strQueryUserSave);
$strQueryUserSave = array();
if($listUserSave) {
    foreach ($listUserSave as $key => $value) {
        $strQueryUserSave[] = $value["ui"];
    }
}

unset($listUserSave);
$strGetScript .= '<script src="'.APIGETUSERACTION.'?uid='.$sessionUserId.'&action=userapply&limit=5&var=window.userManageApplied"></script>';
// $strGetScript .= '<script src="'.APIGETUSERLISTID.'?listID='.implode(",", $strQueryUserApplied).'&var=window.userManageApplied"></script>';
$strGetScript .= '<script src="'.APIGETUSERLISTID.'?listID='.implode(",", $strQueryUserSave).'&var=window.userManageSaved"></script>';

// CALL VIEW IN HANDBARTEMP
