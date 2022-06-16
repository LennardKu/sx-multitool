<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access

$panel_content = '';

/*
*   Documents
*/
$panel = new panel();
    $panel->panel_head('Documenten','test');
$panel->panel_body();

echo $panel->get_panel();
