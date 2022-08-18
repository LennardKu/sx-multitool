<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

/*
*   Edit
*/
if(isset($_GET['edit'])){

    $message = (isset($_POST['message']) ? stripslashes($_POST['message']) : '');
    $style = (isset($_POST['style']) ? stripslashes($_POST['style']) : '');
    $accept = (isset($_POST['accept']) ? (!is_array($_POST['accept']) ? stripslashes($_POST['accept']) : '') : '');

    $cookie_message = new cookie_message;
    $cookie_message->update($message,'message');
    $cookie_message->update($style,'style');
    $cookie_message->update($accept,'accept');

    echo 'success';
    exit;
}