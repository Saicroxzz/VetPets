-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2025 a las 20:57:04
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
-- Base de datos: `vetpet2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_dueno` int(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sede` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `fecha_cita`, `hora_cita`, `motivo`, `estado`, `id_mascota`, `id_dueno`, `id_usuario`, `id_sede`) VALUES
(1, '2025-10-05', '13:48:34', 'asdasdsdaa das dasd as das da', 'Confirmada', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueno`
--

CREATE TABLE `dueno` (
  `id_dueno` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dueno`
--

INSERT INTO `dueno` (`id_dueno`, `nombre`, `apellido`, `telefono`, `correo`, `direccion`, `id_sede`) VALUES
(1, 'asdasdas', 'asdasd', 'asdasd', 'dasdasd', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiamedica`
--

CREATE TABLE `historiamedica` (
  `id_historia` int(11) NOT NULL,
  `diagnostico` text NOT NULL,
  `procedimiento` text NOT NULL,
  `medicamentos` text NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `id_cita` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `id_dueno` int(10) NOT NULL,
  `id_sede` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre`, `especie`, `raza`, `edad`, `sexo`, `id_dueno`, `id_sede`) VALUES
(2, 'sdfsdfsdfsdf', 'sdf', 'adfsdf', 34, 'sdsd', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`, `ciudad`, `telefono`) VALUES
(1, 'Sede Norte', 'Bogotá', '601-1234567'),
(2, 'Sede Centro', 'Medellín', '604-7654321'),
(3, 'Sede Sur', 'Cali', '602-9876543');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `id_sede` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `correo`, `password_hash`, `rol`, `id_sede`) VALUES
(1, 'Wilever', 'wil@vet.com', '$2y$10$D9UcqMkEHxgIrkCPa/eLQ.QW3COeNOkSbGsEhI6vhBONY8GZQFYBe', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_dueno` (`id_dueno`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD PRIMARY KEY (`id_dueno`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `id_dueno` (`id_dueno`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_sede` (`id_sede`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dueno`
--
ALTER TABLE `dueno`
  MODIFY `id_dueno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`),
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`id_dueno`) REFERENCES `dueno` (`id_dueno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD CONSTRAINT `dueno_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  ADD CONSTRAINT `historiamedica_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`),
  ADD CONSTRAINT `historiamedica_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`),
  ADD CONSTRAINT `historiamedica_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `historiamedica_ibfk_4` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`),
  ADD CONSTRAINT `mascota_ibfk_3` FOREIGN KEY (`id_dueno`) REFERENCES `dueno` (`id_dueno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
