-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2021 a las 22:27:35
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreriadoofinder`
--
CREATE DATABASE IF NOT EXISTS `libreriadoofinder` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `libreriadoofinder`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `pseudonimo` varchar(200) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_muerte` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id`, `nombre`, `pseudonimo`, `fecha_nacimiento`, `fecha_muerte`) VALUES
(1, 'Antonio Machado', 'Antonio M.', '1875-07-26', '1939-02-22'),
(2, 'Miguel de Cervantes', '', '1547-09-29', '1616-04-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Poemarios', ''),
(2, 'Sátira', ''),
(3, 'Parodia', ''),
(4, 'Farsa', 'Es una forma dramática en la que los personajes se desenvuelven de manera caricaturesca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `isbn` varchar(200) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `descripcion`, `isbn`, `autor`) VALUES
(1, 'Soledades, Galerías y otros poemas', 'En Soledades, galerías y otros poemas encontramos al Machado «misterioso y silencioso». Un Machado que elabora un modernismo íntimo que permitirá que sus poemas resistan bien la prueba del tiempo', '1571742883', 1),
(2, 'Don Quijote de la Mancha', 'Don Quijote de la Mancha​ es una novela escrita por el español Miguel de Cervantes Saavedra. Publicada su primera parte con el título de El ingenioso hidalgo don Quijote de la Mancha a comienzos de 1605, es la obra más destacada de la literatura española ', '1571742994', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_categoria_libro`
--

CREATE TABLE `relacion_categoria_libro` (
  `id_libro` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `relacion_categoria_libro`
--

INSERT INTO `relacion_categoria_libro` (`id_libro`, `id_categoria`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
