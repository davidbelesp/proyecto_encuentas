<html>
<?php
session_start();
if (!isset($_SESSION["Usuario"]) {
    header("Location: ../index.html");
}
$array = array(
    "dia1"  => "1",
    "dia2"  => "2",
    "dia3"  => "3",
    "dia4"  => "4",
);
echo var_dump($array); 
    ?>
</html>