-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2025 a las 12:05:11
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
-- Base de datos: `verpets3`
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
  `id_dueno` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `fecha_cita`, `hora_cita`, `motivo`, `estado`, `id_mascota`, `id_dueno`, `id_usuario`, `id_sede`) VALUES
(2, '2025-10-22', '13:00:23', 'Dolor de clavija', 'Confirmada', 5, '1023156012', 3, 3),
(3, '2025-10-22', '13:00:23', 'Dolor de clavija', 'Confirmada', 5, '1023156012', 3, 3),
(4, '2025-10-23', '09:15:00', 'Vacunación anual', 'Pendiente', 6, '1012125213', 3, 3),
(5, '2025-10-24', '10:30:00', 'Control de peso', 'Confirmada', 7, '1232134523', 3, 3),
(6, '2025-10-25', '11:45:00', 'Chequeo post-cirugía', 'Pendiente', 8, '1023562130', 3, 3),
(7, '2025-10-26', '14:20:00', 'Consulta dermatológica', 'Cancelada', 9, '1023652031', 3, 3),
(8, '2025-10-27', '15:10:00', 'Examen dental', 'Confirmada', 10, '1236521436', 3, 3),
(9, '2025-10-28', '08:50:00', 'Revisión general', 'Pendiente', 11, '2153264215', 3, 3),
(10, '2025-10-29', '12:40:00', 'Problemas digestivos', 'Confirmada', 12, '3214658964', 3, 3),
(11, '2025-10-30', '16:05:00', 'Vacunación cachorro', 'Pendiente', 13, '3256142536', 3, 3),
(12, '2025-11-01', '17:30:00', 'Control post-vacuna', 'Confirmada', 14, '4256312549', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueno`
--

CREATE TABLE `dueno` (
  `id_dueno` varchar(10) NOT NULL,
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
('1012125213', 'Juan', 'Diaz', '3213215456', 'juandiaz@gmail.com', 'Calle 2', 1),
('1023156012', 'Diego', 'Hernández', '3194455667', 'diego.hernandez@hotmail.com', 'Transversal 9 #14-55', 3),
('1023562130', 'Laura', 'Vargas', '3147788990', 'laura.vargas@yahoo.com', 'Calle 100 #50-22', 3),
('1023652031', 'Camila', 'Moreno', '3226677889', 'camila.moreno@gmail.com', 'Carrera 15 #33-72', 3),
('1232134523', 'Ramona', 'Castiblanco', '3225641220', 'ramona123cast@gmail.com', 'Carrera 100 #24-32', 3),
('1236521436', 'María', 'Gómez', '3209876543', 'mariagomez@yahoo.com', 'Carrera 7 #89-25', 3),
('2153264215', 'Andrés', 'Rodríguez', '3012345678', 'andres.rodri@hotmail.com', 'Av. Principal #20-50', 3),
('3214658964', 'Jorge', 'Torres', '3185566778', 'jorge.torres@gmail.com', 'Calle 60 #9-40', 3),
('3256142536', 'Paola', 'Ramírez', '3123344556', 'paolaramirez@gmail.com', 'Diagonal 10 #5-22', 3),
('3625142536', 'Lucía', 'Martínez', '3152223344', 'luciamartinez@gmail.com', 'Calle 8 #15-60', 3),
('4256312549', 'Fernando', 'Salazar', '3169988776', 'fernando.sala@gmail.com', 'Carrera 23 #44-18', 3),
('5213652148', 'Carlos', 'Pérez', '3114567890', 'carlosperez@gmail.com', 'Calle 45 #12-18', 3);

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
  `id_dueno` varchar(10) NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `nombre`, `especie`, `raza`, `edad`, `sexo`, `id_dueno`, `id_sede`) VALUES
(2, 'Princesa', 'Perro', 'Doverman', 2, 'Hembra', '2153264215', 3),
(3, 'Princesa', 'Perro', 'Doverman', 2, 'Hembra', '2153264215', 3),
(4, 'Rocky', 'Perro', 'Labrador', 4, 'Macho', '1012125213', 3),
(5, 'Misu', 'Gato', 'Criollo', 3, 'Hembra', '1232134523', 3),
(6, 'Thor', 'Perro', 'Pastor Alemán', 5, 'Macho', '1023156012', 3),
(7, 'Luna', 'Gato', 'Persa', 2, 'Hembra', '1023562130', 3),
(8, 'Max', 'Perro', 'Golden Retriever', 6, 'Macho', '1023652031', 3),
(9, 'Nina', 'Gato', 'Siames', 1, 'Hembra', '1236521436', 3),
(10, 'Boby', 'Perro', 'Beagle', 7, 'Macho', '3214658964', 3),
(11, 'Kira', 'Perro', 'Poodle', 3, 'Hembra', '3256142536', 3),
(12, 'Simba', 'Gato', 'Angora', 4, 'Macho', '3625142536', 3),
(13, 'Canela', 'Perro', 'Bulldog', 5, 'Hembra', '4256312549', 3),
(14, 'Tommy', 'Perro', 'Husky Siberiano', 2, 'Macho', '5213652148', 3);

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
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `correo`, `contrasena`, `rol`, `id_sede`) VALUES
(3, 'Wilever', 'wil@admin.com', '$2y$10$DNy35NnbZm8ocqvibDOcGuTtH./Tx3RjtmjqG06/ECmvzK2HYUZRe', 'Admin', 1),
(4, 'admin1', 'admin1@vetpet.com', '$2y$10$/lKxLHVidWWXYmfsT4MKgeqpsFd.8kbg8udRDxw/Qs4lE6vsUiXBO', 'usuario', 1);

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
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `historiamedica`
--
ALTER TABLE `historiamedica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_dueno`) REFERENCES `dueno` (`id_dueno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD CONSTRAINT `dueno_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

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
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id_dueno`) REFERENCES `dueno` (`id_dueno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
