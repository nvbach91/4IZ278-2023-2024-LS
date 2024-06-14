-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 12:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palpad`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supertype` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `subtype` varchar(255) DEFAULT NULL,
  `set_id` char(36) NOT NULL,
  `image_small_url` varchar(255) DEFAULT NULL,
  `image_large_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `supertype`, `type`, `subtype`, `set_id`, `image_small_url`, `image_large_url`) VALUES
('base1-86', 'Pokémon Flute', 'Trainer', NULL, NULL, 'base1', 'https://images.pokemontcg.io/base1/86.png', 'https://images.pokemontcg.io/base1/86_hires.png'),
('base2-64', 'Poké Ball', 'Trainer', NULL, NULL, 'base2', 'https://images.pokemontcg.io/base2/64.png', 'https://images.pokemontcg.io/base2/64_hires.png'),
('bw11-35', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'bw11', 'https://images.pokemontcg.io/bw11/35.png', 'https://images.pokemontcg.io/bw11/35_hires.png'),
('bw5-29', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'bw5', 'https://images.pokemontcg.io/bw5/29.png', 'https://images.pokemontcg.io/bw5/29_hires.png'),
('bwp-BW56', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'bwp', 'https://images.pokemontcg.io/bwp/BW56.png', 'https://images.pokemontcg.io/bwp/BW56_hires.png'),
('dc1-27', 'Team Aqua\'s Great Ball', 'Trainer', NULL, 'Item', 'dc1', 'https://images.pokemontcg.io/dc1/27.png', 'https://images.pokemontcg.io/dc1/27_hires.png'),
('dc1-31', 'Team Magma\'s Great Ball', 'Trainer', NULL, 'Item', 'dc1', 'https://images.pokemontcg.io/dc1/31.png', 'https://images.pokemontcg.io/dc1/31_hires.png'),
('dp1-4', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'dp1', 'https://images.pokemontcg.io/dp1/4.png', 'https://images.pokemontcg.io/dp1/4_hires.png'),
('dp5-17', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'dp5', 'https://images.pokemontcg.io/dp5/17.png', 'https://images.pokemontcg.io/dp5/17_hires.png'),
('dp7-2', 'Empoleon', 'Pokémon', 'Metal', 'Stage 2', 'dp7', 'https://images.pokemontcg.io/dp7/2.png', 'https://images.pokemontcg.io/dp7/2_hires.png'),
('dpp-DP11', 'Empoleon LV.X', 'Pokémon', 'Water', 'Level-Up', 'dpp', 'https://images.pokemontcg.io/dpp/DP11.png', 'https://images.pokemontcg.io/dpp/DP11_hires.png'),
('ex4-72', 'Dual Ball', 'Trainer', NULL, 'Item', 'ex4', 'https://images.pokemontcg.io/ex4/72.png', 'https://images.pokemontcg.io/ex4/72_hires.png'),
('ex4-75', 'Team Aqua Ball', 'Trainer', NULL, 'Item', 'ex4', 'https://images.pokemontcg.io/ex4/75.png', 'https://images.pokemontcg.io/ex4/75_hires.png'),
('hgss2-72', 'Dual Ball', 'Trainer', NULL, 'Item', 'hgss2', 'https://images.pokemontcg.io/hgss2/72.png', 'https://images.pokemontcg.io/hgss2/72_hires.png'),
('neo3-60', 'Balloon Berry', 'Trainer', NULL, 'Pokémon Tool', 'neo3', 'https://images.pokemontcg.io/neo3/60.png', 'https://images.pokemontcg.io/neo3/60_hires.png'),
('pl1-26', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'pl1', 'https://images.pokemontcg.io/pl1/26.png', 'https://images.pokemontcg.io/pl1/26_hires.png'),
('pl3-27', 'Empoleon FB', 'Pokémon', 'Water', 'Basic', 'pl3', 'https://images.pokemontcg.io/pl3/27.png', 'https://images.pokemontcg.io/pl3/27_hires.png'),
('sm12-56', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'sm12', 'https://images.pokemontcg.io/sm12/56.png', 'https://images.pokemontcg.io/sm12/56_hires.png'),
('sm35-60', 'Great Ball', 'Trainer', NULL, 'Item', 'sm35', 'https://images.pokemontcg.io/sm35/60.png', 'https://images.pokemontcg.io/sm35/60_hires.png'),
('sm5-34', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'sm5', 'https://images.pokemontcg.io/sm5/34.png', 'https://images.pokemontcg.io/sm5/34_hires.png'),
('sma-SV81', 'Aether Foundation Employee', 'Trainer', NULL, 'Supporter', 'sma', 'https://images.pokemontcg.io/sma/SV81.png', 'https://images.pokemontcg.io/sma/SV81_hires.png'),
('sv4pt5-234', 'Charizard ex', 'Pokémon', 'Darkness', 'Stage 2', 'sv4pt5', 'https://images.pokemontcg.io/sv4pt5/234.png', 'https://images.pokemontcg.io/sv4pt5/234_hires.png'),
('sv5-144', 'Buddy-Buddy Poffin', 'Trainer', NULL, 'Item', 'sv5', 'https://images.pokemontcg.io/sv5/144.png', 'https://images.pokemontcg.io/sv5/144_hires.png'),
('sv6-142', 'Accompanying Flute', 'Trainer', NULL, 'Item', 'sv6', 'https://images.pokemontcg.io/sv6/142.png', 'https://images.pokemontcg.io/sv6/142_hires.png'),
('sv6-223', 'Buddy-Buddy Poffin', 'Trainer', NULL, 'Item', 'sv6', 'https://images.pokemontcg.io/sv6/223.png', 'https://images.pokemontcg.io/sv6/223_hires.png'),
('svp-56', 'Charizard ex', 'Pokémon', 'Darkness', 'Stage 2', 'svp', 'https://images.pokemontcg.io/svp/56.png', 'https://images.pokemontcg.io/svp/56_hires.png'),
('swsh10-213', 'Path to the Peak', 'Trainer', NULL, 'Stadium', 'swsh10', 'https://images.pokemontcg.io/swsh10/213.png', 'https://images.pokemontcg.io/swsh10/213_hires.png'),
('swsh11-152', 'Arc Phone', 'Trainer', NULL, 'Item', 'swsh11', 'https://images.pokemontcg.io/swsh11/152.png', 'https://images.pokemontcg.io/swsh11/152_hires.png'),
('swsh11-79', 'Comfey', 'Pokémon', 'Psychic', 'Basic', 'swsh11', 'https://images.pokemontcg.io/swsh11/79.png', 'https://images.pokemontcg.io/swsh11/79_hires.png'),
('swsh35-52', 'Great Ball', 'Trainer', NULL, 'Item', 'swsh35', 'https://images.pokemontcg.io/swsh35/52.png', 'https://images.pokemontcg.io/swsh35/52_hires.png'),
('swsh35-59', 'Poké Ball', 'Trainer', NULL, 'Item', 'swsh35', 'https://images.pokemontcg.io/swsh35/59.png', 'https://images.pokemontcg.io/swsh35/59_hires.png'),
('swsh8-225', 'Battle VIP Pass', 'Trainer', NULL, 'Item', 'swsh8', 'https://images.pokemontcg.io/swsh8/225.png', 'https://images.pokemontcg.io/swsh8/225_hires.png'),
('xy0-35', 'Poké Ball', 'Trainer', NULL, 'Item', 'xy0', 'https://images.pokemontcg.io/xy0/35.png', 'https://images.pokemontcg.io/xy0/35_hires.png'),
('xy7-76', 'Level Ball', 'Trainer', NULL, 'Item', 'xy7', 'https://images.pokemontcg.io/xy7/76.png', 'https://images.pokemontcg.io/xy7/76_hires.png'),
('xy8-38', 'Empoleon', 'Pokémon', 'Water', 'Stage 2', 'xy8', 'https://images.pokemontcg.io/xy8/38.png', 'https://images.pokemontcg.io/xy8/38_hires.png');

-- --------------------------------------------------------

--
-- Table structure for table `card_sets`
--

CREATE TABLE `card_sets` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card_sets`
--

