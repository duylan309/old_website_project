<div id="main-menu" class="bg-color1">
    <div class="container">
        <div class="desktop-menu">
            <ul>
                <li><a href="/<?=$seo_name["page"]["admin"]?>"><img src="<?=UDATAIMAGE?>style/logo1.png" alt="Thuetoday.vn"></a></li>
                <?php if(isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {?>
                <li><a href="?fun=config">Config</a></li>
                <li><a href="?fun=category"><?=$language["category"]?></a></li>
                <li><a href="?fun=pagehtml">Page HTML</a></li>
                <li class="hidden"><a href="?mod=image"><?=$language["image"]?></a></li>
                <li><a href="?fun=user">Applicant</a></li>
                <li><a href="?fun=cmp"><?=$language["company"]?></a></li>
                <li><a href="?fun=cmppage">Page CMP</a></li>
                <li><a href="?fun=jobs"><?=$language["jobs"]?></a></li>
                <li><a href="?fun=jobapply"><?=$language["btnApply"]?></a></li>
                <li class="hidden"><a href="?fun=news">News</a></li>
                <li><a href="?fun=contact"><?=$language["contact"]?></a></li>
                <li class="hidden"><a href="?fun=checkout">Checkout</a></li>
                <li><a href="?fun=promo">Promo</a></li>
                <li><a href="?fun=history">History</a></li>
                <li><a href="?fun=managerweb">Manager</a></li>
                <li><a href="?fun=password">Password</a></li>
                <li class="hidden"><a href="?fun=sendedm">Send Email Edm</a></li>
                <li><a href="?fun=messages"><?=$language["message"]?></a></li>
                <?php }?>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
