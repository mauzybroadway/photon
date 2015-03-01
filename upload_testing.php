<?php
if (!$_POST['submit']) {
	echo "please fill out all of the form";
	header('Location: upload.html');
}

$allowedExts = array("gif", "jpeg", "jpg", "png");
$file_size = 400000000;
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$type = strtolower($_FILES["file"]["type"]);
$image_id = $_FILES["file"]["name"];

if($_FILES["file"]["size"] > $file_size){
	echo "File size too big";
	header('Location: index.php');	
}

/******* File upload size is 20kb ********/
if ((($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/jpg") 
|| ($type == "image/pjpeg") || ($type == "image/x-png") || ($type == "image/png")) 
&& ($_FILES["file"]["size"] < $file_size) && in_array($extension, $allowedExts)) {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	} else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		if (file_exists("images/" . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
		} else {
			move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $image_id);
			echo "Stored in: " . "images/" . $image_id;
		}
	}
} else {
	
	header('Location: index.php');	
}


?>