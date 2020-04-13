
<!DOCTYPE HTML>  
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php
    require('dataProcess.php');
  ?>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<?php
   ob_start();
   session_start();

    if ( isset( $_SESSION['email'] ) ) 
    {
        header("location:index.php");
    } 
    else 
    {
        if(isset($_GET['not_succ']))
        {
            echo "<span class='error'>* log in to view index</span>";
        }

      
    }
?>



<?php
// define variables and set to empty values
$emailErr = $passErr = "";
$email = $pass = "";

$flag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $flag = 1;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $flag = 1;
    }
  }
   
  if (empty($_POST["password"])) {
    $passErr = "Password is required";
    $flag = 1;
  } else {
    $pass = test_input($_POST["password"]);
  } 

  if($flag == 0)
  {
    require_once('dataBase.php');

    $db = new database();
  
    if($db->restaurant_owner_login_authenticate($email,$pass))
    {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['email'] = $email;
        header("location:index.php?succ=1");
        die();
    }
    else
    {
      echo "<span class='error'>* Password or email incorrect</span>";
    }

  }
  
}


?>


<?php
    
    if(isset( $_GET['asd']))
    {
        echo 'signup success';
    }

      if(isset($_GET['logout_succ']))
        {
            echo "<span class='error'>* logout successful</span>";
        }

?>


<h2>Log In page</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    E-mail: <input type="text" name="email" value="<?php echo $email;?>" placeholder="abc@def.com">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Password: <input type="password" name="password" value="" placeholder="**********">
    <span class="error">* <?php echo $passErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">  
</form>
<a href="regester.php">sign up</a>
</body>
</html>
 