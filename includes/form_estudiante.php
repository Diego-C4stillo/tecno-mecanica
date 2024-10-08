<div class="modal fade" id="estudiante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar un nuevo estudiante</h3>
                <button type="button" class="btn btn-black" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <form action="../includes/functions.php" class="needs-validation" method="POST" novalidate>
                    <input type="hidden" name="accion" value="insert_estudiante">
                    <div class="form-group">
                        <label for="txtCedula" class="form-label">Número de cédula*</label>
                        <input type="text" id="txtCedula" name="txtCedula" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingrese un número de cédula válido.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtNombres" class="form-label">Nombres*</label>
                        <input type="text" id="txtNombres" name="txtNombres" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingresa solo letras y espacio.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtApellidos" class="form-label">Apellidos*</label>
                        <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingresa solo letras y espacio.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtPeriodo" class="form-label">Periodo*</label>
                        <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingresa solo números.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtSemestre" class="form-label">Semestre*</label>
                        <select class="form-control" id="txtSemestre" name="txtSemestre">
                            <option value="">- Seleccione un semestre -</option>
                            <option value="1">Primero</option>
                            <option value="2">Segundo</option>
                            <option value="3">Tercero</option>
                            <option value="4">Cuarto</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione un semestre
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtCarrera" class="form-label">Carrera que estudia*</label>
                        <select class="form-control" id="txtCarrera" name="txtCarrera">
                            <option value="">- Seleccione una carrera -</option>
                            <?php

                            include "../includes/db.php";
                            $sql = "SELECT * FROM carreras ORDER BY NombreCarrera";
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
                    <div class="form-group">
                        <label for="txtEmail">Correo electrónico:</label>
                        <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingresa un correo electrónico válido.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtNumeroCelular">Número de celular:</label>
                        <input type="text" name="txtNumeroCelular" id="txtNumeroCelular" class="form-control" required>
                        <div class="invalid-feedback">
                            Ingrese un número de celular válido.
                        </div>
                    </div>
                    <input type="submit" value="Guardar" class="btn btn-success">
                    <a href="estudiantes.php" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/validator-estudiantes.js"></script>