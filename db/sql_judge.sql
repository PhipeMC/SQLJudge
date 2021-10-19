-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: localhost    Database: sql_judge
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `idAlumno` int NOT NULL AUTO_INCREMENT,
  `UsuarioA` varchar(45) NOT NULL,
  `ContrasenaA` varchar(100) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(90) NOT NULL,
  PRIMARY KEY (`idAlumno`),
  UNIQUE KEY `UsuarioA_UNIQUE` (`UsuarioA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idCATEGORIA` int NOT NULL AUTO_INCREMENT,
  `NombreCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idCATEGORIA`),
  UNIQUE KEY `NombreCategoria_UNIQUE` (`NombreCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docente` (
  `idDocente` int NOT NULL AUTO_INCREMENT,
  `UsuarioD` varchar(45) NOT NULL,
  `ContrasenaD` varchar(100) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellidos` varchar(90) NOT NULL,
  PRIMARY KEY (`idDocente`),
  UNIQUE KEY `UsuarioA_UNIQUE` (`UsuarioD`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `envio`
--

DROP TABLE IF EXISTS `envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envio` (
  `Estado` enum('TLE','PR','EE','F') NOT NULL DEFAULT 'F',
  `NumeroIntento` int NOT NULL AUTO_INCREMENT,
  `CodigoAlumno` longtext NOT NULL,
  `ALUMNO_idAlumno` int NOT NULL,
  `PROBLEMA_idPROBLEMA` int NOT NULL,
  PRIMARY KEY (`NumeroIntento`),
  KEY `fk_ALUMNO_PROBLEMA_ALUMNO1_idx` (`ALUMNO_idAlumno`),
  KEY `fk_ALUMNO_PROBLEMA_PROBLEMA1_idx` (`PROBLEMA_idPROBLEMA`),
  CONSTRAINT `fk_ALUMNO_PROBLEMA_ALUMNO1` FOREIGN KEY (`ALUMNO_idAlumno`) REFERENCES `alumno` (`idAlumno`),
  CONSTRAINT `fk_ALUMNO_PROBLEMA_PROBLEMA1` FOREIGN KEY (`PROBLEMA_idPROBLEMA`) REFERENCES `problema` (`idPROBLEMA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo` (
  `CodigoGrupo` varchar(45) NOT NULL,
  `DOCENTE_idDocente1` int NOT NULL,
  `idGrupo` varchar(45) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  UNIQUE KEY `CodigoGrupo_UNIQUE` (`CodigoGrupo`),
  KEY `fk_GRUPO_DOCENTE1_idx` (`DOCENTE_idDocente1`),
  CONSTRAINT `fk_GRUPO_DOCENTE1` FOREIGN KEY (`DOCENTE_idDocente1`) REFERENCES `docente` (`idDocente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='								';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `problema`
--

DROP TABLE IF EXISTS `problema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problema` (
  `idPROBLEMA` int NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(45) NOT NULL,
  `Descripcion` longtext NOT NULL,
  `DOCENTE_idUsuario` int NOT NULL,
  `Solucion` longtext NOT NULL,
  `CATEGORIA_idCATEGORIA` int NOT NULL,
  PRIMARY KEY (`idPROBLEMA`),
  UNIQUE KEY `Titulo_UNIQUE` (`Titulo`),
  KEY `fk_PROBLEMA_DOCENTE1_idx` (`DOCENTE_idUsuario`),
  KEY `fk_PROBLEMA_CATEGORIA1_idx` (`CATEGORIA_idCATEGORIA`),
  CONSTRAINT `fk_PROBLEMA_CATEGORIA1` FOREIGN KEY (`CATEGORIA_idCATEGORIA`) REFERENCES `categoria` (`idCATEGORIA`),
  CONSTRAINT `fk_PROBLEMA_DOCENTE1` FOREIGN KEY (`DOCENTE_idUsuario`) REFERENCES `docente` (`idDocente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-19  9:13:33
