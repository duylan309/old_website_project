<?php
$strGetScript = '<script src="'.APIGETCOMPANY.'/'.$rowCompany["id"].'&var=window.companyInfomation"></script>';
echo $strGetScript;
?>
<div class="item-content" data-google-map-in-tab="google-map-profile">
    <h3 class="icon hidden tab-title hidden-sm hidden-md hidden-lg hidden-xs"><?=$language["profile"]?></h3>
    <div class="tab-content">
        <?php

        // var_dump($rowCompany);

        $floatLat = isset($rowCompany["lat"])? floatval($rowCompany["lat"]) : 10.789113161930226;
        $floatLng = isset($rowCompany["lng"])? floatval($rowCompany["lng"]) : 106.67731847416599;
       
        if ($isPageOfCompany) {
        ?>

        <div class="user-update-general-info cmp-more no-m-top"
            data-copy-template
            data-option-local="companyInfomation"
            data-elm-data='{"triggerClick":".user-update-general-info [data-closet-toggle-class]","<?=$langcode?>" : "1"}'
            data-view-template=".user-update-general-info"
            data-template-id="entryCmpUpdateInfo">&nbsp;</div>

        <div class="user-update-more user-update-more1 no-m-top "
            data-copy-template
            data-option-local="companyInfomation"
            data-elm-data='{"triggerClick":".user-update-more1 [data-closet-toggle-class]","showElement":"<?=count($companyInfoPage["more"]["about"]) ?1 :0 ?>"}'
            data-view-template=".user-update-more1"
            data-template-id="entryCmpUpdateMoreAbout">&nbsp;</div>
    
        <div class="cmp-more">
            <div class="row">
                <div class="col-sm-2 control-label text-left text-color1 t-s-18">
                    <label><?=$language["map"]?></label>
                </div>
                <div class="col-sm-10">
                    <div class="edit-disabled">
                        <div class="form-control-static  text-right">
                        <span data-closet-toggle-class="edit-enabled"
                            data-object=".edit-disabled"
                            onClick="$('[data-google-map]').data('disableUpdate', false); $('[data-google-map]').data('pacInputId', 'pac-input');  Site.googleMap('google-map-profile');"
                            class="btn bg-color4 text-uppercase"><i class="fa fa-pencil"></i></span>
                        </div>
                        <div class="edit-show">
                            
                            <input id="pac-input" class="controls" style="min-width:97%;padding:5px 10px;border:one;margin-top:10px;left:10px" type="text" placeholder="<?=$language["searchAddress"]?>">
                        </div>
                        <form class="form-update-google-marker form-horizontal post-form edit-show m-b-10 text-right">
                            <div class="hidden">
                                <input name="db.id" value="<?=$rowCompany["id"]?>">
                                <input name="db.ui" value="<?=$rowCompany["ui"]?>">
                                <input name="updateNode" value="db">
                                <input name="db.lat" data-key-lat value="">
                                <input name="db.lng" data-key-lng value="">
                            </div>
                            <div class="edit-show m-t-15">
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6">
                                        <span data-closet-toggle-class="edit-enabled"
                                            data-object=".edit-disabled"
                                            onClick="$.removeData($('[data-google-map]')); $('[data-google-map]').data('disableUpdate', true); Site.googleMap('google-map-profile');"
                                            class="btn bg-color5 text-uppercase"><i class="fa fa-times"></i> <?=$language["btnClose"]?></span>
                                        <button type="submit"
                                        class="btn bg-color1 text-uppercase"
                                        data-button-magic=""
                                        data-params-form=".post-form"
                                        data-format-json="true"
                                        data-ajax-url="<?=APIPOSTCOMPANY?>"
                                        data-show-success=".alert-footer.alert"
                                        data-show-errors=".alert-footer.alert-error"
                                        data-redirect="."
                                        value="Update"><i class="fa fa-check"></i> <?=$language["btnSave"]?></button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="hidden-xs home-google-map">
                            <div data-google-map="google-map-profile"
                                data-map-point="#google-location .point"
                                data-latitude="<?=$floatLat?>"
                                data-longitude="<?=$floatLng?>"
                                data-zoom="18"
                                data-roadmap="true"
                                data-disable-update="true"
                                data-update-maker=".form-update-google-marker"
                                data-map-point-sms=".msm-content"></div>

                            <ul id="google-location" class="hidden">
                                <li class="point"
                                    data-latitude="<?=$floatLat?>"
                                    data-longitude="<?=$floatLng?>"
                                    data-id="1">
                                    <div class="msm-content">
                                        <div class="msm-content-detail" data-copy-obj=".header-profile .col-sm-10">
                                            ...
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div id="google-map-profile" style="width: 100%; height: 280px;">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div class="cmp-more no-m-top emp-info">
            <table>
                <colgroup>
                <col class="col-xs-4 col-sm-3">
                <col class="col-xs-8 col-sm-9">
                </colgroup>
                <tbody>
                   
                    <tr>
                        <td class=""><strong><?=$language["companyName"]?></strong></td>
                        <td><p class="short-text"><?=$rowCompany["name"]?></p></td>
                    </tr>
                    <tr>
                        <td class=""><strong><?=$language["jobCategories"]?></strong></td>
                        <td><p class="short-text"><span class="view-local-category c-list"
                data-copy-template
                data-view-template=".view-local-category"
                data-elm-data='{"key":"","value":"","obj":"menuList","str":"<?=$rowCompany["category"]?>"}'
                data-template-id="entryViewLocalOption">&nbsp;</span></p></td>
                    </tr>
                    <tr>
                        <td class=""><strong><?=$language["address"]?></strong></td>
                        <td>
                        <p class="short-text">
                        <?=isset($rowCompany["address"]) ? $rowCompany["address"].', ':""?> 
                        <?=isset($rowCompany["city"]) ? $language["locationOption"][$rowCompany["city"]] : ''?> </p></td>
                    </tr>

                    <?php if (isset($rowCompany["website"]) && count($rowCompany["website"])):?>
                    <tr>
                        <td class=""><strong><?=$language["website"]?></strong></td>
                        <td><p class="short-text"><?=$rowCompany["website"]?></p></td>
                    </tr>
                    <?php endif;?>

                    <?php
                    if(isset($rowCompany["facebook"]) && count($rowCompany["facebook"])) {
                    ?>
                    <tr>
                        <td class=""><strong><?=$language["facebook"]?></strong></td>
                        <td><p class="short-text"><?=$rowCompany["facebook"];?></p></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php if(isset($companyInfoPage["more"]["about"]) && count($companyInfoPage["more"]["about"]) && !is_array($companyInfoPage["more"]["about"])):?>
        <div class="cmp-more">
            <div class="row">
               
                <div class="col-sm-12 textarea-content-line">
                    <?=isset($companyInfoPage["more"]["about"]) && count($companyInfoPage["more"]["about"]) && !is_array($companyInfoPage["more"]["about"]) ? mysql_unreal_escape_string($companyInfoPage["more"]["about"]) : '' ?>
                </div>
            </div>
        </div>
        <?php endif;?>

        <div class="cmp-more hidden">
            <div class="row">
                <div class="col-sm-3">
                    <label class="text-color1 j-stitle t-s-18"><?=$language["workWithUs"]?></label>
                </div>
                <div class="col-sm-9 textarea-content-line">
                    <?=isset($companyInfoPage["more"]["whyworkus"]) && count($companyInfoPage["more"]["whyworkus"]) ? $companyInfoPage["more"]["whyworkus"] : ''?>
                </div>
            </div>
        </div>
        <div class="cmp-more">
            <div class="row">
                <div class="col-sm-3">
                    <label><?=$language["map"]?></label>
                </div>
                <div class="col-sm-9">
                    <div class="row home-google-map">
                        <div data-google-map="google-map-profile"
                            data-map-point="#google-location .point"
                            data-latitude="<?=$floatLat?>"
                            data-longitude="<?=$floatLng?>"
                            data-zoom="18"
                            data-roadmap="true"
                            data-map-point-sms=".msm-content"></div>
                        <ul id="google-location" class="hidden">
                            <li class="point"
                                data-latitude="<?=$floatLat?>"
                                data-longitude="<?=$floatLng?>"
                                data-id="id">
                                <div class="msm-content">
                                    <div class="msm-content-detail" data-copy-obj=".header-profile .col-sm-10">
                                        ...
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div id="google-map-profile" style="width: 100%; height: 280px;">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLEAPIKEY?>&libraries=places">
    </script>
</div>
