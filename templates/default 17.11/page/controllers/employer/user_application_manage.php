<?php
if(isset($_GET["cid"]) && $_GET["cid"]) {
    $strElementData = "data-elm-data='{\"viewCV\":\"{$_GET["cid"]}\"}'";
    $strGetScript .= '<script src="'.APIGETCV.'/'.$_GET["cid"].'?type=db&var=window.cvDetail"></script>';
}

$jid = isset($_GET['jid']) ? $_GET['jid'] : null;
# count many columb
$strSelectAction = "COUNT(us.fo) AS total,
					SUM(us.status = 1) AS totalLike,
					SUM(us.status = 3) AS totalInterview,
					SUM(us.status = 4) AS totalHire,
					SUM(us.status = 5) AS totalDeny ";

$strWhereAction= " WHERE us.fo = $sessionUserId";
$strQueryAction= "SELECT $strSelectAction
                        FROM ".TABLE_USER_SAVED." AS us ".$strWhereAction;

$rowTotalAction= $db->db_array($strQueryAction);

require dirname(__FILE__) . "/../../views/employer/manager/user_application.php";
