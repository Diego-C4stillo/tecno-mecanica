<?php

require_once("db.php");
$dominio = "https://c855-190-89-45-21.ngrok-free.app/tecno-mecanica/";

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {

        case 'acceso_usuario':
            acceso_user();
            break;

        case 'insert_solicitud':
            insert_solicitud();
            break;

        case 'insert_pdf_solicitud':
            insert_pdf_solicitud();
            break;

        case 'insert_estudiante':
            insert_estudiante();
            break;

        case 'insert_docente':
            insert_docente();
            break;

        case 'insert_administrador':
            insert_administrador();
            break;

        case 'insert_herramienta':
            insert_herramienta();
            break;

        case 'insert_herramienta_ubicacion':
            insert_herramienta_ubicacion();
            break;

        case 'insert_herramienta_grupo':
            insert_herramienta_grupo();
            break;

        case 'insert_herramienta_marca':
            insert_herramienta_marca();
            break;

        case 'insert_maqueta':
            insert_maqueta();
            break;

        case 'insert_manual':
            insert_manual();
            break;

        case 'insert_inventario':
            insert_inventario();
            break;

        case 'editar_estado_solicitud':
            editar_estado_solicitud();
            break;

        case 'editar_estudiante':
            editar_estudiante();
            break;

        case 'editar_docente':
            editar_docente();
            break;

        case 'editar_administrador':
            editar_administrador();
            break;

        case 'editar_usuario':
            editar_usuario();
            break;

        case 'editar_herramienta':
            editar_herramienta();
            break;

        case 'editar_herramienta_ubicacion':
            editar_herramienta_ubicacion();
            break;

        case 'editar_herramienta_grupo':
            editar_herramienta_grupo();
            break;

        case 'editar_herramienta_marca':
            editar_herramienta_marca();
            break;

        case 'editar_maqueta':
            editar_maqueta();
            break;

        case 'reestablecer_pass_estudiante':
            reestablecer_pass_estudiante();
            break;

        case 'reestablecer_pass_docente':
            reestablecer_pass_docente();
            break;

        case 'reestablecer_pass_administrador':
            reestablecer_pass_administrador();
            break;


        case 'config_editar_qr_herramienta':
            config_editar_qr_herramienta();
            break;

        case 'config_editar_qr_maqueta':
            config_editar_qr_maqueta();
            break;

        default:
            error_404();
            break;
    }
}

function mostrarAlerta($mensaje, $url)
{
    echo "<script language='JavaScript'>
          alert('$mensaje');
          location.assign('$url');
          </script>";
    exit;
}

