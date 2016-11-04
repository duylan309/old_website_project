<div class="filter-list search-job hidden-xs transition m-t-15">
    <form class="post-form filter-form" data-change-to-submit-form data-search-form action="/<?=$seo_name["page"]["search"]?>">
        <div class="filter bg-color4">
            <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
            <div class="form-group p-10 p-b-0">
                <input type="hidden" name="distinct" value="1">
                <input type="hidden" data-order name="order" value="1">
                
                <input class="form-control m-b-10"
                    name="title"
                    value=""
                    placeholder="<?=$language["placeholderSearchJob"]?>">
                
                <div class="select-wrapper">
                    <select name="loc"
                        data-validate
                        data-dropdown
                        data-index-value="<?=isset($rowCompany[""])?$rowCompany["city"]:null; ?>"
                        data-object-init='{"id":"", "ti":"<?=$language["optCity"]?>"}'
                        data-option-local-json="location"
                        class="form-control">
                        <option value=""><?=$language["optCity"]?></option>
                    </select>
                </div>

                <input name="sa"
                    class="form-control m-b-10"
                    value="<?=isset($_GET["sa"]) ? $_GET["sa"]:null; ?>"
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
                       
                       $arraycat = explode(',',$rowCompany["category"]);
                       
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
                    foreach ($language["jobTimeOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="ty[]"
                               type="checkbox"
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
                    foreach ($language["jobLevelOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="le[]"
                               type="checkbox"
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
                    foreach ($language["yearOfExperienceOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="ex[]"
                               type="checkbox"
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
                    foreach ($language["langOption"] as $key => $value):
                    ?>
                    <label class="checkbox">
                        <input name="la[]"
                               type="checkbox"
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

<?php if(isset($_SESSION["userlog"]) && $url_data[0] != $seo_name["page"]["user"]):?>
<script src="<?=APIGETJOBSUGGEST?>?distinct=1&limit=4&var=window.JobSuggested"></script>
<div class="other-suggest-job-search hidden-xs">
    <div class="list-side-r">
        <h2 class="title-box text-color5"><?=$language["suggestedJobs"];?></h2>
        <div class="side-bar m-t-15"
            data-view-list-by-handlebar
            data-init-obj="JobSuggested"
            data-init-button-magic=".item [data-button-magic]"
            data-url="<?=APIGETJOBSUGGEST?>?distinct=1&limit=4"
            data-method="get"
            data-ignore-hash="true"
            data-elm-data='{"showCmp":1}'
            data-show-page="10"
            data-show-item="10"
            data-show-all="false"
            data-scroll-view="false"
            data-template-id="viewItemJobSuggestSmall">
            <div data-content>
                <div class="style-loadding"></div>
            </div>
        <a href="/<?=$seo_name["page"]["user"]?>?manage=jobsuggest"
            class="btn btn-block bg-color5 text-uppercase btn-save transition">
            <?=$language["viewMore"]?>
        </a>
        </div>
    </div>
</div>
<?php endif;?>