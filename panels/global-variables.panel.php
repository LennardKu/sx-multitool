<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


// $global_varibale = new global_variable(sx_database(),sx_database_global_values);
// print_r($global_varibale->get_variable('phone_number'));

// if(isset($_FILES['file'])){

//     $upload = new sx_upload($_FILES['file'],array(),'test');
//     $upload->create_file();
//     echo $upload->get_file_information()['complete_url'];

// }




echo '<div class="sx_tabs">';

    echo '<input type="radio" name="sx_tabs" id="standard_variables" checked="checked">';
    echo '<label for="standard_variables">Standaard variabelen </label>';
    echo '<div class="tab">';
        echo '<h1>Tab One Content</h1>';
        
    echo '</div>';

    echo '<input type="radio" name="sx_tabs" id="google_fields">';
    echo '<label for="google_fields">Google analytics </label>';
    echo '<div class="tab">';
        echo '<h1>Google analytics</h1>';
        echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';

        echo '<form method="post" enctype="multipart/form-data">';
            echo '<input type="file" name="file" >';
            echo '<button>Upload</button>';
        echo '</form>';

    echo '</div>';
  
echo '</div>';