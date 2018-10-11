<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */


// add-user-auth
require_once('./ext/include/user_login.php');
$cls= new User_login();
if($cls->check_login_forRoot()== false){
	header("Location: ./ext/user/");
	exit();
}

//
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
