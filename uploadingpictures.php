<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '34bb76a2a193945123756ef689d2e9ef';
$secret = '4a6d997a30a3323f';
$phpFlickrObj = new phpFlickr($api_key, $secret);
$phpFlickrObj->setToken('72157650677930220-6f864764e9bc8e83');
$phpFlickrObj->auth("write");
/*---------------------------------------*/


// Get user information
$user = $phpFlickrObj->people_findByUsername('ph0ton1');
$user_url = $phpFlickrObj->urls_getUserPhotos($user['id']);


$result = $phpFlickrObj->sync_upload('images/photo1.jpg', null, null, 'mytag', 1);

?>