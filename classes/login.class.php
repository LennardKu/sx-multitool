<?php
    
    class sx_login_screen{
    
        private $database;
        private $database_name;
    
        /*
        *   Database 
        */
        public function __construct(){
            global $sx_database_login_screen;
            $this->database = new sx_db(sx_database()[0],sx_database()[1],sx_database()[2],sx_database()[3]);   
            $this->database_name = $sx_database_login_screen;     
        }


        public function create_item($slug = '',$content = '',$type =''){
            return $this->database->query('INSERT INTO `'.$this->database_name.'` (`slug`,`value`,`type`) VALUES (?,?,?)',$slug,$content,$type);

        }

        public function update_item($slug = '',$update_column = '',$new_value =''){
            return $this->database->query('UPDATE `'.$this->database_name.'` SET `'.$update_column.'` = ? WHERE `'.$this->database_name.'`.`slug` = ?',$new_value,$slug);

        }

        public function get_item($slug = ''){
            $itemInformation =  $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ?',$slug)->fetchArray();
            if($itemInformation){
                return $itemInformation;
            }
            return array('value'=>'#0000');
        }

        public function check_item($slug = ''){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ?',$slug)->fetchArray();
        }

        public function get_items(){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'`')->fetchAll();
        }
    
    }