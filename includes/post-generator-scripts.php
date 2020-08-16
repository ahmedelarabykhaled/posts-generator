<?php
  // Add Scripts
  function pg_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('pg-main-style', plugins_url(). '/posts-generator/assets/css/style.css');
    wp_enqueue_style( 'dashicons' );
    // Add Main JS  
    wp_enqueue_script('pg-main-script', plugins_url(). '/posts-generator/assets/js/main.js',[jquery],'1.0.0',true);
  }

  