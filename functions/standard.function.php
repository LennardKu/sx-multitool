<?php

// Plugin path
function sx_plugin_path(){
    return $_SERVER['DOCUMENT_ROOT'].str_replace(get_site_url(),'',plugins_url('',__DIR__)).'/';
}


// Table exist 
function sx_table_exist($table_name = ''){
    global $wpdb;
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

    if ( ! $wpdb->get_var( $query ) == $table_name ) {
        return false;
    }

    return true;
}


// Create table 
function sx_create_table($table_name = '',$sql = ''){
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    if(empty(trim($sql))){return false;} // No sql set 

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    return dbDelta( $sql );
}
