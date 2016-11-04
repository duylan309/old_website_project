<?php
if(isset($strBannerConfig) && $strBannerConfig && !$url_data[0] ) {
    echo $strBannerConfig;
}
else {
    if(isset($bannerSlide) && $bannerSlide) {
        $strSlide=null;
        foreach($bannerSlide as $item):
            $image = $link = null;
            if( is_array($item) && isset($item["im"]) ){
                $image  = FOLDERIMAGEMENU.$item["im"];
                $link   = "#";
                if(is_file($image)):
                    $strSlide .='<div class="hidden banner-info" data-image="/'.$image.'" data-url="'.$link.'">
                        <div class="slide-content">
                            <p><a href="'.$link.'"><span class="iconm-point-right"></span>'.$item["ti"].'</a></p>
                        </div>
                    </div>';
                endif;
            }
            elseif( isset($pageInfo["db"]["id"]) && $pageInfo["db"]["id"]) {
                $image  = FOLDERSLIDEMENU.$pageInfo["db"]["id"]."/".$item;
                if(is_file($image)):
                    $strSlide .='<div class="hidden banner-info" data-image="/'.$image.'" data-url="#"></div>';
                endif;
            }
        endforeach;
        if($strSlide) {
        ?>
        <div id="slide-banner" data-supersized-animate>
            <div class="container">
                <div class="slide-container">
                    <div class="hidden-xs" id="slidecaption"></div>
                </div>
                <div id="supersized-loader"></div>
                <ul id="supersized"></ul>
                <?php
                if(count($bannerSlide)>1) {
                ?>
                <div class="controls-bar">
                    <a id="prevslide" class="nav-slide nav-slide-prev load-item"> <span></span></a>
                    <a id="nextslide" class="nav-slide nav-slide-next load-item"><span></span></a>
                </div>
                <?php }?>
                <div class="supersized-setup"><?=$strSlide?></div>
            </div>
        </div>
        <?php
        unset($bannerSlide);
        }
    }
}
?>
