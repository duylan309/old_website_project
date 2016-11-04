<?php
if (isset($_GET['dir']) && $_GET['dir'] ) {
    $path = FOLDERUPLOAD.$_GET['dir'];
} else {
    $path = FOLDERUPLOAD;
}

$list_file = readImageInfoInDir($path);
$dataResponse = $list_file;
?>
