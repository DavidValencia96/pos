<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Recuperar contraseña</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- SweetAlert2-->
    <link rel="stylesheet" href="../css/sweetalert2.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../index.php"><b>Farmacia</b>(nombre)</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">¿Olvidates tu contraseña? Aqui la puedes recuperar.</p>

            <span id="aviso1" class="text-success text-bold">aviso1 success</span>
            <span id="aviso" class="text-danger text-bold">aviso danger</span>

            <form id="form-recuperar" action="" method="post">
                <div class="input-group mb-3">
                    <input type="number" class="form-control" id="dni-recuperar" placeholder="ingrese su DNI" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-address-card"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="email-recuperar" placeholder="E-mail" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </div>
                </div>
            </form>
            <p class="login-box-msg mt-3">Se le enviara un codigo a su E-mail.</p>
            <p class="mt-3 mb-1">
                <a href="../index.php">Iniciar sesión</a>
            </p>
            </div>
        </div>
    </div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<script src="../js/recuperar.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.js"></script>

</body>
</html>
