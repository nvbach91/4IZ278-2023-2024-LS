-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 28. čen 2024, 12:04
-- Verze serveru: 10.5.19-MariaDB-0+deb11u2
-- Verze PHP: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `lukt03`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `available_times`
--

CREATE TABLE `available_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitter_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `available_times`
--

INSERT INTO `available_times` (`id`, `sitter_id`, `created_at`, `updated_at`, `start`, `end`) VALUES
(1, 13, '2024-06-27 22:25:28', '2024-06-27 22:25:28', '2024-07-05 04:30:00', '2024-06-02 22:27:00'),
(2, 5, '2024-06-27 22:27:06', '2024-06-27 22:48:01', '2024-06-30 08:30:00', '2024-06-30 10:27:00'),
(3, 5, '2024-06-27 22:28:37', '2024-06-27 22:48:16', '2024-06-29 07:28:00', '2024-06-29 08:28:00'),
(4, 5, '2024-06-27 22:28:57', '2024-06-27 22:28:57', '2024-06-11 22:28:00', '2024-06-12 22:28:00'),
(5, 5, '2024-06-27 22:29:22', '2024-06-27 22:47:25', '2024-06-28 07:29:00', '2024-06-28 09:29:00'),
(7, 5, '2024-06-27 22:44:17', '2024-06-27 22:44:17', '2024-06-27 14:00:00', '2024-06-27 15:00:00'),
(8, 13, '2024-06-27 22:51:45', '2024-06-27 22:52:01', '2024-06-28 07:00:00', '2024-06-28 10:00:00'),
(9, 13, '2024-06-28 08:53:49', '2024-06-28 08:54:00', '2024-06-29 13:02:00', '2024-06-28 13:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `cats`
--

CREATE TABLE `cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `cats`
--

INSERT INTO `cats` (`id`, `owner_id`, `name`, `birthday`, `details`, `photo_path`, `created_at`, `updated_at`) VALUES
(2, 2, 'Kočus', '2018-01-01', 'Je mazlivý', NULL, '2024-06-27 13:23:42', '2024-06-27 13:32:15'),
(3, 13, 'Mew', '2024-06-02', 'Mew mew mew', 'cats/JXyi1WZ33BlREPXvPvWBBykmU0L9GirHDL32vylc.png', '2024-06-27 22:12:10', '2024-06-27 22:12:10'),
(4, 13, 'Mewtwox', '2024-05-05', 'Mew two', 'cats/bPSI7UDiiNqxHiNDnqHLJuDRvWB2kQQNTvQNVyB3.png', '2024-06-27 22:12:30', '2024-06-27 22:12:38'),
(5, 13, 'Meowth', '2024-06-27', 'Speak', 'cats/4D7dhA3ZGy3meVW2iOv5aWIVtV7K8ugnPsdieEFQ.png', '2024-06-27 22:14:15', '2024-06-27 22:14:15'),
(6, 15, 'Kočka', '2018-01-01', 'Chce se mazlit', 'cats/ByREtnnplKpkFbz6gCIZetfqAG0iVZy1nZKH1AqQ.png', '2024-06-28 08:35:47', '2024-06-28 08:35:55');

-- --------------------------------------------------------

--
-- Struktura tabulky `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_12_091709_add_properties_to_users_table', 1),
(6, '2024_05_12_094255_create_cats_table', 1),
(7, '2024_05_12_094259_create_available_times_table', 1),
(8, '2024_05_12_094307_create_sittings_table', 1),
(9, '2024_05_12_094311_create_reviews_table', 1),
(10, '2024_06_01_203033_fix_users_role_default', 1),
(11, '2024_06_04_144824_fix_constraints', 1),
(12, '2024_06_05_162046_rename_user_photo_url_to_avatar_path', 1),
(13, '2024_06_07_004145_rename_cat_photo_url_to_photo_path', 1),
(14, '2024_06_07_140216_change_simple_available_times', 1),
(15, '2024_06_27_023226_modify_sittings_columns', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitting_id` bigint(20) UNSIGNED NOT NULL,
  `review_of_owner` varchar(1000) DEFAULT NULL,
  `score_of_owner` int(11) DEFAULT NULL,
  `review_of_sitter` varchar(1000) DEFAULT NULL,
  `score_of_sitter` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `sittings`
--

