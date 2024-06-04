<?php
require "../includes/_sesion/validar.php";
if ($rolSesion != 'Administrador') {
    header("Location: 404.php");
    exit;
}

$GrupoHerramienta = $_GET['IdGrupoH'];
include "db.php";

//Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
$codigoGrupo = $_GET['grupo'];
$envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

$checkQuery = mysqli_query($conexion, "SELECT * FROM herramientas WHERE IdGrupo = '$GrupoHerramienta'");
if(mysqli_num_rows($checkQuery) > 0) {
    // Hay registros relacionados, no se puede eliminar
    mysqli_close($conexion);
    header("Location: ../views/herramientas.php?eliminarGrupo=error_grupo{$envioGrupo}");
    exit;
}

// Borrar el registro de la base de datos
$query = mysqli_query($conexion, "DELETE FROM grupoherramientas WHERE IdGrupoH = '$GrupoHerramienta'");
mysqli_close($conexion);
header("Location: ../views/herramientas.php?eliminarGrupo=ok{$envioGrupo}");
exit;
