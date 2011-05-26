<?php

require_once 'info.php';
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die ("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());
// start session...check to see if logged on
session_start();
if(!isset($_SESSION['user_id'])){
header("Location: home.php");
}else{
    // select all specific resume and necessary components
    $query = 'SELECT * FROM resume WHERE user_id='.$id.' and id='.$rid;
    $resume = mysql_query($query);
    $resume_data=mysql_fetch_object($resume);
    $title = $resume->title;
    $street = $resume->street;
    $city = $resume->city;
    $state = $resume->state;    $zip = $resume->zip;
    $country = $resume->country;
    $phone = $resume->phone;
    $email = $resume->email;

    //query to put info in submissions table

    $query = "INSERT INTO `kwadwo+IAP`.`submission` (`id`, `user_id`, `resume_id`, `title`, `street`, `city`, `state`, `zip`, `country`, `phone`, `email`, `status`, `timestamp`
) VALUES (NULL,$id, $rid, $title, $street, $city, $state, $zip, $country, $phone, $email, NULL, NULL)";    mysql_query($query);

    // select all education thats relevant and put in sub_education
    $query = 'SELECT * FROM education WHERE user_id='.$id.' and resume_id='.$rid;
    $education = mysql_query($query);
    $ed_data=mysql_fetch_($education);

    $query= "INSERT INTO `kwadwo+IAP`.`sub_education` (`id`, `user_id`, `resume_id`, `title`, `position`, `description`, `start`, `end`, `timestamp`) VALUES (NULL,$ed_data[1] ,
 $ed_data[2], $ed_data[3], $ed_data[4], $ed_data[5],$ed_data[6],$ed_data[7], NULL)";
    mysql_query($query);

    //select all experience thats relevant and put in sub_experience
    $query = 'SELECT * FROM experience WHERE user_id='.$id.' and resume_id='.$rid;
    $experience = mysql_query($query);
    $exp_data=mysql_fetch_object($experience);

    $query= "INSERT INTO `kwadwo+IAP`.`sub_experience` (`id`, `user_id`, `resume_id`, `title`, `position`, `description`, `start`, `end`, `timestamp`) VALUES (NULL, $exp_data[1],$exp_data[2],$exp_data[3],$exp_data[4],$exp_data[5],$exp_data[6], $exp_data[7], NULL)";
    mysql_query($query);

    //select all activities thats relevant and put in sub_activities
    $query = 'SELECT * FROM activities WHERE user_id='.$id.' and resume_id='.$rid;
    $activities= mysql_query($query);
    $act_data=mysql_fetch_object($activities);


