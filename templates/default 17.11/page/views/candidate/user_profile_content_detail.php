<div class="w-b b-r-4 p-20 cmp-more">
    <div class="row">
        <div class="col-sm-8">
            <div class="row p-10">
                <div class="col-sm-3 col-xs-2">
                    <div class="cmp-logo text-center">
                        <?php
                        $strImg = "/img/style/user.png";
                        
                        if(isset($infoUser["im"]) && count($infoUser["im"]) && is_file(FOLDERIMAGEUSER.$infoUser["im"])) {
                            $strImg = "/".FOLDERIMAGEUSER.$infoUser["im"];
                        }
                        
                        ?>
                        <div class="pr-div b-cover b-r-4" style="background:url('<?=$strImg?>') no-repeat;">
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-10">
                    <div class="col-sm-9">
                        <div class="c-t-cv">
                            <h3 class="text-color1 no-margin u-name"><?=$infoUser["name"]?></h3>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 short-text">
                                    <span class="c-list text-color3 text-bold t-s-14"><?=isset($missingDataContent['title']) ? $missingDataContent['title']  : (isset($cvInfo["db"]["title"]) && count($cvInfo["db"]["title"])  ? $cvInfo["db"]["title"] : "")?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 short-text">
                                    <?=isset($missingDataContent["experience"]) && $missingDataContent["experience"] ? $missingDataContent["experience"] : ( isset($cvInfo["db"]["experience"]) && !is_array($cvInfo["db"]["experience"]) ? $language["yearOfExperienceOption"][$cvInfo["db"]["experience"]] : '')?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            
            <?php $str_employer = isset($infoUser["employer_status"]) ? ',"employer_status":"'.$infoUser["employer_status"].'"' : ''?>
            
            <div class="button-function"
                data-copy-template
                data-view-template=".button-function"
                data-elm-data='{ "fo":"<?=$sessionUserId ?>",
                                 "ui":"<?=$cvInfo["db"]["ui"] ?>",
                                 "im":"<?=$infoUser["im"] ? $infoUser["im"] : ''?>",
                                 "name":"<?=$infoUser["name"] ?>",
                                 "dob":"<?=$infoUser["dob"] ? $infoUser["dob"]  : ''?>",
                                 "gender":"<?=$infoUser["gender"] ? $infoUser["gender"] :'' ?>",
                                 "phone":"<?=$infoUser["phone"] ? $infoUser["phone"] : ''?>"
                                 <?=$str_employer?> }'
                data-template-id="entryUserCvFunction">&nbsp;</div>
            
            
            
        </div>
    </div>
