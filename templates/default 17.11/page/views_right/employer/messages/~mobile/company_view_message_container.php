<div class="user-manage-feature m-t-15">
    <div class="row">
        <div class="col-sm-3">
            <div class="user-menu-action"
                 data-elm-data='{"<?=$direction?>":"1"}'
                 data-copy-template
                 data-view-template=".user-menu-action"
                 data-template-id="entryUserMenuSetting"></div>
        </div>
        <?php
        if(isset($direction)):

            switch ($direction) {
                case 'view':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/view_detail.php";
                    break;

                case 'compose':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/compose.php";
                    break;

                case 'sent':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/sent.php";
                    break; 

                case 'draf':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/draf.php";
                    break;    

                case 'favorite':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/favorite.php";
                    break; 

                case 'trash':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/trash.php";
                    break;    

                case 'inbox':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/inbox.php";
                    break;

                default:
                ?>
                <script type="text/javascript">
                location.href="<?=SITEURL?>error404.html";
                </script>;
                <?php
                break;
            } # end switch 

        else:
            require dirname(__FILE__) ."/".$_SESSION["device"]."/inbox.php";
        endif;
        ?> 
    </div>    
</div>

<link rel="stylesheet" href="/media/style/messages.min.css" />

<!-- <div class="item-view-more"
                data-view-list-by-handlebar
                data-init-button-magic=".item [data-button-magic]"
                data-init-object="userManageCheckout"
                {{#if e.strUrlList}}
                data-url="{{e.strUrlList}}"
                {{/if}}
                data-elm-data='{"savejob":"1"}'
                data-method="get"
                data-show-page="10"
                data-show-item="10"
                data-show-all="false"
                data-scroll-view="false"
                data-form-filter=".form-filter"
                data-template-id="entryCheckoutItem">

                <div data-messages class="table-responsive p-10">
                    <table class="table table-bordered">
                        <colgroup>
                            <col class="col-sm-1">
                            <col class="col-sm-3">
                            <col class="col-sm-7">
                            <col class="col-sm-1">
                        </colgroup>
                        <thead>
                            <tr class="b-b bg-grey-color1">
                                <th></th>
                                <th>{{d.l10n.name}}</th>
                                <th>{{d.l10n.description}}</th>
                                <th>{{d.l10n.date}}</th>
                            </tr>
                           
                        </thead>
                        <tbody class="view-items" data-content>
                        </tbody>
                    </table>
                </div>
            </div> -->