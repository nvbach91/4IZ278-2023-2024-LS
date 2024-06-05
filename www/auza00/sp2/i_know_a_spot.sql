-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 05. čen 2024, 12:53
-- Verze serveru: 10.4.14-MariaDB
-- Verze PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `i_know_a_spot`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `spot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`comment_id`, `spot_id`, `user_id`, `username`, `date`, `text`) VALUES
(3, 7, 1, 'Admin', '2024-04-29 22:05:23', 'tadydadyda'),
(4, 7, 1, 'Admin', '2024-04-29 22:35:16', 'fdsfds'),
(5, 7, 1, 'Admin', '2024-04-29 22:35:20', 'fdsfdsfd'),
(6, 7, 1, 'Admin', '2024-04-29 22:35:25', 'fds'),
(7, 8, 1, 'Admin', '2024-06-04 16:01:03', 'ahoj tady koment od autora spotu'),
(8, 8, 2, 'user1', '2024-06-04 16:09:45', 'ahoj tady koment od uživatele'),
(9, 7, 6, 'user4', '2024-06-04 17:14:41', 'user4 koment'),
(10, 9, 6, 'user4', '2024-06-04 17:16:42', 'ahoj tady koment od autora'),
(11, 10, 6, 'user4', '2024-06-04 17:17:30', 'dadada'),
(12, 10, 6, 'user4', '2024-06-04 17:31:10', 'bhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm'),
(13, 10, 6, 'user4', '2024-06-04 17:57:37', 'random random random random random randomrandom random randomrandom random randomrandom random randomrandom random randomrandom random randomrandom random random'),
(14, 10, 6, 'user4', '2024-06-04 18:13:45', 'Hele fakt to je tady docela pekny, jenom si dávejte bacha na bxuaibnjkxa');

-- --------------------------------------------------------

--
-- Struktura tabulky `likes`
--

CREATE TABLE `likes` (
  `spot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `likes`
--

INSERT INTO `likes` (`spot_id`, `user_id`, `date`) VALUES
(7, 1, '2024-04-29 22:36:20'),
(7, 5, '2024-06-04 17:12:24'),
(8, 6, '2024-06-04 17:15:31'),
(9, 6, '2024-06-04 17:17:40'),
(10, 6, '2024-06-04 18:21:52');

-- --------------------------------------------------------

--
-- Struktura tabulky `spots`
--

CREATE TABLE `spots` (
  `spot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coordinatesX` double DEFAULT NULL,
  `coordinatesY` double DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `spots`
--

INSERT INTO `spots` (`spot_id`, `user_id`, `username`, `title`, `description`, `coordinatesX`, `coordinatesY`, `category`, `image_id`, `created_at`) VALUES
(7, 1, 'Admin', 'haha', '', 14.600269333528104, 50.02679373705624, 'vyhlidka,rybnik,,,', '08217fd6033a2d1cf1471bb04c6ba3d8.', '2024-04-29 21:27:50'),
(8, 1, 'Admin', 'pit', 'dasnjikdnasklcnmas', 14.576592208085344, 50.01822012522311, ',,ohniste,zricenina,', '7cc0c098fd2f803c63d2ba80c1b8ff45.jpg', '2024-04-29 22:37:00'),
(9, 6, 'user4', 'k dalnici', 'popisek1BZU8IObsdkl', 14.585910012841396, 50.017116178375005, 'vyhlidka,rybnik,ohniste,,', 'ec680e7288b6f2ec6ebd2bbae31def21.jpg', '2024-06-04 17:16:02'),
(10, 6, 'user4', 'panizkovasna', 'sasa magicarp', 14.585363691688599, 50.01487556570194, ',,,zricenina,pristresek', 'fdc626927197c7d1eca1addbca20c304.jpg', '2024-06-04 17:17:12');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Admin', '$2y$10$Cg5hBj5ln6VGQki0D8Ky6.sMHYDsbS6avHtb8GffdTApBCbOznCeK', 'a.auzky@gmail.com'),
(2, 'user1', '$2y$10$Hj/.iantTTRPK8FuEVBKneorcnHGq4rV2UoA2Hk36LCerNkELC/qO', 'a.auzky1@gmail.com'),
(3, 'user2', '$2y$10$aOk6MGsRpUHwNzqR/hFgKeZ.7MEAJCi8kr7e5CnCtYOVxY4MFX7zq', 'a.auzky2@gmail.com'),
(5, 'user3', '$2y$10$W2oygalQHpiCBgZrtobDnOUFjKCBCODoakTS3j.ZcRtpAVWki1.BO', 'a.auzky3@gmail.com'),
(6, 'user4', '$2y$10$kbtKW.xPLycjfTrOnENpVOK5S15oHKAcMl6HNEx4mIGasieqLqJIS', 'a.auzky4@gmail.com');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `spot_id` (`spot_id`);

--
-- Klíče pro tabulku `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `spot_id` (`spot_id`);

--
-- Klíče pro tabulku `spots`
--
ALTER TABLE `spots`
  ADD PRIMARY KEY (`spot_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pro tabulku `spots`
--
ALTER TABLE `spots`
  MODIFY `spot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `spots`
--
ALTER TABLE `spots`
  ADD CONSTRAINT `spots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
