-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2024 a las 17:14:39
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnomecanica`
--
CREATE DATABASE IF NOT EXISTS `tecnomecanica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `tecnomecanica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `IdCarrera` tinyint(3) UNSIGNED NOT NULL,
  `NombreCarrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`IdCarrera`, `NombreCarrera`) VALUES
(1, 'Electromecánica Automotriz'),
(2, 'Mecánica Automotriz'),
(3, 'Desarrollo de Software');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoherramientas`
--

CREATE TABLE `grupoherramientas` (
  `IdGrupoH` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `grupoherramientas`
--

INSERT INTO `grupoherramientas` (`IdGrupoH`, `Nombre`) VALUES
(1, 'HERRAMIENTAS MANUALES'),
(2, 'HERRAMIENTAS ELECTRICAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `CodigoHerramienta` varchar(10) NOT NULL,
  `IdUbicacion` int(10) UNSIGNED NOT NULL,
  `IdGrupo` int(10) UNSIGNED NOT NULL,
  `Detalle` varchar(150) NOT NULL,
  `CantidadDisponible` int(10) UNSIGNED NOT NULL,
  `IdMarca` int(10) UNSIGNED NOT NULL,
  `Imagen` varchar(150) DEFAULT NULL,
  `CodigoQR` varchar(150) DEFAULT NULL,
  `Observaciones` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`CodigoHerramienta`, `IdUbicacion`, `IdGrupo`, `Detalle`, `CantidadDisponible`, `IdMarca`, `Imagen`, `CodigoQR`, `Observaciones`) VALUES
('HTECNM0001', 1, 1, 'ARCOS DE SIERRA', 7, 1, '../assets/img/herramientas/HTECNM0001.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0001.png', 'SE RECOMIENDA CAMBIO DE HOJAS DE SIERRÁ'),
('HTECNM0002', 1, 1, 'LIMAS PLANAS 14\"', 4, 2, '../assets/img/herramientas/HTECNM0002.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0002.png', ''),
('HTECNM0003', 1, 1, 'LIMAS PLANAS 12\"', 2, 2, '../assets/img/herramientas/HTECNM0003.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0003.png', ''),
('HTECNM0004', 1, 1, 'LIMAS PLANAS 10\"', 3, 2, '../assets/img/herramientas/HTECNM0004.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0004.png', ''),
('HTECNM0005', 1, 1, 'LIMAS PLANAS 8\"', 5, 2, '../assets/img/herramientas/HTECNM0005.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0005.png', ''),
('HTECNM0006', 1, 1, 'LIMAS PLANAS 6\"', 3, 2, '../assets/img/herramientas/HTECNM0006.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0006.png', ''),
('HTECNM0007', 1, 1, 'LIMAS MEDIA CAÑA 10\"', 3, 2, '../assets/img/herramientas/HTECNM0007.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0007.png', ''),
('HTECNM0008', 1, 1, 'LIMAS MEDIA CAÑA 8\"', 5, 2, '../assets/img/herramientas/HTECNM0008.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0008.png', ''),
('HTECNM0009', 1, 1, 'LIMAS MEDIA CAÑA 6\"', 4, 2, '../assets/img/herramientas/HTECNM0009.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0009.png', 'ROTA'),
('HTECNM0010', 1, 1, 'LIMAS REDONDAS 14\"', 2, 2, '../assets/img/herramientas/HTECNM0010.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0010.png', ''),
('HTECNM0011', 1, 1, 'LIMAS REDONDAS 12\"', 2, 2, '../assets/img/herramientas/HTECNM0011.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0011.png', '1 LIMA ROTA'),
('HTECNM0012', 1, 1, 'LIMAS REDONDAS 8\"', 2, 2, '../assets/img/herramientas/HTECNM0012.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0012.png', ''),
('HTECNM0013', 1, 1, 'LIMAS CUADRADAS 10\"', 1, 2, '../assets/img/herramientas/HTECNM0013.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0013.png', ''),
('HTECNM0014', 1, 1, 'LIMAS TRIANGULARES 10\"', 1, 2, '../assets/img/herramientas/HTECNM0014.jpg', '../assets/img/codigos_herramientas/Herramienta_HTECNM0014.png', ''),
('HTECNM0015', 1, 2, 'LIMAS TRIANGULARES 8\"', 2, 2, '../assets/img/herramientas/HTECNM0015.png', '../assets/img/codigos_herramientas/Herramienta_HTECNM0015.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listaestudiantes`
--

