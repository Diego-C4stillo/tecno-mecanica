<?php
require "../includes/_sesion/validar.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>

    <!-- Icono personalizado -->
    <link rel="icon" href="../assets/img/logo_icon.png" type="image/x-icon">

    <!-- Estilos definidos -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5">

        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Página no encontrada</p>
            <p class="text-gray-500 mb-0">Parece que la página no se encuentra disponible este momento...</p>
            <a href="../views/user.php">&larr; Regresar</a>

        </div>

    </div>
</body>

</html>