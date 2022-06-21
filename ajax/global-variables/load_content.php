<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if(!isset($_GET['content_name'])){ echo 'error'; exit; } // Not all data supplied

$content_name = trim(htmlspecialchars($_GET['content_name']));
$offset = (isset($_GET['offset']) ? htmlspecialchars($_GET['offset']) : 0);


/*
*   Get variables
*/
if($content_name == 'global_variables'){
    $counter = 0;

    $get_variables = new global_variable(sx_database(),sx_database_global_values);
    
    foreach($get_variables->get_variables($offset) as $number => $get_variable){
        echo '<div class="sx_table-row">';		
            echo '<div class="sx_table-data">'.$get_variable['name'].'</div>';
            echo '<div class="sx_table-data">'.$get_variable['slug'].'</div>';
            echo '<div class="sx_table-data">'.$get_variable['value'].'</div>';
        echo '</div>';
    }

    exit; // Not allow to do other actions
}