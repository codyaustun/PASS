
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
  
}

function matchDesc($key){
   $search = '[[:<:]]'.$key.'[[:>:]]';
   $query = "SELECT * FROM job_postings WHERE description REGEXP '$search'";
   $result=mysql_query($query);
   return $result;
}
function matchLoc($key){
   $search = '[[:<:]]'.$key.'[[:>:]]';
   $query = "SELECT * FROM job_postings WHERE location REGEXP '$search'";
   $result=mysql_query($query);
   return $result;
}
function matchIndustry($key){
   $search = '[[:<:]]'.$key.'[[:>:]]';
   $query = "SELECT * FROM job_postings WHERE type REGEXP '$search'";
   $result=mysql_query($query);
   return $result;
}
function matchTitle($key){
   $search = '[[:<:]]'.$key.'[[:>:]]';
   $query = "SELECT * FROM job_postings WHERE position REGEXP '$search'";
   $result=mysql_query($query);
   return $result;
}
function matchReq($key){
   $search = '[[:<:]]'.$key.'[[:>:]]';
   $query = "SELECT * FROM job_postings WHERE requirements REGEXP '$search'";
   $result=mysql_query($query);
   return $result;
}
//$key = "programming";
//$res=mysql_fetch_object(matchDesc($key));
//print_r($res);

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
    <link rel="stylesheet" href="styles/search.css" />
    
    <script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
    <script type="text/javascript" src="scripts/feedback.js"></script>
    <script type="text/javascript" src="scripts/growl.js"></script>
    <script type="text/javascript" src="scripts/search.js"></script>


