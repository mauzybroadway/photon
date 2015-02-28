<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '34bb76a2a193945123756ef689d2e9ef';
$secret = '4a6d997a30a3323f';
$token = '72157650633173817-dd6a9b907ada024d';
$phpFlickrObj = new phpFlickr($api_key, $secret, true);
$phpFlickrObj->setToken($token);
$phpFlickrObj->auth("write");
/*---------------------------------------*/

return $phpFlickrObj->async_upload("photo1.jpg");


echo '<a href="http://www.google.com">googleeee3</a>';
?>