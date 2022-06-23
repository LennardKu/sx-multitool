<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


// if(isset($_FILES['file'])){
//     $upload = new sx_upload($_FILES['file'],array(),'test');
//     $upload->create_file();
//     echo $upload->get_file_information()['complete_url'];
// }

echo '<div class="sx_tabs">';

    echo '<input type="radio" name="sx_tabs" id="standard_variables" checked="checked">';
    echo '<label for="standard_variables">Standaard variabelen </label>';
    echo '<div class="tab">';
        echo '<h1>Standaard waarde</h1>';    

        echo '<button create-btn="create_variable" btn="default">Create</button>';
        echo '<div class="sx_table">';
            echo '<div class="sx_table-header">';
                echo '<div class="header__item"><span class="filter__link" >Naam</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Slug</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Waarde</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Shortcode</span></div>';
            echo '</div>';
            echo '<div class="sx_table-content" load-content="global_variables" loaded="false" offset="0">';
            echo '</div>';
        echo '</div>';

    echo '</div>';

    /*
    *   Scripts
    */  
    echo '<input type="radio" name="sx_tabs" id="google_fields">';
    echo '<label for="google_fields">Scripts </label>';
    echo '<div class="tab">';
        echo '<h1>Scripts</h1>';
        
        echo '<button create-btn="insert_script" btn="default">Create</button>';
        echo '<div class="sx_table">';
            echo '<div class="sx_table-header">';
                echo '<div class="header__item"><span class="filter__link" >Script naam</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Locatie</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Upload url</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Script</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >status</span></div>';
            echo '</div>';
            echo '<div class="sx_table-content" load-content="get_scripts" loaded="false" offset="0">';
            echo '</div>';
        echo '</div>';

    echo '</div>';

    /*
    *   Login page
    */
    echo '<input type="radio" name="sx_tabs" id="login_page" >';
    echo '<label for="login_page">Login pagina</label>';
    echo '<div class="tab">';
        echo '<h1>Login pagina</h1>'; 
    echo '</div>';

    /*
    *   Cookie message 
    */
    echo '<input type="radio" name="sx_tabs" id="cookie_message" >';
    echo '<label for="cookie_message">Cookie melding</label>';
    echo '<div class="tab">';
        echo '<h1>Cookie melding</h1>'; 
    echo '</div>';

echo '</div>';


// Js 
echo '<script src="'.sx_plugin_path('url').'/src/js/main.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/global_variables.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/modal.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';