-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2025 a las 01:13:38
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
-- Base de datos: `sanlorenzo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_id` bigint(20) UNSIGNED NOT NULL,
  `dia_id` bigint(20) UNSIGNED NOT NULL,
  `descuento` int(11) NOT NULL DEFAULT 0,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `monto_final` int(11) NOT NULL DEFAULT 0,
  `monto_adeudado` int(11) NOT NULL DEFAULT 0,
  `deposito` int(11) NOT NULL DEFAULT 0,
  `estado_deposito` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `alquileres`
--
DELIMITER $$
CREATE TRIGGER `after_alquileres_update` BEFORE UPDATE ON `alquileres` FOR EACH ROW BEGIN
                IF OLD.descuento != NEW.descuento THEN
                SET NEW.monto_final = NEW.monto_final / (1 - OLD.descuento / 100)
                                                    * (1 - NEW.descuento / 100);
                    SET NEW.monto_adeudado =  NEW.monto_final - (OLD.monto_final - OLD.monto_adeudado);
                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler_abonos`
--

CREATE TABLE `alquiler_abonos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alquiler_id` bigint(20) UNSIGNED NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `metodo_de_pagos_id` bigint(20) UNSIGNED NOT NULL,
  `es_deposito` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `alquiler_abonos`
--
DELIMITER $$
CREATE TRIGGER `after_alquiler_abonos_delete` AFTER DELETE ON `alquiler_abonos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado + OLD.monto_pagado
                WHERE id = OLD.alquiler_id;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_alquiler_abonos_insert` AFTER INSERT ON `alquiler_abonos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado - NEW.monto_pagado
                WHERE id = NEW.alquiler_id;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_alquiler_abonos_update` AFTER UPDATE ON `alquiler_abonos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_adeudado = monto_adeudado + OLD.monto_pagado - NEW.monto_pagado
                WHERE id = NEW.alquiler_id;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler_recibos`
--

CREATE TABLE `alquiler_recibos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alquiler_id` bigint(20) UNSIGNED NOT NULL,
  `servicio_nombre` varchar(100) NOT NULL,
  `servicio_precio` int(11) NOT NULL,
  `servicio_cantidad` int(11) NOT NULL DEFAULT 1,
  `desde` time DEFAULT NULL,
  `hasta` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `alquiler_recibos`
--
DELIMITER $$
CREATE TRIGGER `after_alquiler_recibos_delete` AFTER DELETE ON `alquiler_recibos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_final = monto_final - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100))
                WHERE id = OLD.alquiler_id;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_alquiler_recibos_insert` AFTER INSERT ON `alquiler_recibos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_final = monto_final + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100))
                WHERE id = NEW.alquiler_id;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_alquiler_recibos_update` AFTER UPDATE ON `alquiler_recibos` FOR EACH ROW BEGIN
                UPDATE alquileres
                SET monto_final = monto_final - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)) + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100)),
                    monto_adeudado = monto_adeudado - (OLD.servicio_precio * OLD.servicio_cantidad * (1 - descuento / 100)) + (NEW.servicio_precio * NEW.servicio_cantidad * (1 - descuento / 100))
                WHERE id = NEW.alquiler_id;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `socio` tinyint(1) NOT NULL DEFAULT 0,
  `contacto` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `monto` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `depositos`
--

INSERT INTO `depositos` (`id`, `nombre`, `monto`, `created_at`, `updated_at`) VALUES
(1, 'Depósito base', 15000, '2025-01-23 03:06:54', '2025-01-23 03:06:54'),
(2, 'Sin depósito', 0, '2025-01-23 03:06:54', '2025-01-23 03:06:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `nombre`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 'Socio', 30, '2024-12-14 05:47:30', '2024-12-14 05:47:30'),
(2, 'No socio', 0, '2024-12-14 05:47:38', '2024-12-14 05:47:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Domingo', NULL, NULL),
(2, 'Lunes', NULL, NULL),
(3, 'Martes', NULL, NULL),
(4, 'Miércoles', NULL, NULL),
(5, 'Jueves', NULL, NULL),
(6, 'Viernes', NULL, NULL),
(7, 'Sábado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Pago', NULL, NULL),
(2, 'Impago', NULL, NULL),
(3, 'Reembolsado', NULL, NULL),
(4, 'Retenido', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_de_pagos`
--

