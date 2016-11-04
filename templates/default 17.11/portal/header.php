<div id="header" class="relative transition">
    <div class="w-100 cl-fixed bg-color1">
        <div class="full-container">
            <div class="w-100">
                <div class="pull-left">
                    <div class="row" data-menu-main>
                        <div class="col-sm-2 logo-width">
                            <div class="logo">
                                <a href="/"><img src="<?=UDATAIMAGE?>style/logo1.png" alt="Thuetoday.vn"></a>
                            </div>
                        </div>
                        <div class="col-sm-10 hidden-xs">
                            <?php if($header == "employer"):?>
                                <ul class="emp-header text-left">
                                    <li> <a href="#" data-template-id="entryPopupContactWebsite" data-view-template="[data-quick-view-item]" data-view-template-local="true" data-button-magic="1"><?=$language["contact"]?></a></li>
                                </ul>     
                            <?php elseif($header == "normal"):?>
                                <div class="u-search text-left">
                                    <?php require dirname(__FILE__) . "/header/entry_user_search.php";?>
                                </div>
                            <?php endif;?>    
                        </div>
                    </div>
                </div>

                <div class="pull-right">
                    <?php require dirname(__FILE__) . "/header/entry_load_data.php";?>    
                    <div class="u-header text-right hidden-xs">
                        <?php require dirname(__FILE__) . "/header/entry_user_header.php";?>
                    </div>
                    <div class="m-header hidden-lg hidden-sm hidden-md">
                        <?php require dirname(__FILE__) . "/header/entry_user_header_mobile.php";?>    
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?=APIGETPAGEHTML?>?token=AiPC9BjkCyDFQX127111cAdI2Fak8rEJFnWkIEsdpYtUFYpI7&limit=10&sort=1&var=window.listHtmlContent"></script>
<?php if($pageEmployer != "employer"):?>   
<div id="user-menu">
    <div class="full-container">
        <div class="u-menu">
             <?php require dirname(__FILE__) . "/header/entry_user_menu.php";?>
        </div>    
        <div class="clearfix"></div>
    </div>
</div>
<?php endif;?>

<div id="navi-button" class="navigation-button hidden hidden-lg hidden-sm hidden-md hidden0 <?=isset($_SESSION["userlog"]) && count($_SESSION["userlog"]) ? "no-padding": ""?>">
    <?php if(isset($_SESSION["userlog"]) && count($_SESSION["userlog"])):?>
        <i class="fa fa-plus transition hidden"></i>
         <span class="icon-avatar no-margin"> 
           <?php if($_SESSION["userlog"]["im"] && count($_SESSION["userlog"]["im"]) != 0 && $_SESSION["userlog"]["type"] == 2):?>
           <img class="no-padding" src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
           <?php elseif(isset($_SESSION["userlog"]["im"]) && strlen($_SESSION["userlog"]["im"]) != 0  && $_SESSION["userlog"]["type"] == 1):?>
           <img class="no-padding" src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
           <?php elseif(isset($_SESSION["userlog"]["im"]) && strlen($_SESSION["userlog"]["im"]) != 0  && isset($_SESSION["usersub"]) && $_SESSION["userlog"]["type"] == 1):?>
           <img class="no-padding" src="/<?=FOLDERIMAGECOMPANY.$_SESSION["userlog"]["im"]?>">
           <?php else:?>
           <i class="fa fa-user"></i>
           <?php endif;?>
        </span>
    <?php else:?>
        <i class="fa fa-navicon"></i>
    <?php endif;?>
</div>

<div id="mobile-navigation">
    <div class="row">
        <?php if($sessionUserId):     
          if($_SESSION["userlog"]["type"]==1){ 
            require dirname(__FILE__) . "/header/mobile/employer_bar_bottom.php";
          }else{ 
            require dirname(__FILE__) . "/header/mobile/user_bar_bottom.php";
          }
        else:
          require dirname(__FILE__) . "/header/mobile/no_user_bar_bottom.php";
        endif;?>    
    </div>
</div>