<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/login.css">
    <link rel="stylesheet" href="../Styles/main.css">
    <link rel="stylesheet" href="../Styles/chpass.css">
    <link rel="icon" type="image/x-icon" href="./Resources/logo-example.png">
    <script src="./Scripts/main.js"></script>
    <title>Cambiar Contraseña</title>
</head>
<body>
    <?php
    require("../Class/Login.php");
    
    session_start();
    Login::comprobarInicioSesion($_SESSION['Usuario']);
    
    if(isset($_POST["enviarform"])){
        try{
            if($_POST["password"]==$_POST["password2"]){
                #DATOS A METER
                $usuario = htmlentities(addslashes( $_SESSION["Usuario"] ));
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT,['cost'=>10]);
                #QUERY
                $consulta = "UPDATE usuarios set password=:password where usuario= :usuario";
                $resultado = Conexion::getConexion()->prepare($consulta);
                $array= array(":usuario"=>$usuario,":password"=>$password);
                $resultado->execute($array);
                header("Location: ../summary");
            }else{
                echo "
                    <script>
                        setTimeout(() => {displayError()}, 0);
                        setTimeout(() => {displayError(false)}, 2000);
                    </script>";
            }
        }catch(Exception $e){
            echo $e->getMessage();
            echo "Error, intentelo de nuevo.";
        }
    }



    ?>
    <div class="content">

        <div class="loginbox">
            <h2>Cambiar Contraseña</h2>
            <h2 id="name"><?php echo $_SESSION["Usuario"] ?></h2>
            <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
                <div class="box">
                    <input type='password' name='password' required>
                    <label>Nueva contraseña</label>
                </div>
                <div class="box">
                    <input type='password' name='password2' required>
                    <label>Repetir contraseña</label>
                </div>
                <div class="submitbox">
                    <a href="../summary">Volver</a>
                    <span id="underline"></span>
                    <input type='submit' name='enviarform' value='Enviar'>
                </div>
            </form>
        </div>

        <div class="errordiv">
            <div class="message">
                <p>Las contraseñas no coinciden</p>
            </div>
        </div>

    </div>


</body>
<script>
    document.addEventListener("click", () => {
        displayError(false)
    })

    setTimeout(() => {noWLogo();}, 0);
    
    function displayError(a = true) {
        const box = document.querySelector(".errordiv");
        a ? box.style.display = "flex" : box.style.display = "none"
    }

</script>
</html>