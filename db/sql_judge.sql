-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2021 a las 02:52:23
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sql_judge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--
Create database sql_judge;
use sql_judge;
CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Contrasena` varchar(150) NOT NULL,
  `Nombre` varchar(90) NOT NULL,
  `Apellidos` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `alumno` (`idAlumno`, `Usuario`, `Email`, `Contrasena`, `Nombre`, `Apellidos`) VALUES
(1, 'Alu1', 'root1@gmail.com', 'root1', 'Nahuel', 'Cruz'),
(2, 'Alu2', 'root2@gmail.com', 'root1', 'Daniel', 'Garcia'),
(3, 'Alu3', 'root3@gmail.com', 'root1',  'Cesar', 'Domunguez');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCATEGORIA` int(11) NOT NULL,
  `NombreCategoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCATEGORIA`, `NombreCategoria`) VALUES
(3, 'Agrupaciones'),
(1, 'Consultas Básicas'),
(2, 'Consultas de varias tablas'),
(6, 'funciones(text, date, numéricas...)'),
(4, 'Subconsultas anidadas'),
(5, 'Subconsultas correlacionadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `idDocente` int(11) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Contrasena` varchar(150) NOT NULL,
  `Nombre` varchar(90) NOT NULL,
  `Apellidos` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `Usuario`, `Email`, `Contrasena`, `Nombre`, `Apellidos`) VALUES
(1, 'prof1', 'root@gmail.com', 'root', 'Felipe', 'Calderon');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `Estado` enum('CD','RT','NR','NC','WA','AC') NOT NULL,
  `NumeroIntento` int(11) NOT NULL,
  `CodigoAlumno` longtext NOT NULL,
  `ALUMNO_idAlumno` int(11) NOT NULL,
  `PROBLEMA_idPROBLEMA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO envio (`Estado`, `NumeroIntento`, `CodigoAlumno`, `ALUMNO_idAlumno`, `PROBLEMA_idPROBLEMA`) VALUES
('AC', 10, 'fsjfsebjfeapfipefbipsfbefibesfbisebifseibfise', 1, 10),
('AC', 2, 'fefshfgjvfvsefhkafeaknfeafbaefbeaifafiabpfibpafi', 2, 10),
('WA', 3, 'fefshfgjvfvsefhkafeaknfeafbaefbeaifafiabpfibpafi', 3, 10),
('AC', 4, 'fsjfsebjfeapfipefbipsfbefibesfbisebifseibfise', 1, 18),
('WA', 1, 'fesifvifsevyfeufvufjbavhjavggzczgcvwyudtavydi', 3, 18);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `CodigoGrupo` varchar(45) NOT NULL,
  `DOCENTE_idDocente1` int(11) NOT NULL,
  `idGrupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problema`
--

CREATE TABLE `problema` (
  `idPROBLEMA` int(11) NOT NULL,
  `Titulo` varchar(45) NOT NULL,
  `Descripcion` longtext NOT NULL,
  `DOCENTE_idUsuario` int(11) NOT NULL,
  `Solucion` longtext NOT NULL,
  `CATEGORIA_idCATEGORIA` int(11) NOT NULL,
  `dificultad` enum('Basico','Intermedio','Avanzado') NOT NULL,
  `NombreBaseDatos` enum('World', 'Sakila', 'Nwind') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `problema`
--

INSERT INTO `problema` (`idPROBLEMA`, `Titulo`, `Descripcion`, `DOCENTE_idUsuario`, `Solucion`, `CATEGORIA_idCATEGORIA`, `dificultad`) VALUES
(10, 'Select dificil', 'asdsasdsadsadsadasd', 1, 'sadsadsadsadsadsads', 1, 'Basico'),
(18, 'Seleccion basica', 'asdsasdsadsadsadasd', 1, 'sadsadsadsadsadsads', 3, 'Basico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `UsuarioA_UNIQUE` (`Usuario`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCATEGORIA`),
  ADD UNIQUE KEY `NombreCategoria_UNIQUE` (`NombreCategoria`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`idDocente`),
  ADD UNIQUE KEY `UsuarioA_UNIQUE` (`Usuario`),
   ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`NumeroIntento`),
  ADD KEY `fk_ALUMNO_PROBLEMA_ALUMNO1_idx` (`ALUMNO_idAlumno`),
  ADD KEY `fk_ALUMNO_PROBLEMA_PROBLEMA1_idx` (`PROBLEMA_idPROBLEMA`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD UNIQUE KEY `CodigoGrupo_UNIQUE` (`CodigoGrupo`),
  ADD KEY `fk_GRUPO_DOCENTE1_idx` (`DOCENTE_idDocente1`);

--
-- Indices de la tabla `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`idPROBLEMA`),
  ADD UNIQUE KEY `Titulo_UNIQUE` (`Titulo`),
  ADD KEY `fk_PROBLEMA_DOCENTE1_idx` (`DOCENTE_idUsuario`),
  ADD KEY `fk_PROBLEMA_CATEGORIA1_idx` (`CATEGORIA_idCATEGORIA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `idDocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `NumeroIntento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `problema`
--
ALTER TABLE `problema`
  MODIFY `idPROBLEMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `fk_ALUMNO_PROBLEMA_ALUMNO1` FOREIGN KEY (`ALUMNO_idAlumno`) REFERENCES `alumno` (`idAlumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ALUMNO_PROBLEMA_PROBLEMA1` FOREIGN KEY (`PROBLEMA_idPROBLEMA`) REFERENCES `problema` (`idPROBLEMA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_GRUPO_DOCENTE1` FOREIGN KEY (`DOCENTE_idDocente1`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `problema`
--
ALTER TABLE `problema`
  ADD CONSTRAINT `fk_PROBLEMA_CATEGORIA1` FOREIGN KEY (`CATEGORIA_idCATEGORIA`) REFERENCES `categoria` (`idCATEGORIA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PROBLEMA_DOCENTE1` FOREIGN KEY (`DOCENTE_idUsuario`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
