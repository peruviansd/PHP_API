<?php
require_once("./model/users_model.php");

class Login{

    private $user;
    private $uuid;


    public function __construct($params, $body){
        
        $method = array_shift($params);
        switch ($method){
            case "POST":
                $this->validateUser($body);
                break; 
            default:
                echo $this->wrongRequest();
        }    
    }

    
    private function validateUser($user){
        $model = new Users_model();
        $userModelo = $model->getUser($user);
        $correct = password_verify($user->password, $userModelo["password"]);
        
        
        
        $json = new stdClass(); 
        
        if($correct){
          
            $this->user = $userModelo;
            $this->uuid = $this->generateUUID();

            require("./model/apikey.php");
            $apikey = new Apikey();
            $apikey->add($this->user["id"],$this->uuid);
           
            
           
            $json->uuid = $this->uuid;

        }else{
            http_response_code(400);
            $json->error = "incorrect password";

        }

       
        require_once("./vista/users_vista.php");

    }

          

    private function generateUUID($data = null){

         $data = $data ?? random_bytes(16);
         assert(strlen($data) == 16);
     
         $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
         $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
     
         return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));

    }

    private function wrongRequest(){
        http_response_code(405);
    }
}

?>