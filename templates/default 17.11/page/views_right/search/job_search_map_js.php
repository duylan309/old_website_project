<script src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLEAPIKEY?>&callback=initMap&libraries=places" async defer></script>
<script type="text/javascript">
$(document).ready(function(){function E(a,b,c,d){$.ajax({type:"GET",url:a,data:b,beforeSend:function(){},success:function(a,b,c){var d=a.data;d&&0!=d.length&&I(d,b,c)}})}function F(a,b,c){u=new google.maps.Map(document.getElementById("jobMap"),{center:new google.maps.LatLng(a,b),zoom:15,mapTypeId:google.maps.MapTypeId.ROADMAP,styles:[{featureType:"transit.station.bus",stylers:[{visibility:"off"}]},{featureType:"transit.station",stylers:[{visibility:"off"}]},{featureType:"poi.park",stylers:[{visibility:"off"}]},{featureType:"poi.medical",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",stylers:[{visibility:"off"}]},{featureType:"poi.school",stylers:[{visibility:"off"}]},{featureType:"transit.line",stylers:[{visibility:"off"}]},{stylers:[{hue:"#000"},{saturation:-80}]}]}),v=new google.maps.InfoWindow,R(),G(u,c)}function G(a,b){google.maps.event.addListener(a,"idle",function(){var c=a.getBounds(),d=c.getSouthWest(),e=c.getNorthEast();0==C?(I(b),C=1):H(d.lng(),d.lat(),e.lng(),e.lat())})}function H(a,b,d,e){t={title:h,loc:j,cat:k,sa:l,nat:m,ty:n,le:o,ex:p,di:r,la:q,fromlng:a,fromlat:b,tolng:d,tolat:e,noId:w},""==h&&delete t.title,""==j&&delete t.loc,""==k&&delete t.cat,""==l&&delete t.sa,""==m&&delete t.nat,""==n&&delete t.ty,""==o&&delete t.le,""==p&&delete t.ex,""==r&&delete t.di,""==q&&delete t.la,E(c,t,s,"")}function I(a){var c,d,e,f,g,b=a;if(b&&b.length>0){for(i=0;i<b.length;i++)w.push(b[i].ci),0!=b[i].lat&&b[i].lng&&(d=new google.maps.LatLng(b[i].lat,b[i].lng),e=1==b[i].sa?'<?=$language["negotiable"]?>':1==b[i].sa?Q(b[i].s1)+"-"+Q(b[i].s2)+" "+P(1,"currency","id","ti"):Q(b[i].s1)+"-"+Q(b[i].s2)+" "+P(2,"currency","id","ti"),imgUrl=""==b[i].im?"/img/style/user.png":'<?=FOLDERIMAGECOMPANY."thumbnail/"?>'+b[i].im,f='<div class="boxinfo"><div class="item item-map"><div class="img i-center"> <figure> <a href="/<?=$seo_name["page"]["job"]?>/'+N(b[i].ti,b[i].id)+'">  <img alt="'+b[i].na+'" class="image-load b-r-4" src="'+imgUrl+'" > </a> </figure></div><div class="c-t-s-j transition"> <div class="j-search"> <div class="j-title transition"> <a class="text-color1 no-margin transition" href="/<?=$seo_name["page"]["job"]?>/'+N(b[i].ti,b[i].id)+'"> <div class="j-level text-color2 no-margin short-text c-list"> '+P(b[i].ty,"jobTime","","")+'</div><div class="j-name transition short-text">'+b[i].ti+' </div></a> </div><a href="/<?=$seo_name["page"]["job"]?>/'+N(b[i].ti,b[i].id)+'"> <p class="text-salary short-text"> <strong class="text-color3"> '+e+'</strong> </p><p class="text-postby short-text"> <span class="text-color4"> <?=$language["postby"]?> </span> <span class="text-color2 j-level text-bold"> '+b[i].na+' </span> </p><p class="short-text c-list t-s-11 text-color4"> '+P(b[i].lo,"location","","")+" </p></a></div></div></div></div>",g=new google.maps.MarkerImage(imgUrl,new google.maps.Size(40,40),new google.maps.Point(0,0),new google.maps.Point(0,40),new google.maps.Size(40,40)),c=new google.maps.Marker({map:u,position:d,icon:g,animation:google.maps.Animation.DROP,optimized:!1}),J(c,u,v,f.trim()));y=new google.maps.OverlayView,y.draw=function(){this.getPanes().markerLayer.id="markerLayer"},y.setMap(u)}}function J(a,b,c,d){google.maps.event.addListener(a,"click",function(){c.setContent(d),c.open(b,a),google.maps.event.addListener(b,"click",function(){c.close()})})}function L(a){var b=a.coords.latitude,c=a.coords.longitude;F(b,c),marker=new google.maps.Marker({map:u,position:new google.maps.LatLng(b,c),animation:google.maps.Animation.DROP})}function N(a,b){a=O(a);var c=a.replace(/[^A-Z0-9]/gi,"-")+"."+b;return c}function O(a){return a&&a.length?(a=a.toLowerCase(),a=a.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"),a=a.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"),a=a.replace(/ì|í|ị|ỉ|ĩ/g,"i"),a=a.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"),a=a.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"),a=a.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"),a=a.replace(/đ/g,"d")):""}function P(a,b,c,d){if("undefined"!=typeof a&&dropdownLocal){a=a.toString();var e=dropdownLocal[b];if(e=e||defineVariable.l10n[b]){var f,g=a&&a.length?a.split(","):[],h="";if(c.length){if(!d.length)return;$.each(e,function(a,b){return b[c]==g[0]?(h+="<span>"+b[d]+"</span>",!1):void 0})}else for(var i=0,j=g.length;j>i;i++)f=g[i].trim(),$.each(e,function(a,b){h+=f==b.id?"<span>"+b.ti+"</span>":""});return h}}}function Q(a,b,c){"use strict";if("undefined"!=typeof a){var d=a.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1.");return b&&c&&(1==b?d=c+d:d+=c),d}}function R(){D=new google.maps.places.Autocomplete(document.getElementById("autocomplete"),{types:["geocode"]}),D.addListener("place_changed",S)}function S(){var a=D.getPlace();return F(a.geometry.location.lat(),a.geometry.location.lng()),!1}var t,u,v,y,D,a="<?=$floatLat?>",b="<?=$floatLng?>",c="<?=APIGETJOBMAP?>",h='<?=isset($_GET["title"]) ? $_GET["title"] : ""?>',j='<?=isset($_GET["loc"]) ? $_GET["loc"]  : ""?>',k='<?=isset($_GET["cat"]) ? $_GET["cat"]  : ""?>',l='<?=isset($_GET["sa"])  ? $_GET["sa"]   : ""?>',m='<?=isset($_GET["nat"]) ? $_GET["nat"]  : ""?>',n='<?=isset($_GET["ty"])  ? implode(",",$_GET["ty"] ) : ""?>',o='<?=isset($_GET["le"])  ? implode(",",$_GET["le"] ) : ""?>',p='<?=isset($_GET["ex"])  ? implode(",",$_GET["ex"] ) : ""?>',q='<?=isset($_GET["la"])  ? implode(",",$_GET["la"] ) : ""?>',r='<?=isset($_GET["di"]) ? $_GET["di"]  : ""?>',s=$("#tbody"),w=[],A=a,B=b,C=0;window.onload=function(){var a=viewSearchJobs;if(0!=a.length){for(i=0;i<a.length;i++)if(0!=a[i].lat&&0!=a[i].lng){F(10.7756587,106.70042379999995,a);break}}else F(A,B)},$("#nearby").click(function(a){navigator.geolocation?navigator.geolocation.getCurrentPosition(L):x.innerHTML="Geolocation is not supported by this browser."}),$("#autocomplete").keypress(function(a){if(13==a.which)return!1})});
</script>