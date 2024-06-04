<div class="modal fade" id="maqueta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar una nueva maqueta</h3>
            </div>
            <div class="modal-body">
                <form action="../includes/functions.php" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="accion" value="insert_maqueta">
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCodigoMaqueta" class="form-label">Código de la maqueta*</label>
                                <input type="text" id="txtCodigoMaqueta" name="txtCodigoMaqueta" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa un código válido de 10 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtUbicacion" class="form-label">Ubicación*</label>
                                <input type="text" id="txtUbicacion" name="txtUbicacion" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y guión.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtGrupo" class="form-label">Grupo*</label>
                                <input type="text" id="txtGrupo" name="txtGrupo" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtDetalle" class="form-label">Detalle*</label>
                                <input type="text" id="txtDetalle" name="txtDetalle" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y signos de puntuación.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="txtCantidadDisponible" class="form-label">Cantidad disponible*</label>
                                <input type="number" id="txtCantidadDisponible" name="txtCantidadDisponible" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo números.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtMarca" class="form-label">Marca*</label>
                                <input type="text" id="txtMarca" name="txtMarca" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras, números y slash.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group text-center">
                                <label for="imagenMaqueta" class="form-label">Imagen</label>
                                <input type="file" id="imagenMaqueta" name="imagenMaqueta" class="form-control" accept=".jpg, .jpeg, .png" onchange="preview()">
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
                                <img class="rounded border" src="../assets/img/vacio.jpg" alt="Previsualización de la herramienta" id="previewImage" height="250px" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtObservaciones">Observaciones</label>
                                <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" rows="3"></textarea>
                                <div class="valid-feedback">
                                    El campo de observaciones puede estar vacío.
                                </div>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y signos de puntuación.
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-primary border-3">

                    <input type="submit" value="Guardar" class="btn btn-success">
                    <a href="maquetas.php" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/validator-maquetas.js"></script>
<script src="../assets/js/preview-image-maquetas.js"></script>