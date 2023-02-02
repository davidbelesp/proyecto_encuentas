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
        td{border-color: black; border-style: solid;border-width: 2px;}
    </style>
</head>


<body>
    <?php
    require("../Class/Conexion.php");
    
    if(isset($_POST["enviousuario"])){
        $id = $_POST["id"];
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $conexion = new Conexion();
        $consulta = "UPDATE usuarios set usuario=:usuario,password=:password where id= :id";
        $resultado = $conexion->db_conexion->prepare($consulta);
        $resultado->execute(array(":usuario"=>$usuario,":password"=>$password,":id"=>$id));
        header("Location: ./index.php");
    }
    $form = $_GET["form"];

    ?>

        <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
            <center>
            <h1>ACTUALIZAR</h1>
            <?php
                if($form=="usuario"){
                    $id = $_GET["id"];
                    $usuario = $_GET["usuario"];
                    $password = $_GET["password"];
                
                    echo "
                    <table>
                    <input type='hidden' name='id' value='$id'>
                    <tr><td>Usuario</td><td><input type='text' name='usuario' value='$usuario'></td></tr>
                    <tr><td>Contraseña</td><td><input type='text' name='password' value='$password'></td></tr>
                    </table>
                    <input type='submit' name='enviousuario' value='enviar'>
                    ";
            }
            ?>
        </center>
        </form>
</body>
</html>