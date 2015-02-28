<?php
    /* Last updated with phpFlickr 1.4
     *
     * If you need your app to always login with the same user (to see your private
     * photos or photosets, for example), you can use this file to login and get a
     * token assigned so that you can hard code the token to be used.  To use this
     * use the phpFlickr::setToken() function whenever you create an instance of 
     * the class.
     */

    require_once("phpFlickr.php");
    $f = new phpFlickr("2da2f168f5d5d67c7532f39587cc9bdc", "20ebde61b471bd0e");
    
    //change this to the permissions you will need
    $f->auth("write");
    
    echo "Copy this token into your code: " . $_SESSION['phpFlickr_auth_token'];
    
?>