<?php

// Get slug 
function get_global_value($slug = ''){
    global $sx_database_global_values;
    global $wpdb;

    $query = $wpdb->get_var($wpdb->prepare("SELECT value FROM {$sx_database_global_values} WHERE slug='%s';", $slug ));
    return $query;
}

// Create value 
function sx_global_value_create($name = '',$slug = '',$value = ''){
    global $sx_database_global_values;
    global $wpdb;

    $data=array(
        'name' => $name, 
        'slug' => $slug, 
        'value' => $value, 
    );

     $wpdb->insert( $sx_database_global_values, $data);
}

