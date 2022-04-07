<?php
class App{
    public function  __construct($params, $body, $method){
     
        $nom_controlador = strtolower(array_shift($params));
       
        array_unshift($params, $method);
  
        $archivo="./controlador/".$nom_controlador.".php";
        if (file_exists($archivo)){
            
            require_once $archivo;
          
            $control = new $nom_controlador($params, $body);
            
        }else {
            require_once 'controlador/error_c.php';
            $control=new Error_c($params);
        }
    }
}
?>