<!DOCTYPE html>
<html>
<head>
	<title>Búsqueda de maquetas</title>
	<link rel="stylesheet" href="../assets/css/estilos_buscador.css">
</head>
<body>
	<h1>Búsqueda de maqueta</h1>
	<div class="container">		
		<form method="post" action="../includes/buscar_maqueta.php">
			<div class="search-bar">
				<input type="text" name="CodigoMaqueta" id="CodigoMaqueta" placeholder="Código de Maqueta">
			</div>
			<input class="boton-busqueda" type="submit" name="buscarCodigo" value="Buscar">
		</form>
		<?php
        require '../assets/phpqrcode/qrlib.php';
        include '../includes/db.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['CodigoMaqueta']) && is_string($_GET['CodigoMaqueta'])) {
            // Mostrar detalles de la maqueta
            $codigoMaqueta = $conexion->real_escape_string($_GET['CodigoMaqueta']);
            $query = "SELECT CodigoMaqueta, Ubicacion, Grupo, Detalle, CantidadDisponible, Marca, Imagen, Observaciones, CodigoQR FROM maquetas WHERE CodigoMaqueta = '$codigoMaqueta'";
            $result = $conexion->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Muestra los detalles de la maqueta
                echo "<h2>CÓDIGO</h2><h3>{$row['CodigoMaqueta']}</h3>";
                echo "<h2>UBICACIÓN</h2><h3>{$row['Ubicacion']}</32>";
                echo "<h2>GRUPO</h2><h3>{$row['Grupo']}</h3>";
                echo "<h2>DETALLE</h2><h3>{$row['Detalle']}</h2>";
                echo "<h2>CANTIDAD</h2><h3>{$row['CantidadDisponible']}</h3>";
                echo "<h2>MARCA</h2><h3>{$row['Marca']}</h3>";
				echo "<h2>OBSERVACIONES</h2><h3>{$row['Observaciones']}</h3>";

				echo "<div class='image-container'>";
                $imagenPath = $row['Imagen'];
                if (file_exists($imagenPath)) {
                    echo '<img src="' . $imagenPath . '" alt="Imagen de maqueta">';
                } else {
                    echo 'No Disponible';
                }
                
                if (!empty($row['CodigoQR'])) {
                    echo "<img src='{$row['CodigoQR']}' alt='Código QR de la maqueta'>";
                } else {
                    echo "<p>No hay código QR disponible para esta maqueta.</p>";
                }
				echo "</div>";

            } else {
                echo "<p>La maqueta no se encontró.</p>";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscarCodigo'])) {
            // Búsqueda de maqueta por códigoMaqueta
            $codigoMaqueta = $conexion->real_escape_string($_POST['CodigoMaqueta']);
            $query = "SELECT CodigoMaqueta, Ubicacion, Grupo, Detalle, CantidadDisponible, Marca, Imagen, Observaciones, CodigoQR FROM maquetas WHERE CodigoMaqueta = '$codigoMaqueta'";
            $result = $conexion->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Muestra los detalles de la maqueta
                echo "<h2>CÓDIGO</h2><h3>{$row['CodigoMaqueta']}</h3>";
                echo "<h2>UBICACIÓN</h2><h3>{$row['Ubicacion']}</h3>";
                echo "<h2>GRUPO</h2><h3>{$row['Grupo']}</h3>";
                echo "<h2>DETALLE</h2><h3>{$row['Detalle']}</h3>";
                echo "<h2>CANTIDAD</h2><h3>{$row['CantidadDisponible']}</h3>";
                echo "<h2>MARCA</h2><h3>{$row['Marca']}</h3>";
				echo "<h2>OBSERVACIONES</h2><h3>{$row['Observaciones']}</h3>";

				echo "<div class='image-container'>";
                $imagenPath = $row['Imagen'];
                if (file_exists($imagenPath)) {
                    echo '<img src="' . $imagenPath . '" alt="Imagen de maqueta">';
                } else {
                    echo 'No Disponible';
                }
               
                if (!empty($row['CodigoQR'])) {
                    echo "<img src='{$row['CodigoQR']}' alt='Código QR de la maqueta'>";
                } else {
                    echo "<p>No hay código QR disponible para esta maqueta.</p>";
                }
				echo "</div>";

            } else {
                echo "<p>La maquetas no se encontró.</p>";
            }
        }

        $conexion->close();
        ?>	
		<div class="button-container">	
			<a href="../views/user.php" class="button">Regresar</a>	
		</div>
	</div>
	<div class="capa"></div>
</body>

</html>
