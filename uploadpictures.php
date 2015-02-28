<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '2da2f168f5d5d67c7532f39587cc9bdc';
$secret = '20ebde61b471bd0e';
$token = '72157651080024282-414b3e85b1ba9a80';
$phpFlickrObj = new phpFlickr($api_key, $secret, true);
$phpFlickrObj->setToken($token);
$phpFlickrObj->auth("write");
/*---------------------------------------*/

return $phpFlickrObj->async_upload("photo1.jpg");


echo '<a href="http://www.google.com">googleeee3</a>';
?>