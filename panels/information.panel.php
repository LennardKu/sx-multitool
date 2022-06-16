<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


/*
*   Documents
*/
$panel = new panel();
$panel->panel_head('Documenten');
$panel->panel_body();
$documents_panel_uuid = $panel->get_body_uuid();
echo $panel->get_panel();





// Js
echo '<script src="'.sx_plugin_path('url').'src/js/get_documents.js" document-ajax-map="'.sx_plugin_path('url').'/ajax/documents/" panel-body-uuid="'.$documents_panel_uuid.'"></script>';