<?php
require("Conexion.php");
class Login{
    private $user;
    private $pass;

    public function __construct($user_post,$pass_post){
        $this->user = htmlentities(addslashes($user_post));
        $this->pass = htmlentities(addslashes($pass_post));
    }
    public function iniciarSesion(){
        try{
            $consulta = "SELECT tipo from usuarios where usuario = :user";
            $resultado = Conexion::getConexion()->prepare($consulta);
            $resultado->bindValue(":user",$this->user);
            $resultado->execute();
            $tipo = $resultado->fetch();
            if($tipo){ $tipo = $tipo[0];}

            $consulta = "SELECT usuario from usuarios where usuario = :user and password = :pass";
            $resultado = Conexion::getConexion()->prepare($consulta);
    
            $resultado->bindValue(":user",$this->user);
            $resultado->bindValue(":pass",$this->pass);
            $resultado->execute();
            $numero_resultado_coincidencia = $resultado->rowCount();
            if($numero_resultado_coincidencia!=0){
                session_start();
                $_SESSION["$tipo"] = $this->user;

                if($tipo=="Usuario"){
                    header("location:summary");
                }else if($tipo=="Admin"){
                    header("location: ./Admin/");
                }

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
        header("Location:index");
    }
    public static function comprobarInicioSesion(&$sesion){
        if(!isset($sesion)){
            header("Location: ../login.php");
        }

    }

}
?>