<?php

require_once("/var/www/html/subCat/wp-load.php");
require_once("/var/www/html/subCat/wp-config.php");

$record_id = isset($_POST['record_id']) && $_POST['record_id'] !== '0' ? (string)$_POST['record_id'] :'0';
$widget_base = isset($_POST['widget_base']) && !empty($_POST['widget_base']) ? $_POST['widget_base'] :'';
$current_widget_id = isset($_POST['current_widget_id']) && !empty($_POST['current_widget_id']) ? $_POST['current_widget_id'] :'';


function delete_record($widget_base,$current_widget_id,$record_id){
    if (!$widget_base || !$current_widget_id) die('-1'); 

    $widget_instances = get_option($widget_base);
    $current_widget = $widget_instances[$current_widget_id];

    unset($current_widget['records'][$record_id]);

    $widget_instances[$current_widget_id] = $current_widget;

    update_option($widget_base,$widget_instances);
    
    die('0');
}

delete_record($widget_base,$current_widget_id,$record_id);







