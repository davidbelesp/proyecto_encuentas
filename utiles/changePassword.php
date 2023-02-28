<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{background-color: rgb(164, 242, 252);height: 100%;}
        form{height: 100%;}
        table{border-collapse: collapse;margin-top:10%;}
        h1{
            padding-top: 100px;
        }
        td{border-color: black; border-style: solid;border-width: 2px;}
        a {
            float: right;
            padding-right: 20px;
        }
        a input{
            float: right;
            border-radius: 20px;
        }
        a input:hover{
           background-color: black;
           color: white;
        }
    </style>
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
                $password = crypt(htmlentities(addslashes($_POST["password"])),DB_NAME);
                #QUERY
                $consulta = "UPDATE usuarios set password=:password where usuario= :usuario";
                $resultado = Conexion::getConexion()->prepare($consulta);
                $array= array(":usuario"=>$usuario,":password"=>$password);
                $resultado->execute($array);
                header("Location: ../summary");
            }else{
                echo "Las contraseñas no son las mismas.";
            }
        }catch(Exception $e){
            echo $e->getMessage();
            echo "Error, intentelo de nuevo.";
        }
    }



    ?>

        <center>
        <a href="../summary"><input type="button" value="Volver atras"></a>
        <h1>ACTUALIZAR CONTRASEÑA</h1>
        
        <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
        <table>
        <tr><td>Usuario</td><td style="text-align: center;"><?php echo $_SESSION["Usuario"] ?></td></tr>
        <tr><td>Contraseña</td><td><input type='password' name='password' value='' placeholder="Introduce una contraseña."></td></tr>
        <tr><td>Repetir contraseña</td><td><input type='password' name='password2' value='' placeholder="Introduce de nuevo la contraseña."></td></tr>
        </table>
        <input type='submit' name='enviarform' value='enviar'>
        </form>
        </center>
        </form>
</body>
</html>