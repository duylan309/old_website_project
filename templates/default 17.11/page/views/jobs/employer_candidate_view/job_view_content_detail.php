<?php if(!isset($_GET["cid"]) && !isset($_GET["statistics"]) ):?>
<div class="cmp-more">
    <label class="text-color1 j-stitle t-s-18 hidden"><?=$language["generalInfo"]?></label>

    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"> <label><?=$language["jobTitle"]?> </label></div>
        <div class="col-sm-9 col-xs-8"> <span><?=$infoJob["db"]["ti"]; ?></span></div>
    </div>

    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"> <label><?=$language["jobExpires"]?> </label></div>
        <div class="col-sm-9 col-xs-8"> <span><?=date("d-m-Y", strtotime($infoJob["db"]["de"])) ?></span></div>
    </div>

    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"><label><?=$language["location"]?> </label></div>
        <div class="col-sm-9 col-xs-8">
        <i class="fa fa-map-marker"></i>
        <span><?=$infoJob["db"]['address']?></span>
        <span class="c-list view-local-location"
           data-copy-template
           data-view-template=".view-local-location"
           data-elm-data='{"key":"","value":"","obj":"locationOption","str":"<?=$infoCmp["city"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>
    <div class="j-view-option row hidden">
        <div class="col-sm-3 col-xs-4"> <label><?=$language["jobNumber"]?> </label></div>
        <div class="col-sm-9 col-xs-8"> <span><?=isset($infoJob["more"]["number"]) && $infoJob["more"]["number"] ? $infoJob["more"]["number"]:null; ?></span></div>
    </div>

    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"><label><?=$language["jobCategories"]?> </label></div>
        <div class="col-sm-9 col-xs-8">

        <span class="c-list view-local-category-job"
           data-copy-template
           data-view-template=".view-local-category-job"
           data-elm-data='{"key":"","value":"","obj":"menuList","str":"<?=$infoJob["db"]["ca"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>

    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"> <label><?=$language["jobSalary"]?> </label></div>
        <div class="col-sm-9 col-xs-8"> <span class="text-color3 text-bold"><?=$strPrice?></span></div>
    </div>
    
    <div class="j-view-option row hidden">
        <div class="col-sm-3 col-xs-4"><label><?=$language["contactPerson"]?> </label></div>
        <div class="col-sm-9 col-xs-8">                </div>
    </div>
