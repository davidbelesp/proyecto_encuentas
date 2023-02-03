<?php

require("../Class/Login.php");

session_start();
Login::comprobarInicioSesion($_SESSION['Admin']);

$conexion = new Conexion();
$seleccion = $_GET["seleccion"]; 
$id = $_GET["id"]; 

if($seleccion=="usuario"){
    $conexion->db_conexion->query("DELETE FROM usuarios WHERE ID='$id'");   
}elseif($seleccion=="comentario"){
    $conexion->db_conexion->query("DELETE FROM encuesta WHERE ID='$id'");
}
header("Location: index.php");
?>