function acceso_user()
{
    include("db.php");

    session_start();
    $_SESSION['Usuario'] = null;
    $usuario = $conexion->real_escape_string($_POST['txtUser']);
    $passwordUser = $conexion->real_escape_string($_POST['txtPassword']);

    // Prepara la consulta
    $stmt = $conexion->prepare("SELECT pass FROM usuarios WHERE Usuario = ?");

    // Vincula los parámetros
    $stmt->bind_param("s", $usuario);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene el resultado
    $stmt->bind_result($pass);
    $stmt->fetch();

    // Verifica la contraseña
    if (password_verify($passwordUser, $pass)) {
        $_SESSION['Usuario'] = $usuario;
        session_regenerate_id(true);

        // Redirección después del inicio de sesión exitoso
        header('Location: ../views/user.php');
        exit;
    } else {
        // Credenciales inválidas
        echo "<script language='JavaScript'>
            location.href='../includes/_sesion/login.php?messages=error'; 
                </script>";

        session_destroy();
        exit();
        mostrarAlerta('Usuario o Contraseña Incorrecta', '../includes/_sesion/login.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function insert_solicitud()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    $nivel = $_POST['txtNivel'];
    $jornada = $_POST['txtJornada'];
    $carrera = $_POST['txtCarrera'];
    $asignatura = $_POST['txtAsignatura'];
    $campus = $_POST['txtSede'];
    $cadenaFecha = explode(" ", $_POST['txtFecha']);
    $fecha = $cadenaFecha[0];
    $horaInicio = $cadenaFecha[1];
    $horaFin =  date('H:i', strtotime("$horaInicio +2 hours"));;
    $cedulaDocente = $_POST['docente_cedula'];
    $actividades = $_POST['txtActividades'];
    $implementos = $_POST['txtImplementos'];
    $materiales = $_POST['txtMateriales'];
    $area = $_POST['txtArea'];
    $listaEstudiantes = $_POST['estudiante_cedula'];
    $estado = "Pendiente";

    $consulta_solicitud = "INSERT INTO solicitudesareas (IdUsuario, CedulaDocente, Nivel, Jornada, IdCarrera, Area, Asignatura, Campus, Fecha, HoraInicio, HoraFin, Actividades, Implementos, MaterialPractica, EstadoSolicitudArea)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_solicitud = mysqli_prepare($conexion, $consulta_solicitud);
    mysqli_stmt_bind_param($stmt_solicitud, "issssssssssssss", $idUsuario, $cedulaDocente, $nivel, $jornada, $carrera, $area, $asignatura, $campus, $fecha, $horaInicio, $horaFin, $actividades, $implementos, $materiales, $estado);

    $resultado_solicitud = mysqli_stmt_execute($stmt_solicitud);

    if ($resultado_solicitud) {
        $idSolicitud = mysqli_insert_id($conexion);

        foreach ($listaEstudiantes as $cedulaEstudiante) {
            $consulta_lista_estudiantes = "INSERT INTO listaestudiantes (IdSolicitud, CedulaEstudiante) VALUES (?, ?)";
            $stmt_lista_estudiantes = mysqli_prepare($conexion, $consulta_lista_estudiantes);
            mysqli_stmt_bind_param($stmt_lista_estudiantes, "is", $idSolicitud, $cedulaEstudiante);
            $resultado_lista_estudiantes = mysqli_stmt_execute($stmt_lista_estudiantes);

            if (!$resultado_lista_estudiantes) {
                mostrarAlerta('Se produjo un error al procesar la lista de estudiantes.', '../views/solicitudes.php');
            }
        }

        echo "<script language='JavaScript'>
                location.href='../views/solicitudes.php?m=ok'; 
              </script>";
    } else {
        mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/solicitudes.php');
    }

    $stmt_lista_estudiantes->close();
    $stmt_solicitud->close();
    mysqli_close($conexion);
}

function insert_pdf_solicitud()
{
    include "db.php";

    $idSolicitudArea = $_POST['txtIdSolicitudArea'];
    $archivo = $_FILES["txtDocumento"]["tmp_name"];
    $nombreArchivo = $_FILES["txtDocumento"]["name"];
    $tipoArchivo = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $archivoantiguo = $_POST['txtDocumentoAnterior'];
    $directorio = "../assets/documents/";

    if (file_exists($archivoantiguo)) {
        unlink($archivoantiguo);
    }

    $ruta = $directorio . $idSolicitudArea . "." . $tipoArchivo;

    if (!move_uploaded_file($archivo, $ruta)) {

        echo "<script language='JavaScript'>
            location.href='../views/solicitudes.php?editar=error_image'; 
                </script>";
    } else {

        $consulta = "UPDATE solicitudesareas
                 SET Documento = ? 
                 WHERE IdSolicitudArea = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "si", $ruta, $idSolicitudArea);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/solicitudes.php?editar=ok'; 
                </script>";
        } else {
            $error = mysqli_error($conexion);
            mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/solicitudes.php');
        }
    }

    $stmt->close();

    mysqli_close($conexion);
}

function insert_estudiante()
{
    include "db.php";

    $cedulaEstudiante = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $semestre = $_POST['txtSemestre'];
    $carrera = $_POST['txtCarrera'];
    $rol = 'Estudiante';
    $numeroCelular = $_POST['txtNumeroCelular'];
    $email = $_POST['txtEmail'];
    $usuario = $cedulaEstudiante;
    $hashedPassword = password_hash($cedulaEstudiante, PASSWORD_BCRYPT);
    $estadoUsuario = 1;

    if (!verificar_usuario($cedulaEstudiante, 'Estudiante', $usuario, $email) && !verificar_nombre_usuario($nombres, $apellidos)) {
        $consulta = "INSERT INTO usuarios (Cedula, Nombres, Apellidos, Periodo, Semestre, IdCarrera, Rol, NumeroCelular, Usuario, Email, Pass, EstadoUsuario)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sssisisssssi", $cedulaEstudiante, $nombres, $apellidos, $periodo, $semestre, $carrera, $rol, $numeroCelular, $usuario, $email, $hashedPassword, $estadoUsuario);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/estudiantes.php?agregar=ok'; 
                </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/estudiantes.php');
        }

        $stmt->close();
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/estudiantes.php?agregar=existe'; 
                </script>";
    }

    mysqli_close($conexion);
}

