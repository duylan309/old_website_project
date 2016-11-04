<script type="text/javascript">
var FBURL = getUrl("<?=isset($rowCompany['facebook']) && count($rowCompany['facebook']) && !is_array($rowCompany['facebook']) ? strtolower($rowCompany['facebook']) : 0 ?>");

function getUrl(url) {
    var result= [];
    result[0] =  url.indexOf("http://");
    result[1] =  url.indexOf("https://");

    if(result[0] != -1 || result[1] != -1 ){
      return url;
    }else{
      return "https://"+url;
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
          if (response && !response.error) {

            getFacebookPhotos(response.id);
          }
        }
    );
}
function getFacebookPhotos(FBCMPID){
   FB.api(
       FBCMPID,
       'GET',
       {"fields":"albums.limit(10){name,photos.limit(20){id,images,height,width,link,created_time}}","access_token":"<?=TOKENFB?>"},


       function(response) {
          console.log(response);

          if(response && !response.error){

            var objAlbums = response.albums.data;
            var photoFb = [];
            Object.keys(objAlbums).forEach(function(keyAl){

              if(objAlbums[keyAl].photos){
                var obj = objAlbums[keyAl].photos.data;

                Object.keys(obj).forEach(function(key){
                   photoFb.push({ "name"   : obj[key].id,
                                  "link"   : obj[key].images[0].source,
                                  "images" : obj[key].images[obj[key].images.length-1].source});

                });
              }
            });

            if(photoFb.length) {
                $('[data-view-list-by-handlebar-fb-photo]').viewListByHandlebar({"initObject":photoFb});
            }

          }else{
            $('.fb-error').addClass("display-block");
            $('.photos-container .style-loadding').css('display','none');
          }
       }
   );
}
</script>
<div class="fb-error">
      <div class="no-data">
          <div class="no-data-content"><?=$language["facebookErrorUrl"]?><br><?=$language["notiCanGetFbPhoto"]?><a class="text-uppercase" href="/<?=$seo_name["page"]["user"]?>?manage=pagecmp&setting=info&pid=<?=$companyInfoPage["db"]["id"]?>"><?=$language["notiCanGetFbNewfeedEditFacebook"]?></a></div>
      </div>
</div>
<div class="photos-container"
    data-view-list-by-handlebar-fb-photo
    data-init-button-magic=".item [data-button-magic]"
    data-method="get"
    data-show-page="5"
    data-ignore-visible="true"
    data-show-item="12"
    data-show-all="false"
    data-scroll-view="true"
    data-scroll-bottom=".photo-more"
    data-form-filter=".form-filter"
    data-is-reload-page="false"
    data-ignore-hash="true"
    data-img-lightbox=".photos-container [data-lightbox]"
    data-template-id="viewItemPhotoFB">

    <div class="view-items" data-content>
        <div class="style-loadding"></div>
    </div>
    <div data-footer=""></div>
</div>

<div class="clearfix"></div>
<div class="photo-more"></div>



