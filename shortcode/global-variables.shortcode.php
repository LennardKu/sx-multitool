<?php

function sx_global_get_global_data_func($atts){
    $slug = (isset($atts['slug']) ? htmlspecialchars($atts['slug']) : '');
    return get_global_value($slug); 
} add_shortcode('sx_global_data','sx_global_get_global_data_func');