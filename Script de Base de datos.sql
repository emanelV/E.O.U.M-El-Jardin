-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 09:35:54
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
-- Base de datos: `eljardinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `actividad_id` int(11) NOT NULL,
  `nombre_actividad` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `nombre_actividad`, `estado`) VALUES
(4, 'Maqueta', 0),
(5, 'Evaluacion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL,
  `cod_personal` varchar(100) NOT NULL,
  `nombre_alumno` varchar(100) NOT NULL,
  `apellidos_alumno` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cui` varchar(20) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `u_acceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `cod_personal`, `nombre_alumno`, `apellidos_alumno`, `direccion`, `cui`, `fecha_nac`, `genero`, `fecha_registro`, `estado`, `u_acceso`) VALUES
(4, 'FERXXITO', 'Emanuel Fernando', 'Lopez Vargas', 'Lotificacion prados verdes', '3370554750920', '2001-02-16', '1', '2024-09-25', 1, NULL),
(5, 'P614LBW', 'Jeancarlo Emanuel', 'Cifuentes Velarde', 'Lotificacion prados verdes', '3741485380920', '2016-03-17', '1', '2024-09-30', 1, '2024-10-09 00:44:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aula_id` int(11) NOT NULL,
  `nombre_aula` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aula_id`, `nombre_aula`, `estado`) VALUES
(6, 'A', 1),
(7, 'D', 1),
(8, 'C', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `calificacion_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `contenido_id` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `pm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`contenido_id`, `titulo`, `descripcion`, `material`, `pm_id`) VALUES
(19, 'Capitulos de Proyecto de Graduacion', 'Este es un material de apoyo para realizar sus primeros capitulos de proyecta, pero fast fast ', '../../../uploads/6178/Capítulo 2 y 3.pdf', 26),
(20, 'Prueba 33', 'PPPPPPP', '../../../uploads/5614/', 26),
(21, 'Contenido de sociales ', 'Contenido de sociales ', '../../../uploads/2114/Administracion de TI.docx', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

CREATE TABLE `encargado` (
  `id_encargado` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `nombre_enc` varchar(100) DEFAULT NULL,
  `apellidos_enc` varchar(100) DEFAULT NULL,
  `telefono_enc` varchar(20) DEFAULT NULL,
  `dpi_enc` varchar(20) DEFAULT NULL,
  `clave_enc` varchar(100) NOT NULL,
  `parentesco` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`id_encargado`, `alumno_id`, `nombre_enc`, `apellidos_enc`, `telefono_enc`, `dpi_enc`, `clave_enc`, `parentesco`) VALUES
(1, 4, 'Maynor Geovanny', 'Lopez', '55526353', '3370554750213', '$2y$10$fIhkS0aL0wZM1IDUgjFSDeGDm8so5fbLM1LJdrcF/tao/e1i6ITz6', 'Padre'),
(2, 5, 'Martha Julissa', 'Cifuentes Velarde', '56560213', '3370554750214', '$2y$10$WRy186a1H.EvVsSkAYo6luU1qSfJUfHEtIKmUF2LViCC3R1VP8XES', 'Madre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `env_entregadas`
--

CREATE TABLE `env_entregadas` (
  `ev_entregada_id` int(11) NOT NULL,
  `evaluacion_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `material_alumno` varchar(255) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `env_entregadas`
--

INSERT INTO `env_entregadas` (`ev_entregada_id`, `evaluacion_id`, `alumno_id`, `material_alumno`, `observacion`) VALUES
(1, 2, 5, 'material', 'observacion evlauada'),
(2, 3, 5, '../../../uploads/6617/Entrevista sobre redes de Enfermería.pdf', 'esta es una prueba de entrega de actividad para el sistema de la escuela oficial urbana mixta'),
(3, 4, 5, '../../../uploads/7327/etica hoy.pdf', 'he realizado la entrega del contenido de sociales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `evaluacion_id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `porcentaje` varchar(100) DEFAULT NULL,
  `contenido_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`evaluacion_id`, `titulo`, `descripcion`, `fecha`, `porcentaje`, `contenido_id`) VALUES
(2, 'Medios de Comunicacion', 'ahhhhhh valimos', '2024-10-16', '32', 19),
(3, 'Maqueta de algun medio de comunicacion', 'Realizar una maqueta de preferencia con materiales reciclado de cualquier medio de comunicacion Ej. Radio, Television y Telefono', '2024-10-11', '10', 19),
(4, 'Tarea de Sociales', 'Tarea de Sociales', '2024-10-10', '10', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `grado_id` int(11) NOT NULL,
  `nombre_grado` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`grado_id`, `nombre_grado`, `estado`) VALUES
(9, 'Tercero', 1),
(15, 'Primero', 1),
(16, 'Quinto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `nombre_materia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `nombre_materia`, `estado`) VALUES
(18, 'Ciencias Sociales', 1),
(19, 'Comunicacion y Lenguaje', 1),
(20, 'Dibujo Tecnico', 1),
(21, 'Ciencias Naturales', 1),
(22, 'Ingles Basico 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `nota_id` int(11) NOT NULL,
  `ev_entregada_id` int(11) NOT NULL,
  `valor_nota` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`nota_id`, `ev_entregada_id`, `valor_nota`, `fecha`) VALUES
