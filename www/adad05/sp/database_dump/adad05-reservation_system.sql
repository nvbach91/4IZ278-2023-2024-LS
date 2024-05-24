-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 24. kvě 2024, 13:26
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `reservation_system`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `association`
--

CREATE TABLE `association` (
  `reservation_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `association`
--

INSERT INTO `association` (`reservation_id`, `car_id`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(8, 2),
(8, 3),
(9, 3),
(15, 3),
(17, 1),
(17, 3),
(18, 2),
(20, 3),
(21, 1),
(22, 1),
(22, 2),
(23, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 3),
(28, 3),
(34, 1),
(36, 3),
(72, 1),
(76, 1),
(77, 1),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 4),
(83, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `capacity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `cars`
--

INSERT INTO `cars` (`car_id`, `model`, `capacity`) VALUES
(1, 'Škoda Octavia', 4),
(2, 'Škoda Fabia', 3),
(3, 'Škoda Rapid', 2),
(4, 'Mercedes', 7),
(7, 'Zkouška', 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `edits`
--

CREATE TABLE `edits` (
  `edit_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `car` int(10) NOT NULL,
  `last_edited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `edits`
--

INSERT INTO `edits` (`edit_id`, `date`, `car`, `last_edited`) VALUES
(1, '2024-05-18', 1, '2024-05-18 18:20:03'),
(2, '2024-05-18', 2, '2024-05-18 17:40:49'),
(3, '2024-05-18', 3, '2024-05-18 17:51:06'),
(4, '2024-05-05', 4, '2024-05-23 15:48:08'),
(5, '2024-05-05', 1, '2024-05-23 15:48:07'),
(6, '2024-05-23', 1, '2024-05-23 12:14:05'),
(7, '2024-05-05', 2, '2024-05-23 12:48:52'),
(8, '2024-06-02', 4, '2024-05-23 15:45:36'),
(9, '2024-06-02', 1, '2024-05-23 15:45:35'),
(10, '2024-06-02', 2, '2024-05-23 15:45:40'),
(11, '2024-06-09', 1, '2024-05-23 16:02:44'),
(12, '2024-06-09', 4, '2024-05-23 16:02:48'),
(13, '2024-06-09', 3, '2024-05-23 16:02:49'),
(14, '2024-05-24', 1, '2024-05-24 11:18:54'),
(15, '2024-05-24', 3, '2024-05-24 11:18:57'),
(16, '2024-06-01', 3, '2024-05-24 11:49:48'),
(17, '2024-07-19', 3, '2024-05-24 12:59:58'),
(18, '2024-10-18', 4, '2024-05-24 13:13:17'),
(19, '2024-10-18', 2, '2024-05-24 13:20:02');

-- --------------------------------------------------------

--
-- Struktura tabulky `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `name`, `address`) VALUES
(1, 'Majestic Prague', 'Truhlářská 18'),
(2, 'Grand Hotel', 'Klimentská 20'),
(3, 'Intercontinental', 'Pařížská 4'),
(4, 'Mega Hotel', 'Soukenická 7'),
(7, 'Asd', 'ASdasd');

-- --------------------------------------------------------

--
-- Struktura tabulky `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `booked_by` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `booked_by`, `date`, `time`) VALUES
(1, 1, '2024-05-05', 0),
(2, 1, '2024-05-05', 1),
(3, 1, '2024-05-06', 5),
(4, 1, '2024-05-05', 4),
(5, 2, '2024-05-05', 10),
(6, 1, '2024-05-05', 8),
(7, 1, '2024-05-09', 0),
(8, 1, '2024-05-09', 1),
(9, 1, '2024-05-09', 2),
(10, 1, '2024-05-09', 6),
(11, 1, '2024-05-09', 5),
(12, 1, '2024-05-09', 7),
(13, 1, '2024-05-05', 23),
(14, 1, '2024-05-09', 3),
(15, 1, '2024-05-05', 2),
(16, 1, '2024-05-05', 7),
(17, 1, '2024-05-09', 23),
(18, 1, '2024-05-09', 19),
(19, 1, '2024-05-09', 17),
(20, 1, '2024-05-05', 10),
(21, 1, '2024-05-13', 0),
(22, 1, '2024-05-14', 0),
(23, 1, '2024-05-14', 4),
(24, 2, '2024-05-14', 23),
(25, 2, '2024-05-14', 0),
(26, 2, '2024-05-14', 2),
(27, 2, '2024-05-14', 1),
(28, 2, '2024-05-14', 22),
(29, 2, '2024-05-15', 0),
(30, 2, '2024-05-14', 6),
(31, 2, '2024-05-05', 11),
(32, 2, '2024-05-05', 12),
(33, 2, '2024-05-05', 23),
(34, 5, '2024-05-15', 0),
(35, 5, '2024-05-15', 1),
(36, 5, '2024-05-15', 23),
(37, 6, '2024-05-15', 2),
(38, 6, '2024-05-15', 3),
(39, 5, '2024-05-16', 0),
(40, 5, '2024-05-18', 0),
(41, 6, '2024-05-18', 0),
(42, 6, '2024-05-18', 2),
(43, 6, '2024-05-18', 3),
(44, 5, '2024-05-18', 5),
(45, 6, '2024-05-18', 7),
(46, 5, '2024-05-18', 17),
(47, 5, '2024-05-18', 2),
(48, 5, '2024-05-18', 11),
(49, 6, '2024-05-18', 13),
(50, 5, '2024-05-18', 16),
(51, 5, '2024-05-18', 3),
(52, 6, '2024-05-18', 16),
(53, 6, '2024-05-05', 17),
(54, 6, '2024-05-05', 6),
(55, 5, '2024-05-23', 0),
(56, 5, '2024-05-23', 1),
(57, 5, '2024-05-05', 12),
(58, 5, '2024-05-05', 1),
(59, 6, '2024-05-05', 13),
(60, 6, '2024-05-05', 18),
(61, 6, '2024-05-05', 20),
(62, 6, '2024-06-02', 7),
(63, 6, '2024-06-02', 10),
(64, 6, '2024-06-02', 13),
(65, 6, '2024-06-02', 14),
(66, 6, '2024-05-05', 15),
(67, 6, '2024-05-05', 16),
(68, 6, '2024-06-09', 3),
(69, 6, '2024-06-09', 5),
(70, 6, '2024-06-09', 7),
(71, 6, '2024-06-09', 6),
(72, 7, '2024-05-24', 20),
(73, 7, '2024-05-24', 19),
(74, 7, '2024-05-24', 21),
(75, 8, '2024-05-24', 1),
(76, 7, '2024-05-24', 8),
(77, 7, '2024-05-24', 4),
(78, 8, '2024-05-24', 5),
(79, 6, '2024-06-01', 7),
(80, 6, '2024-06-01', 8),
(81, 6, '2024-07-19', 4),
(82, 6, '2024-10-18', 22),
(83, 6, '2024-10-18', 23),
(84, 6, '2024-10-18', 15);

-- --------------------------------------------------------

--
-- Struktura tabulky `time_blocks`
--

CREATE TABLE `time_blocks` (
  `time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `time_blocks`
--

INSERT INTO `time_blocks` (`time_id`) VALUES
(0),
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hotel` int(11) DEFAULT NULL,
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `hotel`, `privilege`) VALUES
(1, 'Daniel Adam', 'danadam@seznam.cz', '$2y$10$XvDh7RNcTyVnpo1QK/YftOLenw6keR63bQfG7t2VpKPoilg9aHd2u', 1, 1),
(2, 'Daniel Adam', 'pejsek@seznam.cz', '$2y$10$XvDh7RNcTyVnpo1QK/YftOLenw6keR63bQfG7t2VpKPoilg9aHd2u', 1, 1),
(4, 'Dan Adam', 'dan@seznam.cz', '$2y$10$XvDh7RNcTyVnpo1QK/YftOLenw6keR63bQfG7t2VpKPoilg9aHd2u', 3, 1),
(5, 'Dan Dan', 'adam@seznam.cz', '$2y$10$jAlBx.buQBhdCdDFo4/E7.o3sj/4Xw.30vJt0HAg6R.s8gU1tg/s6', 2, 2),
(6, 'Admin King', 'admin@seznam.cz', '$2y$10$mjp8hw2D4nAF7nJsZKWeU.wJRoJfi/T5t3S8o7xp6cJ8Y6ACCOdkq', NULL, 3),
(7, 'Dan Dan', 'danadam2001@seznam.cz', '$2y$10$I5L0qxqo5IszXpEMhK/4vOb5iuvU9m1/J9TAYTSE6PEPJo5pdYz5O', NULL, 2),
(8, 'Daniel Adam', 'dandan@seznam.cz', '$2y$10$6dSKKRbAdO/Fizu5e3KoXeUKlviLM7TYhFNVy5Jc0MfceJvbEFuFG', NULL, 2);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `association`
--
ALTER TABLE `association`
  ADD PRIMARY KEY (`reservation_id`,`car_id`) USING BTREE,
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexy pro tabulku `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexy pro tabulku `edits`
--
ALTER TABLE `edits`
  ADD PRIMARY KEY (`edit_id`),
  ADD KEY `car` (`car`);

--
-- Indexy pro tabulku `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexy pro tabulku `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `booked_by` (`booked_by`),
  ADD KEY `time` (`time`);

--
-- Indexy pro tabulku `time_blocks`
--
ALTER TABLE `time_blocks`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `hotel` (`hotel`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `edits`
--
ALTER TABLE `edits`
  MODIFY `edit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pro tabulku `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `association`
--
ALTER TABLE `association`
  ADD CONSTRAINT `association_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `association_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`);

--
-- Omezení pro tabulku `edits`
--
ALTER TABLE `edits`
  ADD CONSTRAINT `edits_ibfk_1` FOREIGN KEY (`car`) REFERENCES `cars` (`car_id`);

--
-- Omezení pro tabulku `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`booked_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`time`) REFERENCES `time_blocks` (`time_id`);

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`hotel`) REFERENCES `hotels` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
