<div class="modal fade" id="administrador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar un nuevo administrador</h3>
            </div>
            <div class="modal-body">
                <form action="../includes/functions.php" class="needs-validation" method="POST" novalidate>
                    <input type="hidden" name="accion" value="insert_administrador">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtCedula" class="form-label">Cédula*</label>
                                <input type="text" id="txtCedula" name="txtCedula" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingrese un número de cédula válido.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtNombres" class="form-label">Nombres*</label>
                                <input type="text" id="txtNombres" name="txtNombres" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y espacio.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtApellidos" class="form-label">Apellidos*</label>
                                <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras y espacio.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtCarrera" class="form-label">Carrera*</label>
                                <select class="form-control" id="txtCarrera" name="txtCarrera">
                                    <option value="">- Seleccione una carrera -</option>
                                    <?php

                                    include "../includes/db.php";
                                    $sql = "SELECT * FROM tecnomecanica.carreras ORDER BY NombreCarrera";
                                    $resultado = mysqli_query($conexion, $sql);
                                    while ($consulta = mysqli_fetch_array($resultado)) {
                                        echo '<option value="' . $consulta['IdCarrera'] . '">' . $consulta['NombreCarrera'] . '</option>';
                                    }
                                    mysqli_close($conexion);

                                    ?>

                                </select>
                                <div class="invalid-feedback">
                                    Selecciona una carrera.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtPeriodo" class="form-label">Periodo*</label>
                                <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo números.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="form-group">
                                <label for="txtEmail" class="form-label">Correo electrónico*</label>
                                <input type="text" id="txtEmail" name="txtEmail" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa un correo electrónico válido.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtNumeroCelular" class="form-label">Nro. Celular*</label>
                                <input type="text" id="txtNumeroCelular" name="txtNumeroCelular" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingrese un número de celular válido.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtUsuario" class="form-label">Usuario*</label>
                                <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa solo letras, una mayúscula, opcional dos números al final.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtPass" class="form-label">Contraseña*</label>
                                <input type="password" id="txtPass" name="txtPass" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa una contraseña válida, 8 letras, una mayúscula y un número.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtPassVerificar" class="form-label">Confirmar contraseña*</label>
                                <input type="password" id="txtPassVerificar" name="txtPassVerificar" class="form-control" required>
                                <div class="invalid-feedback">
                                    Las contraseñas no coinciden.
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border border-success border-3">

                    <input type="submit" value="Guardar" class="btn btn-success">
                    <a href="administradores.php" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/validator-administradores.js"></script>