<?php
  // Add Scripts
add_action('admin_enqueue_scripts', 'pg_add_scripts');
function pg_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('pg-main-style', plugins_url(). '/posts-generator/assets/css/style.css');
    wp_enqueue_style( 'dashicons' );
    // Add Main JS  
    wp_enqueue_script('pg-main-script', plugins_url(). '/posts-generator/assets/js/main.js',[jquery],'1.0.0',true);
}

// Adding Admin Scripts
add_action('admin_enqueue_scripts', 'pg_add_admin_scripts');
function pg_add_admin_scripts($hook){

  // if( 'widgets.php' != $hook ) return;

  wp_enqueue_style('pg-admin-style',
      plugins_url(). '/posts-generator/assets/css/admin.css'
  );
  
  wp_enqueue_script( 'ajax-script',
      plugins_url() .'/posts-generator/assets/js/admin.js',
      array( 'jquery' ),
      '',
      true
  );

  wp_localize_script( 'ajax-script', 'my_ajax_obj', array(
    'ajax_url' => admin_url( 'admin-ajax.php' ),
    'nonce'    => wp_create_nonce( 'title_example' ), // It is common practice to comma after
  ) );                // the last array item for easier maintenance    

}

// Adding Front Scripts
add_action('wp_enqueue_scripts','pg_add_front_scripts');
function pg_add_front_scripts(){
  wp_enqueue_style('pg-front-style',
    plugins_url(). '/posts-generator/assets/css/front.css'
  );

  wp_enqueue_script( 'ajax-script-fr',
    plugins_url() .'/posts-generator/assets/js/front.js',
    array( 'jquery' ),
    '',
    true
  );

  wp_localize_script( 'ajax-script-fr', 'my_ajax_obj', array(
    'ajax_url' => admin_url( 'admin-ajax.php' ),
    'nonce'    => wp_create_nonce( 'title_example' ), // It is common practice to comma after
  ) );                // the last array item for easier maintenance    

}