<?php 

$templateId = "entryUsersub";

if(isset($_GET["add"])) {
    $strElementData = "data-elm-data='{\"add\":\"1\"}'";
    if($_GET["add"]) {
        $strQuery = "SELECT * FROM ".TABLE_USERSUB." WHERE uid={$sessionUserId} AND id = {$_GET["add"]}";
        $rowUsersub = $db->db_array($strQuery);
        if($rowUsersub ) {
            $strGetScript = '<script src="'.APIGETUSERSUB.'/'.$_GET["add"].'&var=window.usersubDetail"></script>';
            $strOptionLocal = "data-option-local=\"usersubDetail\"";
            $strElementData = "data-elm-data='{\"update\":\"{$_GET["add"]}\"}'";
        }
    }
} else {
    $strAjaxUrl = APIGETUSERSUB.'?uid='.$sessionUserId;
    $strElementData = "data-elm-data='{
                \"strUrlList\":\"{$strAjaxUrl}\"
            }'";
    $strGetScript = '<script src="'.$strAjaxUrl.'&var=window.usersubManage"></script>';
}

$strGetUrl = null;