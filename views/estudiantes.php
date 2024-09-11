<?php
require "../includes/_sesion/validar.php";
include "../includes/header.php";
?>

<div class="container-fluid">
    <!-- DataTable Estudiante -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de Estudiantes</h5>
            <?php
            if ($rolSesion == 'Administrador' || $rolSesion == 'Docente') {
                echo '<button type="button" class="btn btn-success mt-1" data-toggle="modal" data-target="#estudiante">
                            <span class="glyphicon glyphicon-plus"></span> Agregar estudiante <i class="fa fa-user-plus"></i> </button>';
            }
            ?>
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
                        echo 'El usuario ya se encuentra registrado';
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
                        echo 'El estudiante fue actualizado correctamente';
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
                            <?php
                            if ($rolSesion == 'Administrador' || $rolSesion == 'Docente') {

                                echo '<th>Nro. Cédula</th>';
                            }
                            ?>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Periodo</th>
                            <th>Semestre</th>
                            <th>Carrera</th>
                            <?php
                            if ($rolSesion == 'Administrador' || $rolSesion == 'Docente') {
                                //<th>Estado cuenta</th>
                                echo '<th>Nro. Celular</th>
                                      <th>Usuario</th>
                                      <th>Email</th>
                                      
                                      <th>Acciones</th>';
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT *, NombreCarrera FROM usuarios
                        INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera WHERE Rol = 'Estudiante' AND EstadoUsuario = 1");
                        $contador = 1;
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>     
                                <td><?php echo $fila['IdUsuario']; ?></td>                       
                                <?php
                                if ($rolSesion == 'Administrador' || $rolSesion == 'Docente') {

                                    echo '<td>' . $fila['Cedula'] . '</td>';
                                }
                                ?>
                                <td><?php echo $fila['Nombres']; ?></td>
                                <td><?php echo $fila['Apellidos']; ?></td>
                                <td><?php echo "P".$fila['Periodo']; ?></td>
                                <td><?php echo $fila['Semestre']; ?></td>
                                <td><?php echo $fila['NombreCarrera']; ?></td>
                                <?php
                                if ($rolSesion == 'Administrador' || $rolSesion == 'Docente') {
                                    //<td>' . $fila['EstadoCuenta'] . '</td>
                                    echo '<td>' . $fila['NumeroCelular'] . '</td>
                                          <td>' . $fila['Usuario'] . '</td>
                                          <td>' . $fila['Email'] . '</td>
                                          
                                          <td class="text-center">
                                              <div class="d-flex justify-content-center">
                                                  <a class="btn btn-warning mr-2" href="../includes/editar_estudiante.php?IdUsuario=' . $fila['IdUsuario'] . '"><i class="fa fa-edit"></i></a>
                                                  <a href="../includes/eliminar_estudiante.php?IdUsuario=' . $fila['IdUsuario'] . '" class="btn btn-danger btn-del-estudiante">
                                                      <i class="fa fa-trash "></i>
                                                  </a>
                                              </div>
                                          </td>
                                          ';
                                }
                                ?>
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
<?php include "../includes/form_estudiante.php"; ?>