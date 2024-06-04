<!DOCTYPE html>
<html>

<head>
	<title>Búsqueda de herramientas</title>
	<link rel="stylesheet" href="../assets/css/estilos_buscador.css">
</head>

<body>
	<h1>Búsqueda de Herramienta</h1>
	<div class="container">		
		<form method="post" action="../includes/buscar_herramienta.php">
			<div class="search-bar">
				<input type="text" name="CodigoHerramienta" id="CodigoHerramienta" placeholder="Código de herramienta">
			</div>
			<input class="boton-busqueda" type="submit" name="buscarCodigo" value="Buscar">
		</form>
		<?php
        require '../assets/phpqrcode/qrlib.php';
        include '../includes/db.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['CodigoHerramienta']) && is_string($_GET['CodigoHerramienta'])) {
            // Mostrar detalles de la herramienta
            $codigoHerramienta = $conexion->real_escape_string($_GET['CodigoHerramienta']);
            $query = "SELECT herramientas.*, ubicacionherramientas.Nombre AS NombreUbicacion, grupoherramientas.Nombre AS NombreGrupo, marcaherramientas.Nombre AS NombreMarca FROM herramientas INNER JOIN ubicacionherramientas ON herramientas.IdUbicacion = ubicacionherramientas.IdUbicacionH INNER JOIN grupoherramientas ON herramientas.IdGrupo = grupoherramientas.IdGrupoH INNER JOIN marcaherramientas ON herramientas.IdMarca = marcaherramientas.IdMarcaH WHERE CodigoHerramienta = '$codigoHerramienta'";
            $result = $conexion->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Muestra los detalles de la herramienta
                echo "<h2>CÓDIGO</h2><h3>{$row['CodigoHerramienta']}</h3>";
                echo "<h2>UBICACIÓN</h2><h3>{$row['NombreUbicacion']}</h3>";
                echo "<h2>GRUPO</h2><h3>{$row['NombreGrupo']}</h3>";
                echo "<h2>DETALLE</h2><h3>{$row['Detalle']}</h3>";
                echo "<h2>CANTIDAD</h2><h3>{$row['CantidadDisponible']}</h3>";
                echo "<h2>MARCA</h2><h3>{$row['NombreMarca']}</h3>";
				echo "<h2>OBSERVACIONES</h2><h3>{$row['Observaciones']}</h3>";

				echo "<div class='image-container'>";
                $imagenPath = $row['Imagen'];
                if (file_exists($imagenPath)) {
                    echo '<img src="' . $imagenPath . '" alt="Imagen de herramienta">';
                } else {
                    echo 'No Disponible';
                }
                
                if (!empty($row['CodigoQR'])) {
                    echo "<img src='{$row['CodigoQR']}' alt='Código QR de la herramienta'>";
                } else {
                    echo "<p>No hay código QR disponible para esta herramienta.</p>";
                }
				echo "</div>";

            } else {
                echo "<p>La herramienta no se encontró.</p>";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscarCodigo'])) {
            // Búsqueda de herramienta por códigoHerramienta
            $codigoHerramienta = $conexion->real_escape_string($_POST['CodigoHerramienta']);
            $query = "SELECT herramientas.*, ubicacionherramientas.Nombre AS NombreUbicacion, grupoherramientas.Nombre AS NombreGrupo, marcaherramientas.Nombre AS NombreMarca FROM herramientas INNER JOIN ubicacionherramientas ON herramientas.IdUbicacion = ubicacionherramientas.IdUbicacionH INNER JOIN grupoherramientas ON herramientas.IdGrupo = grupoherramientas.IdGrupoH INNER JOIN marcaherramientas ON herramientas.IdMarca = marcaherramientas.IdMarcaH WHERE CodigoHerramienta = '$codigoHerramienta'";
            $result = $conexion->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Muestra los detalles de la herramienta
                echo "<h2>CÓDIGO</h2><h3>{$row['CodigoHerramienta']}</h3>";
                echo "<h2>UBICACIÓN</h2><h3>{$row['NombreUbicacion']}</h3>";
                echo "<h2>GRUPO</h2><h3>{$row['NombreGrupo']}</h3>";
                echo "<h2>DETALLE</h2><h3>{$row['Detalle']}</h3>";
                echo "<h2>CANTIDAD</h2><h3>{$row['CantidadDisponible']}</h3>";
                echo "<h2>MARCA</h2><h3>{$row['NombreMarca']}</h3>";
				echo "<h2>OBSERVACIONES</h2><h3>{$row['Observaciones']}</h3>";

				echo "<div class='image-container'>";
                $imagenPath = $row['Imagen'];
                if (file_exists($imagenPath)) {
                    echo '<img src="' . $imagenPath . '" alt="Imagen de herramienta">';
                } else {
                    echo 'No Disponible';
                }
               
                if (!empty($row['CodigoQR'])) {
                    echo "<img src='{$row['CodigoQR']}' alt='Código QR de la herrameinta'>";
                } else {
                    echo "<p>No hay código QR disponible para esta herramienta.</p>";
                }
				echo "</div>";

            } else {
                echo "<p>La herramienta no se encontró.</p>";
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