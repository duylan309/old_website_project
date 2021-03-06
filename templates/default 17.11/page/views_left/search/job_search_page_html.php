<div class="hidden">
    <script src="<?=$getUrl.$paramUrl?>"></script>
</div>
<div class="row m-t-15">
    <div class="col-sm-3">
        <div class="filter-list hidden-xs">
            <form class="post-form filter-form" data-change-to-submit-form action="/<?=$seo_name["page"]["search"]?>">
                <div class="filter bg-color4">
                    <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?></div>
                    
                    <div class="form-group p-10 p-b-0">
                        <input type="hidden" name="distinct" value="1">
                        <input type="hidden" name="random" value="1">
                        
                        <input class="form-control m-b-10"
                        name="title"
                        value='<?=isset($getParams["subject"]) && count($getParams["subject"]) ? html_entity_decode($getParams["subject"]):null; ?>'
                        placeholder="<?=$language["placeholderSearchJob"]?>">
                        
                        <div class="select-wrapper">
                            <select name="loc"
                                data-validate
                                data-dropdown
                                data-index-value="<?=isset($getParams["lo"]) && count($getParams["lo"]) ? $getParams["lo"]:null; ?>"
                                data-object-init='{"id":"", "ti":"<?=$language["optCity"]?>"}'
                                data-option-local-json="location"
                                class="form-control">
                                <option value=""><?=$language["optCity"]?></option>
                            </select>
                        </div>

                        <input  name="sa"
                                class="form-control m-b-10"
                                value="<?=isset($getParams["sa"]) && count($getParams["sa"]) ? $getParams["sa"]:null; ?>"
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
                </div>
                <button class="btn btn-block bg-color1 m-t-10">
                    <span class="fa fa-search"> </span>
                    <span><?=$language["btnSearch"]?></span>
                </button>

                <a class="btn btn-block bg-color2 m-t-10" href="<?="http://$_SERVER[HTTP_HOST]/".$seo_name["page"]["search"]."?map=view"?>">
                    <i class="fa fa-map-marker"></i> <span><?=$language["viewByMap"]?></span>
                </a>

            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="m-filter-header hidden-md hidden-sm hidden-lg hidden">
            <div class="row">
                <div class="col-xs-8"><span class="text-color1 text-bold t-s-18"><?=$language["allJobs"]?></span></div>
                <div class="col-xs-4 text-right"><div class="bg-color3 text-uppercase text-bold filter-btn b-r-4"><i class="fa fa-filter"></i> <?=$language["filter"]?></div></div>
            </div>
        </div>
        <div class="item-view-more job-list-result"
            data-view-list-by-handlebar
            data-init-button-magic=".item [data-button-magic]"
            data-init-object="viewSearchJobs"
            data-url='<?=$getUrl.$paramUrl?>'
            data-method="get"
            data-show-page="10"
            data-show-item="20"
            data-show-all="false"
            data-scroll-view="true"
            data-form-filter=".form-filter"
            data-object-reverse="true"
            data-is-reload-page="true"
            data-reload-base-on-id="id"
            data-reload-base-set-params="listID"
            data-reload-url="<?=APIGETJOBLISTID?>"
            data-template-id="viewItemJobSearch" >
            <div
                data-content
                class="view-items"
                data-center-items
                data-class-name="item-job"
                data-item-class=".item"
                data-responsive="true"
                data-items-custom="[835, 4], [500,3]"><div class="style-loadding"></div>
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
        </div>
    </div>
</div>