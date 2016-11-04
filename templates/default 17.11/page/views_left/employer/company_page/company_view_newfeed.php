<div class="item-content">
    <h3 class="icon hidden tab-title hidden-sm hidden-md hidden-xs"><?=$language["newfeed"]?></h3>

    <div class="tab-content">
        <div class="row">
            <div class="col-sm-4 side-bar">
                <div class="side-block text-color1 hidden-xs">
                    <h3 class="text-bold text-left t-s-16 hidden"><?=$language["generalInfo"]?></h3>
                    <p class="text-left t-s-12"><?=$rowCompany["address"].', '.$language["locationOption"][$rowCompany["city"] ];?></p>
                    <?php if(isset($rowCompany["phone"]) && count($rowCompany["phone"])):?><p class="text-left t-s-12 short-text"><i class="fa fa-phone"></i>&nbsp;<?=$rowCompany["phone"]?></p><?php endif;?>
                    <?php if(isset($rowCompany["facebook"]) && count($rowCompany["facebook"])):?><p class="text-left t-s-12 short-text"><i class="fa fa-facebook"></i>&nbsp;<span class="text-color3"><?=$rowCompany["facebook"] ? $rowCompany["facebook"] : ""?></span></p><?php endif;?>

                </div>

                <div class="text-center side-block hidden">
                    <h3>Rate this company</h3>
                    <p>4.5 of 5 stars from 2.245 people</p>
                    <div class="rating">
                    </div>
                </div>

                <div class="text-center side-block hidden-xs">
                    <div class="btn-share">
                        <?php
                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        ?>
                        <a data-share-to="https://www.facebook.com/sharer/sharer.php?u="
                            data-share-link="<?=$actual_link?>"
                            data-center="true"
                            href="#"
                            class="btn btn-block facebook-color">
                            Facebook
                        </a>
                        <a data-share-to="https://twitter.com/intent/tweet?source="
                            data-share-link="<?=$actual_link?>"
                            data-center="true"
                            href="#"
                            class="btn btn-block twitter-color">
                            Twitter
                        </a>
                        <a data-share-to="https://plus.google.com/share?url="
                            data-share-link="<?=$actual_link?>"
                            data-center="true"
                            href="#"
                            class="btn btn-block google-color">
                            Google+
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
               <?php
                    if($rowCompany["facebook"] && isset($rowCompany["fb_load_newfeed"]) && $rowCompany["fb_load_newfeed"]== 1):
                        require dirname(__FILE__) . "/newfeed/cmp_newfeed_facebook.php";
                    else:
                        require dirname(__FILE__) . "/newfeed/cmp_newfeed_site.php";
                    endif;
               ?>
            </div>
        </div>
    </div>
</div>