CREATE TABLE `listaestudiantes` (
  `IdListaEstudiantes` int(10) UNSIGNED NOT NULL,
  `IdSolicitud` int(10) UNSIGNED NOT NULL,
  `CedulaEstudiante` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquetas`
--

CREATE TABLE `maquetas` (
  `CodigoMaqueta` varchar(10) NOT NULL,
  `Ubicacion` varchar(40) NOT NULL,
  `Grupo` varchar(40) NOT NULL,
  `Detalle` varchar(150) NOT NULL,
  `CantidadDisponible` int(10) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Imagen` varchar(150) DEFAULT NULL,
  `CodigoQR` varchar(150) DEFAULT NULL,
  `Observaciones` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `maquetas`
--

INSERT INTO `maquetas` (`CodigoMaqueta`, `Ubicacion`, `Grupo`, `Detalle`, `CantidadDisponible`, `Marca`, `Imagen`, `CodigoQR`, `Observaciones`) VALUES
('MTECNM0001', 'LAB - CAJAS', 'MAQUETA', 'CAJA AUDI A4 CVT - TRANSVERSALS', 2, 'AUDIQ', '../assets/img/maquetas/MTECNM0001.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0001.png', ''),
('MTECNM0002', 'LAB - CAJAS', 'MAQUETA', 'CAJA AUDI Q5 - INTEGRAL', 1, 'AUDI', '../assets/img/maquetas/MTECNM0002.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0002.png', ''),
('MTECNM0003', 'LAB - CAJAS', 'MAQUETA', 'CAJA CVT TRANSVERSAL', 3, 'SIN MARCA', '../assets/img/maquetas/MTECNM0003.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0003.png', ''),
('MTECNM0004', 'LAB - CAJAS', 'MAQUETA', 'CAJA TIPO TRASNVERSA', 5, 'SIN MARCA', '../assets/img/maquetas/MTECNM0004.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0004.png', 'PRESENTAN FISURAS, FALTA DE PERNOS, MAL ARMADOS'),
('MTECNM0005', 'LAB - CAJAS', 'MAQUETA', 'CAJA TIPO LONGITUDINAL', 7, 'SIN MARCA', '../assets/img/maquetas/MTECNM0005.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0005.png', 'PRESENTAN FISURAS, FALTA DE PERNOS, MAL ARMADOS'),
('MTECNM0006', 'LAB - CAJAS', 'MAQUETA', 'CAJA TRANSVERSAL', 5, 'SIN MARCA', '../assets/img/maquetas/MTECNM0006.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0006.png', 'PRESENTAN FISURAS, FALTA DE PERNOS, MAL ARMADOS'),
('MTECNM0007', 'LAB - CAJAS', 'MAQUETA', 'TRASNFER WOLKSWAGEN/KIA/SK3', 3, 'WOLKSWAGEN/KIA/SK3', '../assets/img/maquetas/MTECNM0007.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0007.png', ''),
('MTECNM0008', 'LAB - CAJAS', 'MAQUETA', 'BANCO DE PRUEBAS A/T', 1, 'SIN MARCA', '../assets/img/maquetas/MTECNM0008.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0008.png', 'MAL ESTADO'),
('MTECNM0009', 'LAB - CAJAS', 'MAQUETA', 'MAQUETA EN CORTE TRANSIMISION AUTOMATICA', 2, 'SIN MARCA', '../assets/img/maquetas/MTECNM0009.jpg', '../assets/img/codigos_maquetas/Maqueta_MTECNM0009.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcaherramientas`
--

CREATE TABLE `marcaherramientas` (
  `IdMarcaH` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `marcaherramientas`
--

INSERT INTO `marcaherramientas` (`IdMarcaH`, `Nombre`) VALUES
(1, 'VARIOS'),
(2, 'MINTCRAFT/BAHCO'),
(3, 'DREMEL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriz`
--

CREATE TABLE `matriz` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudesareas`
--

CREATE TABLE `solicitudesareas` (
  `IdSolicitudArea` int(10) UNSIGNED NOT NULL,
  `IdUsuario` int(10) UNSIGNED NOT NULL,
  `CedulaDocente` varchar(10) NOT NULL,
  `Nivel` enum('1','2','3','4') NOT NULL,
  `Jornada` enum('Matutina','Nocturna','Intensiva') NOT NULL,
  `IdCarrera` tinyint(3) UNSIGNED NOT NULL,
  `Area` enum('Taller de mecánica','Laboratorio de electrónica','Laboratorio de computación') NOT NULL,
  `Asignatura` varchar(40) NOT NULL,
  `Campus` enum('Calderón','Eloy Alfaro','Magdalena') NOT NULL,
  `Fecha` date NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL,
  `Actividades` varchar(300) NOT NULL,
  `Implementos` varchar(300) NOT NULL,
  `MaterialPractica` varchar(300) NOT NULL,
  `EstadoSolicitudArea` enum('Pendiente','Aprobada','Negada') NOT NULL,
  `Documento` varchar(255) DEFAULT NULL,
  `Observaciones` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacionherramientas`
--

CREATE TABLE `ubicacionherramientas` (
  `IdUbicacionH` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacionherramientas`
--

INSERT INTO `ubicacionherramientas` (`IdUbicacionH`, `Nombre`) VALUES
(1, 'A3'),
(2, 'B1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(10) UNSIGNED NOT NULL,
  `Cedula` varchar(10) NOT NULL,
  `Nombres` varchar(25) NOT NULL,
  `Apellidos` varchar(25) NOT NULL,
  `Periodo` smallint(5) UNSIGNED NOT NULL,
  `Semestre` enum('0','1','2','3','4') NOT NULL,
  `IdCarrera` tinyint(3) UNSIGNED NOT NULL,
  `Rol` enum('Docente','Estudiante','Administrador') NOT NULL,
  `NumeroCelular` varchar(10) NOT NULL,
  `Usuario` varchar(25) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Pass` varchar(60) NOT NULL,
  `EstadoCuenta` enum('Sin préstamos','Préstamo activo','Préstamo vencido') NOT NULL,
  `EstadoUsuario` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Cedula`, `Nombres`, `Apellidos`, `Periodo`, `Semestre`, `IdCarrera`, `Rol`, `NumeroCelular`, `Usuario`, `Email`, `Pass`, `EstadoCuenta`, `EstadoUsuario`) VALUES
(1, '1234567890', 'Admin', 'Root', 36, '0', 3, 'Administrador', '0000000000', 'AdminRoot', 'admin@example.com', '$2y$10$KTkaXsoOBDs/c4ynS2SNf.W.avA0r/eUldfCelaWwe8UetgH1VXOa', 'Sin préstamos', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`IdCarrera`);

--
-- Indices de la tabla `grupoherramientas`
--
ALTER TABLE `grupoherramientas`
  ADD PRIMARY KEY (`IdGrupoH`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`CodigoHerramienta`),
  ADD KEY `fk_ubicacion_idx` (`IdUbicacion`),
  ADD KEY `fk_grupo_idx` (`IdGrupo`),
  ADD KEY `fk_marca_idx` (`IdMarca`);

--
-- Indices de la tabla `listaestudiantes`
--
ALTER TABLE `listaestudiantes`
  ADD PRIMARY KEY (`IdListaEstudiantes`),
  ADD KEY `fk_ListaEstudiantes_idx` (`IdSolicitud`);

--
-- Indices de la tabla `maquetas`
--
ALTER TABLE `maquetas`
  ADD PRIMARY KEY (`CodigoMaqueta`);

--
-- Indices de la tabla `marcaherramientas`
--
ALTER TABLE `marcaherramientas`
  ADD PRIMARY KEY (`IdMarcaH`);

--
-- Indices de la tabla `solicitudesareas`
--
ALTER TABLE `solicitudesareas`
  ADD PRIMARY KEY (`IdSolicitudArea`),
  ADD KEY `fk_carrerasolicitudtaller_idx` (`IdCarrera`),
  ADD KEY `fk_IdUsuarioSolicitudTaller_idx` (`IdUsuario`);

--
-- Indices de la tabla `ubicacionherramientas`
--
ALTER TABLE `ubicacionherramientas`
  ADD PRIMARY KEY (`IdUbicacionH`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Usuario_UNIQUE` (`Usuario`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`),
  ADD KEY `fk_carrera_idx` (`IdCarrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `IdCarrera` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupoherramientas`
--
ALTER TABLE `grupoherramientas`
  MODIFY `IdGrupoH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `listaestudiantes`
--
ALTER TABLE `listaestudiantes`
  MODIFY `IdListaEstudiantes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `marcaherramientas`
--
ALTER TABLE `marcaherramientas`
  MODIFY `IdMarcaH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudesareas`
--
ALTER TABLE `solicitudesareas`
  MODIFY `IdSolicitudArea` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `ubicacionherramientas`
--
ALTER TABLE `ubicacionherramientas`
  MODIFY `IdUbicacionH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD CONSTRAINT `fk_grupo` FOREIGN KEY (`IdGrupo`) REFERENCES `grupoherramientas` (`IdGrupoH`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`IdMarca`) REFERENCES `marcaherramientas` (`IdMarcaH`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`IdUbicacion`) REFERENCES `ubicacionherramientas` (`IdUbicacionH`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `listaestudiantes`
--
ALTER TABLE `listaestudiantes`
  ADD CONSTRAINT `fk_ListaEstudiantes` FOREIGN KEY (`IdSolicitud`) REFERENCES `solicitudesareas` (`IdSolicitudArea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitudesareas`
--
ALTER TABLE `solicitudesareas`
  ADD CONSTRAINT `fk_CarreraSolicitudTaller` FOREIGN KEY (`IdCarrera`) REFERENCES `carreras` (`IdCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IdUsuarioSolicitudTaller` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_carrera` FOREIGN KEY (`IdCarrera`) REFERENCES `carreras` (`IdCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
