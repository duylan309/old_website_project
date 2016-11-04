<div class="hiddens">
    <script src="<?=$getUrl.$paramUrl?>"></script>
</div>
<div class="row m-t-15">
    <div class="col-sm-3">
        <div class="filter-list hidden-xs">
            <form class="post-form filter-form" action="/<?=$seo_name["page"]["searchcv"]?>">
                <div class="filter bg-color4">
                    <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
                    <div class="form-group p-10 p-b-0">
                        <input class="form-control m-b-10"
                            name="title"
                            value="<?=isset($_GET["title"]) ? $_GET["title"]:null; ?>"
                            placeholder="<?=$language["placeholderSearchCv"]?>">

                        <input name="sa"
                            class="form-control m-b-10"
                            value="<?=isset($_GET["sa"]) ? $_GET["sa"]:null; ?>"
                            onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                            onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); } else if(event.which ==13) { $(this).trigger('change'); }"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                            placeholder="<?=$language["jobSalaryMin"]?>">

                        <div class="select-wrapper">
                            <select name="loc"
                                class="form-control"
                                type="select"
                                data-object-init='{"id":"", "ti":"<?=$language["optCity"]?>"}'
                                data-dropdown
                                placeholder="30"
                                data-index-value="<?=isset($_GET["loc"])?$_GET["loc"]:null; ?>"
                                data-option-local-json="location"
                                data-option-from-json="<?=APIGETLOCATION;?>">
                                <option value=""><?=$language["optCity"]?></option>
                            </select>
                        </div>

                        <div class="select-wrapper">
                        <select name="uco"
                            class="form-control"
                            data-dropdown
                            data-option-local-json="countryShort"
                            data-index-value="<?=isset($_GET["uco"])?$_GET["uco"]:null; ?>"
                            data-object-init='{"id":"", "ti":"<?=$language["optNationality"]?>"}'
                            data-target-append=".multiselect-category">
                            <option value=""><?=$language["optNationality"]?></option>
                        </select>
                        </div>

                        <div class="select-wrapper">
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
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="m-filter-header hidden-md hidden-sm hidden-lg">
            <div class="row">
                <div class="col-xs-8"><span class="text-color1 text-bold t-s-18"><?=$language["allCandidates"]?></span></div>
                <div class="col-xs-4 text-right"><div class="bg-color1 text-uppercase text-bold filter-btn b-r-4"><i class="fa fa-filter transition"></i> <span class="hidden-xs"><?=$language["filter"]?></span></div></div>
            </div>
        </div>

        <div class="info-not-found-result hidden">
            <div class="no-data">
                <div class="no-data-content"><?=$language['noEmployeeFound']?></div>
            </div>
        </div>

        <div class="item-view-more cv-list-result"
            data-view-list-by-handlebar
            data-init-button-magic=".item [data-button-magic]"
            data-init-object="viewSearchCv"
            data-url="<?=$getUrl?>"
            data-method="get"
            data-show-page="10"
            data-show-item="10"
            data-show-all="false"
            data-scroll-view="true"
            data-form-filter=".form-filter"
            data-show-elm=".info-not-found-result"
            data-hidden-obj-null = "true"
            data-is-reload-page="true"
            data-reload-base-on-id="ui"
            data-reload-base-set-params="listID"
            data-reload-url="<?=APIGETUSERLISTID?>"
            data-template-id="entryCvItemAction" >
            <div data-content>
                <div class="style-loadding">...</div>
            </div>
            <div class="no-data">
                <div class="no-data-content"><?=$language['noEmployeeFound']?></div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div data-footer></div>
        </div>
    </div>
</div>