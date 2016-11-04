<div data-content-notification data-content-navigate-mobile class="get-action">
    <ul>
        <!-- Employer -->
        <?php if(isset($listNotification) && count($listNotification) && $_SESSION["userlog"]["type"] == 1):?>
        <?php foreach( $listNotification as $value => $notification):?>
        <li class="<?=$notification["jas"] == 7 ? "item-read" : ""?> ">
            <div class="row">
                <div class="col-sm-2 col-xs-2">
                    <img class="thumb_img" src="<?=isset($notification['im']) && !empty($notification['im'])? '/'.FOLDERIMAGEUSER.$notification['im'] : "/img/style/user.png"?>">
                </div>
                <div class="col-sm-10 col-xs-10">
                    <a href="/<?=$seo_name["page"]["job"]?>/<?=$notification["ji"]?>/<?=urlFriendly($notification["jt"])?>?statistics=1&cid=<?=$notification["ui"]?>&uname=<?=$notification["na"]?>">
                        <p class="short-text"><span class="text-color1 text-bold"><?=$notification["na"]?></span> <?=$language["justApplied"]?> <span class="text-bold"><?=$notification['jt']?></span></p>
                        <span class="noti-date"><?=getDateTime($notification["cr"])?></span>
                    </a>
                </div>
            </div>
        </li>
        <?php endforeach;  ?>
        <?php elseif(isset($listNotification) && count($listNotification) && $_SESSION["userlog"]["type"] == 1):?>
        <?php foreach( $listNotification as $value => $notification):?>
        <li class="<?=$notification["readed"] == 1 ? "item-read" : ""?> ">
            <div class="row">
                <div class="col-sm-2">
                    <img class="thumb_img" src="<?=isset($notification['company_image']) && !empty($notification['company_image'])? '/'.FOLDERIMAGECOMPANY.$notification['company_image'] : UDATAIMAGE."style/user.png"?>">
                </div>
                <div class="col-sm-10">
                    <a href="<?=$user_link?>#<?=$notification["id"]?>">
                        <p class="short-text"><span class="text-color1 text-bold"><?=$notification["company_name"]?></span> <?=$language["justCommented"]?></p>
                        <span class="noti-date"><?=getDateTime($notification["created_date"])?></span>
                    </a>
                </div>
            </div>
        </li>
        <?php endforeach;  ?>
        <?php else:?>            
        <li><a href="#"><?=$language["noNotification"]?></a></li>
        <?php endif;?>
        
        <!-- Candidate -->

    </ul>
</div>


