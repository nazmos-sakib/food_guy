<!DOCTYPE html>
<html>
<head>
	<?php
   		require('dataProcess.php');
    ?>
	<title></title>

	<style>
.error {color: #FF0000;}
</style>			
</head>
<body>

	<h1>add food item</h1>




	<a href="logout.php">logout</a>
<br><br><br>

<?php
   ob_start();
   session_start();
   // define variables and set to empty values
	$food_nameErr  = $category_idErr = $sub_category_idErr = $descriptionErr = $priceErr = $availableErr = "";
	$food_name = $category_id = $sub_category_id = $description = $price = $available = "";

	$flag = 0;


   if(isset($_SESSION['email']))
   {

 
   		echo '<br>Wellcome '.$_SESSION['email'];

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

//-------field 1 : food name

		    if (empty($_POST["food_name"])) 
		    {
		        $food_nameErr = "food Name is required";
		        $flag = 1;
		    } 
		    else
		    {
		        $food_name = test_input($_POST["food_name"]);
		        // check if name only contains letters and whitespace
		        if (!preg_match("/^[a-zA-Z ]*$/",$food_name)) 
		        {
		          $food_nameErr = "Only letters and white space allowed";
		          $flag = 1;
		        }
		    }


//-------field 2 : category

		    if (empty($_POST["category_id"])) 
		    {
		        $category_idErr = "select a category";
		        $flag = 1;
		    } 
		    else 
		    {
		        $category_id = test_input($_POST["category_id"]);
		        // check if name only contains letters and whitespace
		        if (!preg_match('/^[0-9]*$/',$category_id)) 
		        {
		            $category_idErr = "something wrong";
		            $flag = 1;
		        }
		    }


//-------field 3 : sub category
		    if (!empty($_POST["sub_category_id"])) 
		    {
		        $sub_category_id = test_input($_POST["sub_category_id"]);
		        // check if name only contains letters and whitespace
		        if (!preg_match('/^[0-9]*$/',$sub_category_id)) 
		        {
		            $sub_category_idErr = "something wrong";
		            $flag = 1;
		        }
		    }

//-------field 4 : description
		    if (empty($_POST["description"])) 
		    {
		        $descriptionErr = "food Name is required";
		        $flag = 1;
		    } 
		    else
		    {
		        $description = test_input($_POST["description"]);
		        // check if name only contains letters and whitespace
		        if (!preg_match("/^[a-zA-Z  ,  . ]*$/",$description)) 
		        {
		          $descriptionErr = "Only letters , white space comma and fullstops are allowed";
		          $flag = 1;
		        }
		    }

//-------field 5 : price
		    if (empty($_POST["price"])) 
		    {
		        $priceErr = "food Name is required";
		        $flag = 1;
		    } 
		    else
		    {
		        $price = test_input($_POST["price"]);
		        // check if name only contains letters and whitespace
		        if (!preg_match("/^[0-9]*$/",$price)) 
		        {
		          $priceErr = "Only number is allowed";
		          $flag = 1;
		        }
		    }

//-------field 6 : available
		    if (empty($_POST["available"])) 
		    {
		        $availableErr = "select one";
		        $flag = 1;
		    } 
		    else
		    {
		        $available = test_input($_POST["available"]);

		        if ($available == "yes")
		        {
		        	$available = 1;
		        }
		        else
		        {
		        	$available = 0;
		        }
		    }

//---------database insert
		    if($flag == 0)
		    {
		        require_once('dataBase.php');
		        $restaurant_owner_email = $_SESSION['email'];

		        $db = new database();
		        $restaurant_id = $db->extract_restaurant_id($restaurant_owner_email);
	            $db->insert_food_item($food_name, $category_id, $sub_category_id, $restaurant_id, $restaurant_owner_email, $description, $price, $available);
	            //echo 'email not found'; 
	            header("location:index.php?succ_insert_item=1");
	            die();

		       
		    }



		}   																				
   }
   else
   {
   		header("location:login.php?not_succ=1");
   }

   
?>
<br><br>





<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  Food Name: <input type="text" name="food_name" value="<?php echo $food_name;?>">
  <span class="error">* <?php echo $food_nameErr;?></span>
  <br><br>



Select category of the food:
  <select name = "category_id">
  	<option value ="">Select one</option>";
    <?php 
	  require_once('dataBase.php');

	  $db = new database();
	  $result = $db->category_list();

	    while($row = $result->fetch_assoc()) 
	    {
	      echo "<option value =" .$row["category_id"].">".$row["category_name"]."</option>";

	    }
    ?>
  </select>
   <br><br>
  


Select second category of the food:(you can live it blank): 
  <select name = "sub_category_id">
  	<option value ="">Select one</option>";
    <?php 
	  require_once('dataBase.php');

	  $db = new database();
	  $result = $db->category_list();

	    while($row = $result->fetch_assoc()) 
	    {
	      echo "<option value =" .$row["category_id"].">".$row["category_name"]."</option>";
	    }
	    
    ?>
  </select>
   <br><br>





  Food Description: <input type="text" name="description" value="<?php echo $description;?>">
  <span class="error">* <?php echo $descriptionErr;?></span>
  <br><br>


  price: <input type="number" name="price" value="<?php echo $price;?>">
  <span class="error">* <?php echo $priceErr;?></span>
  <br><br>

  is food available?: 
  <br>
  <input type="radio" name="available" value="yes">
	<label for="male">Yes</label><br>
	<input type="radio" name="available" value="no">
	<label for="female">No</label><br>
  <span class="error">* <?php echo $availableErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<br><br>
<a href="index.php">cancle</a>

</body>
</html>