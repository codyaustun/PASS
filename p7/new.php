<?php

require_once 'info.php';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());


session_start();
$uid = $_SESSION['user_id'];

$table = mysql_real_escape_string($_POST['table']);
$rid = mysql_real_escape_string($_POST['rid']);
$seq = mysql_real_escape_string($_POST['seq']);


$query = "INSERT INTO `$db_database`.`$table` ( `id`, `user_id`, `resume_id`, `sequence`,";

foreach($_POST['fields'] as $field){
	$field = " `".mysql_real_escape_string($field)."`,";
	$query = $query.$field;
}

$query = $query." `created_on`, `updated_on`) VALUES ( NULL, '$uid', '$rid', '$seq',";

foreach($_POST['vals'] as $value){
	$value = " '".mysql_real_escape_string($value)."',";
	$query = $query.$value;
}

$query = $query." NULL, NULL)";

$new = mysql_query($query);
$nid = mysql_insert_id();

echo $nid



?> 