<?php
require("../Class/Conexion.php");
$conexion = new Conexion();
$seleccion = $_GET["seleccion"]; 
$id = $_GET["id"]; 

if($seleccion=="usuario"){
    $conexion->db_conexion->query("DELETE FROM USUARIOS WHERE ID='$id'");   
}elseif($seleccion=="comentario"){
    $conexion->db_conexion->query("DELETE FROM ENCUESTA WHERE ID='$id'");
}
header("Location: index.php");
?>