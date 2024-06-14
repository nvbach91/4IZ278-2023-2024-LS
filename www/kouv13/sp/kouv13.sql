-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 14. čen 2024, 14:30
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
-- Databáze: `kouv13`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `fields`
--

CREATE TABLE `fields` (
  `field_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `fields`
--

INSERT INTO `fields` (`field_id`, `name`, `description`, `capacity`, `price`, `img`) VALUES
(1, 'Hala 12', 'Hala je vybavená sítí, ideální je tedy pro tenis, nohejbal, dá se zde hrát i volejbal.', 6, 600, 'tenis.webp'),
(2, 'Hala 2', 'Ideální proastor pro Házenou, florbal nebo sálový fotbal.', 25, 3000, 'florbal.webp'),
(3, 'Hala 3', 'Boxerský ring jako strvořený pro začátečníky i profíky.', 4, 1000, 'box.webp'),
(4, 'Hala 4', 'Basketballová hala vybavená nastavitelnými koši.', 30, 3500, 'basket.webp');

-- --------------------------------------------------------

--
-- Struktura tabulky `field_sport`
--

CREATE TABLE `field_sport` (
  `id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `field_sport`
--

INSERT INTO `field_sport` (`id`, `sport_id`, `field_id`) VALUES
(2, 1, 1),
(71, 2, 2),
(1, 2, 4),
(5, 3, 2),
(3, 4, 1),
(4, 5, 1),
(6, 6, 2),
(8, 8, 3),
(7, 9, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `field_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `day` varchar(2) NOT NULL,
  `status` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status_change` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `sport_id`, `field_id`, `user_id`, `date`, `time`, `day`, `status`, `price`, `status_change`, `created_at`) VALUES
(231, 5, 1, 5, '2024-06-09', '14:00:00', 'ne', 1, 600, '2024-06-08 22:17:43', '2024-06-08 22:17:43'),
(232, 5, 1, 5, '2024-06-09', '15:00:00', 'ne', 5, 600, '2024-06-08 22:17:43', '2024-06-08 22:17:43'),
(233, 5, 1, 5, '2024-06-09', '16:00:00', 'ne', 5, 600, '2024-06-08 22:17:43', '2024-06-08 22:17:43'),
(234, 8, 3, 5, '2024-06-09', '13:00:00', 'ne', 5, 1000, '2024-06-08 22:26:36', '2024-06-08 22:26:36'),
(235, 8, 3, 5, '2024-06-09', '14:00:00', 'ne', 5, 1000, '2024-06-08 22:26:37', '2024-06-08 22:26:37'),
(236, 2, 4, 5, '2024-06-10', '09:00:00', 'po', 5, 3500, '2024-06-09 09:27:38', '2024-06-09 09:27:38'),
(237, 2, 4, 5, '2024-06-10', '10:00:00', 'po', 5, 3500, '2024-06-09 09:27:38', '2024-06-09 09:27:38'),
(238, 2, 4, 5, '2024-06-10', '11:00:00', 'po', 5, 3500, '2024-06-09 09:27:38', '2024-06-09 09:27:38'),
(239, 6, 2, 5, '2024-06-10', '09:00:00', 'po', 5, 3000, '2024-06-09 09:43:27', '2024-06-09 09:43:27'),
(240, 6, 2, 5, '2024-06-10', '10:00:00', 'po', 5, 3000, '2024-06-09 09:43:27', '2024-06-09 09:43:27'),
(241, 6, 2, 5, '2024-06-10', '11:00:00', 'po', 5, 3000, '2024-06-09 09:43:27', '2024-06-09 09:43:27'),
(242, 5, 1, 5, '2024-06-09', '11:00:00', 'ne', 1, 600, '2024-06-09 11:03:11', '2024-06-09 11:03:11'),
(243, 5, 1, 5, '2024-06-09', '12:00:00', 'ne', 1, 600, '2024-06-09 11:03:11', '2024-06-09 11:03:11'),
(244, 5, 1, 5, '2024-06-09', '13:00:00', 'ne', 1, 600, '2024-06-09 11:03:11', '2024-06-09 11:03:11'),
(245, 3, 2, 8, '2024-06-11', '15:00:00', 'ut', 1, 3000, '2024-06-09 11:04:26', '2024-06-09 11:04:26'),
(246, 3, 2, 8, '2024-06-12', '19:00:00', 'st', 1, 3000, '2024-06-09 11:04:26', '2024-06-09 11:04:26'),
(247, 3, 2, 8, '2024-06-13', '19:00:00', 'ct', 1, 3000, '2024-06-09 11:04:26', '2024-06-09 11:04:26'),
(248, 3, 2, 8, '2024-06-16', '19:00:00', 'ne', 1, 3000, '2024-06-09 11:04:26', '2024-06-09 11:04:26'),
(249, 5, 1, 8, '2024-06-09', '09:00:00', 'ne', 1, 600, '2024-06-09 11:04:39', '2024-06-09 11:04:39'),
(250, 5, 1, 8, '2024-06-09', '10:00:00', 'ne', 1, 600, '2024-06-09 11:04:39', '2024-06-09 11:04:39'),
(251, 5, 1, 8, '2024-06-09', '12:00:00', 'ne', 1, 600, '2024-06-09 11:04:39', '2024-06-09 11:04:39'),
(252, 8, 3, 8, '2024-06-10', '11:00:00', 'po', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(253, 8, 3, 8, '2024-06-10', '12:00:00', 'po', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(254, 8, 3, 8, '2024-06-11', '11:00:00', 'ut', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(255, 8, 3, 8, '2024-06-11', '12:00:00', 'ut', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(256, 8, 3, 8, '2024-06-11', '13:00:00', 'ut', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(257, 8, 3, 8, '2024-06-12', '11:00:00', 'st', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(258, 8, 3, 8, '2024-06-12', '12:00:00', 'st', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(259, 8, 3, 8, '2024-06-12', '13:00:00', 'st', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(260, 8, 3, 8, '2024-06-12', '14:00:00', 'st', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(261, 8, 3, 8, '2024-06-13', '14:00:00', 'ct', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(262, 8, 3, 8, '2024-06-14', '16:00:00', 'pa', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(263, 8, 3, 8, '2024-06-15', '17:00:00', 'so', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(264, 8, 3, 8, '2024-06-16', '18:00:00', 'ne', 1, 1000, '2024-06-09 11:06:24', '2024-06-09 11:06:24'),
(265, 8, 3, 1, '2024-06-09', '20:00:00', 'ne', 1, 1000, '2024-06-09 15:27:47', '2024-06-09 15:27:47'),
(266, 8, 3, 1, '2024-06-09', '21:00:00', 'ne', 5, 1000, '2024-06-09 15:27:47', '2024-06-09 15:27:47'),
(267, 5, 1, 1, '2024-06-09', '15:00:00', 'ne', 1, 600, '2024-06-09 15:35:17', '2024-06-09 15:35:17'),
(268, 5, 1, 1, '2024-06-09', '16:00:00', 'ne', 1, 600, '2024-06-09 15:35:17', '2024-06-09 15:35:17'),
(269, 5, 1, 1, '2024-06-09', '17:00:00', 'ne', 2, 600, '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(270, 5, 1, 1, '2024-06-09', '18:00:00', 'ne', 2, 600, '2024-06-09 15:39:48', '2024-06-09 15:39:48'),
(271, 5, 1, 1, '2024-06-09', '19:00:00', 'ne', 2, 600, '2024-06-09 15:40:01', '2024-06-09 15:40:01'),
(272, 2, 4, 1, '2024-06-09', '19:00:00', 'ne', 2, 3500, '2024-06-09 18:04:06', '2024-06-09 18:04:06'),
(273, 2, 4, 1, '2024-06-09', '20:00:00', 'ne', 2, 3500, '2024-06-09 18:04:06', '2024-06-09 18:04:06'),
(274, 2, 4, 1, '2024-06-09', '21:00:00', 'ne', 2, 3500, '2024-06-09 18:04:07', '2024-06-09 18:04:07'),
(275, 2, 4, 5, '2024-06-09', '17:00:00', 'ne', 1, 3500, '2024-06-09 18:05:44', '2024-06-09 18:05:44'),
(276, 2, 4, 5, '2024-06-09', '18:00:00', 'ne', 1, 3500, '2024-06-09 18:05:44', '2024-06-09 18:05:44'),
(277, 5, 1, 5, '2024-06-10', '10:00:00', 'po', 5, 600, '2024-06-10 13:13:51', '2024-06-10 13:13:51'),
(278, 5, 1, 5, '2024-06-10', '11:00:00', 'po', 1, 600, '2024-06-10 13:13:51', '2024-06-10 13:13:51'),
(279, 8, 12, 1, '2024-06-12', '15:00:00', 'st', 2, 1, '2024-06-10 14:03:59', '2024-06-10 14:03:59'),
(280, 8, 12, 1, '2024-06-13', '12:00:00', 'ct', 2, 1, '2024-06-10 14:03:59', '2024-06-10 14:03:59'),
(281, 8, 12, 1, '2024-06-14', '15:00:00', 'pa', 2, 1, '2024-06-10 14:03:59', '2024-06-10 14:03:59'),
(282, 2, 13, 1, '2024-06-11', '12:00:00', 'ut', 2, 212, '2024-06-10 14:10:38', '2024-06-10 14:10:38'),
(283, 2, 13, 1, '2024-06-13', '13:00:00', 'ct', 2, 212, '2024-06-10 14:10:38', '2024-06-10 14:10:38'),
(284, 2, 13, 1, '2024-06-13', '15:00:00', 'ct', 2, 212, '2024-06-10 14:10:38', '2024-06-10 14:10:38'),
(285, 2, 14, 1, '2024-06-10', '13:00:00', 'po', 2, 1, '2024-06-10 14:49:03', '2024-06-10 14:49:03'),
(286, 2, 14, 1, '2024-06-11', '13:00:00', 'ut', 2, 1, '2024-06-10 14:49:03', '2024-06-10 14:49:03'),
(287, 2, 14, 1, '2024-06-13', '13:00:00', 'ct', 2, 1, '2024-06-10 14:49:03', '2024-06-10 14:49:03'),
(288, 1, 1, 1, '2024-06-12', '12:00:00', 'st', 5, 600, '2024-06-10 15:31:30', '2024-06-10 15:03:57'),
(289, 1, 1, 1, '2024-06-14', '12:00:00', 'pa', 5, 600, '2024-06-14 09:11:33', '2024-06-10 15:03:57'),
(290, 1, 1, 1, '2024-06-16', '13:00:00', 'ne', 5, 600, '2024-06-14 09:11:39', '2024-06-10 15:03:57'),
(291, 5, 1, 1, '2024-06-10', '10:00:00', 'po', 5, 600, '2024-06-10 21:48:15', '2024-06-10 21:48:03'),
(292, 5, 1, 1, '2024-06-10', '21:00:00', 'po', 2, 600, '2024-06-10 21:59:25', '2024-06-10 21:59:25'),
(293, 8, 3, 5, '2024-06-12', '17:00:00', 'st', 5, 1000, '2024-06-11 00:10:13', '2024-06-10 22:04:59'),
(294, 2, 4, 1, '2024-07-25', '17:00:00', 'ct', 5, 3500, '2024-06-11 10:53:17', '2024-06-10 22:05:17'),
(295, 3, 2, 5, '2024-06-11', '16:00:00', 'ut', 5, 3000, '2024-06-11 00:02:01', '2024-06-10 23:07:04'),
(296, 3, 2, 5, '2024-06-11', '17:00:00', 'ut', 5, 3000, '2024-06-11 00:02:03', '2024-06-10 23:55:31'),
(297, 3, 2, 5, '2024-06-11', '18:00:00', 'ut', 5, 3000, '2024-06-11 10:43:28', '2024-06-10 23:55:31'),
(298, 3, 2, 5, '2024-06-12', '17:00:00', 'st', 1, 3000, '2024-06-11 00:00:14', '2024-06-11 00:00:14'),
(299, 3, 2, 5, '2024-06-12', '18:00:00', 'st', 5, 3000, '2024-06-11 00:10:11', '2024-06-11 00:00:14'),
(300, 2, 4, 5, '2024-06-11', '15:00:00', 'ut', 5, 3500, '2024-06-11 00:10:14', '2024-06-11 00:01:21'),
(301, 2, 4, 5, '2024-06-12', '15:00:00', 'st', 5, 3500, '2024-06-11 10:43:34', '2024-06-11 00:01:21'),
(302, 3, 2, 5, '2024-06-11', '13:00:00', 'ut', 5, 3000, '2024-06-11 10:36:07', '2024-06-11 00:02:07'),
(303, 3, 2, 1, '2024-06-11', '17:00:00', 'ut', 2, 3000, '2024-06-11 00:04:29', '2024-06-11 00:04:29'),
(304, 2, 4, 5, '2024-06-11', '17:00:00', 'ut', 5, 3500, '2024-06-11 10:43:26', '2024-06-11 00:04:38'),
(305, 3, 2, 5, '2024-06-11', '14:00:00', 'ut', 5, 3000, '2024-06-11 10:36:10', '2024-06-11 00:07:00'),
(306, 8, 3, 5, '2024-06-12', '16:00:00', 'st', 1, 1000, '2024-06-11 00:10:19', '2024-06-11 00:10:19'),
(307, 8, 3, 5, '2024-06-11', '16:00:00', 'ut', 5, 1000, '2024-06-11 10:43:21', '2024-06-11 00:13:10'),
(308, 8, 3, 5, '2024-06-11', '18:00:00', 'ut', 5, 1000, '2024-06-11 10:43:30', '2024-06-11 00:13:48'),
(309, 8, 3, 1, '2024-06-11', '14:00:00', 'ut', 2, 1000, '2024-06-11 00:14:39', '2024-06-11 00:14:39'),
(310, 8, 3, 5, '2024-06-11', '17:00:00', 'ut', 5, 1000, '2024-06-11 10:43:24', '2024-06-11 00:14:47'),
(311, 8, 3, 5, '2024-06-14', '17:00:00', 'pa', 1, 1000, '2024-06-11 00:15:06', '2024-06-11 00:15:06'),
(312, 8, 3, 5, '2024-06-12', '17:00:00', 'st', 1, 1000, '2024-06-11 00:15:20', '2024-06-11 00:15:20'),
(313, 2, 4, 5, '2024-06-11', '16:00:00', 'ut', 5, 3500, '2024-06-11 10:43:23', '2024-06-11 00:16:05'),
(314, 2, 4, 5, '2024-06-11', '18:00:00', 'ut', 5, 3500, '2024-06-11 10:43:31', '2024-06-11 00:19:30'),
(315, 2, 4, 5, '2024-06-11', '19:00:00', 'ut', 5, 3500, '2024-06-11 10:43:32', '2024-06-11 00:21:26'),
(316, 3, 2, 5, '2024-06-14', '20:00:00', 'pa', 1, 3000, '2024-06-11 10:43:11', '2024-06-11 10:43:11'),
(317, 3, 2, 5, '2024-06-16', '20:00:00', 'ne', 1, 3000, '2024-06-11 10:43:11', '2024-06-11 10:43:11'),
(318, 3, 2, 5, '2024-06-24', '17:00:00', 'po', 1, 3000, '2024-06-11 10:43:43', '2024-06-11 10:43:43'),
(319, 3, 2, 5, '2024-06-24', '18:00:00', 'po', 1, 3000, '2024-06-11 10:43:43', '2024-06-11 10:43:43'),
(320, 3, 2, 5, '2024-06-24', '19:00:00', 'po', 1, 3000, '2024-06-11 10:43:43', '2024-06-11 10:43:43'),
(321, 3, 2, 5, '2024-06-24', '20:00:00', 'po', 1, 3000, '2024-06-11 10:43:43', '2024-06-11 10:43:43'),
(322, 1, 1, 5, '2024-06-13', '14:00:00', 'ct', 1, 600, '2024-06-11 10:47:06', '2024-06-11 10:47:06'),
(323, 10, 15, 1, '2024-07-16', '17:00:00', 'ut', 2, 312313, '2024-06-11 10:52:31', '2024-06-11 10:52:31'),
(324, 11, 10, 11, '2024-06-11', '20:00:00', 'ut', 1, 2000, '2024-06-11 10:58:14', '2024-06-11 10:58:14'),
(325, 11, 10, 11, '2024-06-12', '17:00:00', 'st', 1, 2000, '2024-06-11 10:59:01', '2024-06-11 10:59:01'),
(326, 11, 10, 11, '2024-06-12', '19:00:00', 'st', 1, 2000, '2024-06-11 10:59:18', '2024-06-11 10:59:18'),
(327, 11, 10, 11, '2024-06-11', '15:00:00', 'ut', 1, 2000, '2024-06-11 11:00:59', '2024-06-11 11:00:59'),
(328, 11, 10, 11, '2024-06-12', '15:00:00', 'st', 1, 2000, '2024-06-11 11:00:59', '2024-06-11 11:00:59'),
(329, 11, 10, 11, '2024-06-13', '15:00:00', 'ct', 1, 2000, '2024-06-11 11:00:59', '2024-06-11 11:00:59'),
(330, 3, 2, 11, '2024-06-11', '13:00:00', 'ut', 1, 3000, '2024-06-11 11:01:43', '2024-06-11 11:01:43'),
(331, 3, 2, 11, '2024-06-11', '14:00:00', 'ut', 1, 3000, '2024-06-11 11:01:43', '2024-06-11 11:01:43'),
(332, 3, 2, 11, '2024-06-11', '16:00:00', 'ut', 1, 3000, '2024-06-11 11:07:00', '2024-06-11 11:07:00'),
(333, 3, 2, 11, '2024-06-12', '16:00:00', 'st', 1, 3000, '2024-06-11 11:07:19', '2024-06-11 11:07:19'),
(334, 3, 2, 11, '2024-06-11', '12:00:00', 'ut', 1, 3000, '2024-06-11 11:07:39', '2024-06-11 11:07:39'),
(335, 3, 2, 11, '2024-06-11', '18:00:00', 'ut', 1, 3000, '2024-06-11 11:08:57', '2024-06-11 11:08:57'),
(336, 3, 2, 11, '2024-06-11', '11:00:00', 'ut', 1, 3000, '2024-06-11 11:09:16', '2024-06-11 11:09:16'),
(337, 3, 2, 11, '2024-06-12', '11:00:00', 'st', 1, 3000, '2024-06-11 11:09:16', '2024-06-11 11:09:16'),
(338, 8, 3, 11, '2024-06-11', '15:00:00', 'ut', 1, 1000, '2024-06-11 11:11:36', '2024-06-11 11:11:36'),
(339, 2, 4, 11, '2024-06-11', '17:00:00', 'ut', 1, 3500, '2024-06-11 11:11:44', '2024-06-11 11:11:44'),
(340, 2, 4, 11, '2024-06-12', '17:00:00', 'st', 1, 3500, '2024-06-11 11:11:44', '2024-06-11 11:11:44'),
(341, 2, 4, 11, '2024-06-13', '17:00:00', 'ct', 1, 3500, '2024-06-11 11:11:44', '2024-06-11 11:11:44'),
(342, 2, 4, 11, '2024-06-11', '18:00:00', 'ut', 1, 3500, '2024-06-11 11:18:44', '2024-06-11 11:18:44'),
(343, 2, 4, 11, '2024-06-11', '16:00:00', 'ut', 1, 3500, '2024-06-11 11:48:26', '2024-06-11 11:48:26'),
(344, 2, 4, 11, '2024-06-11', '19:00:00', 'ut', 1, 3500, '2024-06-11 11:49:02', '2024-06-11 11:49:02'),
(345, 2, 4, 11, '2024-06-11', '20:00:00', 'ut', 1, 3500, '2024-06-11 11:49:02', '2024-06-11 11:49:02'),
(346, 2, 4, 11, '2024-06-11', '21:00:00', 'ut', 1, 3500, '2024-06-11 11:49:02', '2024-06-11 11:49:02'),
(347, 5, 1, 12, '2024-06-12', '09:00:00', 'st', 5, 600, '2024-06-11 13:33:27', '2024-06-11 13:33:14'),
(348, 8, 3, 13, '2024-06-12', '18:00:00', 'st', 5, 1000, '2024-06-12 20:55:36', '2024-06-12 20:55:27'),
(349, 9, 2, 13, '2024-06-16', '09:00:00', 'ne', 1, 3000, '2024-06-12 20:56:11', '2024-06-12 20:56:11'),
(350, 8, 3, 13, '2024-06-13', '18:00:00', 'ct', 1, 1000, '2024-06-12 20:59:31', '2024-06-12 20:59:31'),
(351, 8, 3, 13, '2024-06-30', '21:00:00', 'ne', 1, 1000, '2024-06-12 20:59:52', '2024-06-12 20:59:52'),
(352, 8, 3, 13, '2024-06-24', '09:00:00', 'po', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(353, 8, 3, 13, '2024-06-24', '10:00:00', 'po', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(354, 8, 3, 13, '2024-06-25', '09:00:00', 'ut', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(355, 8, 3, 13, '2024-06-25', '10:00:00', 'ut', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(356, 8, 3, 13, '2024-06-26', '09:00:00', 'st', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(357, 8, 3, 13, '2024-06-26', '10:00:00', 'st', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(358, 8, 3, 13, '2024-06-27', '09:00:00', 'ct', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(359, 8, 3, 13, '2024-06-27', '10:00:00', 'ct', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(360, 8, 3, 13, '2024-06-28', '09:00:00', 'pa', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(361, 8, 3, 13, '2024-06-28', '10:00:00', 'pa', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(362, 8, 3, 13, '2024-06-29', '09:00:00', 'so', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(363, 8, 3, 13, '2024-06-29', '10:00:00', 'so', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(364, 8, 3, 13, '2024-06-30', '09:00:00', 'ne', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(365, 8, 3, 13, '2024-06-30', '10:00:00', 'ne', 1, 1000, '2024-06-12 21:00:19', '2024-06-12 21:00:19'),
(366, 5, 1, 13, '2024-06-12', '09:00:00', 'st', 1, 600, '2024-06-12 21:06:59', '2024-06-12 21:06:59'),
(367, 5, 1, 15, '2024-06-13', '15:00:00', 'ct', 5, 600, '2024-06-13 08:40:06', '2024-06-13 08:39:52'),
(368, 10, 16, 1, '2024-06-13', '14:00:00', 'ct', 2, 1000, '2024-06-13 10:07:41', '2024-06-13 10:07:41'),
(369, 10, 16, 1, '2024-06-15', '19:00:00', 'so', 2, 1000, '2024-06-13 10:07:44', '2024-06-13 10:07:44'),
(370, 8, 3, 1, '2024-06-14', '18:00:00', 'pa', 2, 1000, '2024-06-13 23:28:40', '2024-06-13 23:28:40'),
(371, 3, 2, 11, '2024-06-14', '13:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(372, 3, 2, 11, '2024-06-14', '14:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(373, 3, 2, 11, '2024-06-14', '15:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(374, 3, 2, 11, '2024-06-14', '16:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(375, 3, 2, 11, '2024-06-14', '17:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(376, 3, 2, 11, '2024-06-14', '18:00:00', 'pa', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(377, 3, 2, 11, '2024-06-15', '13:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(378, 3, 2, 11, '2024-06-15', '14:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(379, 3, 2, 11, '2024-06-15', '15:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(380, 3, 2, 11, '2024-06-15', '16:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(381, 3, 2, 11, '2024-06-15', '17:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(382, 3, 2, 11, '2024-06-15', '18:00:00', 'so', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(383, 3, 2, 11, '2024-06-16', '13:00:00', 'ne', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(384, 3, 2, 11, '2024-06-16', '14:00:00', 'ne', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(385, 3, 2, 11, '2024-06-16', '15:00:00', 'ne', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(386, 3, 2, 11, '2024-06-16', '16:00:00', 'ne', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(387, 3, 2, 11, '2024-06-16', '17:00:00', 'ne', 1, 3000, '2024-06-13 23:29:32', '2024-06-13 23:29:32'),
(388, 3, 2, 11, '2024-06-16', '18:00:00', 'ne', 5, 3000, '2024-06-14 12:01:47', '2024-06-13 23:29:32'),
(389, 3, 2, 11, '2024-06-14', '19:00:00', 'pa', 1, 3000, '2024-06-13 23:30:52', '2024-06-13 23:30:52'),
(390, 3, 2, 11, '2024-06-15', '19:00:00', 'so', 1, 3000, '2024-06-13 23:30:52', '2024-06-13 23:30:52'),
(391, 11, 17, 11, '2024-06-14', '19:00:00', 'pa', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(392, 11, 17, 11, '2024-06-14', '20:00:00', 'pa', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(393, 11, 17, 11, '2024-06-14', '21:00:00', 'pa', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(394, 11, 17, 11, '2024-06-15', '19:00:00', 'so', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(395, 11, 17, 11, '2024-06-15', '20:00:00', 'so', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(396, 11, 17, 11, '2024-06-15', '21:00:00', 'so', 1, 1500, '2024-06-13 23:31:11', '2024-06-13 23:31:11'),
(397, 11, 17, 11, '2024-06-14', '13:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(398, 11, 17, 11, '2024-06-14', '14:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(399, 11, 17, 11, '2024-06-14', '15:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(400, 11, 17, 11, '2024-06-14', '16:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(401, 11, 17, 11, '2024-06-14', '17:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(402, 11, 17, 11, '2024-06-14', '18:00:00', 'pa', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(403, 11, 17, 11, '2024-06-15', '15:00:00', 'so', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(404, 11, 17, 11, '2024-06-15', '16:00:00', 'so', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(405, 11, 17, 11, '2024-06-15', '17:00:00', 'so', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(406, 11, 17, 11, '2024-06-15', '18:00:00', 'so', 1, 1500, '2024-06-13 23:31:21', '2024-06-13 23:31:21'),
(407, 8, 3, 1, '2024-06-14', '09:00:00', 'pa', 5, 1000, '2024-06-14 09:09:13', '2024-06-13 23:33:30'),
(408, 8, 3, 1, '2024-06-14', '10:00:00', 'pa', 5, 1000, '2024-06-14 09:11:29', '2024-06-13 23:33:30'),
(409, 8, 3, 1, '2024-06-14', '11:00:00', 'pa', 5, 1000, '2024-06-14 09:11:31', '2024-06-13 23:33:30'),
(410, 8, 3, 1, '2024-06-14', '12:00:00', 'pa', 5, 1000, '2024-06-14 09:11:34', '2024-06-13 23:33:30'),
(411, 8, 3, 1, '2024-06-14', '13:00:00', 'pa', 2, 1000, '2024-06-13 23:33:30', '2024-06-13 23:33:30'),
(412, 8, 3, 1, '2024-06-14', '14:00:00', 'pa', 2, 1000, '2024-06-13 23:33:30', '2024-06-13 23:33:30'),
(413, 8, 3, 1, '2024-06-15', '14:00:00', 'so', 5, 1000, '2024-06-14 09:11:36', '2024-06-13 23:33:30'),
(414, 8, 3, 1, '2024-06-15', '15:00:00', 'so', 5, 1000, '2024-06-14 09:11:37', '2024-06-13 23:33:30'),
(415, 8, 3, 1, '2024-06-15', '16:00:00', 'so', 2, 1000, '2024-06-13 23:33:30', '2024-06-13 23:33:30'),
(416, 8, 3, 1, '2024-06-16', '15:00:00', 'ne', 5, 1000, '2024-06-14 09:11:41', '2024-06-13 23:33:30'),
(417, 8, 3, 1, '2024-06-16', '16:00:00', 'ne', 5, 1000, '2024-06-14 09:11:42', '2024-06-13 23:33:30'),
(418, 8, 3, 1, '2024-06-16', '17:00:00', 'ne', 5, 1000, '2024-06-14 09:11:43', '2024-06-13 23:33:30'),
(419, 11, 17, 11, '2024-06-15', '09:00:00', 'so', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(420, 11, 17, 11, '2024-06-15', '10:00:00', 'so', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(421, 11, 17, 11, '2024-06-15', '11:00:00', 'so', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(422, 11, 17, 11, '2024-06-15', '12:00:00', 'so', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(423, 11, 17, 11, '2024-06-16', '09:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(424, 11, 17, 11, '2024-06-16', '10:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(425, 11, 17, 11, '2024-06-16', '11:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(426, 11, 17, 11, '2024-06-16', '12:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(427, 11, 17, 11, '2024-06-16', '13:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(428, 11, 17, 11, '2024-06-16', '14:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(429, 11, 17, 11, '2024-06-16', '15:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(430, 11, 17, 11, '2024-06-16', '16:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(431, 11, 17, 11, '2024-06-16', '17:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(432, 11, 17, 11, '2024-06-16', '18:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(433, 11, 17, 11, '2024-06-16', '19:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(434, 11, 17, 11, '2024-06-16', '20:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(435, 11, 17, 11, '2024-06-16', '21:00:00', 'ne', 1, 1500, '2024-06-13 23:33:48', '2024-06-13 23:33:48'),
(436, 4, 1, 1, '2024-06-14', '13:00:00', 'pa', 2, 600, '2024-06-13 23:53:20', '2024-06-13 23:53:20'),
(437, 9, 2, 11, '2024-06-14', '21:00:00', 'pa', 1, 3000, '2024-06-13 23:53:42', '2024-06-13 23:53:42'),
(438, 13, 20, 1, '2024-06-14', '09:00:00', 'pa', 2, 3113, '2024-06-13 23:55:27', '2024-06-13 23:55:27'),
(439, 2, 1, 11, '2024-06-14', '10:00:00', 'pa', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(440, 2, 1, 11, '2024-06-14', '11:00:00', 'pa', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(441, 2, 1, 11, '2024-06-14', '12:00:00', 'pa', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(442, 2, 1, 11, '2024-06-15', '09:00:00', 'so', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(443, 2, 1, 11, '2024-06-15', '10:00:00', 'so', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(444, 2, 1, 11, '2024-06-15', '11:00:00', 'so', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(445, 2, 1, 11, '2024-06-15', '12:00:00', 'so', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(446, 2, 1, 11, '2024-06-15', '13:00:00', 'so', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(447, 2, 1, 11, '2024-06-16', '09:00:00', 'ne', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(448, 2, 1, 11, '2024-06-16', '10:00:00', 'ne', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(449, 2, 1, 11, '2024-06-16', '11:00:00', 'ne', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(450, 2, 1, 11, '2024-06-16', '12:00:00', 'ne', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(451, 2, 1, 11, '2024-06-16', '13:00:00', 'ne', 1, 600, '2024-06-14 09:37:00', '2024-06-14 09:37:00'),
(452, 3, 2, 17, '2024-06-14', '11:00:00', 'pa', 1, 3000, '2024-06-14 09:38:15', '2024-06-14 09:38:15'),
(453, 3, 2, 17, '2024-06-14', '12:00:00', 'pa', 1, 3000, '2024-06-14 09:38:15', '2024-06-14 09:38:15'),
(454, 3, 2, 17, '2024-06-15', '11:00:00', 'so', 1, 3000, '2024-06-14 09:38:15', '2024-06-14 09:38:15'),
(455, 2, 2, 1, '2024-06-15', '20:00:00', 'so', 2, 3000, '2024-06-14 11:56:49', '2024-06-14 11:56:49'),
(456, 2, 2, 1, '2024-06-15', '21:00:00', 'so', 2, 3000, '2024-06-14 11:56:49', '2024-06-14 11:56:49'),
(457, 2, 4, 1, '2024-06-14', '12:00:00', 'pa', 2, 3500, '2024-06-14 11:56:57', '2024-06-14 11:56:57'),
(458, 2, 4, 1, '2024-06-14', '13:00:00', 'pa', 2, 3500, '2024-06-14 11:56:57', '2024-06-14 11:56:57'),
(459, 2, 4, 1, '2024-06-14', '14:00:00', 'pa', 5, 3500, '2024-06-14 12:21:55', '2024-06-14 11:56:57'),
(460, 1, 1, 1, '2024-07-15', '19:00:00', 'po', 2, 600, '2024-06-14 11:57:09', '2024-06-14 11:57:09'),
(461, 5, 1, 11, '2024-06-14', '14:00:00', 'pa', 1, 600, '2024-06-14 12:01:06', '2024-06-14 12:01:06'),
(462, 8, 3, 1, '2024-07-11', '17:00:00', 'ct', 5, 1000, '2024-06-14 12:17:28', '2024-06-14 12:01:58'),
(463, 6, 2, 1, '2024-06-15', '12:00:00', 'so', 5, 3000, '2024-06-14 12:17:34', '2024-06-14 12:09:12'),
(464, 6, 2, 1, '2024-06-16', '12:00:00', 'ne', 5, 3000, '2024-06-14 12:16:34', '2024-06-14 12:09:12');

-- --------------------------------------------------------

--
-- Struktura tabulky `sports`
--

CREATE TABLE `sports` (
  `sport_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `sports`
--

INSERT INTO `sports` (`sport_id`, `name`) VALUES
(1, 'Volejbal'),
(2, 'Basketball'),
(3, 'Florbal'),
(4, 'Tenis'),
(5, 'Nohejbal'),
(6, 'Házená'),
(7, 'Ping-Pong'),
(8, 'Box'),
(9, 'Sálový fotbal'),
(10, 'Baseball'),
(11, 'Hokej'),
(12, 'Lakros'),
(13, 'Kriket'),
(14, 'Lazergame'),
(15, 'Lazergame'),
(16, 'Test'),
(17, 'Lední hokej'),
(18, 'dawudh');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Administrátor', 'admin@mojehala.cz', '$2y$10$YbSgRkk5EmaoWh9r7IihgOZ5mEYyKvgp3dVi//JNw3S76hjDDtaYW', '2024-06-09 11:41:19'),
(5, 'Vojta dl', 'vojta@koubek.cz', '$2y$10$NN4FuwDVq24jbRvAz1qmCuSrFzniPdQk93XPb002BL/gZvXwP6E.i', '2024-06-11 10:46:46'),
(6, 'Vojta dl', 'vojta2@koubek.cz', '$2y$10$uNH7Xlb7gi0JY7ke3RpZY.aRkR4jAbWE225MWnoatocXObfn/F9my', '2024-06-08 19:49:18'),
(7, 'adwad', 'vojta1221@koubek.cz', '$2y$10$LIM3z3kyBqzT/8n4Y3NRmes.C9D.tzD2Jd9plG4g0Lytgfn6v6Du.', '2024-06-08 22:39:13'),
(8, 'Adam Mastná', 'adam@mastna.cz', '$2y$10$rD6Z4q4CwG2FAZ2w5xrhXeXYzle3vM/voxe409QhDD/nVEXC2Ybmy', '2024-06-09 11:04:10'),
(9, 'add', 'vojta@kouaaabek.cz', '$2y$10$YbSgRkk5EmaoWh9r7IihgOZ5mEYyKvgp3dVi//JNw3S76hjDDtaYW', '2024-06-09 11:29:01'),
(11, 'Vojtěch Koubek VŠE', 'kouv13@vse.cz', '$2y$10$fuLGMcso7QijUlLHB/eAQugnsHF1lrqQIXlpFvuRUwc1TkX.8hS9C', '2024-06-14 12:01:29'),
(12, 'visitor', 'nahodnyemail@centrum.cz', '$2y$10$EMNyq4IvOm5Wwt/BFE0G3umG23WHb3t5RHE/D3lkIr000Zc2M8z1q', '2024-06-11 13:32:28'),
(13, 'nguv03@vse.cz', 'nguv03@vse.cz', '$2y$10$8zwg4BkSVlBJwP7bB9in3OkRtupFV1GOwGDq.zIryTc8.ui7R3cI.', '2024-06-12 20:52:14'),
(14, 'nguv04@vse.cz', 'nguv04@vse.cz', '$2y$10$JRrXYQCDjKWIqgVkr.G0YeKUjBegQxeUzhqjNEdJym4eZtMARmHEu', '2024-06-12 20:52:32'),
(15, 'Bob', 'bob@bob.bob', '$2y$10$7pIL5FR6lVFsB.uEyTjXJ.vqgEFZiVDSZ8tHpqhW5sNvq4UFdeKnC', '2024-06-13 08:39:28'),
(16, 'awdawd', 'kouv13@njuac.cz', '$2y$10$Suz1y.O7jykOlBs9XCPeoeWCyopA/7lgUdaEV2Jutzoac2ezgQTj2', '2024-06-13 22:28:37'),
(17, 'Vojtěch Koubek', 'koko@ch.cz', '$2y$10$QO52wb4yriHMhxMC.S0qV.QiihngUVvtUwpUztx8cvzMsxFC2rInK', '2024-06-14 09:35:13');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexy pro tabulku `field_sport`
--
ALTER TABLE `field_sport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_id` (`sport_id`,`field_id`),
  ADD KEY `field_sport_ibfk_2` (`field_id`);

--
-- Indexy pro tabulku `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `sport_id` (`sport_id`,`field_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexy pro tabulku `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `fields`
--
ALTER TABLE `fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pro tabulku `field_sport`
--
ALTER TABLE `field_sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pro tabulku `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT pro tabulku `sports`
--
ALTER TABLE `sports`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `field_sport`
--
ALTER TABLE `field_sport`
  ADD CONSTRAINT `field_sport_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `field_sport_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fields` (`field_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`sport_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
