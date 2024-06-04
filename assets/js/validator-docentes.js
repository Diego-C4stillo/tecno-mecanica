(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            var fields = [
                { input: 'txtCedula', regex: /^\d{10}$/, message: 'Ingresa un número de cédula válido.' },
                { input: 'txtNombres', regex: /^(?! )[\p{L}\s]{1,24}[\p{L}\s](?<! )$/u, message: 'Ingresa solo letras y espacio.' },
                { input: 'txtApellidos', regex: /^(?! )[\p{L}\s]{1,24}[\p{L}\s](?<! )$/u, message: 'Ingresa solo letras y espacio.' },
                { input: 'txtNumeroCelular', regex: /^\d{10}$/, message: 'Ingresa un número de celular válido.' },
                { input: 'txtUsuario', regex: /^(?=.*[A-Z])(?!.*\d{3,})[A-Za-z\d]{6,15}$/, message: 'Ingresa solo letras, una mayúscula, opcional dos números al final.' },
                { input: 'txtEmail', regex: /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/, message: 'Ingresa un correo electrónico válido.' }
            ];

            fields.forEach(function (field) {
                var inputElement = document.getElementById(field.input);
                //console.log("ID del elemento:", field.input, "Elemento:", inputElement);
                inputElement.addEventListener('input', function () {
                    validateField(inputElement, field.regex, field.message);
                });
            });

            form.addEventListener('submit', function (event) {
                fields.forEach(function (field) {
                    var inputElement = document.getElementById(field.input);
                    validateField(inputElement, field.regex, field.message);
                });

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                var periodo = document.getElementById('txtPeriodo');

                periodo.addEventListener('input', function () {
                    var periodoValue = periodo.value.trim(); // Elimina espacios en blanco al principio y al final

                    if (!/^\d+$/.test(periodoValue)) {
                        periodo.setCustomValidity('Digite solo números.');
                    } else {
                        var periodoNum = parseInt(periodoValue, 10); // Convierte a entero con base 10
                        if (periodoNum < 1 || periodoNum > 500) {
                            periodo.setCustomValidity('El número debe estar entre 1 y 500.');
                        } else {
                            periodo.setCustomValidity('');
                        }
                    }
                });

                var carrera = document.getElementById('txtCarrera');
                if (!carrera.value.trim()) {
                    carrera.setCustomValidity('Selecciona una carrera.');
                } else {
                    carrera.setCustomValidity('');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });

        var periodo = document.getElementById('txtPeriodo');
        periodo.addEventListener('input', function () {
            var periodoValue = periodo.value.trim();

            if (!/^\d+$/.test(periodoValue)) {
                periodo.setCustomValidity('Digite solo números.');
            } else {
                var periodoNum = parseInt(periodoValue, 10);
                if (periodoNum < 1 || periodoNum > 500) {
                    periodo.setCustomValidity('El número debe estar entre 1 y 500.');
                } else {
                    periodo.setCustomValidity('');
                }
            }
        });

        document.getElementById('txtCarrera').addEventListener('input', function () {
            var carrera = document.getElementById('txtCarrera');
            if (!carrera.value.trim()) {
                carrera.setCustomValidity('Selecciona una carrera.');
            } else {
                carrera.setCustomValidity('');
            }
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