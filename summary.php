<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Styles/main.css" rel="stylesheet"></link>
    <link href="./Styles/style.css" rel="stylesheet"></link>
    <script src="main.js"></script>
    <title>Resumen</title>


    <?php

        session_start();
        if(!isset($_SESSION["Usuario"])){
            header("Location:login.php");
        }

        require("./Class/DatosSummary.php");

        $conexion = new DatosSummary();
        if($conexion->db_conexion!=NULL){
            $conexion->setUser($_SESSION["Usuario"]);
            $conexion->setDatosComentario();
            $conexion->setDatosGenerales();
        }


    ?>

</head>
<body>
    <div class="page">

        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                  <a href="./index"><li>Inicio</li></a>
                  <a href="./form"><li>Encuesta</li></a>
                  <a href="#"><li>Resumen</li></a>
                  <a href="#"><li>Contacto</li></a>
                  <a href="./cerrar_sesion.php"><li>Cerrar Sesion</li></a>
                </ul>
            </div>
        </div>
        
        <div class="menu">
            <img src="./Resources/logo-example.png" alt="logo">
            <a href="./index.html">Inicio</a>
            <a href="./form.html">Encuesta</a>
            <a href="">Contacto</a>
            <a href="./cerrar_sesion.php">Cerrar Sesion</a>
        </div>


        <div class="content">
            <div class="header">
                <div class="prev-summary">
                    <div class="summary box">
                        <table class="summary-table">
                            <thead>
                                <th colspan="2">Resumen</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Valoración</td>
                                    <td> <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosGenerales(),"-",$conexion->getDatosGenerales()); ?> </td>
                                </tr>
                                <tr>
                                    <td>Satisfecho</td>
                                    <td>173</td>
                                </tr>
                                <tr>
                                    <td>Insatisfecho</td>
                                    <td>46</td>
                                </tr>
                                <tr>
                                    <td>Tareas</td>
                                    <td>9</td>
                                </tr>
                                <tr>
                                    <td>Exámenes</td>
                                    <td>3.4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="prev-graph">
                    <div class="graph box"></div>
                </div>
            </div>
            <div class="divisor">
                <div class="half-1"></div>
                <div class="divisor-text">
                    <p>Comentarios</p>
                </div>
                <div class="half-2"></div>
            </div>
            <div class="comments">
                <div class="comments-left">
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(),$conexion->printCommentAndDate("error"),$conexion->printCommentAndDate("izquierda")); ?>
                </div>
                <div class="comments-right">
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(),$conexion->printCommentAndDate("error"),$conexion->printCommentAndDate("derecha")); ?>
                </div>
                <div class="comments-media">
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(),$conexion->printCommentAndDate("error"),$conexion->printCommentAndDate("todos")); ?>
                </div>

                
            </div>
        </div>
        <div class="footer">
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>
</body>
<script>
setTimeout(() => {noWLogo()}, 0);
</script>
</html>