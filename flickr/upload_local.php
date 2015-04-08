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

/*********************************
  Writing to file for processing
*********************************/
$filename = 'comm/enterthevoid.pho';
$Content = $image_id . "\n";
 
echo "openning file\n";
$handle = fopen($filename, 'a') or die("can't open file");
//echo "clear";
// this clears the file
// ftruncate($handle, 0);
echo "writing to file\n";
fwrite($handle, $Content);
echo "closing file\n";
fclose($handle);

// EXECUTE PYTHON SCRIPT HERE

/*********************************
  wait for lines to come back
*********************************/
// wait for signal file, then delete it.
while (!file_exists("comm/signal.pho")) sleep(1);
unlink("comm/signal.pho");

$file = fopen("comm/exitthevoid.pho","r");
$picture_info = fgets($file);
fclose($file);

/*********************************
  upload to flickr
*********************************/
$parts = explode(":", $pizza);
$name_of_file = $parts[0];
$tags = $parts[1];

//Include phpFlickr
require_once("includes/phpFlickr.php");

$path = "images/".$name_of_file;
function uploadPhoto($path, $name_of_file) {
    $apiKey = "e429519b8f5703c57c6776a60dfc0583";
    $apiSecret = "81617fd7844165cf";
    $permissions  = "write";
    $token        = "72157650634145157-428e5e1a693b769d";

    $f = new phpFlickr($apiKey, $apiSecret, true);
    $f->setToken($token);
    return $f->async_upload($path, $title);
}


if (isset($_POST['name']) && $error==0) {
    echo "  <h2>Your file has been uploaded to <a href='http://www.flickr.com/photos/131602302@N05/' target='_blank'>Mauzy's photo stream</a></h2>";
}else {
	echo "<h2>Error uploading file</h2>";
}

/*********************************
  delete picture
*********************************/
unlink($path);


?>