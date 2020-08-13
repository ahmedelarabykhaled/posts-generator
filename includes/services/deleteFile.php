<?php

// require_once("/var/www/html/subCat/wp-content//wp-load.php");
$record_id = isset($_POST['record_id']) && !empty($_POST['record_id']) ? $_POST['record_id'] :'';
$widget_base = isset($_POST['widget_base']) && !empty($_POST['widget_base']) ? $_POST['widget_base'] :'';
$current_widget_id = isset($_POST['current_widget_id']) && !empty($_POST['current_widget_id']) ? $_POST['current_widget_id'] :'';

// global $wpdb;
// echo $wpdb->dbname;
echo "123";
// $widget_instances = get_option($widget_base);
// $current_widget = $widget_instances[$current_widget_id];
// print_r($current_widget_id);

// function delete_record($widget_base,$current_widget_id,$record_id){
// echo "islam server";
//     // if (!$widget_base || $current_widget_id || $record_id) echo "-1";

//     // $widget_instances = get_option($widget_base);
//     // $current_widget = $widget_instances[$current_widget_id];
//     // update_option('widget_'.$this->id_base,$widget_instances);

//     // print_r($current_widget);
// }

// add_action( 'wp_ajax_delete_record', 'delete_record' );
// add_action( 'wp_ajax_nopriv_wp_ajax_delete_record', 'delete_record' );





