<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

$ChangeUrl = new sx_options;
if($ChangeUrl->update_item('LoginUrl','value',str_replace('','',htmlspecialchars(trim($_POST['url']))))){
    echo 'success';
    exit;
}
