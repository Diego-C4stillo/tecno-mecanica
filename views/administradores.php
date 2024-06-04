<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
    header("Location: ../includes/404.php");
    exit;
}
include "../includes/header.php";
?>

<div class="container-fluid">
    <!-- DataTable Administrador -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de Administradores</h5>
            <button type="button" class="btn btn-success mt-1" data-toggle="modal" data-target="#administrador">
                <span class="glyphicon glyphicon-plus"></span> Agregar administrador <i class="fa fa-user-plus"></i> </a></button>
        </div>
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregar'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregar']) {
                    case 'ok':
                        echo 'El registro fue agregado correctamente';
                        break;
                    case 'existe':
                        echo 'El administrador ya se encuentra registrado';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editar'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editar']) {
                    case 'ok':
                        echo 'El administrador fue actualizado correctamente';
                        break;
                    case 'error_email':
                        echo 'El correo ingresado ya existe.';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nro. Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Periodo</th>
                            <th>Carrera</th>
                            <th>Nro. Celular</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT *, NombreCarrera FROM usuarios
                        INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera WHERE Rol = 'Administrador' AND EstadoUsuario = 1");
                        $contador = 1;
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?php echo $fila['IdUsuario']; ?></td>
                                <td><?php echo $fila['Cedula']; ?></td>
                                <td><?php echo $fila['Nombres']; ?></td>
                                <td><?php echo $fila['Apellidos']; ?></td>
                                <td><?php echo "P".$fila['Periodo']; ?></td>
                                <td><?php echo $fila['NombreCarrera']; ?></td>
                                <td><?php echo $fila['NumeroCelular']; ?></td>
                                <td><?php echo $fila['Usuario']; ?></td>
                                <td><?php echo $fila['Email']; ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-warning mr-2" href="../includes/editar_administrador.php?IdUsuario=<?php echo $fila['IdUsuario'] ?>"><i class="fa fa-edit"></i></a>
                                        <a href="../includes/eliminar_administrador.php?IdUsuario=<?php echo $fila['IdUsuario'] ?>" class="btn btn-danger btn-del-administrador">
                                            <i class="fa fa-trash "></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $contador++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
                <?php mysqli_close($conexion) ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "../includes/footer.php"; ?>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<?php include "../includes/form_administrador.php"; ?>