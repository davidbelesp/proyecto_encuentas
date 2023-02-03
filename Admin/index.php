<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/crud.css">
</head>
<body>
    <?php
    require("../Class/Conexion.php");
    $conexion = new Conexion();
    /*CREAR USUARIO O CREAR COMENTARIO*/
    if(isset($_POST["crearuser"])){
        try{
            $usuario = $_POST["ususario"];
            $password = $_POST["password"];
            $tipo = $_POST["tipo"];
            $resultado = $conexion->db_conexion->prepare("insert into usuarios(usuario,password,tipo) values(:usuario,:password,:tipo)");
            $resultado->execute(array(":usuario"=>$usuario,":password"=>$password,":tipo"=>$tipo));
        }catch(Exception $excepcion){
            echo "ERROR CREAR USUARIO";
        }
    }
    if(isset($_POST["crearcomentario"])){
        try{
            $profesor = $_POST["profesor"];
            $comentario = $_POST["comentario"];
            $nota = $_POST["nota"];
            $examen = $_POST["examen"];
            $tareas = $_POST["tareas"];
            $fecha = $_POST["fecha"];
            $satifaccion = $_POST["satifaccion"];
            $resultado = $conexion->db_conexion->prepare("insert into encuesta(idProfesor,comentario,nota,examenes,tareas,fecha,satifaccion) values(:profesor,:comentario,:nota,:examen,:tareas,:fecha,:satifaccion)");
            $resultado->execute(array(":profesor"=>$profesor,":comentario"=>$comentario,":nota"=>$nota,":examen"=>$examen,":tareas"=>$tareas,":fecha"=>$fecha,":satifaccion"=>$satifaccion));
        }catch(Exception $excepcion){
            echo "ERROR CREAR COMENTARIO";
        }
    }
    /*QUERY*/
    $tableUsuarios = $conexion->db_conexion->query("Select * from usuarios")->fetchAll(PDO::FETCH_OBJ);
    $tableComment = $conexion->db_conexion->query("Select * from encuesta")->fetchAll(PDO::FETCH_OBJ);
    //echo var_dump($tableComment);
    ?>


    <div class="creacion">



        <div class="seleccion">
        <h1>Visualizar</h1>
        <input type="radio" name="seleccion" checked>
        <input type="radio" name="seleccion">
        </div>


        <div class="dividir" style="margin-top: 10px"> </div>


        <form id="createuser" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h1>Crear Usuario</h1>
            <input type="text" name="ususario" placeholder="Usuario">
            <input type="text" name="password" placeholder="contraseña">
            <label>Usuario:<input type="radio" value="Usuario" name="tipo" checked>Admin:<input type="radio" value="Admin" name="tipo"></label>
            <input type="submit" name="crearuser">
        </form>


        <div class="dividir"> </div>


        <form id="createcomment" action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <h1>Crear comentario</h1>
            <input type="text" name="profesor" placeholder="profesor">
            <input type="text" name="comentario" placeholder="Comentario">
            <input type="number" name="nota" placeholder="Nota">
            <input type="number" name="examen" placeholder="Nota examenes">
            <input type="number" name="tareas" placeholder="Nota tareas">
            <input type="date" name="fecha" placeholder="fecha">
            <label>SATIFACCION:<br>
            <input class="radio" type="radio" name="satifaccion" value="si" checked>
            <input class="radio" type="radio" name="satifaccion" value="no">
            </label>
            <input type="submit" name="crearcomentario">
        </form>

    </div>

    
    <div class="tablas">
        <table >
            <tr><th>ID</th><th>USUARIO</th><th>CONTRASEÑA</th><th>TIPO</th></tr>
            <?php foreach($tableUsuarios as $datosUsuario):?>
            <tr> <td><?php echo $datosUsuario->id;?></td> <td><?php echo $datosUsuario->usuario;?></td> <td><?php echo $datosUsuario->password;?></td> <td><?php echo $datosUsuario->tipo;?></td> 
            <td class="boton"><a href="./actualizar.php?form=usuario&id=<?php echo $datosUsuario->id?>&usuario=<?php echo $datosUsuario->usuario?>&password=<?php echo $datosUsuario->password;?> "><input type="button" value="Actualizar"></td></a>
            <td class="boton"><a href="./borrar.php?id=<?php echo $datosUsuario->id?>&seleccion=usuario" ><input type="button" value="Eliminar"></a></td></tr>
            <?php endforeach ?>
        </table>
        <br>
        <br>
        <br>
        <table>
            <tr><th>ID</th><th>ID PROFE</th><th>COMENTARIO</th><th>NOTA</th><th>TAREAS</th><th>EXAMENES</th><th>SATIFACCION</th><th>FECHA</th></tr>
            <?php foreach($tableComment as $datosComment):?>
            <tr> <td><?php echo $datosComment->id?></td>   <td><?php echo $datosComment->idProfesor?></td>  <td><?php echo $datosComment->comentario?></td>     <td><?php echo $datosComment->nota?></td>    <td><?php echo $datosComment->tareas?></td>  <td><?php echo $datosComment->examenes?></td>  <td><?php echo $datosComment->satifaccion?></td>    <td><?php echo $datosComment->fecha?></td>
            <td class="boton"><a href="./actualizar.php?form=comentario&id=<?php echo $datosComment->id?>&idprofesor=<?php echo $datosComment->idProfesor?>&comentario=<?php echo $datosComment->comentario?>&nota=<?php echo $datosComment->nota?>&tareas=<?php echo $datosComment->tareas?>&examenes=<?php echo $datosComment->examenes?>&satifaccion=<?php echo $datosComment->satifaccion?>&fecha=<?php echo $datosComment->fecha?>"><input type="button" value="Actualizar"></a></td>
            <td class="boton"><a href="./borrar.php?id=<?php echo $datosComment->id ?>&seleccion=comentario "><input type="button" value="Eliminar"></a></td></tr>
            <?php endforeach ?>
        </table>
</div>

</body>
</html>