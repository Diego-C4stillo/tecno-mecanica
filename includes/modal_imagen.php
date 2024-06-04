<!-- Modal para mostrar la imagen -->
<script>
    $('.image-link').on('click', function(e) {
        e.preventDefault();
        var imageUrl = $(this).data('image');
        $('#modalImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    });
</script>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Imagen Modal" class="img-fluid mx-auto d-block" height="400px">
            </div>
        </div>
    </div>
</div>