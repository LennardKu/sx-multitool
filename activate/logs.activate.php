<?php

// Database name 
$sx_database_logs = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx-logs';
define('sx_database_logs',$sx_database_logs);

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_logs)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_logs.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `log` varchar(255) NOT NULL,
        `data` longtext NOT NULL,
        `creator` longtext NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_logs,$sql);
  }

   