<script type="text/javascript">

var FBURL = getUrl("https://facebook.com/thuetoday/");

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

        getFacebookNewfeed("265132260496825");
        // if(FBURL != 0)
        // {
        //    // getFacebookID(FBURL);
        // }

      });
    });
});

function getFacebookID(FBURL){
    FB.api(
        "/",
        {"id": FBURL ,"access_token":"<?=TOKENFB?>"},

        function (response) {
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
       {"fields":"id,type,full_picture,from,caption,message,created_time,call_to_action,actions,likes.limit(0),comments.limit(0),shares,link,source,name","access_token":"<?=TOKENFB?>","limit":"10"},
       function(response) {
          if(response && !response.error){
             var obj = response.data;
             if(obj.length) {
                // console.log(obj);
                if(obj.length > 9){
                  var dataNextUrlArr = getUrlVars(response.paging.next);
                  $('.fb-load-more').attr('data-next-url', dataNextUrlArr['__paging_token']);
                  $('.fb-load-more').attr('data-next-url-until', dataNextUrlArr['until']);
                }else{
                  $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');
                }
               
                Object.keys(obj).forEach(function(key){
                  //console.log(urlFriendly(obj[key].name));
                  var string,urlLink=urlFriendly(obj[key].name)+'.'+obj[key].id,content = shortent(obj[key].message, 250);

                  if(obj[key].type == "video"){
                    string = '<div class="item i-blog"><div class="sortcontent"><div class="video-fb"><video controls poster="'+obj[key].full_picture+'"><source src="'+obj[key].source+'" type="video/mp4"></video></div><a href="/<?=$seo_name["page"]["social"]?>/'+urlLink+'"><p class="textarea-content m-t-15">'+content+'</p></a></div></div>';
                  }else{
                    if(obj[key].link.indexOf('http://giphy.com/gifs/') != -1 || obj[key].link.indexOf('https://giphy.com/gifs/') != -1){
                      var strGif = obj[key].link.split('/');
                      strGif = strGif[strGif.length-1].split('?');
                      var linkGif = strGif[0];
                      var sourceUrl = obj[key].link.indexOf('https://giphy.com/gifs/') != -1 ? 'https://giphy.com/media/' : 'http://giphy.com/media/';

                      string = '<div class="item i-blog"><div class="sortcontent"><div class="fb-img"><a href="/<?=$seo_name["page"]["social"]?>/'+urlLink+'"><img src="'+sourceUrl+linkGif+'/giphy-tumblr.gif"></a></div><a href="/<?=$seo_name["page"]["social"]?>/'+urlLink+'"><p class="textarea-content m-t-15">'+content+'</p></a></div></div>';
                    }else{
                      string = '<div class="item i-blog"><div class="sortcontent"><div class="fb-img"><a href="/<?=$seo_name["page"]["social"]?>/'+urlLink+'"><img src="'+obj[key].full_picture+'"></a></div><a href="/<?=$seo_name["page"]["social"]?>/'+urlLink+'"><p class="textarea-content m-t-15">'+content+'</p></a></div></div>';
                    } 
                  }
                  $('.newsfeed-fb').append(string.trim());
                });


                // if(obj.length > 9){
                //   var dataNextUrlArr = getUrlVars(response.paging.next);
                //   $('.fb-load-more').attr('data-next-url', dataNextUrlArr['__paging_token']);
                //   $('.fb-load-more').attr('data-next-url-until', dataNextUrlArr['until']);
                // }else{
                //   $('.newsfeed-fb .style-loadding,.fb-load-more').css('display','none');
                // }

                // $('[data-view-list-by-handlebar-fb]').viewListByHandlebar({"initObject":obj});

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

   var FBCMPID = '265132260496825';
   var UrlFields = $('.fb-load-more').attr('data-next-url');
   var UrlFieldsUntil = $('.fb-load-more').attr('data-next-url-until');

    // CHƯA CÓ PHẦN TRANG
   FB.api(
       '265132260496825/posts',
       'GET',
       {"fields":"id,type,full_picture,from,caption,message,created_time,call_to_action,actions,likes.limit(0),comments.limit(0),shares,link,source,name","limit":"10","access_token":"<?=TOKENFB?>","__paging_token":UrlFields,"until":UrlFieldsUntil},
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
                Object.keys(obj).forEach(function(key){
                   // console.log(obj[key].type);
                   var string,urlLink;
                   var content = shortent(obj[key].message, 250);
                   if(obj[key].type == "video"){
                     string = '<div class="item i-blog"><div class="sortcontent"><div class="video-fb"><video controls poster="'+obj[key].full_picture+'"><source src="'+obj[key].source+'" type="video/mp4"></video></div><p class="textarea-content m-t-15">'+content+'</p></div></div>';
                   }else{
                     if(obj[key].link.indexOf('http://giphy.com/gifs/') != -1 || obj[key].link.indexOf('https://giphy.com/gifs/') != -1){
                      var strGif = obj[key].link.split('/');
                      strGif = strGif[strGif.length-1].split('?');
                      var linkGif = strGif[0];
                      var sourceUrl = obj[key].link.indexOf('https://giphy.com/gifs/') != -1 ? 'https://giphy.com/media/' : 'http://giphy.com/media/';

                      string = '<div class="item i-blog"><div class="sortcontent"><div class="fb-img"><img src="'+sourceUrl+linkGif+'/giphy-tumblr.gif"></div><p class="textarea-content m-t-15">'+content+'</p></div></div>';
                     }else{
                      string = '<div class="item i-blog"><div class="sortcontent"><div class="fb-img"><img src="'+obj[key].full_picture+'"></div><p class="textarea-content m-t-15">'+content+'</p></div></div>';
                     }   
                   }
                   $('.newsfeed-fb').append(string.trim());
                 });
              }

          }else{

             $('.fb-error').addClass("display-block");
             $('.newsfeed-fb .style-loadding').css('display','none');

          }
       }
   );
}

function shortent(t,e){
  if (t && t.length) {
        var n = t;
        if(n.length > e){
          n = n.substr(0, e) + "..."
        }
  }

  return n
}

function urlFriendly (t) {
    "use strict";
    return t ? ( t = convertVietnamese(t), t = t.replace(/[^A-Z0-9]/gi, "-"), t) : ""
}

function convertVietnamese(t) {
        return t && t.length ? (t = t.toLowerCase(), t = t.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a"), t = t.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e"), t = t.replace(/ì|í|ị|ỉ|ĩ/g, "i"), t = t.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o"), t = t.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u"), t = t.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y"), t = t.replace(/đ/g, "d")) : ""
}

</script>

<div class="row">
  <div class="col-sm-6 m-t-15">
    <div class="fb-error">
      <div class="no-data">
        <div class="no-data-content"><?=$language["facebookErrorUrl"]?><br><?=$language["notiCanGetFbNewfeed"]?><a class="text-uppercase" href="/<?=$seo_name["page"]["user"]?>?manage=info"><?=$language["notiCanGetFbNewfeedEditFacebook"]?></a></div>
      </div>
    </div>
    <div class="item-view-more side-bar m-t-30">
      <div class="view-items newsfeed-fb" data-content>
        <div class="style-loadding hidden"></div>
      </div>
      <div data-footer="">
        
      </div>
    </div>
    <div class="newfeed-more hidden"></div>
    <div class="fb-load-more text-center text-uppercase" onclick="getFacebookNextFeed();">
      <div class="btn bg-color7"> <?=$language["loadMore"]?></div>
    </div>
  </div>
</div>