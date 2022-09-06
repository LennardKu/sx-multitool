<?php
/*
*  Plugin Name: Sx Multitool
*  Version: 1.0.0
*  Plugin Uri: https://github.com/LennardKu/sx-multitool/
*  Description: A sx plugin for managing data
*  Author: Sx development team
*  Author Uri:  https://simplix.nl
*/
$debug = true;

if(isset($debug) && $debug == true){ error_reporting(E_ALL); ini_set('display_errors', 'On'); } // Debug state

/*
*   Updater
*/
require 'plugin-update-checker/plugin-update-checker.php';

$SxMultitoolUpdateChecker = Puc_v4p13_Factory::buildUpdateChecker(
	'https://github.com/LennardKu/sx-multitool/',
	__FILE__,
	'sx-multitool'
);

$SxMultitoolUpdateChecker->SetBranch('main');


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

/*
*   Change login page
*/
function themeprefix_login_page() { 
    $login_page_style = new sx_login_screen;
    $login_page_style = $login_page_style->get_items();
    
    foreach($login_page_style as $style){
        if($style['slug'] == 'logo'){
            echo '<style> #login h1 a{ background-image:url('.get_site_url().$style['value'].');background-size:contain;max-width:280px;width:100%;}</style>';
            continue;
        }

        if($style['slug'] == 'background'){ // background
            echo '<style> body{ background-image:url('.get_site_url().$style['value'].') !important;background-size:cover !important;background-repeat:no-repeat}</style>';
            continue;
        }

        echo '<style>'.$style['slug'].'{'.$style['type'].':'.$style['value'].' !important}</style>';
    }

 }
add_action( 'login_enqueue_scripts', 'themeprefix_login_page' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Simplix';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// Cookie accept 
if(isset($_POST['sx-multitool-accept-cookie'])){
    setcookie('sx-multitool-accept-cookie',  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(25/strlen($x)) )),1,25), time() + (86400 * 356), "/"); // 86400 = 1 day
}