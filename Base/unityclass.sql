-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 05:19:13
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
  `fecha` varchar(10) NOT NULL,
  `fk_teacher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre_actividad`, `descripcion`, `fk_materia`, `fecha`, `fk_teacher`) VALUES
(1, 'Historia del Arte', 'Esta actividad te ayudara a descubrir y conocer el Arte', 19, '2024-11-07', 26);

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
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `user_id`, `programa_id`) VALUES
(20, 26, 3),
(21, 26, 4),
(22, 26, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_materias`
--

CREATE TABLE `inscripciones_materias` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `fecha_inscripcion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones_materias`
--

INSERT INTO `inscripciones_materias` (`id`, `user_id`, `materia_id`, `fecha_inscripcion`) VALUES
(1, 27, 2, '2024-11-09 20:12:55'),
(2, 27, 20, '2024-11-09 20:30:27'),
(3, 27, 18, '2024-11-09 20:33:30'),
(4, 27, 3, '2024-11-10 04:10:36'),
(5, 27, 19, '2024-11-10 04:10:43'),
(6, 27, 1, '2024-11-14 16:55:41'),
(7, 27, 17, '2024-11-14 16:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre_materia` varchar(100) DEFAULT NULL,
  `objetivos` text DEFAULT NULL,
  `actividades` text DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre_materia`, `objetivos`, `actividades`, `unidad`, `fecha_registro`) VALUES
(3, 'Matemáticas', 'Ayudar a comprender como las matemáticas no son solo números.', NULL, NULL, '2024-11-17 17:31:47'),
(8, 'Ingles', 'Ayuda a los alumnos a mejorar y entender el nivel de ingles.', NULL, NULL, '2024-11-17 17:31:47'),
(16, 'Formación cívica', 'Esta materia ayudara a reconocer los valores', NULL, NULL, '2024-11-17 17:31:47'),
(17, 'Ciencias Naturales', 'Nos ayudara conocer el mundo en que vivimos, a comprender nuestro entorno y las aportaciones de los avances científicocos a nuestra vida diaria.', NULL, NULL, '2024-11-17 17:31:47'),
(18, 'Robotics and Technology', 'This subject focuses on introducing students to the world of robotics and emerging technologies.', NULL, NULL, '2024-11-17 17:31:47'),
(19, 'Visual Arts (drawing, painting)', 'Students will learn about color theory, composition, shapes, shadows, and perspective, and how to apply them across different media.', NULL, NULL, '2024-11-17 17:31:47'),
(20, 'Languages ​​and Intercultural Communication', 'To teach basic skills in one or more languages, along with cultural understanding that enriches communication.', NULL, NULL, '2024-11-17 17:31:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `FK_materia` int(11) DEFAULT NULL,
  `FK_tipo_usuario` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre`, `descripcion`, `FK_materia`, `FK_tipo_usuario`, `fecha_registro`) VALUES
(3, 'Basic Matematics', 'Programas que cubren conceptos como suma, resta, multiplicación y división.', 3, 11, '2024-11-17 15:21:42'),
(5, 'Science and Technology Program', 'This program seeks to foster interest in science and technology through hands-on classes and experimentation.', 18, 26, '2024-11-17 15:21:42'),
(7, 'Cultural and Linguistic Exploration', 'To expand students\' knowledge of different cultures and languages.', 20, 11, '2024-11-17 15:21:42');

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
  `fecha_nac` date NOT NULL,
  `session_activa` tinyint(1) DEFAULT 0,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `genero`, `edad`, `tipo_usuario`, `fecha_nac`, `session_activa`, `fecha_registro`) VALUES
(1, 'Jazmin', 'jazmin@ucol.mx', '123456', 'Femenino', 19, 'Administrator', '2005-02-23', 0, '2024-11-07 11:42:32'),
(6, 'Luis123', 'luis19@gmail.com', '1234567', 'Masculino', 19, 'Donor', '2005-05-12', 0, '2024-11-07 11:42:32'),
(9, 'Yoongi', 'yoon28@gmail.com', 'yoongi', 'Masculino', 29, 'Student', '1995-03-09', 0, '2024-11-07 11:42:32'),
(10, 'Jinn', 'jin12@gmail.com', 'jin28', 'Masculino', 10, 'Student', '2014-09-12', 0, '2024-11-07 11:42:32'),
(11, 'Joaquin', 'joa@gmail.com', '12345678', 'Masculino', 33, 'Teacher', '1991-10-23', 0, '2024-11-07 11:42:32'),
(14, 'Sofia', 'sofi@gmail.com', '1234567', 'Masculino', 19, 'Student', '2005-05-23', 0, '2024-11-07 11:42:32'),
(17, 'Diego', 'die@gmail.com', '1234567', 'Masculino', 19, 'Donor', '2005-07-12', 0, '2024-11-07 11:42:32'),
(18, 'Ramon', 'ramon@gmail.com', 'ramon123', 'Masculino', 18, 'Student', '2006-06-11', 0, '2024-11-07 11:42:32'),
(19, 'Felipe', 'feli@gamil.com', 'feliz123', 'Masculino', 20, 'Student', '2004-07-02', 0, '2024-11-07 11:42:32'),
(23, 'adriel', 'adriel@gmail.com', '123456', 'Masculino', 19, 'Student', '2004-11-12', 0, '2024-11-07 11:42:32'),
(24, 'Ernesto ', 'ernesto@gmail.com', '1234567', 'Masculino', 25, 'Teacher', '1999-11-12', 0, '2024-11-07 11:42:32'),
(25, 'Alan', 'alan@ucol.mx', '123456', 'Masculino', 20, 'Cordinator', '2004-07-12', 0, '2024-11-07 11:42:32'),
(26, 'Laura', 'lau@gmail.com', '1234567', 'Masculino', 20, 'Teacher', '2004-07-21', 0, '2024-11-07 11:42:32'),
(27, 'Ariel', 'ari@gmail.com', '12345678', 'Masculino', 19, 'Student', '2005-05-02', 0, '2024-11-08 07:52:52');

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
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `programa_id` (`programa_id`);

--
-- Indices de la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`materia_id`),
  ADD KEY `materia_id` (`materia_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  ADD CONSTRAINT `inscripciones_materias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripciones_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`id`);

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
