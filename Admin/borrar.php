<?php

require("../Class/Login.php");

session_start();
Login::comprobarInicioSesion($_SESSION['Admin']);

$seleccion = $_GET["seleccion"]; 
$id = htmlentities(addslashes($_GET["id"])); 

if($seleccion=="usuario"){
    Conexion::getConexion()->query("DELETE FROM usuarios WHERE ID='$id'");   
}elseif($seleccion=="comentario"){
    Conexion::getConexion()->query("DELETE FROM encuesta WHERE ID='$id'");
}
header("Location: index.php");
?>