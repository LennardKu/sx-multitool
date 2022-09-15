<?php
    
    class sx_images{
    
        private $database;
        private $database_name;
    
        /*
        *   Database 
        */
        public function __construct(){
            global $sx_database_options;
            $this->database = new sx_db(sx_database()[0],sx_database()[1],sx_database()[2],sx_database()[3]);   
            $this->database_name = $sx_database_options;     
        }


        public function createItem($slug = '',$content = ''){
            return $this->database->query('INSERT INTO `'.$this->database_name.'` (`slug`,`value`) VALUES (?,?)',$slug,$content);

        }

        public function updateItem($slug = '',$update_column = '',$new_value =''){
            return $this->database->query('UPDATE `'.$this->database_name.'` SET `'.$update_column.'` = ? WHERE `'.$this->database_name.'`.`slug` = ?',$new_value,$slug);

        }

        public function deleteItems($slug = ''){
            return $this->database->query("DELETE FROM `".$this->database_name."` WHERE `".$this->database_name."`.`slug` = '".$slug."'");
        }

        public function deleteItem($slug = '',$content = ''){
            return $this->database->query("DELETE FROM `".$this->database_name."` WHERE `".$this->database_name."`.`slug` = '".$slug."' AND `".$this->database_name."`.`value` = '".$content."'");
        }

        public function getItem($slug = ''){
            $itemInformation =  $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ?',$slug)->fetchArray();
            if($itemInformation){
                return $itemInformation;
            }
            return array('value'=>'');
        }

        public function checkItem($slug = ''){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ?',$slug)->fetchArray();
        }

        public function disabledSizes(){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ? ','Disabledsize')->fetchAll();
        }
        
        public function ownFormats(){
            return $this->database->query('SELECT * FROM `'.$this->database_name.'` WHERE `slug` = ? ','OwnFormat')->fetchAll();
        }
    }