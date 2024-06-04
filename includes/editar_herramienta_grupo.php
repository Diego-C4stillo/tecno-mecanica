<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
    header("Location: 404.php");
    exit;
}
// CONEXION BD
include "db.php";
$idGrupoH = isset($_GET['IdGrupoH']) ? $_GET['IdGrupoH'] : '';
if (empty($idGrupoH)) {
    echo "Código de grupo no válido.";
    exit;
}
$consulta = "SELECT * FROM grupoherramientas WHERE IdGrupoH = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "s", $idGrupoH);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$grupo = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<form action="functions.php" id="form" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-11">
                <div class="col-md-12">
                    <input type="hidden" name="txtCodGrupo" value="<?= $_GET['grupo'] ?>">
                    <input type="hidden" name="accion" value="editar_herramienta_grupo">
                    <h3 class="text-center mb-3">Editar datos del grupo</h3>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtIdGrupoH" class="form-label">Id Grupo*</label>
                                <input type="text" id="txtIdGrupoH" name="txtIdGrupoH" class="form-control text-center" value="<?php echo htmlentities($grupo['IdGrupoH']); ?>" required readonly="readonly">
                                <div class="invalid-feedback">
                                    Ingresa un código válido
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtNombreGrupo" class="form-label">Nombre del grupo*</label>
                                <input type="text" id="txtNombreGrupo" name="txtNombreGrupo" class="form-control text-center" value="<?php echo htmlentities($grupo['Nombre']); ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y signos de puntuación.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                        <a href="../views/herramientas.php<?php echo isset($_GET['grupo']) ? '?grupo=' . $_GET['grupo'] : ''; ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="../assets/js/validator-herramientas-grupo.js"></script>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>