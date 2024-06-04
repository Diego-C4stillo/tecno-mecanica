/*let tiempoInactividad = 5000;*/
let tiempoInactividad = 45 * 60 * 1000;
let tiempoInactivo;

function reiniciarTiempoInactivo() {
    clearTimeout(tiempoInactivo);
    tiempoInactivo = setTimeout(function() {
        mostrarMensajeInactividad();
    }, tiempoInactividad);
}

$(document).on('mousemove keydown', function() {
    reiniciarTiempoInactivo();
});

function mostrarMensajeInactividad() {
    // Puedes personalizar el mensaje según tus necesidades   
    alert('La sesión ha caducado por inactividad.');
    cerrarSesion();
}

function cerrarSesion() {
    // Realiza la redirección o acción para cerrar la sesión
    window.location.href = '../includes/_sesion/logout.php';
}