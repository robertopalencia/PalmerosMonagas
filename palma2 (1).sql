-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2018 a las 05:32:48
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `palma2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `id` int(10) UNSIGNED NOT NULL,
  `cuenta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banco` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipocuenta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`id`, `cuenta`, `banco`, `tipo`, `tipocuenta`, `productor_id`, `created_at`, `updated_at`) VALUES
(1, '01020304050607080910', 'Mercantil', 'Juridico', 'Corriente', 1, '2018-03-28 21:58:05', '2018-03-28 21:58:05'),
(2, '01020304050607080911', 'venezuela', 'Personal', 'Ahorro', 1, '2018-03-29 02:24:35', '2018-03-29 02:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `camion`
--

INSERT INTO `camion` (`id`, `nombre`, `cedula`, `placa`, `modelo`, `marca`, `color`, `ano`, `peso`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Roberto Palencia', 'V20648368', '123456', '70', 'chevrolet', 'rojo', 70, '1.55', '04249064351', '2018-03-28 21:56:02', '2018-03-28 22:38:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargagandola`
--

CREATE TABLE `cargagandola` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peso_neto` decimal(10,2) NOT NULL,
  `peso_mermado` decimal(10,2) NOT NULL,
  `peso_real` decimal(10,2) NOT NULL,
  `finale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_gandola` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargagandola`
--

