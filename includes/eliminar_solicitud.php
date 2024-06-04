<?php
require "../includes/_sesion/validar.php";

	$id = $_GET['id'];
	include "db.php";
	$query = mysqli_query($conexion,"DELETE FROM solicitudes WHERE id = '$id'");
	
	header ('Location: ../vistas/solicitudes.php?m=1');

?>