function insert_docente()
{
    include "db.php";

    $cedulaDocente = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $carrera = $_POST['txtCarrera'];
    $rol = 'Docente';
    $numeroCelular = $_POST['txtNumeroCelular'];
    $email = $_POST['txtEmail'];
    $usuario = $_POST['txtUsuario'];
    $hashedPassword = password_hash($cedulaDocente, PASSWORD_BCRYPT);
    $estadoUsuario = 1;

    if (!verificar_usuario($cedulaDocente, 'Docente', $usuario, $email) && !verificar_nombre_usuario($nombres, $apellidos)) {
        $consulta = "INSERT INTO usuarios (Cedula, Nombres, Apellidos, Periodo, IdCarrera, Rol, NumeroCelular, Usuario, Email, Pass, EstadoUsuario)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sssiisssssi", $cedulaDocente, $nombres, $apellidos, $periodo, $carrera, $rol, $numeroCelular, $usuario, $email, $hashedPassword, $estadoUsuario);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/docentes.php?agregar=ok'; 
                </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/docentes.php');
        }

        $stmt->close();
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/docentes.php?agregar=existe'; 
                </script>";
    }

    mysqli_close($conexion);
}

function insert_administrador()
{
    include "db.php";

    $cedulaAdministrador = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $carrera = $_POST['txtCarrera'];
    $rol = 'Administrador';
    $numeroCelular = $_POST['txtNumeroCelular'];
    $email = $_POST['txtEmail'];
    $usuario = $_POST['txtUsuario'];
    $pass = $_POST['txtPass'];
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    //$estadoUsuario = 1;

    if (!verificar_usuario_administrador($cedulaAdministrador, $usuario, $email)) {
        $consulta = "INSERT INTO usuarios (Cedula, Nombres, Apellidos, Periodo, IdCarrera, Rol, NumeroCelular, Usuario, Email, Pass)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sssiisssss", $cedulaAdministrador, $nombres, $apellidos, $periodo, $carrera, $rol, $numeroCelular, $usuario, $email, $hashedPassword);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/administradores.php?agregar=ok'; 
                </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/administradores.php');
        }

        $stmt->close();
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/administradores.php?agregar=existe'; 
                </script>";
    }

    mysqli_close($conexion);
}

function insert_herramienta()
{
    require '../assets/phpqrcode/qrlib.php';
    include "db.php";

    //$ubicacion = mb_strtoupper($_POST['txtUbicacion']);
    //$grupo = mb_strtoupper($_POST['txtGrupo']);
    //$marca = mb_strtoupper($_POST['txtMarca']);

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $codigoHerramienta = mb_strtoupper($_POST['txtCodigoHerramienta']);
    $ubicacion = $_POST['txtUbicacion'];
    $grupo = $_POST['txtGrupo'];
    $detalle = mb_strtoupper($_POST['txtDetalle']);
    $cantidadDisponible = $_POST['txtCantidadDisponible'];
    $marca = $_POST['txtMarca'];
    $observaciones = trim(mb_strtoupper($_POST['txtObservaciones']));

    if (!verificar_herramienta($codigoHerramienta)) {
        if (isset($_FILES['imagenHerramienta']['tmp_name']) && !empty($_FILES['imagenHerramienta']['tmp_name'])) {
            $extension = pathinfo($_FILES['imagenHerramienta']['name'], PATHINFO_EXTENSION);
            $imagenTemp = $_FILES['imagenHerramienta']['tmp_name'];
            $imagenHerramienta = "../assets/img/herramientas/" . $codigoHerramienta . "." . $extension;

            move_uploaded_file($imagenTemp, $imagenHerramienta);
        } else {
            $imagenHerramienta = null;
        }

        global $dominio;
        $qrData = $dominio . "includes/buscar_herramienta.php?CodigoHerramienta=$codigoHerramienta";
        $qrFilename = "../assets/img/codigos_herramientas/Herramienta_$codigoHerramienta.png";
        QRcode::png($qrData, $qrFilename, QR_ECLEVEL_Q, 10, 1, false, 0xFFFFFF, 0x000000, 500, 500);

        $consulta = "INSERT INTO herramientas (CodigoHerramienta, IdUbicacion, IdGrupo, Detalle, CantidadDisponible, IdMarca, Imagen, CodigoQR, Observaciones)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "siisiisss", $codigoHerramienta, $ubicacion, $grupo, $detalle, $cantidadDisponible, $marca, $imagenHerramienta, $qrFilename, $observaciones);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?agregar=ok{$envioGrupo}'; 
                </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/herramientas.php' . $envioGrupo);
        }

        $stmt->close();
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?agregar=existe{$envioGrupo}'; 
                </script>";
    }

    mysqli_close($conexion);
}