<!-- </div>
<div class="cmp-more"> -->
    <label class="text-color1 j-stitle t-s-18 hidden"><?=$language["jobInformation"]?></label>
    
    <?php if(isset($infoJob["db"]["le"]) && $infoJob["db"]["le"]) {?>
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"><label><?=$language["jobLevel"]?></label></div>
        <div class="col-sm-9 col-xs-8">
        <span class="c-list view-local-level"
           data-copy-template
           data-view-template=".view-local-level"
           data-elm-data='{"key":"","value":"","obj":"jobLevelOption","str":"<?=$infoJob["db"]["le"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>
    <?php }?>        

    <?php if(isset($infoJob["db"]["ex"]) && $infoJob["db"]["ex"]) {?>
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"><label><?=$language["experienceWork"]?></label></div>
        <div class="col-sm-9 col-xs-8">
        <span class="c-list view-local-exp"
           data-copy-template
           data-view-template=".view-local-exp"
           data-elm-data='{"key":"","value":"","obj":"yearOfExperienceOption","str":"<?=$infoJob["db"]["ex"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>
    <?php }?>
    
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"> <label><?=$language["jobTime"]?> </label></div>
        <div class="col-sm-9 col-xs-8"> <span class="text-color2">
        <span class="c-list view-local-time"
           data-copy-template
           data-view-template=".view-local-time"
           data-elm-data='{"key":"","value":"","obj":"jobTimeOption","str":"<?=$infoJob["db"]["ty"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>
    
    <?php if(isset($infoJob["db"]["la"]) && $infoJob["db"]["la"]) {?>
     <div class="j-view-option row">
        <div class="col-sm-3 col-xs-4"><label><?=$language["language"]?> </label></div>
        <div class="col-sm-9 col-xs-8">
        <span class="c-list view-local-lb"
           data-copy-template
           data-view-template=".view-local-lb"
           data-elm-data='{"key":"","value":"","obj":"langOption","str":"<?=$infoJob["db"]["la"]?>"}'
           data-template-id="entryViewLocalOption">&nbsp;</span>
        </div>
    </div>
    <?php } ?>
    
    <?php if(isset($infoJob["more"]["requirement"]) && count($infoJob["more"]["requirement"])):?>
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-12"><label class="t-s-14"><?=$language["jobSkill"]?></label></div>
        <div class="col-sm-9 col-xs-12"><p class="textarea-content"><?=isset($infoJob["more"]["requirement"]) && count($infoJob["more"]["requirement"]) ? preg_replace('/(?<!\d)[.,!?](?![.,!?\d])/', ', ', $infoJob["more"]["requirement"]) : "" ?></p></div>
    </div>
    <?php endif;?>
  
    <?php if(isset($infoJob["more"]["description"]) && count($infoJob["more"]["description"])):?>
    <hr class="m-t-15 m-b-15">
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-12"><h2 class="t-s-14 m-t-15"><?=$language["jobDescription"]?></h2></div>
        <div class="col-sm-9 col-xs-12"><p class="textarea-content m-t-15"><?=isset($infoJob["more"]["description"]) && count($infoJob["more"]["description"]) ? $infoJob["more"]["description"] : "" ?></p></div>
    </div>
    <?php endif;?>

    <?php if(isset($infoJob["more"]["benefit"]) && count($infoJob["more"]["benefit"])):?>
    <hr class="m-t-15 m-b-15">
    <div class="j-view-option row">
        <div class="col-sm-3 col-xs-12"><p class="t-s-14 no-margin"><?=$language["jobConditionAndBenefit"]?></p></div>
        <div class="col-sm-9 col-xs-12"><p class="textarea-content"><?=isset($infoJob["more"]["benefit"]) && count($infoJob["more"]["benefit"]) ? $infoJob["more"]["benefit"] : "" ?></p></div>
    </div>
    <?php endif;?>

    <?php if(isset($infoJob["more"]["keyword"]) && count($infoJob["more"]["keyword"])):?>
    <div class="j-view-option row hidden">
        <div class="col-sm-3 col-xs-12"><label class="t-s-14"><?=$language["keyword"]?></label></div>
        <div class="col-sm-9 col-xs-12"><p class="textarea-content"><?=isset($infoJob["more"]["keyword"]) && count($infoJob["more"]["keyword"]) ? preg_replace('/(?<!\d)[.,!?](?![.,!?\d])/', ', ', $infoJob["more"]["keyword"]) : "" ?></p></div>
    </div>
    <?php endif;?>
</div>

<?php 
  
  $lat = isset($infoJob['db']['lat']) && !is_array($infoJob['db']['lat']) && $infoJob['db']['lat'] != '0.000000' ? $infoJob['db']['lat'] : null ;
  $lng = isset($infoJob['db']['lng']) && !is_array($infoJob['db']['lng']) && $infoJob['db']['lng'] != '0.000000' ? $infoJob['db']['lng'] : null;
  
?>

<?php if($lat == !null && $lng != null):?>
<div map-job-location class="home-google-map b-r-4">
    <div data-google-map="google-map-profile"
        data-map-point="#google-location .point"
        data-latitude="<?=$lat?>"
        data-longitude="<?=$lng?>"
        data-zoom="18"
        data-roadmap="true"
        data-map-point-sms=".msm-content"></div>
    <ul id="google-location" class="hidden">
        <li class="point"
            data-latitude="<?=$lat?>"
            data-longitude="<?=$lng?>"
            data-id="id">
            <div class="msm-content">
                <div class="msm-content-detail" data-copy-obj=".header-profile .col-sm-10">
                    ...
                </div>
            </div>
        </li>
    </ul>
    <div id="google-map-profile" style="width: 100%; height: 150px;">&nbsp;</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLEAPIKEY?>&libraries=places"></script>
<?php endif;?>

<?php endif;?>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=<?=$_SESSION["lang"]?>" async defer></script>

<script type="text/javascript">
  var verifyCallback = function(response) {
    $('.boxcaptcha').attr('checked','checked');
  };
 
  $(document).on('click','.btn-apply-without-signin',function(){
    grecaptcha.render(document.getElementById('captcha'), {
      'sitekey' : '<?=SITEKEYCAPTCHA?>',
      'callback' : verifyCallback,
    });
  })
</script>