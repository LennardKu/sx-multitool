<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

/*
*   Get modal 
*/
if(isset($_GET['get_modal'])){

    $modal = new modal;
    $modal->head('Variable maken');

    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

    $body = '<form sx-form-uuid="'.$form_uuid.'" reload="false">'; 
        $body .= '';
    $body .= '</form>';

    $footer = '<button sx-submit-form="'.$form_uuid.'">Opslaan</button>';

    $modal->body($body);
    $modal->footer($footer);

    echo $modal->get_modal();

}
