-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 14. čen 2024, 15:39
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `becultureal`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `advertizer`
--

CREATE TABLE `advertizer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `profile_picture` longblob DEFAULT NULL,
  `header_picture` longblob DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'hello',
  `bank_code` varchar(20) DEFAULT NULL,
  `account_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `advertizer`
--

INSERT INTO `advertizer` (`id`, `name`, `address`, `description`, `created`, `profile_picture`, `header_picture`, `username`, `password`, `bank_code`, `account_number`) VALUES
(26, 'aa', 'aa', 'aa', '2024-06-12 00:02:33', NULL, NULL, 'a@a.cz', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', '2010', '2301448588'),
(27, 'asdf', '', '', '2024-06-12 00:47:54', NULL, NULL, 'i', 'de7d1b721a1e0632b7cf04edf5032c8ecffa9f9a08492152b926f1a5a7e765d7', NULL, NULL),
(30, '', '', '', '2024-06-12 03:00:05', NULL, NULL, 'asdf', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b', NULL, NULL),
(36, 'Miriam Zedníčková', '', '', '2024-06-14 12:08:16', NULL, NULL, 'miri', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', NULL, NULL),
(37, '', '', '', '2024-06-14 12:24:42', NULL, NULL, 'e@e.cz', '3f79bb7b435b05321651daefd374cdc681dc06faa65e374e38337b88ca046dea', '2010', '12354612');

-- --------------------------------------------------------

--
-- Struktura tabulky `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `birth_year` date DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `customer`
--

INSERT INTO `customer` (`id`, `name`, `created`, `email`, `birth_year`, `password`) VALUES
(35, 'AAA', '2024-06-12', 'a@a.cz', '2024-06-20', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb'),
(36, 'e', '2024-06-12', 'e@e.cz', '2024-06-04', '3f79bb7b435b05321651daefd374cdc681dc06faa65e374e38337b88ca046dea'),
(37, 'Miriam Zedníčková', '2024-06-12', 'mitcamit@gmail.com', '2024-06-28', '3f3b08eca62c21d76256e6e1d0b8bf99f4efbe376f64335b72f4163a8fc50dba'),
(40, 'A', '2024-06-12', 'ASDF@ADSF', '2024-06-26', '559aead08264d5795d3909718cdd05abd49572e84fe55590eef31a88a08fdffd'),
(41, 'ei', '2024-06-12', 'e@i.cz', '2024-06-20', '39d633dc9cf015fb99ef4bc11351e02f55f37397c9017f1f7cefe05c08493aeb'),
(42, '', '2024-06-14', 'mitcamit@g', '2024-06-15', '9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0');

-- --------------------------------------------------------

--
-- Struktura tabulky `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `cancelled` tinyint(1) DEFAULT NULL,
  `type` enum('concert','theatre','entertainment','dance','other') DEFAULT NULL,
  `picture` text DEFAULT NULL,
  `special_offer_percetage` float DEFAULT NULL,
  `special_offer_end` datetime DEFAULT NULL,
  `special_offer_start` datetime DEFAULT NULL,
  `advertizer_id` int(11) NOT NULL,
  `price` float(6,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `event`
--

INSERT INTO `event` (`id`, `name`, `address`, `time`, `description`, `capacity`, `cancelled`, `type`, `picture`, `special_offer_percetage`, `special_offer_end`, `special_offer_start`, `advertizer_id`, `price`) VALUES
(64, 'udalost', 'asdf', '2024-06-27 12:23:00', 'asdfsd', 12, NULL, 'theatre', '', NULL, NULL, NULL, 26, 12.00),
(65, 'hello', 'asdf', '2024-06-06 12:25:00', 'asdf', 0, NULL, 'concert', '', NULL, NULL, NULL, 37, 0.00),
(66, 'nova udalost', '123asdf', '2024-06-12 12:52:00', 'asdf', 12, NULL, 'concert', '', NULL, NULL, NULL, 26, 12.00),
(67, 'tady', 'asdf', '2024-06-21 13:15:00', '', 12, NULL, 'concert', '', NULL, NULL, NULL, 26, 20.00);

-- --------------------------------------------------------

--
-- Struktura tabulky `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `paid` datetime DEFAULT NULL,
  `confirmed` datetime DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `ticket`
--

INSERT INTO `ticket` (`id`, `price`, `event_id`, `customer_id`, `paid`, `confirmed`, `code`) VALUES
(32, NULL, 65, 35, '2024-06-14 12:39:44', NULL, '0'),
(37, NULL, 64, 35, '2024-06-14 12:51:17', NULL, NULL),
(38, NULL, 66, 35, '2024-06-14 12:52:28', NULL, NULL),
(39, NULL, 67, 35, '2024-06-14 13:19:00', NULL, NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `advertizer`
--
ALTER TABLE `advertizer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`username`) USING BTREE;

--
-- Indexy pro tabulku `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexy pro tabulku `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertizer` (`advertizer_id`);

--
-- Indexy pro tabulku `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `ticket_ibfk_1` (`event_id`),
  ADD KEY `ticket_ibfk_2` (`customer_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `advertizer`
--
ALTER TABLE `advertizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pro tabulku `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pro tabulku `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pro tabulku `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `advertizer` FOREIGN KEY (`advertizer_id`) REFERENCES `advertizer` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
