(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            var fields = [
                { input: 'txtNombreMarca', regex: /^[\wáéíóúÁÉÍÓÚüÜñÑ\d][\wáéíóúÁÉÍÓÚüÜñÑ\d\s\/]{2,48}[\wáéíóúÁÉÍÓÚüÜñÑ\d\/]$/, message: 'Ingresa solo letras, números y slash.' },
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
})();