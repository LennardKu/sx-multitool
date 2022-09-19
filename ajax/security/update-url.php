<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access


// Check if value exists 
$ChangeUrl = new sx_options;
if(!$ChangeUrl->check_item('LoginUrl')){
    $ChangeUrl->create_item('LoginUrl','beheer');
}

if($ChangeUrl->update_item('LoginUrl','value',str_replace('','',htmlspecialchars(trim($_POST['url']))))){
    echo 'success';
    exit;
}
