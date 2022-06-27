<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

$edit_data = (isset($_GET['edit_data']) ? htmlspecialchars($_GET['edit_data']) : '');
$edit_type = (isset($_GET['edit_type']) ? htmlspecialchars($_GET['edit_type']) : '');

if(empty(trim($edit_data)) || empty(trim($edit_type))){ echo 'error'; exit; } // Not all data supplied

/*
*   Configure modal
*/
$modal = new modal;
$modal->head('Wijzigen');
$body = $footer = '';

/*
*   Scripts edit 
*/
if($edit_type == 'get_scripts'){
    
    $global_varibale = new global_variable(sx_database(),sx_database_scripts);
    $script_data = $global_varibale->get_variable($edit_data,'id');

    if(empty($script_data)){ echo 'error'; exit; } // No variable found 

    $modal->head('Wijzigen '.$script_data['name']);

    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    $reload_function = "'get_scripts'";

    $body .= '<div class="container sx-form-wrapper">';
        $body .= '<form sx-form-uuid="'.$form_uuid.'" sx-sumbit-page="/global-variables/insert_script.php?edit=true&id='.$edit_data.'" reload="false" after-function="sx_reload_content('.$reload_function.')" delete-modal="'.$modal->modal_information()['modal_uuid'].'">'; 
        
            $body .= '<input type="text" hidden name="id" value="'.$script_data['id'].'">';

            $body .= '<label for="name">Naam</label>';
            $body .= '<input type="text" id="name" name="name" value="'.$script_data['name'].'">';

            $body .= '<label for="variable">Script</label>';
            $body .= '<textarea type="text" id="variable" height="300px" name="script">'.$script_data['script_content'].'</textarea>';

            if(!empty(trim($script_data['uploaded_script']))){
                $body .= '<label for="variable">Upgeload script: <a target="_blank" href="'.$script_data['uploaded_script'].'">'.$script_data['uploaded_script'].'</a></label><br><br>';
            }

            $body .= '<label for="include_header"><input type="radio" id="include_header" name="location" value="header" '.($script_data['location'] == 'header' ? 'checked' : '').'>Header</label>';
            $body .= '<br />';
            $body .= '<label for="include_Footer"><input type="radio" id="include_Footer" name="location" value="footer" '.($script_data['location'] == 'footer' ? 'checked' : '').'>Footer</label>';
            $body .= '<br />';
            $body .= '<br />';

            $body .= '<label for="status"><input type="checkbox" id="status" name="status" '.($script_data['status'] == 'active' ? 'checked' : '').'> Status</label>';

        $body .= '</form>';
    $body .= '</div>';

    $footer .= '<button sx-submit-form="'.$form_uuid.'" right>Opslaan</button>';
    $footer .= '<button sx-submit-form-confirm="'.$form_uuid.'" delete confirm-btn="false"  left not-important>Verwijdren</button>';

}

/*
*   Global value edit 
*/
if($edit_type == 'global_variables'){
    
    $global_varibale = new global_variable(sx_database(),sx_database_global_values);
    $global_data = $global_varibale->get_variable($edit_data,'id');

    if(empty($global_data)){ echo 'error'; exit; } // No variable found 

    $modal->head('Wijzigen '.$global_data['name']);

    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    $reload_function = "'global_variables'";

    $body .= '<div class="container sx-form-wrapper">';
        $body .= '<form sx-form-uuid="'.$form_uuid.'" sx-sumbit-page="/global-variables/create_global_variable.php?edit=true&id='.$edit_data.'" reload="false" after-function="sx_reload_content('.$reload_function.')" delete-modal="'.$modal->modal_information()['modal_uuid'].'">'; 
        
            $body .= '<input type="text" hidden name="id" value="'.$global_data['id'].'">';

            $body .= '<label for="name">Naam</label>';
            $body .= '<input type="text" id="name" name="name" value="'.$global_data['name'].'">';

            $body .= '<label for="Slug">Slug</label>';
            $body .= '<input type="text" id="Slug" name="slug" value="'.$global_data['slug'].'">';

            $body .= '<label for="value">Waarde</label>';
            $body .= '<input type="text" id="value" name="value" value="'.$global_data['value'].'">';

        $body .= '</form>';
    $body .= '</div>';

    $footer .= '<button sx-submit-form="'.$form_uuid.'" right>Opslaan</button>';
    $footer .= '<button sx-submit-form-confirm="'.$form_uuid.'" delete confirm-btn="false"  left not-important>Verwijdren</button>';

}

/*
*   Create modal
*/
$modal->body($body);
$modal->footer($footer);
echo $modal->get_modal();