<!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js ie lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
  <?php
  require dirname(__FILE__) . '/../portal/head_admin.php';
  require dirname(__FILE__) . '/../handlebartemp/template_config.php';
  require dirname(__FILE__) . '/../handlebartemp/jobs.php';
  require dirname(__FILE__) . '/../handlebartemp/cv.php';
  require dirname(__FILE__) . '/../handlebartemp/user.php';
  require dirname(__FILE__) . '/../handlebartemp/admin.php';
  ?>
  <body>
    <div class="admin-page">
    <?php
    require dirname(__FILE__) . '/../portal/menu_admin.php';
    ?>
    <div id="container">
        <div class="container">
            <main id="main">
                <?php main(); ?>
            </main>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <p class="copyright">CMS được phát triển bởi <a href="#"><strong>PHPVNN</strong></a> - <a href="tel:0944112199"> <span class="icon-phone"></span> hỗ trợ khách hàng 0944112199</a></p>
        </div>
    </div>
    <div class="modal quick-view-item fade" data-quick-view-item data-modal-quick-view> <!--Embed view detail here--></div>
    <div class="modal fade" data-quick-view-item1 data-modal-quick-view> <!--Embed apply job here--></div>
    <div class="modal quick-view-sms fade"  data-quick-view-sms> <!--Embed apply job here--></div>
    <div class="alert-footer alert" data-fade="4500">
      <div class="sms-content"></div>
    </div>
    <div class="alert-footer alert-error" data-fade="4500">
      <div class="sms-content"></div>
    </div>
    <script type="text/javascript" src="<?=APIGETUSERINFO.'/'.$sessionUserId;?>?var=window.userAccess"></script>
    <script type="text/javascript" src="/api/get/optionlocal?var=window.optionLocal<?=$pageUserId?>"></script>
    <script type="text/javascript" src="/api/get/lang?var=window.languageText"></script>
    <!-- <script type="text/javascript" src="/media/js/template.backend.js"></script> -->
    <script type="text/javascript" src="/media/js/clientlibs.js"></script>
    <script type="text/javascript" src="/media/js/admin.min.js"></script>
    <script type="text/javascript" src="/media/plugins/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/media/plugins/tinymce/init.js"></script>
    </div>
    <!--[if lt IE 9]><div class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</div><![endif]-->
    <noscript>JavaScript is off. Please enable to view full site.</noscript>
  </body>
</html>
