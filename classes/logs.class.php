<?php
    
    class sx_logs{
    
        private $database;
        private $database_name;
    
        /*
        *   Database 
        */
        public function __construct(){
            global $sx_database_logs;
            $this->database = new sx_db(sx_database()[0],sx_database()[1],sx_database()[2],sx_database()[3]);   
            $this->database_name = $sx_database_logs;     
        }


        public function CreateItem($log = '',$data = ''){
            return $this->database->query('INSERT INTO `'.$this->database_name.'` (`slug`,`value`) VALUES (?,?)',$slug,$content);

        }

        public function UpdateItem($log = '',$update_column = '',$new_value =''){
            return $this->database->query('UPDATE `'.$this->database_name.'` SET `'.$update_column.'` = ? WHERE `'.$this->database_name.'`.`log` = ?',$new_value,$log);

        }

        public function GetItem($log = ''){
            $itemInformation =  $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `log` = ?',$log)->fetchArray();
            if($itemInformation){
                return $itemInformation;
            }
            return array('value'=>'');
        }

        public function CheckItem($log = ''){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `log` = ?',$log)->fetchArray();
        }

        public function GetItems(){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'`')->fetchAll();
        }
    
    }