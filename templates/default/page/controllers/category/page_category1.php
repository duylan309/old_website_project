<?php
function main() {
    global $seo_name, $language, $pageInfo, $item, $langcode;
    if(isset($pageInfo["more"]["description"])){
        ?>
        <div class="more-info">
            <div class="title hidden">
                <h1><?=$pageInfo["db"]["ti_{$langcode}"]?></h1>
            </div>
            <div class="content">
                <?=$pageInfo["more"]["description"]["$langcode"]?>
            </div>
        </div>
        <?php
    } else {
        if (isset($pageInfo["detail"]) && $pageInfo["detail"]) {
            $strTab = null;
            foreach ($pageInfo["detail"] as $key => $value) {
              if ($value["title"] && $value["description"]) {
                $strTab .= '<div class="item-content">
                      <h3 class="icon tab-title">' . $value["title"] . '</h3>
                      <div class="tab-content" ><div class="tab-description" >' . $value["description"] . '</div></div>
                  </div>';
              }
            }
            echo $strTab ? '<div data-ui-tabs data-tab-class="ui-tabs" data-mobile-title="tab-title"><div class="product-des">'.$strTab.'</div></div>':'';
        }
    }
}


