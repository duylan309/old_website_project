<?php

if(isset($_GET["title"])){
    $s_title = $_GET["title"];
}else{
    $s_title = "";
}

if(isset($_GET["loc"])){
    $s_loc = $_GET["loc"];
}else{
    $s_loc = 30;
}

if(isset($_SESSION["userlog"]["type"]) && $_SESSION["userlog"]["type"]!=2){
    if($url_data[0] == $seo_name["page"]["search"]){
        $type_search = 2;
    }else{
        $type_search = 1;

    }
}
else {
    $type_search = 2;
}

$type_search = 2;
?>

<form class="form-inline" action="/<?=$type_search == 1 ? $seo_name["page"]["searchcv"] : $seo_name["page"]["search"]?>">

        <div class="form-group">
            <input type="hidden" value="1" name="distinct">
            <input type="hidden" value="1" name="random">

            <input  class="form-control" 
                    id="searchbar" 
                    name="title" 
                    value="<?=$s_title?>"
                    placeholder="<?=$type_search==1 ? $language["placeholderSearchCv"] : $language["placeholderSearchJob"]?>" >
               

            <span class="select-wrapper">

            <select name="loc"
                    class="form-control"
                    type="select"
                    data-validate
                    data-required="<?=$language["optCity"]?>"
                    data-object-init='{"id":"", "ti":"<?=$language["locationSearch"]?>"}'
                    data-dropdown
                    data-index-value="<?=$s_loc?>"
                    data-option-local-json="location"
                    data-option-from-json="<?=APIGETLOCATION;?>">
                    <option value=""><i class="fa fa-user"></i><?=$language["optCity"]?></option>
            </select>
            </span>
        </div>
        <div class="form-group">
            <button class="btn bg-color3 text-uppercase"><span class="icon-search icon-search1"> </span> <span class="hidden-xs hidden-sm"></span></button>
        </div>
        
    </form>