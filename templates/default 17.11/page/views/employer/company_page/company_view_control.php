<div class="row cmp">
    <?php
    
    $tab = isset($url_data[1]) ? $url_data[1] : (isset($rowCompany['facebook']) && !is_array($rowCompany['facebook']) && count($rowCompany['facebook']) ? $seo_name["page"]["newfeed"] : $seo_name["page"]["about"]);

    if(isset($url_data[1]) && $url_data[1] == "admin") {
    ?>
    <div class="usersub-form u-signup in"
        data-elm-data='{"cid":"<?=$rowCompany["id"]?>","cname":"<?=$rowCompany["name"]?>","cim":"<?=$avatar_cmp?>"}'
        data-copy-template
        data-view-template=".usersub-form"
    data-template-id="entryUsersubSignin"></div>
    <?php
    } else {
    echo '<div class="col-sm-9">';
        require dirname(__FILE__) . "/company_view_header.php";
        ?>
        <div class="content-tabs">
            <div class="product-des">
                <?php
                if(isset($tab)):
                switch ($tab) {
                    case $seo_name["page"]["newfeed"]:
                        require dirname(__FILE__) . "/company_view_newfeed.php";
                        break;
                    case $seo_name["page"]["about"]:
                        require dirname(__FILE__) . "/company_view_profile.php";
                        break;
                    case $seo_name["page"]["photo"]:
                        require dirname(__FILE__) . "/company_view_photo.php";
                        break;
                    case $seo_name["page"]["jobs"]:
                        require dirname(__FILE__) . "/company_view_jobs.php";
                        break;
                    default:
                    ?>
                    <script type="text/javascript">
                    location.href="<?=SITEURL?>error404.html";
                    </script>';
                    <?php
                    break;
                }
                else:
                require dirname(__FILE__) . "/company_view_newfeed.php";
                endif;
                ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-sm-3">
    </div>
</div>