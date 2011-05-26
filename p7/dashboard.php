<?php

/**********************
Written by Cody Coleman, and Kwadwo Nyarko
for MIT 6.470, IAP '11
***********************/
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
if(isset($_GET['cid'])){
  $cid=$_GET['cid'];
  $query="SELECT title,type,size,letter FROM cover_letter where user_id='$id' AND id='$cid' ";
  //echo "$query";
  $result = mysql_query($query) or die('Error, query failed. Please try again.');
  list($title,$type,$size,$content)=mysql_fetch_array($result);
  header("Content-length:$size");
  header("Content-type: $type");
  header("Content-Disposition:filename=$title");
  echo $content;
  exit;
}

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

  }


}
?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PASS - Job Hunting Made Simple</title>
<link href="images/favicon.ico" rel="shortcut icon"  />
<link href="images/favicon.ico" rel="icon" type="image/x-icon" />

<link rel="stylesheet" href="jquery-ui-1.8.7.custom/css/ui-lightness/jquery-ui-1.8.7.custom.css" />
<link rel="stylesheet" href="styles/baseThin.css" />
<link rel="stylesheet" href="styles/dash.css" />

<script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="scripts/feedback.js"></script>
<script type="text/javascript" src="scripts/growl.js"></script>
<script type="text/javascript" src="scripts/dash.js"></script>


<body>

<div id="topOuter">
     <!-- topInner Start -->
     <div id="topInner">
        
             <!-- Header Start -->
             <div id="header">
                    
             </div>
            
            <!-- Header End -->
            
            
            <!-- Navigation Start -->
            <div id="nav">
            
             <!-- Menu Start -->
                <div id="links">
                    <ul>
                        <li><a href="dashboard.php" class="nav-link navCurrent">Home</a></li>
                     
                      
                    </ul>
                </div>
                <!-- Menu End -->
              
                
                
                <!-- Search form Start -->
                 <form id="searchForm" method="post" action="search.php" >
                     <div id="search">
                            <input type="text" name="search" id="searchBox" class="clear" value="Search"/>
                            <input type="submit" value="" id="searchSubmit" />
                        </div>
                    </form>
                <!-- Search form End -->
                
                <!-- Account info Start -->
                
                	<div id="account">
                    	<div id="accHead">Account</div>
                        <div id="accImage">
                        </div>
                        <div id="moreAcc">
                        	<ul>
                            	<li><a href="logout.php">Logout</a></li>
                                <li><a href="#">Edit Profile</a></li>
                            </ul>
                        </div>
                    </div>
                
                <!-- Account info End -->
                
            
            </div>
            <!-- Navigation End -->
            
            
        </div>
        <!-- topInner End -->
    </div>
    
    
    
    <div id="bottomOuter">
    
     <!-- bottomInner Start -->
     <div id="bottomInner">
        
         <!-- Content Start -->
         <div id="content">
         
         <h2 id="dashGreet">
         	Welcome 
            <?php 
				$query = "SELECT * FROM `auth_user` WHERE `id` = $id";
				
				$user = mysql_query($query);
				$user_data = mysql_fetch_object($user);
				echo $user_data->first_name
				
			?>!
         </h2>
            
		<div id="col1">
                 <h2><?php echo 'Create:' ?></h2>
                    <div class="dashNavBox">
                    	<ul>

						<?php
                        $url = "mypass.php?uid=$id&amp;rid=none";
                           echo '<li><a href='.$url.' class="dash-link">Create a New Resume</a></li>';
                        ?>
                                                <li>
                                                	<a href="#" class="dash-link" id="upCovBut">Upload a Cover Letter</a>
                                                    
                                               </li>
                        <?php
                        $url = "jobPost.php?uid=$id&amp;jid=none";
                           echo '<li><a href='.$url.' class="dash-link">Create a New Job</a></li>';
                        ?>
                            
                        <?php
                        $url = "company.php?uid=$id&amp;cid=none";
                           echo '<li><a href='.$url.' class="dash-link">Create a New Company</a></li>';
                        ?>
                        </ul>
                    </div>
                </div>
                <div id="col2">
                 <h2>View:</h2>
                    <div class="dashNavBox">
                     <ul class="dashNav">
                            <li><a href="#" class="dash-link">View Resumes</a>
                             <ul>
                                <?php
