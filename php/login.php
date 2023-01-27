    <?php
        require("./Class/Login.php");
        $login = new Login($_POST["user_login"],$_POST["password_login"]);
        $login->iniciarSesion();
    ?>