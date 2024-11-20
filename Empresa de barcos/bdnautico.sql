-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 05:29:33
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
-- Base de datos: `bdnautico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barco`
--

CREATE TABLE `barco` (
  `matricula` varchar(20) NOT NULL,
  `cedsocio` varchar(20) DEFAULT NULL,
  `nombre_barco` varchar(100) DEFAULT NULL,
  `num_amarre` int(11) DEFAULT NULL,
  `cuota` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `barco`
--

INSERT INTO `barco` (`matricula`, `cedsocio`, `nombre_barco`, `num_amarre`, `cuota`) VALUES
('B01', '123456', 'La Maravilla', 1, 150.00),
('B02', '789012', 'El Viajero', 2, 200.00),
('B03', '345678', 'Oceánico', 3, 250.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor_patron`
--

CREATE TABLE `conductor_patron` (
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `conductor_patron`
--

INSERT INTO `conductor_patron` (`codigo`, `nombre`, `telefono`, `direccion`) VALUES
('1', 'Luis Martínez', '555-3333', 'Calle Falsa 123'),
('2', 'María Torres', '555-4444', 'Avenida Siempreviva 742'),
('3', 'Pedro Sánchez', '555-5555', 'Boulevard Central 567'),
('5', 'Fernando', '2334-2332', 'Panama Costa del este');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `cedula` varchar(20) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`cedula`, `nombre_completo`, `telefono`, `correo`) VALUES
('123456', 'Juan Pérez', '555-1234', 'juan.perez@example.com'),
('345678', 'Carlos Ruiz', '555-9012', 'carlos.ruiz@example.com'),
('789012', 'Ana Gómez', '555-5678', 'ana.gomez@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `numero` int(11) NOT NULL,
  `matribarco` varchar(255) DEFAULT NULL,
  `codpatron` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `destino` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`numero`, `matribarco`, `codpatron`, `fecha`, `hora`, `destino`) VALUES
(1, 'B01', '1', '2024-11-20', '10:00:00', 'Isla del Sol'),
(2, 'B02', '2', '2024-11-21', '11:00:00', 'Bahía Azul'),
(3, 'B03', '3', '2024-11-22', '12:00:00', 'Cabo Dorado'),
(4, 'B02', '2', '2024-11-13', '14:30:00', 'Darien');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barco`
--
ALTER TABLE `barco`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `cedsocio` (`cedsocio`);

--
-- Indices de la tabla `conductor_patron`
--
ALTER TABLE `conductor_patron`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `matribarco` (`matribarco`),
  ADD KEY `codpatron` (`codpatron`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barco`
--
ALTER TABLE `barco`
  ADD CONSTRAINT `barco_ibfk_1` FOREIGN KEY (`cedsocio`) REFERENCES `socio` (`cedula`);

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`codpatron`) REFERENCES `conductor_patron` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
