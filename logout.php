<!DOCTYPE html>
<html>
<head>
    <title>Nutralytics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<div class="container-3">
  
  <title>PHP State Maintenance (Session)</title>    
</head>
<body>

<?php session_start(); // make sessions available ?>
  
  <div class="container">
    <h1>Thank you for using Nutrilitics!</h1>

    
    Successfully logged out 
  </div>

<?php
// Set session variables can be removed by specifying their element name to unset() function.
// A session can be completely terminated by calling the session_destroy() function.

if (count($_SESSION) > 0)     // Check if there are session variables
{   
   foreach ($_SESSION as $key => $value)
   {
      // Deletes the variable (array element) where the value is stored in this PHP.
      // However, the session object still remains on the server.    	
      unset($_SESSION[$key]);      
   }  
   echo "sessionID = " . session_id() . "<br/>";
   session_destroy();     // complete terminate the session instance  
   echo "sessionID = " . session_id() . "<br/>";

   // redirect to the login page immediately 
//    header('Location: login.php');

   // redirect with 5 seconds delay
   header('refresh:1; url=createAccount.php');
}

?>


</body>
</html>
