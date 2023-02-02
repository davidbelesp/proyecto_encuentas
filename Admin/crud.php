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
session_start();
    if(!isset($_SESSION["Admin"])){
        header("Location:./login");
    }
?>
    <form action="createUser">
        <h1>Crear Usuario</h1>
        <input type="text" name="ususario" placeholder="Usuario">
        <input type="text" name="password" placeholder="contraseña">
        <input type="submit">
    </form>
    <table >
        <tr><th>ID</th><th>USUARIO</th><th>CONTRASEÑA</th><th colspan="2"></th></tr>
        <tr><td>1</td><td>root</td> <td>123</td> <td><input type="button" value="Actualizar"></td> <td><input type="button" value="Eliminar"></td></tr>
    </table>

    <table>
        <tr><th>COMENTARIO</th><th>NOTA</th><th>BLA</th><th colspan="2"></th></tr>
        <tr><td>JJIJOU</td><td>4</td> <td>4564</td> <td><input type="button" value="Actualizar"></td> <td><input type="button" value="Eliminar"></td></tr>
    </table>


</body>
</html>