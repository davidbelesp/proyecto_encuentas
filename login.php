<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/login.css">
    <link rel="stylesheet" href="./Styles/main.css">
    <title>Log in</title>
    <?php
    require("./Class/Login.php");
    if (isset($_POST["enviar"])) {
        $login = new Login($_POST["user_login"], $_POST["password_login"]);
        $login->iniciarSesion();
    }
    ?>
</head>

<body>
    <div class="content">
        
        <div class="loginbox">
            <h2>Acceder</h2>
            <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
                
            <div class="box">
                <input type="text" name="user_login" required>
                <label>Usuario</label>
                </div>
                
                <div class="box">
                    <input type="password" name="password_login" required autocomplete="off">
                    <label>Contraseña</label>
                </div>
                
                <div class="submitbox">
                    <a href="./index">Volver</a>
                    <span id="underline"></span>
                    <input type="submit" name="enviar">
                </div>
                
                
                
            </form>
        </div>
        
        
        <div class="errorbox">
            <div class="message">
                <p>Error en el usuario o constraseña</p>
                <?php if (isset($_POST["enviar"])) {
                    echo "<script>document.querySelector('.errorbox').style.display = 'block'</script>";
                } ?>
            </div>
        </div>

    </div>
</body>


</html>