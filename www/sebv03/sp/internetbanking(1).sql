-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 14. čen 2024, 14:15
-- Verze serveru: 10.4.25-MariaDB
-- Verze PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `internetbanking`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `accounts`
--

INSERT INTO `accounts` (`id`, `display_name`, `balance`, `created_at`, `updated_at`) VALUES
(1, 'Vojtěch Šebek\'s Account', '83.00', '2024-06-13 17:13:19', '2024-06-14 10:03:34'),
(2, 'Jan Novák\'s Account', '47.00', '2024-06-13 17:21:22', '2024-06-14 10:06:44'),
(3, 'Cool account', '23.00', '2024-06-13 18:12:50', '2024-06-14 09:46:31'),
(4, 'Vojta\'s Account', '100.00', '2024-06-13 18:39:07', '2024-06-13 18:39:07'),
(5, 'zkouška', '0.00', '2024-06-14 09:56:00', '2024-06-14 09:56:00'),
(6, 'zkouška2', '0.00', '2024-06-14 09:56:19', '2024-06-14 09:56:19'),
(7, 'Účet s ID 35', '0.00', '2024-06-14 09:57:53', '2024-06-14 09:57:53'),
(42, 'Účet s ID 42', '47.00', '2024-06-14 09:58:21', '2024-06-14 10:06:44');

-- --------------------------------------------------------

--
-- Struktura tabulky `account_permissions`
--

CREATE TABLE `account_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission` enum('owner','manager','follower') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `account_permissions`
--

INSERT INTO `account_permissions` (`id`, `account_id`, `user_id`, `permission`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'owner', '2024-06-13 17:13:19', '2024-06-13 17:13:19'),
(5, 2, 2, 'owner', '2024-06-13 17:30:20', '2024-06-13 17:31:21'),
(14, 3, 2, 'owner', '2024-06-13 18:12:50', '2024-06-13 18:12:50'),
(15, 4, 3, 'owner', '2024-06-13 18:39:07', '2024-06-13 18:39:07'),
(21, 5, 2, 'owner', '2024-06-14 09:56:00', '2024-06-14 09:56:00'),
(22, 6, 2, 'owner', '2024-06-14 09:56:19', '2024-06-14 09:56:19'),
(23, 7, 2, 'owner', '2024-06-14 09:57:53', '2024-06-14 09:57:53'),
(24, 42, 2, 'owner', '2024-06-14 09:58:21', '2024-06-14 09:58:21'),
(25, 2, 1, 'follower', '2024-06-14 10:03:21', '2024-06-14 10:03:21');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_14_082350_create_accounts_table', 1),
(6, '2024_05_14_082950_create_transactions_table', 1),
(7, '2024_05_14_092751_create_account_permissions_table', 1);

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
-- Struktura tabulky `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `from_account` bigint(20) UNSIGNED NOT NULL,
  `target_account` bigint(20) UNSIGNED NOT NULL,
  `sent_by` bigint(20) UNSIGNED NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `from_account`, `target_account`, `sent_by`, `sent_at`, `message`, `created_at`, `updated_at`) VALUES
(1, '31.00', 2, 1, 2, '2024-06-13 19:21:43', 'Na pečivo', '2024-06-13 17:21:43', '2024-06-13 17:21:43'),
(2, '33.00', 1, 2, 2, '2024-06-13 20:00:50', 'Díky!', '2024-06-13 18:00:50', '2024-06-13 18:00:50'),
(3, '1.00', 1, 2, 1, '2024-06-14 09:06:52', NULL, '2024-06-14 09:06:52', '2024-06-14 09:06:52'),
(4, '2.00', 1, 2, 1, '2024-06-14 09:07:14', NULL, '2024-06-14 09:07:14', '2024-06-14 09:07:14'),
(5, '3.00', 1, 3, 1, '2024-06-14 09:07:25', NULL, '2024-06-14 09:07:25', '2024-06-14 09:07:25'),
(6, '4.00', 1, 2, 1, '2024-06-14 09:07:38', NULL, '2024-06-14 09:07:38', '2024-06-14 09:07:38'),
(7, '5.00', 1, 3, 1, '2024-06-14 09:07:52', NULL, '2024-06-14 09:07:52', '2024-06-14 09:07:52'),
(8, '12.00', 1, 3, 1, '2024-06-14 09:45:29', NULL, '2024-06-14 09:45:29', '2024-06-14 09:45:29'),
(9, '3.00', 2, 3, 2, '2024-06-14 09:46:31', 'abc', '2024-06-14 09:46:31', '2024-06-14 09:46:31'),
(10, '35.00', 2, 42, 2, '2024-06-14 09:58:51', NULL, '2024-06-14 09:58:51', '2024-06-14 09:58:51'),
(11, '12.00', 2, 1, 2, '2024-06-14 10:03:34', NULL, '2024-06-14 10:03:34', '2024-06-14 10:03:34'),
(12, '12.00', 2, 42, 2, '2024-06-14 10:06:44', NULL, '2024-06-14 10:06:44', '2024-06-14 10:06:44');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Vojtěch Šebek', 'vsebekvojtech@gmail.com', '$2y$12$MupxBFWVtjW8cgsJts3hAOzO1VGmntwWw0Sxuc/xoxBdC83vy4OOC', '2024-06-13 17:13:19', '2024-06-13 17:13:19', 'EWBN9CQjuhDQlqwMIO7LETUBnjfP2627aRF2UC6aNgCBJg3xyDoxRg2RtBnJ'),
(2, 'Jan Novák', 'jan@novak.cz', '$2y$12$/UVXkBkRwx1Rznl8RgHBOuoYkKi7LVPP2WqNIwiN3VoJMtNJcJ8Mi', '2024-06-13 17:21:22', '2024-06-13 17:21:22', 'TyZdOILebUwvdAHY12wzFFxvHi7RfNXqqk727hLoQKkfumVuIiPOMAtvRBNg'),
(3, 'Vojta', 'sebv03@vse.cz', '$2y$12$NvF3LuF9DT76HM1esmQTaeTAYRfzUMnbbNBIWhAbr8pLKWbNO7GHO', '2024-06-13 18:39:07', '2024-06-13 18:39:07', '8F2Vapbjgb1WFehOFROozTYiVlFYpDEKPCZ7CRQAEnW1gexgfgwJPX6caWw6');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `account_permissions`
--
ALTER TABLE `account_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_permissions_account_id_foreign` (`account_id`),
  ADD KEY `account_permissions_user_id_foreign` (`user_id`);

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
-- Indexy pro tabulku `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_from_account_foreign` (`from_account`),
  ADD KEY `transactions_target_account_foreign` (`target_account`),
  ADD KEY `transactions_sent_by_foreign` (`sent_by`);

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
-- AUTO_INCREMENT pro tabulku `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pro tabulku `account_permissions`
--
ALTER TABLE `account_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `account_permissions`
--
ALTER TABLE `account_permissions`
  ADD CONSTRAINT `account_permissions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `account_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Omezení pro tabulku `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_from_account_foreign` FOREIGN KEY (`from_account`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `transactions_sent_by_foreign` FOREIGN KEY (`sent_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_target_account_foreign` FOREIGN KEY (`target_account`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
