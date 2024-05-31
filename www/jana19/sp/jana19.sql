-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 31. kvě 2024, 13:42
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
-- Databáze: `jana19`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `order`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` enum('pending','confirmed','canceled','paid','sent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `date`, `state`) VALUES
(1, 4, '2024-05-29 07:29:36', 'sent'),
(3, 4, '2024-05-29 07:31:50', 'canceled'),
(4, 4, '2024-05-29 05:33:28', 'pending'),
(5, 4, '2024-05-31 09:39:48', 'sent'),
(6, 4, '2024-05-29 07:37:11', 'canceled'),
(7, 4, '2024-05-29 07:31:55', 'sent'),
(8, 4, '2024-05-29 07:12:19', 'paid'),
(9, 4, '2024-05-29 07:45:17', 'paid'),
(10, 4, '2024-05-29 08:38:35', 'paid'),
(11, 4, '2024-05-29 09:34:09', 'paid'),
(12, 5, '2024-05-30 14:57:31', 'paid'),
(13, 4, '2024-05-31 09:24:58', 'paid'),
(14, 4, '2024-05-31 09:25:16', 'pending'),
(15, 4, '2024-05-31 09:38:55', 'paid'),
(16, 4, '2024-05-31 09:41:38', 'paid'),
(17, 4, '2024-05-31 11:34:25', 'pending');

-- --------------------------------------------------------

--
-- Struktura tabulky `orderproducts`
--

CREATE TABLE `orderproducts` (
  `idOrderProductList` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productDiscount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `orderproducts`
--

INSERT INTO `orderproducts` (`idOrderProductList`, `idOrder`, `idProduct`, `productQuantity`, `productPrice`, `productDiscount`) VALUES
(1, 3, 7, 1, 120, 20),
(2, 4, 7, 1, 120, 20),
(3, 5, 7, 1, 120, 20),
(4, 6, 3, 1, 500, 0),
(5, 7, 3, 1, 500, 0),
(6, 8, 7, 1, 120, 20),
(7, 8, 4, 1, 70, 0),
(8, 9, 3, 1, 500, 0),
(9, 10, 7, 1, 120, 20),
(10, 11, 1, 1, 50, 5),
(11, 12, 3, 2, 500, 0),
(12, 13, 3, 2, 500, 0),
(13, 14, 3, 1, 500, 0),
(14, 15, 1, 1, 55, 5),
(15, 16, 1, 1, 55, 5),
(16, 16, 4, 1, 70, 0),
(17, 17, 3, 1, 500, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `product`
--

CREATE TABLE `product` (
  `idProduct` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  `isCaffeineFree` tinyint(1) NOT NULL,
  `isGiftSet` tinyint(1) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `product`
--

INSERT INTO `product` (`idProduct`, `name`, `price`, `discount`, `isAvailable`, `isCaffeineFree`, `isGiftSet`, `image`, `description`) VALUES
(1, 'Mint Mystique', 55, 5, 1, 0, 0, 'https://www.ahmadtea.cz/upload/image/product/orig-40517-ahmad-tea-mint-mystique-t8.png', 'A fantastic green tea with calming mint flavour.'),
(3, 'Decaf Bundle', 500, 0, 1, 1, 1, 'https://uk.ahmadtea.com/cdn/shop/products/DecafBundle.jpg?v=1662552291', 'Treat yourself or a friend with this collection of Decaffeinated Teas. Who said you can\'t enjoy nice cup of black tea in the evening?'),
(4, 'Mint & Lemon', 70, 0, 1, 1, 0, 'https://images.deliveryhero.io/image/darsktores-cz/Products/054881000024.jpg?height=480', 'A calming blend of the finest Mint with a hint of Lemon. '),
(5, 'Winter Charm', 80, 0, 0, 1, 0, 'https://www.lupex.cz/UserFiles/Image/1704800586orig-60072-orig-82133-wintercharm-20foil-r-560x560-1.png', 'nice tea'),
(10, 'English Tea Six Collection', 300, 0, 1, 0, 1, 'https://www.ahmadtea.cz/upload/image/cache/d/f/b/dfb00507768f5c8d79bff6086ef1fce5/orig-89346-5015-tea-lovers-collection-levy-stin-kopie-560x560-1.png', 'A fantastic collection.');

-- --------------------------------------------------------

--
-- Struktura tabulky `producttype`
--

CREATE TABLE `producttype` (
  `idProductTypeRelation` int(11) NOT NULL,
  `idProductType` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `producttype`
--

INSERT INTO `producttype` (`idProductTypeRelation`, `idProductType`, `idProduct`) VALUES
(3, 3, 4),
(4, 1, 3),
(5, 2, 3),
(47, 1, 8),
(48, 4, 8),
(60, 1, 10),
(61, 2, 10),
(62, 3, 10),
(63, 4, 10),
(65, 1, 1),
(70, 4, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `producttypes`
--

CREATE TABLE `producttypes` (
  `idProductType` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `producttypes`
--

INSERT INTO `producttypes` (`idProductType`, `typeName`) VALUES
(1, 'Green'),
(2, 'Black'),
(3, 'Herbal'),
(4, 'Fruit'),
(5, 'Rooibos');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authType` enum('local','google') NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`idUser`, `email`, `password`, `authType`, `role`) VALUES
(4, 'lalala@seznam.cz', '$2y$10$kLCV2qajQghOfWAwbyL/buEW2dAnKuQajzK3bQ.P7gPz2wcJfpMcS', 'local', 1),
(5, 'nguv03@vse.cz', '$2y$10$0UGCG8GHthZcZW.rdHCjnuY053fWuR/tf4D30CjkQFXF4ki6LJ02u', 'local', 1),
(6, 'nguv03@vse.cz', '$2y$10$3RD5rR4uVmTbp4Cu1ETYVez23COZqnOcDZXBojbJOEFyRO8JLEESO', 'local', 1),
(7, 'nguv03@vse.cz', '$2y$10$/qBg8HKwedCMKHd9rjXfFexE0pzCT5D0zbRZQbPGSR0N9vDN08aYe', 'local', 1),
(8, 'nguv03@vse.cz', '$2y$10$IQ4hwaGTcdj2MLbVETgFreEyfGjzJZgWgplYvGsq9QIvb2eIafaLG', 'local', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexy pro tabulku `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`idOrderProductList`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Indexy pro tabulku `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indexy pro tabulku `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`idProductTypeRelation`),
  ADD KEY `idProductType` (`idProductType`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Indexy pro tabulku `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`idProductType`);

--
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `idOrderProductList` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `producttype`
--
ALTER TABLE `producttype`
  MODIFY `idProductTypeRelation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pro tabulku `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `idProductType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Omezení pro tabulku `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `OrderProducts_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`),
  ADD CONSTRAINT `OrderProducts_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);

--
-- Omezení pro tabulku `producttype`
--
ALTER TABLE `producttype`
  ADD CONSTRAINT `ProductType_ibfk_1` FOREIGN KEY (`idProductType`) REFERENCES `producttypes` (`idProductType`),
  ADD CONSTRAINT `ProductType_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
