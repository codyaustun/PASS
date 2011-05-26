<?php

require_once 'info.php';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());


session_start();
$uid = $_SESSION['user_id'];

$jid = mysql_real_escape_string($_POST['jid']);

$select = "SELECT * FROM `$db_database`.`job_postings` WHERE `id` = $jid";


$check = mysql_query($select);
$check_data = mysql_fetch_row($check);


if($uid == $check_data[1]){
	$reqQ = mysql_query("SELECT * FROM `$db_database`.`requirements` WHERE `job_id` = $jid");
	while($req = mysql_fetch_object($reqQ)){
		$id = $req->id;
		$delQ = "DELETE FROM `$db_database`.`requirements` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$beneQ = mysql_query("SELECT * FROM `$db_database`.`benefits` WHERE `job_id` = $jid");
	while($bene = mysql_fetch_object($beneQ)){
		$id = $bene->id;
		$delQ = "DELETE FROM `$db_database`.`benefits` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$pluQ = mysql_query("SELECT * FROM `$db_database`.`pluses` WHERE `job_id` = $jid");
	while($plu = mysql_fetch_object($pluQ)){
		$id = $plu->id;
		$delQ = "DELETE FROM `$db_database`.`pluses` WHERE `id` = $id";
		$del = mysql_query($delQ);
	}
	
	$delQ = "DELETE FROM `$db_database`.`job_postings` WHERE `id` = $jid";
	$del = mysql_query($delQ);
}
else{
	
};

?>