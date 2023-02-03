<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Styles/main.css" rel="stylesheet">
    <link href="./Styles/style.css" rel="stylesheet">
    <script src="./Scripts/main.js"></script>
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
                    <a href="#">
                        <li>Contacto</li>
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
                <a href="">Contacto</a>
            </div>
            <div class="user-box">
                <div class="user">
                    <p id="letter">
                        <?php echo substr($_SESSION["Usuario"], 0, 1) ?>
                    </p>
                </div>
            </div>
            <div class="user-menu">
                <p>Hola,
                    <?php echo $_SESSION["Usuario"] ?>
                </p>
                <a href="./cerrar_sesion.php" id="cerrar">Cerrar Sesion</a>
            </div>
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
                        <div id="graph"></div>
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
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>
</body>
<script>
    setTimeout(() => { noWLogo() }, 0);
</script> 
<script>
    function makeGraph() {
        // const graphDiv = document.querySelector("#graph")

        trace1 = {
            x: [1, 2, 3, 4, 5],
            y: [1, 2, 4, 8, 16]
        }

        data = [trace1]

        layout = {
            autosize: false,
            width: 500,
            height: 100,
            margin: {
                l: 0,
                r: 0,
                b: 0,
                t: 0,
                pad: 4
            },
            paper_bgcolor: 'rgba(0,0,0,0)',
            plot_bgcolor: 'rgba(0,0,0,0)'
        };

        config = {
            // responsive:true
        }

        Plotly.newPlot(graphDiv, data, layout)
    }

    setTimeout(() => {
        makeGraph()
    }, 0);
</script>

</html>