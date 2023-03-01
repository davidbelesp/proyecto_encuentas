<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Styles/crud.css">
    <link rel="stylesheet" href="../Styles/main.css">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
</head>

<body>

    <?php
    $errorCreacion;
    require("../Class/Login.php");

    session_start();
    Login::comprobarInicioSesion($_SESSION['Admin']);
    
    /*CREAR USUARIO O CREAR COMENTARIO*/
    if(isset($_POST["crearuser"])){
        try{
            $usuario = htmlentities(addslashes($_POST["ususario"]));
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT,['cost'=>10]);
            $tipo = htmlentities(addslashes($_POST["tipo"]));
            $resultado = Conexion::getConexion()->prepare("insert into usuarios(usuario,password,tipo) values(:usuario,:password,:tipo)");
            $resultado->execute(array(":usuario"=>$usuario,":password"=>$password,":tipo"=>$tipo));
        }catch(Exception $excepcion){
            $errorCreacion = "usuario";
        }
    }
    if(isset($_POST["crearcomentario"])){
        try{
            $profesor = htmlentities(addslashes($_POST["profesor"]));
            $comentario = htmlentities(addslashes($_POST["comentario"]));
            $nota = htmlentities(addslashes($_POST["nota"]));
            $examen = htmlentities(addslashes($_POST["examen"]));
            $tareas = htmlentities(addslashes($_POST["tareas"]));
            $fecha = htmlentities(addslashes($_POST["fecha"]));
            $satifaccion = htmlentities(addslashes($_POST["satifaccion"]));
            $resultado = Conexion::getConexion()->prepare("insert into encuesta(idProfesor,comentario,nota,examenes,tareas,fecha,satifaccion) values(:profesor,:comentario,:nota,:examen,:tareas,:fecha,:satifaccion)");
            $resultado->execute(array(":profesor"=>$profesor,":comentario"=>$comentario,":nota"=>$nota,":examen"=>$examen,":tareas"=>$tareas,":fecha"=>$fecha,":satifaccion"=>$satifaccion));
        }catch(Exception $excepcion){
            $errorCreacion = "comentario";
        }
    }
    /*QUERY*/
    $tableUsuarios = Conexion::getConexion()->query("Select * from usuarios")->fetchAll(PDO::FETCH_OBJ);
    $tableComment = Conexion::getConexion()->query("Select * from encuesta")->fetchAll(PDO::FETCH_OBJ);
    //echo var_dump($tableComment);
    ?>

    <div class="message">
        <p>Device not supported</p>
    </div>

    <div class="wrapper">

        <div class="creacion box">

            <div class="seleccion">

                <h1>Visualizar</h1>

                <div>
                    <label>Usuario:</label>
                    <input type="radio" name="seleccion" value="usu" checked class="usu-enc">
                    <label>Encuesta:</label>
                    <input type="radio" name="seleccion" value="enc" class="usu-enc">
                </div>

            </div>


            <div class="dividir" style="margin-top: 10px"> </div>


            <form id="createuser" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <h1>Crear Usuario</h1>
                <input type="text" name="ususario" placeholder="Usuario">
                <input type="text" name="password" placeholder="contraseña">
                <label>Usuario:<input type="radio" value="Usuario" name="tipo" checked>Admin:<input type="radio"
                        value="Admin" name="tipo"></label>
                <input type="submit" name="crearuser">
            </form>
            <?php if(isset($errorCreacion) and $errorCreacion=="usuario"){echo "Error al crear usuario";}?>


            <div class="dividir"> </div>


            <form id="createcomment" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <h1>Crear comentario</h1>
                <input type="text" name="profesor" placeholder="IdProfesor">
                <input type="text" name="comentario" placeholder="Comentario">
                <input type="number" name="nota" placeholder="Nota">
                <input type="number" name="examen" placeholder="Nota examenes">
                <input type="number" name="tareas" placeholder="Nota tareas">
                <input type="date" name="fecha" placeholder="fecha">
                <label>SATIFACCION<br>
                    Si:<input class="radio" type="radio" name="satifaccion" value="si" checked>
                    No:<input class="radio" type="radio" name="satifaccion" value="no">
                </label>
                <input type="submit" name="crearcomentario">
            </form>
            <?php if(isset($errorCreacion) and $errorCreacion=="comentario"){echo "Error al crear comentario";}?>

        </div>


        <div class="tablas box" style="width:100%;">
            <a href="../cerrar_sesion.php" class="cerrarsesion"><input type="button" value="CERRAR SESION"></a>
            <table id="usuarios">
                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>CONTRASEÑA</th>
                    <th>TIPO</th>
                    <th>CAMBIAR</th>
                    <th>ELIMINAR</th>
                </tr>
                <?php foreach($tableUsuarios as $datosUsuario):?>
                <tr>
                    <td>
                        <?php echo $datosUsuario->id;?>
                    </td>
                    <td>
                        <?php echo $datosUsuario->usuario;?>
                    </td>
                    <td>
                        <?php echo $datosUsuario->password;?>
                    </td>
                    <td>
                        <?php echo $datosUsuario->tipo;?>
                    </td>
                    <td class="boton"><a
                            href="./actualizar.php?form=usuario&id=<?php echo $datosUsuario->id?>&usuario=<?php echo $datosUsuario->usuario?>&password=<?php echo $datosUsuario->password;?> "><input
                                type="button" value="Actualizar"></td></a>
                    <td class="boton"><a href="./borrar.php?id=<?php echo $datosUsuario->id?>&seleccion=usuario"><input
                                type="button" value="Eliminar"></a></td>
                </tr>
                <?php endforeach ?>
            </table>
            <table id="encuestas">
                <tr>
                    <th>ID</th>
                    <th>ID PROFE</th>
                    <th>COMENTARIO</th>
                    <th>NOTA</th>
                    <th>TAREAS</th>
                    <th>EXAMENES</th>
                    <th>SATIFACCION</th>
                    <th>FECHA</th>
                    <th>CAMBIAR</th>
                    <th>ELIMINAR</th>
                </tr>
                <?php foreach($tableComment as $datosComment):?>
                <tr>
                    <td>
                        <?php echo $datosComment->id?>
                    </td>
                    <td>
                        <?php echo $datosComment->idProfesor?>
                    </td>
                    <td>
                        <?php echo $datosComment->comentario?>
                    </td>
                    <td>
                        <?php echo $datosComment->nota?>
                    </td>
                    <td>
                        <?php echo $datosComment->tareas?>
                    </td>
                    <td>
                        <?php echo $datosComment->examenes?>
                    </td>
                    <td>
                        <?php echo $datosComment->satifaccion?>
                    </td>
                    <td>
                        <?php echo $datosComment->fecha?>
                    </td>
                    <td class="boton"><a
                            href="./actualizar.php?form=comentario&id=<?php echo $datosComment->id?>&idprofesor=<?php echo $datosComment->idProfesor?>&comentario=<?php echo $datosComment->comentario?>&nota=<?php echo $datosComment->nota?>&tareas=<?php echo $datosComment->tareas?>&examenes=<?php echo $datosComment->examenes?>&satifaccion=<?php echo $datosComment->satifaccion?>&fecha=<?php echo $datosComment->fecha?>"><input
                                type="button" value="Actualizar"></a></td>
                    <td class="boton"><a
                            href="./borrar.php?id=<?php echo $datosComment->id ?>&seleccion=comentario "><input
                                type="button" value="Eliminar"></a></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>

</body>
<script>
    const inputs = document.querySelectorAll(".usu-enc")
    inputs.forEach(element => {
        element.addEventListener("change", (event) => {
            const usuTable = document.getElementById("usuarios")
            const encTable = document.getElementById("encuestas")

            const selection = event.target.value
            if (!selection) return
            if (selection == "usu") {
                usuTable.style.display = "flex"
                encTable.style.display = "none"
            } if (selection == "enc") {
                encTable.style.display = "table"
                usuTable.style.display = "none"
            }
        })
    });
</script>

</html>