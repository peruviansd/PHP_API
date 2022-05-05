<?php

    class Events_model{

        private $db;
        private $events;

        public function __construct(){
            require_once("./model/connexion.php");
            $this->db=Connexion::connectar();
            $this->events=array();
        }
        
        public function addEvent($event,$userId){

            
            $consulta = "INSERT INTO events.events ( userId, eventId, name, description,urlImg,location) VALUES( :userId, :eventId,:name, :description,:urlImg,:location)";
            $eventId = $this->getLastEvent();

            if(!$eventId) {
                $eventId=1;
            }else{
                $eventId = $eventId+1;
            }
            
            $dades = [
                'userId'=>$userId,
                'eventId'=> $eventId,
                'name'=>$event->name,
                'description'=>$event->description,
                'urlImg'=>$event->urlImg,
                'location'=>$event->location
            ];
            $this->db->prepare($consulta)->execute($dades);

            return $this->db->lastInsertId();
            
             
        }

        public function getLastEvent(){

            $consulta = "SELECT * FROM events.events order by eventId desc limit 1";
            $result = $this->db->query($consulta);
            $event = $result->fetch();

            return $event["eventId"];
        }

        public function getALlEvents(){
            $consulta = "SELECT * FROM events.events";
            $result = $this->db->query($consulta);
            while ($fila=$result->fetch(PDO::FETCH_ASSOC)){
                $this->events[]=$fila;
            }
            return $this->events;

        }
    }

?>