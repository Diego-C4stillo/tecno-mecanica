<?php
// CONEXION BD
include "../includes/db.php";
$id = 1;
$consulta = "SELECT * FROM matriz WHERE Id = ?";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$matriz = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($stmt);
include_once "../includes/header.php";
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Matriz</h5>
        </div>

        <!-- Alerta de matriz fue guardado correctamente-->
        <?php echo (isset($alert)) ? $alert : '';
        if (isset($_GET['agregarMatriz'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarMatriz']) {
                    case 'ok':
                        echo 'La matriz fue agregada / editada correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta de la matriz fue eliminado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarMatriz'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarMatriz']) {
                    case 'ok':
                        echo 'La matriz se elimino correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <div class="card-body">
            <h5 class="font-weight-bold">Datos</h5>
            <form action="../includes/functions.php" method="post" class="mb-2">
                <input type="hidden" name="accion" value="insert_edit_matriz">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlentities($matriz['Nombre']) ?>">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion" rows="3" id="direccion" class="form-control"><?= htmlentities($matriz['Direccion'])?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Agregar | Actualizar</button>
            </form>
            <form action="../includes/eliminar_matriz.php" method="post">
                <button type="submit" class="btn btn-danger">Eliminar los datos de la matriz <i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
        </div>
        
    </div>
</div>
</div>

<?php include "../includes/footer.php"; ?>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->