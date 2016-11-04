<?php if(!$isJobOfUser) :?>
<div class="j-top cmp-more job-header-fix transition-quick">

    <div class="row">
        <div class="col-sm-9">
            <div class="j-level text-color2 t-s-16">
            <span class="c-list view-local-time"
               data-copy-template
               data-view-template=".view-local-time"
               data-elm-data='{"key":"","value":"","obj":"jobTimeOption","str":"<?=$infoJob["db"]["ty"]?>"}'
               data-template-id="entryViewLocalOption">&nbsp;</span>
            </div>
            <h1 class="text-color1 j-title no-margin"><?=$infoJob["db"]["ti"]; ?></h1>
            <strong class="text-color3 t-s-16">
                <?php
                $strPrice = $language["negotiable"];
                if(isset($infoJob["db"]["s1"]) && isset($infoJob["db"]["s2"]) && isset($infoJob["db"]["sa"]) ) {
                    if($infoJob["db"]["sn"] != 1 && $infoJob["db"]["s1"] != 0 && $infoJob["db"]["s2"] != 0 && $infoJob["db"]["sa"] != 0){
                        $strPrice = "<span data-format-currency>{$infoJob["db"]["s1"]}</span> - <span data-format-currency>{$infoJob["db"]["s2"]}</span>";
                        if($infoJob["db"]["sa"]==2) {
                            $strPrice .= " {$language["currencyOption"][2]}";
                        }
                        else {
                            $strPrice .= " {$language["currencyOption"][1]}";
                        }
                    }
                }

                echo $strPrice;
                ?>
            </strong>
        </div>
        <div class="col-sm-3">
            <div class="button-function j-u-function"
                data-copy-template
                data-view-template=".button-function"
                <?=$strElementData?>
                data-template-id="entryUserJobFunction">&nbsp;</div> 
        </div>
    </div>
</div>
<?php endif;?>