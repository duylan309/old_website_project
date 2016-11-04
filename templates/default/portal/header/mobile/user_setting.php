<?php   $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($_SESSION["userlog"]["name"]))) );
        $user_link = '/'.$seo_name["page"]["cv"].'/'.$_SESSION["userlog"]["id"].'/'.$linkFriendly;?>
<div class="p-b-30"> 
<ul>
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
                <span class="icon-avatar">
                    <a href="<?=$user_link?>">
                    <?php if($_SESSION["userlog"]["im"] && !isset($_SESSION["usersub"])):?>
                    <img src="/<?=FOLDERIMAGEUSER.$_SESSION["userlog"]["im"]?>">
                    <?php elseif(isset($_SESSION["usersub"]["im"]) && $_SESSION["userlog"]):?>
                    <img src="/<?=FOLDERIMAGECOMPANY.$_SESSION["usersub"]["im"]?>">
                    <?php else:?>
                    <i class="fa fa-user"></i>
                    <?php endif;?>
                    </a>
                </span>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="<?=$user_link?>">
                <span><?=$_SESSION["userlog"]["name"]?></span>
                </a>
            </div>
        </div>
    </li>
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
               <i class="fa no-shadow">&nbsp;</i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>">
                     <span><?=$language["btnUpdateProfile"]?></span>
                </a>
            </div>
        </div>
    </li>


    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
                <i class="fa fa-file"></i> 
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobapply">
                    <span><?=$language["jobApplied"]?></span>
                </a>
            </div>
        </div>
    </li>
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
                <i class="fa fa-heart"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=jobsave">
                    <span><?=$language["jobSaved"]?></span>
                </a>
            </div>
        </div>
    </li>

    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="col-sm-11 col-xs-10">
                <a href="/<?=$seo_name["page"]["user"]?>?manage=messages">
                    <span><?=$language["messages"]?></span>
                </a>
            </div>
        </div>
    </li>
    
    <li>
        <div class="row">
            <div class="col-sm-1 col-xs-2">
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
            <div class="col-sm-1 col-xs-2">
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
</div>