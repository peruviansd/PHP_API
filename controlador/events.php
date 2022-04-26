<?php

    require_once("./model/events_model.php");
    require_once("./model/users_model.php");
    class Events{
        public function __construct($params, $body){
  
            $method = array_shift($params);
  
            $api_key = array_shift($params);
            
            switch($method){

                case "GET";
                $this->getEvents();
                break;

                case "POST";
                $this->postEvents($body, $api_key);
                break;

                default:
                    http_response_code(405);


            }


        }

        private function postEvents($body, $api_key = ""){
            
            
            
            $model = new Users_model();
            $userId = $model->getUserByApiKey($api_key);
            
            if(!$userId) return http_response_code(403);
            
            $model = new Events_model();

            if ($model->addEvent($body,$userId)) http_response_code(201);
          
           
         
        }

        
    }



?>
