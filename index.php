<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// $method = $_SERVER['REQUEST_METHOD'];
// if($method == "OPTIONS") {
//     die();
// }
$x_api_key ="";
if ($_SERVER['HTTP_X_API_KEY']){

    $x_api_key = $_SERVER['HTTP_X_API_KEY'];
}



    include_once('app.php');
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $params = explode('/',$url);
    $body = json_decode(file_get_contents('php://input'));
    
    $app = new App($params, $body, $_SERVER['REQUEST_METHOD'], $x_api_key);
?>