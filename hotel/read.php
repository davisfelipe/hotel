<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/hotel.php';

$database = new Database();
$db = $database->getConexion();
$hotel = new Hotel($db);

$stmt = $hotel->read();
$num = pg_num_rows($stmt);
echo("Numero de resultados: ".$num."\n");
if($num>0){
    $hotel_arr=array();
    $hotel_arr["records"]=array();
    while ($row=pg_fetch_assoc($stmt)) {
        # code...
        extract($row);
        $hotelDatos=array(
            "ID"=>$ID_HOTEL,
            "NOMBRE"=>$NOMBRE,
            "NIT"=>$NIT,
            "HABITACIONES"=>$NUM_HABITACIONES,
            "DIRECCION"=>$DIRECCION,
            "PAIS"=>$PAIS_UBICACION,
            "CIUDAD"=>$CIUDAD_UBICACION
        );
        array_push($hotel_arr["records"],$hotelDatos);
    }
    http_response_code(200);
    echo json_encode($hotel_arr);
    
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>