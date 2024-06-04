
<?php
require "../includes/_sesion/validar.php";
include "../includes/header.php";

?>

<div class="container-fluid">
    <!-- DataTable Herramienta -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php
            include "../includes/db.php";
            $idGrupo = $_GET['grupo'];
            $query = "SELECT * FROM grupoherramientas WHERE IdGrupoH = '$idGrupo'";
            $result = mysqli_query($conexion, $query);
            $nombreGrupo = mysqli_fetch_assoc($result);
            if ($rolSesion == 'Administrador') { ?>
                <div class="row">
                    <div class="col">
                        <h5 class="m-0 font-weight-bold text-primary">Lista de Herramientas<?php echo !empty($nombreGrupo['Nombre']) ? (" - <span style=\"color: #000000\">" . $nombreGrupo['Nombre'] . "</span>") : "" ?></h5>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5 class="m-0 font-weight-bold text-primary">Agregar herramientas</h5>
                        <button type="button" class="btn btn-success mt-1" data-toggle="modal" data-target="#herramienta">
                            <span class="glyphicon glyphicon-plus"></span> Agregar herramienta <i class="fa fa-user-plus"></i> </button>
                        <button type="button" class="btn btn-secondary mt-1" data-toggle="modal" data-target="#herramientaConfiguracion">
                            <span class="glyphicon glyphicon-plus"></span> Config. código QR <i class="fas fa-qrcode"></i> </button>
                    </div>
                    <div class="col">
                        <h5 class="m-0 font-weight-bold text-primary">Agregar otras opciones</h5>
                        <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#herramientaUbicacion">
                            <span class="glyphicon glyphicon-plus"></span> Ubicación <i class="fas fa-map-marker-alt"></i> </button>
                        <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#herramientaGrupo">
                            <span class="glyphicon glyphicon-plus"></span> Grupo <i class="fas fa-tools"></i> </button>
                        <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#herramientaMarca">
                            <span class="glyphicon glyphicon-plus"></span> Marca <i class="fas fa-layer-group"></i> </button>
                    </div>
                </div>
            <?php
            } else { ?>
                <div class="row">
                    <div class="col">
                        <h5 class="m-0 font-weight-bold text-primary">Lista de Herramientas<?php echo !empty($nombreGrupo['Nombre']) ? (" - <span style=\"color: #000000\">" . $nombreGrupo['Nombre'] . "</span>") : "" ?></h5>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!-- Alera de la herramienta fue guardado correctamente-->
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
                        echo 'El código de la herramienta ya existe';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!-- Alera de la herramienta fue modificada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editar'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editar']) {
                    case 'ok':
                        echo 'La herramienta fue actualizada correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!---------------------Editar todos los códigos qr de las herramientas------------------------------->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarCodigo'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarCodigo']) {
                    case 'ok':
                        echo 'Todos los códigos de las herramientas fueron actualizados';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>


        <!------------------ ALERTAS DE GUARDARDO EN BOTONES DE UBICACION, GRUPO, MARCA-------------------------->
        <!-- El código de la ubicación fue actualizado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregarUbicacion'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarUbicacion']) {
                    case 'ok':
                        echo 'El código de la ubicación fue guardado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!-- El código del grupo fue actualizado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregarGrupo'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarGrupo']) {
                    case 'ok':
                        echo 'El código del grupo fue guardado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!-- El código de la marca fue actualizado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregarMarca'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarMarca']) {
                    case 'ok':
                        echo 'El código de la marca fue guardado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>


        <!------------------ ALERTAS DE EDICION EN BOTONES DE UBICACION, GRUPO, MARCA-------------------------->
        <!--Alerta La ubicación fue actualizada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarUbicacion'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarUbicacion']) {
                    case 'ok':
                        echo 'La ubicación fue actualizada correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!--Alerta La marca fue actualizada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarMarca'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarMarca']) {
                    case 'ok':
                        echo 'La marca fue actualizada correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!--Alerta el grupo fue actualizado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarGrupo'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarGrupo']) {
                    case 'ok':
                        echo 'El grupo fue actualizado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!------------------ ALERTAS DE ELIMINAR EN BOTONES DE UBICACION, GRUPO, MARCA-------------------------->
        <!--Alerta La ubicación fue actualizada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarUbicacion'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarUbicacion']) {
                    case 'ok':
                        echo 'La ubicación fue eliminada correctamente';
                        break;
                        case 'error_ubicacion':
                            echo 'La eliminación no es posible ya que una herramienta dentro de esta ubicación está siendo utilizada';
                            break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!--Alerta La marca fue actualizada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarMarca'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarMarca']) {
                    case 'ok':
                        echo 'La marca fue eliminada correctamente';
                        break;
                        case 'error_marca':
                            echo 'La eliminación no es posible ya que una herramienta dentro de esta marca está siendo utilizada';
                            break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!--Alerta el grupo fue actualizado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarGrupo'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarGrupo']) {
                    case 'ok':
                        echo 'El grupo fue eliminado correctamente';
                        break;
                        case 'error_grupo':
                            echo 'La eliminación no es posible ya que una herramienta dentro de este grupo está siendo utilizada';
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
                            <th>Código Herramienta</th>
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
                        if (isset($_GET['grupo'])) {
                            $idGrupo = $_GET['grupo'];
                            $query = "SELECT herramientas.*, ubicacionherramientas.Nombre AS NombreUbicacion, grupoherramientas.Nombre AS NombreGrupo, marcaherramientas.Nombre AS NombreMarca FROM herramientas INNER JOIN ubicacionherramientas ON herramientas.IdUbicacion = ubicacionherramientas.IdUbicacionH INNER JOIN grupoherramientas ON herramientas.IdGrupo = grupoherramientas.IdGrupoH INNER JOIN marcaherramientas ON herramientas.IdMarca = marcaherramientas.IdMarcaH WHERE IdGrupo = ?";
                            $stmt = mysqli_prepare($conexion, $query);
                            mysqli_stmt_bind_param($stmt, "s", $idGrupo);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                        } else {
                            $result = mysqli_query($conexion, "SELECT herramientas.*, ubicacionherramientas.Nombre AS NombreUbicacion, grupoherramientas.Nombre AS NombreGrupo, marcaherramientas.Nombre AS NombreMarca FROM herramientas INNER JOIN ubicacionherramientas ON herramientas.IdUbicacion = ubicacionherramientas.IdUbicacionH INNER JOIN grupoherramientas ON herramientas.IdGrupo = grupoherramientas.IdGrupoH INNER JOIN marcaherramientas ON herramientas.IdMarca = marcaherramientas.IdMarcaH");
                        }
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td>
                                    <?php echo $fila['CodigoHerramienta']; ?>
                                </td>
                                <td>
                                    <?php echo $fila['NombreUbicacion']; ?>
                                </td>
                                <td>
                                    <?php echo $fila['NombreGrupo']; ?>
                                </td>
                                <td>
                                    <?php echo $fila['Detalle']; ?>
                                </td>
                                <td>
                                    <?php echo $fila['CantidadDisponible']; ?>
                                </td>
                                <td>
                                    <?php echo $fila['NombreMarca']; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    // Verificar si hay una ruta de imagen válida
                                    if (!empty($fila['Imagen']) && file_exists($fila['Imagen'])) {
                                        echo '<a href="#" data-toggle="modal" data-target="#imageModal" class="image-link contenedorImagen" data-image="' . $fila['Imagen'] . '">
                                                <img src="' . $fila['Imagen'] . '" alt="Imagen de la herramienta" class="image-table rounded" width="100" height="100">     
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
                                <td>
                                    <?php echo $fila['Observaciones']; ?>
                                </td>
                                <?php
                                if ($rolSesion == 'Administrador') {
                                    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
                                    $codigoGrupo = $_GET['grupo'];
                                    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";
                                    echo '<td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-warning mr-2" href="../includes/editar_herramienta.php?CodigoHerramienta=' . $fila['CodigoHerramienta'] . $envioGrupo . ' "><i class="fa fa-edit"></i></a>
                                                <a href="../includes/eliminar_herramienta.php?CodigoHerramienta=' . $fila['CodigoHerramienta'] . $envioGrupo . '" class="btn btn-danger btn-del-herramienta">
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
<?php include "../includes/form_herramienta.php"; ?>
<?php include "../includes/form_herramienta_ubicacion.php"; ?>
<?php include "../includes/form_herramienta_grupo.php"; ?>
<?php include "../includes/form_herramienta_marca.php"; ?>
<?php include "../includes/modal_configuracion_herramienta.php"; ?>