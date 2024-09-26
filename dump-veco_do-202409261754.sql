-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: veco_do
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Almacén','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(2,'Aseguramiento de la Calidad','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(3,'Comercial','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(4,'Desarrollo Organizacional','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(5,'Dirección General','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(6,'Finanzas','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(7,'Gerencia General','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(8,'Ingeniería','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(9,'Jurídico','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(10,'Logística','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(11,'Mantenimiento','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(12,'Mercadotecnia','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(13,'Planta 1','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(14,'Planta 2','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(15,'Procuramiento','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(16,'Seguridad e Higiene','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(17,'Servicios','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL),(18,'Sistemas','Jonathan Sanchez','2024-09-23 16:42:34',NULL,NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

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
  `puesto` text NOT NULL,
  `linea` text NOT NULL,
  `area` text NOT NULL,
  `sede` text NOT NULL,
  `gerente_jefe` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text NOT NULL,
  `fecha_hora_modificacion` text NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `empleados_unique` (`no_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Información de los colaboradores de la compania';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Jonathan Jaziel Sanchez Ortiz','S011','Ingeniero de Soporte','Sistemas','Sistemas','Morelos','Santos Gonzalez Espinosa','Jonathan Jaziel Sánchez Ortiz','2024-09-26 23:31:50','',''),(2,'Marco Antonio Lorenzana Sotelo','L11','Gerencia de Sistemas','Sistemas','Sistemas','CDMX','Ivonne Villegas','Jonathan Jaziel Sánchez Ortiz','2024-09-26 23:48:13','',''),(3,'Santos Gonzalez Espinosa','G002','Jefatura de Sistemas','Sistemas','Sistemas','Morelos','Marco Antonio Lorenzana Sotelo','Jonathan Jaziel Sánchez Ortiz','2024-09-26 23:20:36','',''),(4,'Diego Emmanuel Cuellar Mendez','C32','Ingeniero de Soporte','Sistemas','Sistemas','CDMX','Santos Gonzalez Espinosa','Jonathan Jaziel Sánchez Ortiz','2024-09-26 23:31:50','','');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lineas`
--

LOCK TABLES `lineas` WRITE;
/*!40000 ALTER TABLE `lineas` DISABLE KEYS */;
/*!40000 ALTER TABLE `lineas` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motivo_ausencia`
--

LOCK TABLES `motivo_ausencia` WRITE;
/*!40000 ALTER TABLE `motivo_ausencia` DISABLE KEYS */;
INSERT INTO `motivo_ausencia` VALUES (1,'Retardo Justificado','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(2,'Retardo Injustificado','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(3,'Paternidad','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(4,'Personal: Tiempo por tiempo','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(5,'Personal: Trabajo desde casa','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(6,'Personal: Falta Justificada','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(7,'Personal: Falta Injustificada','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(8,'Salud','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(9,'Incapacidades: Enfermedad General','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(10,'Incapacidades: Riesgo de trabajo','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(11,'Incapacidades: Maternidad','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(12,'Vacaciones','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL),(13,'Labor de campo','Jonathan Sánchez','2024-09-23 18:11:59',NULL,NULL);
/*!40000 ALTER TABLE `motivo_ausencia` ENABLE KEYS */;
UNLOCK TABLES;

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
  `fecha_hora_modificacion` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Listado de permisos permitidos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'15:30','26/09/2024','Jonathan Sanchez','Jonathan Jaziel Sanchez Ortiz','S011','Ingeniero de Soporte','Sistemas','Sistemas','Morelos','Jonathan Jaziel Sanchez Ortiz','Personal: Tiempo por tiempo','Si','2024-09-26','0','15:30','15:30','2024-09-26','tyxt',NULL,'::1','JONATHANSA','2024-09-26 21:36:34',NULL,NULL),(2,'15:40','26/09/2024','Jonathan Sanchez','Jonathan Jaziel Sanchez Ortiz','S011','Ingeniero de Soporte','Sistemas','Sistemas','Morelos','Jonathan Jaziel Sanchez Ortiz','Retardo Justificado','Si','2024-09-30','0','15:37','15:38','2024-09-30','','../checador/evidence_perm/AKD101209VA2FRMDVA0000076018.pdf','::1','JONATHANSA','2024-09-26 21:40:56',NULL,NULL),(3,'16:22','26/09/2024','Jonathan Sanchez','Jonathan Jaziel Sanchez Ortiz','S011','Ingeniero de Soporte','Sistemas','Sistemas','Morelos','Jonathan Jaziel Sanchez Ortiz','Personal: Falta Injustificada','No','2024-09-26','0','','','2024-09-26','txt','../checador/evidence_perm/Tickets - Odoo Community Days_ América Latina (11 sep. 2024 09_00_00) - Jonathán Sánchez.pdf','::1','JONATHANSA','2024-09-26 22:24:13',NULL,NULL),(4,'17:32','26/09/2024','Santos Gonzalez Espinosa','Diego Emmanuel Cuellar Mendez','C32','Ingeniero de Soporte','Sistemas','Sistemas','CDMX','Santos Gonzalez Espinosa','Labor de campo','Si','2024-09-30','1','07:00','19:00','2024-09-30','Trabajo en planta Morelos','../checador/evidence_perm/MantenimientoMorelos.png','192.168.1.6','SANTOSGO','2024-09-26 23:34:31',NULL,NULL);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puestos` (
  `id_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `puesto` text NOT NULL,
  `registra_data` text NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifica_data` text DEFAULT NULL,
  `fecha_hora_modificacion` text DEFAULT NULL,
  PRIMARY KEY (`id_puesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos`
--

LOCK TABLES `puestos` WRITE;
/*!40000 ALTER TABLE `puestos` DISABLE KEYS */;
/*!40000 ALTER TABLE `puestos` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2024-09-26 17:54:46
