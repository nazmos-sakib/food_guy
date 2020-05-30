<!DOCTYPE html>
<html>
<head>
	<?php
	require('../includes/dataProcess.php');
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
	$food_nameErr  = $category_idErr = $sub_category_idErr = $cuisine_idErr = $restaurant_id = $descriptionErr = $priceErr = $availableErr = $image_uploadErr = "";
	$food_name = $category_id = $sub_category_id = $cuisine_id = $restaurant_idErr = $description = $price = $available = "";

	$flag = 0;

	
	if(isset($_SESSION['admin_email']))
	{

		
		echo '<br>Wellcome '.$_SESSION['admin_email'];

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{

//-------field 01 : food name

			if (empty($_POST["food_name"])) 
			{
				$food_nameErr = "food Name is required";
				$flag = 1;
			} 
			else
			{
				$food_name = test_input($_POST["food_name"]);
		        // check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z0-9  ,  .;&-_]*$/",$food_name)) 
				{
					$food_nameErr = "Only letters and white space allowed";
					$flag = 1;
				}
			}


//-------field 02 : category

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


//-------field 03 : sub category
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
			


//-------field 04 : cuisine id

			if (!empty($_POST["cuisine_id"])) 
			{
				$sub_category_id = test_input($_POST["cuisine_id"]);
		        // check if name only contains letters and whitespace
				if (!preg_match('/^[0-9]*$/',$cuisine_id)) 
				{
					$cuisine_idErr = "something wrong";
					$flag = 1;
				}
			}
			else
			{
				$cuisine_idErr = "select a category";
				$flag = 1;
			}


//-------field 05 : restaurant id

			if (!empty($_POST["restaurant_id"])) 
			{
				$restaurant_id = test_input($_POST["restaurant_id"]);
		        // check if name only contains letters and whitespace
				if (!preg_match('/^[0-9]*$/',$restaurant_id)) 
				{
					$restaurant_idErr = "something wrong";
					$flag = 1;
				}
			}
			else
			{
				$restaurant_idErr = "select a category";
				$flag = 1;
			}



//-------field 06 : description
			if (empty($_POST["description"])) 
			{
				$descriptionErr = "food Name is required";
				$flag = 1;
			} 
			else
			{
				$description = test_input($_POST["description"]);
		        // check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z0-9  ,  .;&-_!]*$/",$description)) 
				{
					$descriptionErr = "Only letters, number , white space comma and fullstops are allowed";
					$flag = 1;
				}
			}

//-------field 07 : price
			if (empty($_POST["price"])) 
			{
				$priceErr = "food Name is required";
				$flag = 1;
			} 
			else
			{
				$price = test_input($_POST["price"]);
		        // check if name only contains letters and whitespace
				if (!preg_match("/^[0-9 . ]*$/",$price)) 
				{
					$priceErr = "Only number is allowed";
					$flag = 1;
				}
			}

//-------field 08 : available
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
//---------image validation
			
			$dir = $restaurant_id;
			$path = "../Image/".$dir."/";
			
			$uploadOk = 0;
			$is_image_atached = 0;
			$image_id = "";

			if (file_exists($path)) 
			{
				if (!empty($_FILES["fileToUpload"]["name"])) 
				{
					$is_image_atached = 1;
					
					$extension = strtolower(substr(strrchr($_FILES["fileToUpload"]["name"], '.'), 1));
					

					require_once('../includes/dataBase.php');

					$db = new database();
					$image_id = $db->get_last_image_number() + 1;

					$image_name = $dir."_" . $image_id;
					
					$target_file = $path . $image_name .".". $extension;
					
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						$image_uploadErr = "File is an image - " . $check["mime"] . ".";
						$uploadOk = 0;
					} 
					else 
					{
						$image_uploadErr = "File is not an image.";
						$uploadOk = 1;
					}


					// Check if file already exists
					if (file_exists($target_file)) 
					{
						$image_uploadErr = "Sorry, file already exists.";
						$uploadOk = 1;
					}

					// Check file size 5MB
					if ($_FILES["fileToUpload"]["size"] > 500000) 
					{
						$image_uploadErr = "Sorry, your file is too large.";
						$uploadOk = 1;
					}

					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) 
					{
						$image_uploadErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 1;
					}



					
				}
				else
				{
					$image_uploadErr = "no file";
				}

				
			}
			else
			{
				
			}

