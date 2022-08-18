<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';

if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

if(!isset($_GET['content_name'])){ echo 'error'; exit; } // Not all data supplied

$content_name = trim(htmlspecialchars($_GET['content_name']));
$offset = (isset($_GET['offset']) ? htmlspecialchars($_GET['offset']) : 0);


/*
*   Get variables
*/
if($content_name == 'global_variables'){

    $get_variables = new global_variable(sx_database(),sx_database_global_values);
    
    foreach($get_variables->get_variables($offset) as $number => $get_variable){
        echo '<div class="sx_table-row">';		
            echo '<div class="sx_table-data" edit-data="'.$get_variable['id'].'" edit-type="global_variables">'.$get_variable['name'].'</div>';
            echo '<div class="sx_table-data" edit-data="'.$get_variable['id'].'" edit-type="global_variables">'.$get_variable['slug'].'</div>';
            echo '<div class="sx_table-data" edit-data="'.$get_variable['id'].'" edit-type="global_variables">'.$get_variable['value'].'</div>';
            echo '<div class="sx_table-data" copy-content>[sx_global_data slug="'.$get_variable['slug'].'"]</div>';
        echo '</div>';
    }

    exit; // Not allow to do other actions
}


/*
*   Get scripts
*/
if($content_name == 'get_scripts'){
    
    $get_variables = new global_variable(sx_database(),sx_database_scripts);
    
    foreach($get_variables->get_variables($offset) as $number => $get_variable){
        echo '<div class="sx_table-row" edit-data="'.$get_variable['id'].'" edit-type="get_scripts">';		
            echo '<div class="sx_table-data">'.$get_variable['name'].'</div>';
            echo '<div class="sx_table-data">'.$get_variable['location'].'</div>';
            echo '<div class="sx_table-data">'.$get_variable['uploaded_script'].'</div>';
            echo '<div class="sx_table-data">'.htmlspecialchars($get_variable['script_content']).'</div>';
            echo '<div class="sx_table-data">'.$get_variable['status'].'</div>';
        echo '</div>';
    }

    exit; // Not allow to do other actions
}

/*
*   Accept scripts
*/
if($content_name == 'accept_script_variables'){
        
    $get_variables = new global_variable(sx_database(),sx_database_scripts);
    
    foreach($get_variables->get_variables($offset) as $number => $get_variable){
        echo '<option value="'.$get_variable['id'].'">'.$get_variable['name'].'</option>';
    }

    exit; // Not allow to do other actions
}

/*
*   Logo login
*/
if($content_name == 'logo-login'){
    $login_logo = new sx_login_screen;
    if($login_logo->check_item('logo')){
        echo get_site_url().$login_logo->get_item('logo')['value'];
    }
}