// Show resumes
$resQ = mysql_query('SELECT * FROM resume WHERE user_id='.$id);
$unRes = 1;
if (mysql_num_rows($resQ) == 0) echo "<font color='#FFFFFF'>You haven't made or upload a resume yet.</font>";
else{
	while($res = mysql_fetch_object($resQ)){
		$url = "mypass.php?uid=$id&amp;rid=$res->id";
		if($res->title){
			echo '<li><a href=' .$url.' class="dash-link">' .$res->title . '<div class="delRes" data-i="'.$res->id.'"></div></a></li>';
		}
		else{
			echo '<li><a href=' .$url.' class="dash-link">Untitled Resume '.$unRes.'<div class="delRes" data-i="'.$res->id.'"></div></a></li>';
			$unRes = $unRes + 1;
		}
	}
}
?>
                                </ul>
                            </li>
                            <li><a href="#" class="dash-link">View Cover Letters</a>
                             <ul>
                                <?php
$covQ = mysql_query('SELECT * FROM cover_letter WHERE user_id='.$id);
$unCov = 1;
if (mysql_num_rows($covQ)==0) echo "<font color='#FFFFFF'>You haven't uploaded a cover letter yet.</font>";
else{
	while($cov = mysql_fetch_object($covQ)){
	$url = "dashboard.php?cid=$cov->id";
		if($cov-title){
			echo '<li><a href='.$url.' class="dash-link">'.$cov->title. '<div class="delUp" data-i="'.$cov->id.'"></div></a></li>';
		}
		else{
			echo '<li><a href='.$url.' class="dash-link">Untitled Letter '.$unCov.'<div class="delUp" data-i="'.$cov->id.'"></div></a></li>';
			$unCov = $unCov + 1;
		}
	}
}
?>
                                </ul>
                            </li>
                            <li><a href="#" class="dash-link">View Personal Job Postings</a>
                             <ul>
<?php
$jobQ = mysql_query('SELECT * FROM job_postings WHERE user_id='.$id);
$unJob = 1;
if (mysql_num_rows($jobQ)==0) echo "<font color='#FFFFFF'>You do not have any posted jobs.</font>";
else{
	while($job = mysql_fetch_object($jobQ)){
		$url = "jobPost.php?uid=$id&amp;jid=$job->id";
		if($job->position){
		 	echo '<li><a href="'.$url.'" class="dash-link">'.$job->position. '<div class="delJob" data-i="'.$job->id.'"></div></a></li>';
		}
		else{
			echo '<li><a href="'.$url.'" class="dash-link">Untitled Job '.$unJob.'<div class="delJob" data-i="'.$job->id.'"></div></a></li>';	
			$unJob = $unJob + 1;
		}
	}
}
?>
                                </ul>
                            </li>
                            
                            <li><a href="#" class="dash-link">View Companies</a>
                             <ul>
<?php
$compQ = mysql_query('SELECT * FROM company WHERE user_id='.$id);
$unComp = 1;
if (mysql_num_rows($compQ)==0) echo "<font color='#FFFFFF'>You have made a company.</font>";
else{
	while($comp = mysql_fetch_object($compQ)){
		$url = "company.php?uid=$id&amp;cid=$comp->id";
		if($comp->title){
		 	echo '<li><a href="'.$url.'" class="dash-link">'.$comp->title. '<div class="delComp" data-i="'.$comp->id.'"></div></a></li>';
		}
		else{
			echo '<li><a href="'.$url.'" class="dash-link">Untitled Company '.$unComp.'<div class="delComp" data-i="'.$comp->id.'"></div></a></li>';	
			$unComp = $unComp + 1;
		}
	}
}
?>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>

            </div>
            <!-- Content End -->
            
            
        </div>
        
        </div>
        
        <div id="footer">
            About Us
        </div>
        
        <div id="coverUp" title="Upload a cover letter">

    <form enctype="multipart/form-data" action="dashboard.php" id="upLetter" method="POST" />
      <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
       <input name="upload" type="file" />
     
       <input type="submit" name="submit" id="upLetSub" value="Upload" />
     </form>
        </div>
       
        
   
</body>
</html>