<?php
class Database{
    private $host="localhost";
    private $db_name="decameron";
    private $username="postgres";
    private $password="asd123";
    public $conexion;

    public function getConexion(){
        $this->conexion=null;
        try{
            $this->conexion=pg_connect("host=".$this->host." dbname=".$this->db_name." user=".$this->username." password=".$this->password);
            echo("Conexion Establecida \n");
        }catch(pg_connect $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conexion;
    }
}
?>