<div class="hidden">
    <script src="<?=$getUrl.$paramUrl?>"></script>
</div>
<div class="row m-t-15">
    
    <div class="col-sm-9">

        <div class="category-section post-form cmp-more no-margin m-b-10 hidden">
            <div class="job-filter-group filter-category-section active">
                <div class="head-title-bar t-s-18 text-bold hidden">
                    <?=$language["jobCategories"]?></i>
                </div>
                <div class="form-group no-border no-padding no-margin"
                       data-copy-template
                       data-elm-data='{"selected":"<?=$get["cati"]?>"}'
                       data-view-template=".filter-category-section .form-group"
                       data-template-id="viewSearchCategorySection">
                </div>
            </div>
        </div>
        
        <div data-filter-search-bar class="filter-list bg-color7 p-10 b-r-4">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <?php $link_search = str_replace(array("&brand=view","?brand=view"),"","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>    
                    
                    <a class="btn btn-block bg-color4" href="<?=$link_search?>">
                        <i class="fa fa-th"></i> <span><?=$language["viewByList"]?></span>
                    </a>
                </div>
                <div class="col-sm-3 hidden-xs"> 
                    <a class="btn btn-block bg-color4" href="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&map=view"?>">
                        <i class="fa fa-map-marker"></i> <span><?=$language["viewByMap"]?></span>
                    </a>
                </div>
                <div class="col-sm-3 hidden-xs">
                     <a class="btn btn-block bg-color4" href="<?=SITEURL.$seo_name["page"]["search"].'?random=1&brand=view'?>">
                        <i class="fa fa-building-o"></i> <span><?=$language["viewByBrand"]?></span>
                    </a>
                </div>
                <div class="col-sm-3 col-xs-12">
                        <div class="form-group no-margin">
                            <span class="select-wrapper no-margin">
                                <i class="fa fa-sort-alpha-asc"></i>
                                <select data-select-order name="order" class="form-control">
                                <?php
                                if(isset($language["orderOption"]) && $language["orderOption"]):
                                foreach ($language["orderOption"] as $key => $value):
                                ?>
                                    <option <?=$key==$orderOption ? 'selected="selected"' : ''?> value="<?=$key?>">
                                        <?=$value?>
                                    </option>
                                <?php
                                endforeach;
                                endif;
                                ?>
                                </select>
                            </span>
                        </div>
                    
                </div>
            </div>
        </div>

        <div class="item-view-more job-list-result m-t-15"
            data-view-list-by-handlebar
            data-init-button-magic=".item [data-button-magic]"
            data-init-object="viewSearchJobs"
            data-url="<?=$getUrl?>"
            data-method="get"
            data-show-page="10"
            data-show-item="48"
            data-show-all="false"
            data-scroll-view="true"
            data-form-filter=".form-filter"
            data-object-reverse="true"
            data-is-reload-page="true"
            data-reload-base-on-id="id"
            data-reload-base-set-params="listID"
            data-reload-url="<?=APIGETJOBLISTID?>"
            data-template-id="viewItemJobSearch" >
            
            <div class="m-filter-header no-padding hidden-md hidden-sm hidden-lg hidden">
                <div class="row">
                    <div class="col-xs-8"><span class="text-color1 text-bold t-s-18"><?=$language["results"]?>: <span data-total-item></span> <?=$language["jobs"]?></span></div>
                    <div class="col-xs-4 text-right"><div class="bg-color1 text-uppercase text-bold filter-btn b-r-4"><i class="fa fa-filter"></i> <span class="hidden-xs"><?=$language["filter"]?></span></div></div>
                </div>
            </div>

            <div
                data-content
                class="view-items"
                data-center-items
                data-class-name="item-job"
                data-item-class=".item"
                data-responsive="true"
                data-items-custom="[835, 4], [500,3]"
                ><div class="style-loadding"></div>
            </div>

            <div class="no-data">
                <div class="no-data-content"><?=$language['noJobFound']?></div>

                <?php if(!isset($_SESSION["userlog"])):?>
                    <div class="form-information-collect"
                        data-copy-template
                        data-view-template=".form-information-collect"
                        data-elm-data='{"strSearch":"<?=$getUrl?>"}'
                        data-template-id="entrySaveData">
                    </div>
                <?php endif;?>


            </div>
            <div class="clearfix">&nbsp;</div>
            <div data-footer></div>
        </div>

        
        <?php if(isset($_SESSION["userlog"]) && $url_data[0] != $seo_name["page"]["user"]):?>
        
        <div class="other-suggest-job-search hidden-sm hidden-lg hidden-md">
            <div class="item-view-more featured-job"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="<?=APIGETJOBSUGGEST?>?distinct=1&limit=4"
                data-init-object="JobSuggested"
                data-method="get"
                data-show-page="10"
                data-show-item="24"
                data-show-all="false"
                data-scroll-view="true"
                data-scroll-bottom=".cv-list-logo"
                data-form-filter=".form-filter"
                data-is-reload-page="false"
                data-reload-base-on-id="id"
                data-reload-base-set-params="listID"
                data-ignore-hash="true"
                data-reload-url="/api/get/joblistid"
                data-template-id="viewItemJobSearch">
                <div class="j-h-r">
                    <div class="row">
                        <div class="col-xs-6 col-sm-10">
                            <h2 class="no-m-top"><a class="text-color1 t-s-18" href="/q?cat=15&amp;distinct=1"><?=$language["suggestedJobs"]?></a></h2>
                        </div>
                        <div class="col-xs-6  col-sm-2 text-right">
                            <h2 class="no-m-top"><a class="text-color2 t-s-14 text-bold" href="/q?cat=15&amp;distinct=1"><?=$language["viewMore"]?></a></h2>
                        </div>
                    </div>
                    <div class="view-items item-job"
                        data-content
                        data-center-items
                        data-class-name="job-suggest"
                        data-item-class=".item"
                        data-responsive="true">
                        <div class="style-loadding"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        </div>

        <div class="col-sm-3">
            <div class="filter-list search-job hidden-xs transition">
                <form class="post-form filter-form" data-change-to-submit-form data-search-form action="/<?=$seo_name["page"]["search"]?>">
                    <div class="filter bg-color4">
                        <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
                        <div class="form-group p-10 p-b-0">
                            <input type="hidden" name="distinct" value="1">
                            <input type="hidden" data-order name="order" value="1">
                            
                            <input class="form-control m-b-10"
                                name="title"
                                value="<?=$get["title"]?>"
                                placeholder="<?=$language["placeholderSearchJob"]?>">
                            
                            <div class="select-wrapper">
                                <select name="loc"
                                    data-validate
                                    data-dropdown
                                    data-index-value="<?=isset($_GET["loc"])?$_GET["loc"]:null; ?>"
                                    data-object-init='{"id":"", "ti":"<?=$language["optCity"]?>"}'
                                    data-option-local-json="location"
                                    class="form-control">
                                    <option value=""><?=$language["optCity"]?></option>
                                </select>
                            </div>


                          <!--   <div class="select-wrapper">
                            <select name="cat"
                                class="form-control"
                                data-dropdown
                                data-option-from-json="<?=APIGETMENU;?>"
                                data-option-local-json="menuStructure"
                                data-params="opp=3"
                                data-index-value="<?=isset($_GET["cat"])?$_GET["cat"]:null; ?>"
                                data-object-init='{"id":"", "ti":"<?=$language["jobCategories"]?>"}'
                                data-target-append=".multiselect-category">
                                <option value=""><?=$language["jobCategories"]?></option>
                            </select>
                            </div> -->

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
                                   $arraycat = explode(',',$get["cati"]);
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

                        <div class="job-filter-group <?=isset($timeOption) && count($timeOption) ? "active" : ""?>">
                            <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobType"]?> <i class="fa fa-plus pull-right transition"></i></div>
                            <div class="form-group">
                                <?php
                                if(isset($language["jobTimeOption"]) && $language["jobTimeOption"]):
                                foreach ($language["jobTimeOption"] as $key => $value):
                                ?>
                                <label class="checkbox">
                                    <input name="ty[]"
                                           type="checkbox"
                                           <?=in_array($key, $timeOption) ? "checked" : null;?>
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
                            
                        <div class="job-filter-group <?=isset($levelOption) && count($levelOption) ? "active" : ""?>">    
                            <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobLevel"]?> <i class="fa fa-plus pull-right transition"></i></div>
                            <div class="form-group">
                                <?php
                                if(isset($language["jobLevelOption"]) && $language["jobLevelOption"]):
                                foreach ($language["jobLevelOption"] as $key => $value):
                                ?>
                                <label class="checkbox">
                                    <input name="le[]"
                                           type="checkbox"
                                           <?=in_array($key, $levelOption) ? "checked" : null;?>
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

                        <div class="job-filter-group <?=isset($experienceOption) && count($experienceOption) ? "active" : ""?>">
                            <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["yearOfExperience"]?> <i class="fa fa-plus pull-right transition"></i></div>
                            <div class="form-group">
                                <?php
                                if(isset($language["yearOfExperienceOption"]) && $language["yearOfExperienceOption"]):
                                foreach ($language["yearOfExperienceOption"] as $key => $value):
                                ?>
                                <label class="checkbox">
                                    <input name="ex[]"
                                           type="checkbox"
                                           <?=in_array($key, $experienceOption) ? "checked" : null;?>
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
                            
                        <div class="job-filter-group <?=isset($languageOption) && count($languageOption) ? "active" : ""?>">    
                            <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobPreferredlanguage"]?> <i class="fa fa-plus pull-right transition"></i></div>
                            <div class="form-group">
                                <?php
                                if(isset($language["langOption"]) && $language["langOption"]):
                                foreach ($language["langOption"] as $key => $value):
                                ?>
                                <label class="checkbox">
                                    <input name="la[]"
                                           type="checkbox"
                                           <?=in_array($key, $languageOption) ? "checked" : null;?>
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


        </div>

    </div>

</div>