function insert_herramienta_ubicacion()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $nombreUbicacion = mb_strtoupper($_POST['txtNombreUbicacion']);

    $consulta = "INSERT INTO ubicacionherramientas (Nombre)
                     VALUES (?)";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $nombreUbicacion);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.href='../views/herramientas.php?agregarUbicacion=ok{$envioGrupo}'; 
            </script>";
    } else {
        mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();

    mysqli_close($conexion);
}

function insert_herramienta_grupo()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $nombreGrupo = mb_strtoupper($_POST['txtNombreGrupo']);

    $consulta = "INSERT INTO grupoherramientas (Nombre)
                     VALUES (?)";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $nombreGrupo);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.href='../views/herramientas.php?agregarGrupo=ok{$envioGrupo}'; 
            </script>";
    } else {
        mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();

    mysqli_close($conexion);
}

function insert_herramienta_marca()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $nombreMarca = $_POST['txtNombreMarca'];

    $consulta = "INSERT INTO marcaherramientas (Nombre)
                     VALUES (?)";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $nombreMarca);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.href='../views/herramientas.php?agregarMarca=ok{$envioGrupo}'; 
            </script>";
    } else {
        mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();

    mysqli_close($conexion);
}

function insert_maqueta()
{
    require '../assets/phpqrcode/qrlib.php';
    include "db.php";

    $codigoMaqueta = mb_strtoupper($_POST['txtCodigoMaqueta']);
    $ubicacion = mb_strtoupper($_POST['txtUbicacion']);
    $grupo = mb_strtoupper($_POST['txtGrupo']);
    $detalle = mb_strtoupper($_POST['txtDetalle']);
    $cantidadDisponible = $_POST['txtCantidadDisponible'];
    $marca = mb_strtoupper($_POST['txtMarca']);
    $observaciones = trim(mb_strtoupper($_POST['txtObservaciones']));

    if (!verificar_maqueta($codigoMaqueta)) {
        if (isset($_FILES['imagenMaqueta']['tmp_name']) && !empty($_FILES['imagenMaqueta']['tmp_name'])) {
            $extension = pathinfo($_FILES['imagenMaqueta']['name'], PATHINFO_EXTENSION);
            $imagenTemp = $_FILES['imagenMaqueta']['tmp_name'];
            $imagenMaqueta = "../assets/img/maquetas/" . $codigoMaqueta . "." . $extension;

            move_uploaded_file($imagenTemp, $imagenMaqueta);
        } else {
            $imagenMaqueta = null;
        }

        global $dominio;
        $qrData = $dominio . "includes/buscar_maqueta.php?CodigoMaqueta=$codigoMaqueta";
        $qrFilename = "../assets/img/codigos_maquetas/Maqueta_$codigoMaqueta.png";
        QRcode::png($qrData, $qrFilename, QR_ECLEVEL_Q, 10, 1, false, 0xFFFFFF, 0x000000, 500, 500);

        $consulta = "INSERT INTO maquetas (CodigoMaqueta, Ubicacion, Grupo, Detalle, CantidadDisponible, Marca, Imagen, CodigoQR, Observaciones)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ssssissss", $codigoMaqueta, $ubicacion, $grupo, $detalle, $cantidadDisponible, $marca, $imagenMaqueta, $qrFilename, $observaciones);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/maquetas.php?agregar=ok'; 
                </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/maquetas.php');
        }

        $stmt->close();
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/maquetas.php?agregar=existe'; 
                </script>";
    }

    mysqli_close($conexion);
}

function insert_manual()
{
    if (isset($_FILES['txtManual'])) {
        $archivoNombre = $_FILES['txtManual']['name'];
        $archivoExtension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
        $archivoTmp = $_FILES['txtManual']['tmp_name'];
        //$archivoTamano = $_FILES['txtManual']['size'];

        if (move_uploaded_file($archivoTmp, "../assets/manuales/manual." . $archivoExtension)) {
            echo "<script language='JavaScript'>
                     location.href='../views/manuales.php?agregarManual=ok'; 
                   </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/manuales.php');
        }
    }
}

function insert_inventario()
{
    if (isset($_FILES['txtInventario'])) {
        $archivoNombre = $_FILES['txtInventario']['name'];
        $archivoExtension = pathinfo($archivoNombre, PATHINFO_EXTENSION);
        $archivoTmp = $_FILES['txtInventario']['tmp_name'];
        //$archivoTamano = $_FILES['txtInventario']['size'];

        if (move_uploaded_file($archivoTmp, "../assets/manuales/inventario." . $archivoExtension)) {
            echo "<script language='JavaScript'>
                     location.href='../views/manuales.php?agregarInventario=ok'; 
                   </script>";
        } else {
            mostrarAlerta('Se produjo un error al procesar la solicitud.', '../views/manuales.php');
        }
    }
}

