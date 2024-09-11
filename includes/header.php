<?php
require "../includes/_sesion/validar.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Etiquetas meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Sistema para la gestión de solicitudes de talleres y laboratorios automotrices del Instituto Superior Tecnológico Tecnoecuatoriano.">
    <meta name="author" content="Diego Alexander Castillo Cardenas">

    <title>TecnoMécanica</title>

    <!-- Icono personalizado -->
    <link rel="icon" href="../assets/img/logo_icon.png" type="image/x-icon">

    <!-- Custom fonts for this template -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendor/google/fonts.css" rel="stylesheet">

    <!-- Estilos definidos -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Estilos personalizados para la plantiilla -->
    <link href="../assets/css/flatpickr.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Cambiar el color de la barra izquierda -->
        <!--<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">-->
        <ul class="navbar-nav bg-green sidebar sidebar-blue accordion" id="accordionSidebar">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../views/user.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Menú de las solicitudes -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSolicitudes" aria-expanded="true" aria-controls="collapseSolicitudes">
                    <i class="fa fa-sticky-note" aria-hidden="true"></i>
                    <span>Solicitudes</span>
                </a>
                <div id="collapseSolicitudes" class="collapse" aria-labelledby="headingSolicitudes" data-parent="#accordionSidebar">
                    <?php
                    if ($rolSesion != 'Administrador') {
                        echo '<div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Ver formato solicitud:</h6>
                                <a class="collapse-item" href="../includes/form_solicitud.php">Agregar nueva solicitud</a>
                              </div>';
                    }
                    ?>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver solicitudes:</h6>
                        <a class="collapse-item" href="../views/solicitudes.php">Mostrar solicitudes</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Menú de las Herramientas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHerramientas" aria-expanded="true" aria-controls="collapseHerramientas">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <span>Herramientas</span>
                </a>
                <div id="collapseHerramientas" class="collapse" aria-labelledby="headingHerramientas" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver herramientas:</h6>
                        <a class="collapse-item" href="../views/herramientas.php">Mostrar herramientas</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver por grupo:</h6>
                        <?php
                        require_once 'db.php';
                        $result = mysqli_query($conexion, "SELECT IdGrupo, Nombre FROM herramientas INNER JOIN grupoherramientas ON herramientas.IdGrupo = grupoherramientas.IdGrupoH GROUP BY IdGrupo");
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <a class="collapse-item text-wrap" href="../views/herramientas.php?grupo=<?= $fila['IdGrupo'] ?>">
                                <?= $fila['Nombre'] ?>
                            </a>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Búsqueda herramientas:</h6>
                        <a class="collapse-item" href="../includes/buscar_herramienta.php">Buscar herramienta</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Menú de las Maquetas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaquetas" aria-expanded="true" aria-controls="collapseMaquetas">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <span>Maquetas</span>
                </a>
                <div id="collapseMaquetas" class="collapse" aria-labelledby="headingMaquetas" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver maquetas:</h6>
                        <a class="collapse-item" href="../views/maquetas.php">Mostrar maquetas</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Búsqueda maqueta:</h6>
                        <a class="collapse-item" href="../includes/buscar_maqueta.php">Buscar maqueta</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Menú de los estudiantes con sus opciones -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios" aria-expanded="true" aria-controls="collapseUsuarios">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUsuarios" class="collapse" aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver estudiantes:</h6>
                        <a class="collapse-item" href="../views/estudiantes.php">Mostrar estudiantes</a>
                    </div>
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver docentes:</h6>
                        <a class="collapse-item" href="../views/docentes.php">Mostrar docentes</a>
                    </div>
                    <?php
                    if ($rolSesion == 'Administrador') {
                        echo '<div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Ver administradores:</h6>
                                <a class="collapse-item" href="../views/administradores.php">Mostrar administradores</a>
                              </div>';
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManuales" aria-expanded="true" aria-controls="collapseManuales">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Manuales</span>
                </a>
                <div id="collapseManuales" class="collapse" aria-labelledby="headingManuales" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ver manuales:</h6>
                        <a class="collapse-item" href="../views/manuales.php">Mostrar manuales</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMatriz" aria-expanded="true" aria-controls="collapseMatriz">
                    <i class="fas fa-school" aria-hidden="true"></i>
                    <span>Matriz</span>
                </a>
                <div id="collapseMatriz" class="collapse" aria-labelledby="headingMatriz" data-parent="#accordionSidebar">
                    <?php
                    $result1 = mysqli_query($conexion, "SELECT * FROM matriz");
                    $fila = mysqli_fetch_assoc($result1);
                    if ($rolSesion == 'Administrador') { ?>
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Ver matriz</h6>
                            <a class="collapse-item" href="../views/matriz.php">Mostrar matriz</a>
                        </div>
                    <?php } else { ?>
                        <?php if (isset($fila['Nombre']) && isset($fila['Direccion'])) { ?>
                            <div class="bg-white collapse-inner rounded">
                                <span class="collapse-item text-wrap"><?= htmlentities($fila['Nombre']) ?></span>
                                <hr>
                                <span class="collapse-item text-wrap"><?= htmlentities($fila['Direccion']) ?></span>
                            </div>
                        <?php } else { ?>
                        <div class="bg-white collapse-inner rounded">
                            <span class="collapse-item text-wrap">Datos no disponibles</span>
                        </div>
                    <?php } } ?>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Otros
            </div>
            <!-- Elementos de navegación - Menú de la ayuda 
            <li class="nav-item">
                <a class="nav-link" href="../views/ayuda.php">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span>Ayuda</span></a>
            </li>-->
            <!-- Elementos de navegación - Menú de acerca -->
            <li class="nav-item">
                <a class="nav-link" href="../views/acerca.php">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span>Acerca de</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Boton minimizar la barra lateral) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- cabecera horizontal -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-sm-inline-block form-inline mr-auto">
                        <div id="logoContainer" class="text-sm-center">
                            <img src="../assets/img/logo.png" alt="Logo ISTTE" width="75" height="75">
                            <strong>
                                Instituto Superior Tecnológico Tecnoecuatoriano
                            </strong>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php include "fecha.php"; ?>
                        <h8 class="ml-auto"><strong><b><?php echo fecha(); ?></h8></strong></b>
                        <div class="reloj">
                            <h6><span id="tiempo">-- : -- : --</span></h6>
                        </div>
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - Información del usuario -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['Usuario']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown -Información del usuario -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../includes/editar_user.php">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Modificar Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <?php include "../includes/salir.php"; ?>
</body>

</html>