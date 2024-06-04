(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function (form) {
            var fields = [
                { input: 'txtAsignatura', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-][\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{2,38}[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]$/, message: 'Ingresa solo letras y signos de puntuación.' },
                { input: 'txtActividades', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-][\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{2,298}[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]$/, message: 'Ingresa solo letras y signos de puntuación.' },
                { input: 'txtImplementos', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-][\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{2,298}[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]$/, message: 'Ingresa solo letras y signos de puntuación.' },
                { input: 'txtMateriales', regex: /^[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-][\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-\s]{2,298}[\wáéíóúüñÁÉÍÓÚÜÑ.,;:'"¡!¿?()/\-]$/, message: 'Ingresa solo letras y signos de puntuación.' }
            ];

            fields.forEach(function (field) {
                var inputElement = document.getElementById(field.input);
                //console.log("ID del elemento:", field.input, "Elemento:", inputElement);
                inputElement.addEventListener('input', function () {
                    validateField(inputElement, field.regex, field.message);
                });
            });

            form.addEventListener('submit', function (event) {

                if (!validateListaDocente()) {
                    event.preventDefault();
                    return false;
                }

                if (!validateListaEstudiantes()) {
                    event.preventDefault();
                    return;
                }

                fields.forEach(function (field) {
                    var inputElement = document.getElementById(field.input);
                    validateField(inputElement, field.regex, field.message);
                });

                var nivel = document.getElementById('txtNivel');
                if (!nivel.value.trim()) {
                    nivel.setCustomValidity('Selecciona un nivel.');
                } else {
                    nivel.setCustomValidity('');
                }

                var jornada = document.getElementById('txtJornada');
                if (!jornada.value.trim()) {
                    jornada.setCustomValidity('Selecciona una jornada.');
                } else {
                    jornada.setCustomValidity('');
                }

                var carrera = document.getElementById('txtCarrera');
                if (!carrera.value.trim()) {
                    carrera.setCustomValidity('Selecciona una carrera.');
                } else {
                    carrera.setCustomValidity('');
                }

                var sede = document.getElementById('txtSede');
                if (!sede.value.trim()) {
                    sede.setCustomValidity('Selecciona una sede.');
                } else {
                    sede.setCustomValidity('');
                }

                var area = document.getElementById('txtArea');
                if (!area.value.trim()) {
                    area.setCustomValidity('Selecciona una area.');
                } else {
                    area.setCustomValidity('');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });

        document.getElementById('txtNivel').addEventListener('input', function () {
            var nivel = document.getElementById('txtNivel');
            if (!nivel.value.trim()) {
                nivel.setCustomValidity('Selecciona un nivel.');
            } else {
                nivel.setCustomValidity('');
            }
        });

        document.getElementById('txtJornada').addEventListener('input', function () {
            var jornada = document.getElementById('txtJornada');
            if (!jornada.value.trim()) {
                jornada.setCustomValidity('Selecciona una jornada.');
            } else {
                jornada.setCustomValidity('');
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

        document.getElementById('txtSede').addEventListener('input', function () {
            var sede = document.getElementById('txtSede');
            if (!sede.value.trim()) {
                sede.setCustomValidity('Selecciona una sede.');
            } else {
                sede.setCustomValidity('');
            }
        });

        document.getElementById('txtArea').addEventListener('input', function () {
            var area = document.getElementById('txtArea');
            if (!area.value.trim()) {
                area.setCustomValidity('Selecciona una sede.');
            } else {
                area.setCustomValidity('');
            }
        });

        function validateListaEstudiantes() {
            var listaEstudiantes = document.getElementById('listaEstudiantesAgregados');
            var invalidFeedback = listaEstudiantes.parentNode.querySelector('.invalid-feedback');
            if (listaEstudiantes.children.length < 2) {
                invalidFeedback.style.display = 'block';
                return false;
            } else {
                invalidFeedback.style.display = 'none';
                return true;
            }
        }

        function validateListaDocente() {
            var docente = document.getElementById('docenteSolicitud');
            var invalidFeedback = docente.parentNode.querySelector('.invalid-feedback');
            if (docente.children.length == 0) {
                invalidFeedback.style.display = 'block';
                return false;
            } else {
                invalidFeedback.style.display = 'none';
                return true;
            }
        }
        

    });

    function validateField(inputElement, regex, message) {
        if (!regex.test(inputElement.value)) {
            inputElement.setCustomValidity(message);
        } else {
            inputElement.setCustomValidity('');
        }
    }
})();