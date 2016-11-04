<?php
if (!$mycon = @mysql_connect("localhost", "root", "")) {
	die('Database Error: ' . mysql_error());
} elseif (!@mysql_select_db("thuetoday_code_ver_3", $mycon)) {
	die('Database Error: ' . mysql_error());
}

?>
