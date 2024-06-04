<?php
require "../includes/_sesion/validar.php";

// CONEXION BD
include "db.php";

$consulta = "SELECT * FROM usuarios WHERE IdUsuario = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "s", $idUsuarioSesion);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "header.php";
?>
<form action="functions.php" id="form" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-11">
                <div class="col-md-12">
                    <input type="hidden" name="accion" value="editar_usuario">
                    <input type="hidden" name="txtPassAntigua" value="<?php echo $usuario['Pass']; ?>">
                    <input type="hidden" name="txtIdUsuario" value="<?php echo $idUsuarioSesion; ?>">
                    <h3 class="text-center mb-3">Editar datos de usuario</h3>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtCedula" class="form-label">Nro. Cedula</label>
                                <input type="text" id="txtCedula" name="txtCedula" class="form-control" value="<?php echo htmlentities($usuario['Cedula']); ?>" required readonly="readonly">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtNombres" class="form-label">Nombres</label>
                                <input type="text" id="txtNombres" name="txtNombres" class="form-control" value="<?php echo $usuario['Nombres']; ?>" required readonly="readonly">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtApellidos" class="form-label">Apellidos</label>
                                <input type="text" id="txtApellidos" name="txtApellidos" class="form-control" value="<?php echo htmlentities($usuario['Apellidos']); ?>" required readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtPass" class="form-label">Cambiar contraseña:</label>
                                <input type="password" id="txtPass" name="txtPass" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa una nueva contraseña válida, La contraseña debe tener una letra mayúscula y un mínimo de 8 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtPassVerificar" class="form-label">Verificación de contraseña</label>
                                <input type="password" id="txtPassVerificar" name="txtPassVerificar" class="form-control" required>
                                <div class="invalid-feedback">
                                    Las contraseñas no coinciden.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                        <a href="../views/user.php" class="btn btn-danger">Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script src="../assets/js/validator-usuario.js"></script>
<?php
mysqli_close($conexion);
include_once "footer.php";
?>