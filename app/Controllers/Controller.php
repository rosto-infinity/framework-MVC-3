<?php
namespace App\Controllers;

use Database\Db;

abstract class Controller{
 
        protected $db;
        public function __construct(Db $db){
            $this-> db = $db;
             
        }

       protected function view (string $path, array $params = null){

            ob_start();
            $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
            require VIEWS. $path. '.php';
        //    if($params){
        //     $params = extract($params);
        // }
            $content = ob_get_clean();
            require VIEWS . 'layout.php';

        }

        /**
         * getter
         *
         *
         */
        protected function getDB(){
        return $this->db;
    }

}