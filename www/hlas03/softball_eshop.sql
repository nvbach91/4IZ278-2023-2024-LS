-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 07. čen 2024, 11:32
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
-- Databáze: `softball_eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `address`
--

INSERT INTO `address` (`address_id`, `street`, `city`, `zip_code`, `country`, `user_id`) VALUES
(6, 'aaaa', 'aaaaa', '123', 'sdfsd', 12),
(7, 'dsf', 'sdfsd', '323', 'dsfsd', 12),
(8, 'a', 'a', '23', 'w', NULL),
(9, 'a', 'a', '33', 'sdf', NULL),
(10, 'asdfgasd', 'asdfgds', '123', 'wefwed', NULL),
(11, 'df', 'dfsb', '21', 'wef', NULL),
(12, 'sdfb', 'sdfb', '32', 'sdfg', NULL),
(13, 'asdffads', 'sdafasd', '1321', 'afa', NULL),
(14, 'adfs', 'asdf', '123', 'sdf', NULL),
(15, 'adsf', 'asdf', '1234', 'sdf', NULL),
(16, 'ulice', 'Město', '12345', 'Česká republika', 18);

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(6, 'Boty'),
(3, 'Helmy'),
(7, 'Míče'),
(4, 'Oblečení'),
(2, 'Pálky'),
(1, 'Rukavice'),
(5, 'Tašky');

-- --------------------------------------------------------

--
-- Struktura tabulky `host_users`
--

CREATE TABLE `host_users` (
  `host_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `host_users`
--

INSERT INTO `host_users` (`host_user_id`, `first_name`, `last_name`, `email`, `phone`) VALUES
(7, 'asd', 'asdfasd', 'dasf@adsasdf.xf', '+420601492395'),
(8, 'asdf', 'asdf', 'dasf@aaddsdf.xf', '+420604491395');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_fee` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `shipping_price` int(11) NOT NULL,
  `host_user_id` int(11) DEFAULT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`order_id`, `status`, `created_at`, `user_id`, `payment_method_id`, `payment_fee`, `shipping_method_id`, `shipping_price`, `host_user_id`, `address_id`) VALUES
(29, 'active', '2024-06-05 03:06:17', 12, 1, 0, 2, 0, NULL, 6),
(35, 'active', '2024-06-05 03:53:32', 12, 2, 0, 2, 0, NULL, 13),
(37, 'active', '2024-06-05 04:28:58', NULL, 2, 0, 2, 0, 8, 15),
(38, 'active', '2024-06-07 02:20:12', 12, 2, 0, 2, 0, NULL, 6),
(39, 'active', '2024-06-07 07:24:59', 12, 2, 0, 2, 0, NULL, 6),
(40, 'active', '2024-06-07 07:50:20', 18, 1, 0, 1, 0, NULL, 16),
(41, 'active', '2024-06-07 08:06:49', 18, 2, 60, 2, 0, NULL, 16),
(42, 'active', '2024-06-07 08:14:11', 18, 2, 50, 2, 80, NULL, 16);

-- --------------------------------------------------------

--
-- Struktura tabulky `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `quantity`, `price`, `product_id`, `order_id`) VALUES
(21, 1, 160, 2, 29),
(22, 1, 160, 2, 35),
(23, 1, 160, 2, 37),
(24, 5, 1600, 8, 38),
(25, 3, 200, 1, 38),
(26, 1, 1200, 6, 38),
(27, 1, 200, 1, 39),
(28, 1, 1600, 7, 39),
(29, 6, 200, 1, 40),
(30, 1, 1200, 3, 40),
(31, 1, 1200, 3, 41),
(32, 1, 160, 2, 42);

-- --------------------------------------------------------

--
-- Struktura tabulky `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `name`, `fee`) VALUES
(1, 'Kreditní karta', 0),
(2, 'Dobírka', 50);

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `img_format` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `description`, `stock`, `img_format`) VALUES
(1, '8,5&Rawlings TVB - U7 + U8', 200, 'Baseballový flexiball míč Rawlings TVB.\r\n\r\nDoporučeno pro: baseball - flexiball - měkký míč pro děti.\r\n\r\nVelikost: 8,5&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;quot;\r\n\r\nMateriál: syntetický flexiball.', 0, 'jpg'),
(2, '9\" Rawlings R100-UPY', 160, 'Super odolný tréninkový gumový baseballový míč Rawlings R100-UPY.\r\n\r\n3x odolnější než klasický kožený míček.\r\n\r\nDoporučeno pro: baseball - mládež - pro trénink pálky.\r\n\r\nVelikost: 9\"\r\n\r\nMateriál: tvrzená guma.', 8, 'jpg'),
(3, '10\" Franklin 1000', 1200, 'Rukavice Franklin 1000.\r\n\r\nDoporučena pro: softball, baseball.\r\n\r\nVelikost: 10\".\r\n\r\nOrientační věk: cca 5-8 let.\r\n\r\nMateriál: vepřová kůže.\r\n\r\nRuka: na levou ruku (pro praváka), na pravou ruku (pro leváka).', 3, 'jpg'),
(5, '10\" Easton Havoc Youth', 1150, 'Rukavice Easton Havoc Youth.\r\n\r\nDoporučena pro: baseball, softball.\r\n\r\nVelikost: 10\"\r\n\r\nOrientační věk: 5-7 let.\r\n\r\nMateriál: vepřová kůže + syntetika.\r\n\r\nRuka: na levou ruku (pro praváka), na pravou ruku (pro leváka).', 5, 'jpg'),
(6, '2 1/4\" Easton Quantum Teeball 2023 -10', 1200, 'Teeballová pálka Easton TB23QUAN10.\r\n\r\nDoporučeno pro: baseball - mládež.\r\n\r\nMateriál: 7046\r\n\r\nOdlehčení: -10\r\n\r\nBarel: 2 1/4\r\n\r\nCertifikace: USA BASEBALL\r\n\r\nCertifikace USA BASEBALL opravňuje používat tyto pálky v žákovských a kadetských soutěžích od roku 2018.', 2, 'jpg'),
(7, '2 1/4\" Louisville Slugger Diva 2022 -11,5', 1600, 'Softballová pálka Louisville Slugger Diva 2022.\r\n\r\nDoporučeno pro: softball - mládež.\r\n\r\nMateriál: Full Alloy.\r\n\r\nOdlehčení: -11,5', 4, 'jpg'),
(8, 'Rawlings R16MS MATTE SENIOR', 1600, 'Helma Rawlings R16MS SENIOR.\r\n\r\nVelikost: univerzální - 6 7/8 až 7 5/8\r\n\r\nBarva: tmavě modrá.\r\n\r\nK této helmě je mřížka R16WG\r\n\r\nK této helmě je chránič obličeje REXTR\r\n\r\nK této helmě je chránič obličeje REVEXT', 0, 'jpg'),
(9, 'Rawlings RCFH Matte včetně mřížky', 1950, 'Helma Rawlings RCFH Matte.\r\n\r\nBarva: světle modrá\r\n\r\nVelikost: univerzální - 6 1/2 - 7 1/2', 5, 'jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `product_categories`
--

CREATE TABLE `product_categories` (
  `product_categories_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `product_categories`
