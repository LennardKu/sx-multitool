<?php
// Database name 
$sx_database_options = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx-options';
define('sx_database_options',$sx_database_options);

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_options)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_options.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `slug` varchar(255) NOT NULL,
        `value` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_options,$sql);

    $ChangeUrl = new sx_options;
    $ChangeUrl->create_item('LoginUrl','wp-login');
    
  }

   