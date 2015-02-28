<?php

require_once("include/phpFlickr.php");

/*-------- Flickr Authentication --------*/
$api_key = '34bb76a2a193945123756ef689d2e9ef';
$secret = '4a6d997a30a3323f';
$phpFlickrObj = new phpFlickr($api_key, $secret);
$phpFlickrObj->setToken('72157647562248933-080a58d6c7d10d47');
$phpFlickrObj->auth("write");
/*---------------------------------------*/

// Get user information
$user = $phpFlickrObj->people_findByUsername('ph0ton');
$user_url = $phpFlickrObj->urls_getUserPhotos($user['id']);

// Collection where photo will be chosen from
$collection_id = "72157649478392860";

// Get array of photosets from collection
$results = $phpFlickrObj->collections_getTree($collection_id, $user['id']);
$photosets = $results['collections']['collection'][0]['set'];

// Get random photoset
$photoset = $photosets[rand(0, count($photosets) - 1)];
$photoset_id = $photoset['id'];
$photoset_title = $photoset['title'];

// Get random photo from photoset
$results = $phpFlickrObj->photosets_getPhotos($photoset_id);
$photos = $results['photoset']['photo'];
$photo = $photos[rand(0, count($photos) - 1)];

// Build out variables for HTML
$photo_link = $phpFlickrObj->buildPhotoURL($photo, "_k");
$album_name = $photoset_title;
$album_link = $user_url."sets/".$photoset_id."/";


?>