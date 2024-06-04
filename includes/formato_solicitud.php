<?php
require "../includes/_sesion/validar.php";
if (empty($_REQUEST['s'])) {
    header('Location: ../includes/404.php');
    exit;
} else {
    require_once('tcpdf/tcpdf.php');
    include "db.php";

    class MyPDF extends TCPDF
    {
        // Variables para el encabezado
        public $header_title = 'SOLICITUD DE TALLER / LABORATORIOS';

        // Cabecera de página
        public function Header()
        {
            // Obtener el número de página
            $page_number = $this->getPage();

            // Verificar si la página es mayor que 1 para agregar encabezado
            if ($page_number == 1) {
                // Establecer color de fondo
                $this->SetFillColor(4, 77, 126); // Color #044D7E en RGB

                // Dibujar un rectángulo como fondo para el título
                $this->Rect(0, 0, $this->getPageWidth(), 15, 'F');

                // Logo
                $image_file = 'logo.png'; // Nombre de tu archivo de logo
                $this->Image($image_file, 10, 2.5, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false);

                // Arial bold 15
                $this->SetFont('helvetica', 'B', 20);

                // Título con color de texto blanco
                $this->SetTextColor(255, 255, 255);

                // Movernos a la derecha
                $this->Cell(80);

                // Título
                $this->Cell(0, 7, $this->header_title, 0, 0, 'R', false);

                // Restaurar color de texto
                $this->SetTextColor(0); // Restaurar color a negro

                // Agregar rectángulo al final en la parte derecha
                $this->SetDrawColor(10, 150, 72);
                $this->SetFillColor(10, 150, 72);
                $this->Rect($this->GetPageWidth() - 5, 0, 15, 15, 'FD');

                $this->SetDrawColor(0);

                // Salto de línea
                $this->Ln(15); // Ajusta el espacio entre el encabezado y el contenido
            }
        }

        // Pie de página
        public function Footer()
        {
            // Obtener el número de página
            $page_number = $this->getPage();

            // Posición a 1.5 cm del final
            $this->SetY(-18);
            // Configuración de la fuente y tamaño
            $this->SetFont('helvetica', 'I', 8);
            // Número de página
            $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // Crear nuevo objeto MyPDF
    $pdf = new MyPDF('L', 'mm', 'A4', true, 'UTF-8', false);

    $codigoSolicitud = $_REQUEST['s'];
    $consulta = "SELECT * FROM solicitudesareas INNER JOIN usuarios ON solicitudesareas.IdUsuario = usuarios.IdUsuario INNER JOIN carreras ON usuarios.IdCarrera = carreras.IdCarrera where IdSolicitudArea = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "i", $codigoSolicitud);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $datos = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    $consultaDocente = "SELECT Nombres, Apellidos FROM solicitudesareas INNER JOIN usuarios ON solicitudesareas.CedulaDocente = usuarios.Cedula where IdSolicitudArea = ?";
    $stmtDocente = mysqli_prepare($conexion, $consultaDocente);
    mysqli_stmt_bind_param($stmtDocente, "i", $codigoSolicitud);
    mysqli_stmt_execute($stmtDocente);
    $resultadoDocente = mysqli_stmt_get_result($stmtDocente);
    $datosDocente = mysqli_fetch_assoc($resultadoDocente);
    mysqli_stmt_close($stmtDocente);

    // Establecer información del documento
    $pdf->SetCreator('TCPDF');
    $pdf->SetAuthor('Author');
    $pdf->SetTitle('Solicitud ' . $datos['IdSolicitudArea']);
    $pdf->SetSubject('Solicitud para talleres y laboratorios');
    $pdf->SetKeywords('Solicitud');

    // Agregar página
    $pdf->AddPage();

    // Llamar al método Header para generar el encabezado
    $pdf->Header();

    // Establecer fuente
    $pdf->SetFont('helvetica', '', 10);

    $pdf->MultiCell(277, 1, "Código: {$codigoSolicitud}", 0, 'R', false, 1, '', '', true, 0, false, true, 10, 'M');

    // Definir contenido de la fila
    $nivel_jornada = "Nivel/jornada";
    $carrera = "Carrera";
    $asignatura = "Asignatura";
    $sede = "Sede";
    $fecha_horario = "Fecha y horario";
    $profesor = "Profesor responsable";

    //$pdf->MultiCell(35, 5, $nivel_jornada, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(35, 6, $nivel_jornada, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(60, 6, $carrera, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(55, 6, $asignatura, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(35, 6, $sede, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(45, 6, $fecha_horario, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(47, 6, $profesor, 1, 'C', false, 1, '', '', true, 0, false, true, 10, 'T');

    // Definir contenido de la fila 2
    $nivel_jornada_2 = $datos['Nivel'] . ' / ' . $datos['Jornada'];
    $carrera_2 = 'Tecnología Superior en ' . $datos['NombreCarrera'];
    $asignatura_2 = $datos['Asignatura'];
    $sede_2 = $datos['Campus'];
    $fecha_horario_2 = $datos['HoraInicio'] . ' - ' . $datos['HoraFin'] . " " . $datos['Fecha'];
    $profesor_2 = $datosDocente['Nombres'] . " " . $datosDocente['Apellidos'];

    // Agregar cada elemento en celdas individuales para la fila 2
    $pdf->MultiCell(35, 12, $nivel_jornada_2, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(60, 12, $carrera_2, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(55, 12, $asignatura_2, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(35, 12, $sede_2, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(45, 12, $fecha_horario_2, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(47, 12, $profesor_2, 1, 'C', false, 1, '', '', true, 0, false, true, 10, 'M');

    // Definir contenido de la fila 3
    $actividades = "Actividades a realizar";
    $herramientas = "Herramientas y equipos a utilizar";
    $material = "Material de práctica";

    // Agregar cada elemento en celdas individuales
    $pdf->MultiCell(95, 6, $actividades, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(90, 6, $herramientas, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'T');
    $pdf->MultiCell(92, 6, $material, 1, 'C', false, 1, '', '', true, 0, false, true, 10, 'T');

    // Definir contenido de la fila 3
    $actividades_2 = $datos['Actividades'];
    $herramientas_2 = $datos['Implementos'];
    $material_2 = $datos['MaterialPractica'];

    // Agregar cada elemento en celdas individuales
    $pdf->MultiCell(95, 25, $actividades_2, 1, 'J', false, 0, '', '', true, 0, true, true, 10, 'M');
    $pdf->MultiCell(90, 25, $herramientas_2, 1, 'J', false, 0, '', '', true, 0, true, true, 10, 'M');
    $pdf->MultiCell(92, 25, $material_2, 1, 'J', false, 1, '', '', true, 0, true, true, 10, 'M');

    $lugar = "Area: {$datos['Area']}";
    $pdf->MultiCell(277, 6, $lugar, 1, 'L', false, 1, '', '', true, 0, false, true, 10, 'T');

    $listaAlumnos = "Lista de alumnos que asisten a la práctica";

    $pdf->MultiCell(277, 5, $listaAlumnos, 1, 'C', false, 1, '', '', true, 0, false, true, 10, 'M');

    $nombres_completos = "Nombres completos";
    $asistencia = "Asistencia";

    $pdf->MultiCell(118, 7, $nombres_completos, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(20, 7, $asistencia, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');

    $pdf->MultiCell(119, 7, $nombres_completos, 1, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->MultiCell(20, 7, $asistencia, 1, 'C', false, 1, '', '', true, 0, false, true, 10, 'M');

    $listaEstudiantes = mysqli_query($conexion, "SELECT CedulaEstudiante,Nombres,Apellidos FROM listaEstudiantes INNER JOIN usuarios ON listaestudiantes.CedulaEstudiante = usuarios.Cedula WHERE IdSolicitud = $codigoSolicitud AND Rol = 'Estudiante' || Rol = 'Docente' ORDER BY 
    listaEstudiantes.IdListaEstudiantes");
    $contador = 0;
    while ($fila = mysqli_fetch_assoc($listaEstudiantes)) :
        if ($contador % 2 == 0) {
            $pdf->MultiCell(118, 7, $fila['Nombres'] . " " . $fila['Apellidos'], 1, 'L', false, 0, '', '', true, 0, false, true, 10, 'M');
            $pdf->MultiCell(20, 7, "", 1, 'L', false, 0, '', '', true, 0, false, true, 10, 'M');
        } else {
            $pdf->MultiCell(119, 7, $fila['Nombres'] . " " . $fila['Apellidos'], 1, 'L', false, 0, '', '', true, 0, false, true, 10, 'M');
            $pdf->MultiCell(20, 7, "", 1, 'L', false, 1, '', '', true, 0, false, true, 10, 'M');
        }
        $contador++;
    endwhile;

    if ($contador % 2 != 0) {
        $pdf->MultiCell(119, 7, "", 1, 'L', false, 0, '', '', true, 0, false, true, 10, 'M');
        $pdf->MultiCell(20, 7, "", 1, 'L', false, 1, '', '', true, 0, false, true, 10, 'M');
    }

    $observaciones = "Observaciones: ";
    $pdf->MultiCell(277, 15, $observaciones . "", 1, 'L', false, 1, '', '', true, 1, false, true, 10, 'M');

    $pdf->MultiCell(277, 7, "Firmas de responsabilidad", 0, 'C', false, 1, '', '', true, 1, false, true, 10, 'M');

    $pdf->Ln(10);

    $pdf->MultiCell(92, 10, "Ing. Christian Echeverria\nPROFESOR", 0, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->Line(15, $pdf->GetY(), 95, $pdf->GetY(), array('width' => 0.5, 'color' => array(0, 0, 0)));

    $pdf->MultiCell(93, 10, "Tnlg. Rodrigo Aucapiña\nADMINISTRADOR DE TALLER", 0, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->Line(105, $pdf->GetY(), 190, $pdf->GetY(), array('width' => 0.5, 'color' => array(0, 0, 0)));

    $pdf->MultiCell(92, 10, "Ing. Christian Echeverria\nCOORDINADOR DE CARRERA", 0, 'C', false, 0, '', '', true, 0, false, true, 10, 'M');
    $pdf->Line(205, $pdf->GetY(), 280, $pdf->GetY(), array('width' => 0.5, 'color' => array(0, 0, 0)));

    $pdf->Output('Solicitud ' . $datos['IdSolicitudArea'] . '.pdf', 'I');
    mysqli_close($conexion);
} 

