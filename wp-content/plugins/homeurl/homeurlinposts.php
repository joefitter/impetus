<?php
/*
Plugin Name: Home URL in Posts
Plugin URI: http://joefitter.com
Description: Shortcode for including home url
Version: 1.0
Author: Joe Fitter
Author URI: http://joefitter.com
*/

function get_the_home_url(){
    return bloginfo("home");
}

add_shortcode( "home", "get_the_home_url" );