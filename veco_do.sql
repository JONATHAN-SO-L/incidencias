-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2024 a las 01:55:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veco_do`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `area` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `area`, `registra_data`, `fecha_hora_registro`, `modifica_data`, `fecha_hora_modificacion`) VALUES
(1, 'Almacén', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(2, 'Aseguramiento de la Calidad', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(3, 'Comercial', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(4, 'Desarrollo Organizacional', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(5, 'Dirección General', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(6, 'Finanzas', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(7, 'Gerencia General', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(8, 'Ingeniería', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(9, 'Jurídico', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(10, 'Logística', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(11, 'Mantenimiento', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(12, 'Mercadotecnia', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(13, 'Planta 1', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(14, 'Planta 2', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(15, 'Procuramiento', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(16, 'Seguridad e Higiene', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(17, 'Servicios', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL),
(18, 'Sistemas', 'Jonathan Sanchez', '2024-09-23 16:42:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `nombre_colaborador` text NOT NULL,
  `no_empleado` varchar(10) NOT NULL,
  `puesto` text NOT NULL,
  `linea` text NOT NULL,
  `area` text NOT NULL,
  `sede` text NOT NULL,
  `gerente_jefe` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text NOT NULL,
  `fecha_hora_modificacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Información de los colaboradores de la compania';

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre_colaborador`, `no_empleado`, `puesto`, `linea`, `area`, `sede`, `gerente_jefe`, `registra_data`, `fecha_hora_registro`, `modifica_data`, `fecha_hora_modificacion`) VALUES
(1, 'Jonathan Jaziel Sanchez Ortiz', 'S011', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'Morelos', 'Santos Gonzalez Espinosa', 'Jonathan Jaziel Sánchez Ortiz', '2024-09-26 23:31:50', '', ''),
(2, 'Marco Antonio Lorenzana Sotelo', 'L11', 'Gerencia de Sistemas', 'Sistemas', 'Sistemas', 'CDMX', 'Ivonne Villegas', 'Jonathan Jaziel Sánchez Ortiz', '2024-09-26 23:48:13', '', ''),
(3, 'Santos Gonzalez Espinosa', 'G002', 'Jefatura de Sistemas', 'Sistemas', 'Sistemas', 'Morelos', 'Marco Antonio Lorenzana Sotelo', 'Jonathan Jaziel Sánchez Ortiz', '2024-09-26 23:20:36', '', ''),
(4, 'Diego Emmanuel Cuellar Mendez', 'C32', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'CDMX', 'Santos Gonzalez Espinosa', 'Jonathan Jaziel Sánchez Ortiz', '2024-09-26 23:31:50', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id_linea` int(11) NOT NULL,
  `area` text NOT NULL,
  `linea` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_ausencia`
--

CREATE TABLE `motivo_ausencia` (
  `id_motivo` int(10) UNSIGNED NOT NULL,
  `motivo_ausencia` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modifica` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivo_ausencia`
--

INSERT INTO `motivo_ausencia` (`id_motivo`, `motivo_ausencia`, `registra_data`, `fecha_hora_registro`, `modifica_data`, `fecha_hora_modifica`) VALUES
(1, 'Retardo Justificado', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(2, 'Retardo Injustificado', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(3, 'Paternidad', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(4, 'Personal: Tiempo por tiempo', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(5, 'Personal: Trabajo desde casa', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(6, 'Personal: Falta Justificada', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(7, 'Personal: Falta Injustificada', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(8, 'Salud', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(9, 'Incapacidades: Enfermedad General', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(10, 'Incapacidades: Riesgo de trabajo', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(11, 'Incapacidades: Maternidad', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(12, 'Vacaciones', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL),
(13, 'Labor de campo', 'Jonathan Sánchez', '2024-09-23 18:11:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(10) UNSIGNED NOT NULL,
  `hora_creacion` varchar(10) NOT NULL,
  `fecha_creacion` varchar(10) NOT NULL,
  `registra_permiso` text NOT NULL,
  `nombre_colaborador` text NOT NULL,
  `no_empleado` varchar(10) NOT NULL,
  `puesto` text NOT NULL,
  `linea` text NOT NULL,
  `area` text NOT NULL,
  `sede` text NOT NULL,
  `gerente_jefe` text NOT NULL,
  `motivo_ausencia` text NOT NULL,
  `goce_sueldo` text DEFAULT NULL,
  `fecha_ausencia` varchar(15) NOT NULL,
  `dias_solicitados` varchar(5) NOT NULL,
  `hora_salida` varchar(10) DEFAULT NULL,
  `hora_regreso` varchar(10) DEFAULT NULL,
  `fecha_regreso` varchar(15) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `evidencia` text DEFAULT NULL,
  `ip_registro` text DEFAULT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Listado de permisos permitidos';

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `hora_creacion`, `fecha_creacion`, `registra_permiso`, `nombre_colaborador`, `no_empleado`, `puesto`, `linea`, `area`, `sede`, `gerente_jefe`, `motivo_ausencia`, `goce_sueldo`, `fecha_ausencia`, `dias_solicitados`, `hora_salida`, `hora_regreso`, `fecha_regreso`, `observaciones`, `evidencia`, `ip_registro`, `registra_data`, `fecha_hora_registro`, `modifica_data`, `fecha_hora_modificacion`) VALUES
(1, '15:30', '26/09/2024', 'Jonathan Sanchez', 'Jonathan Jaziel Sanchez Ortiz', 'S011', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'Morelos', 'Jonathan Jaziel Sanchez Ortiz', 'Personal: Tiempo por tiempo', 'Si', '2024-09-26', '0', '15:30', '15:30', '2024-09-26', 'tyxt', NULL, '::1', 'JONATHANSA', '2024-09-26 21:36:34', NULL, NULL),
(2, '15:40', '26/09/2024', 'Jonathan Sanchez', 'Jonathan Jaziel Sanchez Ortiz', 'S011', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'Morelos', 'Jonathan Jaziel Sanchez Ortiz', 'Retardo Justificado', 'Si', '2024-09-30', '0', '15:37', '15:38', '2024-09-30', '', '../checador/evidence_perm/AKD101209VA2FRMDVA0000076018.pdf', '::1', 'JONATHANSA', '2024-09-26 21:40:56', NULL, NULL),
(3, '16:22', '26/09/2024', 'Jonathan Sanchez', 'Jonathan Jaziel Sanchez Ortiz', 'S011', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'Morelos', 'Jonathan Jaziel Sanchez Ortiz', 'Personal: Falta Injustificada', 'No', '2024-09-26', '0', '', '', '2024-09-26', 'txt', '../checador/evidence_perm/Tickets - Odoo Community Days_ América Latina (11 sep. 2024 09_00_00) - Jonathán Sánchez.pdf', '::1', 'JONATHANSA', '2024-09-26 22:24:13', NULL, NULL),
(4, '17:32', '26/09/2024', 'Santos Gonzalez Espinosa', 'Diego Emmanuel Cuellar Mendez', 'C32', 'Ingeniero de Soporte', 'Sistemas', 'Sistemas', 'CDMX', 'Santos Gonzalez Espinosa', 'Labor de campo', 'Si', '2024-09-30', '1', '07:00', '19:00', '2024-09-30', 'Trabajo en planta Morelos', '../checador/evidence_perm/MantenimientoMorelos.png', '192.168.1.6', 'SANTOSGO', '2024-09-26 23:34:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id_puesto` int(11) NOT NULL,
  `puesto` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `empleados_unique` (`no_empleado`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `motivo_ausencia`
--
ALTER TABLE `motivo_ausencia`
  ADD PRIMARY KEY (`id_motivo`),
  ADD UNIQUE KEY `motivo_ausencia_unique` (`motivo_ausencia`) USING HASH;

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id_puesto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivo_ausencia`
--
ALTER TABLE `motivo_ausencia`
  MODIFY `id_motivo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
