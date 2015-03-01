<?php

//Include phpFlickr
require_once("includes/phpFlickr.php");


function uploadPhoto($path, $title) {
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
?>
