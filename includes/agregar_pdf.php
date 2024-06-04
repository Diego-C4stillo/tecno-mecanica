<?php
require "../includes/_sesion/validar.php";
if($rolSesion == 'Administrador'){
    header("Location: ../includes/404.php");
    exit;
}
// CONEXION BD
include "db.php";
$idSolicitudArea = isset($_GET['IdSolicitudArea']) ? $_GET['IdSolicitudArea'] : '';
if (empty($idSolicitudArea)) {
    echo "Código de solicitud no válida.";
    exit;
}
$consulta = "SELECT * FROM solicitudesareas WHERE IdSolicitudArea = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "s", $idSolicitudArea);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$solicitud = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<form action="functions.php" id="form" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-7">
                <input type="hidden" name="accion" value="insert_pdf_solicitud">
                <input type="hidden" name="txtIdSolicitudArea" value="<?php echo $idSolicitudArea; ?>">
                <input type="hidden" id="txtDocumentoAnterior" name="txtDocumentoAnterior" class="form-control" value="<?php echo $solicitud['Documento']; ?>">

                <h3 class="text-center mb-3">Añadir PDF solicitud <?php echo $idSolicitudArea; ?></h3>

                <div class="form-group">
                    <input type="file" id="txtDocumento" name="txtDocumento" class="form-control" accept=".pdf">
                    <div class="invalid-feedback">
                        Agrega un documento PDF válido (10MB máximo).
                    </div>
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                    <a href="../views/solicitudes.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="../assets/js/validator-subir-pdf.js"></script>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>