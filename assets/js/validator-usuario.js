(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            var fields = [             
                { input: 'txtPass', regex: /^(?=.*[A-ZÑ])(?=.*[a-zñ])(?=.*\d)[A-Za-zñ\d!@#$%^&*()-_+=]{8,25}$/, message: 'Ingresa una contraseña válida, 8 letras, una mayúscula y un número.' }
            ];

            fields.forEach(function (field) {
                var inputElement = document.getElementById(field.input);
                //console.log("ID del elemento:", field.input, "Elemento:", inputElement);
                inputElement.addEventListener('input', function () {
                    validateField(inputElement, field.regex, field.message);
                });
            });

            var passInput = document.getElementById('txtPass');
            var passVerifyInput = document.getElementById('txtPassVerificar');
            passInput.addEventListener('input', function () {
                validatePasswordMatch(passInput, passVerifyInput);
            });
            passVerifyInput.addEventListener('input', function () {
                validatePasswordMatch(passInput, passVerifyInput);
            });

            form.addEventListener('submit', function (event) {
                fields.forEach(function (field) {
                    var inputElement = document.getElementById(field.input);
                    validateField(inputElement, field.regex, field.message);
                });

                validatePasswordMatch(passInput, passVerifyInput);

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

    function validatePasswordMatch(passInput, passVerifyInput) {
        if (passInput.value !== passVerifyInput.value) {
            passVerifyInput.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            passVerifyInput.setCustomValidity('');
        }
    }
})();