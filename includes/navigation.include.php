<?php

/*
* Navigation sx_multitool
*/
function sx_multitool_navigation(){
    if ( current_user_can( 'manage_options' ) ) {

        // Menu 
        add_menu_page('Sx Multitool', 'Sx Multitool', 'manage_options', 'sx_multitool', 'sx_multitool_information',plugins_url('/src/images/Simplix-favicon.svg',__DIR__));

        // Style  
        wp_enqueue_style('sx_multitool_style', plugins_url('',__DIR__).'/src/css/style.css'  );

        // Submenu 
        add_submenu_page( 'sx_multitool', 'Standaard waarden', 'Standaard waarden', 'manage_options', 'sx_multitool_global_variables', 'sx_multitool_global_variables');
        add_submenu_page( 'sx_multitool', 'Afbeeldingen ', 'Afbeeldingen', 'manage_options', 'sx_multitool_images', 'sx_multitool_images');
        add_submenu_page( 'sx_multitool', 'Beveiliging ', 'Beveiliging', 'manage_options', 'sx_multitool_security', 'sx_multitool_security');

    }

} add_action('admin_menu', 'sx_multitool_navigation');


/*
*   Information Panel
*/
function sx_multitool_information(){
    // Include panel 
    require sx_plugin_path().'panels/information.panel.php';
}

/*
*   Global variables
*/
function sx_multitool_global_variables(){
    // Include panel 
    include sx_plugin_path().'panels/global-variables.panel.php';
}

/*
*   Security
*/
function sx_multitool_security(){
    // Include panel 
    include sx_plugin_path().'panels/security.panel.php';
}


/*
*   Security
*/
function sx_multitool_images(){
    // Include panel 
    include sx_plugin_path().'panels/images.panel.php';
}

