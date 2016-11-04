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

                case 'important':
                    require dirname(__FILE__) ."/".$_SESSION["device"]."/important.php";
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