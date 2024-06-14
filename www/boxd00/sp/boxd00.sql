-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 14. čen 2024, 14:58
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
-- Databáze: `boxd00`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `connection`
--

CREATE TABLE `connection` (
  `flight_code` varchar(255) NOT NULL,
  `from_code` varchar(255) NOT NULL,
  `to_code` varchar(255) NOT NULL,
  `day` int(11) NOT NULL,
  `time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `connection`
--

INSERT INTO `connection` (`flight_code`, `from_code`, `to_code`, `day`, `time`, `duration`, `price`, `created_at`, `updated_at`) VALUES
('BJ001', 'PRG', 'BKK', 5, '15:50:00', 600, 9999, '2024-06-14 10:47:49', '2024-06-14 10:47:49');

-- --------------------------------------------------------

--
-- Struktura tabulky `destination`
--

CREATE TABLE `destination` (
  `airport_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `destination`
--

INSERT INTO `destination` (`airport_code`, `name`, `country`, `created_at`, `updated_at`) VALUES
('BKK', 'Bangkok', 'Thajsko', '2024-06-14 10:47:00', '2024-06-14 10:47:00'),
('JFK', 'New York', 'Spojené státy', '2024-06-14 10:49:49', '2024-06-14 10:49:49'),
('PRG', 'Praha', 'Česká republika', '2024-06-14 10:47:22', '2024-06-14 10:47:22'),
('YZZ', 'Toronto', 'Kanada', '2024-06-14 10:49:41', '2024-06-14 10:49:41');

-- --------------------------------------------------------

--
-- Struktura tabulky `flight`
--

CREATE TABLE `flight` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flight_code` varchar(255) NOT NULL,
  `delay` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `flight`
--

INSERT INTO `flight` (`id`, `flight_code`, `delay`, `date`, `created_at`, `updated_at`) VALUES
(1, 'BJ001', 0, '2024-06-21', '2024-06-14 10:48:04', '2024-06-14 10:48:04');

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
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2024_06_10_210348_create_destination_table', 1),
(13, '2024_06_12_102005_create_connection_table', 1),
(14, '2024_06_12_104336_create_flight_table', 1),
(15, '2024_06_12_104522_create_user_table', 1);

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
-- Struktura tabulky `ticket`
--

CREATE TABLE `ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `passenger_id` bigint(20) UNSIGNED NOT NULL,
  `seat` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  `reserved_until` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `ticket`
--

INSERT INTO `ticket` (`id`, `flight_id`, `passenger_id`, `seat`, `class`, `reserved`, `reserved_until`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'B6D', 1, 0, '2024-06-14 12:48:53', '2024-06-14 10:48:34', '2024-06-14 10:48:53');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `is_student` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `membership` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `birth_date`, `is_student`, `email`, `password`, `phone`, `membership`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'a', 'a', '2001-01-01', 0, 'a@a.cz', '$2y$12$xaduqch7bsZreEXwEP1v9uf2G22gNi7TDv68bus1xS0RwOZjARNJK', '+420123456789', 0, 0, '2024-06-14 10:45:15', '2024-06-14 10:45:15'),
(2, 'David', 'Boxan', '2001-01-01', 1, 'boxd00@vse.cz', '$2y$12$Ob/JaBjk4IXRtnlJ4E6PCOyriCOxXADNWXRWoS68MGih.Ih0eion.', '+420123456789', 0, 1, '2024-06-14 10:45:45', '2024-06-14 10:45:45');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`flight_code`),
  ADD KEY `connection_from_code_foreign` (`from_code`),
  ADD KEY `connection_to_code_foreign` (`to_code`);

--
-- Indexy pro tabulku `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`airport_code`);

--
-- Indexy pro tabulku `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_flight_code_foreign` (`flight_code`);

--
-- Indexy pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexy pro tabulku `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_flight_id_foreign` (`flight_id`);

--
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `flight`
--
ALTER TABLE `flight`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT pro tabulku `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `connection_from_code_foreign` FOREIGN KEY (`from_code`) REFERENCES `destination` (`airport_code`),
  ADD CONSTRAINT `connection_to_code_foreign` FOREIGN KEY (`to_code`) REFERENCES `destination` (`airport_code`);

--
-- Omezení pro tabulku `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_flight_code_foreign` FOREIGN KEY (`flight_code`) REFERENCES `connection` (`flight_code`);

--
-- Omezení pro tabulku `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
