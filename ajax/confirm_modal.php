<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

$text = (isset($_GET['text']) ? htmlspecialchars($_GET['text']) : '');
$btn_uuid = (isset($_GET['btn_uuid']) ? htmlspecialchars($_GET['btn_uuid']) : '');

if(empty(trim($text)) || empty(trim($btn_uuid))){ echo 'error'; exit; } // Not all data supplied

$confirm_modal = new modal('small');
$confirm_modal->head($text);
$body = '';

$body .= '<button left sx-remove-modal="'.$confirm_modal->modal_information()['modal_uuid'].'" style="margin: auto;">Annuleren</button>'; 
$body .= '<button right not-important sx-remove-modal="'.$confirm_modal->modal_information()['modal_uuid'].'" confirmed="'.$btn_uuid.'" style="margin: auto;">Verwijderen</button>'; 

$confirm_modal->body($body);

echo $confirm_modal->get_modal();