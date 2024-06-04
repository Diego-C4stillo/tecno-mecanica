<?php

$directorioDestino = '../assets/manuales/';

$archivoNombre = 'manual.pdf';

$rutaArchivo = $directorioDestino . $archivoNombre;

if (file_exists($rutaArchivo)) {
    if (unlink($rutaArchivo)) {
        echo "<script language='JavaScript'>
                location.href='../views/manuales.php?eliminarM=ok'; 
              </script>";
    } else {
        echo "<script language='JavaScript'>
                location.href='../views/manuales.php?eliminarM=errorManual'; 
              </script>";
    }
} else {
    echo "<script language='JavaScript'>
            location.href='../views/manuales.php?eliminarM=noExisteManual'; 
          </script>";
}
