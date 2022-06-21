<?php

// Database name 
$sx_database_global_values = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx-global-values';
define('sx_database_global_values',$sx_database_global_values);

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_global_values)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_global_values.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(255) NOT NULL,
        `slug` varchar(255) NOT NULL,
        `value` varchar(255) NOT NULL,
        `status` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_global_values,$sql);

   // Create example values 
   $global_varibale = new global_variable(sx_database(),sx_database_global_values);
   $global_varibale->create_variable('Telefoonnummer','phone_number','+316 123 456 78');

   $global_varibale = new global_variable(sx_database(),sx_database_global_values);
   $global_varibale->create_variable('E-mail','email','info@website.com');

  }

   