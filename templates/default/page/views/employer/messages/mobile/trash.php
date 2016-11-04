<p class="hidden">
    <script type="text/javascript" src="<?=$script?>"></script>
</p>
<div class="message-inbox">
    <div class="item-view-contact-list admin-list"
        data-view-list-by-handlebar
        data-init-button-magic="[data-button-magic]"
        data-init-object="loadMessages"
        data-method="get"
        data-show-page="6"
        data-show-item="30"
        data-elm-data='{"imagefolder":"<?=FOLDERIMAGEUSER?>","type":"<?=$_SESSION["userlog"]["type"]?>","action":"trash"}'
        data-show-all="false"
        data-scroll-view="false"
        data-form-filter=".form-filter"
        data-elm-data='{"adminList":1}'
        data-template-id="entryLoadMessageMobile"> 
              
       <div class="container">
           <div class="row m-b-10">
               <div data-message-header class="col-xs-12">
                   <h2 class="pull-left text-color1 t-s-20"><?=$language["messages"]?></h2>
                   <a  class="btn bg-color2 form-add btn-add-a-item"
                       href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=compose">
                       <i class="fa fa-plus t-s-12"></i> <span class="t-s-14"><?=$language["writemessages"]?></span>
                   </a>
               </div>
           </div>
           <div class="p-10" data-search-mobile>
               <?php require dirname(__FILE__) . "/search.php";?>
           </div>
           <div class="row m-b-10">
               <ul data-menu-message class="col-xs-12">
                   <li class="btn bg-color7 b-r-4">
                       <a  class="t-s-14"
                           href="/<?=$seo_name["page"]["user"]?>?manage=messages">
                           <?=$language["inboxmessages"]?>
                       </a>
                   </li>
                    <li class="btn bg-color7 b-r-4">
                       <a  class="t-s-14"
                           href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=sent">
                           <?=$language["sentmessages"]?></a>
                   </li> 
                   <li class="btn bg-color7 b-r-4">
                       <a  class="t-s-14"
                           href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=important">
                       <?=$language["importantmessages"]?></a>
                   </li>
                   <li class="btn bg-color7 b-r-4 active">
                       <a  class="t-s-14"
                           href="/<?=$seo_name["page"]["user"]?>?manage=messages&action=trash">
                           <?=$language["trashmessages"]?></a>
                   </li>

               </ul>
           </div>
       </div>

       <div table-message-inbox class="view-items" data-content>
          
       </div>    
       <div class="container b-r-4" data-footer></div>

    </div>
</div>