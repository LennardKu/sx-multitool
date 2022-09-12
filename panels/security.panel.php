<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access

echo '<h2>Beveiliging</h2>';

echo '<div class="sx_tabs">';


    /*
    *   Login page
    */
    echo '<input type="radio" checked name="sx_tabs" id="login_page" >';
    echo '<label for="login_page" class="tab_indicator">Login pagina</label>';
    echo '<div class="tab active" >';
        echo '<h1>Url</h1>'; 

        echo '<div class="" style="max-width:900px">';

            $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
            $UrlInformation = new sx_options;    


            echo '<div class="container sx-form-wrapper">';
                echo '<form sx-form-uuid="'.$form_uuid.'" after-function="" sx-sumbit-page="/security/update-url.php?confirm=true" dont-reset-form="true" reload="false">'; 
                        
                    echo '<label for="variable">Login url</label><br />';
                    echo '<input type="text" name="url" value="'.$UrlInformation->get_item('LoginUrl')['value'].'">';
                    
                echo '</form>';
                echo '<br / >';

                echo '<button btn="default" sx-submit-form="'.$form_uuid.'">Opslaan</button>';
            echo '</div>';

        echo '</div>';

    echo '</div>';
    echo '</div>';

    echo '<script src="'.sx_plugin_path('url').'/src/js/main.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
    echo '<script src="'.sx_plugin_path('url').'/src/js/modal.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';