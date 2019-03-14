<?php
class Hotel{
    private $conexion;
    private $nombre_tabla="HOTEL";

    public $id;
    public $nombre;
    public $nit;
    public $numHabitaciones;
    public $direccion;
    public $pais;
    public $ciudad;

    public function __construct($db){
        $this->conexion=$db;
    }
    public function read(){
        $query='SELECT * FROM "HOTEL"';
        $stmt=pg_query($this->conexion,$query) or die('error en busqueda hotel');
        return $stmt;
    }
    public function read_one(){
        $query='SELECT * FROM "HOTEL" WHERE "ID_HOTEL"=$1';
        echo($query);
        try{
            $stmt=pg_query_params($this->conexion,$query,array((int)$this->id));
            $row=pg_fetch_assoc($stmt);
            extract($row);
            $this->nombre=$NOMBRE;
            $this->nit=$NIT;
            $this->numHabitaciones=$NUM_HABITACIONES;
            $this->direccion=$DIRECCION;
            $this->pais=$PAIS_UBICACION;
            $this->ciudad=$CIUDAD_UBICACION;
        }catch(pg_query_params $exception){

        }
    }
    public function create(){
        $query='INSERT INTO "HOTEL" VALUES($1,$2,$3,$4,$5,$6,$7)';
        try{
            if(pg_query_params($this->conexion,$query,array($this->id,$this->nombre,$this->nit,$this->numHabitaciones,$this->direccion,$this->pais,$this->ciudad))){
                return true;
            }else{
                return false;
            }
        }catch(pg_query_params $exception){
            echo "ERROR AL INSERTAR: " .pg_last_error($conexion);
            return false;
        }
    }
}


?>