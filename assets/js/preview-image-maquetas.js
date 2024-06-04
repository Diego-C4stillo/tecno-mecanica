function preview() {
    // Función para mostrar la previsualización de la imagen seleccionada
    var input = document.getElementById('imagenMaqueta');
    var preview = document.getElementById('previewImage');

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var extension = file.name.split('.').pop().toLowerCase();

        if (extension === 'jpg' || extension === 'jpeg' || extension === 'png') {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = '../assets/img/vacio.jpg';
        }
    }
}