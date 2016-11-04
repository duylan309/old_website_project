<script type="text/javascript">
    $(document).ready(function() {

        $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
         
          FB.init({
            appId: '<?=FBAPPID?>',
            version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
          });
     
        });

        var facebookResult = [];

        $(".auto-fill-facebook").autocomplete({

            source: function( request, response ) {
                        FB.api(
                            "/search",
                            {
                                "type": "page",
                                "q": request.term,
                                "limit":5,
                                "fields": "id,name,page,picture,link",
                                "access_token":"<?=TOKENFB?>"},
                            
                            function (responseFB) {
                                if (responseFB && !responseFB.error) {
                                facebookResult = [];
                                var data = responseFB.data;
                                Object.keys(data).forEach(function(key){
                                     facebookResult.push({"name":data[key].name,"image":data[key].picture.data.url,"id":data[key].id,"label":data[key].link});
                                });
                                response(facebookResult);
                                }
                            }
                        );
                    },
            select: function( event, ui ) {
              $("[data-facebook-url]").val( ui.item.label ).attr('data-facebook-id',ui.item.id);
              $('.company-create [name="fb.facebook_id"]').attr('value',ui.item.id);
            },        
            minLength: 0,
            autoFocus: true,
            
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( '<img width="20" height" src="'+item.image+'"> ' + item.name + '')
            .appendTo( ul );
        };


        $("#FbAutocomplete").click(function(event) {
            var $getId = $('[data-facebook-id]').attr('data-facebook-id');
            var $getFacebookUrl = getUrlHttp($('[data-facebook-url]').val());

            if($getFacebookUrl != undefined &&  $getFacebookUrl != ''){
                if($getId != undefined ){
                    facebookAutoComplete($getId,'<?=TOKENFB?>');
                }else{
                    facebookGetId($getFacebookUrl,'<?=TOKENFB?>')
                }
            }else{
                $("[data-facebook-url]").parents('.form-group').addClass('invalid');
                $("[data-facebook-url]").next('.error').html('<?=$language["require"]?>');
            }

        });

        function getUrlHttp(urlget) {
            var result= [];

            result[0] =  urlget.indexOf("http://");
            result[1] =  urlget.indexOf("https://");

            if(result[0] != -1 || result[1] != -1 ){
              return urlget;
            }else{
              return "https://"+urlget;
            }
        }

        function facebookGetId($facebook_url,$access_token){
            FB.api(
                "/",
                {"id": $facebook_url ,"access_token":$access_token},

                function (response) {
              
                  if (response && !response.error) {
                    facebookAutoComplete(response.id,$access_token);
                  }else{
                    $("[data-facebook-url]").parents('.form-group').addClass('invalid');
                    $("[data-facebook-url]").next('.error').html('<?=$language["notFoundFacebook"]?>');
                  }
                }
            );
        }

        function facebookAutoComplete($facebookId,$access_token){
            FB.api(
                '/'+$facebookId,
                'GET',
                {"fields":"about,picture.type(large),name,website,link,username,category,phone,cover,description,location,single_line_address,description_html","access_token":$access_token },
                function(response) {

                    if (response && !response.error) {
                        $("[data-facebook-url]").parents('.form-group').removeClass('invalid');

                        var description,id,location,phone,picture,about,category,cover,address,city,country,username,name,link,website,lat,lng;

                        address = response.location != undefined && response.location.street != undefined && response.location.zip != undefined ? ($.isNumeric(response.location.zip) == true ? response.location.street : response.location.street + ', ' + response.location.zip)  : '';
                        lat     = response.location != undefined && response.location.latitude != undefined ? response.location.latitude : '';
                        lng     = response.location != undefined && response.location.longitude != undefined ? response.location.longitude : '';
                        city    = response.location != undefined && response.location.city != undefined ? response.location.city : '';
                        country = response.location != undefined && response.location.country != undefined ? response.location.country : '';

                        profile_picture = response.picture.data.url != undefined ? response.picture.data.url : '';
                        cover_photo     = response.cover != undefined ? response.cover.source : '';
                        username        = response.username != undefined ? response.username : '';
                        name            = response.name != undefined ? response.name : '';
                        phone           = response.phone != undefined ? response.phone : '';
                        website         = response.website != undefined ? response.website : '';
                        link            = response.link != undefined ? response.link : '';

                        about           = response.about != undefined ? response.about : '';
                        description     = response.description != undefined ? response.description : '';
                        category        = response.category != undefined ? response.category : '';

                        description     = description != ''? description : about;

                        phone           = phone == '<<not-applicable>>' ? '' : phone; 

                        $('.company-create [name="db.name"]').val(name); 
                        $('.company-create [name="db.url"]').val(username); 
                        $('.company-create [name="db.phone"]').val(phone); 
                        $('.company-create [name="db.address"]').val(address); 
                        $('.company-create [name="db.website"]').val(website); 
                        $('.company-create [name="db.facebook"]').val(link); 
                        $('.company-create [name="more.about"]').val(description); 
                        $('#lat').val(lat); 
                        $('#lng').val(lng); 

                        if(link != ''){
                           $('.company-create [name="db.fb_load_newfeed"],.company-create [name="db.fb_load_photo"]').prop('checked', true); 
                        }

                        if(profile_picture != ''){
                            $('.facebook-autocomplete').removeClass('hidden').find(' .update-item-image-setting img').attr({
                                'src': profile_picture,
                                'style': 'display:block !important'
                            });
                            $('.facebook-autocomplete [name="fb.im"]').attr('value',profile_picture);
                        }

                        if(cover_photo != ''){
                            $('.facebook-autocomplete').removeClass('hidden').find(' .update-banner-image-setting img').attr({
                                'src': cover_photo,
                            });
                            $('.facebook-autocomplete [name="fb.im_banner"]').attr('value',cover_photo);
                        }

                        $('#facebookfill').attr('value',1);
                        $('.company-create-info').addClass('active');
                        $('.no-facebook-fanpage').addClass('hidden');
                        
                    }else{
                       $("[data-facebook-url]").parents('.form-group').addClass('invalid');
                       $("[data-facebook-url]").next('.error').html('<?=$language["notFoundFacebook"]?>');
                       $('#facebookfill').attr('value',0);
                    }

              }
            );
        }

        $('.company-create-info button[type="reset"]').click(function(event) {
            $('.facebook-autocomplete').addClass('hidden');
        });


        $('[data-update-facebook-photo]').click(function() {
            var $getFacebookUrl = getUrlHttp($(this).attr('data-facebook-url'));
            var $userId         = $(this).attr('data-ui-id');
            var $companyId      = $(this).attr('data-co-id');

            if($getFacebookUrl != undefined &&  $getFacebookUrl != ''){
                $("[data-facebook-url]").after("<div style='position:fixed;z-index:999;width:100%;height:100%;background:rgba(0,0,0,0.8);left:0;top:0'><div style='position:fixed;z-index:1000;top:40vh;background:#fff;' class='style-loadding b-r-4'></div></div>");
                facebookGetIdAndUploadPhoto($getFacebookUrl,'<?=TOKENFB?>',$userId,$companyId)
            }else{
                $('.error-facebook').addClass('in') && setTimeout(function () {
                            $('.error-facebook').removeClass("in")
                        }, 10000);
            }

        }); 


        function facebookGetIdAndUploadPhoto($facebook_url,$access_token,$userId,$companyId){
            FB.api(
                "/",
                {"id": $facebook_url ,"access_token":$access_token},

                function (response) {
                  if (response && !response.error) {
                  
                    facebookUploadPhoto(response.id,$access_token,$userId,$companyId);
                  
                  }else{
                    $('.error-facebook').addClass('in') && setTimeout(function () {
                            $('.error-facebook').removeClass("in")
                        }, 10000);
                  }
                
                }
            );
        }

        function facebookUploadPhoto($facebookId,$facebookAccessToken,$userId,$companyId){
             var xhttp = new XMLHttpRequest();
            FB.api(
                '/'+$facebookId,
                'GET',
                {"fields":"about,picture.type(large),name,website,link,username,category,phone,cover,description,location,single_line_address,description_html","access_token":$facebookAccessToken },
                function(response) {
                 
                    if (response && !response.error) {
                        
                        xhttp.onreadystatechange = function() {
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                location.reload();
                            }
                        };

                        var $profile_picture = response.picture.data.url != undefined ? response.picture.data.url : '';
                        var $cover_photo     = response.cover != undefined ? response.cover.source : '';
                        var $name            = response.name != undefined ? response.name : '';
                        xhttp.open("POST", "/api/post/fbuploadphoto", true, "/json-handler");
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(JSON.stringify({
                           uid:  $userId,
                           companyId:  $companyId,  
                           profile_picture: $profile_picture,
                           cover_photo: $cover_photo,
                           fbId: $facebookId,
                           fbName: $name
                        }));


                    }else{
                        $('.error-facebook').addClass('in') && setTimeout(function () {
                            $('.error-facebook').removeClass("in")
                        }, 10000);
                    }
                }
            )        
        }

    });
</script>



