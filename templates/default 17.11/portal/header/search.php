<?php if(isset($_SESSION["userlog"]["type"]) && $_SESSION["userlog"]["type"] == 1){
        $emp_type = 1;
    }else{
        $emp_type = 0;
    }
    $get = isset($_GET) ? $_GET : null;
    $languageOption = isset($get["la"]) ? $get["la"] : array();
    $timeOption = isset($get["ty"]) ? $get["ty"] : array();


?>
<div class="get-action search-content" data-content-navigate-mobile>
    <form class="form-inline" <?=$emp_type == 1 ? 'action="/'.$seo_name["page"]["searchcv"].'"' : 'action="/'.$seo_name["page"]["search"].'"'?>>
        
            <input type="hidden" value="1" name="distinct">
            <input type="hidden" value="1" name="random">
            <div class="form-group">
                <div class="s-title hidden"><?=$language["findJob"]?></div>
                <div class="box-search-title">
                    <input class="form-control" id="searchbar"
                    name="title"
                    value="<?=isset($_GET["title"]) ? $_GET["title"]:null; ?>"
                    placeholder="<?=$emp_type==1? $language["placeholderSearchCv"] :$language["placeholderSearchJob"]?>">
                    <span class="select-wrapper map-marker">
                    <select name="loc"
                        class="form-control"
                        type="select"
                        data-validate
                        data-required="<?=$language["optCity"]?>"
                        data-object-init='{"id":"", "ti":"<?=$language["locationSearch"]?>"}'
                        data-dropdown
                        data-index-value="<?=isset($_GET["loc"]) ? $_GET["loc"] : 30?>"
                        data-option-local-json="location"
                        data-option-from-json="<?=APIGETLOCATION;?>">
                        <option value=""><i class="fa fa-user"></i> <?=$language["optCity"]?></option>
                    </select>
                </span>
                </div>
            </div>

            <div class="form-group">
                <div class="s-title"><i class="fa fa-suitcase"></i> <?=$language["jobCategories"]?></div>
                <span class="select-wrapper">
                <select name="cat"
                    class="form-control"
                    data-dropdown
                    data-option-from-json="<?=APIGETMENU;?>"
                    data-option-local-json="menuStructure"
                    data-params="opp=3"
                    data-index-value="<?=isset($_GET["cat"])?$_GET["cat"]:null; ?>"
                    data-object-init='{"id":"", "ti":"<?=$language["optInsdustry"]?>"}'
                    data-target-append=".multiselect-category">
                    <option value=""><?=$language["optInsdustry"]?></option>
                </select>
                </span>
            </div>

            <div class="form-group">
                <div class="s-title"><i class="fa fa-clock-o"></i> <?=$language["jobType"]?></div>
                <?php
                if(isset($language["jobTimeOption"]) && $language["jobTimeOption"]):
                foreach ($language["jobTimeOption"] as $key => $value):
                ?>
                <div class="checkbox btn-checkbox">
                    <input class="b-r-4" name="ty[]"
                           type="checkbox"
                           <?=in_array($key, $timeOption) ? "checked" : null;?>
                           value="<?=$key?>">
                    <span class="checkbox-style"></span>
                    <span class="tx"><?=$value?></span>
                </div>
                <?php
                endforeach;
                endif;
                ?>
            </div>  

            <div class="form-group">
                <div class="s-title"><i class="fa fa-language"></i>  <?=$language["jobPreferredlanguage"]?></div>

                <?php
                if(isset($language["langOption"]) && $language["langOption"]):
                foreach ($language["langOption"] as $key => $value):
                ?>
                <div class="checkbox btn-checkbox">
                    <input class="b-r-4" name="la[]"
                           type="checkbox"
                           <?=in_array($key, $languageOption) ? "checked" : null;?>
                           value="<?=$key?>">
                    <span class="checkbox-style"></span>
                    <span class="tx"><?=$value?></span>
                    
                </div>
                <?php
                endforeach;
                endif;
                ?>
            </div>
            <div class="form-group">
                <button class="btn bg-color1 text-uppercase">
                    <span class="icon-search icon-search1"> </span> <?=$language["btnSearch"]?>
                </button>
                <div class="btn bg-color5 btn-block m-t-10 close-search">
                    <i class="fa fa-times"></i> <?=$language["btnCancel"]?>
                </div>  
            </div>
       
    </form>
</div>