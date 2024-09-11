<?php

include_once "config.php";

/* 

¡IMPORTANTE!
Realizar la configuración de la base de datos y el dominio en el archivo config.php 

*/

$host = HOST;
$user = USER;
$password = PASS;
$database = DATABASE;

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {

    echo "No se realizo la conexion a la base de datos, el error fue:" .
        mysqli_connect_error();
}