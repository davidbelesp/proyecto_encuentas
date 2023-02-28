<?php

require("../Class/Login.php");
session_start();
Login::comprobarInicioSesion($_SESSION["Usuario"]);

$datosArray = array(":user"=>$user);
if($_POST["switch_encuesta"]==="Activado"){
    $consulta = "UPDATE usuarios set encActivada=0 where usuario=:user";
    echo "entro en desactivar";
}else{
    $consulta = "UPDATE usuarios set encActivada=1 where usuario= :user";
    echo "entro en activar";
}
$resultado =Conexion::getConexion()->prepare($consulta);
$resultado->bindValue(":user",$_SESSION["Usuario"]);
$resultado->execute();
header("Location:../summary");

?>