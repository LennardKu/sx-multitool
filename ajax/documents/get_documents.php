<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!is_user_logged_in()) { echo 'error'; exit;} // No access

/*
*   Documents
*/
foreach(array_diff(scandir(sx_plugin_path().'/documents/'), array('.', '..')) as $file){
    echo '<div class="option">';
        echo '<div class="title">'.$file.'</div>';
        echo '<a href="'.sx_plugin_path('url').'/documents/'.$file.'" target="_blank" download style="font-weight:bold;cursor:pointer;color:#111">Download</a>';
    echo '</div>';
}
