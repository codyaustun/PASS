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
$r_id = $_GET['rid'];

$query = 'SELECT * FROM resume WHERE user_id='.$id.' and id='.$r_id;

$resumes = mysql_query($query);
$resume_data = mysql_fetch_row($resumes);
$resume_id=$resume_data[0];
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
<link rel="stylesheet" href="styles/mypassM.css" />

<script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="scripts/feedback.js"></script>
<script type="text/javascript" src="scripts/growl.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>



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
                        <li><a href="#" class="nav-link">Home</a></li>
                        <li><a href="#" class="nav-link">Pass Me(10)</a></li>
                        <li><a href="#" class="nav-link">Job Tracking(3)</a></li>
                        
                      
                    </ul>
                </div>
                <!-- Menu End -->
              
                
                
                <!-- Search form Start -->
                	<form id="searchForm">
                    	<div id="search">
                            <input type="test" name="search" id="searchBox" placeholder="search"/>
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
            	<div id="title" class="entry" data-t="resume" data-i="<?php echo $r_id ?>">
                	<input class="editForm title" type="text" id="title" placeholder="Untitled Resume" name="title" value="<?php echo $resume_data[2];?>"/>
                </div>
            
            
            	<!-- Contact Information Start -->
                <div id="contact" class="entry" data-t="resume" data-i="<?php echo $r_id ?>">
                <h2>Contact:</h2>
                
                <form id="contactForm">
                	<input class="editForm" type="text" id="street" name="street" placeholder="Street" value="<?php echo $resume_data[3];?>" />
                    &#8226;
                    <input class="editForm" type="text" id="city" name="city" placeholder="City" value="<?php echo $resume_data[4];?>"/>,
                    <input class="editForm" type="text" id="state" name="state"  placeholder="State" value="<?php echo $resume_data[5];?>"/>
                    <input class="editForm" type="text" id="zip" name="zip" placeholder="Zip Code" value="<?php echo $resume_data[6];?>" />
                    &#8226;
                    <label for="phone">Phone:</label>
                    <input class="editForm" type="text" id="phone" name="phone" placeholder="555-555-5555" value="<?php echo $resume_data[8];?>"/>
                    &#8226;
                    <label for="fax">Fax:</label>
                    <input class="editForm" type="text" id="fax" name="fax" placeholder="555-555-5555" value="<?php echo $resume_data[9];?>"/>
                    &#8226;
                    <label for="email">Email:</label>
                    <input class="editForm" type="email" id="email" name="email" placeholder="smith@example.com" value="<?php echo $resume_data[10];?>"/>
                </form>
                </div>
                <!-- Contact Information End -->
        
                <!-- Education Start -->
                <div  id="education">
                
                	<!-- col1 Start -->
                    <div class="col1">
                
                        <span class="sectionTitle">Education:</span>
                        
                        <!-- Storage Managment Controls Start -->
                        <div class="manage">
                        	<div class="storeButton">Storage</div>
                            <div class="open connectEd">
							<?php 
                            $edQ= mysql_query('SELECT * FROM education WHERE user_id ='.$id.' and resume_id !='.$resume_id.' ORDER BY sequence');
                            while($ed = mysql_fetch_object($edQ)){
                                echo '
									<div class="storage">
										<div class="mywrap">
											<div class="ed entry" data-t="education" data-i="'.$ed->id.'">
											
												<div class="handle">
													<div class="move">
													</div>
													<div class="cut">
													</div>
													<div class="close">
													</div>
												</div>
											
												<div class="col2">
													
													<div class="row1">
														
														<div class="school">
															<span class="editable" data-field="school" data-type="bold">'
																.$ed->school.
															'</span>
														</div>
														
														<div class="gpa">
															GPA:&nbsp;
															<span class="editable" data-field="gpa">'
																.$ed->gpa.
															'</span>
															/4.0
														</div>
														
													</div>
													
													<div class="row2">
														<span class="degree editable" data-field="degree">'
															.$ed->degree.
														'</span>
													</div>
													
													<div class="row3">
														 
														<p class="editable-area" data-field="classes">'
															.$ed->classes.
														'</p>
													</div>
												
													
												</div>
												
												<div class="col3">
													
													<div class="location">
														<span class="editable" data-field="city">'
															.$ed->city.
														'</span>,
														<span class="editable" data-field="state">'
															.$ed->state.
														'</span>
													</div>
													
													<div class="date">
														(<span class="editable" data-field="grad_date">'
															.$ed->grad_date.	
														'</span>)
													</div>
													
													
												</div>
											</div>
										</div>
									</div> 
                                    ';
                                
                            }
                            
                        ?>
                            </div>
                        </div>
                        <!-- Storage Managment Controls End -->
                        
                    </div>
                    <!-- col1 End -->
                    
                    <!-- sideRow Start -->
                    <div class="sideRow connectEd">
                    <?php 
						$edQ= mysql_query('SELECT * FROM education WHERE user_id ='.$id.' and resume_id='.$resume_id.' ORDER BY sequence');
						if(mysql_num_rows($edQ)==0) echo '<div class="emptySideRow">Drag Here!</div>';
						else{
							while($ed = mysql_fetch_object($edQ)){
							echo '
								<div class="ed entry" data-t="education" data-i="'.$ed->id.'">
								
									<div class="handle">
										<div class="move">
										</div>
										<div class="cut">
										</div>
										<div class="close">
										</div>
									</div>
								
									<div class="col2">
										
										<div class="row1">
											
											<div class="school">
												<span class="editable" data-field="school" data-type="bold">'
													.$ed->school.
												'</span>
											</div>
											
											<div class="gpa">
												GPA:&nbsp;
												<span class="editable" data-field="gpa">'
													.$ed->gpa.
												'</span>
												/4.0
											</div>
											
										</div>
										
										<div class="row2">
											<span class="degree editable" data-field="degree">'
												.$ed->degree.
											'</span>
										</div>
										
										<div class="row3">
											 
											<p class="editable-area" data-field="classes">'
												.$ed->classes.
											'</p>
										</div>
									
										
									</div>
									
									<div class="col3">
										
										<div class="location">
											<span class="editable" data-field="city">'
												.$ed->city.
											'</span>,
											<span class="editable" data-field="state">'
												.$ed->state.
											'</span>
										</div>
										
										<div class="date">
											(<span class="editable" data-field="grad_date">'
												.$ed->grad_date.	
											'</span>)
										</div>
										
										
									</div>
								</div> 
                       			';
							}
						}
						
					?>
                       <!-- Education Sample Start -->
                        <div class="ed entry sample" data-t="education">
                        	<div class="handle">
                            	<div class="move">
                                </div>
                                <div class="cut">
                                </div>
                                <div class="close">
                                </div>
                            </div>
                            <div class="col2">
                                
                                <div class="row1">
                                    
                                    <div class="school">
                                        <span class="editable" data-field='school' data-type='bold'>
                                            School (Example: Harvard University)
                                        </span>
                                    </div>
                                    
                                    <div class="gpa">
                                    	 GPA:&nbsp;
                                        <span class="editable" data-field='gpa'>
                                        	4.0   
                                        </span>
                                        /4.0
                                    </div>
                                    
                                </div>
                                
                                <div class="row2">
                                    <span class="degree editable" data-field="degree">
                                        Enter your Degree (Example: Candidate for Bachelor of Science in Computer Science.)
                                    </span>
                                </div>
                                
                                <div class="row3">
                                     
                                    <span class="editable-area" data-field="classes">
                                        Enter your relevant classes here.
                                    </span>
                                </div>
                            
                                
                            </div>
                            
                            <div class="col3">
                                
                                <div class="location">
                                    <span class="editable" data-field="city">
                                        City
                                    </span>,
                                    <span class="editable" data-field="state">
                                    	State
                                    </span>
                                </div>
                                
                                <div class="date">
                                    (<span class="editable" data-field="grad_date">
                                        Graduation Date
                                    </span>)
                                </div>
                                
                                
                            </div>
                        </div> 
                       <!-- Education  Sample End --->
                       
                       
                        <!-- Education Controls Start -->
                       <div id="ed-control" class="control">
                            <div id="ed-show">
                                Hide Example
                            </div>
                            <div id="ed-new">
                                New
                            </div>
                       </div>
                       <!-- Education Controls End -->
                    </div> 
                    <!-- sideRow End -->
                    
                    
                       
                </div>
                <!-- education End -->
                
                <!-- experience Start -->
                <div  id="experience">
                
                	<!-- col1 Start -->
                	<div class="col1">
                
                        <span class="sectionTitle">Experience:</span>
                        
                        <!-- Storage Managment Controls Start -->
                        <div class="manage">
                        	<div class="storeButton">Storage</div>
                            <div class="open connectEx">
							<?php 
                            $exQ= mysql_query('SELECT * FROM experience WHERE user_id='.$id.' and resume_id !='.$resume_id.' ORDER BY sequence');
                            while($ex = mysql_fetch_object($exQ)){
                                    echo '
                                    <div class="storage">
                                        <div class="mywrap">
                                            <div class="ex entry" data-t="experience" data-i="'.$ex->id.'">
                                                <div class="handle">
                                                    <div class="move">
                                                    </div>
                                                    <div class="cut">
                                                    </div>
                                                    <div class="close">
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    
                                                    <div class="row1">
                                                        
                                                        <div class="organization">
                                                            <span class="editable" data-field="organization" data-type="bold">'
                                                                .$ex->organization.
                                                            '</span>
                                                            &nbsp;
                                                        </div>
                                                        
                                                        <div class="project">
                                                            <span class="editable" data-field="project">'
                                                                .$ex->project.
                                                            '</span>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row2">
                                                        <span class="position editable" data-field="position" data-type="italic">'
                                                            .$ex->position.
                                                        '</span>
                                                    </div>
                                                    
                                                    <div class="row3">
                                                         
                                                        <span class="editable-area" data-field="description">'
                                                            .$ex->description.
                                                        '</span>
                                                    </div>
                                                
                                                    
                                                </div>
                                                
                                                <div class="col3">
                                                    
                                                    <div class="location">
                                                        <span class="editable" data-field="city">'
                                                            .$ex->city.
                                                        '</span>,
                                                        <span class="editable" data-field="state">'
                                                            .$ex->state.
                                                        '</span>
                                                    </div>
                                                    
                                                    <div class="date">
                                                        (<span class="editable" data-field="start">'
                                                            .$ex->start.
                                                        '</span>-
                                                        <span class="editable" data-field="end">'
                                                            
                                                            .$ex->end.
                                                            
                                                            
                                                        '</span>)
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                            }
                            ?>
                            </div>
                        </div>
                        <!-- Storage Managment Controls End -->
                        
                    </div>
                    <!-- col1 End -->
                    
                    <!-- sideRow Start -->
                    <div class="sideRow connectEx">
                     <?php 
					$exQ= mysql_query('SELECT * FROM experience WHERE user_id='.$id.' and resume_id='.$resume_id.' ORDER BY sequence');
					if (mysql_num_rows($exQ)==0) echo '<div class="emptySideRow">Drag Here!</div>';
					else{
						while($ex = mysql_fetch_object($exQ)){
							echo '
							<div class="ex entry" data-t="experience" data-i="'.$ex->id.'">
								<div class="handle">
									<div class="move">
									</div>
									<div class="cut">
									</div>
									<div class="close">
									</div>
								</div>
								<div class="col2">
									
									<div class="row1">
										
										<div class="organization">
											<span class="editable" data-field="organization" data-type="bold">'
												.$ex->organization.
											'</span>
											&nbsp;
										</div>
										
										<div class="project">
											<span class="editable" data-field="project">'
												.$ex->project.
											'</span>
										</div>
										
									</div>
									
									<div class="row2">
										<span class="position editable" data-field="position" data-type="italic">'
											.$ex->position.
										'</span>
									</div>
									
									<div class="row3">
										 
										<span class="editable-area" data-field="description">'
											.$ex->description.
										'</span>
									</div>
								
									
								</div>
								
								<div class="col3">
									
									<div class="location">
										<span class="editable" data-field="city">'
											.$ex->city.
										'</span>,
										<span class="editable" data-field="state">'
											.$ex->state.
										'</span>
									</div>
									
									<div class="date">
										(<span class="editable" data-field="start">'
											.$ex->start.
										'</span>-
										<span class="editable" data-field="end">'
											
											.$ex->end.
											
											
										'</span>)
									</div>
									
									
								</div>
							</div>';
						}
					}
					?>
						   
                    
                    <!-- Experience Sample Start -->
                    <div class="ex entry sample" data-t="experience">
                        <div class="handle">
                            <div class="move">
                            </div>
                            <div class="cut">
                            </div>
                            <div class="close">
                            </div>
                        </div>
                        <div class="col2">
                            <div class="row1">
                                
                                <div class="organization">
                                    <span class="editable" data-field="organization" data-type="bold">
                                        MIT
                                    </span>
                                    &nbsp;
                                </div>
                                
                                <div class="project">
                                 
                                    <span class="editable" data-field="project">
                                        Electrical Engineering and Computer Science Department
                                    </span>
                                </div>
                                
                            </div>
                            
                            <div class="row2">
                                <span class="position editable" data-field="position" data-type="italic">
                                    Founder 
                                </span>
                            </div>
                            
                            <div class="row3">
                                 
                                <span class="editable-area" data-field="description">
                                    Spearheading an alumni career advising program for the EECS department, which would provide alumni mentors and mock technical interviews for current undergraduate students.
                                </span>
                            </div>
                        
                            
                        </div>
                        
                        <div class="col3">
                            
                            <div class="location">
                                <span class="editable" data-field="city">
                                    Cambridge
                                </span>,
                                <span class="editable" data-field="state">
                                    MA
                                </span>
                            </div>
                            
                            <div class="date">
                                (<span class="editable" data-field="start">
                                    Dec. 2010
                                </span>-
                                <span class="editable" data-field="end">
                                Present
                                </span>)
                            </div>
                            
                            
                        </div>
                    </div>
                <!-- Experience Sample End -->
                
                        <!-- Experience Controls End -->
                       <div id="ex-control" class="control">
                            <div id="ex-show">
                                Hide Example
                            </div>
                            <div id="ex-new">
                                New
                            </div>
                       </div>
                       <!-- Experience Controls End -->
                        
                    </div>
                    <!-- sideRow End -->
                    
                    
                
                </div>
                <!-- experience End -->
                
                <!-- activities Start -->
                <div id="activities">
                
                	<!-- col1 Start -->
                	<div class="col1">
                		<span class="sectionTitle">Activities:</span>
                        <!-- Storage Managment Controls Start -->
                        <div class="manage">
                        	<div class="storeButton">Storage</div>
                            <div class="open connectAct">
                            
							<?php
                            $actQ = mysql_query('SELECT * FROM activities WHERE user_id='.$id.' and resume_id !='.$resume_id.' ORDER BY sequence');
                            while($act=mysql_fetch_object($actQ)){
                                    echo '
                                        <div class="storage" data-t="activities" data-i="'.$act->id.'">
                                            <div class="mywrap">
                                                <div class="act entry">
                                                    <div class="handle">
                                                        <div class="move">
                                                        </div>
                                                        <div class="cut">
                                                        </div>
                                                        <div class="close">
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        
                                                        <div class="row1">
                                                            
                                                            <div class="organization">
                                                                <span class="editable" data-field="organization" data-type="bold">'
                                                                    .$act->project.
                                                                '</span>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="row2">
                                                            <span class="position editable" data-field="position" data-type="italic">'
                                                                .$act->position.
                                                            '</span>
                                                        </div>
                                                        
                                                        <div class="row3">
                                                             
                                                            <span class="editable-area" data-field="description">'
                                                                .$act->description.
                                                            '</span>
                                                        </div>
                                                    
                                                        
                                                    </div>
                                                    
                                                    <div class="col3">
                                                        
                                                        <div class="location">
                                                            <span class="editable" data-field="city">'
                                                                .$act->city.
                                                            
                                                            '</span>,
                                                            <span class="editable" data-field="state">'
                                                                .$act->state.
                                                            '</span>
                                                        </div>
                                                        
                                                        <div class="date">
                                                            (<span class="editable" data-field="start">'
                                                                .$act->start.
                                                            '</span>-
                                                            <span class="editable" data-field="end">'
                                                                .$act->end.
                                                            '</span>)
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         ';
                                
                            }
                            ?>                        

                            
                            </div>
                        </div>
                        <!-- Storage Managment Controls End -->
                    </div>
                    <!-- col1 End -->
                    
                    <!-- sideRow Start -->
                    <div class="sideRow connectAct">
                    
					<?php
                    $actQ = mysql_query('SELECT * FROM activities WHERE user_id='.$id.' and resume_id='.$resume_id.' ORDER BY sequence');
                    if(mysql_num_rows($actQ)==0) echo '<div class="emptySideRow">Drag Here!</div>';
                    else{
                        while($act=mysql_fetch_object($actQ)){
                            echo '
                                        
                                            <div class="act entry" data-t="activities" data-i="'.$act->id.'">
                                                <div class="handle">
                                                    <div class="move">
                                                    </div>
                                                    <div class="cut">
                                                    </div>
                                                    <div class="close">
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    
                                                    <div class="row1">
                                                        
                                                        <div class="organization">
                                                            <span class="editable" data-field="organization" data-type="bold">'
                                                                .$act->project.
                                                            '</span>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row2">
                                                        <span class="position editable" data-field="position" data-type="italic">'
                                                            .$act->position.
                                                        '</span>
                                                    </div>
                                                    
                                                    <div class="row3">
                                                         
                                                        <span class="editable-area" data-field="description">'
                                                            .$act->description.
                                                        '</span>
                                                    </div>
                                                
                                                    
                                                </div>
                                                
                                                <div class="col3">
                                                    
                                                    <div class="location">
                                                        <span class="editable" data-field="city">'
                                                            .$act->city.
                                                        
                                                        '</span>,
                                                        <span class="editable" data-field="state">'
                                                            .$act->state.
                                                        '</span>
                                                    </div>
                                                    
                                                    <div class="date">
                                                        (<span class="editable" data-field="start">'
                                                            .$act->start.
                                                        '</span>-
                                                        <span class="editable" data-field="end">'
                                                            .$act->end.
                                                        '</span>)
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                            ';
                        }
                    }
                    ?>                        
                        <!-- Activity Sample Start -->
                        <div class="act entry sample" data-t="activities">
                        	<div class="handle">
                            	<div class="move">
                                </div>
                                <div class="cut">
                                </div>
                                <div class="close">
                                </div>
                            </div>
                            <div class="col2">
                                
                                <div class="row1">
                                    
                                    <div class="organization">
                                        <span class="editable" data-field="organization" data-type="bold">
                                            MIT
                                        </span>
                                    </div>
                                    
                                </div>
                                
                                <div class="row2">
                                    <span class="position editable" data-field="position" data-type="italic">
                                        Member of the Institute Committee for Student Life
                                    </span>
                                </div>
                                
                                <div class="row3">
                                     
                                    <span class="editable-area" data-field="description">
                                        Represent the interests of MIT undergraduate student body and formulate a plan of action, to improve the overall quality of student life.
                                    </span>
                                </div>
                            
                                
                            </div>
                            
                            <div class="col3">
                                
                                <div class="location">
                                    <span class="editable" data-field="city">
                                        Cambridge
                                    </span>,
                                    <span class="editable" data-field="state">
                                    	MA
                                    </span>
                                </div>
                                
                                <div class="date">
                                    (<span class="editable" data-field="start">
                                        May 2010
                                    </span>-
                                    <span class="editable" data-field="end">
                                    	Present
                                    </span>)
                                </div>
                                
                                
                            </div>
                        </div>
                        <!-- Activity Sample End -->
                        
                        <!-- Activities Controls End -->
                       <div id="act-control" class="control">
                            <div id="act-show">
                                Hide Example
                            </div>
                            <div id="act-new">
                                New
                            </div>
                       </div>
                       <!-- Activities Controls End -->
                      
                        
                    </div>
                    <!--- sideRow End -->
                    
                    
                
                </div>
                <!-- activities End -->
                
                <!-- skills Start -->
                <div id="skills">
                	<!-- col1 Start -->
                	<div class="col1">
                    	<span class="sectionTitle">
                        	Skills:
                        </span>
                        
                        <!-- Storage Managment Controls Start -->
                        <div class="manage">
                        	<div class="storeButton">Storage</div>
                            <div class="open connectSk">
                            <?php
							$skQ = mysql_query('SELECT * FROM skills WHERE user_id='.$id.' and resume_id !='.$resume_id.' ORDER BY sequence');
							while($sk=mysql_fetch_object($skQ)){
									echo '
								<div class="storage">
									<div class="mywrap">
										<div class="inter entry" data-t="skills" data-i="'.$sk->id.'">
												<div class="smallHandle">
													<div class="move">
													</div>
													<div class="cut">
													</div>
													<div class="close">
													</div>
												</div>
												
											<input class="editForm editableForm skill" name="skill" placeholder="Enter interest" value="'.$sk->skill.'" />
													
										  
											
										</div>
									</div>
								</div>
										';
								
							}
							?>
                            </div>
                        </div>
                        <!-- Storage Managment Controls End -->
                        
                    </div>
                    <!-- col1 End -->
                    
                    <!-- sideRow Start -->
                    <div class="sideRow connectSk" >
                    <?php
                    $skQ = mysql_query('SELECT * FROM skills WHERE user_id='.$id.' and resume_id='.$resume_id.' ORDER BY sequence');
                    if(mysql_num_rows($skQ)==0) echo '<div class="emptySideRow">Drag Here!</div>';
                    else{
                        while($sk=mysql_fetch_object($skQ)){
                            echo '
						<div class="inter entry" data-t="skills" data-i="'.$sk->id.'">
                        		<div class="smallHandle">
                                    <div class="move">
                                    </div>
                                    <div class="cut">
                                    </div>
                                    <div class="close">
                                    </div>
                                </div>
                                
                            <input class="editForm editableForm skill" name="skill" placeholder="Enter interest" value="'.$sk->skill.'" />
                                    
                          
                            
                        </div>';
						}
					}
					?>
                    
                    	<div class="sk entry sample" data-t="skills">
                        		<div class="smallHandle">
                                    <div class="move">
                                    </div>
                                    <div class="cut">
                                    </div>
                                    <div class="close">
                                    </div>
                                </div>
                                
                            <input class="editForm editableForm skill" name="skill" placeholder="Enter skill" />
                                    
                          
                            
                        </div>
                    	
                    </div>	
                    <!-- sideRow end -->
                </div>
                <!-- skills End -->
                
                
                <!-- interests Start-->
                <div id="interests">
                	<!-- col1 Start -->
                	<div class="col1">
                    	<span class="sectionTitle">
                        	Interests:
                        </span>
                        
                        <!-- Storage Managment Controls Start -->
                        <div class="manage">
                        	<div class="storeButton">Storage</div>
                            <div class="open connectInt">
                            	<?php
								$intQ = mysql_query('SELECT * FROM interests WHERE user_id='.$id.' and resume_id !='.$resume_id.' ORDER BY sequence');
								while($int=mysql_fetch_object($intQ)){
										echo '
									<div class="storage">
										<div class="mywrap">
											<div class="inter entry" data-t="interests" data-i="'.$int->id.'">
													<div class="smallHandle">
														<div class="move">
														</div>
														<div class="cut">
														</div>
														<div class="close">
														</div>
													</div>
													
												<input class="editForm editableForm interest" name="interest" placeholder="Enter interest" value="'.$int->interest.'" />
														
											  
												
											</div>
										</div>
									</div>'
										;
									
								}
								?>
                            </div>
                        </div>
                        <!-- Storage Managment Controls End -->
                        
                    </div>
                    <!-- col1 end -->
                    
                    <!-- sideRow Start -->
                     <div class="sideRow connectInt">
                     <?php
                    $intQ = mysql_query('SELECT * FROM interests WHERE user_id='.$id.' and resume_id='.$resume_id.' ORDER BY sequence');
                    if(mysql_num_rows($intQ)==0) echo '<div class="emptySideRow">Drag Here!</div>';
                    else{
                        while($int=mysql_fetch_object($intQ)){
                            echo '
						<div class="inter entry" data-t="interests" data-i="'.$int->id.'">
                        		<div class="smallHandle">
                                    <div class="move">
                                    </div>
                                    <div class="cut">
                                    </div>
                                    <div class="close">
                                    </div>
                                </div>
                                
                            <input class="editForm editableForm interest" name="interest" placeholder="Enter interest" value="'.$int->interest.'" />
                                    
                          
                            
                        </div>';
						}
					}
					?>
                     
                     	<div class="inter entry sample" data-t="interests">
                        		<div class="smallHandle">
                                    <div class="move">
                                    </div>
                                    <div class="cut">
                                    </div>
                                    <div class="close">
                                    </div>
                                </div>
                                
                            <input class="editForm editableForm interest" name="interest" placeholder="Enter interest" />
                                    
                          
                            
                        </div>
                     
                        
                     </div>
                     <!-- sideRow End -->
                </div>
                <!-- interest End -->
                
            </div>
            <!-- Content End -->
            
            
        </div>
        
        <div id="footer">
            	About Us | Feedback | History
           	</div>
        
    </div>
</body>
</html>
