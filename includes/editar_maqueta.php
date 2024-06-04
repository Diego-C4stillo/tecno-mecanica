<?php
require "../includes/_sesion/validar.php";
if($rolSesion != 'Administrador'){
    header("Location: 404.php");
    exit;
}

// CONEXION BD
include "db.php";
$CodigoMaqueta = isset($_GET['CodigoMaqueta']) ? $_GET['CodigoMaqueta'] : '';
if (empty($CodigoMaqueta)) {
    echo "Código de maqueta no válido.";
    exit;
}
$consulta = "SELECT * FROM maquetas WHERE CodigoMaqueta = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "s", $CodigoMaqueta);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$maqueta = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<form action="functions.php" id="form" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-11">
                <div class="col-md-12">
                    <input type="hidden" name="accion" value="editar_maqueta">
                    <h3 class="text-center mb-3">Editar datos de la maqueta</h3>
                    <div class="form-group">
                        <label for="txtDetalle" class="form-label">Nombre/Detalle*</label>
                        <input type="text" id="txtDetalle" name="txtDetalle" class="form-control text-center" value="<?php echo htmlentities($maqueta['Detalle']); ?>" required>
                        <div class="invalid-feedback">
                            Ingresa solo letras y signos de puntuación.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCodigoMaqueta" class="form-label">Código maqueta*</label>
                                <input type="text" id="txtCodigoMaqueta" name="txtCodigoMaqueta" class="form-control" value="<?php echo $maqueta['CodigoMaqueta']; ?>" required readonly="readonly">
                                <div class="invalid-feedback">
                                    Ingresa un código válido de 10 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtUbicacion" class="form-label">Ubicación*</label>
                                <input type="text" id="txtUbicacion" name="txtUbicacion" class="form-control" value="<?php echo htmlentities($maqueta['Ubicacion']); ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y guión.
                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="form-group">
                                <label for="txtGrupo" class="form-label">Grupo*</label>
                                <input type="text" id="txtGrupo" name="txtGrupo" class="form-control" value="<?php echo htmlentities($maqueta['Grupo']); ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCantidad" class="form-label">Cantidad*</label>
                                <input type="number" id="txtCantidadDisponible" name="txtCantidad" class="form-control" value="<?php echo $maqueta['CantidadDisponible']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo números.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtMarca" class="form-label">Marca*</label>
                                <input type="text" id="txtMarca" name="txtMarca" class="form-control" value="<?php echo htmlentities($maqueta['Marca']); ?>" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras, números y slash.
                                </div>
                            </div>
                        </div>
                        <div class="col-xl">
                            <div class="form-group">
                                <label for="imagenMaqueta">Imagen</label>
                                <input type="file" id="imagenMaqueta" name="imagenMaqueta" class="form-control" accept=".jpg, .jpeg, .png" oninput="preview()">
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
                                if (!empty($maqueta['Imagen']) && file_exists($maqueta['Imagen'])) {
                                    echo '<img src="' . $maqueta['Imagen'] . '" alt="Imagen de maqueta" id="previewImage" class="rounded border" height="250px" width="300px">';
                                } else {
                                    echo '<img src="../assets/img/vacio.jpg" alt="No se ha subido una imagen válida" id="previewImage" class="rounded border" height="250px" width="300px">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="imagenMaquetaAnterior" name="imagenMaquetaAnterior" class="form-control" value="<?php echo $maqueta['Imagen']; ?>">
                    <div class="form-group">
                        <label for="txtObservaciones">Observaciones</label>
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"><?php echo htmlentities($maqueta['Observaciones']); ?></textarea>
                        <div class="valid-feedback">
                            El campo de observaciones puede estar vacío.
                        </div>
                        <div class="invalid-feedback">
                            Ingresa solo letras y signos de puntuación.
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                        <a href="../views/maquetas.php" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="../assets/js/validator-maquetas.js"></script>
<script src="../assets/js/preview-image-maquetas.js"></script>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>