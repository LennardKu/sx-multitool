<?php

class global_variable{
    
    protected $database = array(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    /*
    *   Database 
    */
    public function database(){
        global $sx_database_global_values;
        $db = new db($this->database[0],$this->database[1],$this->database[2],$this->database[3]);
        return array($db,$sx_database_global_values);
    }


    /*
    *   Get variable
    */
    public function get_variable($slug = ''){
        $db = $this->database()[0];
        $get_variable = $db->query('SELECT * FROM '.$this->database()[1].' WHERE slug = ?',$slug)->fetchArray();
        return $get_variable;
    }


}