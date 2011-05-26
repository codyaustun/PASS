<?php

/**********************
Written by Cody Coleman
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
	<div id="growl">
    </div>
	<div id="feedback">
    	<h3>Feedback</h3>
    </div>
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
                        <li><a href="#" class="nav-link">Home</a></li>
                        <li><a href="#" class="nav-link">Pass Me(10)</a></li>
                        <li><a href="#" class="nav-link">Job Tracking(3)</a></li>
                        
                      
                    </ul>
                </div>
                <!-- Menu End -->
              
                
                
                <!-- Search form Start -->
                 <form id="searchForm">
                     <div id="search">
                            <input type="text" name="search" id="searchBox" class="clear" value="Search"/>
                            <input type="submit" value="" id="searchSubmit" />
                        </div>
                    </form>
                <!-- Search form End -->
                
            
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
            
			<div id="col1">
                 <h2><?php echo 'Create:' ?></h2>
                    <div class="dashNavBox">
                     <ul class="dashNav">
                            <li><a href="#" class="dash-link">Create a New Resume</a></li>
                            <li><a href="#" class="dash-link">Upload a Cover Letter</a></li>
                            <li><a href="#" class="dash-link">Create a New Job Posting</a></li>
                            
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
if (mysql_num_rows($resQ) == 0) echo "You haven't made or upload a resume yet.";
else{
while($res = mysql_fetch_object($resQ)){
$url = "mypass.php?uid=$id&amp;rid=$res->id";
echo '<li><a href=' .$url.' class="dash-link">' .$res->title . '</a></li>';
}
}
?>
                                </ul>
                            </li>
                            <li><a href="#" class="dash-link">View Cover Letters</a>
                             <ul>
                                <?php
$covQ = mysql_query('SELECT * FROM cover_letter WHERE user_id='.$id);
if (mysql_num_rows($covQ)==0) echo "You haven't uploaded a cover letter yet.";
else{
while($cov = mysql_fetch_object($covQ)){
echo '<li><a href="#" class="dash-link">'.$cov->title. '</a></li>';
}
}
?>
                                </ul>
                            </li>
                            <li><a href="#" class="dash-link">View Personal Job Postings</a>
                             <ul>
<?php
$jobQ = mysql_query('SELECT * FROM job_postings WHERE user_id='.$id);
if (mysql_num_rows($jobQ)==0) echo "You do not have any posted jobs.";
else{
while($job = mysql_fetch_object($resQ)){
                                 echo '<li><a href="#" class="dash-link">'.$job->title. '</a></li>';
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
             Footer!
        </div>
        
   
</body>
</html>