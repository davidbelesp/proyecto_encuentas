<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            
            text-align: center;
        }
        form{
            width: fit-content;
            margin: 250px auto;
            background-color: yellow;
        }
        table{
            text-align: center;
        }
        p{
            text-align: center;
        }
    </style>
    <?php 
            require("./Class/Login.php");
            if(isset($_POST["enviar"])){
                $login = new Login($_POST["user_login"],$_POST["password_login"]);
                $login->iniciarSesion();
            }
    ?>
</head>
<body>
    <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
        <h1>LOGIN</h1>
        <table>
        <tr><td class="izq">Login:</td><td class="der"><input type="text" name="user_login"></td></tr>
        <tr><td class="izq">Contraseña:</td><td class="der"><input type="password" name="password_login"></td></tr>
        <tr><td colspan="2"><input type="submit" name="enviar"></td></tr>
        </table>
        </tr>
        <?php if(isset($_POST["enviar"])){ echo "<p>Error en el usuario o constraseña</p>";}?>
    </form>
    
</body>
</html>