function editar_estado_solicitud()
{

    if (!empty($_POST['txtEstado'])) {
        include "db.php";

        $idSolicitudArea = $_POST['txtIdSolicitudArea'];
        $estado = $_POST['txtEstado'];

        $consulta = "UPDATE solicitudesareas
                 SET EstadoSolicitudArea = ?
                 WHERE IdSolicitudArea = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "si", $estado, $idSolicitudArea);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/solicitudes.php?editarEstado=ok'; 
                </script>";
        } else {
            $error = mysqli_error($conexion);
            mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/solicitudes.php');
        }

        $stmt->close();
        mysqli_close($conexion);
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/solicitudes.php'; 
                </script>";
    }
}

function editar_estudiante()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    //$cedula = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $semestre = $_POST['txtSemestre'];
    $carrera = $_POST['txtCarrera'];
    //$email = $_POST['txtEmail'];
    $numeroCelular = $_POST['txtNumeroCelular'];
    //$usuario = $_POST['txtUsuario'];

    $consulta = "UPDATE usuarios
                 SET Nombres = ?, Apellidos = ?, Periodo = ?, Semestre = ?, IdCarrera = ?, NumeroCelular = ?
                 WHERE IdUsuario = ?";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "ssisisi", $nombres, $apellidos, $periodo, $semestre, $carrera, $numeroCelular, $idUsuario);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/estudiantes.php?editar=ok'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/estudiantes.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_docente()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    //$cedula = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $carrera = $_POST['txtCarrera'];
    //$email = $_POST['txtEmail'];
    $numeroCelular = $_POST['txtNumeroCelular'];
    //$usuario = $_POST['txtUsuario'];

    $consulta = "UPDATE usuarios
                 SET Nombres = ?, Apellidos = ?, Periodo = ?, IdCarrera = ?, NumeroCelular = ?
                 WHERE IdUsuario = ?";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "ssiiss", $nombres, $apellidos, $periodo, $carrera, $numeroCelular, $idUsuario);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/docentes.php?editar=ok'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/docentes.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_administrador()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    //$cedula = $_POST['txtCedula'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $periodo = $_POST['txtPeriodo'];
    $carrera = $_POST['txtCarrera'];
    $email = $_POST['txtEmail'];
    $numeroCelular = $_POST['txtNumeroCelular'];
    $usuario = $_POST['txtUsuario'];

    if (verificar_editar_usuario($idUsuario, $email)) {

        $consulta = "UPDATE usuarios
                 SET Nombres = ?, Apellidos = ?, Periodo = ?, IdCarrera = ?, NumeroCelular = ?, Usuario = ?, Email = ? 
                 WHERE IdUsuario = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ssiisssi", $nombres, $apellidos, $periodo, $carrera, $numeroCelular, $usuario, $email, $idUsuario);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script language='JavaScript'>
            location.href='../views/administradores.php?editar=ok'; 
                </script>";
        } else {
            $error = mysqli_error($conexion);
            mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/administradores.php');
        }

        $stmt->close();
        mysqli_close($conexion);
    } else {
        echo "<script language='JavaScript'>
            location.href='../views/administradores.php?editar=error_email'; 
                </script>";
    }
}

