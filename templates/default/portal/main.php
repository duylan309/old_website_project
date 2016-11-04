<?php
$strClsColumnLeft = isset($strClsColumnLeft) ? $strClsColumnLeft:null;
$strClsColumnMain = isset($strClsColumnMain) ? $strClsColumnMain:null;
$strClsColumnRight = isset($strClsColumnRight) ? $strClsColumnRight:null;
?>
<div id="container">
    <?php   if(isset($_SESSION["userlog"]["missingData"])){?>
            <div class="missing-data-header">
                <div class="cmp-more container no-border">
                    <div class="row">
                        <div class="col-sm-1 col-xs-12">
                            <i class="fa fa-warning text-color2"></i>
                        </div>
                        <div class="col-sm-11 col-xs-12">
                            <div class="content"><?=$language["warningUserMissingCvContent"]?></div> 
                            <div class="list-side-r improve-cv-online no-border no-padding no-margin">
                                <div class="side-bar">
                                <?php $i=0; foreach ($_SESSION["userlog"]["missingData"] as $key => $value) {
                                if($i == 2){
                                    echo '<div class="load-more" data-object=".improve-cv-online" data-closet-toggle-class="active">';
                                }   
                                    echo '<p class="need-fill">- <a class="need-fill text-capitalize" href="/user">'.$language["pleaseFillYour"].'<span class="text-capitalize">'.$_SESSION["userlog"]["missingData"][$key].'</span></a></p>';
                                    $i++;
                                }

                                if($i > 2){echo '</div>';}
                                ?>
                                <?php if(count($_SESSION["userlog"]["missingData"]) > 2):?>
                                <div    class="text-bold m-b-5 view-more"
                                        data-object=".improve-cv-online"
                                        data-closet-toggle-class="active">
                                    <span class="up"><i class="fa fa-caret-up"></i> <span><?=$language["viewLess"]?></span></span>
                                    <span class="down"><i class="fa fa-caret-down"></i> <span><?=$language["viewMore"]?></span></span>
                                </div>
                                <?php endif;?>
                                
                                </div>
                            </div>

                            <a href="/user" class="btn bg-color2-outline text-uppercase">
                                <i class="fa fa-pencil"></i> <span><?=$language["btnEditNow"]?></span>
                            </a>
                        </div>
                     
                    </div>
                </div>
            </div> 
    <?php   }?>
    <div class="container">
        <?php
        if($strClsColumnMain):
        ?>
        <div class="row">
            <?php
            if(isset($strClsColumnLeft) && $strClsColumnLeft) {
                echo '<div class="'.$strClsColumnLeft.'">'.$strSidebarLeft.'</div>';
            }
            ?>
            <div class="<?=$strClsColumnMain?>">
                <main id="main">
                    <?php main(); ?>
                </main>
            </div>
            <?php
            if(isset($strClsColumnRight) && $strClsColumnRight) {
                echo '<div class="'.$strClsColumnRight.'">'.$strSidebarRight.'</div>';
            }
            ?>
        </div>
        <?php
        else :
        ?>
        <main id="main">
            <?php main(); ?>
        </main>
        <?php
        endif;
        ?>
    </div>
</div>
<div class="modal quick-view-item fade" data-quick-view-item data-modal-quick-view> <!--Embed view detail here--></div>
<div class="modal fade" data-quick-view-item1 data-modal-quick-view> <!--Embed apply job here--></div>
<div class="modal quick-view-sms fade"  data-quick-view-sms> <!--Embed apply job here--></div>
<div data-lightbox-show
    data-lightbox-img="[data-lightbox-show] .lb-img"
    data-lightbox-button="[data-button]"
    data-lightbox-loader="[data-lightbox-show] .lb-loader"
    data-lightbox-content="[data-lightbox-show] .lb-content"
    data-lightbox-title="[data-lightbox-show] .lb-title">
    <div class="lb-content">
        <div class="modal-signin">
            <span data-button data-lightbox-btn-close class="lb-close  position-right"><i class="fa fa-times-circle"></i></span>
        </div>
        <img class="lb-img" src="/images/lightbox/transparent.png" />
        <div class="lb-nav">
            <a data-button value="-1" class="icon-prev">&nbsp;</a>
            <a data-button value="1" class="icon-next">&nbsp;</a>
        </div>
        <div class="lb-loader"></div>
        <div class="lb-title">&nbsp;</div>
    </div>
</div>

