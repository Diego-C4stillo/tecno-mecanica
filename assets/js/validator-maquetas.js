(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            var fields = [
                { input: 'txtCodigoMaqueta', regex: /^[a-zA-Z0-9]{10}$/, message: 'Ingresa un código válido de 10 caracteres.' },
                { input: 'txtUbicacion', regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ][a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s-]{2,38}[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]$/, message: 'Ingresa solo letras y guión.' },
                { input: 'txtGrupo', regex: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ][a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{2,38}[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]$/, message: 'Ingresa solo letras.' },
                { input: 'txtDetalle', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-][\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{2,148}[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]$/, message: 'Ingresa solo letras y signos de puntuación.' },
                { input: 'txtCantidadDisponible', regex: /^\d{1,5}$/, message: 'Ingresa solo números.' },
                { input: 'txtMarca', regex: /^[\wáéíóúÁÉÍÓÚüÜñÑ\d][\wáéíóúÁÉÍÓÚüÜñÑ\d\s\/]{2,48}[\wáéíóúÁÉÍÓÚüÜñÑ\d\/]$/, message: 'Ingresa solo letras, números y slash.' },
                { input: 'imagenMaqueta', validator: validateImagen },
                { input: 'txtObservaciones', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/-]?[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{0,148}?[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]?$/, message: 'Ingresa solo letras y signos de puntuación.' }
            ];

            fields.forEach(function (field) {
                var inputElement = document.getElementById(field.input);
                //console.log("ID del elemento:", field.input, "Elemento:", inputElement);
                if (field.validator) {
                    inputElement.addEventListener('input', field.validator);
                } else {
                    inputElement.addEventListener('input', function () {
                        validateField(inputElement, field.regex, field.message);
                    });
                }
            });

            form.addEventListener('submit', function (event) {
                fields.forEach(function (field) {
                    var inputElement = document.getElementById(field.input);
                    if (field.validator) {
                        field.validator();
                    } else {
                        validateField(inputElement, field.regex, field.message);
                    }
                });

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    });

    function validateField(inputElement, regex, message) {
        if (!regex.test(inputElement.value)) {
            inputElement.setCustomValidity(message);
        } else {
            inputElement.setCustomValidity('');
        }
    }


    function validateImagen() {
        var imageInput = document.getElementById('imagenMaqueta');
        if (imageInput.files.length === 0) return;
    
        var fileName = imageInput.value.toLowerCase();
        var allowedExtensions = ['.jpg', '.jpeg', '.png'];
    
        if (!allowedExtensions.some(ext => fileName.endsWith(ext))) {
            imageInput.setCustomValidity('Carga una imagen en formato válido.');
            return;
        }
    
        var img = new Image();
        img.src = URL.createObjectURL(imageInput.files[0]);
    
        img.onload = function () {
            var maxWidth = 1500;
            var maxHeight = 1500;
    
            if (img.width > maxWidth || img.height > maxHeight) {
                imageInput.setCustomValidity('La imagen tiene un tamaño superior a (1024 x 1024) píxeles.');
            } else {
                imageInput.setCustomValidity('');
            }
        };
    }
})();