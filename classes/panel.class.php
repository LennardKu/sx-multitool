<?php

class panel{

    public $panel_uuid; 
    public $head;
    public $body;
    public $wrapper;
    public $close_wrapper;
    public $body_uuid;

    /*
    *   Construct
    */
    function __construct(){

        // Set uuid's
        $this->panel_uuid = $this->creat_uuid();
        $this->body_uuid = $this->creat_uuid();

        $this->wrapper = '<div class="panel_wrapper" panel-uuid="'.$this->panel_uuid.'">';
            $this->head = '<div class="panel_head"></div>';
            $this->body = '<div class="panel_body" panel_body_uuid="'.$this->body_uuid.'"></div>';
        $this->close_wrapper = '</div>';

    }

    /*
    *   Generate 
    */
    public function creat_uuid(){
        return  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    }

    /*
    *   Head
    */
    public function panel_head($title = '',$option = '',$option_attr = ''){
        $head = '';

        /*
        *   Icons icon 
        */
        if($option == 'icon-add'){ // Add icon
            $option = '<svg version="1.1" id="Capa_1" style="height: 14px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60.364 60.364" style="enable-background:new 0 0 60.364 60.364;" xml:space="preserve"><g><path d="M54.454,23.18l-18.609-0.002L35.844,5.91C35.845,2.646,33.198,0,29.934,0c-3.263,0-5.909,2.646-5.909,5.91v17.269L5.91,23.178C2.646,23.179,0,25.825,0,29.088c0.002,3.264,2.646,5.909,5.91,5.909h18.115v19.457c0,3.267,2.646,5.91,5.91,5.91c3.264,0,5.909-2.646,5.91-5.908V34.997h18.611c3.262,0,5.908-2.645,5.908-5.907C60.367,25.824,57.718,23.178,54.454,23.18z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
        }

        $head .= '<div class="panel_head">';
            $head .= '<h3>'.$title.'</h3>';
            $head .= (!empty(trim($option)) ? '<span class="head_option" '.$option_attr.'>'.$option.'</span>' : ''); // Option
        $head .= '</div>';

        $this->head = $head;
    }

    /*
    *   Body
    */

    public function panel_body($body_content = ''){
        $this->body = '<div class="panel_body" panel_body_uuid="'.$this->body_uuid.'">'.$body_content.'</div>';
    }

    /*
    *   Get uuid's
    */
    public function get_body_uuid(){
        return $this->body_uuid;
    }

    public function get_panel_uuid(){
        return $this->panel_uuid;
    }

    /*
    *   Get panel
    */
    public function get_panel(){
        $output = '';
        $output .= '<div class="panel_outer_wrapper">';
            $output .= $this->wrapper;    
                $output .= $this->head;
                $output .= $this->body;
            $output .= $this->close_wrapper;
        $output .= '</div>';
        return $output;
    }

}