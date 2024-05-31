-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: May 31, 2024 at 09:33 PM
-- Server version: 10.5.19-MariaDB-1:10.5.19+maria~ubu2004
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240528143427', '2024-05-30 20:05:13', 257),
('DoctrineMigrations\\Version20240528161653', '2024-05-30 20:05:14', 6),
('DoctrineMigrations\\Version20240528221015', '2024-05-30 20:05:14', 7),
('DoctrineMigrations\\Version20240531073521', '2024-05-31 07:35:39', 64),
('DoctrineMigrations\\Version20240531092033', '2024-05-31 09:20:36', 336),
('DoctrineMigrations\\Version20240531094327', '2024-05-31 09:43:30', 11),
('DoctrineMigrations\\Version20240531114558', '2024-05-31 11:46:01', 27);

-- --------------------------------------------------------

--
-- Table structure for table `entrance`
--

CREATE TABLE `entrance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entrance`
--

INSERT INTO `entrance` (`id`, `name`, `created_at`) VALUES
(1, 'Online', '2024-05-31 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `football_match`
--

CREATE TABLE `football_match` (
  `id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `played_at` datetime NOT NULL,
  `full_price` double NOT NULL,
  `child_price` double NOT NULL,
  `slug` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `football_match`
--

INSERT INTO `football_match` (`id`, `created_by_id`, `title`, `status`, `played_at`, `full_price`, `child_price`, `slug`, `availability`) VALUES
(4, 1, 'Slavia - Buldok', 'Plánovaný', '2024-12-12 12:12:00', 100, 50, 'Slavia-Buldok-2024-12-12-33e7f5d8c8276615', 1),
(5, 1, 'Sparta - Buldok', 'Plánovaný', '2025-05-11 00:30:00', 100, 50, 'Sparta-Buldok-2025-05-11-1562c8b9b51ef11f', 1),
(6, 1, '<script>alert(\"ahoj\");</script>', 'Plánovaný', '2026-12-12 12:12:00', 100, 50, '-script-alert-ahoj-script-2026-12-12-8d1374ba08a8688b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `entrance_id` int(11) NOT NULL,
  `sold_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_multi` tinyint(1) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `football_match_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `entrance_id`, `sold_at`, `is_multi`, `owner_id`, `football_match_id`, `type`, `price`, `confirmed`) VALUES
(19, 1, '2024-05-31 10:29:10', 0, 1, 4, 'child', 50, 1),
(20, 1, '2024-05-31 10:29:10', 0, 1, 4, 'child', 50, 1),
(21, 1, '2024-05-31 10:29:10', 0, 1, 4, 'child', 50, 1),
(25, 1, '2024-05-31 10:33:56', 0, 1, 4, 'adult', 100, 1),
(26, 1, '2024-05-31 10:33:56', 0, 1, 4, 'adult', 100, 1),
(27, 1, '2024-05-31 11:57:22', 0, 1, 5, 'adult', 100, 1),
(28, 1, '2024-05-31 11:57:22', 0, 1, 5, 'adult', 100, 1),
(29, 1, '2024-05-31 11:57:22', 0, 1, 5, 'adult', 100, 1),
(30, 1, '2024-05-31 11:57:22', 0, 1, 5, 'adult', 100, 1),
(31, 1, '2024-05-31 11:57:22', 0, 1, 5, 'adult', 100, 1),
(32, 1, '2024-05-31 11:57:22', 0, 1, 5, 'child', 50, 1),
(33, 1, '2024-05-31 11:57:22', 0, 1, 5, 'child', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`) VALUES
(1, 'a@a.a', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$gO8dulMUQkU/bAlaulMeU.6RGJLZS4WroY/gYZGSaqCOij6kJleWu', 'Martin', 'Růžek'),
(2, 'b@b.b', '[\"ROLE_USER\"]', '$2y$13$cHlbWMZLP7BF/r2FfUoele6D6igEJSNgNQJGV0yCrC1hZkJza9y02', 'Martin', 'Růžek'),
(3, 'f@f.f', '[\"ROLE_USER\"]', '$2y$13$.RxSiTW5/CnF.p7xSdORT.9EkVLl3JpEX3OaV/iBMRwIcEHtcwbMi', 'fake', 'ucet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `entrance`
--
ALTER TABLE `entrance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `football_match`
--
ALTER TABLE `football_match`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8CE33ACEB03A8386` (`created_by_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97A0ADA392458494` (`entrance_id`),
  ADD KEY `IDX_97A0ADA37E3C61F9` (`owner_id`),
  ADD KEY `IDX_97A0ADA3E1DA134D` (`football_match_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entrance`
--
ALTER TABLE `entrance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `football_match`
--
ALTER TABLE `football_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `football_match`
--
ALTER TABLE `football_match`
  ADD CONSTRAINT `FK_8CE33ACEB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_97A0ADA37E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_97A0ADA392458494` FOREIGN KEY (`entrance_id`) REFERENCES `entrance` (`id`),
  ADD CONSTRAINT `FK_97A0ADA3E1DA134D` FOREIGN KEY (`football_match_id`) REFERENCES `football_match` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
