<?php

    class global_variable{
    
        private $database;
        private $database_name;

        /*
        *   Database 
        */
        public function __construct($database = '',$database_name = ''){
            $this->database = new db($database[0],$database[1],$database[2],$database[3]);   
            $this->database_name = $database_name;     
        }
    
    
        /*
        *   Get variable
        */
        public function get_variable($slug = ''){
            $db = $this->database;
            $get_variable = $db->query('SELECT * FROM '.$this->database_name.' WHERE slug = ?',$slug)->fetchArray();
            return $get_variable;
        }
    
    
    }