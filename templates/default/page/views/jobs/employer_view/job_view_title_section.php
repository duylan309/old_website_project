<?php 
if($isJobOfUser) :

    $strElmLinkMore = ',"linkMore":"/'.$_GET["q"].'?statistics=1&"';

    if(isset($_GET["cid"]) && $_GET["cid"] ) {
        $uid = intval($_GET["cid"]);
        $jid;
        $isComment = 1;

        $strSelectAwS   = "ja.ti AS aw1, ja.de AS aw2, ja.cr AS cr ";
        $strWhereAwS    = "WHERE ja.ui = $uid AND ja.jo = $jid";
        
        $strQueryAwS    = "SELECT $strSelectAwS
                           FROM ".TABLE_JOB_APPLIED." AS ja {$strWhereAwS} ORDER BY ja.id DESC";
        $user_answer    = $db->db_array($strQueryAwS);

        $isTypeOfView   = 1; # 1 = Employer , 2 = User view;

        $strElementData = "data-elm-data='{\"viewCV\":\"{$_GET["cid"]}\",\"viewAW\":\"1\",\"isComment\":\"1\",\"isTypeOfView\":\"{$isTypeOfView}\",\"pid\":\"{$companyInfoPage["db"]["id"]}\",\"jID\":\"{$infoJob["db"]["id"]}}\"}'";
        $strGetScript   = '<script src="'.APIGETCV.'/'.$_GET["cid"].'/'.$jid.'?type=db&var=window.cvDetail"></script>';

    }
    
endif;

if(isset($_GET["statistics"]) && $_GET["statistics"]==1) :
    echo '<div class="hidden"> <script src="'.$getUrl.$paramUrl.'"></script></div>';

    // CHECK TO VIEW USER DETAIL INSIDE JOB
    if(isset($_GET["cid"]) && $_GET["cid"] ) {
        require_once dirname(__FILE__) . "/job_view_detail.php";
    }else {
        require_once dirname(__FILE__) . "/job_view_list_applied.php";
    } 

endif;
?>