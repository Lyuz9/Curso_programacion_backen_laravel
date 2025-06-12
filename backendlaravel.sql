-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-06-2025 a las 18:03:57
-- Versión del servidor: 8.0.42-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `backendlaravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'esse', '2025-05-07 04:05:38', '2025-05-07 04:05:38'),
(2, 'qui', '2025-05-07 04:05:38', '2025-05-07 04:05:38'),
(3, 'maxime', '2025-05-07 04:05:38', '2025-05-07 04:05:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concept`
--

CREATE TABLE `concept` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `concept`
--

INSERT INTO `concept` (`id`, `quantity`, `price`, `product_id`, `created_at`, `updated_at`, `sale_id`) VALUES
(1, 12, '255.60', 10, '2025-06-12 23:27:19', '2025-06-12 23:27:19', 1),
(2, 12, '255.60', 10, '2025-06-13 04:09:50', '2025-06-13 04:09:50', 2),
(3, 13, '171.78', 11, '2025-06-13 04:10:38', '2025-06-13 04:10:38', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_28_162409_create_product_table', 1),
(6, '2025_04_28_163527_add_price_to_product_table', 1),
(7, '2025_04_28_164441_create_category_table', 1),
(8, '2025_04_28_164625_add_category_id_to_product_table', 1),
(9, '2025_06_11_213822_create_concepts_table', 2),
(10, '2025_06_11_215551_create_sales_table', 3),
(11, '2025_06_11_220028_add_sale_id_to_concept_table', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`, `price`, `category_id`) VALUES
(1, 'corrupti', 'Deleniti et aut nesciunt mollitia et exercitationem corporis.', '2025-05-07 04:05:38', '2025-05-07 04:08:56', '2025-05-07 04:08:56', '425.17', 1),
(2, 'nihil', 'Rerum sed quis sapiente pariatur est.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '312.51', 1),
(3, 'eum', 'Recusandae facilis perspiciatis rerum provident.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '136.07', 1),
(4, 'maiores', 'Mollitia est aliquam laborum voluptatem reprehenderit suscipit consectetur ea.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '148.34', 1),
(5, 'ipsum', 'Est ut molestiae sed enim est quod.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '201.31', 1),
(6, 'consequatur', 'Quis pariatur ex doloribus beatae reiciendis soluta excepturi.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '249.82', 1),
(7, 'voluptatem', 'Non unde quia quo fugiat.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '343.67', 1),
(8, 'ipsum', 'Ea est unde a adipisci necessitatibus.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '426.16', 1),
(9, 'occaecati', 'Velit repudiandae rerum et debitis voluptas.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '116.50', 1),
(10, 'omnis', 'Et et assumenda reprehenderit eum iusto itaque praesentium.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '255.60', 1),
(11, 'illo', 'Dolorem distinctio optio quis tenetur.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '171.78', 2),
(12, 'omnis', 'Voluptatem omnis et dignissimos et et.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '466.02', 2),
(13, 'minima', 'Dolor alias vitae possimus consequatur optio sed.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '267.39', 2),
(14, 'nihil', 'Delectus alias quas rerum ratione alias.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '258.84', 2),
(15, 'deleniti', 'Quo quia et doloremque eum aut recusandae animi.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '480.81', 2),
(16, 'dicta', 'Et ad qui sint vel distinctio.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '475.37', 2),
(17, 'praesentium', 'Qui quod amet deleniti aut ea recusandae sit.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '157.64', 2),
(18, 'explicabo', 'Iste eos quo illum est voluptate deleniti aut.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '120.58', 2),
(19, 'aut', 'Sed et qui beatae.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '121.26', 2),
(20, 'libero', 'Error dolorem quo et qui error ipsa.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '88.48', 2),
(21, 'quidem', 'Non ut harum itaque minus aperiam fugit voluptatibus.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '116.54', 3),
(22, 'esse', 'Culpa quasi ut similique totam.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '23.74', 3),
(23, 'velit', 'Voluptatem nostrum qui quod necessitatibus qui quae dolores porro.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '436.94', 3),
(24, 'voluptatem', 'Ea aut eos earum delectus nam.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '201.90', 3),
(25, 'et', 'Dolore sit quia minus ratione ea quos quae.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '290.98', 3),
(26, 'saepe', 'Repudiandae in reiciendis rem quibusdam.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '138.39', 3),
(27, 'et', 'Velit excepturi culpa quae qui optio.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '324.83', 3),
(28, 'assumenda', 'Qui consequuntur architecto deleniti.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '21.70', 3),
(29, 'harum', 'Dolor reiciendis eaque incidunt ipsum assumenda sit.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '133.25', 3),
(30, 'corrupti', 'Vel sunt reprehenderit voluptatem fuga consequuntur earum adipisci.', '2025-05-07 04:05:38', '2025-05-07 04:05:38', NULL, '440.95', 3),
(31, 'PAPAS', 'Papas saladitas', '2025-05-08 03:40:26', '2025-05-08 03:40:26', NULL, '60.00', 1),
(32, 'Papas', 'Papas saladitas', '2025-05-08 04:23:36', '2025-05-08 04:23:36', NULL, '60.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale` (
  `id` bigint UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sale`
--

INSERT INTO `sale` (`id`, `total`, `sale_date`, `email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '3067.20', '2025-01-01 07:05:03', 'gabo@gmail.com', NULL, '2025-06-12 23:27:19', '2025-06-12 23:27:19'),
(2, '3067.20', '2025-01-01 07:05:03', 'gabo@gmail.com', NULL, '2025-06-13 04:09:50', '2025-06-13 04:09:50'),
(3, '2233.14', '2025-06-12 10:10:00', 'gabo@gmail.com', NULL, '2025-06-13 04:10:38', '2025-06-13 04:10:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gabriel', 'Gabriel09@gmail.com', NULL, '$2y$12$QOORsEp9GN/cxWSWLdgT0O5LjH1Vw2fPyZIv5W3Y/0KTuuo3YUmHG', NULL, '2025-05-14 03:45:46', '2025-05-14 03:45:46'),
(2, 'Juan', 'juan@gmail.com', NULL, '$2y$12$RgliJs6oD9xAKg7yQW5epOmhay4NTHGl7DBVxCpoIO1eHtwgKRxQS', NULL, '2025-05-22 21:52:01', '2025-05-22 21:52:01'),
(3, 'prueba', 'prueba@gmail.com', NULL, '$2y$12$/M3Bw9EsQMucFUghAoLbC.pLrsc0cva1mM7TC6SmxrEtU1zSaFWE.', NULL, '2025-05-22 22:03:39', '2025-05-22 22:03:39'),
(4, 'prueba1', 'prueba1@gmail.com', NULL, '$2y$12$W7GnwA08U4TlIy7yyw5sjOQLrtWvvZKobqprV7EqW9ZK/.hW1sEaK', NULL, '2025-05-22 22:04:28', '2025-05-22 22:04:28'),
(5, 'prueba2', 'prueba2@gmail.com', NULL, '$2y$12$EBfZ44JlZvoUNs6oWyQQu.D9fnNpmVGezpSUywEC9tS9IFCPdzMxC', NULL, '2025-05-23 00:10:24', '2025-05-23 00:10:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `concept`
--
ALTER TABLE `concept`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concept_product_id_foreign` (`product_id`),
  ADD KEY `concept_sale_id_foreign` (`sale_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
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
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `concept`
--
ALTER TABLE `concept`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `sale`
--
ALTER TABLE `sale`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `concept`
--
ALTER TABLE `concept`
  ADD CONSTRAINT `concept_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `concept_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
