<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
    <title>Login</title>
</head>
<?php
    session_start();
    if(!empty($_SESSION['us_tipo'])){
        header('location: controlador/LoginController.php');
    }
    else{
        session_destroy();

?>


<body>
    <img class="wave" src="img/wave.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="img/bg.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="controlador/LoginController.php" method="post">
                <img src="img/logo.png" alt="">
                <h2>Farmacia</h2>
                <div class="input-div dni">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>DNI</h5>
                        <input type="number" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>CONTRASEÑA</h5>
                        <input type="password" name="pass" class="input" required>
                    </div>
                </div>
                <a href="vista/recuperar.php">Recuperar contraseña</a>
                <input type="submit" class="btn" value="Iniciar Sesion">
            </form>
        </div>
    </div>
</body>
<script src="js/login.js"></script>
</html>

<?php
}

?>