--

INSERT INTO `product_categories` (`product_categories_id`, `product_id`, `category_id`) VALUES
(5, 5, 1),
(6, 5, 4),
(7, 6, 2),
(8, 7, 2),
(9, 8, 3),
(10, 8, 4),
(11, 9, 3),
(12, 9, 4),
(37, 3, 4),
(38, 3, 1),
(49, 1, 7),
(56, 2, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(2, 'admin'),
(1, 'customer');

-- --------------------------------------------------------

--
-- Struktura tabulky `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `shipping_methods_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `shipping_methods`
--

INSERT INTO `shipping_methods` (`shipping_methods_id`, `name`, `price`) VALUES
(1, 'Zásilkovna - doručení do boxu', 60),
(2, 'PPL - doručení na adresu', 99);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `password_hash`, `role_id`, `first_name`, `last_name`, `email`, `phone`, `is_active`) VALUES
(12, '$2y$10$zwn7DajZuZ7Xl0JpB7uVWOzxH.E18TMmWJvfeovMqZuyhcG050x/6', 2, 'bb', 'bb', 'simon@gmail.com', '+420604492395', 1),
(13, '$2y$10$WDQIF7jrKSpGf2zb2YKfCeEF0/ADeRcwdcG5PwTQKzZ9sSGK6VYHG', 1, 'honza', 'novak', 'honza@gmail.com', '+420 605 992 382', 1),
(14, '$2y$10$eLwdJwt3oeUmod9l62/zXO.xs0YL.PMZKqg6eRBdmAmXQossKq3IG', 1, 'asdf', 'asdf', 'asdf@gmail.com', '604492395', 1),
(15, '$2y$10$1a83jD7u6O8XLZhEloh8juye2tSBLnB.eYzJKA/9uE18vU7/f3IaO', 1, 'dasf', 'asdf', 'asd@gmail.com', '+420634492395', 1),
(16, '$2y$10$ffYJ37xA1PRYE.lisDJgKugouITrTWpPwZkLWcTe9DDrIDshcDy2W', 1, 'asdga', 'asdg', 'qqq@gmail.com', '+420604492295', 1),
(17, '$2y$10$ojSuorbl/CZkrHGcm9cwGOEumCYYqpaYfFRWvIfhQ5aMAmTm3pYhi', 2, 'admin', 'admin', 'admin@gmail.com', '+420604492391', 1),
(18, '$2y$10$tHcurbHkaVXj77bkAvJ/ueWu6edRagiBoj7vmlvI.FBguQtm7BJ86', 1, 'honza', 'prijmeni', 'honza@gm.com', '+420604492311', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_address_users` (`user_id`);

--
-- Indexy pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexy pro tabulku `host_users`
--
ALTER TABLE `host_users`
  ADD PRIMARY KEY (`host_user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexy pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_users` (`user_id`),
  ADD KEY `fk_payment_methods` (`payment_method_id`),
  ADD KEY `fk_shipping_methods` (`shipping_method_id`),
  ADD KEY `fk_host_users` (`host_user_id`),
  ADD KEY `fk_address` (`address_id`);

--
-- Indexy pro tabulku `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `fk_orders` (`order_id`),
  ADD KEY `fk_products` (`product_id`);

--
-- Indexy pro tabulku `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexy pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexy pro tabulku `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_categories_id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_products_id` (`product_id`);

--
-- Indexy pro tabulku `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexy pro tabulku `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`shipping_methods_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `host_users`
--
ALTER TABLE `host_users`
  MODIFY `host_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pro tabulku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pro tabulku `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pro tabulku `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `product_categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pro tabulku `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `shipping_methods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Omezení pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `fk_host_users` FOREIGN KEY (`host_user_id`) REFERENCES `host_users` (`host_user_id`),
  ADD CONSTRAINT `fk_payment_methods` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`payment_method_id`),
  ADD CONSTRAINT `fk_shipping_methods` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_methods` (`shipping_methods_id`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Omezení pro tabulku `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Omezení pro tabulku `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
