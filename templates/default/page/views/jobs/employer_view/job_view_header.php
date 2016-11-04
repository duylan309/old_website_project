<?php if($isJobOfUser && !isset($_GET["cid"])):?>
<div class="j-top cmp-more">
 <div class="row">
        <div class="col-sm-9 ">
            <div class="j-level text-color2 t-s-16">
             <span class="c-list view-local-time"
                data-copy-template
                data-view-template=".view-local-time"
                data-elm-data='{"key":"","value":"","obj":"jobTimeOption","str":"<?=$infoJob["db"]["ty"]?>"}'
                data-template-id="entryViewLocalOption">&nbsp;</span>
            </div>
            <h1 class="text-color1 j-title no-margin"><?=$infoJob["db"]["ti"]; ?></h1>
            <strong class="text-color3 t-s-16">
                <?=$strPrice?>
            </strong>
        </div>
        <div class="col-sm-3">
            <div class="button-function j-u-function"
                data-copy-template
                data-view-template=".button-function"
                <?=$strElementData?>
                data-template-id="entryUserJobFunction">&nbsp;</div>
            </button>
        </div>
    </div>
</div>
<?=$strUserTab;?>
<?php endif;?>