<?php
require "../includes/_sesion/validar.php";
include "../includes/header.php";
?>

<div class="container-fluid">
    <!-- DataTable Maqueta -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de Maquetas</h5>
            <?php 
            if ($rolSesion == 'Administrador') {
                echo '<button type="button" class="btn btn-success mt-1" data-toggle="modal" data-target="#maqueta">
                            <span class="glyphicon glyphicon-plus"></span> Agregar maqueta <i class="fa fa-user-plus"></i> </button>
                        <button type="button" class="btn btn-secondary mt-1" data-toggle="modal" data-target="#maquetaConfiguracion">
                            <span class="glyphicon glyphicon-plus"></span> Configuración <i class="fa fa-bars"></i> </button>';
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
                    echo 'El código de la maqueta ya existe';
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
                echo 'La maqueta fue actualizada correctamente';
                break;
            }
            ?>
          </div>
        <?php
        }
        ?>
        <!-- Todos los códigos de las maquetas fueron actualizados-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarCodigo'])) {
            ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarCodigo']) {
                    case 'ok':
                        echo 'Todos los códigos de las maquetas fueron actualizados';
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
                            <th>Código Maqueta</th>
                            <th>Ubicación</th>
                            <th>Grupo</th>
                            <th>Detalle</th>
                            <th>Cantidad</th>
                            <th>Marca</th>
                            <th>Imagen</th>
                            <th>QR</th>
                            <th>Observaciones</th>
                            <?php
                            if ($rolSesion == 'Administrador') {
                                echo '<th>Acciones</th>';
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT * FROM maquetas");
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?php echo $fila['CodigoMaqueta']; ?></td>
                                <td><?php echo $fila['Ubicacion']; ?></td>
                                <td><?php echo $fila['Grupo']; ?></td>
                                <td><?php echo $fila['Detalle']; ?></td>
                                <td><?php echo $fila['CantidadDisponible']; ?></td>
                                <td><?php echo $fila['Marca']; ?></td>
                                <td class="text-center">
                                    <?php
                                    // Verificar si hay una ruta de imagen válida
                                    if (!empty($fila['Imagen']) && file_exists($fila['Imagen'])) {
                                        echo '<a href="#" data-toggle="modal" data-target="#imageModal" class="image-link contenedorImagen" data-image="' . $fila['Imagen'] . '">
                                                <img src="' . $fila['Imagen'] . '" alt="Imagen de la maqueta" class="image-table rounded" width="100" height="100">     
                                              </a>';
                                    } else {
                                        echo 'No se puede imprimir imagen';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    // Verificar si hay una ruta de imagen válida
                                    if (!empty($fila['CodigoQR']) && file_exists($fila['CodigoQR'])) {
                                        echo '<a href="#" data-toggle="modal" data-target="#imageModal" class="image-link contenedorImagen" data-image="' . $fila['CodigoQR'] . '">
                                                <img src="' . $fila['CodigoQR'] . '" alt="CodigoQR" class="image-table rounded" width="100" height="100">
                                              </a>';
                                    } else {
                                        echo 'No se puede imprimir el código QR';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $fila['Observaciones']; ?></td>
                                <?php 
                                if ($rolSesion == 'Administrador') {
                                    echo '<td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-warning mr-2" href="../includes/editar_maqueta.php?CodigoMaqueta=' . $fila['CodigoMaqueta'] . '"><i class="fa fa-edit"></i></a>
                                                <a href="../includes/eliminar_maqueta.php?CodigoMaqueta=' . $fila['CodigoMaqueta'] . '" class="btn btn-danger btn-del-maqueta">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>';
                                }
                                ?>
                            </tr>
                        <?php endwhile; ?>
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
<?php include "../includes/modal_imagen.php"; ?>
<?php include "../includes/form_maqueta.php"; ?>
<?php include "../includes/modal_configuracion_maqueta.php"; ?>