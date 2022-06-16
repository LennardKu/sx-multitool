<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


$global_varibale = new global_variable(sx_database(),sx_database_global_values);

echo $global_varibale->get_variable('test');