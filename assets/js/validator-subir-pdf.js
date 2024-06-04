(function () {
    document.addEventListener('DOMContentLoaded', function () {
        'use strict';

        var form = document.querySelector('.needs-validation');

        var pdfInput = document.getElementById('txtDocumento');

        pdfInput.addEventListener('change', validatePDF);

        form.addEventListener('submit', function (event) {
            validatePDF();
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    function validatePDF() {
        var pdfInput = document.getElementById('txtDocumento');

        if (pdfInput.files.length === 0) {
            pdfInput.setCustomValidity('Selecciona un archivo PDF válido.');
            return;
        }

        var fileName = pdfInput.value.toLowerCase();
        var allowedExtensions = ['.pdf'];

        if (!allowedExtensions.some(ext => fileName.endsWith(ext))) {
            pdfInput.setCustomValidity('Selecciona un archivo PDF válido.');
            return;
        }

        // Opcional: verificar el tamaño del archivo
        var fileSize = pdfInput.files[0].size; // en bytes
        var maxSizeMB = 10; // Tamaño máximo permitido en MB
        var maxSizeBytes = maxSizeMB * 1024 * 1024; // Convertir a bytes

        if (fileSize > maxSizeBytes) {
            pdfInput.setCustomValidity('El archivo PDF es demasiado grande. El tamaño máximo permitido es de ' + maxSizeMB + ' MB.');
            return;
        }

        pdfInput.setCustomValidity('');
    }
})();