-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jana19`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `idOrder` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` enum('pending','confirmed','canceled','paid','sent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `date`, `state`) VALUES
(3, 4, '2024-05-29 07:31:50', 'canceled'),
(4, 4, '2024-05-29 05:33:28', 'pending'),
(5, 4, '2024-05-29 06:40:52', 'paid'),
(6, 4, '2024-05-29 07:37:11', 'canceled'),
(7, 4, '2024-05-29 07:31:55', 'sent'),
(8, 4, '2024-05-29 07:12:19', 'paid'),
(9, 4, '2024-05-29 07:45:17', 'paid'),
(10, 4, '2024-05-29 08:38:35', 'paid'),
(11, 13, '2024-05-31 10:30:50', 'pending'),
(12, 13, '2024-05-31 10:31:28', 'pending'),
(13, 13, '2024-05-31 10:45:17', 'pending'),
(14, 13, '2024-05-31 10:50:49', 'pending'),
(15, 13, '2024-05-31 11:00:17', 'pending'),
(16, 13, '2024-05-31 11:22:59', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
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
-- Dumping data for table `orderproducts`
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
(10, 11, 7, 2, 120, 20),
(11, 12, 7, 3, 120, 20),
(12, 13, 7, 1, 120, 20),
(13, 14, 1, 2, 50, 5),
(14, 14, 2, 1, 150, 0),
(15, 15, 8, 2, 5000, 0),
(16, 15, 1, 1, 50, 5),
(17, 15, 3, 1, 500, 0),
(18, 16, 3, 1, 500, 0),
(19, 16, 1, 1, 50, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
--

INSERT INTO `product` (`idProduct`, `name`, `price`, `discount`, `isAvailable`, `isCaffeineFree`, `isGiftSet`, `image`, `description`) VALUES
(1, 'Mint Mystique', 50, 5, 1, 0, 0, 'https://www.ahmadtea.cz/upload/image/product/orig-40517-ahmad-tea-mint-mystique-t8.png', 'A fantastic green tea with calming mint flavour.'),
(2, 'English Breakfast', 150, 0, 1, 0, 0, 'https://www.ahmadtea.cz/upload/image/product/orig-75788-0054881006002-ahmad-tea-english-breakfast-cerny-caj-100-x-2g-t9.png', 'A great blend of Black Tea to start your day.'),
(3, 'Decaf Bundle', 500, 0, 1, 1, 1, 'https://uk.ahmadtea.com/cdn/shop/products/DecafBundle.jpg?v=1662552291', 'Treat yourself or a friend with this collection of Decaffeinated Teas. Who said you can\'t enjoy nice cup of black tea in the evening?'),
(4, 'Mint & Lemon', 70, 0, 1, 1, 0, 'https://images.deliveryhero.io/image/darsktores-cz/Products/054881000024.jpg?height=480', 'A calming blend of the finest Mint with a hint of Lemon. '),
(5, 'Winter Charm', 80, 0, 0, 1, 0, 'https://www.lupex.cz/UserFiles/Image/1704800586orig-60072-orig-82133-wintercharm-20foil-r-560x560-1.png', 'Get cosy and enjoy the winter with our special blend. '),
(7, 'chemeleon', 120, 20, 1, 1, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-NSEUHWmQsGxt4SfVM3f8VMW7vN8JsHnL-CnVII5E4A&amp;s', 'testttttt'),
(8, 'A\'Tuin', 5000, 0, 1, 0, 0, 'https://i0.wp.com/apilgriminnarnia.com/wp-content/uploads/2014/03/discworld-atuin-from-film.jpg', 'The greatest.');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `idProductTypeRelation` int(11) NOT NULL,
  `idProductType` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`idProductTypeRelation`, `idProductType`, `idProduct`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 4),
(4, 1, 3),
(5, 2, 3),
(6, 4, 5),
(47, 1, 8),
(48, 4, 8),
(59, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `producttypes`
--

CREATE TABLE `producttypes` (
  `idProductType` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttypes`
--

INSERT INTO `producttypes` (`idProductType`, `typeName`) VALUES
(1, 'Green'),
(2, 'Black'),
(3, 'Herbal'),
(4, 'Fruit'),
(5, 'Rooibos');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authType` enum('local','google') NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `email`, `password`, `authType`, `role`) VALUES
(4, 'lalala@seznam.cz', '$2y$10$kLCV2qajQghOfWAwbyL/buEW2dAnKuQajzK3bQ.P7gPz2wcJfpMcS', 'local', 1),
(13, 'user@email.cz', '$2y$10$4jjulf4xKuowUlPOuorpKew7Auv7Qhs8qc4c3CdmwTMIWxL1hYKxS', 'local', 1),
(14, 'user@email.cz', '$2y$10$28xv6nUqoFBVT9lZeZZ0gOnuhFpbpePdXFYeqnR7dpZdhZloSfWM.', 'local', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`idOrderProductList`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`idProductTypeRelation`),
  ADD KEY `idProductType` (`idProductType`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Indexes for table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`idProductType`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `idOrderProductList` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `idProductTypeRelation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `idProductType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `OrderProducts_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`),
  ADD CONSTRAINT `OrderProducts_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);

--
-- Constraints for table `producttype`
--
ALTER TABLE `producttype`
  ADD CONSTRAINT `ProductType_ibfk_1` FOREIGN KEY (`idProductType`) REFERENCES `producttypes` (`idProductType`),
  ADD CONSTRAINT `ProductType_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
