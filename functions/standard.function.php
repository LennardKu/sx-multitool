<?php

function sx_multitool_plugin_path(){
    return $_SERVER['DOCUMENT_ROOT'].str_replace(get_site_url(),'',plugins_url('',__DIR__)).'/';
}