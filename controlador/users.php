<?php
    require_once("./model/users_model.php");
    class Users{    
        public function __construct($params, $body){
            $method = array_shift($params);
           
            switch ($method){
                case "POST":
                    $this->postUsers($params, $body);
                    break;
                default:
                    $this->wrongRequest();
            }    
        }

        private function postUsers($params, $body){
             
            $model = new Users_model();   
            $created = $model->addUser($body);   

            if($created){
                $json = new stdClass();
                $json->messaje = "user created";
                http_response_code(201);
                require_once("./vista/users_vista.php"); 
            }          
            
        }

        private function wrongRequest(){
            http_response_code(405);
        }  

    }


?>