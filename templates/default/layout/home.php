<!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js ie lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
  <?php
  require dirname(__FILE__) . '/../portal/head.php';
  require dirname(__FILE__) . '/../handlebartemp/template_config.php';
  require dirname(__FILE__) . '/../handlebartemp/handlebarview_site.php';
  require dirname(__FILE__) . '/../handlebartemp/user.php';
  require dirname(__FILE__) . '/../handlebartemp/jobs.php';
  require dirname(__FILE__) . '/../handlebartemp/cv.php';
  require dirname(__FILE__) . '/../handlebartemp/blog.php';
  require dirname(__FILE__) . '/../handlebartemp/lan.php';
  $strClassPage = isset($pageInfo["db"]["pa"])? "pageid-{$pageInfo["db"]["pa"]} ":"";
  $strClassPage .= isset($pageInfo["db"]["id"])? "pageid-{$pageInfo["db"]["id"]}":"";

  $strIndexPage = isset($pageInfo["db"]["pa"])? ".menu-item-{$pageInfo["db"]["pa"]},.side-menu-{$pageInfo["db"]["pa"]}":"";
  $strIndexPage .= isset($pageInfo["db"]["id"])? ",.menu-item-{$pageInfo["db"]["id"]},.side-menu-{$pageInfo["db"]["id"]}":"";
  unset($templatesView);
  ?>

  <body>
    <div id="fb-root"></div>
    <div class="website <?=isset($strClassPage)? $strClassPage: "" ; ?>" data-add-class-active-to-obj="<?=isset($strIndexPage)?$strIndexPage:"";?>">
      <?php
      require dirname(__FILE__) . '/../portal/header.php';
      require dirname(__FILE__) . '/../portal/banner.php';
      require dirname(__FILE__) . '/../portal/main.php';
      require dirname(__FILE__) . '/../portal/footer.php';
      ?>
    </div>
  </body>
  <!--Start of Zopim Live Chat Script-->
  <script type="text/javascript">
  // window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
  // d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
  // _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
  // $.src="//v2.zopim.com/?4H9ciZjMfxVNgXiuZPx8FEl58G7T71W7";z.t=+new Date;$.
  // type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
   </script>
   <script>
  //   $zopim(function() {
  //     $zopim.livechat.theme.setFontConfig({
  //       google: {
  //         families: ['Source Sans Pro,sans-serif']
  //       }
  //     }, 'Source Sans Pro, sans-serif');
  //     $zopim.livechat.setLanguage('<?=$langcode?>');
  //   });
  </script>
  <!--End of Zopim Live Chat Script-->
  
  <?php require dirname(__FILE__) . '/../handlebartemp/more.php';?>
</html>
