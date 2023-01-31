<?php
    require("./Class/Form.php");
    session_start();
    $conexion = new Form();
    if(isset($_POST["enviar"])){
        $conexion->setProfesor($_POST["profesor"]);
        $conexion->setComment($_POST["comentario"],$_POST["nota"]);
        $conexion->enviarFormulario();
        header("Location: index");
    }
?>