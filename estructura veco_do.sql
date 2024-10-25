-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 23:12:12
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id_puesto` int(11) NOT NULL,
  `area` text NOT NULL,
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
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id_linea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivo_ausencia`
--
ALTER TABLE `motivo_ausencia`
  MODIFY `id_motivo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
