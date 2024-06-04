<?php
require "../includes/_sesion/validar.php";
include '../includes/header.php';
include "../includes/db.php";
?>
<!-- Se muestra todo el contenido del contenedor de un usuario -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Bienvenido, <?php echo $nombresSesion . " " . $apellidosSesion ?></h1>
    <br>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel Administrativo</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Se muestra los registros de las solicitudes -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="solicitudes.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Número de solicitudes</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php

                                $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM solicitudesareas";
                                $dato = mysqli_query($conexion, $SQL);
                                $resultado = mysqli_fetch_assoc($dato);

                                // Verificar si la consulta fue exitosa
                                if ($resultado) {
                                    $numeroRegistros = $resultado['NumeroRegistros'];
                                    echo $numeroRegistros;
                                } else {
                                    echo "Error.";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cuentas de estudiantes registradas-->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="estudiantes.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Número de estudiantes registrados</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php

                                $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM usuarios WHERE Rol = 'Estudiante'";
                                $dato = mysqli_query($conexion, $SQL);
                                $resultado = mysqli_fetch_assoc($dato);

                                // Verificar si la consulta fue exitosa
                                if ($resultado) {
                                    $numeroRegistros = $resultado['NumeroRegistros'];
                                    echo $numeroRegistros;
                                } else {
                                    echo "Error.";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Herramientas registradas-->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="herramientas.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Número de herramientas registradas</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php

                                $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM herramientas";
                                $dato = mysqli_query($conexion, $SQL);
                                $resultado = mysqli_fetch_assoc($dato);

                                // Verificar si la consulta fue exitosa
                                if ($resultado) {
                                    $numeroRegistros = $resultado['NumeroRegistros'];
                                    echo $numeroRegistros;
                                } else {
                                    echo "Error.";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-wrench fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maquetas registradas-->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="maquetas.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Número de maquetas registradas</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php

                                $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM maquetas";
                                $dato = mysqli_query($conexion, $SQL);
                                $resultado = mysqli_fetch_assoc($dato);

                                // Verificar si la consulta fue exitosa
                                if ($resultado) {
                                    $numeroRegistros = $resultado['NumeroRegistros'];
                                    echo $numeroRegistros;
                                } else {
                                    echo "Error.";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cuentas de docentes registradas-->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="docentes.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Número de docentes registrados</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php

                                $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM usuarios WHERE Rol = 'Docente'";
                                $dato = mysqli_query($conexion, $SQL);
                                $resultado = mysqli_fetch_assoc($dato);

                                // Verificar si la consulta fue exitosa
                                if ($resultado) {
                                    $numeroRegistros = $resultado['NumeroRegistros'];
                                    echo $numeroRegistros;
                                } else {
                                    echo "Error.";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($rolSesion === 'Administrador') {
        ?>
            <!-- Cuentas de administradores registradas-->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="administradores.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Número de administradores registrados</a>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $SQL = "SELECT COUNT(*) AS NumeroRegistros FROM usuarios WHERE Rol = 'Administrador'";
                                    $dato = mysqli_query($conexion, $SQL);
                                    $resultado = mysqli_fetch_assoc($dato);

                                    // Verificar si la consulta fue exitosa
                                    if ($resultado) {
                                        $numeroRegistros = $resultado['NumeroRegistros'];
                                        echo $numeroRegistros;
                                    } else {
                                        echo "Error.";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>
<?php mysqli_close($conexion); ?>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<?php include '../includes/footer.php'; ?>

</html>