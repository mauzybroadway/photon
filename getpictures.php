<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '2da2f168f5d5d67c7532f39587cc9bdc';
$secret = '20ebde61b471bd0e';
$token = '';
$phpFlickrObj = new phpFlickr($api_key, $secret);
$phpFlickrObj->setToken($token);
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