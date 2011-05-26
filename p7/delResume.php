<?php

require_once 'info.php';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());


session_start();
$uid = $_SESSION['user_id'];

$rid = mysql_real_escape_string($_POST['rid']);

$select = "SELECT * FROM `$db_database`.`resume` WHERE `id` = $rid";


$check = mysql_query($select);
$check_data = mysql_fetch_row($check);


if($uid == $check_data[1]){
	$edQ = mysql_query("SELECT * FROM `$db_database`.`education` WHERE `resume_id` = $rid");
	while($ed = mysql_fetch_object($edQ)){
		$id = $ed->id;
		$delQ = "DELETE FROM `$db_database`.`education` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$exQ = mysql_query("SELECT * FROM `$db_database`.`experience` WHERE `resume_id` = $rid");
	while($ex = mysql_fetch_object($exQ)){
		$id = $ex->id;
		$delQ = "DELETE FROM `$db_database`.`experience` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$actQ = mysql_query("SELECT * FROM `$db_database`.`activities` WHERE `resume_id` = $rid");
	while($act = mysql_fetch_object($actQ)){
		$id = $act->id;
		$delQ = "DELETE FROM `$db_database`.`activities` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	
	$skQ = mysql_query("SELECT * FROM `$db_database`.`skills` WHERE `resume_id` = $rid");
	while($sk = mysql_fetch_object($skQ)){
		$id = $sk->id;
		$delQ = "DELETE FROM `$db_database`.`skills` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$intQ = mysql_query("SELECT * FROM `$db_database`.`interests` WHERE `resume_id` = $rid");
	while($int = mysql_fetch_object($intQ)){
		$id = $int->id;
		$delQ = "DELETE FROM `$db_database`.`interests` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$delQ = "DELETE FROM `$db_database`.`resume` WHERE `id` = $rid";
	$del = mysql_query($delQ);
}
else{
	
};

?>