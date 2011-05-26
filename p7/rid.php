<?php


require_once 'info.php';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());


session_start();
$uid = $_SESSION['user_id'];


$table = mysql_real_escape_string($_POST['table']);
$id = mysql_real_escape_string($_POST['id']);

/* check user */
$select = "SELECT * FROM `$db_database`.`$table` WHERE `id` = $id";
$check = mysql_query($select);
$check_data = mysql_fetch_row($check);

echo $check_data[2];

?>