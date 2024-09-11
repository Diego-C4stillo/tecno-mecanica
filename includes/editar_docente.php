<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
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
$docente = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-11">
            <form action="functions.php" id="form" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="accion" value="editar_docente">
                <input type="hidden" name="txtIdUsuario" value="<?php echo $docente['IdUsuario']; ?>">
                <h3 class="text-center mb-3">Editar datos del docente</h3>
                <div class="row">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtCedula" class="form-label">Nro. Cédula*</label>
                            <input type="text" id="txtCedula" name="txtCedula" class="form-control" value="<?php echo $docente['Cedula']; ?>" required readonly="readonly">
                            <div class="invalid-feedback">
                                Ingresa un número de cédula válido.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtNombres" class="form-label">Nombres*</label>
                            <input type="text" id="txtNombres" name="txtNombres" class="form-control" value="<?php echo htmlentities($docente['Nombres']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa solo letras y espacio.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="txtApellidos" class="form-label">Apellidos*</label>
                            <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" value="<?php echo htmlentities($docente['Apellidos']); ?>" required>
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
                            <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" value="<?php echo htmlentities($docente['Periodo']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa solo números.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtCarrera" class="form-label">Carrera*</label>
                            <select class="form-control" id="txtCarrera" name="txtCarrera">
                                <?php
                                include "../includes/db.php";
                                $sql = "SELECT * FROM carreras ORDER BY NombreCarrera";
                                $resultado = mysqli_query($conexion, $sql);
                                $carreraSeleccionada = $docente['IdCarrera'];
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
                            <input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo htmlentities($docente['Email']); ?>" required readonly='readonly'>
                            <div class="invalid-feedback">
                                Ingresa un correo electrónico válido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtNumeroCelular" class="form-label">Número de celular*</label>
                            <input type="text" id="txtNumeroCelular" name="txtNumeroCelular" class="form-control" value="<?php echo htmlentities($docente['NumeroCelular']); ?>" required>
                            <div class="invalid-feedback">
                                Ingresa un número de celular válido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtUsuario" class="form-label">Usuario*</label>
                            <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" value="<?php echo htmlentities($docente['Usuario']); ?>" required readonly='readonly'>
                            <div class="invalid-feedback">
                                Ingresa solo letras, una mayúscula, opcional dos números al final.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" name="form" class="btn btn-success">Editar</button>
                    <a href="../views/docentes.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
            <form action="functions.php" method="POST">
                <input type="hidden" name="accion" value="reestablecer_pass_docente">
                <input type="hidden" name="txtIdUsuario" value="<?php echo $docente['IdUsuario']; ?>">
                <input type="hidden" name="txtCedula" value="<?php echo $docente['Cedula']; ?>">
                <label for="txtIdUsuario" class="form-label"><span class="text-danger" style="text-decoration: underline;">¡Advertencia!</span> El siguiente botón reestablece la contraseña para el usuario <?php echo htmlentities($docente['Nombres']) . " " . htmlentities($docente['Apellidos']); ?></label>
                <br>
                <button type="submit" name="form" class="btn btn-primary mb-3">Reestablecer contraseña</button>
            </form>
        </div>
    </div>
    <script src="../assets/js/validator-docentes.js"></script>
</div>
</div><!-- Se cierra el contenedor antes de continuar con el footer -->
<?php
mysqli_close($conexion);
include_once "footer.php";
?>