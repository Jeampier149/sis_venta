<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location:login.php');
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>SISTEMA DE VENTAS</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="plantilla/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="plantilla/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="plantilla/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="plantilla/assets/css/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- link datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/sl-1.3.4/datatables.min.css" />
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.html">
                    <span class="brand">SISTEMA
                        <span class="brand-tip">VENTA</span>
                    </span>
                    <span class="brand-mini">SV</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="" class="img_us"  />
                            <span class="usuario">Admin</span><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" onclick="cargar_contenido('contenido_principal','usuario/vista_profile_usuario.php')"><i class="fa fa-user"></i>Profile</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="../controller/usuario/controlador_cerrar_sesion.php"><i class="fa fa-power-off"></i>Salir</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="" class="img_us img-fluid" style="border-radius:50%;height:50px;"/>
                    </div>
                    <div class="admin-info">
                        <div class="font-strong usuario">James Brown</div><small id="rol_usuario">Administrator</small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">INICIO</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','roles/vista_mantenimiento_roles.php')"><i class="sidebar-item-icon fa fa-sitemap icono-sidebar"></i>
                            <span class="nav-label">Roles</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','persona/vista_mantenimiento_persona.php')"><i class="sidebar-item-icon ti-user icono-sidebar"></i>
                            <span class="nav-label">Personas</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','usuario/vista_mantenimiento_usuario.php')"><i class="sidebar-item-icon ti-id-badge icono-sidebar"></i>
                            <span class="nav-label">Usuarios</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','categoria/vista_listar_categoria.php')"><i class="sidebar-item-icon ti-layers-alt icono-sidebar"></i>
                            <span class="nav-label">Categorias</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','unidad_medida/vista_listar_unidad_medida.php')"><i class=" sidebar-item-icon fa-solid fa-scale-balanced icono-sidebar"></i>
                            <span class="nav-label">Unidad de Medida</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','producto/vista_listar_producto.php')"><i class="sidebar-item-icon fa-solid fa-cart-plus icono-sidebar"></i>
                            <span class="nav-label">Productos</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','cliente/vista_listar_cliente.php')"><i class="sidebar-item-icon fas fa-hand-holding-usd icono-sidebar"></i>
                            <span class="nav-label">Clientes</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','proveedor/vista_listar_proveedor.php')"><i class="sidebar-item-icon far fa-handshake icono-sidebar"></i>
                            <span class="nav-label">Proveedores</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','ingreso/vista_listar_ingreso.php')"><i class="sidebar-item-icon fa-solid fa-cart-arrow-down icono-sidebar"></i>
                            <span class="nav-label">Ingresos</span></a>
                    </li>
                    <li>
                        <a onclick="cargar_contenido('contenido_principal','venta/vista_listar_venta.php')"><i class="sidebar-item-icon fas fa-dollar-sign icono-sidebar"></i>
                            <span class="nav-label">Venta</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <input type="text" id="id_user" hidden value="<?php echo $_SESSION['S_IDUSUARIO']; ?>">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div id="contenido_principal">
                    <div class="row d-flex align-items-end mb-5 ">

                        <div class="col-lg-5">
                            <label for="">Fecha Inicio</label>
                            <input type="date" name="fechai" id="fecha_inicio_d" class="form-control">
                        </div>
                        <div class="col-lg-5">
                            <label for="">Fecha Fin</label>
                            <input type="date" name="fechaf" id="fecha_fin_d" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <button class="btn boton-exito" style="width:100%" onclick="traer_datos_widget()"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                        </div>
                    </div>
                    <div class="row" id="mostrar_widget">

                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="ibox">
                                <canvas id="myChart_venta" height="220px;"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox">
                                <canvas id="myChart_ingreso" height="220px;"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- CORE PLUGINS-->

    <script src="plantilla/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="plantilla/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="plantilla/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="plantilla/assets/js/app.min.js" type="text/javascript"></script>
    <!-- SWALERT2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- datatables SCRIPTS-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/b-2.2.2/b-html5-2.2.2/r-2.2.9/sl-1.3.4/datatables.min.js"></script>
    <script src="../js/console_user.js"></script>
    <script src="../js/console_validacion.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            fechadefault_widget()
            traer_datos_widget()

        });
    </script>
    <script>
        function cargar_contenido(contenedor, contenido) {
            $("#" + contenedor).load(contenido);
        }
        traerDatosUsuario()
    </script>
</body>

</html>