<div class="hidden">
    <script src="<?=$getUrl.$paramUrl?>&viewSearchJobs"></script>
</div>
<div class="row m-t-15">
    <div class="col-sm-3">
        <div class="filter-list search-job hidden-xs transition">
            <form data-search-form class="post-form filter-form" data-change-to-submit-form action="/<?=$seo_name["page"]["search"]?>">
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
                        <div    class="head-title-bar p-10"
                                data-object=".job-filter-group" 
                                data-closet-toggle-class="active">
                                <?=$language["jobCategories"]?> <i class="fa fa-plus pull-right transition"></i>
                        </div>

                        <div class="form-group">
                               <?php if($language["categoriesOption"]):
                               foreach($language["categoriesOption"] as $key => $value):?>
                               <label class="checkbox">
                                   <input name="cati[]"
                                          type="checkbox"
                                          <?=isset($get['cati']) && $get['cati'] == $key ? 'checked="checked"' : ''?>
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
            data-url="<?=$getUrl.$paramUrl?>"
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