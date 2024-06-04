<div class="modal fade" id="herramientaConfiguracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Configuración</h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../includes/functions.php" method="POST">
                    <input type="hidden" name="txtCodGrupo" value="<?= $_GET['grupo'] ?>">
                    <input type="hidden" name="accion" value="config_editar_qr_herramienta">
                    El siguiente botón actualiza todos los código QR al nuevo dominio, <span class="font-weight-bold text-danger">utilizar con precaución.</span>
                    <input type="submit" value="Editar códigos QR" class="btn btn-warning">              
                </form>
            </div>
        </div>
    </div>
</div>