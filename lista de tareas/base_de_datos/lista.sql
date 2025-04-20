-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2025 a las 04:09:22
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
-- Base de datos: `lista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listas`
--

CREATE TABLE `listas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listas`
--

INSERT INTO `listas` (`id`, `nombre`, `descripcion`, `usuario`) VALUES
(1, 'cena especial', 'comida con el pana miguel', 'frate'),
(2, 'pana messi', 'sese', 'frate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `Tarea` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Esta_Borrado` tinyint(1) NOT NULL DEFAULT 0,
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  `Fecha_Inicial` datetime DEFAULT NULL,
  `Fecha_Final` datetime DEFAULT NULL,
  `Esta_Finalizado` tinyint(1) NOT NULL DEFAULT 0,
  `Usuario` varchar(255) DEFAULT NULL,
  `id_lista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `Tarea`, `Descripcion`, `Esta_Borrado`, `Fecha_Creacion`, `Fecha_Inicial`, `Fecha_Final`, `Esta_Finalizado`, `Usuario`, `id_lista`) VALUES
(15, 'asdasdasd', 'asdasdhhhhhhhhhhhh', 0, '2025-04-17 17:42:24', '2025-04-17 17:36:54', '2025-04-18 17:36:00', 0, 'frate', NULL),
(16, 'pajearme', 'con la cola del fede', 1, '2025-04-17 18:19:54', '2025-04-17 18:19:14', '2025-04-18 02:03:00', 0, NULL, NULL),
(17, 'coger al fede', 'seseeee', 1, '2025-04-19 17:01:49', '2025-04-19 17:01:22', '2025-04-17 03:32:02', 1, NULL, NULL),
(18, 'ss', 'ss', 1, '2025-04-19 17:03:33', '2025-04-19 05:03:11', '0011-04-02 10:22:02', 0, NULL, NULL),
(19, 'ss', 'ss', 1, '2025-04-19 17:04:06', '2025-04-19 05:03:11', '0011-04-02 10:22:02', 0, NULL, NULL),
(20, 'ss', 'ss', 1, '2025-04-19 17:09:44', '2025-04-19 05:03:11', '0011-04-02 10:22:02', 0, NULL, NULL),
(21, 's', 'ss', 1, '2025-04-19 17:17:43', '2025-04-19 17:17:22', '2025-05-04 03:33:03', 0, NULL, NULL),
(22, 'wwwjjdj', 'sss', 1, '2025-04-19 17:33:35', '2025-04-19 17:33:12', '2025-04-24 08:08:09', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Password`, `Email`) VALUES
('frate', '1234', 'lionelfrate340@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `listas`
--
ALTER TABLE `listas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `id_lista` (`id_lista`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `listas`
--
ALTER TABLE `listas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listas`
--
ALTER TABLE `listas`
  ADD CONSTRAINT `listas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`Usuario`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Usuario`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`id_lista`) REFERENCES `listas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
