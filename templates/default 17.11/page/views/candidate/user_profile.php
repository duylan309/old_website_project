<?=$strGetScript?>
<div class="j-detail cv-detail user-manage-feature">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-3">
            
            <?php require dirname(__FILE__) . "/../general/user_menu_dashboard.php";?>
            <?php $call_file ? require dirname(__FILE__) . $call_file : ''?>
            
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9">
            <?php require_once dirname(__FILE__) . "/user_profile_content_detail.php";?>
        </div>
        
    </div>
</div>