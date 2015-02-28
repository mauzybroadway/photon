<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '34bb76a2a193945123756ef689d2e9ef';
$secret = '4a6d997a30a3323f';
$phpFlickrObj = new phpFlickr($api_key, $secret);
$phpFlickrObj->setToken('72157650674565869-26aab524369f6222');
$phpFlickrObj->auth("write");
/*---------------------------------------*/


// Get user information
$user = $phpFlickrObj->people_findByUsername('ph0ton1');
$user_url = $phpFlickrObj->urls_getUserPhotos($user['id']);
$photos = $phpFlickrObj->people_getPublicPhotos($user['id'], NULL, NULL, 4);


foreach ($photos['photos']['photo'] as $photo)
{
  echo '<a href="'.$user_url.$photo['id'].'" title="'.$photo['title'].' (on Flickr)" target="_blank">';
  echo '<img alt="'.$photo['title'].'" src="'.$phpFlickrObj->buildPhotoURL($photo, "square").'" />';
  echo '</a>';
}

return $phpFlickrObj->async_upload("photo1.jpg");

?>