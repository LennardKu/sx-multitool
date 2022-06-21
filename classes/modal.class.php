<?php

class modal{

    public $modal_uuid;
    public $modal_body_uuid;
    public $modal_head_uuid;
    public $modal_footer_uuid;
    public $modal_head;
    public $modal_body;
    public $modal_footer;
    public $modal_attr;

    /*
    *   Construct
    */
    function __construct(){

        // Standard variables 
        $this->modal_uuid = $this->create_uuid();
        $this->modal_body_uuid = $this->create_uuid();
        $this->modal_head_uuid = $this->create_uuid();
        $this->modal_footer_uuid = $this->create_uuid();

    }   
    
    /*
    *   Generate 
    */
    public function create_uuid(){
        return  substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    }

    /*
    *   Head  
    */
    public function head($head = ''){
        $this->modal_head = $head;
    }
    
    /*
    *   Body  
    */
    public function body($body = ''){
        $this->modal_body = $body;
    }

    /*
    *   Footer  
    */
    public function footer($footer = ''){
        $this->modal_footer = $footer;
    }

    /*
    *   Modal information
    */
    public function modal_information(){
        return array("modal_uuid"=>$this->modal_uuid,"modal_head_uuid"=>$this->modal_head_uuid,"modal_body_uuid"=>$this->modal_body_uuid,"modal_footer_uuid"=>$this->modal_footer_uuid);
    }

    /*
    *   Get modal
    */
    public function get_modal(){
        $output = '';

        $output .= '<div sx-modal="wrapper" sx-modal-uuid="'.$this->modal_uuid.'" '.$this->modal_attr.'>';
            $output .= '<div sx-modal="container">';
                $output .= '<div sx-modal="head"><h2>'.$this->modal_head.'</h2> <span><span sx-minimize-modal="'.$this->modal_uuid.'">mini</span> <span sx-remove-modal="'.$this->modal_uuid.'">X</span></span></div>';
                $output .= '<div sx-modal="body">'.$this->modal_body.'</div>';
                $output .= '<div sx-modal="footer">'.$this->modal_footer.'</div>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;

    }



}