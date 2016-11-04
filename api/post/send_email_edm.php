<?php
$nodeUpdate = isset($post["updateNode"])? $post["updateNode"]:null;
$uid = isset($post["db"]["uid"]) ? $post["db"]["uid"] : null;

# check is admin and user is admin
if (isset($_SESSION["adminlog"]) && $_SESSION["adminlog"]) {
    if($nodeUpdate && $nodeUpdate == "db") {

        if(!isset($post[$nodeUpdate])) {
            die();
        }

        $infoUpdate = isset($post[$nodeUpdate]) ? $post[$nodeUpdate] : null;

        if(isset($infoUpdate["id"]) && $infoUpdate["id"] ) {
            # update blog
            $iId = $infoUpdate["id"];

            if ($db->db_update($infoUpdate, 'email_edm', array("id" => $iId, "ui" => $uid))) {
                $code = 200;
                $message = $language["updateSuccess"];
            }
        } else {

            $infoUpdate["cr"] = $currentTime;
            if ($db->db_insert($infoUpdate, 'email_edm')) {
                
                $str_query = "SELECT * FROM email_edm WHERE cr={$currentTime} ORDER BY id DESC LIMIT 0,1";
                $row = $db->db_array($str_query);
                $link_tracking = '';
                if ($row) {

                    $link_tracking = "&amp;trackingedm=".$row['id'];

                    #doto 2 email template for type = 1 type =2
                    require $cgf_site["temp"] . "newsletter/email_edm.php";

                    $sendMailObj = isset($sendMailObj) ? $sendMailObj : array(
                        "from" => "team@thue.today",
                        "to" => $row['email'],
                        "sender" => "Thue Today",
                        "receiver" => $row['name'],
                        "reply" => "team@thue.today",
                        "replyInfo" => "Thue Today",
                        "subject" => "Tuyển dụng nhân sự miễn phí!",
                        "content" => $strBody,
                    );

                    // require dirname(__FILE__) . "/sendmail.php";

                    $code = 200;
                    $message = $language["insertSuccess"];
                }
                else {
                    $code = 401;
                    $errors = $language["insertErrors"];
                }

            } else {
                
                $code = 402;
                $errors = $language["insertErrors"];
            
            }
        }
    } elseif($nodeUpdate == "del") {
        # delete item
        $iId = isset($post["db"]["id"]) ? $post["db"]["id"]:null;
        if($iId) {
            if($db->db_delete('email_edm', array("id"=>$iId)) ){
                $message = $language["apiResponseSuccess"];
            }
        }
    }
}
else {
    # missing session
    $errors = "missing session";
    $code = 401;
}

?>
