<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access

echo '<h2>Afbeeldingen</h2>';

echo '<div class="sx_tabs">';

    /*
    *   Image formats
    */
    $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    $Function = "'image-sizes'";
    
    echo '<input type="radio" checked name="sx_tabs" id="login_page" >';
    echo '<label for="login_page" class="tab_indicator">Formaten</label>';
    echo '<div class="tab active" >';
        echo '<h1>Formaten</h1>'; 
        echo '<div class="" style="max-width:900px">';
            echo '<div class="container sx-form-wrapper">';
                echo '<form sx-form-uuid="'.$form_uuid.'" after-function="loadSingleItem('.$Function.');emptyWrapper(1)" sx-sumbit-page="/images/disable.php?confirm=true" reload="false" style="display:block">'; 
                echo '<h3>Beschikbare formaten</h3>';
                    echo '<div load-content="image-sizes" loaded="false"></div>';
                    echo '<br>';
                    echo '<hr></hr>';
                    echo '<h3>Eigen formaten</h3>';
                    echo '<div data-own-formats="wrapper"></div>';
                    echo '<span data-own-formats="add">Toevoegen</span>';
                echo '</form>';
                echo '<br / >';
                echo '<button btn="default" sx-submit-form="'.$form_uuid.'">Opslaan</button>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    /*
    *   Regenerate images
    */
    echo '<input type="radio"  name="sx_tabs" id="generate" >';
    echo '<label for="generate" class="tab_indicator">Genereren</label>';
    echo '<div class="tab" >';
        echo '<h1>Genereren</h1>'; 
        echo '<div class="" style="max-width:900px">';
            echo '<div class="container sx-form-wrapper">';
                echo '<div style="display:block">'; 
                    echo '<h3>Beschikbare formaten</h3>';                           
                    echo '<span style="display:none">Typ "verwijderen" in het volgende veld om niet bestaande formaten te verwijderen</span>';
                    echo '<input type="text" id="DeleteNotSetFormat" hidden/>';
                    echo '<span id="DeleteNotSetFormatConfirm" style="color:red;display:none">Niet gezette formaten worden verwijderen.</span>';
                echo '</div>';
                echo '<br / >';
                echo '<button btn="default" data-offset="0" id="regenerateimages">Hergenereren</button>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

echo '</div>'; // End tab

echo '<script src="'.sx_plugin_path('url').'/src/js/main.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/global_variables.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/modal.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/regenerate.js" ajax-url="'.sx_plugin_path('url').'" ></script>';