</head>
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
                        <li><a href="dashboard.php" class="nav-link navCurrent">Home</a></li>
                        <li><a href="#" class="nav-link">Pass Me(10)</a></li>
                        <li><a href="#" class="nav-link">Job Tracking(3)</a></li>
                        
                      
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
            
    
    <?php 
	 $numReqs=$numInd=$numLoc=$numDesc=$numTit=0;
	if(isset($_POST['search'])){
    			echo '<table>
				
					<tr>
						<td>
							Position
						</td>
						<td>
							Type
						</td>
						<td>
							Employer
						</td>
						<td>
							Start Date
						</td>
						<td>
							Pay
						</td>
					</tr>';
    
					$results = (matchReq($_POST['search']));
					if($numReqs=mysql_num_rows($results)==0) {}
					else{
					  while ($Res=mysql_fetch_object($results)){
						
						if($Res->employer_type == 'company'){
						
						  $query = 'SELECT * FROM company WHERE id='.$Res->employer_id;

						  $companies = mysql_query($query);
						  $comp_data = mysql_fetch_row($companies);
						  $comp_id=$comp_data[0];  
						
						echo  '<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Res->id.'">'.$Res->position.'</a>
									</td>
									<td>'
										.$Res->type.
									'</td>
									<td>
										<a href="company.php?uid='.$id.'&amp;cid='.$comp_id.'">'.$comp_data[2].'</a>
									</td>
									
									<td>'
										.$Res->start.
									'</td>
									
									<td>'
										.$Res->pay.
									'</td>
								</tr>';
								
						}
						else{
							
							$query = 'SELECT * FROM auth_user WHERE id='.$Res->employer_id;

							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($users);
							  $user_id=$comp_data[0];  
							
							'<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Res->id.'">'.$Res->position.'</a>
									</td>
									<td>'
										.$Res->type.
									'</td>
									<td>
										'.$user_data[1].' '.$user_data[2].'
									</td>
									
									<td>'
										.$Res->start.
									'</td>
									
									<td>'
										.$Res->pay.
									'</td>
								</tr>';	
						}
					}
				}
			
				
				$results = (matchIndustry($_POST['search']));
				if($numInd=mysql_num_rows($results)==0) {}
				else{
					while ($Ind=mysql_fetch_object($results)){
						if($Ind->employer_type == 'company'){
								$query = 'SELECT * FROM company WHERE id='.$Ind->employer_id;
	
							  $companies = mysql_query($query);
							  $comp_data = mysql_fetch_row($companies);
							  $comp_id=$comp_data[0]; 
						
						echo '<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Ind->id.'">'.$Ind->position.'</a>
									</td>
									<td>'
										.$Ind->type.
									'</td>
									<td>
										<a href="company.php?uid='.$id.'&amp;cid='.$comp_id.'">'.$comp_data[2].'</a>
									</td>
									
									<td>'
										.$Ind->start.
									'</td>
									
									<td>'
										.$Ind->pay.
									'</td>
								</tr>'; 
								
						}
						else{
							
							$query = 'SELECT * FROM auth_user WHERE id='.$Ind->employer_id;

							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($users);
							  $user_id=$comp_data[0];  
							
							'<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Ind->id.'">'.$Ind->position.'</a>
									</td>
									<td>'
										.$Ind->type.
									'</td>
									<td>
										'.$user_data[1].' '.$user_data[2].'
									</td>
									
									<td>'
										.$Ind->start.
									'</td>
									
									<td>'
										.$Ind->pay.
									'</td>
								</tr>';	
							
						}
	
	
					}
				}
				$results = (matchLoc($_POST['search']));
				if($numLoc=mysql_num_rows($results)==0) {}
				else{
  					while ($Loc=mysql_fetch_object($results)){
						if($Loc->employer_type == 'company'){
							$query = 'SELECT * FROM company WHERE id='.$Loc->employer_id;
	
							  $companies = mysql_query($query);
							  $comp_data = mysql_fetch_row($companies);
							  $comp_id=$comp_data[0]; 
						
    					echo  '<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Loc->id.'">'.$Loc->position.'</a>
									</td>
									<td>'
										.$Loc->type.
									'</td>
									<td>
										<a href="company.php?uid='.$id.'&amp;cid='.$comp_id.'">'.$comp_data[2].'</a>
									</td>
									
									<td>'
										.$Loc->start.
									'</td>
									
									<td>'
										.$Loc->pay.
									'</td>
								</tr>'; 
								
								
						}
						else{
							
							$query = 'SELECT * FROM auth_user WHERE id='.$Loc->employer_id;

							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($users);
							  $user_id=$comp_data[0];  
							
							'<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Loc->id.'">'.$Loc->position.'</a>
									</td>
									<td>'
										.$Loc->type.
									'</td>
									<td>
										'.$user_data[1].' '.$user_data[2].'
									</td>
									
									<td>'
										.$Loc->start.
									'</td>
									
									<td>'
										.$Loc->pay.
									'</td>
								</tr>';	
								
							
						}
								
					}
				}
						
						
			   $results = (matchDesc($_POST['search']));
			   if($numDesc=mysql_num_rows($results)==0) { echo "0 desc";}
				else{
				  while ($Desc=mysql_fetch_object($results)){
						
						if($Desc->employer_type == 'company'){	
							$query = 'SELECT * FROM company WHERE id='.$Loc->employer_id;
	
							  $companies = mysql_query($query);
							  $comp_data = mysql_fetch_row($companies);
							  $comp_id=$comp_data[0]; 
						
    					echo  '<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Desc->id.'">'.$Desc->position.'</a>
									</td>
									<td>'
										.$Desc->type.
									'</td>
									<td>
										<a href="company.php?uid='.$id.'&amp;cid='.$comp_id.'">'.$comp_data[2].'</a>
									</td>
									
									<td>'
										.$Desc->start.
									'</td>
									
									<td>'
										.$Desc->pay.
									'</td>
								</tr>';
								
						}
						else{
							
								$query = 'SELECT * FROM auth_user WHERE id='.$Desc->employer_id;

							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($user);
							  $user_id=$comp_data[0];  
							
							'<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Desc->id.'">'.$Desc->position.'</a>
									</td>
									<td>'
										.$Desc->type.
									'</td>
									<td>
										'.$user_data[1].' '.$user_data[2].'
									</td>
									
									<td>'
										.$Desc->start.
									'</td>
									
									<td>'
										.$Desc->pay.
									'</td>
								</tr>';		
						}
								
				  }
				  
			}

			$results = (matchTitle($_POST['search']));
			if($numTit=mysql_num_rows($results)==0) {}
			else{
  				while ($Tit=mysql_fetch_object($results)){
					$query = 'SELECT * FROM company WHERE id='.$Loc->employer_id;
						if($Tit->employer_type == 'company'){
							  $companies = mysql_query($query);
							  $comp_data = mysql_fetch_row($companies);
							  $comp_id=$comp_data[0]; 
						
    					echo  '<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Tit->id.'">'.$Tit->position.'</a>
									</td>
									<td>'
										.$Tit->type.
									'</td>
									<td>
										<a href="company.php?uid='.$id.'&amp;cid='.$comp_id.'">'.$comp_data[2].'</a>
									</td>
									
									<td>'
										.$Tit->start.
									'</td>
									
									<td>'
										.$Tit->pay.
									'</td>
								</tr>';
						}
						else{
							
								$query = 'SELECT * FROM auth_user WHERE id='.$Tit->employer_id;

							  $users = mysql_query($query);
							  $user_data = mysql_fetch_row($user);
							  $user_id=$comp_data[0];  
							
							'<tr>
									<td>
										<a href="jobView.php?uid='.$id.'&amp;jid='.$Tit->id.'">'.$Tit->position.'</a>
									</td>
									<td>'
										.$Tit->type.
									'</td>
									<td>
										'.$user_data[1].' '.$user_data[2].'
									</td>
									
									<td>'
										.$Tit->start.
									'</td>
									
									<td>'
										.$Tit->pay.
									'</td>
								</tr>';	
							
						}
				}
				
			}
					

			
			
		echo '</table>';
		
	}else{
		echo "No Results. Please try another search";	
	}
    ?>
   
    
   
    <ol> 
    <?php
	
/*

*/   

  


    ?>

   </ol>
             
            </div>
            <!-- Content End -->
            
            
    	</div>
    
    </div>
    
    <div id="footer">
        <a href="abouts_2.html">About us</a>
    </div>    
   
</body>
</html>