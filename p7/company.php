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
  $c_id = $_GET['cid'];
  $uid = $_GET['uid'];
  if ($id!=$uid) header("Location: dashboard.php");
  if ($c_id==none){
        $new_compQ="INSERT INTO `kwadwo+IAP`.`company` (`id`, `user_id`, `title`, `industry`, `description`, `size`, `company_url`, `founded_on`, `picture`, `additional_info`, `created_on`) VALUES (NULL, $uid, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP)";
        mysql_query($new_compQ);
        $comp_id = mysql_insert_id();
        $url = "company.php?uid=$id&cid=$comp_id";
        header("Location:".$url);
  }
  else {

  $query = 'SELECT * FROM company WHERE user_id='.$id.' and id='.$c_id;

  $companies = mysql_query($query);
  $comp_data = mysql_fetch_row($companies);
  $comp_id=$comp_data[0];
  
  
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
	  
		$query="UPDATE `$db_database`.`company` SET `picture` = '$fcontent' WHERE `company`.`id` =$comp_id";
		mysql_query($query) or die($query);
	
	  }
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
<link rel="stylesheet" href="styles/create_company.css" />

<script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="scripts/growl.js"></script>
<script type="text/javascript" src="scripts/feedback.js"></script>
<script type="text/javascript" src="scripts/create_company.js"></script>

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
                        <li><a href="dashboard.php" class="nav-link">Home</a></li>
                       
                      
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
                            	<li><a href="logout">Logout</a></li>
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
                <!-- <h1 id="main_title">Create Company:</h1> -->

            	<div id="company_pic">
                	<div id="pic">
                    	<?php 
						/*
						
						$rs = mysql_query("select picture from company where id=$comp_id");
						
						$row = mysql_fetch_assoc($rs);
						$imagebytes = $row[imgdata];
						header("Content-type: image/jpeg");
						print $imagebytes;
						
						echo $comp_data[8];
						
						*/ ?>
                    </div>
                       <form enctype="multipart/form-data" action="<?php echo "company.php?uid=$id&amp;cid=$comp_id";?>" id="upLetter" method="POST" />
                          <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                           <input name="upload" type="file" />
                         
                           <input type="submit" name="submit" id="upLetSub" value="Upload" />
                         </form>
                </div>
                <div id='describ'>
                
                	<table>
                    	<tr>
                        	<td  class="fieldLabel">
                            	
                                <label for="title">Title:</label>
                              
                                
                            </td>
                            
                            <td>
                            	<input type="text" id="title" name="title" class="fieldBox editFormNA" value="<?php echo $comp_data[2]; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                        	<td  class="fieldLabel">
                            	<label for="industry">Industry:</label>
                            </td>
                            
                            <td>
                            	<input type="text" id="industry" name="industry" class="fieldBox editFormNA" value="<?php echo $comp_data[3]; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                        	<td  class="fieldLabel">
                            	<label for="size" >Size:</label>
                            </td>
                            
                            <td>
                            	<input type="text" id="size" name="size" class="fieldBox editFormNA" value="<?php echo $comp_data[5]; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                        	<td class="fieldLabel">
                            	<label for="founded_on">Founded on:</label>
                            </td>
                            
                            <td>
                            	<input type="text" id="founde_on" name="founded_on" class="fieldBox editFormNA dateC" value="<?php echo $comp_data[7]; ?>">
                            </td>
                        </tr>
                        
                        <tr>
                        	<td  class="fieldLabel">
                            	<label for="company_url">Website:</label>
                            </td>
                            
                            <td>
                            	<input type="text" id="company_url" name="company_url" class="fieldBox editFormNA" value="<?php echo $comp_data[6]; ?>">
                            </td>
                        </tr>
                    </table>
           
                </div>
                <div id="describtion" class="entry" data-t="company" data-i="<?php echo $comp_id; ?>">
                    	<div class="sectionTitle"><h2>Description:</h2></div>
                            
                        <div class="sideRow">
                            <div class="row1">
                            <?php
							
								if($comp_data[4]){
									echo '<textarea name="description" class="editableForm editableAreaForm" >'.$comp_data[4].'</textarea>';
								}
								else{
                                echo '<textarea name="description" class="editableForm editableAreaForm clear" >Example: Google Inc. is an American multinational public corporation invested in Internet search, cloud computing, and advertising technologies. Google hosts and develops a number of Internet-based services and products, and generates profit primarily from advertising through its AdWords program. The company was founded by Larry Page and Sergey Brin, while the two were attending Stanford University</textarea>';
								}
							?>
                            </div>
                            
                        </div>
						<div class="sectionTitle"><h2>Additional Information:</h2></div>
                            
                        <div class="sideRow">
                            <div class="row1">
                            <?php
								if($comp_data[9]){
									echo '<textarea name="additional_info" class="editableForm editableAreaForm" >'.$comp_data[9].'</textarea>';
								}
								else{
                                echo '<textarea name="additional_info" class="editableForm editableAreaForm clear" >Example: We focus on being a collaborative, global organization consisting of engineers with the highest levels of technical depth and programming skills. As a Software Engineering intern, you could end up working on our core products and services or those that support critical functions of our engineering operations.</textarea>';
								}
							?>
                            </div>
                            
                        </div>
                        
               </div>
           </div>      
        </div>
      </div>  
        <div id="footer">
        	<a href="abouts_2.html">About us</a>
        </div>
        
    
</body>
</html>