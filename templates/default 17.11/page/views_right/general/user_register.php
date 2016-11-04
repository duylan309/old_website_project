<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=<?=$_SESSION["lang"]?>" async defer></script>

<div class="u-signup"
    data-copy-template
    data-elm-data='<?=$strElmData?>'
    data-view-template=".u-signup"
    data-template-id="entrySignup">
</div>

<script type="text/javascript">
  var verifyCallback = function(response) {
    $('.boxcaptcha').attr('checked','checked');
  };
 
  var onloadCallback = function() {
    grecaptcha.render('captcha', {
      'sitekey' : '<?=SITEKEYCAPTCHA?>',
      'callback' : verifyCallback,
    });
  };
</script>