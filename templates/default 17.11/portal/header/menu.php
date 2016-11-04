<div class="get-action menu-expand">
    <div class="list-menu">
    <ul class="ul-header">
        <?php if($sessionUserId):?>
            <?php if($_SESSION["userlog"]["name"]){?>
                <?php if($_SESSION["userlog"]["type"] == 1):
                
                $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($_SESSION["userlog"]["name"]))) );
                
                if($_SESSION["userlog"]["username"]){
                    $cmp_link = '/'.$_SESSION["userlog"]["username"];
                }else{
                    $cmp_link = '/'.$seo_name["page"]["cmp"].'/'.$_SESSION["userlog"]["id"].'/'.$linkFriendly;
                }?>
                    <ul class="company-list-top-h"
                        data-copy-template
                        data-elm-data='{"hiddenMenu":"1","mobile":"1"}'
                        data-view-template=".company-list-top-h" data-template-id="entryUserMenuSetting"></ul>
                    <ul>

                        
                        <li>
                            <a href="#"
                                data-button-magic
                                data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                            data-redirect="/"><i class="fa fa-sign-out"></i> <span><?=$language["signout"]?></span></a>
                        </li>
                        
                        <?php if(!isset($_SESSION["userlog"]["dayleftshow"])):?>
                        <li class="bg-color3">
                            <a href="<?="/{$seo_name["page"]["user"]}?manage=promoapplied"?>">
                               <span><?=$language["ActivationCode"]?></span>
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                
                <?php else:
                    $linkFriendly = preg_replace('/[^a-zA-Z0-9]+/', '-', trim(strtolower(endcode_vn($_SESSION["userlog"]["name"]))) );
                    $user_link = '/'.$seo_name["page"]["cv"].'/'.$_SESSION["userlog"]["id"].'/'.$linkFriendly;?>
                
                    <ul class="company-list-top-h"
                        data-copy-template
                        data-elm-data='{"hiddenMenu":"1","mobile":"1"}'
                        data-view-template=".company-list-top-h" data-template-id="entryUserMenuSetting"></ul>
                    <ul>
                    
                    <li>
                        <a href="#"
                            data-button-magic
                            data-ajax-url="<?=APIPOSTUSERSIGNOUT?>"
                        data-redirect="/"><i class="fa fa-sign-out"></i> <span><?=$language["signout"]?></span></a>
                    </li>
                <?php endif;?>
            
            <?php }else{?>
            <a href="<?="/{$seo_name["page"]["user"]}";?>"><?=$language["pleaseUpdateInfomation"]?></a>
            <?php }?>

        <?php else:?>
                        
        <li class="hidden"><a href="/<?=$seo_name["page"]["category"]?>/employer"><i class="fa fa-pencil-square-o"></i><span class="text-bold"><?=$language["btnPostJob"]?></span></a></li>
        <li><a href="/rg"><i class="fa fa-user-plus"></i> <span><?=$language["register"]?></span></a></li>
        <li><a href="/user?manage=company#group-view=2"
            class="bg-color6"
            data-button-magic
            data-elm-data='{"urlRedirect":"."}'
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
        data-template-id="entrySigninPopup"><i class="fa fa-sign-in"></i> <span><?=$language["signin"]?></span></a></li>
        <li><a href="#"
            class="bg-color6 hidden"
            data-button-magic
            data-elm-data='{"urlRedirect":"."}'
            data-view-template-local="true"
            data-view-template="[data-quick-view-item]"
        data-template-id="entrySignupWithPromoCode">Promocode</a></li>
        
        <?php endif;?>
    </ul>
    </div>
</div>