<?php

// Database name 
$sx_database_cookie_message = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx_cookie_message';

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_cookie_message)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_cookie_message.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `message` longtext NOT NULL,
        `accept` varchar(255) NOT NULL,
        `style` longtext NOT NULL,
        `status` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_cookie_message,$sql);

  }

  // if(!isset($_COOKIE['sx-multitool-accept-cookie'])){
  //   function sx_cookie_message() {
  //     $get_variables = new cookie_message;
  //     echo $get_variables->get_cookie();
  //   } 
  
  //   add_action( 'wp_footer', 'sx_cookie_message' );
  // }