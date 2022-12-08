-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2022 a las 11:34:17
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `developers_mysql`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currentstatus`
--

CREATE TABLE `currentstatus` (
  `id_status` int(6) NOT NULL COMMENT 'id clave primaria',

  `description` varchar(15) COLLATE utf8_spanish_ci NOT NULL COMMENT 'pending, inProgress, done...',

  `progress` smallint(2) NOT NULL COMMENT 'mostrar ''50%''',
  `active` tinyint(1) NOT NULL COMMENT 'si lo usamos o aun no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (

  `id_task` int(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `masterUsr_id` int(6) NOT NULL,
  `slaveUsr_id` int(6) NOT NULL,
  `initiated` datetime NOT NULL,
  `done` datetime NOT NULL,
  `currentStatus_id` int(6) NOT NULL,
  `deleted` tinyint(1) NOT NULL,

  `description` text COLLATE utf8_spanish_ci NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tasks`
--


INSERT INTO `tasks` (`id_task`, `created_at`, `masterUsr_id`, `slaveUsr_id`, `initiated`, `done`, `currentStatus_id`, `deleted`, `description`) VALUES

(1, '2022-11-01 00:35:00', 1, 2, '2022-11-01 01:40:00', '2022-11-01 01:50:00', 0, 0, 'Estudiar Tailwind'),
(2, '2022-11-01 00:36:00', 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'Estudiar Laravel'),
(3, '2022-11-01 00:37:00', 1, 4, '2022-11-01 01:39:00', '0000-00-00 00:00:00', 0, 0, 'Estudiar MongoDB'),
(10, '2022-11-01 20:48:32', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'd1'),
(11, '2022-11-01 20:49:33', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'd2'),
(12, '2022-11-01 20:49:55', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'd2'),
(13, '2022-11-01 20:50:37', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'description 2'),
(14, '2022-11-02 00:45:42', 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'desc 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(6) NOT NULL,
  `name` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `rol`) VALUES
(1, 'Ruben', 'boss'),
(2, 'Marta', 'manager'),
(3, 'Raquel', 'office'),
(4, 'Carlos', 'office');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `currentstatus`
--
ALTER TABLE `currentstatus`
  ADD PRIMARY KEY (`id_status`);

--

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `masterUsr_id` (`masterUsr_id`),
  ADD KEY `slaveUsr_id` (`slaveUsr_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `currentstatus`
--
ALTER TABLE `currentstatus`
  MODIFY `id_status` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id clave primaria';

--
-- AUTO_INCREMENT de la tabla `subtasks`
--

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
