<?php
require_once 'info.php';
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die ("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());
// start session...check to see if logged on
session_start();
if(!isset($_SESSION['user_id'])){
	header("Location: home.php");
}
else{
  $id=$_SESSION['user_id'];
  if(isset($_POST['submit']) && $_FILES['upload']['size']>0){
		$fname=$_FILES['upload']['name'];
		$tempName=$_FILES['upload']['tmp_name'];
		$fsize=$_FILES['upload']['size'];
		$ftype=$_FILES['upload']['type'];
		$fop=fopen($tempName,'r');
		$fcontent=addslashes(fread($fop,filesize($tempName)));
		fclose($fop);
		if(!get_magic_quotes_gpc()){
		 	$fname=addslashes($fname);
  		}
  
	$query="INSERT INTO `kwadwo+IAP`.`cover_letter` (`id`,`user_id`,`title`,`letter`,`upload_date`,`size`,`type`) VALUES(NULL,'$id','$fname','$fcontent',NULL,'$fsize','$ftype')";
	mysql_query($query) or die('Error,query failed. Please try again');
	echo "File $fname uploaded successfully!"; 
  	}
	
	echo "Failure!".$_FILES['upload']['size'];
}