<ul>
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
               <i class="fa fa-building"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp">
                     <span><?=$language["page"]?></span>
                </a>
            </div>
        </div>
    </li>
</ul>
<ul class="company-setting in no-border"
    data-copy-template
    data-view-template=".company-setting"
    data-template-id="entryCmpPageSimpleListMobile">

</ul>

<ul>
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <i class="fa fa-suitcase"></i> 
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobs">
                    <span><?=$language["jobs"]?></span>
                </a>
            </div>
        </div>
    </li>
    
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <i class="fa fa-files-o"></i> 
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=userapply">
                    <span><?=$language["applications"]?></span>
                </a>
            </div>
        </div>
    </li>

    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <i class="fa fa-users"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=usersub">
                    <span><?=$language["admin"]?></span>
                </a>
            </div>
        </div>
    </li>

    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <i class="fa fa-code"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=promoapplied">
                    <span><?=$language["ActivationCode"]?></span>
                </a>
            </div>
        </div>
    </li>
    
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <i class="fa fa-gears"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=info">
                    <span><?=$language["accountSettting"]?></span>
                </a>
            </div>
        </div>
    </li>

    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2 text-center">
                <a href="#"
                    data-button-magic
                    data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                data-redirect="/"><i class="fa fa-sign-out"></i> </a>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="#"
                    data-button-magic
                    data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                    data-redirect="/"><span><?=$language["signout"]?></span></a>
            </div>
        </div>
    </li>      
</ul>