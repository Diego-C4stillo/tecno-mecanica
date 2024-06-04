<div class="modal fade" id="herramientaMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar una nueva marca</h3>
            </div>
            <div class="modal-body">
                <form action="../includes/functions.php" class="needs-validation" method="POST" novalidate>
                    <input type="hidden" name="txtCodGrupo" value="<?= $_GET['grupo'] ?>">
                    <input type="hidden" name="accion" value="insert_herramienta_marca">
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="txtNombreMarca" class="form-label">Nombre de marca de herramientas*</label>
                                <input type="text" id="txtNombreMarca" name="txtNombreMarca" class="form-control" placeholder="Ejemplo: MINTCRAFT/BAHCO" required>
                                <div class="invalid-feedback">
                                    Ingresa un nombre válido
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-primary border-3">
                    <input type="submit" value="Guardar" class="btn btn-success btn-edit-herramienta">
                    <a href="herramientas.php<?php echo isset($_GET['grupo']) ? '?grupo=' . $_GET['grupo'] : ''; ?>" class="btn btn-danger">Cancelar</a>
                </form>
                <div class="card shadow mb-3 mt-3">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Lista de marca herramientas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableMarcaHerramientas" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "../includes/db.php";
                                    $result = mysqli_query($conexion, "SELECT * FROM marcaherramientas");
                                    while ($fila = mysqli_fetch_assoc($result)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $fila['IdMarcaH']; ?></td>
                                            <td><?php echo $fila['Nombre']; ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-warning mr-2" href="../includes/editar_herramienta_marca.php?IdMarcaH=<?= $fila['IdMarcaH']; ?><?php echo isset($_GET['grupo']) ? ('&grupo='.$_GET['grupo']) : "" ?>"><i class="fa fa-edit"></i></a>
                                                    <a href="../includes/eliminar_herramienta_marca.php?IdMarcaH=<?= $fila['IdMarcaH']; ?><?php echo isset($_GET['grupo']) ? ('&grupo='.$_GET['grupo']) : "" ?>" class="btn btn-danger btn-del-herramienta">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                            <?php mysqli_close($conexion) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/validator-herramientas-marca.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTables para la tabla de marca herramientas
        $('#dataTableMarcaHerramientas').DataTable({
            "lengthMenu": [
                [3, 6, 9],
                ["3", "6", "9"]
            ]
        });

    });
</script>