CREATE TABLE `metodo_de_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_de_pagos`
--

INSERT INTO `metodo_de_pagos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', NULL, NULL),
(2, 'Transferencia', NULL, NULL),
(3, 'Billetera Virtual', NULL, NULL),
(4, 'Tarjeta Credito', NULL, NULL),
(5, 'Tarjeta Debito', NULL, NULL),
(6, 'Credito Personal', NULL, NULL),
(7, 'No especificado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2024_10_16_215315_create_clientes_table', 1),
(21, '2024_10_16_215540_create_dias_table', 1),
(22, '2024_10_16_215555_create_descuentos_table', 1),
(23, '2024_10_16_215604_create_turnos_table', 1),
(24, '2024_10_16_215609_create_tipo_producto_table', 1),
(25, '2024_10_16_215610_create_productos_table', 1),
(26, '2024_10_16_221827_create_estados_table', 1),
(27, '2024_10_16_221828_create_alquileres_table', 1),
(28, '2024_10_16_222430_create_servicios_table', 1),
(29, '2024_10_23_211606_create_metodo_de_pagos_table', 1),
(30, '2024_10_24_222804_create_alquiler_abonos_table', 1),
(31, '2024_10_25_223059_create_alquiler_recibos_table', 1),
(32, '2024_10_30_221835_create_depositos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_producto_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tipo_producto_id`, `created_at`, `updated_at`) VALUES
(1, 'Quincho', 1, '2024-12-14 05:47:53', '2024-12-14 05:47:53'),
(2, 'Vajilla', 3, '2024-12-14 05:48:02', '2024-12-14 05:48:02'),
(3, 'Pileta', 2, '2024-12-14 05:48:10', '2024-12-14 05:48:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `turno_id` bigint(20) UNSIGNED DEFAULT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `precio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `turno_id`, `producto_id`, `nombre`, `precio`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Quincho Dia Completo', 50000, '2024-12-14 05:50:22', '2024-12-14 05:50:22'),
(2, 2, 1, 'Quincho Mediodia', 25000, '2024-12-14 05:50:38', '2024-12-14 05:50:38'),
(3, 3, 1, 'Quincho Noche', 60000, '2024-12-14 05:51:04', '2024-12-14 05:51:04'),
(4, 4, 1, 'Quincho Tarde (2 horas)', 10000, '2024-12-14 05:51:23', '2024-12-14 05:51:23'),
(5, 5, 1, 'Quincho Tarde (3 horas)', 15000, '2024-12-14 05:51:36', '2024-12-14 05:51:36'),
(6, NULL, 3, 'Pileta', 5000, '2024-12-14 05:51:53', '2024-12-14 05:51:53'),
(7, NULL, 2, 'Vajilla', 350, '2024-12-14 05:52:06', '2024-12-14 05:52:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KUGnZEZXozZk3aXZjR1YVwZDAcZnNvIBkUOX2X2U', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjFEQUsyMDdwNmZuTXQyNXVONldJSVhUd1BZTmhRb3hPWmhBY2s1ayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BhbmVsIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1737591143);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Inmueble horario fijo', '2025-01-23 03:06:54', '2025-01-23 03:06:54'),
(2, 'Inmueble horario flexible', '2025-01-23 03:06:54', '2025-01-23 03:06:54'),
(3, 'No inmueble', '2025-01-23 03:06:54', '2025-01-23 03:06:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `desde` time NOT NULL,
  `hasta` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `desde`, `hasta`, `created_at`, `updated_at`) VALUES