function editar_usuario()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $passAntigua = $_POST['txtPassAntigua'];
    $pass = $_POST['txtPass'];
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

    $consulta = "";
    $stmt = "";

    if (!empty($pass)) {
        $consulta = "UPDATE usuarios
                 SET Nombres = ?, Apellidos = ?, Pass = ?
                 WHERE IdUsuario = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sssi", $nombres, $apellidos, $hashedPassword, $idUsuario);
    } else {
        $consulta = "UPDATE usuarios
                 SET Nombres = ?, Apellidos = ?, Pass = ?
                 WHERE IdUsuario = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "sssi", $nombres, $apellidos, $passAntigua, $idUsuario);
    }

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/user.php?editar=ok'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/user.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_herramienta()
{
    include "db.php";

    //$ubicacion = mb_strtoupper($_POST['txtUbicacion']);
    //$grupo = mb_strtoupper($_POST['txtGrupo']);
    //$marca = mb_strtoupper($_POST['txtMarca']);

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $codigoHerramienta = mb_strtoupper($_POST['txtCodigoHerramienta']);
    $ubicacion = $_POST['txtUbicacion'];
    $grupo = $_POST['txtGrupo'];
    $detalle = mb_strtoupper($_POST['txtDetalle']);
    $cantidad = $_POST['txtCantidad'];
    $marca = $_POST['txtMarca'];
    $imagenHerramientaAnterior = $_POST['imagenHerramientaAnterior'];
    $imgSubida = $_FILES['imagenHerramienta']['tmp_name'];
    $rutaImagen;
    $observaciones = mb_strtoupper($_POST['txtObservaciones']);

    $consulta = "UPDATE herramientas 
                 SET IdUbicacion = ?, IdGrupo = ?, Detalle = ?, CantidadDisponible = ?, IdMarca = ?, Imagen = ?, Observaciones = ? 
                 WHERE CodigoHerramienta = ?";

    $stmt = mysqli_prepare($conexion, $consulta);

    if (!empty($imgSubida)) {
        if (!empty($imagenHerramientaAnterior) && file_exists($imagenHerramientaAnterior)) {
            unlink($imagenHerramientaAnterior);
        }

        $extension = pathinfo($_FILES['imagenHerramienta']['name'], PATHINFO_EXTENSION);
        $rutaImagen = "../assets/img/herramientas/" . $codigoHerramienta . "." . $extension;
        move_uploaded_file($imgSubida, $rutaImagen);
    } else {
        $rutaImagen = ($imagenHerramientaAnterior !== 'NULL') ? $imagenHerramientaAnterior : NULL;
    }

    mysqli_stmt_bind_param($stmt, "iisiisss", $ubicacion, $grupo, $detalle, $cantidad, $marca, $rutaImagen, $observaciones, $codigoHerramienta);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?editar=ok{$envioGrupo}'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al administrador.\n' . $error, '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_herramienta_ubicacion()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $idUbicacion = mb_strtoupper($_POST['txtIdUbicacionH']);
    $nombre = mb_strtoupper($_POST['txtNombreUbicacion']);

    $consulta = "UPDATE ubicacionherramientas
                 SET Nombre = ?
                 WHERE IdUbicacionH = ?";

    $stmt = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($stmt, "si", $nombre, $idUbicacion);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?editarUbicacion=ok{$envioGrupo}'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al administrador.\n' . $error, '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_herramienta_marca()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $idMarca = mb_strtoupper($_POST['txtIdMarcaH']);
    $nombre = mb_strtoupper($_POST['txtNombreMarca']);

    $consulta = "UPDATE marcaherramientas
                 SET Nombre = ?
                 WHERE IdMarcaH = ?";

    $stmt = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($stmt, "si", $nombre, $idMarca);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?editarMarca=ok{$envioGrupo}'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al administrador.\n' . $error, '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_herramienta_grupo()
{
    include "db.php";

    //Código de grupo se utiliza para redireccionar a la página que muestra las herramientas pertenecientes a un grupo específico, el cual corresponde al grupo al que pertenece la herramienta creada.
    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";

    $idGrupo = mb_strtoupper($_POST['txtIdGrupoH']);
    $nombre = mb_strtoupper($_POST['txtNombreGrupo']);

    $consulta = "UPDATE grupoherramientas
                 SET Nombre = ?
                 WHERE IdGrupoH = ?";

    $stmt = mysqli_prepare($conexion, $consulta);

    mysqli_stmt_bind_param($stmt, "si", $nombre, $idGrupo);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?editarGrupo=ok{$envioGrupo}'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al administrador.\n' . $error, '../views/herramientas.php' . $envioGrupo);
    }

    $stmt->close();
    mysqli_close($conexion);
}

