<?php

// Database name 
$sx_database_scripts = $table_prefix.(substr($table_prefix, -1) == '_' ? '' : '_').'sx_scripts';
define('sx_database_scripts',$sx_database_scripts);

/*
*   Check if table exists 
*/
if(!sx_standard_table_exist($sx_database_scripts)){
    
    // Create table 
    $sql = 'CREATE TABLE `'.$sx_database_scripts.'` (
        `id` int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(255) NOT NULL,
        `location` varchar(255) NOT NULL,
        `script_content` longtext NOT NULL,
        `uploaded_script` varchar(255) NOT NULL,
        `status` varchar(255) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
      ';

    // Create table 
    sx_standard_create_table($sx_database_scripts,$sql);

  }

/*
*   Include header scripts 
*/  
function sx_header_scripts() {
  $get_variables = new global_variable(sx_database(),sx_database_scripts);
  foreach($get_variables->get_variables(0,'all') as $get_script){
      if($get_script['location'] == 'footer'){continue; }

      if(!empty(trim($get_script['uploaded_script']))){
          echo '<script src="'.$get_script['uploaded_script'].'"></script>';
      }

      if(!empty(trim($get_script['script_content']))){
          echo $get_script['script_content'];
      }

  }
} 

add_action( 'wp_head', 'sx_header_scripts' );

function sx_footer_scripts() {
  $get_variables = new global_variable(sx_database(),sx_database_scripts);
  foreach($get_variables->get_variables(0,'all') as $get_script){
      if($get_script['location'] == 'header'){continue; }
      
      if(!empty(trim($get_script['uploaded_script']))){
          echo '<script src="'.$get_script['uploaded_script'].'"></script>';
      }

      if(!empty(trim($get_script['script_content']))){
          echo $get_script['script_content'];
      }

  }
} 

add_action( 'wp_footer', 'sx_footer_scripts' );