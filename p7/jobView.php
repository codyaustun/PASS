<?php
require_once 'info.php';
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());

// start session check to see if logged on
session_start();
if (!isset($_SESSION['user_id']))
{
header("Location: home.php");
}
else
{
  $id = $_SESSION['user_id'];
  $j_id = $_GET['jid'];
  $uid = $_GET['uid'];
  $query = 'SELECT * FROM job_postings WHERE id='.$j_id;

  $jobs = mysql_query($query);
  $job_data = mysql_fetch_row($jobs);
  $job_id=$job_data[0];
  
  
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
    <link rel="stylesheet" href="styles/jobView.css" />
    
    <script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
    <script type="text/javascript" src="scripts/feedback.js"></script>
    <script type="text/javascript" src="scripts/growl.js"></script>
    <script type="text/javascript" src="scripts/jobView.js"></script>


</head>
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
             	
                <div id="star">
                </div>
                
                
                <!-- top Start -->
             	<div id="top" class="entry" data-t="job_postings" data-i="<?php echo $job_id; ?>">
                	
                    
                    <?php
					
						if($job_data[3] == 'company'){
							  $query = 'SELECT * FROM company WHERE id='.$job_data[4];
							  $companies = mysql_query($query);
							  $comp_data = mysql_fetch_row($companies);
							  $comp_id=$comp_data[0]; 
							  
							  echo '<span>'.$comp_data[2].' &#8226; '.$comp_data[3].' &#8226; '.$comp_data[5].' &#8226; <a href="'.$comp_data[6].'">'.$comp_data[6].'</a></span>';	
						}
						else{
							
							  $query = 'SELECT * FROM auth_user WHERE id='.$job_data[4];
							
							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($users);
							  $user_id=$user_data[0]; 
							  
							  
							  echo '<span>'.$user_data[1].' '.$user_data[2].' &#8226; '.$user_data[3].'</span>';
						}
					
					?>
                    
                
                </div>
                <!-- top End -->
                
                <!-- leftOpt Start -->
                <div id="leftOpt">
                                <div class="label">Position</div>
                                <div class="leftInfo"><?php echo $job_data[6]; ?></div>
                                <div class="label">Type</div>
                                <div class="leftInfo"><?php echo $job_data[7]; ?></div>
                                  
                                <div class="label">City</div>
                                <div class="leftInfo"><?php echo $job_data[8]; ?></div>
                                <div class="label">State</div>
                                <div class="leftInfo"><?php echo $job_data[9]; ?></div>
                                <div class="label">Start</div>
                                <div class="leftInfo"><?php echo $job_data[10]; ?></div>
                                <div class="label">End</div>
                                <div class="leftInfo"><?php echo $job_data[11]; ?></div>
                                <div class="label">Pay</div>
                                <div class="leftInfo"><?php echo $job_data[15]; ?></div>
                                
                                <div class="label">Deadline</div>
                                <div class="leftInfo"><?php echo $job_data[14]; ?></div>
                                <div id="apply">Apply</div>
                </div>
                <!-- leftOpt End -->
                
                <!-- centerOpt Start -->
                <div id="centerOpt">
                	
                    	<!-- description Start -->
                        <div>
                        
                            <div class="sectionTitle"><h2>Description:</h2></div>
                            
                            <div class="desArea sideRow entry" data-t="job_postings" data-i="<?php echo $job_id; ?>">
                                <div class="row1">
                                
                                <?php
									echo '<div>'.$job_data[12].'</div>';
								?>
                                </div>
                              
                            </div>
                        </div>
                        <!-- description End -->
                        
                      
                            
                        
                        
                        <!-- Requirements Start -->
                        <?php
							$reqQ= mysql_query('SELECT * FROM requirements WHERE job_id ='.$job_id);
							if(mysql_num_rows($reqQ)!=0){
								echo '<h2>Requirements:</h2>
								
								<div class="reqArea sideRow">
								<ul>';
								
									$reqQ= mysql_query('SELECT * FROM requirements WHERE job_id ='.$job_id);
									while($req = mysql_fetch_object($reqQ)){
										echo '<li class="req entry">'.$req->info.'</li>';
									}
							
								echo '</ul>   
								</div>';
								
							}
						?>
                        <!-- Requirement End -->
                        
                        
                        <!-- Pluses Start -->
                        <?php
							$pluQ= mysql_query('SELECT * FROM pluses WHERE job_id ='.$job_id);
							if(mysql_num_rows($pluQ)!=0){	
								echo '<h2>Preferred:</h2>
								
								<div class="plusArea sideRow">
									<ul>';
									
										$pluQ= mysql_query('SELECT * FROM pluses WHERE job_id ='.$job_id);
										while($plu = mysql_fetch_object($pluQ)){
											echo '<li class="plu entry">'.$plu->info.'</li>';
										}
									
								echo '</ul>
								</div>';
							}
						?>
                        <!-- Pluses End -->
                        
                        
                        <!-- Benefits Start -->
                        <?php
							$beneQ= mysql_query('SELECT * FROM benefits WHERE job_id ='.$job_id);
							if(mysql_num_rows($beneQ) != 0){
								echo '
									<h2>Benefit:</h2>
									
								   <div class="beneArea sideRow">
								   	<ul>';
										
											$beneQ= mysql_query('SELECT * FROM benefits WHERE job_id ='.$job_id);
											while($bene = mysql_fetch_object($beneQ)){
												echo '<li class="entry bene">'.$bene->info.'</li>';
											}
										echo '</ul>
										</div>';
									
									
							}
						?>
                        <!-- Benefits End -->
                        
                   
                </div>
                <!-- centerOpt End -->
             
            </div>
            <!-- Content End -->
            
            
    	</div>
    
    </div>
    
    <div id="footer">
         Footer!
    </div>
    
    <div id="coverUp" title="Apply!">

    <form enctype="multipart/form-data" action="dashboard.php" id="application" method="POST" />
    
    		<div>Please Select a resume:</div>
            <?php
				
				$resQ = mysql_query('SELECT * FROM resume WHERE user_id='.$id);
				$unRes = 1;
				if (mysql_num_rows($resQ) == 0) echo "You haven't a resume yet.";
				else{
					echo '<select name="resume" id="appResume"  class="editFormNA">';
					while($res = mysql_fetch_object($resQ)){
						if($res->title){
							echo '<option value="'.$res->id.'">' .$res->title . '</option>';
						}
						else{
							echo '<option value="'.$res->id.'">Untitled Resume '.$unRes.'</option>';
							$unRes = $unRes + 1;
						}
					}
					echo '</select>';
				}
            ?>
            
            
            <div>Please Select a cover letter:</div>
            <?php
				
				$covQ = mysql_query('SELECT * FROM cover_letter WHERE user_id='.$id);
				$unCov = 1;
				if (mysql_num_rows($covQ) == 0) echo "You haven't uploaded a cover leteer yet.";
				else{
					echo '<select name="cover" id="appCover"  class="editFormNA">';
					while($cov = mysql_fetch_object($covQ)){
						if($cov->title){
							echo '<option value="'.$cov->id.'">' .$cov->title . '</option>';
						}
						else{
							echo '<option value="'.$cov->id.'">Untitled Resume '.$unCov.'</option>';
							$unCov = $unCov + 1;
						}
					}
					echo '</select>';
				}
            ?>
           
     </form>
     </div>
        
   
</body>
</html>