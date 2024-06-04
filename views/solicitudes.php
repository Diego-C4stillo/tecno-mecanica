<?php
require "../includes/_sesion/validar.php";
include "../includes/header.php";
?>

<div class="container-fluid">
    <!-- DataTable Solicitud -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Lista de Solicitudes</h5>
        </div>
        <!-- La solicitud fue registrada correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['m'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['m']) {
                    case 'ok':
                        echo 'La solicitud fue registrada correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!-- error en pdf-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editar'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editar']) {
                    case 'ok':
                        echo 'El pdf se agregó correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>
        <!-- PDF de solicitud-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['editarEstado'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['editarEstado']) {
                    case 'ok':
                        echo 'El estado de la solicitud se actualizó correctamente';
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
                            <th>Enviado por</th>
                            <th>Nro. Cédula</th>
                            <th>Nivel</th>
                            <th>Jornada</th>
                            <th>Carrera</th>
                            <th>Area</th>
                            <th>Asignatura</th>
                            <th>Campus</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Actividades</th>
                            <th>Implementos</th>
                            <th>Material de práctica</th>
                            <th>Documento</th>
                            <?php if ($rolSesion == "Administrador") { ?>
                                <th>Acciones</th>
                            <?php } ?>
                            <th>Estado solicitud</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../includes/db.php";
                        $result = "";

                        if ($rolSesion == "Administrador") {
                            $result = mysqli_query($conexion, "SELECT * FROM solicitudesareas INNER JOIN usuarios ON solicitudesareas.IdUsuario = usuarios.IdUsuario INNER JOIN carreras ON solicitudesareas.IdCarrera = carreras.IdCarrera");
                        } else {
                            $result = mysqli_query($conexion, "SELECT * FROM solicitudesareas INNER JOIN usuarios ON solicitudesareas.IdUsuario = usuarios.IdUsuario INNER JOIN carreras ON solicitudesareas.IdCarrera = carreras.IdCarrera WHERE solicitudesareas.IdUsuario = $idUsuarioSesion");
                        }

                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?php echo $fila['IdSolicitudArea'] ?></td>
                                <?php $idSolicitud = $fila['IdSolicitudArea']; ?>
                                <td><?php echo $fila['Nombres'] . " " . $fila["Apellidos"]; ?></td>
                                <td><?php echo $fila['Cedula']; ?></td>
                                <td><?php echo $fila['Nivel']; ?></td>
                                <td><?php echo $fila['Jornada']; ?></td>
                                <td><?php echo $fila['NombreCarrera']; ?></td>
                                <td><?php echo $fila['Area']; ?></td>
                                <td><?php echo $fila['Asignatura']; ?></td>
                                <td><?php echo $fila['Campus']; ?></td>
                                <td><?php echo $fila['Fecha']; ?></td>
                                <td><?php echo $fila['HoraInicio'] . "<br>" . $fila['HoraFin']; ?></td>
                                <td><?php echo $fila['Actividades']; ?></td>
                                <td><?php echo $fila['Implementos']; ?></td>
                                <td><?php echo $fila['MaterialPractica']; ?></td>
                                <td>
                                    <!--
                                        "fas fa-file-upload" 
                                        <a class="btn btn-warning mr-2" href="../includes/editar_herramienta.php?CodigoHerramienta=' . $fila['CodigoHerramienta'] . '"><i class="fa fa-edit"></i></a>
                                    -->
                                    <?php
                                    if ($rolSesion !== "Administrador") {
                                        echo '<a class="btn btn-success btn-block" href="../includes/agregar_pdf.php?IdSolicitudArea=' . $fila['IdSolicitudArea'] . '">Agregar <i class="fas fa-file-upload"></i></a>';
                                    }
                                    ?>
                                    <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="<?php echo '#revisar_pdf' . $fila['IdSolicitudArea']; ?>">
                                        Revisar <i class="far fa-eye"></i> </button>
                                    <button class="btn btn-info btn-block" id="btnPDF_<?php echo $idSolicitud; ?>">Generar
                                        PDF <i class="fas fa-print"></i></button>
                                    <input type="hidden" id="idPDF_<?php echo $idSolicitud; ?>" value="<?php echo $idSolicitud; ?>">
                                </td>
                                <?php
                                if ($rolSesion == "Administrador") {
                                    echo '<td>
                                            <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#estado_solicitud' . $fila['IdSolicitudArea'] . '">
                                                <span class="glyphicon glyphicon-plus"></span> Modificar estado <i class="fas fa-edit"></i> 
                                            </button>
                                        </td>';
                                }
                                ?>
                                <td class="<?php
                                            $estado = $fila['EstadoSolicitudArea'];
                                            if ($estado == 'Aprobada') {
                                                echo 'bg-success';
                                            } elseif ($estado == 'Pendiente') {
                                                echo 'bg-warning';
                                            } elseif ($estado == 'Negada') {
                                                echo 'bg-danger';
                                            }
                                            ?>" style="color: black;">
                                    <?php echo $estado; ?>
                                </td>
                            </tr>
                            <script>
                                let idPDFInput_<?php echo $idSolicitud; ?> = document.getElementById("idPDF_<?php echo $idSolicitud; ?>");
                                let generarPDFButton_<?php echo $idSolicitud; ?> = document.getElementById("btnPDF_<?php echo $idSolicitud; ?>");
                                generarPDFButton_<?php echo $idSolicitud; ?>.addEventListener("click", function() {
                                    let id = idPDFInput_<?php echo $idSolicitud; ?>.value;
                                    window.open('../includes/formato_solicitud.php?s=' + id, '_blank');
                                });
                            </script>
                            <div class="modal fade" id="<?php echo 'estado_solicitud' . $fila['IdSolicitudArea']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h3 class="modal-title" id="exampleModalLabel">Modificar el estado de la
                                                solicitud</h3>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../includes/functions.php" class="needs-validation" method="POST" novalidate>
                                                <input type="hidden" name="accion" value="editar_estado_solicitud">
                                                <input type="hidden" value="<?php echo $fila['IdSolicitudArea']; ?>" name="txtIdSolicitudArea">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="txtEstado" id="Aprobada" value="Aprobada">
                                                        <label class="form-check-label" for="Aprobada">
                                                            Aprobada
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="txtEstado" id="Negada" value="Negada">
                                                        <label class="form-check-label" for="Negada">
                                                            Negada
                                                        </label>
                                                    </div>
                                                    <div id="message-error" style="display: none;">
                                                        Debes seleccionar un estado.
                                                    </div>
                                                </div>
                                                <hr class="border border-primary border-3">
                                                <input type="submit" value="Guardar" class="btn btn-success btn-estado-solicitud">
                                                <a href="solicitudes.php" class="btn btn-danger">Cancelar</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo 'revisar_pdf' . $fila['IdSolicitudArea']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h3 class="modal-title" id="exampleModalLabel">PDF GENERADO</h3>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col">
                                                <?php if (empty($fila['Documento']) || $fila['Documento'] == "") { ?>
                                                    <h1 class="text-center">Documento no disponible</h1>
                                                <?php } else { ?>
                                                    <div class="embed-responsive embed-responsive-16by9 embed-responsive-pdf">
                                                        <embed class="embed-responsive-item" src="<?php echo $fila['Documento']; ?>" type="application/pdf" />
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        $resulId = mysqli_query($conexion, "SELECT * FROM solicitudesareas WHERE IdUsuario = $idUsuarioSesion ORDER by IdSolicitudArea DESC LIMIT 1");
                        $filaId = mysqli_fetch_assoc($resulId);
                        $idSolicitudUltimo = $filaId['IdSolicitudArea'];
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
<?php
if (!empty($_GET['m'])) {
    echo "<script>window.open('../includes/formato_solicitud.php?s=$idSolicitudUltimo', '_blank');</script>";
}
?>