function editar_maqueta()
{
    include "db.php";

    $codigoMaqueta = mb_strtoupper($_POST['txtCodigoMaqueta']);
    $ubicacion = mb_strtoupper($_POST['txtUbicacion']);
    $grupo = mb_strtoupper($_POST['txtGrupo']);
    $detalle = mb_strtoupper($_POST['txtDetalle']);
    $cantidad = $_POST['txtCantidad'];
    $marca = mb_strtoupper($_POST['txtMarca']);
    $imagenMaquetaAnterior = $_POST['imagenMaquetaAnterior'];
    $imgSubida = $_FILES['imagenMaqueta']['tmp_name'];
    $rutaImagen;
    $observaciones = mb_strtoupper($_POST['txtObservaciones']);

    $consulta = "UPDATE maquetas
                 SET Ubicacion = ?, Grupo = ?, Detalle = ?, CantidadDisponible = ?, Marca = ?, Imagen = ?, Observaciones = ? 
                 WHERE CodigoMaqueta = ?";

    $stmt = mysqli_prepare($conexion, $consulta);

    if (!empty($imgSubida)) {
        if (!empty($imagenMaquetaAnterior) && file_exists($imagenMaquetaAnterior)) {
            unlink($imagenMaquetaAnterior);
        }

        $extension = pathinfo($_FILES['imagenMaqueta']['name'], PATHINFO_EXTENSION);
        $rutaImagen = "../assets/img/maquetas/" . $codigoMaqueta . "." . $extension;
        move_uploaded_file($imgSubida, $rutaImagen);
    } else {
        $rutaImagen = ($imagenMaquetaAnterior !== 'NULL') ? $imagenMaquetaAnterior : NULL;
    }

    mysqli_stmt_bind_param($stmt, "sssissss", $ubicacion, $grupo, $detalle, $cantidad, $marca, $rutaImagen, $observaciones, $codigoMaqueta);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "<script language='JavaScript'>
            location.href='../views/maquetas.php?editar=ok'; 
                </script>";
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al administrador.\n' . $error, '../views/maquetas.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function verificar_usuario($nroCedula, $rol, $usuario, $email)
{
    include "db.php";

    $consulta = "SELECT COUNT(*) AS count FROM usuarios WHERE (Cedula = ? OR Usuario = ? OR Email = ?) AND (Rol = ?)";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "ssss", $nroCedula, $usuario, $email, $rol);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    return $fila['count'] > 0;
}

function verificar_usuario_administrador($nroCedula, $usuario, $email)
{
    include "db.php";

    $consulta = "SELECT COUNT(*) AS count FROM usuarios WHERE (Cedula = ? OR Usuario = ? OR Email = ?) AND Rol = 'Administrador'";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "sss", $nroCedula, $usuario, $email);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    return $fila['count'] > 0;
}

function verificar_editar_usuario($idUsuario, $email)
{
    include "db.php";

    // Consulta para obtener el correo actual del usuario
    $consulta_correo_actual = "SELECT Email FROM usuarios WHERE IdUsuario = ?";
    $stmt_correo_actual = mysqli_prepare($conexion, $consulta_correo_actual);
    mysqli_stmt_bind_param($stmt_correo_actual, "i", $idUsuario);
    mysqli_stmt_execute($stmt_correo_actual);
    mysqli_stmt_store_result($stmt_correo_actual);
    mysqli_stmt_bind_result($stmt_correo_actual, $email_actual);
    mysqli_stmt_fetch($stmt_correo_actual);
    mysqli_stmt_close($stmt_correo_actual);

    // Si el nuevo correo es igual al correo actual, sobrescribimos el dato sin verificar
    if ($email === $email_actual) {
        mysqli_close($conexion);
        return 1; // Indica que el correo es igual al actual y no requiere verificación
    }

    // Consulta para verificar si el nuevo correo ya existe en otro usuario
    $consulta_verificacion = "SELECT IdUsuario FROM usuarios WHERE Email = ? AND IdUsuario != ?";
    $stmt_verificacion = mysqli_prepare($conexion, $consulta_verificacion);
    mysqli_stmt_bind_param($stmt_verificacion, "si", $email, $idUsuario);
    mysqli_stmt_execute($stmt_verificacion);
    mysqli_stmt_store_result($stmt_verificacion);
    $num_filas = mysqli_stmt_num_rows($stmt_verificacion);
    mysqli_stmt_close($stmt_verificacion);

    mysqli_close($conexion);

    return ($num_filas > 0) ? 0 : 1;
}

function verificar_nombre_usuario($nombres, $apellidos)
{
    include "db.php";

    $consulta = "SELECT COUNT(*) AS count FROM usuarios WHERE Nombres = ? AND Apellidos = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "ss", $nombres, $apellidos);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    return $fila['count'] > 0;
}

/**
 * 
 * Esta función hace tal cosa tatata y se guardan los datos
 * 
 */
function verificar_herramienta($codigo)
{
    include "db.php";

    $consulta = "SELECT COUNT(*) AS count FROM herramientas WHERE CodigoHerramienta = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    return $fila['count'] > 0;
}

function verificar_maqueta($codigo)
{
    include "db.php";

    $consulta = "SELECT COUNT(*) AS count FROM maquetas WHERE CodigoMaqueta = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    return $fila['count'] > 0;
}

