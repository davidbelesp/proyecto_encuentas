<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="./Styles/style.css" rel="stylesheet">
    </link>
    <link href="./Styles/main.css" rel="stylesheet">
    <link href="./Styles/form.css" rel="stylesheet">
    <script src="./Scripts/main.js"></script>
    <title>Encuesta</title>
</head>

<body>
    <?php
    require("./Class/Form.php");
    session_start();
    $conexion = new Form();
    if (isset($_POST["enviar"])) {
        $conexion->setProfesor($_POST["profesor"]);
        $conexion->setData($_POST["comentario"], $_POST["nota"],$_POST["satisf"],$_POST["exam"],$_POST["tareas"]);
        $conexion->enviarFormulario();
        header("Location: index");
    }
    ?>
    <div class="page">
        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                    <a href="./index">
                        <li>Inicio</li>
                    </a>
                    <a href="./summary">
                        <li>Resumen</li>
                    </a>
                    <a href="#">
                        <li>Contacto</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="menu">
            <img src="./Resources/logo-example.png" alt="logo">
            <a href="./index">Inicio</a>
            <a href="./summary">Resumen</a>
            <a href="">Contacto</a>
        </div>

        <div class="content">
            <div class="form-box">
                <form id="myForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="form">
                    <select name="profesor" id="selectProfesor">
                        <?php $conexion->PrintProfesoresHTMLSelect(); ?>
                    </select>

                    <p>Nota</p>
                    <div class="nota fancybox">
                        <input id="notaInput" type="range" name="nota" value="1" min="1" max="10"
                            oninput="updateNumber(event,'nota')" required>

                        <p id="numberNota">1</p>
                    </div>

                    <span id="form-div"></span> <!--------------------------------------------------------->

                    <p>Satisfaccion</p>
                    <div class="election">
                        <input type="radio" name="satisf" value="si">
                        <input type="radio" name="satisf" value="no">
                    </div>

                    <span id="form-div"></span> <!--------------------------------------------------------->

                    <p>Examenes</p>

                    <div class="examenes fancybox">
                        <input id="examInput" type="range" name="exam" value="1" min="1" max="10"
                            oninput="updateNumber(event,'exam')" required>

                        <p id="numberExam">1</p>
                    </div>

                    <span id="form-div"></span> <!--------------------------------------------------------->

                    <p>Tareas</p>

                    <div class="tareas fancybox">
                        <input id="tareaInput" type="range" name="tareas" value="1" min="1" max="10"
                            oninput="updateNumber(event,'tarea')" required>

                        <p id="numberTarea">1</p>
                    </div>

                    <span id="form-div"></span> <!--------------------------------------------------------->

                    <p>Comentario</p>
                    <textarea type="text" id="comentario" name="comentario" maxlength="200"
                        placeholder="Escribe un comentario para el profesor"></textarea>

                    <span id="form-div"></span> <!--------------------------------------------------------->

                    <button type="submit" onclick="return validateForm(event)" name="enviar" id="send">Enviar</button>
                </form>
            </div>
        </div>
        <div class="footer">
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>

</body>
<script>
    function updateNumber(event, mode) {
        let numberNota = document.getElementById("numberNota");
        let numberExam = document.getElementById("numberExam");
        let numberTarea = document.getElementById("numberTarea");

        switch (mode) {
            case "nota":
                numberNota.innerHTML = event.target.value;
                break;
            case "exam":
                numberExam.innerHTML = event.target.value;
                break;
            case "tarea":
                numberTarea.innerHTML = event.target.value;
                break;
            default:
                alert("EXCEPTION CHANGING NUMBER")
                break;
        }
    }

</script>
<script>
    setTimeout(() => { noWLogo() }, 0);
</script>

</html>