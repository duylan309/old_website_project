<?php 

if ($strFirstPage == $seo_name["page"]["home"]) {

    $header = "home";
    require dirname(__FILE__) . CONTROLLERS."general/user_page_home.php";

} elseif ($strFirstPage == $seo_name["page"]["search"]) {

    if(isset($_GET["map"]) && count($_GET["map"])){
        require dirname(__FILE__) . CONTROLLERS."search/job_search_map.php";
    }else if(isset($_GET["brand"]) && count($_GET["brand"])){
        require dirname(__FILE__) . CONTROLLERS."search/job_search_brand.php";
    } else{
        require dirname(__FILE__) . CONTROLLERS."search/job_search.php";
    }

} elseif ($strFirstPage == $seo_name["page"]["searchcv"]) {
    
    require dirname(__FILE__) . CONTROLLERS."general/user_page_not_found.php";

} elseif ($strFirstPage == $seo_name["page"]["user"]) {
    
    require dirname(__FILE__) . CONTROLLERS."user_direction.php";

} elseif ($strFirstPage == $seo_name["page"]["social"]) {
    if(isset($url_data[1])){
        require dirname(__FILE__) . CONTROLLERS."general/social_detail.php";
    }else{
        require dirname(__FILE__) . CONTROLLERS."general/social.php";
    }

} elseif ($strFirstPage == $seo_name["page"]["admin"]) {
    $strLayout = "admin";
    
    require dirname(__FILE__) . "/admin/admin.php";

} elseif ($strFirstPage == $seo_name["page"]["category"]) {
    
    require dirname(__FILE__) . CONTROLLERS."/category/page_category.php";

} elseif ($strFirstPage == $seo_name["page"]["blog"]) {
    
    require dirname(__FILE__) . CONTROLLERS."blog/page_blog.php";

} elseif ($strFirstPage == $seo_name["page"]["news"]) {
   
    require dirname(__FILE__) . CONTROLLERS."news/page_news.php";

} elseif ($strFirstPage == $seo_name["page"]["job"]) {
    
    require dirname(__FILE__) . CONTROLLERS."jobs/job_control.php";

} elseif ($strFirstPage == $seo_name["page"]["cv"]) {
    
    require dirname(__FILE__) . CONTROLLERS."candidate/user_profile.php";

} elseif ($strFirstPage == $seo_name["page"]["signup"]) {
    
    require dirname(__FILE__) . CONTROLLERS."employer_candidate/user_register.php";

} elseif ($strFirstPage == $seo_name["page"]["facebook"]) {
    
    require dirname(__FILE__) . CONTROLLERS."general/user_facebook_login.php";

} elseif ($strFirstPage == $seo_name["page"]["promotion_signup_get"]) {
     
    require dirname(__FILE__) . CONTROLLERS."employer/token_promotion_code.php";
    
} elseif ($strFirstPage == $seo_name["page"]["payment"]) {
    
    require dirname(__FILE__) . CONTROLLERS."employer/user_page_payment.php";

} elseif ($strFirstPage == $seo_name["page"]["password"]) {
  
    require dirname(__FILE__) . CONTROLLERS."employer_candidate/user_password_recover.php";

} elseif ($strFirstPage == $seo_name["page"]["checkout"]) {
  
    require dirname(__FILE__) . CONTROLLERS."employer/user_page_checkout_action.php";

} else {
    $strLayoutUser = "default";
   
    #page member
    $strQueryURL = "SELECT * FROM ".TABLE_URL." AS c WHERE c.url='{$url_data[0]}'";
    $rowURL = $db->db_array($strQueryURL);

    if($rowURL) {
        if($rowURL["cid"]) {
            $pid = intval($rowURL["cid"]);
            $file   = FOLDERCOMPANY.$pid.".xml";
            if(is_file($file)) {
                $fileInfo = simplexml_load_file($file);
                $companyInfoPage = json_encode($fileInfo);
                $companyInfoPage = json_decode($companyInfoPage, true);
            }
            require dirname(__FILE__) . CONTROLLERS."employer/user_cmp_page.php";
            require_once dirname(__FILE__) . "/layout/{$strLayout}.php";
        } elseif($rowURL["hid"]) {
            require dirname(__FILE__) . CONTROLLERS."/search/job_search_page_html.php";
            require_once dirname(__FILE__) . "/layout/{$strLayout}.php";
        }
    } else {
        require dirname(__FILE__) . "/page/controllers/general/user_page_not_found.php";
        require_once dirname(__FILE__) . "/layout/{$strLayout}.php";
    }
}