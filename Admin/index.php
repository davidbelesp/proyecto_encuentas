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
    $resultado = $conexion->db_conexion->query("Select * from usuarios")->fetchAll(PDO::FETCH_OBJ);
    //echo var_dump($resultado);
    ?>


    <div class="creacion">
        <div class="seleccion">
        <h1>Visualizar</h1>
        <input type="radio" name="seleccion" checked>
        <input type="radio" name="seleccion">
        </div>


        <div class="dividir" style="margin-top: 10px"> </div>

        
        <form id="createuser" action="createUser">
            <h1>Crear Usuario</h1>
            <input type="text" name="ususario" placeholder="Usuario">
            <input type="text" name="password" placeholder="contraseña">
            <input type="submit">
        </form>


        <div class="dividir"> </div>


        <form id="createuser" action="createUser">
            <h1>Crear comentario</h1>
            <input type="text" name="profesor" placeholder="profesor">
            <input type="text" name="comentario" placeholder="Comentario">
            <input type="text" name="nota" placeholder="Nota">
            <input type="number" name="examen" placeholder="Nota examenes">
            <input type="number" name="tareas" placeholder="Nota tareas">
            <label>SATIFACCION:<br>
            <input class="radio" type="radio" name="satifaccion" checked>
            <input class="radio" type="radio" name="satifaccion">
            </label>
            <input type="submit">
        </form>

    </div>

    
    <div class="tablas">
        <table >
            <tr><th>ID</th><th>USUARIO</th><th>CONTRASEÑA</th><th>TIPO</th></tr>
            <?php foreach($resultado as $datosUsuario):?>
            <tr> <td><?php echo $datosUsuario->id;?></td> <td><?php echo $datosUsuario->usuario;?></td> <td><?php echo $datosUsuario->password;?></td> <td><?php echo $datosUsuario->tipo;?></td> 
            <td class="boton"><a href="./Actualizar.php?form=usuario&id=<?php echo $datosUsuario->id?>&usuario=<?php echo $datosUsuario->usuario?>&password=<?php echo $datosUsuario->password;?> "><input type="button" value="Actualizar"></td></a>
            <td class="boton"><a href="./borrar.php?id=<?php echo $datosUsuario->id?>" ><input type="button" value="Eliminar"></a></td></tr>
            <?php endforeach ?>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table>
            <tr><th>COMENTARIO</th><th>NOTA</th><th>BLA</th></tr>
            <tr><td>Esto es un comentario bla bla</td><td>1</td> <td>123</td> <td class="boton"><input type="button" value="Actualizar"></td>  <td class="boton"><input type="button" value="Eliminar"></td></tr>
        </table>
</div>

</body>
</html>