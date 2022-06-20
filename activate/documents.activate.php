<?php

// Database name 
$sx_database_global_values = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx_documents';

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_global_values)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_global_values.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(255) NOT NULL,
        `file_name` varchar(255) NOT NULL,
        `file_location` varchar(255) NOT NULL,
        `description` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_global_values,$sql);

  }