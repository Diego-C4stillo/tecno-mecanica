<?php 
require_once('db.php');

$id = base64_decode($_POST['IdUsuario']);
$pass = $_POST['new_password'];
$hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

$query = "UPDATE usuarios SET Pass= '$hashedPassword' WHERE IdUsuario = '$id'";
$conexion->query($query);

header("Location: ../../_sesion/login.php?message=success_password");

?>