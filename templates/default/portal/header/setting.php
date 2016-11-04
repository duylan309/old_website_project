<div data-content-setting data-content-navigate-mobile class="get-action">
    <?php   
    if($_SESSION["userlog"]["type"]==1){
        require dirname(__FILE__) . "/mobile/employer_setting.php";
    }else{
        require dirname(__FILE__) . "/mobile/user_setting.php";
    }?>
</div>

