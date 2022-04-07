<?php

    class Users_model{
        private $db;
        private $users;
        
        public function __construct(){
            require_once("./model/connexion.php");
            $this->db=Connexion::connectar();
            $this->users= array();
        }

        public function addUser($user){
            require_once("./model/password.php");
            
            $userExist = $this->getUser($user);

            if(isset($userExist["username"]))
            {
                $json = new stdClass();
                $json->mensaje = "username already exists";
                http_response_code(400);
                require_once("./vista/users_vista.php"); 
                return;
            }

          
            if ($user){
                $consulta = "INSERT INTO events.users ( username, password, city, country) VALUES( :username, :password,:city, :country)";
                
                $dades = [
                    'username'=>$user->username,
                    'password'=>Password::hash($user->password),
                    'city'=>$user->city,
                    'country'=>$user->country
                 ];
                
                 $this->db->prepare($consulta)->execute($dades);
                 
                 return $this->db->lastInsertId();
            }  

        }

        public  function getUser($user){

            $username = $user->username; 
            
            $consulta = "SELECT * FROM events.users WHERE username='$username'";
            $result = $this->db->query($consulta);

            $user = $result->fetch();
          
            
            return $user;
            
        }

    }


  
    
   
    

  

?>