-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2024 a las 16:19:07
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
-- Base de datos: `unityclass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre_actividad` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fk_materia` int(11) DEFAULT NULL,
  `fecha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `FK_nombre_materia` int(11) DEFAULT NULL,
  `parcial1` decimal(5,2) DEFAULT NULL,
  `parcial2` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id` int(11) NOT NULL,
  `nombre_donacion` varchar(100) DEFAULT NULL,
  `fecha_donacion` date NOT NULL,
  `FK_tipo_Usuario` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre_materia` varchar(100) DEFAULT NULL,
  `objetivos` text DEFAULT NULL,
  `actividades` text DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre_materia`, `objetivos`, `actividades`, `unidad`) VALUES
(1, 'análisis de datos', 'ayudar al estudiante a como se analizan los datos.', NULL, NULL),
(2, 'Estructura de datos', 'ejemplo ballinas ', NULL, NULL),
(3, 'Matemáticas', 'Ayudar a comprender como las matemáticas no son solo números.', NULL, NULL),
(6, 'progra', 'para progeramar', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `FK_materia` int(11) DEFAULT NULL,
  `FK_tipo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(10) NOT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  `fecha_nac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `genero`, `edad`, `tipo_usuario`, `fecha_nac`) VALUES
(1, 'Jazmin', 'jazmin@ucol.mx', '123456', 'Femenino', 19, 'Administrator', '2005-02-23'),
(6, 'Luis', 'luis19@gmail.com', '1234567', 'Masculino', 19, 'Student', '2005-05-12'),
(9, 'Yoongi', 'yoon28@gmail.com', 'yoongi', 'Masculino', 29, 'Student', '1995-03-09'),
(10, 'jin', 'jin12@gmail.com', 'jin28', 'Masculino', 20, 'Student', '2014-09-12'),
(11, 'joaquin', 'joa@gmail.com', '12345678', 'Masculino', 25, 'Teacher', '1991-10-23'),
(12, 'Ariel', 'ariel@gmail.com', '1234567', 'Masculino', 19, 'Cordinator', '2005-05-02'),
(14, 'sofia', 'sofi@gmail.com', '1234567', 'Masculino', 19, 'Student', '2005-05-23'),
(17, 'diego', 'die@gmail.com', '1234567', 'Masculino', 18, 'Student', '2005-07-12'),
(18, 'Ramon', 'ramon@gmail.com', 'ramon123', 'Masculino', 18, 'Student', '2006-06-11'),
(19, 'Felipe', 'feli@gamil.com', 'feliz123', 'Masculino', 20, 'Student', '2004-07-02'),
(20, 'Abi', 'abi@gmail.com', 'abi1234', 'Masculino', 20, 'Student', '2004-07-07'),
(21, 'a', 'jazmin@ucol.mx', 'Masculino', NULL, 18, '123456789', '0000-00-00'),
(22, 'maria', 'maria@gmail.com', 'Femenino', NULL, 17, '12345678', '0000-00-00'),
(23, 'adriel', 'adriel@gmail.com', '123456', 'Femenino', 20, 'Student', '2004-11-12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_actividades_materia` (`fk_materia`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_calificaciones_materia` (`FK_nombre_materia`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_donaciones_usuario` (`FK_tipo_Usuario`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_programas_materia` (`FK_materia`),
  ADD KEY `FK_programas_usuario` (`FK_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `FK_actividades_materia` FOREIGN KEY (`fk_materia`) REFERENCES `materias` (`id`);

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `FK_calificaciones_materia` FOREIGN KEY (`FK_nombre_materia`) REFERENCES `materias` (`id`);

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `FK_donaciones_usuario` FOREIGN KEY (`FK_tipo_Usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `FK_programas_materia` FOREIGN KEY (`FK_materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `FK_programas_usuario` FOREIGN KEY (`FK_tipo_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
