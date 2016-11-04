var response_facebook;
var facebook_id  = '619269798227483';
var callback_url = 'fb';

(function(d, s, id) {
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) return;
       js = d.createElement(s);
       js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));  

window.fbAsyncInit = function() {
    FB.init({
        appId: facebook_id,
        cookie: true, 
        xfbml: true, 
        version: 'v2.5'
    });

    if (document.URL.indexOf('fbaccesstoken=1') != -1 && document.URL.indexOf('code=') != -1) {
        
        $('.modal.quick-view-item.fade').addClass('in').append('<div class="modal-dialog modal-signup"><div class="modal-content"><div class="modal-body p-30 modal-signin"></div></div></div>');
        $(".modal-signin").css('display','none').after("<div style='position:fixed;z-index:1000;top:40vh;background:#fff;' class='style-loadding b-r-4'></div>");
        
        if(typeof FB != "undefined"){
          
          FB.getLoginStatus(function(response) {
            var accessToken = response.authResponse.accessToken;
            facebookConfirm(accessToken);
          }, true);
        
        }else{
          alert("FB is not responding, Please try again!",function(){return true;});
        }
    };
   
};

function loginFB() {
   
    $(".modal-signin").css('display','none').after("<div style='position:fixed;z-index:1000;top:40vh;background:#fff;' class='style-loadding b-r-4'></div>");
   
    if( navigator.userAgent.match('CriOS') ){
      var url;

      if (document.URL.indexOf('fbaccesstoken=1') == -1 && document.URL.indexOf('code=') == -1) {
        document.cookie = "current_url="+document.location.href+'; path=/'+callback_url;
      }

      url = 'https://www.facebook.com/dialog/oauth?client_id='+facebook_id+'&redirect_uri=http://'+document.domain+'/'+callback_url+'?fbaccesstoken=1&scope=user_about_me,email,user_photos,user_location,user_birthday,user_education_history,user_likes,user_work_history';
      
      var win = window.open(url, '_self');
    
    }else{
      facebookAccesslogin();
    }

}

function facebookAccesslogin(){
  FB.login(function(response) {
    response_facebook = response;
     
      if (response.status === 'connected') {
   
          var accessToken = response.authResponse.accessToken;
          facebookConfirm(accessToken);

      } else if (response.status === 'not_authorized') {
          $('.modal.quick-view-item.fade').removeClass('in');
      } else {
          $('.modal.quick-view-item.fade').removeClass('in');
      }

  }, { scope: 'user_about_me,email,user_photos,user_location,user_birthday,user_education_history,user_likes,user_work_history' });
}

function facebookConfirm(accessToken) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var responseText = JSON.parse(xhttp.responseText);
            var accessToken = responseText.message;
           
            FB.api(
              '/me',
              'GET', { "fields": "id,name,about,bio,gender,languages,location,email,birthday,education,work,picture.width(300)" },
              function(response) {
                 
                  var xhttp = new XMLHttpRequest();
                  var get_url_redirect = getCookie('current_url');

                  document.cookie = "current_url=";

                  xhttp.onreadystatechange = function() {
                      if (xhttp.readyState == 4 && xhttp.status == 200) {
                          
                          var getReturn = JSON.parse(xhttp.responseText);
                         
                          if( getReturn.code == 200){
                          
                            if(document.URL.indexOf('fbaccesstoken=1') != -1 && document.URL.indexOf('code=') != -1){

                              location.href=get_url_redirect;

                            }else{

                              location.href="/";
                            }
                          
                          }else{
                            location.href="/user";
                          }  

                          return xhttp.responseText;
                      }
                  };

                  // get education 
                  var education = response.education;
                  var work_history = response.work;

                  xhttp.open("POST", "/api/post/signinfb", true, "/json-handler");
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send(JSON.stringify({
                     accessToken:  accessToken,
                     email:  response.email  ,
                     uid:  response.id  ,
                     name:  response.name,  
                     gender:  response.gender,  
                     uim:  response.picture.data.url,  
                     birthday:  response.birthday ,
                     education:  response.education, 
                     work:  response.work
                  }));
              }
            )
        }
    };

    xhttp.open("POST", "/api/post/signinfb?accessToken="+accessToken, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function logoutFB() {
    FB.logout(function(response) {});
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function facebookApplyJoblogin(){
  FB.login(function(response) {
    response_facebook = response;
     
      if (response.status === 'connected') {
   
          var accessToken = response.authResponse.accessToken;
          facebookConfirmApply(accessToken);

      }
  }, { scope: 'user_about_me,email,user_photos,user_location,user_birthday,user_education_history,user_likes,user_work_history' });
}

function facebookConfirmApply($accessToken){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          var responseText = JSON.parse(xhttp.responseText);
          var accessToken = responseText.message;
         
          FB.api(
            '/me',
            'GET', { "fields": "id,name,about,bio,gender,languages,location,email,birthday,education,work,picture.width(300)" },
            function(response) {
               
                var xhttp = new XMLHttpRequest();
                var get_url_redirect = getCookie('current_url');

                document.cookie = "current_url=";

                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        
                        var getReturn = JSON.parse(xhttp.responseText);
                        applyjobfacebookloadcontent(response);
                        return xhttp.responseText;
                    }
                };

                var education = response.education;
                var work_history = response.work;

                xhttp.open("POST", "/api/post/applyjobfacebook", true, "/json-handler");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(JSON.stringify({
                   accessToken:  accessToken,
                   email:  response.email  ,
                   uid:  response.id  ,
                   name:  response.name,  
                   gender:  response.gender,  
                   uim:  response.picture.data.url,  
                   birthday:  response.birthday ,
                   education:  response.education, 
                   work:  response.work
                }));
            }
          )
      }
  };

  xhttp.open("POST", "/api/post/applyjobfacebook?accessToken="+$accessToken, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}

function applyjobfacebookloadcontent($response){
  var htmlcopy = '';

  htmlcopy = '<div class="form-group"><div class="row">  <label class="col-sm-3 col-xs-3"><div class="cmp-logo text-center"><div class="pr-div b-cover b-r-4" style="background:url('+$response.picture.data.url+') no-repeat;"> </div></div></label><div class="col-sm-9 col-xs-9"><div class="c-t-cv"><h3 class="text-color1 no-margin u-name">'+$response.name+'</h3><div class="row"><div class="col-sm-12 col-xs-12 short-text"><span class="c-list text-color3 text-bold t-s-14">'+$response.email+'</span></div></div><div class="row"><div class="col-sm-12 col-xs-12 short-text">'+$response.birthday+'</div></div></div></div></div></div><span class="hidden"> <input type="text" name="db.facebook" value="1" /><input type="text" name="db.email" value="'+$response.email+'" /></span>';

  $('.facebook-fill-personal-profile').addClass('fb').html(htmlcopy);

}



function applyjobwithfacebook(){
  if( navigator.userAgent.match('CriOS') ){
    var url;

    if (document.URL.indexOf('fbaccesstoken=1') == -1 && document.URL.indexOf('code=') == -1) {
      document.cookie = "current_url="+document.location.href+'; path=/'+callback_url;
    }

    url = 'https://www.facebook.com/dialog/oauth?client_id='+facebook_id+'&redirect_uri=http://'+document.domain+'/'+callback_url+'?fbaccesstoken=1&scope=user_about_me,email,user_photos,user_location,user_birthday,user_education_history,user_likes,user_work_history';
    
    var win = window.open(url, '_self');
  
  }else{
    facebookApplyJoblogin();
  }
}

