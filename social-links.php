<?php
/**
 * Plugin Name:Agv One Social Links
 * Description:Adds social icons with links to profile
 * Author:Andrei Agvan
 * Version:1.0
 */
if(!defined('ABSPATH')){
    exit;
}
require_once(plugin_dir_path(__FILE__).'/includes/social-links-scripts.php');
require_once(plugin_dir_path(__FILE__).'/includes/social-links-class.php');
function register_social_links(){
   register_widget('Social_Links_Widget');
}
add_action('widgets_init','register_social_links');