<?php
require "../includes/_sesion/validar.php";
if($rolSesion != 'Administrador'){
    header("Location: 404.php");
    exit;
}

$idUsuario = $_GET['IdUsuario'];
include "db.php";

// Borrar el registro de la base de datos
// $query = mysqli_query($conexion, "DELETE FROM usuarios WHERE IdUsuario = '$idUsuario'");
$query = mysqli_query($conexion, "UPDATE usuarios SET EstadoUsuario = 0 WHERE IdUsuario = '$idUsuario'");
mysqli_close($conexion);
header('Location: ../views/docentes.php');
exit;
