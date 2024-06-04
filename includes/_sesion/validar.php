<?php

error_reporting(0);
session_start([
	'use_only_cookies' => 1,
	'cookie_lifetime' => 1, // La cookie expirará al cerrar el navegador
	'cookie_secure' => 0, // Solo enviar cookies a través de conexiones seguras (HTTPS)
	'cookie_httponly' => 0, // Las cookies solo son accesibles a través de HTTP (no JavaScript)
	'use_strict_mode' => 1, // Evitar ataques de fijación de sesión
]);

$actualsesion = $_SESSION['Usuario'];
if ($actualsesion == null || $actualsesion == '') {
	header("Location: ../views/principal.php");
	exit();
}

include('../includes/db.php');
$consulta = "SELECT IdUsuario, Nombres, Apellidos, Rol FROM usuarios WHERE Usuario = '$actualsesion'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
	$idUsuarioSesion = $fila['IdUsuario'];
    $nombresSesion = $fila['Nombres'];
    $apellidosSesion = $fila['Apellidos'];
    $rolSesion = $fila['Rol'];
  
} else {
    echo "Error al obtener datos " . mysqli_error($conexion);
}

?>
