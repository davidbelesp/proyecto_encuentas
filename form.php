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
            <div class="links">
                <img src="./Resources/logo-example.png" alt="logo">
                <a href="./index">Inicio</a>
                <a href="./summary">Resumen</a>
                <a href="">Contacto</a>
            </div>
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
                                <svg width="50px" height="50px"
                                viewBox="0 0 24 24" fill="none" 
                                id="like" onclick="likeButtons('like')"
                                data-like
                                class="disabled"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 9.40652C3.44772 9.40652 3 9.85424 3 10.4065V18.4065C3 20.0634 4.34315 21.4065 6 21.4065H9V9.40652H4Z" />
                                <path d="M14.3059 4.16184C13.9067 2.9643 12.3868 2.60551 11.4942 3.4981L7.87868 7.11364C7.31607 7.67624 7 8.43931 7 9.23495V20.4065C7 20.9588 7.44772 21.4065 8 21.4065H15.6812C16.8813 21.4065 17.9659 20.6913 18.4386 19.5883L20.7574 14.1778C20.9175 13.8043 21 13.4023 21 12.996V12.4065C21 10.7497 19.6569 9.40653 18 9.40653H14.2808L14.4771 8.62115C14.8452 7.14867 14.7858 5.60175 14.3059 4.16184Z"/>
                                </svg>
                        <input type="hidden" name="satisf" value="si" id="like-radio">
                                <svg width="50px" height="50px"
                                viewBox="0 0 24 24" fill="none" 
                                id="like" onclick="likeButtons('dislike')"
                                data-dislike
                                class="disabled"
                                transform="rotate(180)"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 9.40652C3.44772 9.40652 3 9.85424 3 10.4065V18.4065C3 20.0634 4.34315 21.4065 6 21.4065H9V9.40652H4Z"/>
                                <path d="M14.3059 4.16184C13.9067 2.9643 12.3868 2.60551 11.4942 3.4981L7.87868 7.11364C7.31607 7.67624 7 8.43931 7 9.23495V20.4065C7 20.9588 7.44772 21.4065 8 21.4065H15.6812C16.8813 21.4065 17.9659 20.6913 18.4386 19.5883L20.7574 14.1778C20.9175 13.8043 21 13.4023 21 12.996V12.4065C21 10.7497 19.6569 9.40653 18 9.40653H14.2808L14.4771 8.62115C14.8452 7.14867 14.7858 5.60175 14.3059 4.16184Z"/>
                                </svg>
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

    function likeButtons(event){
        if (!event) return;
        const dislike = document.querySelector("[data-dislike]");
        const like = document.querySelector("[data-like]");
        const input = document.getElementById("like-radio")
        if (event == "like"){
            like.classList = "like"
            dislike.classList = "disabled"
            input.value = "si"
        }
        if (event == "dislike"){
            dislike.classList = "dislike"
            like.classList = "disabled"
            input.value = "no"
        }
        console.log(input.value)
        // const inputS = document.getElementById("like-radio")
        // inputS.value = "si"
        // console.log(event)
    }

</script>
<script>
    setTimeout(() => { noWLogo() }, 0);
</script>

</html>