<?php

$record_id = isset($_POST['record_id']) && !empty($_POST['record_id']) ? $_POST['record_id'] :'';
$widget = isset($_POST['widget']) && !empty($_POST['widget']) ? $_POST['widget'] :'';

function deleteRecord($widget,$record_id){
    if (!$widget || $record_id) echo "-1";

    Global $wpdb ,$wp_registered_widgets;
    print_r($wp_registered_widgets);

    // $wpdb->prepare("SELECT option_value FROM wp_options WHERE `option_name`='widget_postgenerator_widget'")
}

print_r("123") ;





