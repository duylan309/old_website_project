<div class="item-content">
    <h3 class="icon hidden tab-title hidden-sm hidden-md hidden-lg hidden-xs"><?=$language["photos"]?></h3>
    <div class="tab-content <?=isset($rowCompany['facebook']) ? '' : "fb_none" ?>">
        <div class="cmp-more no-m-top u-g-l-b list-photos">

        <?php
              if(isset($rowCompany["fb_load_photo"]) && $rowCompany["fb_load_photo"]== 1):
                    require dirname(__FILE__) . "/photo/cmp_photo_facebook.php";
              else:
                    require dirname(__FILE__) . "/photo/cmp_photo_site.php";
              endif;
        ?>

        </div>

    </div>
</div>
