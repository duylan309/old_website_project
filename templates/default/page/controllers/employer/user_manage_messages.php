<?php
$direction = 'messages';
$action = isset($_GET['action']) ? $_GET['action'] : 'inbox';
$uid    = isset($_GET['uid']) ? intval($_GET["uid"]) : null;
// Have candidate ID || Don't have

if(isset($action)):
    switch ($action) {
        
        case 'view':
            require dirname(__FILE__) . "/messages/view_detail.php";
            $direction = 'view';
            break;

        case 'compose':
            require dirname(__FILE__) . "/messages/compose.php";
            $direction = 'compose';
            break;

        case 'sent':
            $script = APIGETMESSAGE.'?uid='.$sessionUserId.'&action=sent&var=window.loadMessages';
            $direction = 'sent';
            break; 

        case 'draf':
            $direction = 'draf';
            break;    

        case 'important':
            $script = APIGETMESSAGE.'?uid='.$sessionUserId.'&action=important&var=window.loadMessages';
            $direction = 'important';
            break; 

        case 'trash':
            $script = APIGETMESSAGE.'?uid='.$sessionUserId.'&action=trash&var=window.loadMessages';
            $direction = 'trash';
            break; 

        case 'inbox':
            $script = APIGETMESSAGE.'?uid='.$sessionUserId.'&action=inbox&var=window.loadMessages';
            $direction = 'inbox';
            break;        

        default:
            ?>
            <script type="text/javascript">
            location.href="<?=SITEURL?>error404.html";
            </script>;
            <?php
            break;
    }

    require dirname(__FILE__) . "/../../views/employer/messages/company_view_message_container.php";

else:
    die();
endif;  

?>

