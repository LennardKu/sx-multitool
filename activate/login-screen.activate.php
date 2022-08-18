<?php

// Database name 
$sx_database_login_screen = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx-login-screen';
define('sx_database_login_screen',$sx_database_login_screen);

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_login_screen)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_login_screen.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `slug` varchar(255) NOT NULL,
        `value` longtext NOT NULL,
        `type` longtext NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_login_screen,$sql);

    /*
      $default_values = new sx_login_screen;
      $default_values->create_item('#wp-submit','#be1526','background-color');
      $default_values->create_item('body','#000','background');
      $default_values->create_item('#wp-submit','#be1526','border-color');
      $default_values->create_item('.dashicons','#be1526','color');
    */
  }

   