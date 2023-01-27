<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="./Styles/style.css" rel="stylesheet"></link>
    <link href="./Styles/main.css" rel="stylesheet" >
    <link href="./Styles/form.css" rel="stylesheet" >
    <script src="./Scripts/filterBadWords.js"></script>
    <title>formulario</title>
</head>
<body>
    <?php
    require("./Class/Form.php");
    session_start();
    
    if(isset($_POST["enviar"])){
        $conexion = new Form($_POST["comentario"],$_POST["nota"]);
        $conexion->enviarFormulario();
        header("Location: index.html");
    }
    ?>
    <div class="page">
        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                  <a href="./index.html"><li>Inicio</li></a>
                  <a href="./summary.html"><li>Resumen</li></a>
                  <a href="#"><li>Contacto</li></a>
                </ul>
            </div>
        </div>
        
        <div class="menu">
            <img src="./Resources/logo-example.png" alt="logo">
            <a href="./index.html">Inicio</a>
            <a href="./summary.html">Resumen</a>
            <a href="">Contacto</a>
        </div>

        <div class="content">
            <form id="myForm" action= <?php echo $_SERVER ["PHP_SELF"];?>  method="post" id="form">
                <select name="profesor">
                <option value="PROFE1">Volvo</option>
                <option value="PROFE2">Volvo</option>
                </select>
                <label for="nota"> Nota: </label>
                <input type="range" name="nota" value="1" min="1" max="10" required>
                <br>
                <label for="comentario"> Comentario: </label>
                <input type="text" name="comentario">
                <br>
                <!---<input type="button" onclick="validateForm()" name="enviar" value="submit"></input>--->
                <button type="submit" name="enviar">Enviar</button>
            </form>
        </div>
        <div class="footer">
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>
    
    
</body>
</html>