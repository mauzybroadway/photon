<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
 $apiKey = "2da2f168f5d5d67c7532f39587cc9bdc";
 $apiSecret = "20ebde61b471bd0e";
 $permissions  = "write";
 $token        = "72157651080024282-414b3e85b1ba9a80";

 $f = new phpFlickr($apiKey, $apiSecret, true);
 $f->setToken($token);
 return $f->async_upload("photo1.jpg");
/*---------------------------------------*/

echo '<a href="http://www.google.com">googleeee3</a>';
?>