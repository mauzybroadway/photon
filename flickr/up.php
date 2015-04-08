<?php


$error=0;
$f = null;
$allowedExts = array("gif", "jpeg", "jpg", "png");
$file_size = 400000000;
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$type = strtolower($_FILES["file"]["type"]);
$image_id = md5($poster_id . $_FILES["file"]["name"]);

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

		
		move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $image_id);
		echo "Stored in: " . "images/" . $image_id;
		
	}
} 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Photon</title>
   
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="style.css" type="text/css">
   <style>
   	</style>
   
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Photo Uploader Using Flickr</h1></div>
   <div id="bd" role="main">
   <div id="mainbar" class="yui-b">	  

<?php
if (isset($_POST['name']) && $error==0) {
    echo ' <h2>Your file has been uploaded to the site to <a href="http://www.skaben.ja/images/'. $_POST['name'].'">here</a> </h2>';
}else {
    if($error == 1){
        echo "  <font color='red'>Please provide both name and a file</font>";
    }else if($error == 2) {
        echo "  <font color='red'>Unable to upload your photo, please try again</font>";
    }else if($error == 3){
        echo "  <font color='red'>Please upload JPG, JPEG, PNG or GIF image ONLY</font>";
    }else if($error == 4){
        echo "  <font color='red'>Image size greater than 512KB, Please upload an image under 512KB</font>";
    }
?>
  <h2>Upload your Pic!</h2>
  <form  method="post" accept-charset="utf-8" enctype='multipart/form-data'>
    <p>Name: &nbsp; <input type="text" name="name" value="" ></p>
    <p>Picture: <input type="file" name="file"/></p>
   <p><input type="submit" value="Submit"></p>
  </form>
  <?php
}
?>
	    </div>
    </div>
    <div id="ft"><p></p></div>
</div>
</body>
</html>
