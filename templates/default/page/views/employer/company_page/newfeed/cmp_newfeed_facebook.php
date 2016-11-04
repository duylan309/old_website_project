<script type="text/javascript">

var FBURL = getUrl("<?=isset($rowCompany['facebook']) && !is_array($rowCompany['facebook']) ? strtolower($rowCompany['facebook']) : 0 ?>");

function getUrl(urlget) {
    var result= [];

    result[0] =  urlget.indexOf("http://");
    result[1] =  urlget.indexOf("https://");

    if(result[0] != -1 || result[1] != -1 ){
      return urlget;
    }else{
      return "https://"+urlget;
    }
}

$(function () {
    $(document).ready(function() {
      $.ajaxSetup({ cache: false });

      $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
        FB.init({
          appId: '102432476842485',
          version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
        });

       if(FBURL != 0)
       {
           getFacebookID(FBURL);
       }

      });
    });
});



function getFacebookID(FBURL){
    FB.api(
        "/",
        {"id": FBURL ,"access_token":"<?=TOKENFB?>"},

        function (response) {
          console.log(response);
          // alert(1);
          if (response && !response.error) {

            getFacebookNewfeed(response.id);
            $('.fb-load-more').attr('data-fb-id', response.id);
          }else{

             $('.fb-error').addClass("display-block");
             $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');

          }
        }
    );
}

function getFacebookNewfeed(FBCMPID){
   FB.api(
       FBCMPID+'/posts',
       'GET',
       {"fields":"full_picture,from,caption,message,created_time,call_to_action,actions,likes.limit(0).summary(true),comments.limit(0).summary(true),shares","access_token":"<?=TOKENFB?>","limit":"10"},
       function(response) {
          if(response && !response.error){
             var obj = response.data;
             if(obj.length) {
                if(obj.length > 9){
                  var dataNextUrlArr = getUrlVars(response.paging.next);
                  $('.fb-load-more').attr('data-next-url', dataNextUrlArr['__paging_token']);
                  $('.fb-load-more').attr('data-next-url-until', dataNextUrlArr['until']);
                }else{
                  $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');
                }

                $('[data-view-list-by-handlebar-fb]').viewListByHandlebar({"initObject":obj});

              }


          }else{

             $('.fb-error').addClass("display-block");
             $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');

          }

       }
   );
}

function getUrlVars(url) {
  var arr = url.split('&');
  var values = [];
  Object.keys(arr).forEach(function(key){
       var setValue =  arr[key].split("=");
       values[setValue[0]] = setValue[1];
  });
  return values;
}

function getFacebookNextFeed(){

   var FBCMPID = $('.fb-load-more').attr('data-fb-id');
   var UrlFields = $('.fb-load-more').attr('data-next-url');
   var UrlFieldsUntil = $('.fb-load-more').attr('data-next-url-until');

    // CHƯA CÓ PHẦN TRANG
   FB.api(
       FBCMPID+'/posts',
       'GET',
       {"fields":"full_picture,from,caption,message,created_time,call_to_action,actions,likes.limit(0).summary(true),comments.limit(0).summary(true),shares","limit":"10","access_token":"<?=TOKENFB?>","__paging_token":UrlFields,"until":UrlFieldsUntil},
       function(response) {
           if(response && !response.error){
             var obj = response.data;
             if(obj.length) {
             console.log(obj.length);

                  if(obj.length > 9){
                    var dataNextUrlArr = getUrlVars(response.paging.next);
                    $('.fb-load-more').attr('data-next-url', dataNextUrlArr['__paging_token']);
                    $('.fb-load-more').attr('data-next-url-until', dataNextUrlArr['until']);
                  }else{
                    $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');
                  }

                  $('[data-view-list-by-handlebar-fb]').viewListByHandlebar({"initObject":obj});

              }

          }else{

             $('.fb-error').addClass("display-block");
             $('.newsfeed-fb .style-loadding').css('display','none');

          }
       }
   );
}

</script>
  <div class="fb-error">
        <div class="no-data">
            <div class="no-data-content"><?=$language["facebookErrorUrl"]?><br><?=$language["notiCanGetFbNewfeed"]?><a class="text-uppercase" href="/<?=$seo_name["page"]["user"]?>?manage=info"><?=$language["notiCanGetFbNewfeedEditFacebook"]?></a></div>
        </div>
  </div>

  <div class="item-view-more side-bar"
      data-view-list-by-handlebar-fb
      data-init-button-magic=".item [data-button-magic]"
      data-method="get"
      data-show-page="5"
      data-show-item="5"
      data-elm-data='{"cmpim":"<?=$rowCompany["im"]?>","cmpname":"<?=$rowCompany["name"]?>"}'
      data-show-all="false"
      data-ignore-visible="true"
      data-scroll-view="true"
      data-scroll-bottom=".newfeed-more"
      data-form-filter=".form-filter"
      data-is-reload-page="false"
      data-ignore-hash="true"
      data-append="true"
      data-template-id="viewItemBlogFB">

      <div class="view-items newsfeed-fb" data-content>
          <div class="style-loadding hidden"></div>
      </div>

      <div data-footer=""></div>
  </div>

<div class="newfeed-more hidden"></div>
<div class="fb-load-more text-center text-uppercase" onclick="getFacebookNextFeed();">
<div class="btn bg-color7"> <?=$language["loadMore"]?></div>
</div>