</div>
<!-- Load content -->
<div class="cmp-more">
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["fullname"]?></label>
        <span class="col-xs-8 col-sm-9"><?=$infoUser["name"]?></span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["bod"]?></label>
        <span class="col-xs-8 col-sm-9" >
            <?=isset($infoUser["day"]) ? $language["dayOption"][$infoUser["day"]] : ''?>
            <?=isset($infoUser["month"]) ? $language["monthOption"][$infoUser["month"]] : ''?>
            <?=isset($infoUser["year"]) ? ', '.$infoUser["year"] : ''?>
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["gender"]?></label>
        <span class="col-xs-8 col-sm-9"><?=isset($missingDataContent['gender']) ? $missingDataContent['gender'] :($infoUser["gender"]==1 ? $language["male"] : $language["female"])?></span>
    </div>
    <div class="j-view-option row hidden">
        <label class="col-xs-4 col-sm-3"><?=$language["cv"]?></label>
        <a class="col-xs-8 col-sm-9" href="#"><?=$language["download"];?></a>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["address"]?></label>
        <span class="col-xs-8 col-sm-9">
            <?=$infoUser["address"] ? $infoUser["address"] : (isset($missingDataContent['address']) ?  $missingDataContent['address'] : '' )?>
            <?=isset($infoUser["city_text"]) ? ', '.$infoUser["city_text"]:""?>
            <?php if(isset($infoUser["country"])){?>
            , <span class="c-list view-local-lang1"
                data-copy-template
                data-view-template=".view-local-lang1"
                data-elm-data='{"key":"id","value":"ti","obj":"country","str":"<?=$infoUser["country"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            <?php }?>
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["phone"]?></label>
        <span class="col-xs-8 col-sm-9"><?=$infoUser["phone"] ? $infoUser["phone"] : (isset($missingDataContent['phone']) ?  $missingDataContent['phone'] : '' )?></span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["email"]?></label>
        <span class="col-xs-8 col-sm-9"><?=$infoUser["email"]?></span>
    </div>
    <div class="j-view-option row hidden">
        <label class="col-xs-4 col-sm-3">Skype</label>
        <span class="col-xs-8 col-sm-9"><?=isset($missingDataContent["skype"]) ? $missingDataContent["skype"] : (isset($infoUser["skype"]) && count($infoUser["skype"]) ? $infoUser["skype"] : '')?></span>
    </div>
    <?php if(isset($infoUser["facfaceebook"])):?>
    <div class="j-view-option row hidden">
        <label class="col-xs-4 col-sm-3">Facebook</label>
        <span class="col-xs-8 col-sm-9"><a href="<?=$infoUser["facebook"]?>" target="_blank"><?=isset($missingDataContent["facebook"]) ? $missingDataContent["facebook"] : (isset($infoUser["facebook"]) && count($infoUser["facebook"]) ? $infoUser["facebook"] : '') ?></a></span>
    </div>
    <?php endif;?>
</div>
<div class="cmp-more">
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["jobTitle"]?></label>
        <span class="col-xs-8 col-sm-9 text-color2 text-bold"><?=isset($missingDataContent['title']) ? $missingDataContent['title']  : (isset($cvInfo["db"]["title"]) && count($cvInfo["db"]["title"])  ? $cvInfo["db"]["title"] : "")?></span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["jobCategoriesWantToJoin"]?></label>
        <p class="col-xs-8 col-sm-9">
            <?php if(isset($missingDataContent["category"])):?>
            <?=$missingDataContent["category"]?>
            <?php else:?>
            <span class="c-list view-local-category"
                data-copy-template
                data-view-template=".view-local-category"
                data-elm-data='{"key":"","value":"","obj":"menuList","str":"<?=$cvInfo["db"]["category"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            <?php endif;?>
        </p>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["jobLevel"]?></label>
        <span class="col-xs-8 col-sm-9">
            <?php if(isset($missingDataContent["level"])):?>
            <?=$missingDataContent["level"]?>
            <?php else:?>
            <span class="c-list view-local-level"
                data-copy-template
                data-view-template=".view-local-level"
                data-elm-data='{"key":"","value":"","obj":"jobLevelOption","str":"<?=$cvInfo["db"]["level"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            <?php endif;?>
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["jobTime"]?></label>
        <span class="col-xs-8 col-sm-9">
            
            <span class="c-list view-local-type"
                data-copy-template
                data-view-template=".view-local-type"
                data-elm-data='{"key":"","value":"","obj":"jobTimeOption","str":"<?=$cvInfo["db"]["type"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["languageISpeak"]?></label>
        <span class="col-xs-8 col-sm-9">
            <?php if(isset($missingDataContent["lang"])):?>
            <?=$missingDataContent["lang"]?>
            <?php else:?>
            <span class="c-list view-local-lang"
                data-copy-template
                data-view-template=".view-local-lang"
                data-elm-data='{"key":"","value":"","obj":"langOption","str":"<?=$cvInfo["db"]["lang"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            <?php endif;?>
            
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["salaryExpect"]?></label>
        <span class="col-xs-8 col-sm-9 text-color3 text-bold">
            <?php
            $strPrice = $language["negotiable"];
            if(isset($cvInfo["db"]["s1"])) {
            if($cvInfo["db"]["salary"]==2) {
            $strPrice = "<span  data-format-currency>{$cvInfo["db"]["s1"]}</span> {$language["currencyOption"][2]}";
            }
            else {
            $strPrice = "<span  data-format-currency>{$cvInfo["db"]["s1"]}</span> {$language["currencyOption"][1]}";
            }
            }
            echo $strPrice;
            ?>
        </span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["experienceWork"]?></label>
        <span class="col-xs-8 col-sm-9"><?=isset($cvInfo["db"]["experience"]) && !is_array($cvInfo["db"]["experience"]) ? $language["yearOfExperienceOption"][$cvInfo["db"]["experience"]] : (isset($missingDataContent["experience"]) ? $missingDataContent["experience"] : '')?></span>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-4 col-sm-3"><?=$language["location"]?></label>
        <p class="col-xs-8 col-sm-9">
            <?php if(isset($missingDataContent["location"])):?>
            <?=$missingDataContent["location"]?>
            <?php else:?>
            <span class="c-list view-local-location"
                data-copy-template
                data-view-template=".view-local-location"
                data-elm-data='{"key":"","value":"","obj":"locationOption","str":"<?=$cvInfo["db"]["location"]?>"}'
            data-template-id="entryViewLocalOption">&nbsp;</span>
            <?php endif;?>
        </p>
    </div>
    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3"><?=$language["aboutme"]?></label>
        <p class="textarea-content col-xs-12 col-sm-9"><?=isset($cvInfo["db"]["about"]) && count($cvInfo["db"]["about"])? $cvInfo["db"]["about"] : (isset($missingDataContent["about"]) ? $missingDataContent["about"] : '')?></p>
    </div>

    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3"><?=$language["keySkills"]?></label>
        <p class="textarea-content col-xs-12 col-sm-9"><?=isset($cvInfo["db"]["skill"]) && count($cvInfo["db"]["skill"])? $cvInfo["db"]["skill"] : (isset($missingDataContent["skill"]) ? $missingDataContent["skill"] : '')?></p>
    </div>
    <?php if($cvInfoWork):?>
    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3"><?=$language["employmentHistory"]?></label>
        <div class="col-xs-12 col-sm-9">
            <?php
            if($cvInfoWork):
            
            foreach ($cvInfoWork as $key => $value) {
            echo '<div class="item-history">
                <p>'.$value["title"].'</p>
                <p><strong class="text-color2">'.$value["cmpname"].'</strong> - <span class="t-s-12 text-italic">'.$value["city"].'-'.$value["country"].'</span></p>
                <p class="t-s-12"><strong>'.$value["from"].'</strong> - <strong>'.$value["to"].'</strong></p>
            </div>';
            
            }
            
            else:
            echo isset($missingDataContent['workhistory']) ? $missingDataContent['workhistory'] : '';
            endif;?>
        </div>
    </div>
    <?php endif;?>
    <?php if($cvInfoEducation):?>
    <div class="j-view-option row">
        <label class="col-xs-12 col-sm-3"><?=$language['educationHistory']?></label>
        <div class="col-xs-12 col-sm-9">
            
            <?php
            if($cvInfoEducation):
            foreach ($cvInfoEducation as $key => $value) {
            echo '<div class="item-history">
                <p>'.$value["fieldofstudy"].'</p>
                <p><strong class="text-color2">'.$value["school"].'</strong> - <span class="t-s-12 text-italic">'.$value["degrees"].'<span></p>
                <p class="t-s-12"><strong>'.$value["from"].'</strong> - <strong>'.$value["to"].'</strong></p>
            </div>';
            }
            
            else:
            echo isset($missingDataContent['education']) ? $missingDataContent['education'] : '';
            endif;?>
        </div>
    </div>
    <?php endif;?>
</div>
<!-- Load photos user -->
<h3 class="text-color1 t-s-18 hidden"><?=$language["photos"]?></h3>
<div class="item-content">
    <h3 class="icon hidden tab-title hidden-sm hidden-md hidden-lg hidden-xs"><?=$language["photos"]?></h3>
    <div class="tab-content <?=isset($cmpInfo['facebook']) ? '' : "fb_none" ?>">
        <div class="cmp-more no-m-top u-g-l-b list-photos">
            <?php if ($isCvOfUser):?>
            <div class="update-slide-image text-right photo-function"
                data-copy-template
                data-elm-data='{"urlPost":"<?=APIPOSTSLIDE?>/user",
                "maxSize":"<?=maxSizeUpload?>",
                "ui":"<?=$sessionUserId?>",
                "itemId":"<?=$sessionUserId?>",
                "hidCancel":"1"
                }'
                data-view-template=".update-slide-image"
                data-template-id="entrySlideImage">
            </div>
            <div class="clearfix"></div>
            <?php endif;?>
            <div class="photos-container">
                <div class="item-view-slide-image"
                    data-view-list-by-handlebar
                    data-elm-data='{"uid":"<?=$infoUser["id"]?>"}'
                    data-ignore-hash="true"
                    data-init-button-magic=".item-view-slide-image [data-button-magic]"
                    data-url="<?=APIGETSLIDE.'/user/'.$infoUser["id"]?>"
                    data-params="dir=<?=$infoUser["id"]?>"
                    data-method="GET"
                    data-show-page="10"
                    data-show-item="20"
                    data-show-all="false"
                    data-scroll-view="true"
                    data-template-id="entrySlideItemTwo" >
                    <div class="view-items" data-content><div class="style-loadding"></div></div>
                    <div class="no-data">
                        <div class="no-data-content"><?=$language['noPhotosAndComingSoon']?></div>
                    </div>
                    <div data-footer></div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>