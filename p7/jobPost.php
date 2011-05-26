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
  if ($id!=$uid) header("Location: dashboard.php");
  if ($j_id==none){
        $new_jobQ="INSERT INTO `kwadwo+IAP`.`job_postings` (`id`, `user_id`, `resume_id`, `employer_type`, `employer_id`, `visible`, `position`, `type`, `city`, `state`, `start`, `end`, `description`, `hours`, `deadline`, `pay`) VALUES (NULL, '".$id."', NULL, NULL, NULL, 'false', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
        mysql_query($new_jobQ);
        $job_id = mysql_insert_id();
		// $job_id = 3;
		echo $new_jobQ;
        $url = "jobPost.php?uid=$id&jid=$job_id";
        header("Location:".$url);
  }
  else {

  $query = 'SELECT * FROM job_postings WHERE user_id='.$id.' and id='.$j_id;

  $jobs = mysql_query($query);
  $job_data = mysql_fetch_row($jobs);
  $job_id=$job_data[0];
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
    <link rel="stylesheet" href="styles/jobPost.css" />
    
    <script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
    <script type="text/javascript" src="scripts/feedback.js"></script>
    <script type="text/javascript" src="scripts/growl.js"></script>
    <script type="text/javascript" src="scripts/jobPost.js"></script>


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
             	
                <!-- top Start -->
             	<div id="top" class="entry" data-t="job_postings" data-i="<?php echo $job_id; ?>" data-u="<?php echo $id; ?>">
                	
                    <!--Company start selection start-->
                            <div class="compSelect">
                                <div class="containSelect">
                                    <div class="individual">
                                        <div class="indPic  <?php if($job_data[3] == 'individual') echo 'indPicHover'; ?>">
                                        </div>
                                        <label>
                                            <input id="individual" name="employer_type" class="editFormNA" type="radio" value="individual"/>
                                            <span>Individual</span>
                                        </label>
                                    </div>
                                    
                                    <div class="company">
                                        <div class="compPic  <?php if($job_data[3] == 'company') echo 'compPicHover'; ?>">
                                        </div>
                                        <label>
                                            <input id="company" name="employer_type" class="editFormNA" type="radio" value="company"/>
                                                <?php
												if($job_data[3] == 'company'){
													$query = 'SELECT * FROM company WHERE user_id='.$id.' and id='.$job_data[4];
													  $companies = mysql_query($query);
													  $comp_data = mysql_fetch_row($companies);
													  $comp_id=$comp_data[0];
													  echo '<span>'.$comp_data[2].'</span>';
												}
												else{
                                                	echo '<span>Company</span>';
												}
												?>
                                        </label> 
                                    </div>
                    			</div>
                			</div>                        
							<!--Company start selection end-->
                
                </div>
                <!-- top End -->
                
                <!-- leftOpt Start -->
                <div id="leftOpt" class="entry" data-t="job_postings" data-i="<?php echo $job_id; ?>">
                	<form id="contactForm">
                                
                              
                                <label for="position">Position</label>
                                <input id="postition" type="text" name="position" class="editFormNA" value="<?php echo $job_data[6]; ?>"/>
                                <label for="type_job">Type</label>
                                <select name="type"  class="editFormNA" value="<?php echo $job_data[7]; ?>">
                                    <option value="select">Select</option>
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Part-Time">Part-Time</option>
                                </select>
                                <label for="city">City</label>
                                <input id="city" type="text" name="city" class="editFormNA" value="<?php echo $job_data[8]; ?>">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state"  class="editFormNA" value="<?php echo $job_data[9]; ?>"/>
                                <label for="start_date">Start</label>
                                <input id="start_date"  name="start" class="date editFormNA" value="<?php echo $job_data[10]; ?>">
                                <label for="end_date">End</label>
                                <input id="end_date" name="end" class="date editFormNA" value="<?php echo $job_data[11]; ?>">
                                <label for="pay">Pay</label>
                                <select id="pay" type="text" name="pay" class="editFormNA" value="<?php echo $job_data[15]; ?>">
                                	<option value="0-$20,000">0-$20,000</option>
                                    <option value="$20,000-$40,000">$20,000-$40,000</option>
                                    <option value="$40,000-$60,000">$40,000-$60,000</option>
                                    <option value="$60,000-$80,000">$60,000-$80,000</option>
                                    <option value="$80,000-$100,000">$80,000-$100,000</option>
                                    <option value="$100,000-$150,000">$100,000-$150,000</option>
                                    <option value="$150,000+">$150,000</option>
                                </select>
                                <label for="deadline">Deadline</label>
                                <input id="deadline" name="deadline"  class="date editFormNA" value="<?php echo $job_data[14]; ?>"/>
                                
                                
                                <?php
                                		if($job_data[5] == 'true'){
											echo '<input id="jobSubmit" type="submit" value="Submissions" />';
										}
										else{
                                			echo '<input id="jobSubmit" type="submit" value="Create Job" />';
										}
								
								?>
                     </form>
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
								
									if($job_data[12]){
										
										echo '<textarea name="description" class="editableForm editableAreaForm" >'.$job_data[12].
										'</textarea>
                                </div>';
									}
									else{
                                    	echo '<textarea name="description" class="editableForm editableAreaForm clear" >Example: As a Program Manager intern, you will get to help drive the technical vision, design and implementation of next-generation software solutions. You will transform the product vision into elegant designs that will ultimately turn into products used by Microsoft customers. The PM intern helps manage feature sets throughout the product lifecycle, and you will have the chance to see your design through to completion. You will also work directly with other key team members including Software Development Engineers and Software Development Engineers in Test. Program Managers are advocates for end-users, so your passion for anticipating customer needs and creating outside-the-box solutions for them will really help you shine in this role. </textarea>
                                </div>';
								
									}
									
								?>
                                
                              
                            </div>
                        </div>
                        <!-- description End -->
                        
                      
                            
                        
                        
                        <!-- Requirements Start -->
                        <h2>Requirements:</h2>
                        
                        <div class="reqArea sideRow">
                        <?php
                        	$reqQ= mysql_query('SELECT * FROM requirements WHERE user_id ='.$id.' and job_id ='.$job_id);
                            while($req = mysql_fetch_object($reqQ)){
                                echo '<div class="req entry" data-t="requirements" data-i="'.$req->id.'">
										<div class="smallHandle">
											<div class="close">
											</div>
										</div>
										<textarea name="info" class="editableForm editableAreaForm">'.$req->info.'</textarea>
			  
									</div>';
							}
						?>    
                        	<div class="req entry sample" data-t="requirements" data-i="">
                        		<div class="smallHandle">
                                    <div class="close">
                                    </div>
                                </div>
                                <textarea name="info" class="editableForm editableAreaForm clear" >Example: 1-2 years experience programming in C++, Java, or other computer programming languages preferred</textarea>
      
                        	</div>
                        </div>
                        <!-- Requirement End -->
                        
                        
                        <!-- Pluses Start -->
                        <h2>Preferred:</h2>
                        
                        <div class="plusArea sideRow">
                        	<?php
								$pluQ= mysql_query('SELECT * FROM pluses WHERE user_id ='.$id.' and job_id ='.$job_id);
								while($plu = mysql_fetch_object($pluQ)){
									echo '<div class="plus entry" data-t="pluses" data-i="'.$plu->id.'">
											<div class="smallHandle">
												<div class="close">
												</div>
											</div>
											<textarea name="info" class="editableForm editableAreaForm">'.$plu->info.'</textarea>
				  
										</div>';
								}
							?> 
                        
                        	<div class="plus entry sample" data-t="pluses" data-i="">
                        		<div class="smallHandle">
                                    <div class="close">
                                    </div>
                                </div>
                                <textarea name="info" class="editableForm editableAreaForm clear" >Example: Familiarity with managing complex project schedules, solving complex problems, and nurturing cross-group collaboration</textarea>
      
                        	</div>
                        </div>
                        <!-- Pluses End -->
                        
                        
                        <!-- Benefits Start -->
                        <h2>Benefit:</h2>
                        
                       <div class="beneArea sideRow">
                       		<?php
								$beneQ= mysql_query('SELECT * FROM benefits WHERE user_id ='.$id.' and job_id ='.$job_id);
								while($bene = mysql_fetch_object($beneQ)){
									echo '<div class="bene entry" data-t="benefits" data-i="'.$bene->id.'">
											<div class="smallHandle">
												<div class="close">
												</div>
											</div>
											<textarea name="info" class="editableForm editableAreaForm">'.$bene->info.'</textarea>
				  
										</div>';
								}
							?> 
                       
                        	<div class="bene entry sample" data-t="benefits" data-i="">
                        		<div class="smallHandle">
                                    <div class="close">
                                    </div>
                                </div>
                                <textarea name="info" class="editableForm editableAreaForm clear" >Example: Subsidized car rental or bike purchase plan</textarea>
      
                        	</div>
                        </div>
                        <!-- Benefits End -->
                        
                   
                </div>
                <!-- centerOpt End -->
             
            </div>
            <!-- Content End -->
            
            
    	</div>
    
    </div>
    
    <div id="footer">
         About Us
    </div>
    
    <div id="selCompany" title="Select a Company">

		<div>Please Select a company:</div>
            <?php
				
				$compQ = mysql_query('SELECT * FROM company WHERE user_id='.$id);
				$unComp = 1;
				
					echo '<select name="company" id="appCompany"  class="editFormNA">';
					while($comp = mysql_fetch_object($compQ)){
						if($comp->title){
							echo '<option value="'.$comp->id.'">' .$comp->title . '</option>';
						}
						else{
							echo '<option value="'.$comp->id.'">Untitled Company '.$unComp.'</option>';
							$unComp = $unComp + 1;
						}
					}
					echo '</select>';
				
            ?>
    
	</div>
        
   
</body>
</html>