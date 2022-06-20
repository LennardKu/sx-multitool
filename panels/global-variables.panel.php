<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


// $global_varibale = new global_variable(sx_database(),sx_database_global_values);
// echo $global_varibale->get_variable('test');

if(isset($_FILES['file'])){

    $upload = new sx_upload($_FILES['file'],array(),'test');
    $upload->create_file();
    echo $upload->get_file_information()['complete_url'];

}

echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="file" >';
    echo '<button>Upload</button>';
echo '</form>';