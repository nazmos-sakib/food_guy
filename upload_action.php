
<?php
$rand_var = 92;//rand(10,100);
echo $rand_var;
//$folder_name = mkdir("uploads/".$rand_var);
$target_dir = "uploads/".$rand_var."/";
if (!file_exists($target_dir)) {
    //mkdir("folder/" . $dirname, 0777);
	echo "The directory do not exists.";
    //exit;
} else {
	echo "The directory exists.";
}
//return;
//
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$extension = end(explode(".", $target_file));
$extension = strtolower(substr(strrchr($_FILES["fileToUpload"]["name"], '.'), 1));
$target_file = $target_dir .  "newihmage".".".$extension;


echo "<pre>";
var_dump($_FILES);
echo "</pre>";
//return;


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} 
	else 
	{
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

// Check if file already exists
if (file_exists($target_file)) 
{
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) 
{
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) 
{
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
	echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else 
{
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	} 
	else 
	{
		echo "Sorry, there was an error uploading your file.";
	}
}
?>
