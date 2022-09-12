<?php

// Plugin path
function sx_plugin_path($type = ''){
    return ($type == 'url' ? get_site_url() : $_SERVER['DOCUMENT_ROOT']).str_replace(get_site_url(),'',plugins_url('',__DIR__)).'/';
}


// Table exist 
function sx_standard_table_exist($table_name = ''){
    global $wpdb;
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

    if ( ! $wpdb->get_var( $query ) == $table_name ) {
        return false;
    }

    return true;
}


// Create table 
function sx_standard_create_table($table_name = '',$sql = ''){
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    if(empty(trim($sql))){return false;} // No sql set 

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    return dbDelta( $sql );
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return (rand(1,2) == 1 ? 'd' : 'a').$randomString;
}