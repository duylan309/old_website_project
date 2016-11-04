<div class="welcome">
<a class="btn btn-language text-color2"
    data-button-magic
    data-method="post"
    data-ajax-url="<?=APIPOSTLANG?>"
    data-redirect= "."
    data-params="lang=<?=$langcode == "en" ? "vi" : "en"?>">
    <?=$_SESSION["lang"]=="en" ? "Tiếng Việt" : "English"?>
</a>

<?php
if($sessionUserId) {

    if($_SESSION["userlog"]["type"] == 1) {

        ?>
        <a class="btn bg-color3 form-add btn-add-a-item text-uppercase text-bold hidden-xs"
            <?php
            if(isset($_SESSION["usersub"]["id"])) {
                echo 'href="'.$seo_name["page"]["user"].'?manage=postjob&pid='.$_SESSION["usersub"]["id"].'"';
            } elseif(isset($_SESSION["userlog"]["page"]) && $_SESSION["userlog"]["page"] > 1 ) {
                echo "data-button-magic";
            } else {
                echo 'href="'.$seo_name["page"]["user"].'?manage=postjob"';
            }
            ?>
            data-elm-data='{"urlRedirect":"/<?=$_SESSION["userlog"]["username"]?>"}'
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
            data-template-id="entryPostJobOptionCompany"><span class="icon-file-text2"></span> <span><?=$language["btnPostJob"]?></span></a>

            <a href="<?="/{$seo_name["page"]["user"]}?manage=jobs"?>" class="hidden">
                &nbsp;&nbsp; <i class="fa fa-suitcase"></i> &nbsp;<?=$language["jobs"]?>  &nbsp;&nbsp;
            </a>
            
            <span class="otooltip noti">
                <a href="#" class="relative">
                    <i class="fa fa-comment"></i> <?=$totalNotificationMessage["total"] != 0 ? '<div class="number-noti bg-color3">'.$totalNotificationMessage["total"].'</div>' : ''?> &nbsp;&nbsp;
                </a>
                <span class="otooltip-content otooltip-r">
                    <ul>
                        <?php require dirname(__FILE__) . "/entry_user_notification.php";?>
                    </ul>
                </span>
            </span>

            <span class="otooltip noti">
                <a href="#" class="relative" >
                    <i class="fa fa-bell"></i> <?=$totalNotification["total"] != 0 ? '<div class="number-noti bg-color3">'.$totalNotification["total"].'</div>' : ''?> &nbsp;&nbsp;
                </a>
                <span class="otooltip-content otooltip-r">
                    <ul>
                        <?php if(isset($listNotification) && count($listNotification)):?>
                        <?php foreach( $listNotification as $value => $notification):?>
                        <li class="<?=$notification["jas"] == 7 ? "item-read" : ""?> ">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img class="thumb_img" src="<?=isset($notification['im']) && !empty($notification['im'])? '/'.FOLDERIMAGEUSER.$notification['im'] : "/img/style/user.png"?>">
                                </div>
                                <div class="col-sm-10">
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
                </span>
            </span>
        
            <span class="otooltip">
                <a href="/<?=$seo_name["page"]["user"]?>/user?manage=pagecmp">
                    <span class="icon-avatar">
                        <?php if($_SESSION["userlog"]["im"] && !isset($_SESSION["usersub"])):?>
                        <img src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
                        <?php elseif(isset($_SESSION["usersub"]["im"]) && isset($_SESSION["userlog"])):?>
                        <img src="/<?=FOLDERIMAGECOMPANY.$_SESSION["usersub"]["im"]?>">
                        <?php else:?>
                        <i class="fa fa-user"></i>
                        <?php endif;?>
                    </span>
                    <i class="fa fa-caret-down"></i>
                </a>
                <span class="otooltip-content otooltip-r">

                    <ul class="company-list-top-h"
                        data-copy-template
                        data-elm-data='{"hiddenMenu":"1"}'
                        data-view-template=".company-list-top-h" data-template-id="entryUserMenuSetting"></ul>
                    <ul>


                        <li>
                            <a href="#"
                                data-button-magic
                                data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                                data-redirect="/"><i class="fa fa-sign-out"></i> <?=$language["signout"]?></a>
                        </li>
                        <li>
                            <div class="view-day-left"
                                data-elm-data
                                data-copy-template
                                data-view-template="li .view-day-left"
                                data-template-id="entryUserViewDayLeft">
                        </li>
                        <?php if(!isset($_SESSION["userlog"]["dayleftshow"])):?>
                        <li class="bg-color3 hidden">
                            <a href="<?="/{$seo_name["page"]["user"]}?manage=promoapplied"?>">
                                <?=$language["ActivationCode"]?>
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                </span>
            </span>


    <?php
    } else {

            $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($_SESSION["userlog"]["name"]))) );
            $user_link = '/'.$seo_name["page"]["cv"].'/'.$_SESSION["userlog"]["id"].'/'.$linkFriendly;
            ?>


            <a href="<?="/{$seo_name["page"]["user"]}?manage=jobsave"?>">
                &nbsp;&nbsp; <i class="fa fa-suitcase"></i>&nbsp;  <?=$language["jobs"]?>  &nbsp;&nbsp;
            </a>
            
            <span class="otooltip noti">
                <a href="#" class="relative">
                    <i class="fa fa-comment"></i> <?=$totalNotificationMessage["total"] != 0 ? '<div class="number-noti bg-color3">'.$totalNotificationMessage["total"].'</div>' : ''?> &nbsp;&nbsp;
                </a>
                <span class="otooltip-content otooltip-r">
                    <ul>
                        <?php require dirname(__FILE__) . "/entry_user_notification.php";?>
                    </ul>
                </span>
            </span>

            <span class="otooltip">
                <a href="<?=$user_link?>">
                    <span class="icon-avatar">
                        <?php if($_SESSION["userlog"]["im"]):?>
                        <img src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
                        <?php else:?>
                        <i class="fa fa-user"></i>
                        <?php endif;?>
                    </span>
                    <i class="fa fa-caret-down"></i>
                </a>
                <span class="otooltip-content otooltip-r">
                    <ul>
                        <ul class="company-list-top-h"
                            data-copy-template
                            data-elm-data='{"hiddenMenu":"1"}'
                            data-view-template=".company-list-top-h" data-template-id="entryUserMenuSetting"></ul>
                        <ul>

                        <li>
                            <a href="#"
                                data-button-magic
                                data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                            data-redirect="/"><i class="fa fa-sign-out"></i> <?=$language["signout"]?></a>
                        </li>
                    </ul>
                </span>
            </span>

<?php
    }
} else {?>
        <a href="#"
            class="btn bg-color6"
            data-button-magic
            data-elm-data='{"urlRedirect":"."}'
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
        data-template-id="entrySignupWithPromoCode"><?=$language["promoCode"]?></a>
        <a href="/<?=$seo_name["page"]["category"]?>/employer" class="btn bg-color3 text-bold"><span><?=$language["employer"]?></span></a>
        <a href="/rg"
        class="btn bg-color6 hidden"><?=$language["register"]?></a>
        <a href="/user?manage=company#group-view=2"
            class="btn bg-color6"
            data-button-magic
            data-elm-data='{"urlRedirect":"."}'
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
        data-template-id="entrySigninPopup"><i class="fa fa-lock"></i>&nbsp; <?=$language["signin"]?></a>
       

<?php } ?>
</div>
