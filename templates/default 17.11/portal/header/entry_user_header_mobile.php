<div class="welcome">
    <ul class="mobile-expand no-padding">
        <li class="no-padding no-background no-border">
        <a class="btn btn-language text-color2 no-padding"
            data-button-magic
            data-method="post"
            data-ajax-url="<?=APIPOSTLANG?>"
            data-redirect= "."
            data-params="lang=<?=$langcode == "en" ? "vi" : "en"?>">
            <span class="t-s-11">
            <?=$_SESSION["lang"]=="en" ? "Tiếng Việt" : "English"?>
            </span> 
        </a>
        </li>
        
        <?php if(!isset($_SESSION["userlog"]["type"])):?>
        <li data-employer class="bg-color3"><a href="/<?=$seo_name["page"]["category"]?>/employer"><?=$language["employer"]?></a></li>
        <?php endif;?>
        
        <?php if($sessionUserId):?>		
        <li data-button-message class="noti-btn"><i class="fa fa-comment"></i> <?=isset($totalNotificationMessage["total"]) && count($totalNotificationMessage["total"]) ? '<span class="number-noti bg-color3">'.$totalNotificationMessage["total"].'</span>' : ''?></li>
       
        <?php if($_SESSION["userlog"]["type"] == 1){?>
        <li data-button-notification class="noti-btn"><i class="fa fa-bell"></i> <?=isset($totalNotification["total"]) && count($totalNotification["total"]) ? '<span class="number-noti bg-color3">'.$totalNotification["total"].'</span>' : ''?></li>
        <?php }?>

        <?php else:?>
      	<li class="h-search-btn hidden">
      		<a href="/user?manage=company#group-view=2"
              class="text-bold t-s-14"
              data-button-magic
              data-elm-data='{"urlRedirect":"."}'
              data-view-template-local="true"
              data-view-template="[data-quick-view-item]"
          data-template-id="entrySigninPopup"><?=$language["signin"]?></a></li>	
      	<?php endif;?>
        <li id="searchTopBtn" class="h-search-btn hidden"><i class="fa fa-search"></i> <span class="t-s-11"><?=$language["btnSearch"]?></span></li>
  		  
        <?php if($sessionUserId):?>
        <li class="bars hidden <?=$sessionUserId ? "no-padding no-border no-bg" : ""?>">
          <span class="icon-avatar"> 
             <?php if($_SESSION["userlog"]["im"] && !isset($_SESSION["usersub"])):?>
             <img src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
             <?php elseif(isset($_SESSION["usersub"]["im"]) && $_SESSION["userlog"]):?>
             <img src="/<?=FOLDERIMAGECOMPANY.$_SESSION["usersub"]["im"]?>">
             <?php else:?>
             <i class="fa fa-user"></i>
             <?php endif;?>
          </span>
  	    </li>
        <?php else:?>
	         <i class="fa fa-navicon hidden"></i> 
		    <?php endif;?>
    </ul>
  
    <?php require dirname(__FILE__) . "/notification_message.php";?>
    <?php require dirname(__FILE__) . "/notification.php";?>
    <?php require dirname(__FILE__) . "/menu.php";?>
    <?php require dirname(__FILE__) . "/search.php";?>   
    <?php require dirname(__FILE__) . "/setting.php";?>   
    <?php require dirname(__FILE__) . "/category.php";?>   
</div>
