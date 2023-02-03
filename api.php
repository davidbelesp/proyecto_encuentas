<html>
<?php
session_start();
if (!isset($_SESSION["Usuario"])) {
    header("Location: ../index.html");
}

require("./Class/DatosSummary.php");

$conexion = new DatosSummary($_SESSION["Usuario"]);


$notaDia = $conexion->getNotaDia();
$fecha = $conexion->getFecha();

echo('{<br>');
for($i = 0; $i<count($notaDia); $i++){
    echo('"' . $fecha[$i][0] . '"' . ': [');
    for($j = 0; $j<3; $j++){
        if(is_null($notaDia[$i][$j])){
            echo('null');
        }
        else{
            echo(round($notaDia[$i][$j]));
        }
        if($j!=2){
            echo(',');
        }
        else{
            echo(']');
        }
    }

    if($i!=count($notaDia)-1){
        echo(',<br>');
    }
    else{
        echo('<br>}');
    }
}





    ?>
</html>