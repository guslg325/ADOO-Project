-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2021 a las 00:19:55
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `squid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(70) NOT NULL,
  `calle` varchar(70) NOT NULL,
  `CP` varchar(6) NOT NULL,
  `encargado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `rol_sistema` smallint(6) NOT NULL,
  `correo_cliente` varchar(50) NOT NULL,
  `contrasena_cliente` varchar(50) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `direccion_cliente` varchar(200) NOT NULL,
  `numero_cliente` int(20) NOT NULL,
  `municipio_cliente` varchar(30) NOT NULL,
  `cp_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `nombreO` varchar(40) NOT NULL,
  `calleO` varchar(30) NOT NULL,
  `municipioO` varchar(30) NOT NULL,
  `estadoO` varchar(30) NOT NULL,
  `cpO` varchar(5) NOT NULL,
  `correoO` varchar(25) NOT NULL,
  `telefonoO` varchar(15) NOT NULL,
  `nombreD` varchar(40) NOT NULL,
  `calleD` varchar(30) NOT NULL,
  `municipioD` varchar(30) NOT NULL,
  `estadoD` varchar(30) NOT NULL,
  `cpD` varchar(5) NOT NULL,
  `correoD` varchar(25) NOT NULL,
  `telefonoD` varchar(15) NOT NULL,
  `centroO` varchar(40) NOT NULL,
  `centroD` varchar(40) NOT NULL,
  `tipoPaquete` varchar(5) NOT NULL,
  `guia` int(12) NOT NULL,
  `usuarioAsociado` int(11) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `CP` varchar(6) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Latitud` double NOT NULL,
  `Longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centros`
--
ALTER TABLE `centros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`guia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centros`
--
ALTER TABLE `centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `guia` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
