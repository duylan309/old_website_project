<?php
if(!$isJobOfUser) :
?>
<?php echo $strImgBanner?>
<div class="cmp-more no-radius header-profile">
    <div class="row">
        <div class="col-sm-2">
            <div class="cmp-logo">
                <?=$strImgLogo?>
            </div>
        </div>
        <div class="col-sm-10 text-left">
            <div class="cmp-info">
                <h1><?=$infoCmp["name"]?></h1>
                <table>
                    <colgroup>
                    <col class="col-xs-8 col-sm-10">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td><span class="view-local-category c-list t-s-16"
                                data-copy-template
                                data-view-template=".view-local-category"
                                data-elm-data='{"key":"","value":"","obj":"menuList","str":"<?=$infoCmp["category"]?>"}'
                            data-template-id="entryViewLocalOption">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td><p class="short-text"><?=$infoCmp["address"]?></p></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="header-ui-tab hidden-xs"
         data-fixed-stop="#footer"
         data-fixed-class="cl-fixed"
         data-fixed=".ui-cmp-bars">
        <div class="container">
            <div class="ui-tabs row hidden" data-copy-obj=".ui-cmp-bars ul">
            </div>
        </div>

    </div>


</div>
<?=$strUserTab;?>
<?php
endif;
?>

<?php if($missingData >= 3){?>
<div class="missing-data-header">
    <div class="cmp-more">
        <div class="row">
            <div class="col-sm-1 col-xs-12">
                <i class="fa fa-warning text-color2"></i>
            </div>
            <div class="col-sm-11 col-xs-12">
                <div class="content"><?=$language["warningUserMissingCvContent"]?></div> 
                
                <div class="list-side-r improve-cv-online no-border no-padding no-margin">
                    <div class="side-bar">
                    <?php if($missingDataContent): $i=0;?>
                    <?php foreach ($missingDataContent as $key => $value) {

                    if($i == 3){echo '<div class="load-more" data-object=".improve-cv-online" data-closet-toggle-class="active">';}   
                    
                    echo '<p class="need-fill">- '.$missingDataContent[$key].'</p>';
                    
                    $i++;}
                    if($i > 3){echo '</div>';}
                    ?>
                    <?php endif;?>  

                    <?php if(count($missingDataContent) > 3):?>
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
<?php }?> 