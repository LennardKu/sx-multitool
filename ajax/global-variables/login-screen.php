<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access



$colors = $_POST['color'];

if(is_array($colors)){
    foreach($colors as $key => $value){
        $setColors = new sx_login_screen;

        $key = explode('@',$key);

        // Check if item already exists 
        if($setColors->check_item($key[0])){
            $setColors->update_item($key[0],'value',$value);
            continue;
        }
        $setColors->create_item($key[0],$value,$key[1]);
    }
}


$url = '';
if(isset($_FILES['logo']) && $_FILES['logo']['size'] !== 0){
    $name = 'logo-login';
    $upload = new sx_upload($_FILES['logo'],array('jpg','png','gif','svg','jpeg'),$name);
    $upload->create_file();
    $url = str_replace(get_site_url(),'',$upload->get_file_information()['complete_url']);

    // Check if item already exists 
    if($setColors->check_item('logo')){
        $setColors->update_item('logo','value',$url);
    }else{
        $setColors->create_item('logo',$url,'background-image');

    }
}

echo 'success';