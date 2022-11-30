<?php include('../'); ?>
<html>

<head>
    
    <title>Nutrilitics</title>
    <link rel="stylesheet" href="admin.css">

</head>
<div class=container-4>
<br>
        <h2>Welcome to Nutrilitics! Please Create an Account</h2>
        
        <h4>For new users, please insert your daily calorie goal</h4>
</div>

            <form action="createAccount.php" method="POST" class= "logo-light2">
                <div class="insert-info">
                Username: 
                    <input type="text" name="username" placeholder="Enter Username" required><br>
                    Password:  
                    <input type="text" name="pwd" placeholder="Enter Password" required>
                    <br>
                    
                    Daily Calories Goal:
                    <input type="text" name="Calories_Goal" placeholder="Enter Daily Calories Goal">
                    <br>

</div>
<br>    
<div class=container-3>
                    <input type="submit" name="submit" value="Create Account" class="button-orange2">
                    <input type="submit" name="submit" value="Login" class="button-orange2">

                </form>
                </div>


                    </div>
                </input>
            </div>
            <?php
require("connect-db.php");   
require("createMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['username']) ) {
     $_SESSION['username'] = NULL;
}
//$list_of_meals = getMeals();
//$user_print = $username
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['submit'] == "Create Account") 
  {
      $res = getCreateAccount($_POST['username']);
      echo $res[0]; 
      if (($res[0]) == 0){
      addUser($_POST['username'],password_hash($_POST['pwd'], PASSWORD_DEFAULT),$_POST['Calories_Goal']);
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['UserID'] = getUserID($_POST['username']);
      header('Location: index.php');
}
    else {
        header('Location: createAccount.php');
        echo "<span class='msg'>Username and password do not match our record</span> <br/>";

    }
      //$list_of_meals = getMeals();
  }
  else if ($_POST['submit'] =='Login') 
  {
    function reject($entry)
    {
    //    echo 'Please <a href="login.php">Log in </a>';
       exit();    // exit the current script, no value is returned
    }

    $exists = getUserLogin($_POST['username']);
    //echo password_verify($_POST['pwd'], '$2y$10$Vak/F6izTGQzAwOyvkuNKuVQFxMKfJKhLjbJLUSGYadsYZWJ7Oeda');

    $hashed = getHashPass($_POST['username'], $_POST['pwd']);
    echo $exists[0];

    if($exists[0] == 1 && $hashed == 1){
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0)
    {
       $user = trim($_POST['username']);
       if (!ctype_alnum($user))   // ctype_alnum() check if the values contain only alphanumeric data
          reject('User Name');
            
       if (isset($_POST['pwd']))
       {
          $pwd = trim($_POST['pwd']);
          if (!ctype_alnum($pwd))
             reject('Password');
          else
          {
             // set session attributes
             $_SESSION['user'] = $user;
             
    //       $hash_pwd = md5($pwd);
             $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    //       $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
             
             $_SESSION['pwd'] = $hash_pwd;
             $_SESSION['UserID'] = getUserID($_POST['username']);
             
             // redirect the browser to another page using the header() function to specify the target URL
             header('Location: index.php');
          }
       }
    }
  }
  
}
}
//session_start();
?>