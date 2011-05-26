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
	
	if ($password == "")
	{
	
		echo "Please enter in you password";
	// to be updated so that javascripts is inserted here
	// to show pop up box
	}
	elseif($useremail == "")
	{
		echo "Please enter in your username";	
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
			$_SESSION['last_name'] = $row[2];
			$date = date("Y-m-d",time());
			$query = "UPDATE `kwadwo+IAP`.`auth_user` SET `last_login`='$date' WHERE `auth_user`.`id`='$row[0]'";
			mysql_query($query);
			echo "dashboard.php";
		 
		}
		else 
		{
			//echo "$useremail $hash ";
			echo "Sorry, your username or password was not correct";
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
		echo "Your missing your password";
	// javascript to be inserted here
	}
	elseif($useremail == "")
	{
		echo "You forgot your email address";
	}
	elseif($password!=$confirm)
	{
		echo "Your password and confirmation do not match up!";
	// javascript to be inserted here!
	}
	else
	{
	
	$query = "INSERT INTO `kwadwo+IAP`.`auth_user` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `last_login`, `created_on`) VALUES (NULL, '$firstName', '$lastName', '$useremail', '$hash', 'F', $date, '$date')";
	mysql_query($query);
	echo "dashboard.php";
	// some javascript code should go here as well
	}


}
?>