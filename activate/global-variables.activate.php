<?php

// Database name 
$sx_database_global_values = 'sx-global-values';

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_global_values)){

    // Create table 
    $sql = 'CREATE TABLE `'.$table_prefix.'sx_global_values` (
        `id` int(11) NOT NULL,
        `slug` varchar(255) NOT NULL,
        `value` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    sx_standard_create_table($sx_database_global_values,$sql);
}