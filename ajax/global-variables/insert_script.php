<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
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

            $body .= '<label for="include_header"><input type="radio" id="include_header" name="location" value="header">Header</label>';
            $body .= '<br />';
            $body .= '<label for="include_Footer"><input type="radio" id="include_Footer" name="location" value="footer" checked>Footer</label>';
            $body .= '<br />';
            
        $body .= '</form>';
    $body .= '</div>';

    $footer = '<button sx-submit-form="'.$form_uuid.'" right>Opslaan</button>';

    $modal->body($body);
    $modal->footer($footer);

    echo $modal->get_modal();

}

/*
*   Delete value
*/
if(isset($_GET['delete_value'])){
    $id = (isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '');
    if(empty(trim($id))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $global_varibale = new global_variable(sx_database(),sx_database_scripts);
    $script_data = $global_varibale->get_variable($id,'id');
    
    if(!empty(trim($script_data['uploaded_script']))){
        unlink($_SERVER['DOCUMENT_ROOT'].$script_data['uploaded_script']);
    }

    $global_varibale->delete($id,'id'); // Delete

    echo 'success';

    exit;
}


/*
*   Confirm
*/
if(isset($_GET['confirm'])){
    
    $name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
    $location = (isset($_POST['location']) && $_POST['location'] == 'header' ? 'header' : 'footer');

    $script_content = stripslashes($_POST['script']);

    if(empty(trim($name))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $url = '';
    if(isset($_FILES['file']) && $_FILES['file']['size'] !== 0){
        $upload = new sx_upload($_FILES['file'],array('js'),$name);
        $upload->create_file();
        $url = str_replace(get_site_url(),'',$upload->get_file_information()['complete_url']);
    }

    $create_script = new global_variable(sx_database(),sx_database_scripts);
    $create_script->create_script($name,$script_content,$url,$location);
    echo 'success';
}

/*
*   Edit 
*/
if(isset($_GET['edit'])){

    // Values
    $name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
    $location = (isset($_POST['location']) && $_POST['location'] == 'header' ? 'header' : 'footer');
    $script_content = stripslashes($_POST['script']);
    $status = (isset($_POST['status']) ? 'active' : 'inactive');

    $id = (isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '');

    if(empty(trim($name)) || empty(trim($id))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $check_variable = new global_variable(sx_database(),sx_database_scripts);
    $check_variable->update($name,'name','id',$id);

    $check_variable = new global_variable(sx_database(),sx_database_scripts);
    $check_variable->update($script_content,'script_content','id',$id);

    $check_variable = new global_variable(sx_database(),sx_database_scripts);
    $check_variable->update($location,'location','id',$id);

    $check_variable = new global_variable(sx_database(),sx_database_scripts);
    $check_variable->update($status,'status','id',$id);

    echo 'success';
    exit;
}