CREATE TABLE `sittings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sitter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `sittings`
--

INSERT INTO `sittings` (`id`, `owner_id`, `sitter_id`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 5, '2024-06-27 23:29:00', '2024-06-29 00:29:00', 1, '2024-06-27 22:31:08', '2024-06-27 22:31:35'),
(2, 13, 5, '2024-06-27 23:29:00', '2024-06-29 00:29:00', 1, '2024-06-27 22:40:12', '2024-06-27 22:40:17'),
(3, 13, 5, '2024-06-27 22:29:00', '2024-06-29 00:29:00', 0, '2024-06-27 22:42:04', '2024-06-27 22:42:04'),
(4, 13, 5, '2024-07-01 04:30:00', '2024-07-02 01:27:00', 0, '2024-06-27 22:43:09', '2024-06-27 22:43:09'),
(5, 5, 13, '2024-06-28 07:00:00', '2024-06-28 10:00:00', 1, '2024-06-27 22:52:15', '2024-06-27 22:53:33'),
(6, 15, 5, '2024-06-30 08:30:00', '2024-06-30 10:27:00', 0, '2024-06-28 08:38:27', '2024-06-28 08:38:27'),
(7, 15, 13, '2024-06-28 07:00:00', '2024-06-28 10:00:00', 0, '2024-06-28 08:42:30', '2024-06-28 08:42:30');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `location`, `avatar_path`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '2024-06-14 11:06:21', '$2y$12$7VfUXLBnrVqup7LWTbDzLOAVx49/hBa46TwHoNHDutuh5gUkFK/aW', 2, 'Ústí nad Labem', NULL, 'V7PmsrK92HyG2phVSVLI6Id7o5d4HESdWtSaaBeRHOcK4041fXP601fD8VBi', '2024-06-14 11:06:21', '2024-06-14 11:06:21'),
(2, 'User', 'user@example.com', '2024-06-14 11:06:21', '$2y$12$7VfUXLBnrVqup7LWTbDzLOAVx49/hBa46TwHoNHDutuh5gUkFK/aW', 1, 'Praha', NULL, 'i0lvitIfMfh5YYtH7K8Lc3rOa3ydoOllclaf1l1U6vAyDdSbQYpDWC8nRgaE', '2024-06-14 11:06:21', '2024-06-14 11:06:21'),
(3, 'Božena', 'michael42@example.com', '2024-06-14 11:06:32', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 1, 'Liberec', NULL, 'pwzhICcsxT', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(4, 'Michaela', 'krystof.kropacek@example.net', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 0, 'Břeclav', NULL, 'ON4KayZQvb', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(5, 'Libuše', 'myska.igor@example.com', '2024-06-14 11:06:33', '$2y$12$CsefWp00/poM/a21oEfjG.Tn9mTiPkFovsVY6hAAKcjZRHOqREnqO', 1, 'Praha', NULL, 'QeN1Jk8bJd', '2024-06-14 11:06:33', '2024-06-27 22:38:41'),
(6, 'Zbyněk', 'sediva.matyas@example.com', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 0, 'Vsetín', NULL, 'BmpQn765TV', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(7, 'Antonín', 'lorenc.dominika@example.org', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 1, 'Havlíčkův Brod', NULL, 'FWfqWzIKHq', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(8, 'Lukáš', 'zdenka95@example.org', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 1, 'Sokolov', NULL, 'lpYvJ41G9c', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(9, 'Ivana', 'okostalova@example.org', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 1, 'Most', NULL, 'OZKOga0HNo', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(10, 'Stanislav', 'martin72@example.com', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 1, 'Český Těšín', NULL, 'VEH1z1IzSX', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(11, 'Romana', 'radek03@example.com', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 0, 'Sokolov', NULL, 'ZJo3yt5edf', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(12, 'Věra', 'ales93@example.net', '2024-06-14 11:06:33', '$2y$12$2ZsQyjcFjyvPG0Jjx9BVROSs0GxEso8ya.iM7IfqfWc7OIHQfOaD6', 0, 'Plzeň', NULL, 'kwdBzvKaVf', '2024-06-14 11:06:33', '2024-06-14 11:06:33'),
(13, 'Tester Testington', 'nguv03@vse.cz', '2024-06-27 22:09:58', '$2y$12$CsefWp00/poM/a21oEfjG.Tn9mTiPkFovsVY6hAAKcjZRHOqREnqO', 1, 'Praha', NULL, NULL, '2024-06-27 22:08:40', '2024-06-28 08:53:36'),
(14, 'Tester Testington', 'nguv04@vse.cz', '2024-06-27 22:09:58', '$2y$12$CsefWp00/poM/a21oEfjG.Tn9mTiPkFovsVY6hAAKcjZRHOqREnqO', 2, NULL, NULL, NULL, '2024-06-27 22:08:40', '2024-06-27 22:09:58'),
(15, 'Terka', 'lukt03@vse.cz', '2024-06-28 08:34:49', '$2y$12$7ktii1MCvfBEeOWwfPpHqeQloQR4sjPWU6dpiuPUDyNpunnvU/IZa', 0, NULL, NULL, NULL, '2024-06-28 08:33:19', '2024-06-28 08:34:49');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `available_times`
--
ALTER TABLE `available_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `available_times_sitter_id_foreign` (`sitter_id`);

--
-- Indexy pro tabulku `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cats_owner_id_foreign` (`owner_id`);

--
-- Indexy pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexy pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexy pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexy pro tabulku `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_sitting_id_foreign` (`sitting_id`);

--
-- Indexy pro tabulku `sittings`
--
ALTER TABLE `sittings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sittings_owner_id_foreign` (`owner_id`),
  ADD KEY `sittings_sitter_id_foreign` (`sitter_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `available_times`
--
ALTER TABLE `available_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `cats`
--
ALTER TABLE `cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `sittings`
--
ALTER TABLE `sittings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `available_times`
--
ALTER TABLE `available_times`
  ADD CONSTRAINT `available_times_sitter_id_foreign` FOREIGN KEY (`sitter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_sitting_id_foreign` FOREIGN KEY (`sitting_id`) REFERENCES `sittings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sittings`
--
ALTER TABLE `sittings`
  ADD CONSTRAINT `sittings_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sittings_sitter_id_foreign` FOREIGN KEY (`sitter_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
