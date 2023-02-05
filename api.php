<html>
<?php
session_start();
if (!isset($_SESSION["Usuario"])) {
    header("Location: ../index.html");
}

require("./Class/DatosSummary.php");

$conexion = new DatosSummary($_SESSION["Usuario"]);


$datosGrafico = $conexion->getdatosGrafico();

if($datosGrafico!==NULL){
    echo '{<br>';
    foreach ($datosGrafico as $datos){
        echo '"'.$datos[0].'": ['.round($datos[1]).','.round($datos[2]).','.round($datos[3]).']';
        if($datos!==$datosGrafico[count($datosGrafico)-1]){     echo ',';      }

        echo "<br>";
    }
    echo "}";
}

    ?>
</html>