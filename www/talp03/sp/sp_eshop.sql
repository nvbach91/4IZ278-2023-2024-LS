-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 14. čen 2024, 13:51
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
-- Databáze: `sp_eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'chairs'),
(2, 'tables'),
(3, 'wardrobes'),
(4, 'sofas'),
(5, 'beds');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `total_price` int(11) NOT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `total_price`, `state`, `user_id`) VALUES
(25, '2024-06-09', 13370, 'shiped', 6),
(26, '2024-06-10', 40625, 'shiped', 6),
(27, '2024-06-11', 14500, 'paid', 6),
(34, '2024-06-14', 25000, 'pending', 6),
(35, '2024-06-14', 25000, 'pending', 6),
(36, '2024-06-14', 25000, 'pending', 6),
(37, '2024-06-14', 25000, 'pending', 6),
(38, '2024-06-14', 25000, 'pending', 6),
(39, '2024-06-14', 4000, 'pending', 6),
(40, '2024-06-14', 14000, 'pending', 6),
(41, '2024-06-14', 36000, 'pending', 6),
(42, '2024-06-14', 10000, 'pending', 6);

-- --------------------------------------------------------

--
-- Struktura tabulky `order_products`
--

CREATE TABLE `order_products` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `order_products`
--

INSERT INTO `order_products` (`order_product_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 25, 1, 0, 4000),
(2, 25, 2, 0, 1890),
(3, 25, 3, 0, 2990),
(4, 25, 4, 0, 4490),
(5, 26, 2, 0, 1890),
(6, 26, 3, 0, 2990),
(7, 26, 9, 0, 34555),
(8, 26, 5, 0, 1190),
(9, 27, 21, 0, 2000),
(10, 27, 18, 0, 12500),
(21, 38, 20, 2, 4000),
(22, 38, 21, 3, 2000),
(23, 38, 19, 1, 11000),
(24, 39, 20, 1, 4000),
(25, 40, 21, 3, 2000),
(26, 40, 20, 2, 4000),
(27, 41, 20, 1, 4000),
(28, 41, 19, 2, 11000),
(29, 41, 16, 2, 5000),
(30, 42, 21, 3, 2000),
(31, 42, 20, 1, 4000);

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `img`, `price`, `category_id`, `last_updated`) VALUES
(1, 'GLOSDAT', '', 'https://www.ikea.com/cz/cs/images/products/glostad-2mistna-pohovka-knisa-tmave-seda__0950864_pe800736_s5.jpg?f=xl', 4000, 4, '2024-06-10 11:31:39'),
(2, 'BERGMUND', NULL, 'https://www.ikea.com/cz/cs/images/products/bergmund-zidle-vzor-dub-gunnared-seda__0926590_pe789373_s5.jpg?f=xl', 1890, 1, '2024-06-10 11:31:39'),
(3, 'SLATTUM', NULL, 'https://www.ikea.com/cz/cs/images/products/slattum-calouneny-ram-postele-vissle-tmave-seda__1259335_pe926650_s5.jpg?f=xl', 2990, 5, '2024-06-10 11:31:39'),
(4, 'BRIMNES', NULL, 'https://www.ikea.com/cz/cs/images/products/brimnes-skrin-se-3-dvermi-bila__0176787_pe329567_s5.jpg?f=xl', 4490, 3, '2024-06-10 11:31:39'),
(5, 'SANDSBERG', NULL, 'https://www.ikea.com/cz/cs/images/products/sandsberg-stul-cerna__1074348_pe856162_s5.jpg?f=xl', 1190, 2, '2024-06-10 11:31:39'),
(8, 'FISKA', 'stůl dřevěný', 'https://cdn.myshoptet.com/usr/www.designovynabytek.cz/user/shop/big/126429_masivni-mangovy-kulaty-jidelni-stul-fabio-120-cm.jpg?66508909', 2000, 2, '2024-06-10 11:34:04'),
(9, 'poetry', 'mnbv', 'https://www.google.com/url?sa=i&amp;url=https%3A%2F%2Fpixabay.com%2Fimages%2Fsearch%2Fnature%2F&amp;psig=AOvVaw3xAQqbBZXdaApo4F9Ygpj9&amp;ust=1718101192175000&amp;source=images&amp;cd=vfe&amp;opi=89978449&amp;ved=0CBIQjRxqFwoTCODXgezn0IYDFQAAAAAdAAAAABAK', 5010, 3, '2024-06-10 14:00:43'),
(10, 'GLOVIKO', 'Šedá židle', 'https://www.nabytekmirek.cz/5954-thickbox_default/zidle-s-podruckami-bella-seda-easy-clean.jpg', 3000, 1, '2024-06-10 11:31:39'),
(11, 'FRIHETEN', NULL, 'https://www.ikea.com/cz/cs/images/products/friheten-roh-rozkl-pohovka-s-ul-prostorem-skiftebo-tmave-seda__0175610_pe328883_s5.jpg?f=xl', 11000, 4, '2024-06-10 14:40:37'),
(12, 'FRIDHULT', NULL, 'https://www.ikea.com/cz/cs/images/products/fridhult-rozkladaci-pohovka-skiftebo-zluta__1265821_pe927821_s5.jpg?f=xl', 5500, 4, '2024-06-10 14:40:37'),
(13, 'PARUB', NULL, 'https://www.ikea.com/cz/cs/images/products/paerup-3mistna-pohovka-s-lenoskou-vissle-zluto-hneda__1213945_pe911424_s5.jpg?f=xl', 9000, 4, '2024-06-10 14:40:37'),
(14, 'FORSAND', NULL, 'https://www.ikea.com/cz/cs/images/products/pax-forsand-satni-sestava-vz-bile-mor-dub-vz-bile-mor-dub__1024701_pe833637_s5.jpg?f=xl', 15000, 3, '2024-06-10 14:40:37'),
(15, 'PLATSA', NULL, 'https://www.ikea.com/cz/cs/images/products/smastad-platsa-satni-skrin-bila-svetle-zelena__1242793_pe920396_s5.jpg?f=xl', 3000, 3, '2024-06-10 14:40:37'),
(16, 'VISTHUS', NULL, 'https://www.ikea.com/cz/cs/images/products/visthus-satni-skrin-seda-bila__0592302_pe674454_s5.jpg?f=xl', 5000, 3, '2024-06-10 14:40:37'),
(17, 'NEIDEN', NULL, 'https://www.ikea.com/cz/cs/images/products/neiden-ram-postele-borovice__0749131_pe745500_s5.jpg?f=xl', 1500, 5, '2024-06-10 14:40:37'),
(18, 'HEMNES', NULL, 'https://www.ikea.com/cz/cs/images/products/hemnes-pohovka-se-3-zasuvkami-2-matracemi-zluta-vannareid-velmi-tvrda__1320890_pe941429_s5.jpg?f=xl', 12500, 5, '2024-06-10 14:40:37'),
(19, 'TALLASEN', NULL, 'https://www.ikea.com/cz/cs/images/products/taellasen-calouneny-ram-postele-kulsta-sedo-zelena__1239398_pe918880_s5.jpg?f=xl', 11000, 5, '2024-06-10 14:40:37'),
(20, 'TROTTEN', NULL, 'https://www.ikea.com/cz/cs/images/products/trotten-psaci-stul-bila__1012705_pe828980_s5.jpg?f=xl', 4000, 2, '2024-06-10 14:40:37'),
(21, 'LACK', NULL, 'https://www.ikea.com/cz/cs/images/products/lack-konferencni-stolek-cernohneda__57537_pe163119_s5.jpg?f=xl', 2000, 2, '2024-06-10 14:40:37');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `privilege` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `privilege`) VALUES
(6, 'name', 'name@gmail.com', '$2y$10$2k8gQKPTW5rrI0V76rLcBeUWM087yvfP/fIrqlTigPaJNTI7QASZy', 0),
(7, 'dfgdfg', 'asdadas', '$2y$10$xsgaRlE0FfIwx792qwiRdek/MuAJps8IZA/aYBJ0yxD3eQw2MpWj2', 2),
(8, 'example', 'example@gmail.com', '$2y$10$iVOaFTos6De7PbIFCRf7b.z8ix71AaXlGQgl4Nj46lAl6myVfYTVK', 0),
(9, 'Patrik Talkner', 'patriktalkner@gmail.com', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`) VALUES
(1, 6),
(2, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `wishlist_products`
--

CREATE TABLE `wishlist_products` (
  `wishlist_product_id` int(11) NOT NULL,
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vypisuji data pro tabulku `wishlist_products`
--

INSERT INTO `wishlist_products` (`wishlist_product_id`, `wishlist_id`, `product_id`) VALUES
(8, 2, 2),
(9, 2, 3);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexy pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pro tabulku `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexy pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexy pro tabulku `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pro tabulku `wishlist_products`
--
ALTER TABLE `wishlist_products`
  ADD PRIMARY KEY (`wishlist_product_id`),
  ADD KEY `wishlist_id` (`wishlist_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pro tabulku `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `wishlist_products`
--
ALTER TABLE `wishlist_products`
  MODIFY `wishlist_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Omezení pro tabulku `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `wishlist_products`
--
ALTER TABLE `wishlist_products`
  ADD CONSTRAINT `wishlist_products_ibfk_1` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlist` (`wishlist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wishlist_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
