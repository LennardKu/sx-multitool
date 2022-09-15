<?php

class sx_upload{

    public $file;
    public $file_name; 
    public $file_size;
    public $file_location;
    public $file_path;
    public $file_type;
    public $file_url;
    public $allowed_file_types = array();
    private $allowed_upload;

    /*
    *   Construct
    */
    public function __construct($file = false,$file_types = array(),$file_name = '',$file_path = ''){

        if($file == false){ return false; } // No file 

        if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/sx-uploads/')){
            mk_dir($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/sx-uploads/');
        }

        $this->allowed_file_types = $file_types;
        $this->file = $file;
        $this->file_type = $this->get_file_type();
        $this->file_path = (!empty(trim($file_path)) ? $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/sx-uploads/'.$file_path : $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/sx-uploads/');
        $this->file_url = (!empty(trim($file_path)) ? get_site_url().'/wp-content/uploads/sx-uploads/'.$file_path : get_site_url().'/wp-content/uploads/sx-uploads/');
        $this->file_name = (!empty(trim($file_name)) ? $this->check_custom_file_name($file_name) : $this->random_file_name());
        
        $this->check_file_type(); // Check file upload 
    }

    /*
    *   Generate 
    */
    public function create_uuid(){
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
    }
    
    /*
    *   File name
    */
    public function random_file_name(){
        
        while($this->check_file_name(($file_name = $this->create_uuid()))){
            $file_name = $this->create_uuid();
        }

        return $file_name.'.'.$this->file_type;
    }

    public function check_file_name($file_name = ''){
        if (file_exists($this->file_path.$file_name.'.'.$this->file_type)){
            return true;
        }
        return false;
    }

    public function check_custom_file_name($file_name = ''){

        $custom_name = $file_name;
        $file_exist_counter = 1;

        while($this->check_file_name($file_name)){
            $file_name = $custom_name.'-'.$file_exist_counter;
            $file_exist_counter++;
        }

        return $file_name.'.'.$this->file_type;
    }

    /*
    *   Get file type
    */
    public function get_file_type(){
        
        $tmp = explode('.', $this->file['name']);
        $file_extension = end($tmp);
        return $file_extension;

    }

    /*
    *   Chec uploaded file 
    */
    public function check_file_type(){

        if(empty($this->allowed_file_types)){ // allow all uploads 
            $this->allowed_upload = true;
            return false;
        }

        $this->allowed_upload = false;

        // allowed types 
        foreach($this->allowed_file_types as $allowed){
            if($allowed == $this->file_type){
                $this->allowed_upload = true;
                break;
            }
        }

    }

    /*
    *   Upload
    */
    public function create_file(){

        if($this->allowed_upload === false){ // Check allowed upload
            return false;
        }

        if (move_uploaded_file($this->file["tmp_name"], $this->file_path.$this->file_name)) {
            return true;
        }

        return false;

    }

    /*
    *   File information
    */
    public function get_file_information(){

        if($this->allowed_upload == false){ // Could not upload
            return 'Now allowed upload';
        }

        return array('file_name'=>$this->file_name,'file_url'=>$this->file_url,'complete_url'=>$this->file_url.$this->file_name,'file_path'=>$this->file_path,'file_extension'=>$this->file_type);

    }


}