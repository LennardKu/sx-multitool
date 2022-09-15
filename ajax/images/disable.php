<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access


/*
*   Delete  all disabled sizes
*/

$Disable = new sx_images;
$Disable->deleteItems('DisabledSize');

foreach($_POST['size'] as $disable){

    $Disable->createItem('DisabledSize',$disable);
}

// upload scripts 
if(isset($_POST['ownformat']) && is_array($_POST['ownformat'])){
    foreach($_POST['ownformat'] as $key => $format){
        if(empty(trim($format['name'])) || empty(trim($format['width'])) || empty(trim($format['height']))){ continue; }   
        $Disable->createItem('OwnFormat',$format['name'].'x'.$format['width'].'x'.$format['height']);
    }
}

echo 'success';