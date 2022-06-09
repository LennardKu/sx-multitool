<?php
/*
    Plugin Name: Sx Multitool
    Description: A sx plugin
    Author: Sx development team
    Version: 1.0
*/

$debug = true;

if(isset($debug) && $debug == true){ error_reporting(E_ALL); ini_set('display_errors', 'On'); } // Debug state

/*
*   Define Values 
*/
define('Sx_file_access',true);

/*
*   Standard Values 
*/
$sx_plugin_name = 'sx-multitool';
$version = '1.0';


/*
*   Auto include classes 
*/
foreach (glob($_SERVER['DOCUMENT_ROOT']."/wp-content/plugins/".$sx_plugin_name."/classes/*.class.php") as $filename){
    require_once($filename);
}

/*
*   Auto include functions 
*/
foreach (glob($_SERVER['DOCUMENT_ROOT']."/wp-content/plugins/".$sx_plugin_name."/functions/*.function.php") as $filename){
    require_once($filename);
}

/*
*   Activate scripts 
*   Database names
*/
foreach(glob(sx_plugin_path().'/activate/*.activate.php') as $activate_script){
    require_once($activate_script);
}

/*
*   Shortcodes
*/
foreach(glob(sx_plugin_path().'/shortcode/*.shortcode.php') as $activate_script){
    require_once($activate_script);
}

/*
*   Navigation
*/
include sx_plugin_path().'includes/navigation.include.php';
