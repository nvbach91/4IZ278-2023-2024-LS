-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Počítač: md405.wedos.net:3306
-- Vygenerováno: Pát 14. čen 2024, 12:56
-- Verze serveru: 10.4.31-MariaDB-log
-- Verze PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `d341941_spot`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `spot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `text` text DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `spot_id` (`spot_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=151 ;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`comment_id`, `spot_id`, `user_id`, `username`, `date`, `text`) VALUES
(33, 39, 19, 'User8', '2024-06-11 20:54:26', 'ahohj'),
(37, 20, 19, 'User8', '2024-06-11 22:11:19', 'ahoj vino'),
(38, 20, 19, 'User8', '2024-06-11 22:13:21', 'ahoj vino2'),
(39, 20, 19, 'User8', '2024-06-11 22:55:38', 'ahoj3'),
(40, 20, 19, 'User8', '2024-06-11 22:56:52', 'ahoj4'),
(41, 20, 19, 'User8', '2024-06-11 22:57:53', 'ahoj5'),
(42, 20, 19, 'User8', '2024-06-11 22:59:59', 'ahoj6'),
(43, 20, 19, 'User8', '2024-06-11 23:08:59', 'ahoj7'),
(44, 20, 19, 'User8', '2024-06-11 23:10:47', 'ahoj8'),
(45, 20, 19, 'User8', '2024-06-11 23:10:52', 'ahoj9'),
(50, 40, 19, 'User8', '2024-06-12 12:41:09', 'sasa'),
(51, 40, 19, 'User8', '2024-06-12 12:47:09', 'sasa'),
(52, 20, 19, 'User8', '2024-06-12 12:49:28', '10'),
(53, 20, 19, 'User8', '2024-06-12 12:53:11', '12'),
(54, 20, 19, 'User8', '2024-06-12 13:06:26', '13'),
(55, 20, 19, 'User8', '2024-06-12 13:08:29', '14'),
(56, 20, 19, 'User8', '2024-06-12 13:08:58', '15'),
(57, 20, 19, 'User8', '2024-06-12 13:10:39', '16'),
(58, 20, 19, 'User8', '2024-06-12 13:12:25', '17'),
(59, 20, 19, 'User8', '2024-06-12 13:24:06', '18'),
(60, 20, 19, 'User8', '2024-06-12 13:27:40', '19'),
(61, 20, 19, 'User8', '2024-06-12 13:29:29', '20'),
(62, 20, 19, 'User8', '2024-06-12 13:31:11', '21'),
(63, 20, 19, 'User8', '2024-06-12 13:32:13', 'helou1'),
(64, 20, 19, 'User8', '2024-06-12 13:34:35', 'helou2'),
(65, 20, 19, 'User8', '2024-06-12 13:38:09', 'helou3'),
(74, 20, 19, 'User8', '2024-06-12 16:11:33', 'fsfsd'),
(75, 20, 19, 'User8', '2024-06-12 16:12:12', 'dfsadsadsa'),
(76, 20, 19, 'User8', '2024-06-12 16:12:55', 'gfdgdf'),
(77, 20, 19, 'User8', '2024-06-12 16:17:28', 'sasa'),
(78, 20, 19, 'User8', '2024-06-12 16:19:00', 'sasad'),
(79, 20, 19, 'User8', '2024-06-12 16:30:13', 'fsdjiojioasf'),
(80, 20, 19, 'User8', '2024-06-12 16:31:22', 'gffg'),
(81, 20, 19, 'User8', '2024-06-12 16:33:00', 'ds'),
(82, 20, 19, 'User8', '2024-06-12 16:34:58', 'fdfd'),
(83, 20, 19, 'User8', '2024-06-12 16:36:05', 'sasa'),
(84, 20, 19, 'User8', '2024-06-12 16:39:21', 'sa'),
(85, 20, 19, 'User8', '2024-06-12 16:42:21', 'hn'),
(86, 20, 19, 'User8', '2024-06-12 16:46:16', 'gffgfg'),
(89, 49, 19, 'User8', '2024-06-12 20:07:13', 'hej'),
(90, 49, 19, 'User8', '2024-06-12 20:13:16', 'ahoj'),
(91, 49, 19, 'User8', '2024-06-13 10:43:18', 'ahoj2'),
(94, 49, 19, 'User8', '2024-06-13 13:37:59', 'sasa'),
(95, 49, 19, 'User8', '2024-06-13 13:38:07', '<script>console.log(123)</script>'),
(96, 49, 19, 'User8', '2024-06-13 13:38:31', '<script>console.log(123)</script>'),
(97, 49, 19, 'User8', '2024-06-13 13:38:48', 'sad'),
(98, 49, 19, 'User8', '2024-06-13 13:38:55', 'sad'),
(99, 49, 19, 'User8', '2024-06-13 13:39:02', '<script>console.log(123)</script>'),
(100, 49, 19, 'User8', '2024-06-13 13:40:54', '<script>console.log(123)</script>'),
(101, 49, 19, 'User8', '2024-06-13 13:41:20', '<script>console.log(12saaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa3)</script>'),
(145, 68, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', '2024-06-14 11:28:38', 'normální spot'),
(147, 71, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', '2024-06-14 12:07:49', '&lt;img src onrerror=&quot;alert(&#039;hacked&#039;)&quot;/&gt;'),
(148, 71, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', '2024-06-14 12:07:51', '&lt;img src onrerror=&quot;alert(&#039;hacked&#039;)&quot;/&gt;'),
(150, 71, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', '2024-06-14 12:12:45', 'dadada');

-- --------------------------------------------------------

--
-- Struktura tabulky `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `spot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `spot_id` (`spot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `likes`
--

INSERT INTO `likes` (`spot_id`, `user_id`, `date`) VALUES
(20, 13, '2024-06-06 15:20:37'),
(20, 19, '2024-06-11 19:56:20'),
(39, 19, '2024-06-13 13:19:41'),
(71, 29, '2024-06-14 12:55:54');

-- --------------------------------------------------------

--
-- Struktura tabulky `spots`
--

CREATE TABLE IF NOT EXISTS `spots` (
  `spot_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coordinatesX` double DEFAULT NULL,
  `coordinatesY` double DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`spot_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=73 ;

--
-- Vypisuji data pro tabulku `spots`
--

INSERT INTO `spots` (`spot_id`, `user_id`, `username`, `title`, `description`, `coordinatesX`, `coordinatesY`, `category`, `image_id`, `created_at`) VALUES
(20, 13, 'User5', 'vino', '', 14.445929918103616, 50.07202852750399, 'vyhlidka,rybnik,,,', NULL, '2024-06-06 15:20:14'),
(30, 19, 'User8', 'Jesenice', 'sasa', 14.514405573008958, 49.973755993272874, 'vyhlidka,,ohniste,,', 'abfd25c516dbfe073cd86e5cbb3701d7.png', '2024-06-11 16:46:18'),
(32, 19, 'User8', 'uuuuvalys', 'sasa', 14.744156772812062, 50.087367357240396, ',,ohniste,zricenina,', NULL, '2024-06-11 16:58:54'),
(33, 19, 'User8', 'čelákovice', 'sasa', 14.716046322963962, 50.18357040527647, 'vyhlidka,rybnik,,,', '63b8a8b1620e40d3db85d0e26e196e14.png', '2024-06-11 17:33:38'),
(34, 19, 'User8', 'host', 'sasa', 14.191943021455927, 50.072867000656714, 'vyhlidka,rybnik,,,', 'd112b143a12dcccb6a0788990b75c187.png', '2024-06-11 17:34:33'),
(35, 19, 'User8', 'kladno', 'sasa', 14.169794876800893, 50.12833658998838, 'vyhlidka,rybnik,,,', 'afdc4dde704659238266d813ba4aa402.png', '2024-06-11 17:40:59'),
(36, 19, 'User8', 'brandýs', 'sasa', 14.554007525103543, 50.1977116017749, 'vyhlidka,rybnik,,,', '6ee46119c7c0d6eebb5a530d6048b0e0.png', '2024-06-11 17:41:55'),
(37, 19, 'User8', 'salny', 'slsls', 14.13299005096269, 50.229104649745324, '1,1,,,', '3ca88e64f5f7648cd6b1748b0a2b98f9.png', '2024-06-11 17:43:14'),
(38, 19, 'User8', 'praha', 'sasa', 14.541715776095089, 50.036194174911884, '1,1,,,', 'adff6c059ee881d097d91ddd25ec7ab0.png', '2024-06-11 17:44:52'),
(39, 19, 'User8', 'plzend', 'dsdsds', 13.347902623836376, 49.81534999635565, ',1,1,,', '5f9f16782a4b9fcbb57156d49e089701.png', '2024-06-11 17:46:11'),
(40, 19, 'User8', 'horni briza', '', 13.35345521591205, 49.84755895965304, '1,1,,,', '44e5f0195e70fdc7ff3b1cf0d27c79c5.png', '2024-06-11 17:46:43'),
(49, 19, 'User8', 'kaznějov', '', 13.386487149003642, 49.9023552520604, ',,,,', NULL, '2024-06-12 19:36:16'),
(50, 19, 'User8', 'mělník', 'V mělníku je to fakt hezký', 14.529050130743599, 50.348656651107575, 'vyhlidka,rybnik,,,', '255b8c0d438f80339c83a2747b6a1f10.jpg', '2024-06-13 16:30:57'),
(51, 19, 'User8', 'mladá boleslav', 'mladá boleslav je mladá', 14.8713172162918, 50.41523597880672, 'ohniste,,,,', '34c311b7edb4e91d3c4da8ce2487f5f4.jpg', '2024-06-13 16:34:25'),
(52, 19, 'User8', 'neprsi', '', 14.537332747107712, 50.03966527396099, 'zricenina,,,,', 'ff7c8c03a7499d601d69a75cebb86b56.jpg', '2024-06-13 20:02:51'),
(59, 27, 'tester', 'pankrac', 'ppp', 14.432489138336905, 50.04843079993887, ',rybnik,,,', NULL, '2024-06-14 10:46:18'),
(68, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', 'normální spot', 'normální spot', 14.355349141297552, 49.97934206950356, 'vyhlidka,rybnik,,,', '3bb6c1f91d3cf8776a8d9a3a6b1baf76.jpg', '2024-06-14 11:28:25'),
(71, 29, '&amp;lt;img src onrerror=&amp;quot;alert(&amp;#039;hacked&amp;#039;)&amp;quot;/&amp;gt;', '&lt;img src onrerror=&quot;alert(&#039;hacked&#039;)&quot;/&gt;', '&lt;img src onrerror=&quot;alert(&#039;hacked&#039;)&quot;/&gt;', 14.3455788595287, 50.17823209291069, 'vyhlidka,rybnik,,,', '3fe594480a0fae60e42b353c393b9f35.png', '2024-06-14 12:07:45');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `privilege` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=30 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `privilege`) VALUES
(2, 'user1', '$2y$10$Hj/.iantTTRPK8FuEVBKneorcnHGq4rV2UoA2Hk36LCerNkELC/qO', 'a.auzky1@gmail.com', 0),
(3, 'user2', '$2y$10$aOk6MGsRpUHwNzqR/hFgKeZ.7MEAJCi8kr7e5CnCtYOVxY4MFX7zq', 'a.auzky2@gmail.com', 0),
(5, 'user3', '$2y$10$W2oygalQHpiCBgZrtobDnOUFjKCBCODoakTS3j.ZcRtpAVWki1.BO', 'a.auzky3@gmail.com', 0),
(9, 'kostak', NULL, 'kostak.minecraft@gmail.com', 0),
(13, 'User5', '$2y$10$AoYIp9Xw2Duhc7I.wd5LKuOG.gtVFPhzLVJdtjobrl7O5OXdYY8m6', 'a.auzky5@gmail.com', 0),
(17, 'User6', '$2y$10$uPTkJTHqaGTptJ9rzcNdYelIa1J0xrOFwiVR4TZd47mWod6gOfAWC', 'a.auzky6@gmail.com', 0),
(18, 'User7', '$2y$10$KRbZSgyZ3FElRRirVZdL9ePiI3gYT7JCxMsruOVehUUCP2cy28ClW', 'a.auzky7@gmail.com', 0),
(19, 'User8', '$2y$10$ymEP0qsQHT1RJ/LNlwxAXu3ATqhFCj8owzl8URSj7TrqHblRSZFuK', 'a.auzky8@gmail.com', 1),
(20, 'User9', '$2y$10$CTtuOmkP2BByzB7tVxN9MuQRbG7dmxE5mods9nQAQ.Y0D4e.Smhmq', 'a.auzky9@gmail.com', 0),
(27, 'tester', '$2y$10$O8B.Wift0e94LF5G1PzDfeVwvqmxjnC8DbZkZ3sjVWVFYPf15Utom', 'nguv03@vse.cz', 0),
(29, '&lt;img src onrerror=&quot;alert(&#039;hacked&#039;)&quot;/&gt;', NULL, 'a.auzky@gmail.com', 0);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `spots`
--
ALTER TABLE `spots`
  ADD CONSTRAINT `spots_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
