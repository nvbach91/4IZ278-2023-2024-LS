-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Počítač: sql307.byetcluster.com
-- Vytvořeno: Pát 24. kvě 2024, 08:06
-- Verze serveru: 10.4.17-MariaDB
-- Verze PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `if0_36510556_kombucha_eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Kombucha1', 'Fermented teas with a variety of flavors.', '2024-05-18 15:04:25', '2024-05-18 15:04:25'),
(2, 'Kombucha2', 'Second Category Fermented teas with a variety of flavors.', '2024-05-18 15:04:25', '2024-05-18 15:04:25');

-- --------------------------------------------------------

--
-- Struktura tabulky `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_05_183337_create_categories_table', 1),
(5, '2024_05_05_183338_create_products_table', 1),
(6, '2024_05_05_185337_create_addresses_table', 1),
(7, '2024_05_05_186337_create_shipping_methods_table', 1),
(8, '2024_05_05_187337_create_payment_methods_table', 1),
(9, '2024_05_05_188336_create_orders_table', 1),
(10, '2024_05_05_189336_create_order_details_table', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `email`, `first_name`, `last_name`, `address`, `city`, `zip`, `company`, `phone`, `country`, `shipping_method`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'lorencsam@seznam.cz', 'das', 'das', 'dsa', 'dsa', '12345', NULL, 241412512, 'CZ', 'PPL', 'dobirka', '1498.00', 'pending', '2024-05-18 15:23:16', '2024-05-18 15:23:16'),
(2, 4, 'lorencsam@seznam.cz', 'Samuel', 'Lorenc', 'U Háje, 1548/10', 'Praha 4', '14700', '', 728980270, 'CZ', 'DPD', 'kartou', '819.00', 'paid', '2024-05-18 16:12:10', '2024-05-18 16:12:10'),
(3, 4, 'nguv03@vse.cz', 'Viet Bach', 'Nguyen', 'Adresa 1', 'Praha', '10000', NULL, 123456789, 'CZ', 'DPD', 'dobirka', '4010.00', 'pending', '2024-05-22 22:17:57', '2024-05-22 22:17:57'),
(4, 4, 'nguv03@vse.cz', 'Viet Bach', 'Nguyen', 'Adresa 1', 'Praha', '10000', NULL, 321654987, 'CZ', 'DPD', 'dobirka', '618.00', 'pending', '2024-05-22 22:21:33', '2024-05-22 22:21:33'),
(5, 4, 'nguv03@vse.cz', 'Viet Bach', 'Nguyen', 'Adresa 1', 'Praha', '10000', NULL, 321654987, 'CZ', 'PPL', 'dobirka', '100.00', 'pending', '2024-05-22 22:21:49', '2024-05-22 22:21:49'),
(6, 4, 'nguv03@vse.cz', 'Viet Bach', 'Nguyen', 'Adresa 1', 'Praha', '10000', NULL, 321654987, 'CZ', 'PPL', 'dobirka', '100.00', 'pending', '2024-05-22 22:22:01', '2024-05-22 22:22:01'),
(7, 4, 'nguv03@vse.cz', 'Viet Bach', 'Nguyen', 'Adresa 1', 'Praha', '10000', NULL, 321654987, 'CZ', 'DPD', 'dobirka', '8808.00', 'pending', '2024-05-22 22:27:40', '2024-05-22 22:27:40'),
(8, 4, 'lorencsam@seznam.cz', 'Samuel', 'Lorenc', 'U Háje, 1548/10', 'Praha 4', '14700', NULL, 728980270, 'CZ', 'PPL', 'dobirka', '799.00', 'pending', '2024-05-23 15:41:22', '2024-05-23 15:41:22'),
(9, 4, 'lorencsam@seznam.cz', 'Samuel', 'Lorenc', 'U Háje, 1548/10', 'Praha 4', '14700', NULL, 728980270, 'CZ', 'DPD', 'dobirka', '819.00', 'pending', '2024-05-23 15:44:55', '2024-05-23 15:44:55'),
(10, 4, 'lorencsam@seznam.cz', 'Samuel', 'Lorenc', 'U Háje, 1548/10', 'Praha 4', '14700', NULL, 728980270, 'CZ', 'DPD', 'dobirka', '819.00', 'pending', '2024-05-23 16:28:43', '2024-05-23 16:28:43'),
(11, 4, 'lorencsam@seznam.cz', 'Samuel', 'Lorenc', 'U Háje, 1548/10', 'Praha 4', '12345', NULL, 728980270, 'CZ', 'PPL', 'dobirka', '999.00', 'pending', '2024-05-24 13:39:32', '2024-05-24 13:39:32');

-- --------------------------------------------------------