INSERT INTO `cargagandola` (`id`, `created_at`, `updated_at`, `peso_neto`, `peso_mermado`, `peso_real`, `finale`, `id_gandola`) VALUES
(1, '2018-03-28 21:58:34', '2018-03-28 22:47:26', '2.97', '5.20', '5.56', 'si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE `control` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cargagandola` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id`, `created_at`, `updated_at`, `ubicacion`, `id_cargagandola`) VALUES
(1, '2018-03-28 21:58:34', '2018-03-28 22:43:41', 'Zulia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupos`
--

CREATE TABLE `cupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `peso` int(11) NOT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cupos`
--

INSERT INTO `cupos` (`id`, `fecha`, `peso`, `productor_id`, `created_at`, `updated_at`) VALUES
(1, '2018-03-29', 5000, 1, '2018-03-29 03:31:20', '2018-03-29 03:31:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gandola`
--

CREATE TABLE `gandola` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placaremolque` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` int(11) NOT NULL,
  `chofer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gandola`
--

INSERT INTO `gandola` (`id`, `created_at`, `updated_at`, `placa`, `placaremolque`, `modelo`, `marca`, `color`, `ano`, `chofer`, `cedula`, `peso`, `telefono`) VALUES
(1, '2018-03-28 21:56:53', '2018-03-28 21:56:53', '123457', '123458', '200', 'mack', 'rojo', 2000, 'Betty Osorio', 'V4859195', '30.00', '04140964830');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(180, '2014_10_12_000000_create_users_table', 1),
(181, '2014_10_12_100000_create_password_resets_table', 1),
(182, '2018_01_16_202113_create_productor_table', 1),
(183, '2018_01_16_202132_create_camion_table', 1),
(184, '2018_01_16_202202_create_precio_table', 1),
(185, '2018_01_21_094607_create_banco_table', 1),
(186, '2018_01_21_094621_create_cupos_table', 1),
(187, '2018_02_13_154012_create_gandola_table', 1),
(188, '2018_02_13_154410_create_cargagandola_table', 1),
(189, '2018_02_13_154630_create_control_table', 1),
(190, '2018_02_16_202219_create_pesaje_table', 1),
(191, '2018_03_17_123021_create_roles_table', 1),
(192, '2018_03_17_123230_create_role_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pesaje`
--

CREATE TABLE `pesaje` (
  `id` int(10) UNSIGNED NOT NULL,
  `carga` decimal(10,2) NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pago` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(11) NOT NULL,
  `camion_id` int(10) UNSIGNED DEFAULT NULL,
  `productor_id` int(10) UNSIGNED NOT NULL,
  `precio_id` int(10) UNSIGNED NOT NULL,
  `cargagandola_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pesaje`
--

INSERT INTO `pesaje` (`id`, `carga`, `descripcion`, `pago`, `peso`, `descuento`, `fecha`, `precio`, `camion_id`, `productor_id`, `precio_id`, `cargagandola_id`, `created_at`, `updated_at`) VALUES
(1, '2.52', 'palma', 'SI', '1.53', '0.15', '2018-03-28', 0, 1, 1, 1, 1, '2018-03-28 21:58:34', '2018-03-29 01:25:48'),
(2, '2.52', 'palma', 'NO', '1.53', '0.00', '2018-03-28', 1, 1, 1, 1, 1, '2018-03-28 22:32:14', '2018-03-28 22:32:14'),
(3, '2.52', 'palma', 'NO', '1.55', '0.00', '2018-03-28', 0, 1, 1, 1, 1, '2018-03-28 22:38:14', '2018-03-28 22:38:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `id` int(10) UNSIGNED NOT NULL,
  `preciocontado` decimal(10,2) NOT NULL,
  `preciocredito` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`id`, `preciocontado`, `preciocredito`, `created_at`, `updated_at`) VALUES
(1, '5000.00', '10000.00', '2018-03-28 21:57:12', '2018-03-28 21:57:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productor`
--

CREATE TABLE `productor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finca` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productor`
--

INSERT INTO `productor` (`id`, `nombre`, `cedula`, `rif`, `finca`, `direccion`, `correo`, `telefono`, `cod`, `created_at`, `updated_at`) VALUES
(1, 'Roberto Palencia', 'V20648368', 'J206483683', 'Agropecuaria Palencia RL', 'Cachipo, Calle principal', 'robertojosepalencia@gmail.com', '04249064351', 'PC001', '2018-03-28 21:58:05', '2018-03-28 21:58:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2018-03-28 21:45:08', '2018-03-28 21:45:08'),
(2, 'user', 'User', '2018-03-28 21:45:08', '2018-03-28 21:45:08'),
(3, 'watcher', 'Observador', '2018-03-28 21:45:08', '2018-03-28 21:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-03-28 21:45:08', '2018-03-28 21:45:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'OscarPalencia', '', 'monagaslibre@gmail.com', '$2y$10$cJAD2fzbBTT9o0r7oHew5Opg4gBhiY0TPOK1oBh6jYrIx79nS8z3W', 'U1GbXg4qXCdp9T5saemIt8MKJ9AsHHtZMngMN5Y9GQCYTKDXZP4JusMcSPet', '2018-03-28 21:45:08', '2018-03-28 21:45:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_productor_id_foreign` (`productor_id`);

--
-- Indices de la tabla `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargagandola`
--
ALTER TABLE `cargagandola`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargagandola_id_gandola_foreign` (`id_gandola`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id`),
  ADD KEY `control_id_cargagandola_foreign` (`id_cargagandola`);

--
-- Indices de la tabla `cupos`
--
ALTER TABLE `cupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cupos_productor_id_foreign` (`productor_id`);

--
-- Indices de la tabla `gandola`
--
ALTER TABLE `gandola`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pesaje`
--
ALTER TABLE `pesaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesaje_camion_id_foreign` (`camion_id`),
  ADD KEY `pesaje_productor_id_foreign` (`productor_id`),
  ADD KEY `pesaje_precio_id_foreign` (`precio_id`),
  ADD KEY `pesaje_cargagandola_id_foreign` (`cargagandola_id`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productor`
--
ALTER TABLE `productor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `camion`
--
ALTER TABLE `camion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargagandola`
--
ALTER TABLE `cargagandola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cupos`
--
ALTER TABLE `cupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gandola`
--
ALTER TABLE `gandola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `pesaje`
--
ALTER TABLE `pesaje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productor`
--
ALTER TABLE `productor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `banco`
--
ALTER TABLE `banco`
  ADD CONSTRAINT `banco_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cargagandola`
--
ALTER TABLE `cargagandola`
  ADD CONSTRAINT `cargagandola_id_gandola_foreign` FOREIGN KEY (`id_gandola`) REFERENCES `gandola` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `control_id_cargagandola_foreign` FOREIGN KEY (`id_cargagandola`) REFERENCES `cargagandola` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `cupos`
--
ALTER TABLE `cupos`
  ADD CONSTRAINT `cupos_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pesaje`
--
ALTER TABLE `pesaje`
  ADD CONSTRAINT `pesaje_camion_id_foreign` FOREIGN KEY (`camion_id`) REFERENCES `camion` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pesaje_cargagandola_id_foreign` FOREIGN KEY (`cargagandola_id`) REFERENCES `cargagandola` (`id`),
  ADD CONSTRAINT `pesaje_precio_id_foreign` FOREIGN KEY (`precio_id`) REFERENCES `precio` (`id`),
  ADD CONSTRAINT `pesaje_productor_id_foreign` FOREIGN KEY (`productor_id`) REFERENCES `productor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
