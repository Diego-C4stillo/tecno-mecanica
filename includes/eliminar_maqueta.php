<?php
require "../includes/_sesion/validar.php";
if($rolSesion != 'Administrador'){
    header("Location: 404.php");
    exit;
}

$CodigoMaqueta = $_GET['CodigoMaqueta'];
include "db.php";

// Obtener la ruta de la imagen antes de borrar el registro
$queryImage = mysqli_query($conexion, "SELECT Imagen,CodigoQR FROM maquetas WHERE CodigoMaqueta = '$CodigoMaqueta'");
$dataImage = mysqli_fetch_assoc($queryImage);
if(file_exists($dataImage['Imagen']) || !empty($dataImage['Imagen'])){
    unlink($dataImage['Imagen']);
}
unlink($dataImage['CodigoQR']);

// Borrar el registro de la base de datos
$query = mysqli_query($conexion, "DELETE FROM maquetas WHERE CodigoMaqueta = '$CodigoMaqueta'");
mysqli_close($conexion);
header('Location: ../views/maquetas.php');
exit;
