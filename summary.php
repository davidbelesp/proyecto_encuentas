<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Styles/main.css" rel="stylesheet">
    <link href="./Styles/style.css" rel="stylesheet">
    <script src="./Scripts/main.js"></script>
    <link rel="icon" type="image/x-icon" href="./Resources/logo-example.png">
    <script src="https://cdn.plot.ly/plotly-2.18.0.min.js"></script>
    <title>Resumen</title>


    <?php

    session_start();
    if (!isset($_SESSION["Usuario"])) {
        header("Location:login");
    }

    require("./Class/DatosSummary.php");

    $conexion = new DatosSummary($_SESSION["Usuario"]);


    ?>

</head>

<body>
    <div class="page">

        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>

                <ul id="menu">
                    <p id="welcome-hamb">Hola,
                        <?php echo $_SESSION["Usuario"] ?>
                    </p>
                    <a href="./index">
                        <li>Inicio</li>
                    </a>
                    <a href="./form">
                        <li>Encuesta</li>
                    </a>
                    <a href="#">
                        <li>Resumen</li>
                    </a>
                    <a href="./utiles/changePassword.php">
                        <li>Cambiar Contraseña</li>
                    </a>
                    
                    <a href="#">
                    <form method="post" action="./utiles/switchEncProfe.php">
                        <input style="position: initial; opacity: 100%; width: 90%; height: 50px;" type="submit" name=switch_encuesta value=<?php if($conexion->IsEncActivada()){echo "Activado";}else{echo"Desactivado";}?>>
                    </form>
                    </a>
                    <a href="./cerrar_sesion.php">
                        <li>Cerrar Sesion</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="menu">
            <div class="links">
                <img src="./Resources/logo-example.png" alt="logo">
                <a href="./index">Inicio</a>
                <a href="./form">Encuesta</a>
                <a href="./utiles/changePassword.php">Cambiar Contraseña</a>
            </div>
            <div class="user-box">
                <div class="user">
                    <p id="letter">
                        <?php echo strtoupper(substr($_SESSION["Usuario"], 0, 1)) ?>
                    </p>
                </div>
            </div>
            <div class="user-menu">
                <p>Hola,
                    <?php echo $_SESSION["Usuario"] ?>
                </p>
                    <form method="post" action="./utiles/switchEncProfe.php" class="form-activate">

                        <input type="submit" name=switch_encuesta id="switch-encuesta" value=<?php if($conexion->IsEncActivada()){echo "Activado";}else{echo"Desactivado";}?>>
                    </form>
                <a href="./cerrar_sesion.php" id="cerrar">Cerrar Sesion</a>
            </div>
        </div>


        <div class="content">
            <div class="header">
                <div class="prev-summary">
                    <div class="summary box" id="databox">
                        <table class="summary-table">
                            <thead>
                                <th colspan="2">Resumen</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Valoración</td>
                                    <td>
                                        <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getNota(), "-", $conexion->getNota()); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Satisfecho</td>
                                    <td>
                                        <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getSatisfecho(), "-", $conexion->getSatisfecho()); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Insatisfecho</td>
                                    <td>
                                        <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getNoSatisfecho(), "-", $conexion->getNoSatisfecho()); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tareas</td>
                                    <td>
                                        <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getTareas(), "-", $conexion->getTareas()); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Exámenes</td>
                                    <td>
                                        <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getExamen(), "-", $conexion->getExamen()); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="prev-graph">
                    <div class="graph box">
                        <div id="graph"><p id="nodata">No data</p></div>
                    </div>
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
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(), $conexion->printCommentAndDate("error"), $conexion->printCommentAndDate("izquierda")); ?>
                </div>
                <div class="comments-right">
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(), $conexion->printCommentAndDate("error"), $conexion->printCommentAndDate("derecha")); ?>
                </div>
                <div class="comments-media">
                    <?php DatosSummary::switchPrintNullOrValueMessage($conexion->getDatosComentario(), $conexion->printCommentAndDate("error"), $conexion->printCommentAndDate("todos")); ?>
                </div>


            </div>
        </div>
        <div class="footer">
            <p> © 2023 !TrueDevs y sus afiliados</p>
        </div>
    </div>
</body>
<script>
    document.querySelector(".user").style.background = getRandomColor()
</script>
<script>
    setTimeout( () => {makeGraph()}, 0);
    setTimeout(() => {noWLogo()}, 0);
    var x = window.matchMedia("(max-width: 800px)")
    x.addListener(()=>{makeGraph()})
</script>
</html>