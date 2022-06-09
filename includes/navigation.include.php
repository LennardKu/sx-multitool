<?php

/*
* Navigation sx_multitool
*/
function sx_multitool_navigation(){
   
    // Menu 
    add_menu_page('Sx Multitool', 'Sx Multitool', 'manage_options', 'sx_multitool', 'sx_multitool_information',plugins_url('/sx-multitool/img/icon.svg',__DIR__));
    

    // Style  
    wp_enqueue_style('sx_development_style', plugins_url('/sx-development/src/css/style.css',__DIR__) );
 
    // Js 
    wp_enqueue_script(' js', plugins_url('/sx-development/src/js/main.js',__DIR__) , ['jquery']);

    // Submenu 
    add_submenu_page( 'sx_multitool', 'Standaard waarden', 'Standaard waarden', 'manage_options', 'sx_multitool_global_variables', 'sx_multitool_global_variables');
    add_submenu_page( 'sx_multitool', 'Documenten ', 'Documenten', 'manage_options', 'sx_multitool_documents', 'sx_multitool_documents');


} add_action('admin_menu', 'sx_multitool_navigation');


/*
*   Information Panel
*/
function sx_multitool_information(){
    // Include panel 
    require sx_multitool_plugin_path().'panels/information.panel.php';
}

/*
*   Global variables
*/
function sx_multitool_global_variables(){
    // Include panel 
    include 'panels/global-variables.panel.php';
}

/*
*   Documents
*/
function sx_multitool_documents(){
    // Include panel 
    include 'panels/documents.panel.php';
}



