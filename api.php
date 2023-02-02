<html>
<?php
session_start();
if (!isset($_SESSION["Usuario"])) {
    header("Location: ../index.html");
}

require("./Class/DatosSummary.php");

$conexion = new DatosSummary($_SESSION["Usuario"]);

$notaAvg=$conexion->getNota();
$notaTareas=$conexion->getTareas();
$notaExamen=$conexion->getExamen();

echo('{' . '<br>');
echo ('nota: ' . $notaAvg . ',<br>');
echo('Tareas :' . $notaTareas) . ',<br>';
echo('Examen: ' . $notaExamen) . '<br>';
echo('}')

    ?>
</html>