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
    $modal->head('Scripts');

    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    $reload_function = "'get_scripts'";
    $body = '';

    $body .= '<div class="container sx-form-wrapper">';
        $body .= '<form sx-form-uuid="'.$form_uuid.'" sx-sumbit-page="/global-variables/insert_script.php?confirm=true" reload="false" after-function="sx_reload_content('.$reload_function.')">'; 
        
            $body .= '<label for="name">Naam</label>';
            $body .= '<input type="text" id="name" name="name">';

            $body .= '<label for="variable">Script</label>';
            $body .= '<textarea type="text" id="variable" height="300px" name="script"></textarea>';

            $body .= '<label for="name">Of</label>';
            $body .= '<hr>';
            $body .= '<label for="name">Upload script</label>';
            $body .= '<input type="file" id="file" name="file" accept=".js">';

            $body .= '<input type="checkbox" id="include_header" name="header">';
            $body .= '<label for="include_header">Header</label>';

        $body .= '</form>';
    $body .= '</div>';

    $footer = '<button sx-submit-form="'.$form_uuid.'" right>Opslaan</button>';

    $modal->body($body);
    $modal->footer($footer);

    echo $modal->get_modal();

}

/*
*   
*/
if(isset($_GET['confirm'])){
    
    $name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
    $location = (isset($_POST['header']) ? 'header' : 'footer');

    $script_content = $_POST['script'];

    if(empty(trim($name))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $url = '';
    if(isset($_FILES['file']) && $_FILES['file']['size'] !== 0){
        $upload = new sx_upload($_FILES['file'],array('js'),$name);
        $upload->create_file();
        $url = $upload->get_file_information()['complete_url'];
    }

    $create_script = new global_variable(sx_database(),sx_database_scripts);
    $create_script->create_script($name,$script_content,$url,$location);

    echo 'success';
}