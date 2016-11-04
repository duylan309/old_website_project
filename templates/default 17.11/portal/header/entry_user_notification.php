<?php if(isset($listNotificationMessages) && count($listNotificationMessages)){?>

<?php if($_SESSION["userlog"]["type"] == 2):?>
<?php foreach( $listNotificationMessages as $value => $message):?>
<li class="<?=$message["status"] != 0 ? "item-read" : ""?> ">
    <div class="row">
        <div class="col-sm-2">
            <img class="thumb_img" alt="<?=$message["company_name"]?>" src="<?=isset($message['company_image']) && !empty($message['company_image'])? '/'.FOLDERIMAGECOMPANY.'thumbnail/'.$message['company_image'] : "/img/style/user.png"?>">
        </div>
        <div class="col-sm-10">
            <a href="/<?=$seo_name["page"]["user"]."?manage=messages&action=view&mid=".$message["id"]?>">
                <p class="short-text"> <?=$language["newmessagefrom"]?> <span class="text-color2 text-bold"><?=$message["company_name"]?></span></p>
                <span class="noti-date"><?=getDateTime($message["created_date"])?></span>
            </a>
        </div>
    </div>
</li>
<?php endforeach;  ?>
<?php elseif($_SESSION["userlog"]["type"] == 1):?>
<?php foreach( $listNotificationMessages as $value => $message):?>
<li class="<?=$message["status"] != 0 ? "item-read" : ""?> ">
    <div class="row">
        <div class="col-sm-2">
            <img class="thumb_img" alt="<?=$message["user_name"]?>" src="<?=isset($message['user_image']) && !empty($message['user_image'])? '/'.FOLDERIMAGEUSER.$message['user_image'] : "/img/style/user.png"?>">
        </div>
        <div class="col-sm-10">
            <a href="/<?=$seo_name["page"]["user"]."?manage=messages&action=view&mid=".$message["id"]?>">
                <p class="short-text"> <?=$language["newmessagefrom"]?> <span class="text-color2 text-bold"><?=$message["user_name"]?></span></p>
                <span class="noti-date"><?=getDateTime($message["created_date"])?></span>
            </a>
        </div>
    </div>
</li>
<?php endforeach;  endif;?>


<?php }else{?>
<li><a href="#"><?=$language["noNotification"]?></a></li>
<?php }?>