<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/hotel.php';

$database = new Database();
$db = $database->getConexion();
$hotel = new Hotel($db);
$num = pg_num_rows($hotel->read());
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->NOMBRE)&&
    !empty($data->NIT)&&
    !empty($data->NUM_HABITACIONES)&&
    !empty($data->DIRECCION)&&
    !empty($data->PAIS_UBICACION)&&
    !empty($data->CIUDAD_UBICACION)
){
    $hotel->id=$num+1;
    echo($num+1);
    $hotel->nombre=$data->NOMBRE;
    echo($data->NOMBRE);
    $hotel->nit=$data->NIT;
    $hotel->numHabitaciones=$data->NUM_HABITACIONES;
    $hotel->direccion=$data->DIRECCION;
    $hotel->pais=$data->PAIS_UBICACION;
    $hotel->ciudad=$data->CIUDAD_UBICACION;
    if($hotel->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }

}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}


?>