
<!DOCTYPE HTML>  
<html>
<head>
    <?php
    require('dataProcess.php');
    ?>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$first_nameErr = $last_nameErr = $restaurant_nameErr = $city_listErr = $restaurant_addressErr = $pn_numberErr = $emailErr =  $passErr = $con_passErr = "";
$first_name = $last_name = $restaurant_name = $city_list = $restaurant_address = $pn_number = $email = $pass = $con_pass = "";

$flag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

//-------field 1 : first name

    if (empty($_POST["first_name"])) 
    {
        $first_nameErr = "First Name is required";
        $flag = 1;
    } 
    else
    {
        $first_name = test_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) 
        {
          $first_nameErr = "Only letters and white space allowed";
          $flag = 1;
        }
    }

//-------field 2 : last name

    if (empty($_POST["last_name"])) 
    {
        $last_nameErr = "Last Name is required";
        $flag = 1;
    } 
    else 
    {
        $last_name = test_input($_POST["last_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) 
        {
            $last_nameErr = "Only letters and white space allowed";
            $flag = 1;
        }
    }

//-------field 3 : restaurant name

    if (empty($_POST["restaurant_name"])) 
    {
        $restaurant_nameErr = "restaurant_name is required";
        $flag = 1;
    } 
    else 
    {
        $restaurant_name = test_input($_POST["restaurant_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$restaurant_name)) 
        {
            $restaurant_nameErr = "Only letters and white space allowed";
            $flag = 1;
        }
    }

//-------field 4 : city

    if (empty($_POST["city_list"])) 
    {
        $city_listErr = "city_list is required";
        $flag = 1;
    } 
    else 
    {
        $city_list = test_input($_POST["city_list"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[0-9]*$/',$city_list)) 
        {
            $city_listErr = "something wrong";
            $flag = 1;
        }
    }

//-------field 5 : restaurant address    

    if (empty($_POST["restaurant_address"])) 
    {
        $restaurant_addressErr = "restaurant_address is required";
        $flag = 1;
    } 
    else 
    {
        $restaurant_address = test_input($_POST["restaurant_address"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z , ]*$/",$restaurant_address)) 
        {
            $restaurant_addressErr = "Only letters and white space allowed";
            $flag = 1;
        }
    }

//-------field 6 : Phone Number   

    if (empty($_POST["pn_number"])) 
    {
        $pn_numbertErr = "Phone Number is required";
        $flag = 1;
    } 
    else 
    {
        $pn_number = test_input($_POST["pn_number"]);
        // check if name only contains letters and whitespace
        if (!preg_match('/^[0-9]*$/',$pn_number)) 
        {
            $pn_numberErr = "something wrong. Please provide actual phonenumber without country code";
            $flag = 1;
        }
    }

//-------field 7 : Email

    if (empty($_POST["email"])) 
    {
        $emailErr = "Email is required";
        $flag = 1;
    } 
    else 
    {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $emailErr = "Invalid email format";
            $flag = 1;
        }
    }

//-------field 8&9 :  password & conform password

    if (!empty($_POST["pass"]) && !empty($_POST["con_pass"])) 
    {
        $pass = test_input($_POST["pass"]);
        $con_pass = test_input($_POST["con_pass"]);

        if(strlen($pass)<8)
        {
            $passErr = "Password length atlest 8 character";
            $flag = 1;
        }

        if(!strnatcmp($pass,$con_pass) == 0)
        {
            $con_passErr = $passErr = "Both Password and Conform Password have to be same";
            //$con_passErr = "Both Password and Conform Password have to be same";
            $flag = 1;
        }
        
    } 
    else 
    {
        $con_passErr = $passErr = "Both Password and Conform Password required";
        //$con_passErr = "Both Password and Conform Password required";
        $flag = 1;
    }

//---------database insert
    if($flag == 0)
    {
        require_once('dataBase.php');

        $db = new database();

        if($db->check_email($email))
        {
            $db->insert_restaurant_owner($first_name, $last_name, $restaurant_name, $city_list, $restaurant_address, $pn_number, $email, $pass);
            //echo 'email not found'; 
            header("location:login.php?succ=1");
            die();
        }
        else
        {
            $emailErr = "Email alrady exist";
        }

    }
}

?>

<h2>Regester Page</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  First Name: <input type="text" name="first_name" value="<?php echo $first_name;?>">
  <span class="error">* <?php echo $first_nameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="last_name" value="<?php echo $last_name;?>">
  <span class="error">* <?php echo $last_nameErr;?></span>
  <br><br>
  Restaurant Name: <input type="text" name="restaurant_name" value="<?php echo $restaurant_name;?>">
  <span class="error">* <?php echo $restaurant_nameErr;?></span>
  <br><br>

  Area:
   <select name = "city_list">
    <?php 
  require_once('dataBase.php');

  $db = new database();
  $result = $db->city_list();

    while($row = $result->fetch_assoc()) 
    {
      echo "<option value =" .$row["city_id"].">".$row["city_name"]."</option>";
    }
    ?>
  </select>
   <br><br>

  Restaurant Address: <input type="text" name="restaurant_address" value="<?php echo $restaurant_address;?>">
  <span class="error">* <?php echo $restaurant_addressErr;?></span>
  <br><br>

  Contract Number: <input type="number" name="pn_number" value="<?php echo $pn_number;?>">
  <span class="error">* <?php echo $pn_numberErr;?></span>
  <br><br>

  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password: <input type="Password" name="pass" value="" placeholder="**********">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  Conform Password: <input type="Password" name="con_pass" value="" placeholder="**********">
  <span class="error">* <?php echo $con_passErr;?></span>
  <br><br>
  <br>
  <input type="submit" name="submit" value="Submit">  
</form>

<p><a href="login.php">login</a></p>


</body>
</html>
