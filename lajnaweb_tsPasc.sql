-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-02-2021 a las 10:36:20
-- Versión del servidor: 10.1.48-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-06:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lajnaweb_tsPasc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADMINISTRADOR`
--

CREATE TABLE `ADMINISTRADOR` (
  `ID` int(10) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `ADMIN` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ADMINISTRADOR`
--

INSERT INTO `ADMINISTRADOR` (`ID`, `NOMBRE`, `PASSWORD`, `ADMIN`) VALUES
(1, 'PASCUAL', '$2y$15$jbnBWBsn1cD7PQbTeu9.w.0ehk2G.CuHba15otAnoufLpXGAAYaUS', 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ALUMNOS`
--

CREATE TABLE `ALUMNOS` (
  `ID` int(10) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDOS` varchar(60) NOT NULL,
  `INSTRUMENTO` varchar(15) NOT NULL,
  `CORREO` varchar(90) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `NOMBREADMIN` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ALUMNOS`
--

INSERT INTO `ALUMNOS` (`ID`, `NOMBRE`, `APELLIDOS`, `INSTRUMENTO`, `CORREO`, `PASSWORD`, `NOMBREADMIN`) VALUES
(1, 'FEDERICO', 'garcia', 'oboe', 'oboe@correo.com', '$2y$15$./GyLdynsvZWbmF3sP03.e.FwJGsCd9xA1gpF99KTrKXPvZedH6Hq', 'PASCUAL'),
(2, 'LUIS', 'perez', 'arpa', 'arpa@correo.com', '$2y$15$ZL49rbrphwnmRjO.ovSXDOieygAQP8ooAj04hDFS2I5vdobn.wHRO', 'PASCUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AULAS`
--

CREATE TABLE `AULAS` (
  `IDAULA` int(10) NOT NULL,
  `PISO` int(10) NOT NULL,
  `TIPO` varchar(25) NOT NULL,
  `DESCRIPCION` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `AULAS`
--

INSERT INTO `AULAS` (`IDAULA`, `PISO`, `TIPO`, `DESCRIPCION`) VALUES
(1, 1, 'GENERAL', 'PISO 1 GENERAL 1'),
(2, 1, 'GENERAL', 'PISO 1 GENERAL 2'),
(3, 1, 'GENERAL', 'PISO 1 GENERAL 3'),
(4, 1, 'GENERAL', 'PISO 1 GENERAL 4'),
(5, 1, 'GENERAL', 'PISO 1 GENERAL 5'),
(6, 1, 'GENERAL', 'PISO 1 GENERAL 6'),
(7, 1, 'GENERAL', 'PISO 1 GENERAL 7'),
(8, 1, 'ARPA', 'PISO 1 ARPA'),
(9, 1, 'CANTO', 'PISO 1 CANTO'),
(10, 1, 'PERCUSION', 'PISO 1 PERCUSION'),
(11, 1, 'PERCUSION', 'PISO 1 PERCUSION 2'),
(12, 1, 'JAZZ', 'PISO 1 JAZZ'),
(13, 1, 'CAMARA', 'PISO 1 CAMARA'),
(14, 2, 'GENERAL', 'PISO 2 GENERAL 1'),
(15, 2, 'GENERAL', 'PISO 2 GENERAL 2'),
(16, 2, 'GENERAL', 'PISO 2 GENERAL 3'),
(17, 2, 'GENERAL', 'PISO 2 GENERAL 4'),
(18, 2, 'GENERAL', 'PISO 2 GENERAL 5'),
(19, 2, 'GENERAL', 'PISO 2 GENERAL 6'),
(20, 2, 'GENERAL', 'PISO 2 GENERAL 7'),
(21, 3, 'GENERAL', 'PISO 2 GENERAL 8'),
(22, 3, 'GENERAL', 'PISO 3 GENERAL 1'),
(23, 3, 'GENERAL', 'PISO 3 GENERAL 2'),
(24, 3, 'GENERAL', 'PISO 3 GENERAL 3'),
(25, 3, 'GENERAL', 'PISO 3 GENERAL 4'),
(26, 3, 'GENERAL', 'PISO 3 GENERAL 5'),
(28, 3, 'GENERAL', 'PISO 3 GENERAL 7'),
(29, 3, 'GENERAL', 'PISO 3 GENERAL 8'),
(30, 3, 'GENERAL', 'PISO 3 GENERAL 9'),
(31, 3, 'GENERAL', 'PISO 3 GENERAL 10'),
(27, 3, 'GENERAL', 'PISO 3 GENERAL 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HISTORICOPETICIONES`
--

CREATE TABLE `HISTORICOPETICIONES` (
  `ID` int(10) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDOS` varchar(60) NOT NULL,
  `INSTRUMENTO` varchar(15) NOT NULL,
  `CORREO` varchar(90) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `VALIDADA` tinyint(1) NOT NULL,
  `NOMBREADMIN` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `HISTORICOPETICIONES`
--

INSERT INTO `HISTORICOPETICIONES` (`ID`, `NOMBRE`, `APELLIDOS`, `INSTRUMENTO`, `CORREO`, `PASSWORD`, `VALIDADA`, `NOMBREADMIN`) VALUES
(1, 'federico', 'garcia', 'oboe', 'oboe@correo.com', '$2y$15$./GyLdynsvZWbmF3sP03.e.FwJGsCd9xA1gpF99KTrKXPvZedH6Hq', 1, 'PASCUAL'),
(2, 'luis', 'perez', 'arpa', 'arpa@correo.com', '$2y$15$ZL49rbrphwnmRjO.ovSXDOieygAQP8ooAj04hDFS2I5vdobn.wHRO', 1, 'PASCUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PETICIONES`
--

CREATE TABLE `PETICIONES` (
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDOS` varchar(60) NOT NULL,
  `INSTRUMENTO` varchar(15) NOT NULL,
  `CORREO` varchar(90) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PISOS`
--

CREATE TABLE `PISOS` (
  `IDPISO` int(10) NOT NULL,
  `HORA` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PISOS`
--

INSERT INTO `PISOS` (`IDPISO`, `HORA`) VALUES
(1, '08:30:00'),
(1, '10:00:00'),
(1, '11:30:00'),
(1, '13:00:00'),
(1, '14:30:00'),
(1, '16:00:00'),
(1, '17:30:00'),
(1, '19:00:00'),
(1, '20:30:00'),
(2, '08:15:00'),
(2, '09:45:00'),
(2, '11:15:00'),
(2, '12:45:00'),
(2, '14:15:00'),
(2, '15:45:00'),
(2, '17:15:00'),
(2, '18:45:00'),
(2, '20:15:00'),
(3, '08:00:00'),
(3, '09:30:00'),
(3, '11:00:00'),
(3, '12:30:00'),
(3, '14:00:00'),
(3, '15:30:00'),
(3, '17:00:00'),
(3, '18:30:00'),
(3, '20:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RESERVACAMARA`
--

CREATE TABLE `RESERVACAMARA` (
  `IDRESERVA` int(10) NOT NULL,
  `IDALUMNO` int(10) NOT NULL,
  `IDALUMNO2` int(10) NOT NULL,
  `IDALUMNO3` int(10) NOT NULL,
  `IDAULA` int(10) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RESERVAS`
--

CREATE TABLE `RESERVAS` (
  `IDRESERVA` int(10) NOT NULL,
  `IDALUMNO` int(10) NOT NULL,
  `IDAULA` int(10) NOT NULL,
  `FECHA` date NOT NULL,
  `HORA` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `RESERVAS`
--

INSERT INTO `RESERVAS` (`IDRESERVA`, `IDALUMNO`, `IDAULA`, `FECHA`, `HORA`) VALUES
(1, 1, 1, '2021-02-25', '08:30:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NOMBRE` (`NOMBRE`);

--
-- Indices de la tabla `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UN_CORREO` (`CORREO`),
  ADD KEY `NOMBREADMIN_FK` (`NOMBREADMIN`);

--
-- Indices de la tabla `AULAS`
--
ALTER TABLE `AULAS`
  ADD PRIMARY KEY (`IDAULA`),
  ADD KEY `PISO_FK` (`PISO`);

--
-- Indices de la tabla `HISTORICOPETICIONES`
--
ALTER TABLE `HISTORICOPETICIONES`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NOMBREADMIN_FK` (`NOMBREADMIN`);

--
-- Indices de la tabla `PETICIONES`
--
ALTER TABLE `PETICIONES`
  ADD PRIMARY KEY (`CORREO`);

--
-- Indices de la tabla `PISOS`
--
ALTER TABLE `PISOS`
  ADD PRIMARY KEY (`IDPISO`,`HORA`);

--
-- Indices de la tabla `RESERVACAMARA`
--
ALTER TABLE `RESERVACAMARA`
  ADD PRIMARY KEY (`IDRESERVA`),
  ADD KEY `RESERVACAMARA_FK` (`IDALUMNO`),
  ADD KEY `RESERVACAMARA_FK2` (`IDALUMNO2`),
  ADD KEY `RESERVACAMARA_FK3` (`IDALUMNO3`),
  ADD KEY `RESERVACAMARA_FK4` (`IDAULA`);

--
-- Indices de la tabla `RESERVAS`
--
ALTER TABLE `RESERVAS`
  ADD PRIMARY KEY (`IDRESERVA`),
  ADD KEY `RESERVAS_FK` (`IDALUMNO`),
  ADD KEY `RESERVAS_FK2` (`IDAULA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ALUMNOS`
--
ALTER TABLE `ALUMNOS`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `HISTORICOPETICIONES`
--
ALTER TABLE `HISTORICOPETICIONES`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `RESERVAS`
--
ALTER TABLE `RESERVAS`
  MODIFY `IDRESERVA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `RESERVACAMARA`
  MODIFY `IDRESERVA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