//---------database insert
			if($flag == 0 && $uploadOk == 0)
			{

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
					$image_uploadErr = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} 
				else 
				{
					$image_uploadErr = "Sorry, there was an error uploading your file.";
				}

				require_once('../includes/dataBase.php');

				$db = new database();
			
				$db->insert_food_item($food_name, $category_id, $sub_category_id, $cuisine_id, $image_id, $restaurant_id, $description, $price, $available);

				if ($is_image_atached == 1) 
				{
					$db->insert_into_image_table($image_name .".". $extension);
				}

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
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">  

		01. Food Name: <input type="text" name="food_name" value="<?php echo $food_name;?>">
		<span class="error">* <?php echo $food_nameErr;?></span>
		<br><br>



		02. Select category of the food:
		<select name = "category_id">
			<option value ="">Select one</option>";
			<?php 
			require_once('../includes/dataBase.php');

			$db = new database();
			$result = $db->fetch_category_list();

			while($row = $result->fetch_assoc()) 
			{
				echo "<option value =" .$row["category_id"].">".$row["category_name"]."</option>";

			}
			?>
		</select>
		<span class="error">* <?php echo $category_idErr;?></span>
		<br><br>
		


		03. Select second category of the food:(you can live it blank): 
		<select name = "sub_category_id">
			<option value ="">Select one</option>";
			<?php 
			require_once('../includes/dataBase.php');

			$db = new database();
			$result = $db->fetch_category_list();

			while($row = $result->fetch_assoc()) 
			{
				echo "<option value =" .$row["category_id"].">".$row["category_name"]."</option>";
			}
			
			?>
		</select>
		<span class="error">* <?php echo $sub_category_idErr;?></span>
		<br><br>
		

		04. Select cuisine category
		<select name = "cuisine_id">
			<option value ="">Select one</option>";
			<?php 
			require_once('../includes/dataBase.php');

			$db = new database();
			$result = $db->fetch_cuisine_list();

			while($row = $result->fetch_assoc()) 
			{
				echo "<option value =" .$row["cuisine_id"].">".$row["cuisine_name"]."</option>";
			}
			
			?>
		</select>
		<span class="error">* <?php echo $cuisine_idErr;?></span>
		<br><br>

		
		05. select restaurant name
		<select name = "restaurant_id">
			<option value ="">Select one</option>";
			<?php 
			require_once('../includes/dataBase.php');

			$db = new database();
			$result = $db->fetch_restaurant_list();

			while($row = $result->fetch_assoc()) 
			{
				echo "<option value =" .$row["restaurant_id"].">".$row["restaurant_name"]."</option>";
			}
			
			?>
		</select>
		<span class="error">* <?php echo $restaurant_idErr;?></span>
		<br><br>






		06. Food Description: <input type="text" name="description" value="<?php echo $description;?>">
		<span class="error">* <?php echo $descriptionErr;?></span>
		<br><br>


		07. price: <input type="number"  step="any" name="price" value="<?php echo $price;?>">
		<span class="error">* <?php echo $priceErr;?></span>
		<br><br>

		08. is food available?: 
		<br>
		<input type="radio" id="yes" name="available" value="yes" <?php echo ($available == 1) ?  "checked=\"checked\"" : "" ; ?> >
		<label for="yes">Yes</label><br>
		<input type="radio" id="no" name="available" value="no"  >
		<label for="no">No</label><br>
		<span class="error">* <?php echo $availableErr;?></span>
		<br><br>
		
		09. Please upload a good picture of your food:
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<br>
		<span class="error">* <?php echo $image_uploadErr;?></span>
		<br>

		<br>
		<input type="submit" name="submit" value="Submit">  
		<br>
		<button type="reset" value="Reset">Reset</button>
	</form>

	<br><br>
	<a href="index.php">cancle</a>
	<br>
	<div>
		<img src="../Image/3/3_4.jpg" style="height: 200px; width: 10%">
	</div>
	<br>

</body>
</html>