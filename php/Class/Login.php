<?php
require("Conexion.php");
class Login extends Conexion{
    private $user;
    private $pass;
    public function __construct($user_post,$pass_post){
        parent::__construct();
        $this->user = htmlentities(addslashes($user_post));
        $this->pass = htmlentities(addslashes($pass_post));
    }
    public function iniciarSesion(){
        try{

            $consulta = "SELECT Usuario from usuarios where usuario = :user and password = :pass";
            $resultado = $this->db_conexion->prepare($consulta);
    
    
            $resultado->bindValue(":user",$this->user);
            $resultado->bindValue(":pass",$this->pass);
            $resultado->execute();
            $numero_resultado_coincidencia = $resultado->rowCount();
            if($numero_resultado_coincidencia!=0){
                session_start();
                $_SESSION["Usuario"] = $this->user;
    
                header("location:summary.php");
            }

        }catch(Exception $excepcion){

            echo "ERROR AL REALIZAR LA CONSULTA:";
            echo "<br><br>";
            echo "ERROR:". $excepcion->getMessage();
        }

    }
    public static function cerrarSession(){
        session_start();
        session_destroy();
        header("Location:index.html");
    }

}
?>