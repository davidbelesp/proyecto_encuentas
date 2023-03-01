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
    require("../Class/Login.php");
    
    session_start();
    Login::comprobarInicioSesion($_SESSION['Admin']);

    $form = $_GET["form"];
    
    /*COMPROBAR ENVIOU SUARIO O ENVIO COMENTARIO*/
    if(isset($_POST["enviousuario"])){
        #DATOS A METER
        $id = htmlentities(addslashes( $_POST["id"] ));
        $usuario = htmlentities(addslashes( $_POST["usuario"] ));
        
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT,['cost'=>10]);
        #QUERY
        $consulta = "UPDATE usuarios set usuario=:usuario,password=:password where id= :id";
        $resultado = Conexion::getConexion()->prepare($consulta);
        $resultado->execute(array(":usuario"=>$usuario,":password"=>$password,":id"=>$id));
        header("Location: ./index.php");
    }elseif(isset($_POST["enviocommentario"])){
        #DATOS A METER
        $id= htmlentities(addslashes( $_POST["id"]  ));
        $idProfesor = htmlentities(addslashes( $_POST["idprofesor"]  ));
        $comentario = htmlentities(addslashes( $_POST["comentario"]  ));
        $nota = htmlentities(addslashes( $_POST["nota"]  ));
        $tareas = htmlentities(addslashes( $_POST["tareas"]  ));
        $examenes = htmlentities(addslashes( $_POST["examenes"]  ));
        $satifaccion = htmlentities(addslashes( $_POST["satifaccion"]  ));
        $fecha = htmlentities(addslashes( $_POST["fecha"]  ));
        #QUERY
        $consulta = "UPDATE encuesta set idProfesor=:idProfesor,nota=:nota,comentario=:comentario,tareas=:tareas,examenes=:examenes,satifaccion=:satifaccion,fecha=:fecha where id= :id";
        $datosArray = array(":idProfesor"=>$idProfesor,":nota"=>$nota,":comentario"=>$comentario,":tareas"=>$tareas,":examenes"=>$examenes,":satifaccion"=>$satifaccion,":fecha"=>$fecha,":id"=>$id);
        $resultado = Conexion::getConexion()->prepare($consulta);
        $resultado->execute($datosArray);
        header("Location: ./index.php");
    }

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
                    <tr><td>Contraseña</td><td><input type='text' name='password' value=''></td></tr>
                    </table>
                    <input type='submit' name='enviousuario' value='enviar'>
                    ";
                }elseif($form=="comentario"){
                    $id=$_GET["id"];
                    $idProfesor = $_GET["idprofesor"];
                    $comentario = $_GET["comentario"];
                    $nota = $_GET["nota"];
                    $tareas = $_GET["tareas"];
                    $examenes = $_GET["examenes"];
                    $satifaccion = $_GET["satifaccion"];
                    $fecha = $_GET["fecha"];

                    echo "
                    <table>
                    <input type='hidden' name='id' value='$id'>
                    <tr><td>ID PROFE</td><td><input type='text' name='idprofesor' value='$idProfesor'></td></tr>
                    <tr><td>Comentario</td><td><input type='text' name='comentario' value='$comentario'></td></tr>
                    <tr><td>Nota</td><td><input type='text' name='nota' value='$nota'></td></tr>
                    <tr><td>Tareas</td><td><input type='text' name='tareas' value='$tareas'></td></tr>
                    <tr><td>Examenes</td><td><input type='text' name='examenes' value='$examenes'></td></tr>
                    <tr><td>Satifaccion</td><td><input type='text' name='satifaccion' value='$satifaccion'></td></tr>
                    <tr><td>Fecha</td><td><input type='date' name='fecha' value='$fecha'></td></tr>
                    </table>
                    <input type='submit' name='enviocommentario' value='enviar'>
                    ";
                }
            ?>
        </center>
        </form>
</body>
</html>