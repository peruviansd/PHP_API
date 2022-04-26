<?php
    class Apikey {

         public $db;
        

        public function __construct(){

            $this->db=Connexion::connectar();
        }
        
        public function add($userId,$value){
            
            $consulta = "INSERT INTO events.api_key ( userId, api_key) VALUES( :userId, :api_key)";
            
            $dades = [
                'userId'=>$userId,
                'api_key'=>$value
                
            ];
            
             $this->db->prepare($consulta)->execute($dades);

        }
    }

?>