INSERT INTO `card_sets` (`id`, `name`, `symbol_url`, `logo_url`) VALUES
('base1', 'Base', 'https://images.pokemontcg.io/base1/symbol.png', 'https://images.pokemontcg.io/base1/logo.png'),
('base2', 'Jungle', 'https://images.pokemontcg.io/base2/symbol.png', 'https://images.pokemontcg.io/base2/logo.png'),
('bw11', 'Legendary Treasures', 'https://images.pokemontcg.io/bw11/symbol.png', 'https://images.pokemontcg.io/bw11/logo.png'),
('bw5', 'Dark Explorers', 'https://images.pokemontcg.io/bw5/symbol.png', 'https://images.pokemontcg.io/bw5/logo.png'),
('bwp', 'BW Black Star Promos', 'https://images.pokemontcg.io/bwp/symbol.png', 'https://images.pokemontcg.io/bwp/logo.png'),
('dc1', 'Double Crisis', 'https://images.pokemontcg.io/dc1/symbol.png', 'https://images.pokemontcg.io/dc1/logo.png'),
('dp1', 'Diamond & Pearl', 'https://images.pokemontcg.io/dp1/symbol.png', 'https://images.pokemontcg.io/dp1/logo.png'),
('dp5', 'Majestic Dawn', 'https://images.pokemontcg.io/dp5/symbol.png', 'https://images.pokemontcg.io/dp5/logo.png'),
('dp7', 'Stormfront', 'https://images.pokemontcg.io/dp7/symbol.png', 'https://images.pokemontcg.io/dp7/logo.png'),
('dpp', 'DP Black Star Promos', 'https://images.pokemontcg.io/dpp/symbol.png', 'https://images.pokemontcg.io/dpp/logo.png'),
('ex4', 'Team Magma vs Team Aqua', 'https://images.pokemontcg.io/ex4/symbol.png', 'https://images.pokemontcg.io/ex4/logo.png'),
('hgss2', 'HS—Unleashed', 'https://images.pokemontcg.io/hgss2/symbol.png', 'https://images.pokemontcg.io/hgss2/logo.png'),
('neo3', 'Neo Revelation', 'https://images.pokemontcg.io/neo3/symbol.png', 'https://images.pokemontcg.io/neo3/logo.png'),
('pl1', 'Platinum', 'https://images.pokemontcg.io/pl1/symbol.png', 'https://images.pokemontcg.io/pl1/logo.png'),
('pl3', 'Supreme Victors', 'https://images.pokemontcg.io/pl3/symbol.png', 'https://images.pokemontcg.io/pl3/logo.png'),
('sm12', 'Cosmic Eclipse', 'https://images.pokemontcg.io/sm12/symbol.png', 'https://images.pokemontcg.io/sm12/logo.png'),
('sm35', 'Shining Legends', 'https://images.pokemontcg.io/sm35/symbol.png', 'https://images.pokemontcg.io/sm35/logo.png'),
('sm5', 'Ultra Prism', 'https://images.pokemontcg.io/sm5/symbol.png', 'https://images.pokemontcg.io/sm5/logo.png'),
('sma', 'Hidden Fates Shiny Vault', 'https://images.pokemontcg.io/sma/symbol.png', 'https://images.pokemontcg.io/sma/logo.png'),
('sv4pt5', 'Paldean Fates', 'https://images.pokemontcg.io/sv4pt5/symbol.png', 'https://images.pokemontcg.io/sv4pt5/logo.png'),
('sv5', 'Temporal Forces', 'https://images.pokemontcg.io/sv5/symbol.png', 'https://images.pokemontcg.io/sv5/logo.png'),
('sv6', 'Twilight Masquerade', 'https://images.pokemontcg.io/sv6/symbol.png', 'https://images.pokemontcg.io/sv6/logo.png'),
('svp', 'Scarlet & Violet Black Star Promos', 'https://images.pokemontcg.io/svp/symbol.png', 'https://images.pokemontcg.io/svp/logo.png'),
('swsh10', 'Astral Radiance', 'https://images.pokemontcg.io/swsh10/symbol.png', 'https://images.pokemontcg.io/swsh10/logo.png'),
('swsh11', 'Lost Origin', 'https://images.pokemontcg.io/swsh11/symbol.png', 'https://images.pokemontcg.io/swsh11/logo.png'),
('swsh35', 'Champion\'s Path', 'https://images.pokemontcg.io/swsh35/symbol.png', 'https://images.pokemontcg.io/swsh35/logo.png'),
('swsh8', 'Fusion Strike', 'https://images.pokemontcg.io/swsh8/symbol.png', 'https://images.pokemontcg.io/swsh8/logo.png'),
('xy0', 'Kalos Starter Set', 'https://images.pokemontcg.io/xy0/symbol.png', 'https://images.pokemontcg.io/xy0/logo.png'),
('xy7', 'Ancient Origins', 'https://images.pokemontcg.io/xy7/symbol.png', 'https://images.pokemontcg.io/xy7/logo.png'),
('xy8', 'BREAKthrough', 'https://images.pokemontcg.io/xy8/symbol.png', 'https://images.pokemontcg.io/xy8/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `decks`
--

CREATE TABLE `decks` (
  `id` char(36) NOT NULL,
  `owner_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decks`
--

INSERT INTO `decks` (`id`, `owner_id`, `name`, `created_at`, `updated_at`) VALUES
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 1', '2024-06-10 20:21:40', '2024-06-12 12:21:54'),
('9c41a8dd-9cb6-4c7c-a26f-6f76b2a9a1ba', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 2', '2024-06-10 20:23:19', '2024-06-10 20:23:19'),
('9c41ba09-20b8-4add-bb19-9c67b3d0a76b', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 3', '2024-06-10 21:11:19', '2024-06-12 12:22:03'),
('9c4502c0-d522-4f28-bb5c-b7fe9168b808', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 4', '2024-06-12 12:22:08', '2024-06-12 12:22:08'),
('9c4502c5-db97-488e-b6b3-87a62a9438cc', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 5', '2024-06-12 12:22:11', '2024-06-12 12:22:11'),
('9c4502d8-16a9-44e4-a498-b3491f64443c', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 6', '2024-06-12 12:22:23', '2024-06-12 12:22:23'),
('9c4502de-de32-4ad9-bbc9-777675ec0b4e', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 7', '2024-06-12 12:22:28', '2024-06-12 12:22:28'),
('9c453496-5610-4edc-8076-82a66c02cda2', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 8', '2024-06-12 14:41:29', '2024-06-12 14:41:29'),
('9c45349e-b882-4f23-ab9f-fb54794a5f09', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 9', '2024-06-12 14:41:34', '2024-06-12 14:41:34'),
('9c4534a4-cb64-42fd-923e-bae7a10a69e7', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Deck 10', '2024-06-12 14:41:38', '2024-06-12 14:41:38'),
('9c45b78f-8821-42d3-9f3b-adb00d7e6585', '9c44de50-919f-4e27-89b4-e2c16dc39be6', 'Bob\'s deck (edited)', '2024-06-12 20:47:43', '2024-06-12 20:49:57'),
('9c489b90-b9f6-403f-bb7f-ddb7829826de', '9c40c06b-39c3-47e9-bad0-6d76eb271074', 'My new Deck', '2024-06-14 07:16:55', '2024-06-14 07:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `decks_cards`
--

CREATE TABLE `decks_cards` (
  `deck_id` char(36) NOT NULL,
  `card_id` char(36) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decks_cards`
--

INSERT INTO `decks_cards` (`deck_id`, `card_id`, `count`) VALUES
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'dc1-27', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'dc1-31', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'dp1-4', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'dp7-2', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'dpp-DP11', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'ex4-72', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'ex4-75', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'hgss2-72', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'neo3-60', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'sm35-60', 1),
('9c41a847-2daa-4814-8f01-264fd3b2fd5a', 'swsh8-225', 4),
('9c41a8dd-9cb6-4c7c-a26f-6f76b2a9a1ba', 'sv6-223', 4),
('9c41ba09-20b8-4add-bb19-9c67b3d0a76b', 'sv5-144', 4),
('9c4502c0-d522-4f28-bb5c-b7fe9168b808', 'swsh11-79', 1),
('9c45b78f-8821-42d3-9f3b-adb00d7e6585', 'sv6-223', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_12_1_create_card_sets_table', 1),
(6, '2024_05_12_2_create_cards_table', 1),
(7, '2024_05_12_3_create_decks_table', 1),
(8, '2024_05_12_4_add_privilege_to_users_table', 1),
(9, '2024_05_12_5_create_users_cards_table', 1),
(10, '2024_05_12_6_create_decks_cards_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `privilege`) VALUES
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'Linh', 'lav.linh@gmail.com', NULL, '$2y$12$MvGs3RFUVRZMplk/7INMh.rFmrrs9hdqiAqYkpM4NzFmm8zERUyXC', NULL, '2024-06-10 09:33:20', '2024-06-10 11:24:51', 2),
('9c44de50-919f-4e27-89b4-e2c16dc39be6', 'Bobson', 'bob@bob.bob', NULL, '$2y$12$JY96EVTLsQC1Xk01RYGmEexv8C4l5lYWAZftX9qcpe4.eZDi.bc86', NULL, '2024-06-12 10:40:15', '2024-06-12 22:00:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_cards`
--

CREATE TABLE `users_cards` (
  `user_id` char(36) NOT NULL,
  `card_id` char(36) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_cards`
--

INSERT INTO `users_cards` (`user_id`, `card_id`, `count`) VALUES
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'dc1-31', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'dpp-DP11', 4),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'ex4-75', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'pl1-26', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'pl3-27', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'sm12-56', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'sm5-34', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'sma-SV81', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'sv6-223', 7),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'swsh10-213', 1),
('9c40c06b-39c3-47e9-bad0-6d76eb271074', 'swsh8-225', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cards_set_id_foreign` (`set_id`);

--
-- Indexes for table `card_sets`
--
ALTER TABLE `card_sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `decks_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `decks_cards`
--
ALTER TABLE `decks_cards`
  ADD PRIMARY KEY (`deck_id`,`card_id`),
  ADD KEY `decks_cards_card_id_foreign` (`card_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_cards`
--
ALTER TABLE `users_cards`
  ADD PRIMARY KEY (`user_id`,`card_id`),
  ADD KEY `users_cards_card_id_foreign` (`card_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_set_id_foreign` FOREIGN KEY (`set_id`) REFERENCES `card_sets` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `decks_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `decks_cards`
--
ALTER TABLE `decks_cards`
  ADD CONSTRAINT `decks_cards_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `decks_cards_deck_id_foreign` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_cards`
--
ALTER TABLE `users_cards`
  ADD CONSTRAINT `users_cards_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