--
-- Struktura tabulky `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 2, '699.00', NULL, NULL),
(2, 2, 6, 1, '699.00', NULL, NULL),
(3, 3, 5, 4, '498.00', NULL, NULL),
(4, 3, 7, 1, '899.00', NULL, NULL),
(5, 3, 8, 1, '999.00', NULL, NULL),
(6, 4, 5, 1, '498.00', NULL, NULL),
(7, 7, 6, 11, '699.00', NULL, NULL),
(8, 7, 8, 1, '999.00', NULL, NULL),
(9, 8, 6, 1, '699.00', NULL, NULL),
(10, 9, 6, 1, '699.00', NULL, NULL),
(11, 10, 6, 1, '699.00', NULL, NULL),
(12, 11, 7, 1, '899.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(5, 'Blue Kombucha', 'Osvěžující, lehce nasládlá a plná probiotik.', '498.00', 1, 1, 'images/jn0CejHGI7nZcap561VaogmpLQ9rKWsBWCQAObq2.png', '2024-05-18 15:05:10', '2024-05-22 22:21:33'),
(6, 'Mystic Kombucha', 'Osvěžující, lehce nasládlá a plná probiotik. Výborná', '699.00', 1, 24, 'images/A08tdzFSIevGeEhv5Bu6GRWHJduzF8Bznyg8rkrl.png', '2024-05-18 15:06:06', '2024-05-23 16:28:43'),
(7, 'Green Kombucha', 'Nová edice s mnohem lepší chutí', '899.00', 2, 98, 'images/n37nk1pWjXzZvokMdwDKgz9ws20fULnNdp4sHoxH.png', '2024-05-18 15:07:06', '2024-05-24 13:39:32'),
(8, 'Holy Kombucha', 'Nová edice s mnohem lepší chutí', '999.00', 2, 8, 'images/IUwlaaqJqAn1pUzJPGGCqT9ualV9h0bt8MxN6Otc.png', '2024-05-18 15:07:23', '2024-05-22 22:27:40'),
(11, 'das', 'af', '872.00', 1, 28, 'images/IuLWVcyWHmjxGrqyWUBgdGUNZPAjNwDIIVJRDjC6.jpg', '2024-05-24 14:01:14', '2024-05-24 14:01:14'),
(12, 'dsa', 'das', '72.00', 1, 42, 'images/OjXwTW4SSyiEcgnYEEeys3OgXOZ0Rkvaccn37FW7.png', '2024-05-24 14:02:17', '2024-05-24 14:02:17'),
(13, 'das', 'fsa', '32.00', 1, 42, 'images/JO7NKSZybDpQwKebuAk4FVp7Xpgj0I8zYRhhAddt.jpg', '2024-05-24 14:03:31', '2024-05-24 14:03:31'),
(14, 'fa', 'fas', '42.00', 1, 25, 'images/3z1nlS7ru3r5MAPFLzKkDnMjW2Ap5bond99OfJBC.jpg', '2024-05-24 14:05:08', '2024-05-24 14:05:08'),
(15, 'dsa', 'fga', '52.00', 1, 4, 'images/p5nlxWj9xEsPqhTSB7KSSo0wU1ffa39Bs8azg0EX.png', '2024-05-24 14:05:21', '2024-05-24 14:05:21'),
(16, 'rw', 'rwe', '2.00', 1, 12, 'images/1Qf1R3N2Sh1k8CShG41CIkW6hMj9vbfPrmx6gbaM.jpg', '2024-05-24 14:41:14', '2024-05-24 15:33:19');

-- --------------------------------------------------------

--
-- Struktura tabulky `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FkCAgqPLJtTAfnneGDtaZcR9983Mb0l1nt0JhSQl', 4, '37.188.164.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3hGejROcFpDZ01ZdmRDQ3hWdGVMT2dQdHl4RDdidXNRTlBydlVvVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8va29tYnVjaGFlc2hvcC5pbmZpbml0eWZyZWVhcHAuY29tL2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1716550417),
('PsYOx29XTz3fMa7ovbTjFP9GjGkE6QU8samYb24W', NULL, '146.102.151.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXVhaUNNQkZib0NCd3drODJJMnZ4alBybm9SZlVlekdhYkNSYmZoaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8va29tYnVjaGFlc2hvcC5pbmZpbml0eWZyZWVhcHAuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1716548109);

-- --------------------------------------------------------

--
-- Struktura tabulky `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-05-18 15:04:25', '$2y$12$MpWIPgQRHpPxSPER0Hfzl.8dvrvoixTqDpSCJUSf4Yt1wX9yWgPIi', 'user', 'rAvFAOidFl', '2024-05-18 15:04:25', '2024-05-18 15:04:25'),
(2, 'Samuel Lorenc', 'lorencsam@seznam.cz', NULL, '$2y$12$YaKDwNfq6TGI9iXmuJKdaum3ywrk.aMugCU76XcchdWgDgZ5qg9jW', 'admin', '5uZB2MdeLzFDZVTnsg1MHXFPLhpXbTK80yX0LAn4UVxbghaZVUj5GrG3o9ne', '2024-05-18 15:04:42', '2024-05-18 15:04:42'),
(3, 'VIET BACH NGUYEN', 'nguv03@vse.cz', NULL, '$2y$12$5.bKhK9QzuDDvQcaDBXFv.laEkRK9g5efWRJihc67BCMpwjxqjBrG', 'admin', NULL, '2024-05-22 22:19:06', '2024-05-22 22:19:06'),
(4, 'dsa dsa', 'samuellorenc1@gmail.com', NULL, '$2y$12$LfEaRZqrkRaCvc6cvmmV/eFtOt/EXY.RUXlCftBY1tXv29mvhOx0W', 'admin', NULL, '2024-05-24 13:46:18', '2024-05-24 13:46:18');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Klíče pro tabulku `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Klíče pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Klíče pro tabulku `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Klíče pro tabulku `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Klíče pro tabulku `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Klíče pro tabulku `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Klíče pro tabulku `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`);

--
-- Klíče pro tabulku `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Klíče pro tabulku `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pro tabulku `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Omezení pro tabulku `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
