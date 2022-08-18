<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

$key = (isset($_POST['key']) ? htmlspecialchars($_POST['key']) : '');
$state = (isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '');
$state = ($state == 'true' ? 'true' : 'false');

if(empty(trim($state)) || empty(trim($key))){ echo 'error'; exit; } // Not all data supplied

/*
*   Change cookie message
*/
if($key == 'change_cookie_message'){

    $cookie_message = new cookie_message;
    $cookie_message->update($state,'status');
    
    exit;
}

echo 'error';