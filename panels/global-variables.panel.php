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

        echo '<button create-btn="create_variable">Create</button>';
        echo '<div class="sx_table">';
            echo '<div class="sx_table-header">';
                echo '<div class="header__item"><span class="filter__link" >Naam</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Slug</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Waarde</span></div>';
            echo '</div>';
            echo '<div class="sx_table-content" load-content="global_variables" loaded="false" offset="0">';
            echo '</div>';
        echo '</div>';

    echo '</div>';

    echo '<input type="radio" name="sx_tabs" id="google_fields">';
    echo '<label for="google_fields">Google analytics </label>';
    echo '<div class="tab">';
        echo '<h1>Google analytics</h1>';
        echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';

        echo '<form method="post" enctype="multipart/form-data">';
            echo '<input type="file" name="file">';
            echo '<button>Upload</button>';
        echo '</form>';

    echo '</div>';
  
echo '</div>';


// Js 
echo '<script src="'.sx_plugin_path('url').'/src/js/global_variables.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/modal.js"></script>';