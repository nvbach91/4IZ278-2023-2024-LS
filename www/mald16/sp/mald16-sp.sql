-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 07. čen 2024, 11:18
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
-- Databáze: `mald16`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `organizations`
--

INSERT INTO `organizations` (`org_id`, `org_name`) VALUES
(11, 'Google Studios'),
(12, 'VŠE Studio'),
(13, 'Parkhole Records'),
(15, '123');

-- --------------------------------------------------------

--
-- Struktura tabulky `org_services`
--

CREATE TABLE `org_services` (
  `service_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `org_services`
--

INSERT INTO `org_services` (`service_id`, `org_id`, `service_name`) VALUES
(18, 11, 'Pre-produkce'),
(19, 11, 'Produkce'),
(20, 12, 'Produkce'),
(21, 12, 'Mixing'),
(22, 13, 'Wasting people&#039;s time'),
(23, 13, 'Making people angry'),
(24, 12, 'Další službu'),
(25, 11, '123');

-- --------------------------------------------------------

--
-- Struktura tabulky `org_users`
--

CREATE TABLE `org_users` (
  `org_user_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `org_users`
--

INSERT INTO `org_users` (`org_user_id`, `org_id`, `email`, `role`) VALUES
(37, 11, 'davidmalasek@post.cz', 3),
(38, 11, 'producent@vse.cz', 2),
(39, 11, 'klient@vse.cz', 1),
(40, 12, 'producent@vse.cz', 3),
(41, 12, 'klient@vse.cz', 2),
(42, 12, 'davidmalasek@post.cz', 1),
(43, 12, 'mald16@vse.cz', 1),
(44, 13, 'nvbach91@gmail.com', 3),
(45, 13, 'nguv03@vse.cz', 2),
(46, 13, 'nguv04@vse.cz', 1),
(47, 13, 'nguv05@vse.cz', 1),
(48, 11, 'd@m.cz', 1),
(49, 11, 'mald16@vse.cz', 2),
(50, 12, 'dalsi.klient@vse.cz', 1),
(51, 12, 'dalsi.producent@vse.cz', 2),
(54, 15, 'producent@vse.cz', 3),
(55, 15, 'klient@vse.cz', 2),
(56, 15, 'mald16@vse.cz', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `producer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `songs`
--

INSERT INTO `songs` (`song_id`, `org_id`, `date`, `name`, `client`, `producer`) VALUES
(63, 12, '2024-06-05', 'Skladba č. 1', 42, 41),
(65, 12, '2024-06-05', 'Beat it', 42, 41),
(66, 12, '2024-06-05', 'Hip To Be Square', 43, 41),
(67, 13, '2024-06-05', 'Test', 47, 45),
(68, 13, '2024-06-05', 'Jump out of the window', 46, 45),
(69, 13, '2024-06-05', 'test', 46, 45),
(70, 12, '2024-06-06', 'Nová skladba', 43, 41),
(71, 11, '2024-06-07', 'test 123', 39, 38),
(72, 12, '2024-06-07', 'Beat it', 50, 51),
(73, 11, '2024-06-07', 'Objednávka 1', 39, 49),
(74, 11, '2024-06-07', 'Objednávka 123', 39, 38),
(75, 11, '2024-06-07', 'asdasd', 39, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `song_services`
--

CREATE TABLE `song_services` (
  `song_service_id` int(11) NOT NULL,
  `org_service_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `finish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `song_services`
--

INSERT INTO `song_services` (`song_service_id`, `org_service_id`, `song_id`, `state`, `finish_date`) VALUES
(115, 20, 63, 0, NULL),
(118, 20, 65, 0, NULL),
(121, 21, 66, 1, '2024-06-05'),
(123, 23, 68, 0, NULL),
(124, 22, 67, 1, '2024-06-05'),
(125, 23, 67, 1, '2024-06-05'),
(127, 22, 69, 2, '2024-06-05'),
(128, 23, 69, 2, '2024-06-05'),
(131, 20, 70, 1, '2024-06-06'),
(132, 21, 70, 1, '2024-06-06'),
(134, 18, 71, 1, '2024-06-07'),
(135, 20, 72, 0, NULL),
(139, 18, 73, 0, '2024-06-07'),
(140, 19, 73, 1, '2024-06-07'),
(142, 18, 74, 1, '2024-06-07'),
(143, 19, 74, 0, '2024-06-07'),
(144, 18, 75, 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `notif_opt_in` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `notif_opt_in`) VALUES
('d@m.cz', NULL, NULL, NULL),
('dalsi.klient@vse.cz', NULL, NULL, NULL),
('dalsi.producent@vse.cz', NULL, NULL, NULL),
('davidmalasek@post.cz', NULL, 'David Malášek přes Google', 1),
('klient@vse.cz', '$2y$10$cQDquxf3yo0vDwc7AEwTSOH1P/ok90zRxhXkoWH3yx.wkw.EPrt0i', 'Petr Klient', 1),
('mald16@vse.cz', '$2y$10$W8U7p4G0Ds7ozl3Fly6iD.EQMDQvmayO2ZTz1ighi8VUzCMN421P2', 'David Malášek', 1),
('nahodny.pan@vse.cz', NULL, NULL, NULL),
('nguv03@vse.cz', '$2y$10$6Nz0R.1XepMESVO7fqx0Ne6mFtfTRUlhnStBwpQS/N2RZRGuW83q6', 'Tester client', NULL),
('nguv04@vse.cz', '$2y$10$K36e063s5DwguPwskk0Ul.HmXSvzFIaP/NYU.HL2w4FJRSRutVLnW', 'test nguv04', 0),
('nguv05@vse.cz', NULL, NULL, NULL),
('nvbach91@gmail.com', NULL, 'Nguyen Viet Bach', NULL),
('producent@vse.cz', '$2y$10$5ddt0WE7SQq4F4kA0SfZMeKqvxzhMvjK5nche36.SasiVg06WDf7i', 'Jake The Producent', 1),
('random@vse.cz', NULL, NULL, NULL),
('viet.nguyen@vse.cz', '$2y$10$IpHpiYjEjf2qN9LEJ1xqROowy1IawOD.CCOHTaos1KFFtlDJKfIZq', 'Testtt', NULL);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexy pro tabulku `org_services`
--
ALTER TABLE `org_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexy pro tabulku `org_users`
--
ALTER TABLE `org_users`
  ADD PRIMARY KEY (`org_user_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `email` (`email`);

--
-- Indexy pro tabulku `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `client` (`client`),
  ADD KEY `producer` (`producer`);

--
-- Indexy pro tabulku `song_services`
--
ALTER TABLE `song_services`
  ADD PRIMARY KEY (`song_service_id`),
  ADD KEY `org_service_id` (`org_service_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `org_services`
--
ALTER TABLE `org_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pro tabulku `org_users`
--
ALTER TABLE `org_users`
  MODIFY `org_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pro tabulku `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pro tabulku `song_services`
--
ALTER TABLE `song_services`
  MODIFY `song_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `org_services`
--
ALTER TABLE `org_services`
  ADD CONSTRAINT `org_services_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`);

--
-- Omezení pro tabulku `org_users`
--
ALTER TABLE `org_users`
  ADD CONSTRAINT `org_users_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`),
  ADD CONSTRAINT `org_users_ibfk_2` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Omezení pro tabulku `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`org_id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`client`) REFERENCES `org_users` (`org_user_id`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`producer`) REFERENCES `org_users` (`org_user_id`);

--
-- Omezení pro tabulku `song_services`
--
ALTER TABLE `song_services`
  ADD CONSTRAINT `song_services_ibfk_1` FOREIGN KEY (`org_service_id`) REFERENCES `org_services` (`service_id`),
  ADD CONSTRAINT `song_services_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
