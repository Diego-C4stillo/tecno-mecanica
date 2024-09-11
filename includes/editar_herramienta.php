<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
    header("Location: 404.php");
    exit;
}
// CONEXION BD
include "db.php";
$CodigoHerramienta = isset($_GET['CodigoHerramienta']) ? $_GET['CodigoHerramienta'] : '';
if (empty($CodigoHerramienta)) {
    echo "Código de herramienta no válido.";
    exit;
}
$consulta = "SELECT * FROM herramientas WHERE CodigoHerramienta = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "s", $CodigoHerramienta);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$herramienta = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<form action="functions.php" id="form" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-11">
                <div class="col-md-12">
                    <input type="hidden" name="txtCodGrupo" value="<?= $_GET['grupo'] ?>">
                    <input type="hidden" name="accion" value="editar_herramienta">
                    <h3 class="text-center mb-3">Editar datos de la herramienta</h3>
                    <div class="form-group">
                        <label for="txtDetalle" class="form-label">Nombre/Detalle*</label>
                        <input type="text" id="txtDetalle" name="txtDetalle" class="form-control text-center" value="<?php echo htmlentities($herramienta['Detalle']); ?>" required>
                        <div class="invalid-feedback">
                            Ingresa solo letras y signos de puntuación.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCodigoHerramienta" class="form-label">Código herramienta*</label>
                                <input type="text" id="txtCodigoHerramienta" name="txtCodigoHerramienta" class="form-control" value="<?php echo $herramienta['CodigoHerramienta']; ?>" required readonly="readonly">
                                <div class="invalid-feedback">
                                    Ingresa un código válido de 10 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtUbicacion" class="form-label">Ubicación*</label>
                                <select class="form-control" id="txtUbicacion" name="txtUbicacion">
                                    <?php
                                    include "../includes/db.php";
                                    $sql = "SELECT * FROM ubicacionherramientas ORDER BY IdUbicacionH";
                                    $resultado = mysqli_query($conexion, $sql);
                                    $ubicacionSeleccionada = $herramienta['IdUbicacion'];
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        $selected = ($consulta['IdUbicacionH'] == $ubicacionSeleccionada) ? "selected" : "";
                                        echo '<option value="' . $consulta['IdUbicacionH'] . '" ' . $selected . '>' . $consulta['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona una ubicación
                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="form-group">
                                <label for="txtGrupo" class="form-label">Grupo*</label>
                                <select class="form-control" id="txtGrupo" name="txtGrupo">
                                    <?php
                                    include "../includes/db.php";
                                    $sql = "SELECT * FROM grupoherramientas ORDER BY IdGrupoH";
                                    $resultado = mysqli_query($conexion, $sql);
                                    $grupoSeleccionado = $herramienta['IdGrupo'];
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        $selected = ($consulta['IdGrupoH'] == $grupoSeleccionado) ? "selected" : "";
                                        echo '<option value="' . $consulta['IdGrupoH'] . '" ' . $selected . '>' . $consulta['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona un grupo
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCantidad" class="form-label">Cantidad*</label>
                                <input type="number" id="txtCantidadDisponible" name="txtCantidad" class="form-control" value="<?php echo $herramienta['CantidadDisponible']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo números.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtMarca" class="form-label">Marca*</label>
                                <select class="form-control" id="txtMarca" name="txtMarca">
                                    <?php
                                    include "../includes/db.php";
                                    $sql = "SELECT * FROM marcaherramientas ORDER BY IdMarcaH";
                                    $resultado = mysqli_query($conexion, $sql);
                                    $marcaSeleccionada = $herramienta['IdMarca'];
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        $selected = ($consulta['IdMarcaH'] == $marcaSeleccionada) ? "selected" : "";
                                        echo '<option value="' . $consulta['IdMarcaH'] . '" ' . $selected . '>' . $consulta['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona una marca
                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="form-group">
                                <label for="imagenHerramienta">Imagen</label>
                                <input type="file" id="imagenHerramienta" name="imagenHerramienta" class="form-control" accept=".jpg, .jpeg, .png" oninput="preview()">
                                <div class="valid-feedback">
                                    El campo de imagen puede estar vacío.
                                </div>
                                <div class="invalid-feedback">
                                    Selecciona una imagen en formato JPG o PNG con dimensiones máximas de 1024 x 1024 píxeles. Elimina los puntos entre el nombre de la imagen.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group text-center">
                                <?php
                                // Verificar si hay una ruta de imagen válida
                                if (!empty($herramienta['Imagen']) && file_exists($herramienta['Imagen'])) {
                                    echo '<img src="' . $herramienta['Imagen'] . '" alt="Imagen de herramienta" id="previewImage" class="rounded border" height="250px" width="300px">';
                                } else {
                                    echo '<img src="../assets/img/vacio.jpg" alt="No se ha subido una imagen válida" id="previewImage" class="rounded border" height="250px" width="300px">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="imagenHerramientaAnterior" name="imagenHerramientaAnterior" class="form-control" value="<?php echo $herramienta['Imagen']; ?>">
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"><?php echo htmlentities($herramienta['Observaciones']); ?></textarea>
                        <div class="valid-feedback">
                            El campo de observaciones puede estar vacío.
                        </div>
                        <div class="invalid-feedback">
                            Ingresa solo letras y signos de puntuación.
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
<script src="../assets/js/validator-herramientas.js"></script>
<script src="../assets/js/preview-image-herramientas.js"></script>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>