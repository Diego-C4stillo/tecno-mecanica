<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
    header("Location: 404.php");
    exit;
}

include "db.php";

// Borrar el registro de la base de datos
$query = mysqli_query($conexion, "TRUNCATE TABLE matriz");
mysqli_close($conexion);
header("Location: ../views/matriz.php?eliminarMatriz=ok");
exit;
