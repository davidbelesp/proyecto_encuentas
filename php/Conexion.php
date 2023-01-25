<?php
require "config.php";

class Conexion{
    public $db_conexion;

    public function __construct(){
        try{
            $this->db_conexion = new PDO(DB_DSN_CONNECT,DB_USER,DB_PASS);
            $this->db_conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db_conexion->exec("SET CHARACTER SET ".DB_CHARSET);

            return $this->db_conexion;

        }catch(Exception $excepcion){
            /*echo "ERROR: " . $excepcion->getMessage();*/
            echo "ERROR";
        }
    }
}
?>