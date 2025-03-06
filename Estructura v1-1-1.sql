-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: veco.lat    Database: veco_do
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `id_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_colaborador` text NOT NULL,
  `no_empleado` varchar(10) NOT NULL,
  `puesto` text DEFAULT NULL,
  `linea` text DEFAULT NULL,
  `area` text NOT NULL,
  `sede` text DEFAULT NULL,
  `gerente_jefe` text DEFAULT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `empleados_unique` (`no_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Información de los colaboradores de la compania';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lineas`
--

DROP TABLE IF EXISTS `lineas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lineas` (
  `id_linea` int(11) NOT NULL AUTO_INCREMENT,
  `area` text NOT NULL,
  `linea` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL,
  PRIMARY KEY (`id_linea`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `motivo_ausencia`
--

DROP TABLE IF EXISTS `motivo_ausencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motivo_ausencia` (
  `id_motivo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `motivo_ausencia` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modifica` text DEFAULT NULL,
  PRIMARY KEY (`id_motivo`),
  UNIQUE KEY `motivo_ausencia_unique` (`motivo_ausencia`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `id_permiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `fecha_hora_modificacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=1641 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Listado de permisos permitidos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puestos` (
  `id_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `area` text NOT NULL,
  `puesto` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL,
  PRIMARY KEY (`id_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'veco_do'
--

--
-- Dumping routines for database 'veco_do'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-06 13:10:42
