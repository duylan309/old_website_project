<div data-content-notification data-content-navigate-mobile class="get-action">
    <ul>
        <?php if(isset($listNotification) && count($listNotification)):?>
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
        <?php else:?>
        <li><a href="#"><?=$language["noNotification"]?></a></li>
        <?php endif;?>
    </ul>
</div>
