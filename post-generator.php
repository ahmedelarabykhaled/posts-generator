<?php
/*
Plugin Name: Post Generator 
Author: Islam Hanafi
*/

// Exit if accessed directly
if(!defined('ABSPATH'))exit;

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/post-generator-scripts.php');

// Services and Ajax handlers
require_once(plugin_dir_path(__FILE__).'/services/delete-record.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/class-PostGenerator.php');


// Register Widget
function register_PostGenerator(){
  register_widget('PostGenerator');
}

// Hook in function
add_action('widgets_init', 'register_PostGenerator');

