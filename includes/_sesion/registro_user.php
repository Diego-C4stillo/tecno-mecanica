<?php
// Se utiliza para llamar al archivo que contine la conexion a la base de datos
require 'db.php';

// Validamos que el formulario y que el boton registro haya sido presionado
if(isset($_POST['registro'])) {

// Obtener los valores enviados por el formulario
$usuario = $_POST['nombre_user'];
$contrasena = $_POST['contrasena_user'];
$correo = $_POST['correo_user'];

$consulta= $conexion->query("SELECT * FROM usuarios WHERE nombre_user = '$usuario'");
$contar = $consulta->num_rows;
if($contar > 0) {
	// Iserción fallida
	echo "ya hay usuario con ese nombre";

    // Insertamos los datos en la base de datos
	} else {
		
		$insertar = $conexion->query("INSERT INTO usuarios (id_user, nombre_user, contrasena_user, correo_user) VALUES (null, '$usuario', '$contrasena', '$correo')");

	if($insertar) {
		// Iserción correcta
		echo "¡Se insertaron los datos correctamente!";
	}
}

}
?>