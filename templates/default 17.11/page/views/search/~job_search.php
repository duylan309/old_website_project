<div class="hidden">
    <script src="<?=$getUrl.$paramUrl?>"></script>
</div>
<div class="row m-t-15">

    <div class="col-sm-3">
        <div class="filter-list search-job hidden-xs transition">
            <form class="post-form filter-form" action="/<?=$seo_name["page"]["search"]?>">

                <div class="filter bg-color4">
                    <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
                    <div class="form-group p-10 p-b-0">
                        <input type="hidden" name="distinct" value="1">
                        <input type="hidden" name="random" value="1">
                        
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
                        <div class="head-title-bar p-10" data-object=".job-filter-group" data-closet-toggle-class="active"><?=$language["jobCategories"]?> <i class="fa fa-plus pull-right transition"></i></div>
                        <div class="form-group"
                               data-copy-template
                               data-elm-data='{"selected":"<?=$get["cati"]?>"}'
                               data-view-template=".filter-category .form-group"
                               data-template-id="viewSearchCategory">
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
                
                <button class="btn btn-block bg-color1 m-t-10">
                    <span class="fa fa-search"> </span>
                    <span><?=$language["btnSearch"]?></span>
                </button>

                <a class="btn btn-block bg-color2 m-t-10" href="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&map=view"?>">
                    <i class="fa fa-map-marker"></i> <span><?=$language["viewByMap"]?></span>
                </a>
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="item-view-more job-list-result"
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
            <div data-footer></div></div>


        <?php if(!isset($_SESSION["userlog"])):?>
        <div class="other-suggest-job-search">
            <script src="/api/get/job?distinct=1&limit=4&var=window.featureJob"></script>
            <div class="item-view-more featured-job"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-url="/api/get/job?distinct=1&limit=4"
                data-init-object="featureJob"
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
                    <div class="view-items"
                        data-content
                        data-center-items
                        data-class-name="item-job"
                        data-item-class=".item"
                        data-responsive="true">
                        <div class="style-loadding"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        </div>
    </div>
</div>