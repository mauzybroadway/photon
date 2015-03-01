<?php

require_once("includes/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = 'e429519b8f5703c57c6776a60dfc0583';
$secret = '81617fd7844165cf';
$token = '72157650634145157-428e5e1a693b769d';
$phpFlickrObj = new phpFlickr($api_key, $secret);
$phpFlickrObj->setToken($token);
$phpFlickrObj->auth("write");
/*---------------------------------------*/



// Get user information
$user = $phpFlickrObj->people_findByUsername('mauzy_broadway');
$user_url = $phpFlickrObj->urls_getUserPhotos($user['id']);
//$photos = $phpFlickrObj->people_getPublicPhotos($user['id'], NULL, "testtag");

//Comma separated list of tags to search for
$input= str_replace(" ", "", $_POST['tag']);
$tags = "testtag";
$tags = $input;
$photos = $phpFlickrObj->people_getPhotos($user['id'], array("tags"=>$tags, "tag_mode"=>"any"));

foreach ($photos['photos']['photo'] as $photo)
{
  echo '<a href="'.$user_url.$photo['id'].'" title="'.$photo['title'].' (on Flickr)" target="_blank">';
  echo '<img alt="'.$photo['title'].'" src="'.$phpFlickrObj->buildPhotoURL($photo, "_k").'" />';
  echo '</a>';
}

?>