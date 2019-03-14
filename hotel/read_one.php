<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../config/database.php';
include_once '../objects/hotel.php';

$database = new Database();
$db = $database->getConexion();
$hotel = new Hotel($db);


$hotel->id=isset($_GET['id']) ? $_GET['id']:die();
$hotel->read_one();
if($hotel->nombre!=null){
    $hotel_arr=array(
        "ID"=>$hotel->id,
        "NOMBRE"=>$hotel->nombre,
        "NIT"=>$hotel->nit,
        "HABITACIONES"=>$hotel->numHabitaciones,
        "DIRECCION"=>$hotel->direccion,
        "PAIS"=>$hotel->pais,
        "CIUDAD"=>$hotel->ciudad
    );
    http_response_code(200);
    echo json_encode($hotel_arr);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Product does not exist."));
}
?>