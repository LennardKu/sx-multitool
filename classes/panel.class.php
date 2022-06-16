<?php

class panel{

    public $panel_uuid; 
    public $head;
    public $body;
    public $footer;
    public $wrapper;
    public $close_wrapper;
    public $body_uuid;

    /*
    *   Open
    */
    function __construct(){

        // Save uuid's
        $this->panel_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
        $this->body_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

        $this->wrapper = '<div class="panel_wrapper" panel-uuid="'.$this->panel_uuid.'">';
            $this->head = '<div class="panel_head">';
                $this->body = '<div class="panel_body" panel_body_uuid="'.$this->body_uuid.'"></div>';
            $this->footer = '</div>';
        $this->close_wrapper = '</div>';

    }

    /*
    *   Head
    */
    public function panel_head($title = '',$option = '',$option_attr = ''){
        $head = '';

        $head .= '<div class="panel_head">';
            $head .= '<h3>'.$title.'</h3>';
            $head .= '<span class="head_option" '.$option_attr.'>'.$option.'</span>';
        $head .= '</div>';

        $this->head = $head;
    }

    /*
    *   Body
    */

    public function panel_body($body = ''){
        $this->body = '<div class="panel_body" panel_body_uuid="'.$this->body_uuid.'">'.$body.'</div>';
    }

    /*
    *   Footer
    */
    public function panel_footer($footer = ''){
        $this->body = '<div class="panel_footer">'.$footer.'</div>';
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
    *   Place
    */
    public function get_panel(){
        echo $this->wrapper;    
            echo $this->head;
                echo $this->body;
            echo $this->footer;
        echo $this->close_wrapper;

    }

}