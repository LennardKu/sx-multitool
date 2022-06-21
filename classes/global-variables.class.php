<?php
    
    class global_variable{
    
        private $database;
        private $database_name;

        /*
        *   Database 
        */
        public function __construct($database = '',$database_name = ''){
            $this->database = new sx_db($database[0],$database[1],$database[2],$database[3]);   
            $this->database_name = $database_name;     
        }
    
    
        /*
        *   Get variable
        */
        public function get_variable($slug = ''){
            $db = $this->database;
            $get_variable = $db->query('SELECT * FROM `'.$this->database_name.'` WHERE slug = ?',$slug)->fetchArray();
            return $get_variable;
        }
    
        /*
        *   Get variables / Limit 25 Or all
        */
        public function get_variables($offset = 0,$option = ''){
            $db = $this->database;
            
            if($option == 'all'){
                $get_variables = $db->query('SELECT * FROM `'.$this->database_name.'` WHERE status = ?','active')->fetchAll(); // Get all items 
            }else{
                $get_variables = $db->query('SELECT * FROM `'.$this->database_name.'` ORDER BY id DESC LIMIT 25 OFFSET '.($offset * 25))->fetchAll();
            }
            return $get_variables;
        }

        /*
        *   Create script
        */
        public function create_script($name = '',$script_content = '',$uploaded_script = '',$location = ''){

            $db = $this->database;
            $create_variable = $db->query('INSERT INTO `'.$this->database_name.'` (`name`,`script_content`,`uploaded_script`,`status`,`location`) VALUES (?,?,?,?,?)',$name,$script_content,$uploaded_script,'active',$location);

            return 'success';

        }

        /*
        *   Create variable
        */
        public function create_variable($name = '',$slug = '',$value = '',$database = 'global_variables'){

            $slug = trim($slug); // remove spaces from slug 

            if(empty(trim($value)) || empty(trim($name)) || empty(trim($slug))){ return 'fill_in_all_values'; } // Empty states
            if($this->get_variable($slug)){ return 'in_use'; } // Slug in use

            $db = $this->database;
            $create_variable = $db->query('INSERT INTO `'.$this->database_name.'` (`name`,`slug`,`value`) VALUES (?,?,?)',$name,$slug,$value);
            
            return 'success';
        }
    }