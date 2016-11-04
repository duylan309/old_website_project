</script>
    <div class="hidden">
        <script src="<?=$getUrl.$paramUrl?>"></script>
    </div>
    <div class="row m-t-15">

        <div class="col-sm-3">
            <div class="filter-list filter-map search-job hidden-xs transition">
                <form class="post-form filter-form" action="/<?=$seo_name["page"]["search"]?>">

                    <div class="filter bg-color4">
                        <div class="header-tab p-10 j-stitle bg-color5 b-ra-t-r-l text-bold"><?=$language["filters"]?> <div class="btn small-padding filter-shortcut pull-right active"><i class="fa fa-plus transition t-s-12 m-t-10"></i></div></div>
                        <div class="form-group p-10 p-b-0">
                            <input type="hidden" name="distinct" value="1">
                            <input type="hidden" name="map" value="view">
   
                            <input class="form-control m-b-10"
                                id="autocomplete"
                                name="location"
                                value="<?=isset($_GET["location"]) ? $_GET["location"]:null; ?>"
                                placeholder="<?=$language["optAddress"]?>">

                            <input class="form-control m-b-10"
                                name="title"
                                value="<?=isset($_GET["title"]) ? $_GET["title"]:null; ?>"
                                placeholder="<?=$language["placeholderSearchJob"]?>">
                           
                            <div class="select-wrapper hidden">
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

                            <input name="sa"
                                class="form-control m-b-10"
                                value="<?=isset($_GET["sa"]) ? $_GET["sa"]:null; ?>"
                                onchange="$(this).val(Site.numberWithCommas($(this).val(),'.'));"
                                onkeyup="if (event.which >= 48 && event.which <= 57) {  $(this).val(Site.numberWithCommas($(this).val(),'.')); } else if(event.which ==13) { $(this).trigger('change'); }"
                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 37 && event.charCode <= 40) || event.charCode===0 "
                                placeholder="<?=$language["jobSalaryMin"]?>">

                          

                        </div>

                        <div class="job-filter-group filter-hidden hidden <?=isset($timeOption) && count($timeOption) ? "active" : ""?>">
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
                            
                        <div class="job-filter-group filter-hidden hidden <?=isset($levelOption) && count($levelOption) ? "active" : ""?>">    
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

                        <div class="job-filter-group filter-hidden hidden <?=isset($experienceOption) && count($experienceOption) ? "active" : ""?>">
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
                            
                        <div class="job-filter-group filter-hidden hidden <?=isset($languageOption) && count($languageOption) ? "active" : ""?>">    
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

                    <?php $link_search = str_replace(array("&map=view","?map=view"),"","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>    
                    <a class="btn btn-block bg-color1 m-t-10" href="<?=$link_search?>">
                        <i class="fa fa-th"></i> <span><?=$language["viewByList"]?></span>
                    </a>
                    <a class="btn btn-block bg-color5" href="<?=SITEURL.$seo_name["page"]["search"].'?random=1&brand=view'?>">
                        <i class="fa fa-building-o"></i> <span><?=$language["viewByBrand"]?></span>
                    </a>

                </form>
            </div>
        </div>
    
        <div class="col-sm-9">
            <div class="fullscreen-map">
                <div id="jobMap" class="view-items item-job" style="width:100%;height:100%">

                </div>
            </div>
        </div>
    </div>