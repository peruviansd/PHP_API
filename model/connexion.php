<?php


    class Connexion {
        public static function connectar(){
            try {
                $db = new PDO("mysql:localhost;dbname=events", "gerald", "gerald");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->exec("SET CHARACTER SET UTF8");
       
                
            }
            catch(Exception $e){
                die("Error de conexión:" . $e->getMessage());
            }
            return $db;
        }
    }

    
  
?>
