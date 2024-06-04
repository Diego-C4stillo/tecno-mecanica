<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['Usuario'];

if ($varsesion == null || $varsesion = '') {
    header("Location: ../includes/_sesion/login_admin.php");
}

include "db.php";
$id = $_GET['IdSolicitud'];
$consulta = "SELECT * FROM solicitudes WHERE IdSolicitud = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);
?>
<?php include_once "header.php"; ?>



<form action="functions.php" id="form" method="POST">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <h3 class="text-center">Editar Solicitud del Estudiante <?php echo $usuario['nombre']; ?></h3>
                    <br>
                    <div class="form-group ">
                        <label for="CedulaUsuario" class="form-label">Cedula Usuario</label>
                        <input type="text" id="CedulaUsuario" name="CedulaUsuario" class="form-control" value="<?php echo $usuario['CedulaUsuario']; ?>" required>
                    </div>

                    <div class="form-group ">
                        <label>Administrador</label>
                        <select class="form-control" id="IdAdministrador" name="IdAdministrador">
                            <option <?php echo $usuario['IdAdministrador'] === 'IdAdministrador' ? "selected='selected' " : "" ?> value="<?php echo $usuario['IdAdministrador']; ?>"><?php echo $usuario['IdAdministrador']; ?> </option>
                            <?php

                            include("db.php");
                            $sql = "SELECT * FROM administradores";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['IdAdministrador'] . '">' . $consulta['Nombre'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="pendiente" class="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option <?php echo $usuario['estado'] === '2' ? "selected='selected' " : "" ?> value="2">Pendiente</option>
                            <option <?php echo $usuario['estado'] === '1' ? "selected='selected' " : "" ?> value="1">Aprobada</option>
                            <option <?php echo $usuario['estado'] === '1' ? "selected='selected' " : "" ?> value="3">Negada</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="FechaSolicitud" class="form-label">FechaSolicitud</label>
                        <input type="time" id="FechaSolicitud" name="FechaSolicitud" class="form-control" value="<?php echo $usuario['FechaSolicitud']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Observaciones" class="form-label">Observaciones</label>
                        <input type="text" id="Observaciones" name="Observaciones" class="form-control" value="<?php echo $usuario['Observaciones']; ?>" required>
                    </div>

                    <input type="hidden" name="accion" value="editar_solicitud">
                    <input type="hidden" name="IdSolicitud" value="<?php echo $id; ?>">

                    <br>
                    <div class="mb-3">

                        <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                        <a href="../views/solicitudes.php" class="btn btn-danger">Cancelar</a>

                    </div>

                </div>
            </div>
</form>
</div>
</div>

<?php include_once "footer.php"; ?>