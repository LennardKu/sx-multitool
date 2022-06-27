<?php

    class cookie_message{

        private $database;
        private $database_name;

        function __construct(){
            global $sx_database_cookie_message;

            $this->database = new sx_db(sx_database()[0],sx_database()[1],sx_database()[2],sx_database()[3]);
            $this->database_name = $sx_database_cookie_message;
        }

        /*
        *   Update
        */
        public function update($data = '',$column = 'name',$where_column = 'id',$where_value = '1'){

            $db = $this->database;
            $db->query('UPDATE `'.$this->database_name.'` SET `'.$column.'` = ? WHERE `'.$this->database_name.'`.`'.$where_column.'` = ?',$data,$where_value);

            return 'success';

        }

        /*
        *   Get cookie information
        */
        function cookie_information(){

            $db = $this->database;
            $get_cookie = $db->query('SELECT * FROM `'.$this->database_name.'` WHERE `id` = ?','1')->fetchArray();
        
            return $get_cookie;

        }

        /*
        *   Get cookie
        */
        function get_cookie(){

            $db = $this->database;
            $get_cookie_modal = $db->query('SELECT * FROM `'.$this->database_name.'` WHERE `status` = ?','true')->fetchArray();
            
            $output = '';
            $output .= '<div sx_cookie_popup="wrapper">';   
                $output .= $get_cookie_modal['message'];
                $output .= $get_cookie_modal['accept'];
            $output .= '</div>';

            $output .= '<style>'.$get_cookie_modal['style'].'</style>';
            return $output;

        }

    }