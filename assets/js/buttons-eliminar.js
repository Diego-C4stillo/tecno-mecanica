// Herramienta
$('.btn-del-herramienta').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: '¿Estás seguro de eliminar esta herramienta?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'La herramienta fue eliminada.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                }).then(function () {
                    document.location.href = href;
                });
            }
        }
    })
})

// Maqueta
$('.btn-del-maqueta').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: '¿Estás seguro de eliminar esta maqueta?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'La maqueta fue eliminada.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                }).then(function () {
                    document.location.href = href;
                });
            }
        }
    })
})

// Estudiante
$('.btn-del-estudiante').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: '¿Estás seguro de eliminar al estudiante?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El estudiante fue eliminado.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                }).then(function () {
                    document.location.href = href;
                });
            }
        }
    })
})

// Docente
$('.btn-del-docente').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: '¿Estás seguro de eliminar al docente?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El docente fue eliminado.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                }).then(function () {
                    document.location.href = href;
                });
            }
        }
    })
})

// Administrador
$('.btn-del-administrador').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: '¿Estás seguro de eliminar al adminsitrador?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El administrador fue eliminado.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false
                }).then(function () {
                    document.location.href = href;
                });
            }
        }
    })
})