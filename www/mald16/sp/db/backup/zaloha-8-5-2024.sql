-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Stř 08. kvě 2024, 17:39
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
-- Databáze: `mald16-sp`
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
(1, 'RoseStreet Studio'),
(2, 'Supraphon'),
(8, 'Testovací organizace');

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
(1, 1, 'Produkce'),
(2, 1, 'Mixing'),
(3, 1, 'Mastering'),
(15, 1, 'Distribuce'),
(20, 2, 'Služba 1');

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
(1, 1, 'd@m.cz', 2),
(2, 1, 'jnekovar17@gmail.com', 2),
(3, 1, 'petr@mara.cz', 2),
(4, 1, 'mald16@vse.cz', 1),
(5, 2, 'd@m.cz', 2),
(6, 8, 'd@m.cz', 3),
(7, 8, 'mald16@vse.cz', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `songs`
--

CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `producer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `songs`
--

INSERT INTO `songs` (`song_id`, `org_id`, `date`, `name`, `client`, `producer`) VALUES
(1, 1, '2024-05-01', 'Ty Říkáš', 'mald16@vse.cz', 'd@m.cz'),
(7, 1, '2024-05-07', 'Omlouvám se ti', 'jnekovar17@gmail.com', 'd@m.cz'),
(10, 1, '2024-05-07', 'Test', 'jnekovar17@gmail.com', 'petr@mara.cz'),
(14, 2, '2024-05-08', 'Test', NULL, 'd@m.cz');

-- --------------------------------------------------------

--
-- Struktura tabulky `song_services`
--

CREATE TABLE `song_services` (
  `org_service_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `finish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `song_services`
--

INSERT INTO `song_services` (`org_service_id`, `song_id`, `state`, `finish_date`) VALUES
(1, 1, 0, NULL),
(2, 1, 0, NULL);

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
('d@m.cz', '$2y$10$ZkH.Dhapfl1U624NNUPHuOleRzz6Zo48F3KFHTJUkhxQpHIEFJUV6', 'David Malášek', NULL),
('davidmalasek@post.cz', '$2y$10$q/I2bZOJBqQhVN7jiwKmxunN9FWC/HfLxoy8BUyghZWsrkQxTKr7W', 'Mejv', NULL),
('jirka.kosor@gmail.com', '$2y$10$Q2viyY9xbDxw2XQg5Wm3pewuCSVGuInUELw3k02DS9X.MypgtVmBa', 'Ing. Jiří Doležal', NULL),
('jnekovar17@gmail.com', '$2y$10$ic4UjMfcjQg6DSg0s9R2HOHviRaY50CIHTUWouAjfUcKcUYP5.RMa', 'Jiří Nekovář', NULL),
('mald16@vse.cz', '$2y$10$0DvYcgwc9Us0p1i8Z3DCEealTH/Cchm2Emv4omZFE01Da2tnxBaCC', 'Dejv', 1),
('petr@mara.cz', '$2y$10$pbFnpqDODG1LYJ9y.IcnsOEjAzTFtHYT/Xu6mnFaGib.OjsA5s8Om', 'Petr Mára', NULL),
('tim.cook@apple.cz', '$2y$10$LOPue9zISMklpdR0aIu5LeK892Y.oM/iuMt1KJixQVKa9OypltYT2', 'Tim Cook', NULL);

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
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `org_services`
--
ALTER TABLE `org_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pro tabulku `org_users`
--
ALTER TABLE `org_users`
  MODIFY `org_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`client`) REFERENCES `org_users` (`email`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`producer`) REFERENCES `org_users` (`email`);

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
