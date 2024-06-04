<?php
require "../includes/_sesion/validar.php";
include "../includes/header.php";

?>

<div class="container-fluid">
    <!-- DataTable Herramienta -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Documentos / Manuales e inventario</h5>
        </div>

        <!-- Alerta del manual fue guardado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregarManual'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarManual']) {
                    case 'ok':
                        echo 'El manual fue agregado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta del inventario fue guardado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['agregarInventario'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['agregarInventario']) {
                    case 'ok':
                        echo 'El inventario fue agregado correctamente';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta del manual fue eliminado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarM'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarM']) {
                    case 'ok':
                        echo 'El manual se elimino correctamente';
                        break;
                    case 'errorManual':
                        echo 'El manual no se pudo eliminar';
                        break;
                    case 'noExisteManual':
                        echo 'El manual no existe';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta del inventario fue eliminado correctamente-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['eliminarI'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['eliminarI']) {
                    case 'ok':
                        echo 'El inventario se elimino correctamente';
                        break;
                    case 'errorInventario':
                        echo 'El inventario no se pudo eliminar';
                        break;
                    case 'noExisteInventario':
                        echo 'El inventario no existe';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta de vista previa el manual no existe-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['noExisteManual'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['noExisteManual']) {
                    case 'ok':
                        echo 'El documento de manual no existe';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <!-- Alerta de vista previa el inventario no existe-->
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['noExisteInventario'])) {
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                switch ($_GET['noExisteInventario']) {
                    case 'ok':
                        echo 'El documento de inventario no existe';
                        break;
                }
                ?>
            </div>
        <?php
        }
        ?>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="m-0 font-weight-bold text-primary text-center">Manual</h5>
                    <?php
                    if (file_exists("../assets/manuales/manual.pdf")) {
                        echo "<h6 class=\"m-0 font-weight-bold text-center\" style=\"color: #000000\">Manual agregado correctamente</h6>";
                    } else {
                        echo "<h6 class=\"m-0 font-weight-bold text-danger text-center\">Aún no hay un manual agregado</h6>";
                    }
                    ?>
                    <?php if ($rolSesion == 'Administrador') { ?>
                        <form action="../includes/functions.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="insert_manual">
                            <div class="form-group mt-3">
                                <label for="txtManual" class="form-label">Añadir Manual*</label>
                                <input type="file" id="txtManual" name="txtManual" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa un archivo PDF
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block mt-2" type="submit">Agregar manual</button>
                        </form>
                        <form action="../includes/eliminar_manual.php" method="post">
                            <button class="btn btn-secondary btn-block mt-2" type="submit">Eliminar manual</button>
                        </form>
                    <?php } ?>
                    <a id="enlaceManual" class="btn btn-success btn-block mt-2" href="#">Revisar manual</a>
                </div>
                <div class="col">
                    <h5 class="m-0 font-weight-bold text-primary text-center">Inventario</h5>
                    <?php
                    if (file_exists("../assets/manuales/inventario.pdf")) {
                        echo "<h6 class=\"m-0 font-weight-bold text-center\" style=\"color: #000000\">Inventario agregado correctamente</h6>";
                    } else {
                        echo "<h6 class=\"m-0 font-weight-bold text-danger text-center\">Aún no hay un inventario agregado</h6>";
                    }
                    ?>
                    <?php if ($rolSesion == 'Administrador') { ?>
                        <form action="../includes/functions.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="insert_inventario">
                            <div class="form-group mt-3">
                                <label for="txtInventario" class="form-label">Añadir inventario*</label>
                                <input type="file" id="txtInventario" name="txtInventario" class="form-control" required>
                                <div class="invalid-feedback">
                                    Ingresa un archivo PDF
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block mt-2" type="submit">Agregar inventario</button>
                        </form>
                        <form action="../includes/eliminar_inventario.php" method="post" enctype="multipart/form-data">
                            <button class="btn btn-secondary btn-block mt-2" type="submit">Eliminar inventario</button>
                        </form>
                    <?php } ?>
                    <a id="enlaceInventario" class="btn btn-success btn-block mt-2" href="#">Revisar inventario</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    const enlaceManual = document.getElementById('enlaceManual');
    const rutaManual = '../assets/manuales/manual.pdf';

    fetch(rutaManual)
        .then(response => {
            if (!response.ok) {
                enlaceManual.classList.add('btn-disabled');
                enlaceManual.removeAttribute('href');
            }
        })
        .catch(error => {
            console.error('Error al verificar la existencia del documento manual:', error);
        });

    enlaceManual.addEventListener('click', (event) => {
        if (enlaceManual.getAttribute('href')) {
            event.preventDefault();
            window.open(rutaManual, '_blank');
        } else {
            event.preventDefault();
            location.href = '../views/manuales.php?noExisteManual=ok';
        }
    });
</script>
<script>
    const enlaceInventario = document.getElementById('enlaceInventario');
    const rutaInventario = '../assets/manuales/inventario.pdf';

    fetch(rutaInventario)
        .then(response => {
            if (!response.ok) {
                enlaceInventario.classList.add('btn-disabled');
                enlaceInventario.removeAttribute('href');
            }
        })
        .catch(error => {
            console.error('Error al verificar la existencia del documento inventario:', error);
        });

    enlaceInventario.addEventListener('click', (event) => {
        if (enlaceInventario.getAttribute('href')) {
            event.preventDefault();
            window.open(rutaInventario, '_blank');
        } else {
            event.preventDefault();
            location.href = '../views/manuales.php?noExisteInventario=ok';
        }
    });
</script>
<?php include "../includes/footer.php"; ?>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->