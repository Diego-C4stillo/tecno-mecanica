<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador' && $rolSesion != 'Docente') {
    header("Location: 404.php");
    exit;
}

// CONEXION BD
include "db.php";
$idUsuario = isset($_GET['IdUsuario']) ? $_GET['IdUsuario'] : '';
if (empty($idUsuario)) {
    echo "Usuario no encontrado";
    exit;
}
$consulta = "SELECT * FROM usuarios WHERE IdUsuario = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$estudiante = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-11">
            <form action="functions.php" id="form" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="accion" value="editar_estudiante">
                <input type="hidden" name="txtIdUsuario" value="<?php echo $estudiante['IdUsuario']; ?>">
                <h3 class="text-center mb-3">Editar datos del estudiante</h3>
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtCedula" class="form-label">Nro. Cédula*</label>
                            <input type="text" id="txtCedula" name="txtCedula" class="form-control" value="<?php echo $estudiante['Cedula']; ?>" required readonly="readonly">
                            <div class="invalid-feedback">
                                Ingresa un número de cédula válido.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtNombres" class="form-label">Nombres*</label>
                            <input type="text" id="txtNombres" name="txtNombres" class="form-control" value="<?php echo htmlentities($estudiante['Nombres']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa solo letras y espacio.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtApellidos" class="form-label">Apellidos*</label>
                            <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" value="<?php echo htmlentities($estudiante['Apellidos']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa solo letras y espacio.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtPeriodo" class="form-label">Periodo*</label>
                            <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" value="<?php echo htmlentities($estudiante['Periodo']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa solo números.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtSemestre" class="form-label">Semestre*</label>
                            <select class="form-control" id="txtSemestre" name="txtSemestre">
                                <?php

                                // Consulta para obtener los valores del ENUM
                                $sqlEnum = "SELECT COLUMN_TYPE 
                                            FROM INFORMATION_SCHEMA.COLUMNS 
                                            WHERE TABLE_NAME = 'usuarios' AND COLUMN_NAME = 'Semestre'";
                                $resultEnum = mysqli_query($conexion, $sqlEnum);
                                $rowEnum = mysqli_fetch_array($resultEnum);

                                // Extraer los valores del ENUM
                                preg_match("/^enum\((.*)\)$/", $rowEnum['COLUMN_TYPE'], $matches);
                                $enumValues = str_getcsv($matches[1], ',', "'");

                                foreach ($enumValues as $value) {
                                    $selected = ($value == htmlentities($estudiante['Semestre'])) ? 'selected' : '';
                                    switch ($value) {
                                        case 1:
                                            $texto = "Primero";
                                            break;
                                        case 2:
                                            $texto = "Segundo";
                                            break;
                                        case 3:
                                            $texto = "Tercero";
                                            break;
                                        case 4:
                                            $texto = "Cuarto";
                                            break;
                                    }
                                    if ($value > 0)
                                        echo "<option value='$value' $selected>$texto</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Seleccione un semestre
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtCarrera" class="form-label">Carrera*</label>
                            <select class="form-control" id="txtCarrera" name="txtCarrera">
                                <?php
                                include "../includes/db.php";
                                $sql = "SELECT * FROM tecnomecanica.carreras ORDER BY NombreCarrera";
                                $resultado = mysqli_query($conexion, $sql);
                                $carreraSeleccionada = $estudiante['IdCarrera'];
                                while ($consulta = mysqli_fetch_array($resultado)) {
                                    $selected = ($consulta['IdCarrera'] == $carreraSeleccionada) ? "selected" : "";
                                    echo '<option value="' . $consulta['IdCarrera'] . '" ' . $selected . '>' . $consulta['NombreCarrera'] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona una carrera.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtEmail" class="form-label">Correo electrónico*</label>
                            <input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo htmlentities($estudiante['Email']); ?>" required readonly='readonly'>
                            <div class="invalid-feedback">
                                Ingresa un correo electrónico válido.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtNumeroCelular" class="form-label">Número de celular*</label>
                            <input type="text" id="txtNumeroCelular" name="txtNumeroCelular" class="form-control" value="<?php echo htmlentities($estudiante['NumeroCelular']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa un número de celular válido.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" name="form" class="btn btn-success">Editar</button>
                    <a href="../views/estudiantes.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
            <form action="functions.php" method="POST">
                <input type="hidden" name="accion" value="reestablecer_pass_estudiante">
                <input type="hidden" name="txtIdUsuario" value="<?php echo $estudiante['IdUsuario']; ?>">
                <input type="hidden" name="txtCedula" value="<?php echo $estudiante['Cedula']; ?>">
                <label for="txtIdUsuario" class="form-label"><span class="text-danger" style="text-decoration: underline;">¡Advertencia!</span> El siguiente botón reestablece la contraseña para el usuario <?php echo htmlentities($estudiante['Nombres']) . " " . htmlentities($estudiante['Apellidos']); ?></label>
                <br>
                <button type="submit" name="form" class="btn btn-primary mb-3">Reestablecer contraseña</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/validator-estudiantes.js"></script>
</div>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>