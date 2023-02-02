<?php
require("../Class/Conexion.php");
$conexion = new Conexion();
$id = $_GET["id"]; 
$conexion->db_conexion->query("DELETE FROM USUARIOS WHERE ID='$id'");
header("Location: index.php");
?>