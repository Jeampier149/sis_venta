<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) {
	header('Location:index.php');
}

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="plantilla/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="plantilla/assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="plantilla/assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="">INICIAR SESION</a>
        </div>
        <form id="login-form" action="javascript:;" method="post" autocomplete="false">
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="user" id="user" placeholder="Ingrese usuario" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="new-password">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block"  onclick="validation_user()">Login</button>
            </div>
           
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="plantilla/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    
    <script src="plantilla/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="plantilla/assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="plantilla/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/js/app.js" type="text/javascript"></script>
    <script src="../js/console_user.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

    </script>
</body>

</html>