<?php
// $facebook_share_content .= '<meta property="fb:app_id"   content="'.FBAPPID.'" />';
// $facebook_share_content .= '<meta property="og:url"   content="'.$actual_link .'" />';
// $facebook_share_content .= '<meta property="og:type"  content="website" />';
// $facebook_share_content .= '<meta property="og:title" content="'.$web_title.'" />';
// $facebook_share_content .= '<meta property="og:description" content="'.$web_description.'" />';
// $facebook_share_content .= '<meta property="og:image" content="'.$cover_cmp.'" />';
// $facebook_share_content .= '<meta property="og:image:width" content="470" />';
// $facebook_share_content .= '<meta property="og:image:height" content="246" />';

function main(){
    global $language, $sessionUserId, $db, $seo_name, $url_data ,$langcode;
    # CALL VIEW
    if(isset($url_data[1])){
    	$post_id_array = explode('.',$url_data[1]);
    	if(isset($post_id_array[1])){
	    	$post_id = $post_id_array[1];
    	}else{
    		echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
    	}

    }else{
    	echo '<span data-goto-link data-url="/'.$seo_name["page"]["error"].'"></span>';
    }
    

    require_once dirname(__FILE__) . "/../../views/general/social_detail.php";

}
?>

