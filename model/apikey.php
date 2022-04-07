<?php
    class Apikey {

         public $db;
        

        public function __construct(){

            $this->db=Connexion::connectar();
        }
        
        public function add($UserId,$value){
            
            $consulta = "INSERT INTO events.api_key ( id, api_key) VALUES( :id, :api_key)";
            
            $dades = [
                'id'=>$UserId,
                'api_key'=>$value
                
            ];
            
             $this->db->prepare($consulta)->execute($dades);

        }
    }

?>