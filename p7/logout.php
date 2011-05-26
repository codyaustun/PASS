<?php

session_start();

if(isset($_SESSION['user_id'])){
	
    $_SESSION = array();
    if (session_id()!="" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000,'/');
	unset($_SESSION['user_id']);
    session_destroy();   
    header("Location: home.php");
}
else{
   echo "You are not logged in!";
   header("Location: home.php");
}

?>