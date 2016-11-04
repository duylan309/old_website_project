<div class="filter-list search-job hidden-xs transition m-t-15">
    <form class="post-form filter-form" data-change-to-submit-form data-search-form action="/<?=$seo_name["page"]["search"]?>">
        <div class="filter bg-color4">
            <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
            <div class="form-group p-10 p-b-0">
                <input type="hidden" name="distinct" value="1">
                <input type="hidden" data-order name="order" value="1">
                
                <input class="form-control m-b-10"
                    name="title"
                    value="<?=$infoJob["db"]["ti"]?>"
                    placeholder="<?=$language["placeholderSearchJob"]?>">
                
                <div class="select-wrapper">
                    <select name="loc"
                        data-validate
                        data-dropdown
                        data-index-value=""
                        data-object-init='{"id":"", "ti":"<?=$language["optCity"]?>"}'
                        data-option-local-json="location"
                        class="form-control">
                        <option value=""><?=$language["optCity"]?></option>
                    </select>
                </div>

                <input name="sa"
                    class="form-control m-b-10"
                    value=""
                    onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                    onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); } else if(event.which ==13) { $(this).trigger('change'); }"
                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                    placeholder="<?=$language["jobSalaryMin"]?>">

            </div>

            <div class="job-filter-group filter-category active">
                <div    class="head-title-bar p-10"
                        data-object=".job-filter-group" 
                        data-closet-toggle-class="active">
                        <?=$language["jobCategories"]?> <i class="fa fa-plus pull-right transition"></i>
                </div>

                <div class="form-group">
                       <?php if($language["categoriesOption"]):
                       
                       $arraycat = explode(',',$infoJob["db"]["ca"]);
                       
                       foreach($language["categoriesOption"] as $key => $value):?>
                       <label class="checkbox">
                           <input name="cati[]"
                                  type="checkbox"
                                  <?=in_array($key,$arraycat) ? 'checked="checked"' : ''?>
                                  value="<?=$key?>">
                           <span class="checkbox-style"></span>
                           <span><?=$value?></span>
                       </label>
                       <?php endforeach;?>
                       <?php endif;?>
                </div>
               
            </div>

            <div class="job-filter-group">
                <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobType"]?> <i class="fa fa-plus pull-right transition"></i></div>
                <div class="form-group">
                    <?php
                    if(isset($language["jobTimeOption"]) && $language["jobTimeOption"]):
                    $jobTimeOption = explode(',', $infoJob["db"]["ty"]);
                    foreach ($language["jobTimeOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="ty[]"
                               type="checkbox"
                               <?=in_array($key, $jobTimeOption) ? 'checked="checked"' : ''?>
                               value="<?=$key?>">
                        <span class="checkbox-style"></span>
                        <span><?=$value?></span>
                    </label>
                    <?php
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>
                
            <div class="job-filter-group">    
                <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobLevel"]?> <i class="fa fa-plus pull-right transition"></i></div>
                <div class="form-group">
                    <?php
                    if(isset($language["jobLevelOption"]) && $language["jobLevelOption"]):
                    $jobTimeOption = explode(',', $infoJob["db"]["le"]);
                    foreach ($language["jobLevelOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="le[]"
                               type="checkbox"
                               <?=in_array($key, $jobTimeOption) ? 'checked="checked"' : ''?>
                               value="<?=$key?>">
                        <span class="checkbox-style"></span>
                        <span><?=$value?></span>
                    </label>
                    <?php
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <div class="job-filter-group">
                <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["yearOfExperience"]?> <i class="fa fa-plus pull-right transition"></i></div>
                <div class="form-group">
                    <?php
                    if(isset($language["yearOfExperienceOption"]) && $language["yearOfExperienceOption"]):
                    $yearOfExperienceOption = explode(',', $infoJob["db"]["ex"]);
                    foreach ($language["yearOfExperienceOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="ex[]"
                               type="checkbox"
                               <?=in_array($key, $yearOfExperienceOption) ? 'checked="checked"' : ''?>
                               value="<?=$key?>">
                        <span class="checkbox-style"></span>
                        <span><?=$value?></span>
                    </label>
                    <?php
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>
                
            <div class="job-filter-group">    
                <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobPreferredlanguage"]?> <i class="fa fa-plus pull-right transition"></i></div>
                <div class="form-group">
                    <?php
                    if(isset($language["langOption"]) && $language["langOption"]):
                    $langOption = explode(',', $infoJob["db"]["la"]);
                    foreach ($language["langOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="la[]"
                               type="checkbox"
                               <?=in_array($key, $langOption) ? 'checked="checked"' : ''?>
                               value="<?=$key?>">
                        <span class="checkbox-style"></span>
                        <span><?=$value?></span>
                    </label>
                    <?php
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <button class="btn btn-block bg-color3 m-t-10">
            <span class="fa fa-search"> </span>
            <span><?=$language["btnSearch"]?></span>
        </button>
    </form>
</div>
