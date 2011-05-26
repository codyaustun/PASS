
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
<script type="text/javascript" src="scripts/jquery.validate.min.js" ></script>
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
                        	<input type="email" name="email"  id="email"/>
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
                    	<td colspan="2" class="sub">
                        	
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
                        <h3>It's easy, and free.</h3>
                        
                        <br />
                        <table>
                        
                         <tr>
                             <td class="fieldLabel">
                                 <label for="firstName">First Name:</label>
                                </td>
                                
                                <td>
                                 <input name="firstName" id="firstName"  
                                    type="text" class="fieldBox"/>
                                </td>
                            </tr>
                            <tr>
                             <td class="fieldLabel">
                                 <label for="lastName">Last Name:</label>
                                </td>
                                <td>
                                 <input name="lastName" id="lastName" 
                                     type="text" class="fieldBox"/>
                                </td>
                            </tr>
                            
                            <tr>
                             <td class="fieldLabel">
                                 <label for="email_su">Email:</label>
                                </td>
                                <td>
                                 <input name="email_su" id="email_su"  type="text" class="fieldBox" />
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
        </div>
        
    </div>
</body>
</html>


