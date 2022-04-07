<?php
    class Connexion {
        public static function connectar(){
            try {
                $db = new PDO("mysql:localhost;dbname=events", "gerald", "123456");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->exec("SET CHARACTER SET UTF8");
       
                
            }
            catch(Exception $e){
                die("Error de conexión:" . $e->getMessage());
            }
            return $db;
        }
    }
    


    class Ej {

        private $db,$uses;

        public function __construct(){

            $this->db=Connexion::connectar();
            $this->users= array(); 
        }

        public function getUser($user){

            $username = $user;
            //$password = $user->password;
            
            
            $consulta = "SELECT * FROM events.users WHERE username='$username'";
            $result = $this->db->query($consulta);

            $user = $result->fetch();
            var_dump($user);
            if(password_verify($password, $user["password"])){
                echo "ok";
            }else{
                echo "ko";
            }
        }
    }

    $ejemplo = new Ej();
    $ejemplo->getUser("foo");

?>