function config_editar_qr_herramienta()
{
    include "db.php";
    require '../assets/phpqrcode/qrlib.php';

    $codigoGrupo = $_POST['txtCodGrupo'];
    $envioGrupo = !empty($codigoGrupo) ? "&grupo=$codigoGrupo" : "";
    $consulta = "SELECT CodigoHerramienta FROM herramientas";
    $resultado = $conexion->query($consulta);

    global $dominio;

    try {
        while ($row = $resultado->fetch_assoc()) {
            $codigoHerramienta = $row['CodigoHerramienta'];

            $qrData = $dominio . "includes/buscar_herramienta.php?CodigoHerramienta=$codigoHerramienta";
            $qrFilename = "../assets/img/codigos_herramientas/Herramienta_$codigoHerramienta.png";

            QRcode::png($qrData, $qrFilename, QR_ECLEVEL_Q, 10, 1, false, 0xFFFFFF, 0x000000, 500, 500);

            $updateConsulta = "UPDATE herramientas SET CodigoQR = ? WHERE CodigoHerramienta = ?";
            $stmt = $conexion->prepare($updateConsulta);
            $stmt->bind_param("ss", $qrFilename, $codigoHerramienta);
            $stmt->execute();
            $stmt->close();
        }
        echo "<script language='JavaScript'>
            location.href='../views/herramientas.php?editarCodigo=ok{$envioGrupo}'; 
                </script>";
    } catch (Exception $e) {
        mostrarAlerta('Error al actualizar los códigos de las herramientas\nError: ' . $e, '../views/herramientas.php' . $envioGrupo);
    } finally {
        $resultado->close();
        mysqli_close($conexion);
    }
}

function config_editar_qr_maqueta()
{
    include "db.php";
    require '../assets/phpqrcode/qrlib.php';

    $consulta = "SELECT CodigoMaqueta FROM maquetas";
    $resultado = $conexion->query($consulta);

    global $dominio;

    try {
        while ($row = $resultado->fetch_assoc()) {
            $codigoMaqueta = $row['CodigoMaqueta'];

            $qrData = $dominio . "includes/buscar_maqueta.php?CodigoMaqueta=$codigoMaqueta";
            $qrFilename = "../assets/img/codigos_maquetas/Maqueta_$codigoMaqueta.png";

            QRcode::png($qrData, $qrFilename, QR_ECLEVEL_Q, 10, 1, false, 0xFFFFFF, 0x000000, 500, 500);

            $updateConsulta = "UPDATE maquetas SET CodigoQR = ? WHERE CodigoMaqueta = ?";
            $stmt = $conexion->prepare($updateConsulta);
            $stmt->bind_param("ss", $qrFilename, $codigoMaqueta);
            $stmt->execute();
            $stmt->close();
        }
        echo "<script language='JavaScript'>
            location.href='../views/maquetas.php?editarCodigo=ok'; 
                </script>";
    } catch (Exception $e) {
        mostrarAlerta('Error al actualizar los códigos de las maquetas\nError: ' . $e, '../views/maquetas.php');
    } finally {
        $resultado->close();
        mysqli_close($conexion);
    }
}

function reestablecer_pass_estudiante()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    $cedula = $_POST['txtCedula'];
    $hashedPassword = password_hash($cedula, PASSWORD_BCRYPT);

    $consulta = "UPDATE usuarios SET Pass = ? WHERE IdUsuario = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $idUsuario);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        mostrarAlerta('La contraseña fue actualizada al número de cédula.', '../views/estudiantes.php');
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/administradores.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function reestablecer_pass_docente()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    $cedula = $_POST['txtCedula'];
    $hashedPassword = password_hash($cedula, PASSWORD_BCRYPT);

    $consulta = "UPDATE usuarios SET Pass = ? WHERE IdUsuario = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $idUsuario);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        mostrarAlerta('La contraseña fue actualizada al número de cédula.', '../views/docentes.php');
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/administradores.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function reestablecer_pass_administrador()
{
    include "db.php";

    $idUsuario = $_POST['txtIdUsuario'];
    $cedula = $_POST['txtCedula'];
    $hashedPassword = password_hash($cedula, PASSWORD_BCRYPT);

    $consulta = "UPDATE usuarios SET Pass = ? WHERE IdUsuario = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $idUsuario);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        mostrarAlerta('La contraseña fue actualizada al número de cédula.', '../views/administradores.php');
    } else {
        $error = mysqli_error($conexion);
        mostrarAlerta('Se produjo un error al procesar la solicitud. Por favor, contacte al equipo de desarrollo.\n' . $error, '../views/administradores.php');
    }

    $stmt->close();
    mysqli_close($conexion);
}

function error_404()
{
    header('Location: ../includes/404.php');
    exit;
}