(18, 1, 22, '2024-10-06 23:37:58'),
(19, 2, 9, '2024-10-08 21:28:46'),
(20, 3, 9, '2024-10-09 00:17:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `periodo_id` int(11) NOT NULL,
  `nombre_periodo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`periodo_id`, `nombre_periodo`, `estado`) VALUES
(4, 'SEGUNDO', 0),
(5, '2024-2025', 1),
(6, '2025-2026', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesoalumno`
--

CREATE TABLE `procesoalumno` (
  `ap_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `pm_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `estadop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesoalumno`
--

INSERT INTO `procesoalumno` (`ap_id`, `alumno_id`, `pm_id`, `periodo_id`, `estadop`) VALUES
(7, 4, 24, 5, 1),
(8, 5, 26, 5, 1),
(9, 5, 27, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesoprofesor`
--

CREATE TABLE `procesoprofesor` (
  `pm_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `estadopm` int(11) NOT NULL DEFAULT 1,
  `materia_id` int(11) DEFAULT NULL,
  `proceso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesoprofesor`
--

INSERT INTO `procesoprofesor` (`pm_id`, `grado_id`, `aula_id`, `profesor_id`, `estadopm`, `materia_id`, `proceso_id`) VALUES
(24, 16, 8, 6, 1, 22, 5),
(25, 15, 6, 5, 1, 20, 5),
(26, 16, 7, 4, 1, 19, 5),
(27, 16, 7, 4, 1, 18, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `profesor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `dpi` varchar(20) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`profesor_id`, `nombre`, `apellidos`, `direccion`, `dpi`, `clave`, `telefono`, `correo`, `estado`) VALUES
(1, 'Fernando Lopez', 'Perez Yac', 'Barrio las casas zona 4', '3370554750310', '$2y$10$4wnoum.pUfwnQwnD4fWGUOhuCC5GHGSZDRsm.ZMVELr/p5tHHZpZG', 55526378, 'gusgperez@gmail.com', 0),
(4, 'Jose Eduardo', 'Gonzales', 'Las conchitas ', '3370554750920', '$2y$10$5U8gqbhjKmOMhWJd6jrxr.RNve2XNJ1bNRl1vxR/8jZDwJdmwwZzm', 55526353, 'Jeduyac20@gmail.com', 1),
(5, 'Angela', 'Fernanda Menendez', 'EL quetzal, San Marcos', '337098562217', '$2y$10$7id7Lo.A88IEjc5uf3qmyulW.pQ6k21zHgsuakXV0vhvMN3oMxRfa', 32544178, 'Angelu@gmail.com', 1),
(6, 'Gustavo Jaime', 'Gonzales', 'Barrio las casas zona 4', '3370554751236', '$2y$10$xnEK0d1I/42k3UpGMEoXEOzjQz/ly1szEL.bdWXeYuk.eGmCitqq6', 32544178, 'gusgperez@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_ROL` int(11) NOT NULL,
  `NOMBREROL` varchar(100) NOT NULL,
  `ACTIVO` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_ROL`, `NOMBREROL`, `ACTIVO`) VALUES
(1, 'Administrador', b'1'),
(2, 'Maestro', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE_USUARIO` varchar(100) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `ID_ROL` int(11) NOT NULL,
  `LOGINUSUARIO` varchar(100) NOT NULL,
  `CONTRASENA` varchar(255) NOT NULL,
  `ACTIVO` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE_USUARIO`, `APELLIDOS`, `ID_ROL`, `LOGINUSUARIO`, `CONTRASENA`, `ACTIVO`) VALUES
(1, 'Emanuel Fernando', 'Lopez Vargas ', 1, 'Admin', '$2y$10$wESFnvRNOoWx8ywbTHBT6.hnG50mI5qA2BD.kDEbXnQDGwhIMqERS', 1),
(4, 'Armando Esteban', 'Quito Hernandez', 1, 'ArmandoBanquitoo', '$2y$10$LachecsrKJGRmq9A5Briz.GZBLHttmYTKYfJ0wk5fH619omp/XYna', 1),
(5, 'Rene', 'Fuentes Gongora', 1, 'FFuentesM', '$2y$10$i8tA680mdR7ChI.akRabsuQ7aVy8PBK6oimjpbtOSG4rTjTq6xWbC', 1),
(6, 'Daniel Fernando', 'Lopez Velasquez', 1, 'DfVelas200', '$2y$10$ZJhFk6t5C8BaTPVAkcOYlevH/QGPk3U86IgXBvP9fUNqF4b67Kk6S', 0),
(7, 'Juanito', 'Escobar', 1, 'Jescob', '$2y$10$.YSAQ2ZIdODQIrCsgL/Qd.HEdamjP2sbEN02JDQnftrwooPed/0ja', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`actividad_id`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`calificacion_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`contenido_id`),
  ADD KEY `pm_id` (`pm_id`);

--
-- Indices de la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD PRIMARY KEY (`id_encargado`),
  ADD KEY `alumno_id` (`alumno_id`);

--
-- Indices de la tabla `env_entregadas`
--
ALTER TABLE `env_entregadas`
  ADD PRIMARY KEY (`ev_entregada_id`),
  ADD KEY `evaluacion_id` (`evaluacion_id`),
  ADD KEY `alumno_id` (`alumno_id`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`evaluacion_id`),
  ADD KEY `contenido_id` (`contenido_id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`grado_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `ev_entrega_id` (`ev_entregada_id`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`periodo_id`);

--
-- Indices de la tabla `procesoalumno`
--
ALTER TABLE `procesoalumno`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `proceso_id` (`pm_id`),
  ADD KEY `pm_id` (`pm_id`),
  ADD KEY `periodo_id` (`periodo_id`);

--
-- Indices de la tabla `procesoprofesor`
--
ALTER TABLE `procesoprofesor`
  ADD PRIMARY KEY (`pm_id`),
  ADD KEY `grado_id` (`grado_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `profesor_id` (`profesor_id`),
  ADD KEY `fk_procesoprofesor_materia` (`materia_id`),
  ADD KEY `fk_procesoprofesor_proceso` (`proceso_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `rol` (`ID_ROL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `calificacion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  MODIFY `contenido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `encargado`
--
ALTER TABLE `encargado`
  MODIFY `id_encargado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `env_entregadas`
--
ALTER TABLE `env_entregadas`
  MODIFY `ev_entregada_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `evaluacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `grado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `periodo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `procesoalumno`
--
ALTER TABLE `procesoalumno`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `procesoprofesor`
--
ALTER TABLE `procesoprofesor`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_ROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD CONSTRAINT `contenidos_ibfk_1` FOREIGN KEY (`pm_id`) REFERENCES `procesoprofesor` (`pm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `encargado`
--
ALTER TABLE `encargado`
  ADD CONSTRAINT `encargado_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`);

--
-- Filtros para la tabla `env_entregadas`
--
ALTER TABLE `env_entregadas`
  ADD CONSTRAINT `env_entregadas_ibfk_1` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluaciones` (`evaluacion_id`),
  ADD CONSTRAINT `env_entregadas_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`);

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_3` FOREIGN KEY (`contenido_id`) REFERENCES `contenidos` (`contenido_id`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`ev_entregada_id`) REFERENCES `env_entregadas` (`ev_entregada_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `procesoalumno`
--
ALTER TABLE `procesoalumno`
  ADD CONSTRAINT `procesoalumno_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoalumno_ibfk_2` FOREIGN KEY (`pm_id`) REFERENCES `procesoprofesor` (`pm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoalumno_ibfk_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodos` (`periodo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `procesoprofesor`
--
ALTER TABLE `procesoprofesor`
  ADD CONSTRAINT `fk_procesoprofesor_materia` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`),
  ADD CONSTRAINT `fk_procesoprofesor_proceso` FOREIGN KEY (`proceso_id`) REFERENCES `periodos` (`periodo_id`),
  ADD CONSTRAINT `procesoprofesor_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoprofesor_ibfk_2` FOREIGN KEY (`grado_id`) REFERENCES `grados` (`grado_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `procesoprofesor_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`profesor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_ROL`) REFERENCES `rol` (`ID_ROL`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
