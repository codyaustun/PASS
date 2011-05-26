<?php // Home page to process login, signup, show html

require_once 'info.php'; //database access information

// function to process user input
function sanitizeString($var){
$var = stripslashes($var); //gets ride of unwanted slashes
$var = htmlentities($var); //removes HTML from a string
$var = strip_tags($var); //strip HTML entirely from an input
return $var;
}

$salt=$useremail=$password=""; //initialize username and password for safety
$db_server=mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to Connect to MySQL: ". mysql_error());
mysql_select_db($db_database) or die("Unable to select database: " .mysql_error());

if (isset($_POST['email']) && !(isset($_POST['firstName']) && (isset($_POST['lastName'])))) 
{
$useremail = sanitizeString($_POST['email']);
$password = sanitizeString($_POST['password']);
$salt = "At MIT 6.470 is one of the best IAP classes to take.";
$hash = sha1($password.$salt); // hash password for security

if ($useremail == "" || $password == "")
{

echo "All fields have not been entered";
// to be updated so that javascripts is inserted here
// to show pop up box
}
else 
{
$query = "SELECT id,first_name FROM auth_user WHERE 
 email = '$useremail' AND password = '$hash'";
$result = mysql_query($query);
if (!$result) die("Database access failed: " . mysql_error());
elseif (mysql_num_rows($result)) 
{
$row = mysql_fetch_row($result);
session_start();
$_SESSION['user_id'] = $row[0];
$_SESSION['first_name'] = $row[1];
$date = date("Y-m-d",time());
$query = "UPDATE `kwadwo+IAP`.`auth_user` SET `last_login`='$date' WHERE `auth_user`.`id`='$row[0]'";
mysql_query($query);
echo "You have logged in!";
header("Location: dashboard.php");
 
}
else 
{
//echo "$useremail $hash ";
die("Invalid username/password combination");
// to be updated so taht javascripts is inserted here
// to show pop up box
}
}
}

// if signing up...process form as sign
elseif (isset($_POST['firstName']))
{
$firstName = sanitizeString($_POST['firstName']);
$lastName = sanitizeString($_POST['lastName']);
$useremail = sanitizeString($_POST['email_su']);
$password = sanitizeString($_POST['password_su']);
$confirm = sanitizeString($_POST['confirm']);
$salt = "At MIT 6.470 is one of the best IAP classes to take.";
$hash = sha1($password.$salt); //hash password for security
$date = date("Y-m-d",time());

if($useremail == "" || $password == "")
{
echo "missing password or username";
// javascript to be inserted here
}
elseif($password!=$confirm)
{
echo "password and confirmation do not match up!";
// javascript to be inserted here!
}
else
{

$query = "INSERT INTO `kwadwo+IAP`.`users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `last_login`, `created_on`) VALUES (NULL, '$firstName', '$lastName', '$useremail', '$hash', 'F', NULL, '$date')";
mysql_query($query);
echo "you have successfully signed up!";
// some javascript code should go here as well
}


}

else // show regular HTML page as normal
{

/*
 ****************************************************************

******************HTML HOME PAGE for PASS *************************

******************************************************************
*/
echo <<<_HTML
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PASS - Job Hunting Made Simple</title>
<link href="images/favicon.ico" rel="shortcut icon"  />
<link href="images/favicon.ico" rel="icon" type="image/x-icon" />

<link rel="stylesheet" href="jquery-ui-1.8.7.custom/css/ui-lightness/jquery-ui-1.8.7.custom.css" />
<link rel="stylesheet" href="styles/baseThick.css" />
<link rel="stylesheet" href="styles/signup.css" />

<script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.7.custom/js/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="scripts/feedback.js"></script>
<script type="text/javascript" src="scripts/growl.js"></script>
<script type="text/javascript" src="scripts/signup.js"></script>


</head>

<body>
<div id="topOuter">
     <!-- topInner Start -->
     <div id="topInner">
        
         <!-- Header Start -->
         <div id="header">
                <div id="login">
                <form id="loginForm" method="post" action="home.php" >
                <table>
                	<tr>
                    	<td>
                        	<label for="email">Email:</label>
                        </td>
                        <td>
                        	<input type="email" name="email" value='$useremail' id="email"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label for="password">Password:</label>
                        </td>
                        <td>
                        	<input type="password" name="password" value="" id="password"/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<input type="submit" name="login"  value="Login" id="loginBut"/>
                        </td>
                    </tr>      
                </table>
                </form>
                </div>
            </div>
            
            <!-- Header End -->
            
            
            <!-- Navigation Start -->
            <div id="nav">
            
                <div id="welcome">
                
                    <div id="hi">
                    </div>
                    
                    <div id="firstNameC">
                    </div>
                    
                    <div id="lastNameC">
                    </div>
                    
                    <div id="yay">
                    </div>
                    
               	 </div>
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
            
           <!-- col1 Start --> 
             <div id="col1">
                 <div id="vidDes">
                    </div>
                    
                    <div id="des">
                     <p class= "description"> 
                            Welcome to <strong>Pass</strong>, 
                            the Professional Automatic Searching System. Pass was created 
                            with the aim of creating an all in one job searching system that would allow users to not
                            only find jobs that fit their needs easier, but also allow them to create a more 
                            efficient way to access their information all in one place. 
                     </p>
                    </div>
                </div>
                <!-- col1 start -->
                
                <!-- col2 Start -->
                <div id="col2">
                 <form id="signUp" method="post" action="home.php">
                        <h2>Sign up</h2>
                        <h3>It's free, and always will be.</h3>
                        
                        <br />
                        <table>
                        
                         <tr>
                             <td class="fieldLabel">
                                 <label for="firstName">First Name:</label>
                                </td>
                                
                                <td>
                                 <input name="firstName" id="firstName" value='$firstName' 
                                    type="text" class="clear fieldBox"/>
                                </td>
                            </tr>
                            <tr>
                             <td class="fieldLabel">
                                 <label for="lastName">Last Name:</label>
                                </td>
                                <td>
                                 <input name="lastName" id="lastName" value='$lastName'
                                     type="text" class="clear fieldBox"/>
                                </td>
                            </tr>
                            
                            <tr>
                             <td class="fieldLabel">
                                 <label for="email_su">Email:</label>
                                </td>
                                <td>
                                 <input name="email_su" value='$useremail' id="email_su" value='$useremail' type="text" class="clear fieldBox" />
                                </td>
                            </tr>
                            
                            <tr>
                             <td class="fieldLabel">
                                 <label for="password_su">Password:</label>
                                </td>
                                <td>
                                 <input name="password_su" id="password_su" class="fieldBox" type="password"  />
                                </td>
                            </tr>
                            
                            <tr>
                             <td class="fieldLabel">
                                 <label for="confirm">Confirm Password:</label>
                                </td>
                                <td>
                                 <input name="confirm" id="confirm" class="fieldBox" type="password"/>
                                </td>
                            </tr>
                            
                            <tr>
                             <td>
                                </td>
                                <td>
                                 <input type="submit" name="submit" id="signUpSubmit" value="Join!" />
                                </td>
                            </tr>
                        
                        </table>
                    
                    </form>
                </div>
                <!-- col2 End -->

            </div>
            <!-- Content End -->
            
            
        </div>
        
        <div id="footer">
             Footer!
        </div>
        
    </div>
</body>
</html>
_HTML;
}

?>