(1, 'Dia Completo', '09:00:00', '05:00:00', '2024-12-14 05:49:10', '2024-12-14 05:49:10'),
(2, 'Mediodia', '09:00:00', '18:00:00', '2024-12-14 05:49:21', '2024-12-14 05:49:21'),
(3, 'Noche', '19:00:00', '05:00:00', '2024-12-14 05:49:33', '2024-12-14 05:49:33'),
(4, 'Tarde (2 horas)', '14:00:00', '16:00:00', '2024-12-14 05:49:46', '2024-12-14 05:49:46'),
(5, 'Tarde (3 horas)', '14:00:00', '17:00:00', '2024-12-14 05:49:56', '2024-12-14 05:49:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'admin@gmail.com', NULL, '$2y$12$NwhKbagtbofN6.lDWHUbj.CCSmjJ5Di8NO/UM/KqTE0lHmzClM4g2', NULL, '2025-01-23 03:06:54', '2025-01-23 03:06:54'),
(2, 'Mobi', 'mobi@gmail.com', NULL, '$2y$12$jwTa0uJzvfDXV7RDDpCyveaQ3qeSCxWCsQpnHnZnLpzsuDeLbFlnS', NULL, '2025-01-23 03:08:21', '2025-01-23 03:08:21'),
(3, 'Sebas', 'seba@gmail.com', NULL, '$2y$12$XEVDHAbZRigfuWVIPBVzmOODEpzToXX1DaST5T4nikwcZ6I02eBXa', NULL, '2025-01-23 03:10:06', '2025-01-23 03:10:06'),
(4, 'Dario', 'dario@gmail.com', NULL, '$2y$12$IcpExFYThmaK3EyNMY9bKeViQ25MVuw/UiTUehsQ7EI4A60ZUrgRC', NULL, '2025-01-23 03:11:10', '2025-01-23 03:11:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alquileres_nombre_id_foreign` (`nombre_id`),
  ADD KEY `alquileres_dia_id_foreign` (`dia_id`),
  ADD KEY `alquileres_estado_id_foreign` (`estado_id`),
  ADD KEY `alquileres_estado_deposito_foreign` (`estado_deposito`);

--
-- Indices de la tabla `alquiler_abonos`
--
ALTER TABLE `alquiler_abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alquiler_abonos_alquiler_id_foreign` (`alquiler_id`),
  ADD KEY `alquiler_abonos_metodo_de_pagos_id_foreign` (`metodo_de_pagos_id`);

--
-- Indices de la tabla `alquiler_recibos`
--
ALTER TABLE `alquiler_recibos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alquiler_recibos_alquiler_id_foreign` (`alquiler_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_dni_unique` (`dni`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodo_de_pagos`
--
ALTER TABLE `metodo_de_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_tipo_producto_id_foreign` (`tipo_producto_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicios_turno_id_foreign` (`turno_id`),
  ADD KEY `servicios_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
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
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alquiler_abonos`
--
ALTER TABLE `alquiler_abonos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alquiler_recibos`
--
ALTER TABLE `alquiler_recibos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodo_de_pagos`
--
ALTER TABLE `metodo_de_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_dia_id_foreign` FOREIGN KEY (`dia_id`) REFERENCES `dias` (`id`),
  ADD CONSTRAINT `alquileres_estado_deposito_foreign` FOREIGN KEY (`estado_deposito`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `alquileres_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `alquileres_nombre_id_foreign` FOREIGN KEY (`nombre_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `alquiler_abonos`
--
ALTER TABLE `alquiler_abonos`
  ADD CONSTRAINT `alquiler_abonos_alquiler_id_foreign` FOREIGN KEY (`alquiler_id`) REFERENCES `alquileres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alquiler_abonos_metodo_de_pagos_id_foreign` FOREIGN KEY (`metodo_de_pagos_id`) REFERENCES `metodo_de_pagos` (`id`);

--
-- Filtros para la tabla `alquiler_recibos`
--
ALTER TABLE `alquiler_recibos`
  ADD CONSTRAINT `alquiler_recibos_alquiler_id_foreign` FOREIGN KEY (`alquiler_id`) REFERENCES `alquileres` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_tipo_producto_id_foreign` FOREIGN KEY (`tipo_producto_id`) REFERENCES `tipo_producto` (`id`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `servicios_turno_id_foreign` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
