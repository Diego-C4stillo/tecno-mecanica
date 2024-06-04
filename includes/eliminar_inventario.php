<?php

$directorioDestino = '../assets/manuales/';

$archivoNombre = 'inventario.pdf';

$rutaArchivo = $directorioDestino . $archivoNombre;

if (file_exists($rutaArchivo)) {
    if (unlink($rutaArchivo)) {
        echo "<script language='JavaScript'>
                location.href='../views/manuales.php?eliminarI=ok'; 
              </script>";
    } else {
        echo "<script language='JavaScript'>
                location.href='../views/manuales.php?eliminarI=errorInventario'; 
              </script>";
    }
} else {
    echo "<script language='JavaScript'>
            location.href='../views/manuales.php?eliminarI=noExisteInventario'; 
          </script>";
}