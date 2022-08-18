<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

$message = (isset($_POST['message']) ? stripslashes($_POST['message']) : '');
$style = (isset($_POST['style']) ? stripslashes($_POST['style']) : '');

echo $message;
echo '<style>'.$style.'</style>';