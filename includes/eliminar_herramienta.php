<?php
require "../includes/_sesion/validar.php";
if($rolSesion != 'Administrador'){
    header("Location: 404.php");
    exit;
}

$CodigoHerramienta = $_GET['CodigoHerramienta'];
include "db.php";

//Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
$codigoGrupo = $_GET['grupo'];
$envioGrupo = !empty($codigoGrupo) ? "?grupo=$codigoGrupo" : "";

// Obtener la ruta de la imagen antes de borrar el registro
$queryImage = mysqli_query($conexion, "SELECT Imagen,CodigoQR FROM herramientas WHERE CodigoHerramienta = '$CodigoHerramienta'");
$dataImage = mysqli_fetch_assoc($queryImage);
if(file_exists($dataImage['Imagen']) || !empty($dataImage['Imagen'])){
    unlink($dataImage['Imagen']);
}
unlink($dataImage['CodigoQR']);

// Borrar el registro de la base de datos
$query = mysqli_query($conexion, "DELETE FROM herramientas WHERE CodigoHerramienta = '$CodigoHerramienta'");
mysqli_close($conexion);
header("Location: ../views/herramientas.php{$envioGrupo}");
exit;
