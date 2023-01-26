<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi pagina</title>
</head>
<body>
    <?php
        try{
            $conexion = new PDO("mysql:host=localhost;dbname=encuestas","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = "SELECT Usuario from usuarios where usuario = :user and password = :pass";
            $resultado = $conexion->prepare($consulta);

            $login = htmlentities(addslashes($_POST["user_login"]));
            $password = htmlentities(addslashes($_POST["password_login"]));

            $resultado->bindValue(":user",$login);
            $resultado->bindValue(":pass",$password);
            $resultado->execute();
            
            $numero_resultado_coincidencia = $resultado->rowCount();
            if($numero_resultado_coincidencia!=0){
                session_start();

                $_SESSION["Usuario"] = $_POST["user_login"];

                header("location:summary.php");
            }else{
                header("location:index.html");
            }


        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();

        }
    ?>


</body>
</html>