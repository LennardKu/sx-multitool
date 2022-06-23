<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

error_reporting(E_ALL);
ini_set('display_errors', 'On');

/*
*   Get modal 
*/
if(isset($_GET['get_modal'])){

    $modal = new modal;
    $modal->head('Variable maken');

    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    $reload_function = "'global_variables'";
    $body = '';

    $body .= '<div class="container sx-form-wrapper">';
        $body .= '<form sx-form-uuid="'.$form_uuid.'" sx-sumbit-page="/global-variables/create_global_variable.php?confirm=true" reload="false" after-function="sx_reload_content('.$reload_function.')">'; 
        
            $body .= '<label for="name">Naam</label>';
            $body .= '<input type="text" id="name" name="name">';

            $body .= '<label for="slug">Slug</label>';
            $body .= '<input type="text" id="slug" name="slug">';

            $body .= '<label for="variable">Variable</label>';
            $body .= '<input type="text" id="variable" name="value">';
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

    $global_varibale = new global_variable(sx_database(),sx_database_global_values);
    $global_varibale->delete($id,'id'); // Delete

    echo 'success';
    exit;
}

/*
*   Edit 
*/
if(isset($_GET['edit'])){

    // Values
    $name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
    $slug = (isset($_POST['slug']) ? str_replace(' ','_',htmlspecialchars($_POST['slug'])) : '');
    $value = (isset($_POST['value']) ? htmlspecialchars($_POST['value']) : '');
    $id = (isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '');

    if(empty(trim($name)) || empty(trim($slug)) || empty(trim($value)) || empty(trim($id))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $check_variable = new global_variable(sx_database(),sx_database_global_values);
    $check_variable->update($name,'name','id',$id);

    $check_variable = new global_variable(sx_database(),sx_database_global_values);
    $check_variable->update($slug,'slug','id',$id);

    $check_variable = new global_variable(sx_database(),sx_database_global_values);
    $check_variable->update($value,'value','id',$id);

    echo 'success';
    

}

/*
*   Create variable 
*/
if(isset($_GET['confirm'])){

    // Values
    $name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
    $slug = (isset($_POST['slug']) ? str_replace(' ','_',htmlspecialchars($_POST['slug'])) : '');
    $value = (isset($_POST['value']) ? htmlspecialchars($_POST['value']) : '');

    // Check if all is filled in 
    if(empty(trim($name)) || empty(trim($slug)) || empty(trim($value))){ echo 'fill_in_all_data'; exit; } // Not all data filled in

    $check_variable = new global_variable(sx_database(),sx_database_global_values);
    $variable_exists = $check_variable->get_variable($slug);
        
    if($variable_exists){ echo 'slug_exists'; exit; } // Slug exists

    // Create variable 
    $create_variable = new global_variable(sx_database(),sx_database_global_values);
    $create_variable->create_variable($name,$slug,$value);

    // Variable created
    echo 'success';
    exit;

}