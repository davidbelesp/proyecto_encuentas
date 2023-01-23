<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./main.css" rel="stylesheet"></link>
    <link href="./style.css" rel="stylesheet"></link>
    <script src="main.js"></script>
    <title>Resumen</title>
</head>
<body>
    <div class="page">
    <?php
        require("optionsbbdd.php");
        $conexion = new mysqli($host,$user,$pass,$bbdd);
        if($conexion->connect_errno){
            echo "FALLO AL CARGAR LA BASE DE DATOS";
            exit();
        }
        /*Consulta  comentario*/
        $consulta = "SELECT comentario,fecha FROM encuesta";
        $resultado = $conexion->query($consulta);
        $comentario_with_fecha = $resultado->fetch_all(MYSQLI_ASSOC);

        /*Consulta Puntuacion*/
        $consulta = "select sum(nota)/count(nota) from encuesta";
        $resultado = $conexion->query($consulta);
        $notaAvg = $resultado->fetch_row();



        /*IMPRIMIR COMENTARIO IZQ Y DERECHA*/
        function imprimirComentario($lado){
            global $comentario_with_fecha;
            switch ($lado){
                case "izquierda":
                    for($i=0;$i<count($comentario_with_fecha);$i++){
                        if($i==0 || $i%2==0){
                            echo"
                            <div class='comment box'>
                            <p id='comment-text'>".$comentario_with_fecha[$i]["comentario"]."</p>
                            <p id='date'>".$comentario_with_fecha[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    break;
                case "derecha":
                    for($i=0;$i<count($comentario_with_fecha);$i++){
                        if($i%2!=0){
                            echo"
                            <div class='comment box'>
                            <p id='comment-text'>".$comentario_with_fecha[$i]["comentario"]."</p>
                            <p id='date'>".$comentario_with_fecha[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    break;
                default:
                    echo  "<div class='comment box'>
                    <p id='comment-text'>"."ERROR"."</p>
                    <p id='date'>"."ERROR"."</p>
                    </div>";
            }
        }
    ?>
        


        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                  <a href="./index.html"><li>Inicio</li></a>
                  <a href="./form.html"><li>Encuesta</li></a>
                  <a href="#"><li>Resumen</li></a>
                  <a href="#"><li>Contacto</li></a>
                </ul>
            </div>
        </div>
        
        <div class="menu">
            <img src="./logo-example.png" alt="logo">
            <a href="./index.html">Inicio</a>
            <a href="./form.html">Encuesta</a>
            <a href="">Contacto</a>
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
                                    <td> <?php echo round($notaAvg[0],1); ?> </td>
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
                    <?php imprimirComentario("izquierda"); ?>
                </div>
                <div class="comments-right">
                    <?php imprimirComentario("derecha"); ?>
                </div>

                
            </div>
        </div>
        <div class="footer">
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>
    <?php mysqli_close($conexion) ?>
</body>
<script>
setTimeout(() => {noWLogo()}, 0);
</script>
</html>