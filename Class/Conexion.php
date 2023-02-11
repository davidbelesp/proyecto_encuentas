<?php
require "config.php";

class Conexion extends PDO{
    private static $db_conexion=null;

    private function __construct(){
        try{
            parent::__construct(DB_DSN_CONNECT,DB_USER,DB_PASS);
        }catch(Exception $excepcion){
            /*echo "ERROR: " . $excepcion->getMessage();*/
            echo "ERROR";
        }
    }

    public static function getConexion(){
        if(is_null(self::$db_conexion)){
            self::$db_conexion = new Conexion();
            self::$db_conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            self::$db_conexion->exec("SET CHARACTER SET ".DB_CHARSET);
        }
        return self::$db_conexion;
    }
}
?>