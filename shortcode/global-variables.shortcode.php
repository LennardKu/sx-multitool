<?php

function sx_global_get_global_data_func($atts){
    $slug = (isset($atts['slug']) ? htmlspecialchars($atts['slug']) : '');
    $check_variable = new global_variable(sx_database(),sx_database_global_values);
    $variable_exists = $check_variable->get_variable($slug);

    return $variable_exists['value']; 
} add_shortcode('sx_global_data','sx_global_get_global_data_func');
