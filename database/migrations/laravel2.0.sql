-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2025 a las 06:28:50
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
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `miniatura` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `miniatura`, `created_at`, `updated_at`) VALUES
(1, 'Java', 'A llorar se dijo', 'miniaturas/sRoVXNRwbMhgSTZvaYFAitWJ8ynRyN3BdrKUVqBp.jpg', '2025-07-19 22:40:19', '2025-07-19 22:40:38'),
(2, 'Prueba', 'djisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsddjisadjisijisjfjdsijfjsfsjfjsjfsd', 'miniaturas/WNuiEY1zEadbRRTxADLbmKQO2vYaQcDv5wcaPSZN.png', '2025-07-25 22:57:11', '2025-07-27 18:51:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_user`
--

CREATE TABLE `curso_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `curso_user`
--

INSERT INTO `curso_user` (`id`, `curso_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, NULL, NULL),
(6, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcions`
--

CREATE TABLE `inscripcions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscripcions`
--

INSERT INTO `inscripcions` (`id`, `user_id`, `curso_id`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2025-07-27 18:47:48', '2025-07-27 18:47:48'),
(7, 1, 2, '2025-07-27 18:50:02', '2025-07-27 18:50:02'),
(9, 1, 1, '2025-07-27 21:06:53', '2025-07-27 21:06:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_07_19_164540_create_users_table', 1),
(2, '2025_07_19_172932_create_cursos_table', 1),
(3, '2025_07_24_165234_create_curso_user_table', 1),
(4, '2025_07_25_162034_create_cache_table', 1),
(5, '2025_07_27_022432_create_inscripcions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Juan Camilo', 'juancamilou07@gmail.com', '$2y$12$9.Bv7al7jXJ3ivdJ4e9fROAcK3rtsVQYgy/0FMJqaTlY0jnLTyLzS', 'student', '2025-07-19 22:24:55', '2025-07-19 22:24:55'),
(2, 'Juan David Marin', 'juan@gmail.com', '$2y$12$VGLukrcH8Gh59JRx3swSEuTAigEB5hj72hHaXSSld38r88fSONVOe', 'student', '2025-07-19 22:28:16', '2025-07-19 22:28:16'),
(3, 'admin', 'juancamilou07@outlook.com', '$2y$12$1L2FSdC/y6um43WNDT/8IuydP9QJHUTE7lUijvR/mi6mC58y/79o.', 'admin', '2025-07-25 20:25:18', '2025-07-25 20:25:18'),
(4, 'ns', 'ejemplo@ejemplo.com', '$2y$12$FtOp5UpnIMjiEDgq098lQuBi0c7QSP5BrAAS7cJW9u5qE8XifPr7y', 'student', '2025-07-27 19:15:37', '2025-07-27 19:15:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curso_user`
--
ALTER TABLE `curso_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curso_user_curso_id_user_id_unique` (`curso_id`,`user_id`),
  ADD KEY `curso_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inscripcions_user_id_foreign` (`user_id`),
  ADD KEY `inscripcions_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `curso_user`
--
ALTER TABLE `curso_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso_user`
--
ALTER TABLE `curso_user`
  ADD CONSTRAINT `curso_user_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  ADD CONSTRAINT `inscripcions_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripcions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
