-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 01:27 PM
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
-- Database: `brud06`
--

-- --------------------------------------------------------

--
-- Table structure for table `cv06_categories`
--

CREATE TABLE `cv06_categories` (
  `category_id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_categories`
--

INSERT INTO `cv06_categories` (`category_id`, `number`, `name`) VALUES
(1, '0', 'Laptops'),
(2, '1', 'Phones'),
(3, '2', 'Books'),
(4, '3', 'Toys');

-- --------------------------------------------------------

--
-- Table structure for table `cv06_products`
--

CREATE TABLE `cv06_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_products`
--

INSERT INTO `cv06_products` (`product_id`, `name`, `price`, `img`, `category_id`) VALUES
(1, 'Lenovo Legion', '49.90', 'https://image.alza.cz/products/NT379x11/NT379x11.jpg?width=500&height=500', 1),
(2, 'Acer Swift', '60.90', 'https://image.alza.cz/products/NC138j1m3g5/NC138j1m3g5.jpg?width=500&height=500', 1),
(3, 'Samsung Galaxy', '47.90', 'https://image.alza.cz/products/SAMO0246b2/SAMO0246b2.jpg?width=500&height=500', 2),
(4, 'Vroom', '51.90', 'https://i5.walmartimages.com/asr/e7bd96a4-5489-4c03-b5b4-241f300f0b98_1.89699a8697fc36fc887e0e0de0af02e2.jpeg?odnHeight=640&odnWidth=640&odnBg=FFFFFF', 4),
(5, 'Midnight library', '39.90', 'https://img-cloud.megaknihy.cz/2694041-large/9b9685aced348ae6f9d749bc489542c8/the-midnight-library.jpg', 3),
(6, 'Holy handgranade', '59.90', 'https://m.media-amazon.com/images/I/81CLvNdVCBL._AC_SL1500_.jpg', NULL),
(7, 'Alzak', '10', 'https://im9.cz/iRft/657/56/3304956657--400x400.jpg', NULL),
(8, 'Dell Alienware', '2000', 'https://image.alza.cz/products/ADD19n16i2/ADD19n16i2.jpg?width=500&height=500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cv06_slides`
--

CREATE TABLE `cv06_slides` (
  `slide_id` int(11) NOT NULL,
  `img` text NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv06_slides`
--

INSERT INTO `cv06_slides` (`slide_id`, `img`, `title`) VALUES
(1, 'https://preview.redd.it/with-new-driver-skins-i-decided-to-make-a-car-skin-that-v0-8xpgnpgdpo6a1.png?width=1080&crop=smart&auto=webp&s=def8ed5329746e5318fbed355aa5226c6dda4786', 'First slide'),
(2, 'https://preview.redd.it/with-new-driver-skins-i-decided-to-make-a-car-skin-that-v0-dme8xy3epo6a1.png?width=1920&format=png&auto=webp&s=2543d6e3a9f258dcc8979e9c28af80a9430a520c', 'Second slide');

-- --------------------------------------------------------

--
-- Table structure for table `cv08_goods`
--

CREATE TABLE `cv08_goods` (
  `good_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `img` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv08_goods`
--

INSERT INTO `cv08_goods` (`good_id`, `name`, `price`, `description`, `img`) VALUES
(1, 'turpis nec mauris', 301.88, 'Nulla semper tellus id', 'https://w7.pngwing.com/pngs/227/909/png-transparent-pokemon-charmander-pokemon-go-pikachu-ash-ketchum-charmander-pokemon-orange-fictional-character-cartoon-thumbnail.png'),
(2, 'Mauris vel', 303.57, 'non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est,', 'https://media.cnn.com/api/v1/images/stellar/prod/210226041654-05-pokemon-anniversary-design.jpg?q=w_1920,h_1080,x_0,y_0,c_fill'),
(3, 'orci. Ut sagittis', 989.8, 'ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu.', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/blastoise.avif'),
(4, 'ad', 539.25, 'Integer in', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/pidgeot.avif'),
(5, 'ultrices', 682.18, 'Duis risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec, euismod in, dolor. Fusce feugiat. Lorem ipsum', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(6, 'iaculis', 466.72, 'Donec', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/golem.avif'),
(7, 'imperdiet dictum', 907.65, 'eu, placerat', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/golem.avif'),
(8, 'Morbi vehicula. Pellentesque', 961.53, 'nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/slowbro.avif'),
(9, 'adipiscing elit.', 118.18, 'a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/gengar.avif'),
(10, 'ultrices,', 753.65, 'et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(11, 'dapibus', 298.65, 'eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(12, 'gravida', 475.17, 'at, nisi. Cum sociis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(13, 'Proin', 751.6, 'dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(14, 'eu', 289.52, 'arcu. Aliquam', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(15, 'amet ante. Vivamus', 503.7, 'nascetur ridiculus mus. Proin vel arcu eu odio', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(16, 'vulputate, risus', 873.27, 'Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus.', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(17, 'dolor vitae dolor.', 562.84, 'justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(18, 'ante', 815.41, 'Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(19, 'vulputate, risus a', 103.18, 'Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(20, 'neque tellus, imperdiet', 381.1, 'odio a purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(21, 'Donec vitae', 634.03, 'Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(22, 'dui, semper', 180.31, 'faucibus lectus, a sollicitudin orci sem eget', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(23, 'nec, cursus', 920.17, 'dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(24, 'in consequat', 555.58, 'convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(25, 'nunc est,', 949.36, 'est tempor bibendum. Donec felis orci, adipiscing non, luctus sit', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(26, 'fermentum vel,', 105.21, 'molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus.', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(27, 'odio', 981.03, 'Cras dolor dolor, tempus non, lacinia at,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(28, 'semper.', 409.8, 'vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec, euismod', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(29, 'vestibulum lorem,', 800.77, 'Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(30, 'penatibus', 497.28, 'mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(31, 'nec, eleifend', 281.21, 'urna, nec luctus', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(32, 'Nullam', 121.15, 'ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(33, 'ac orci.', 898.32, 'Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(34, 'lorem ut', 377.39, 'est arcu ac', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(35, 'commodo at,', 76.2, 'vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(36, 'pede blandit congue.', 983.54, 'ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(37, 'dictum', 488.08, 'In condimentum. Donec at arcu. Vestibulum ante ipsum primis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(38, 'non magna. Nam', 92.69, 'Morbi quis urna. Nunc quis arcu', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(39, 'eu, accumsan', 495.07, 'mattis ornare, lectus ante dictum mi,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(40, 'consectetuer', 986.72, 'egestas a, scelerisque sed,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(41, 'convallis convallis', 842.09, 'iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(42, 'nisi nibh lacinia', 217.35, 'Cras dolor dolor, tempus non, lacinia at, iaculis quis,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(43, 'eu', 424.64, 'dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(44, 'tellus eu augue', 633.88, 'risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(45, 'lorem', 517.43, 'Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra. Donec', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(46, 'neque. Nullam nisl.', 278.32, 'ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(47, 'interdum', 557.82, 'mattis', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(48, 'magna', 292.2, 'augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(49, 'id enim. Curabitur', 10.24, 'scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(50, 'lobortis,', 240.13, 'aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/growlithe.avif'),
(51, 'purus. Maecenas libero', 466.42, 'amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/gengar.avif'),
(52, 'mi lorem,', 531.45, 'fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor,', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/gengar.avif'),
(53, 'Curabitur dictum. Phasellus', 405.78, 'enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/machamp.avif'),
(54, 'pikachu', 6000, 'Pika Pika', 'https://upload.wikimedia.org/wikipedia/en/a/a6/Pok%C3%A9mon_Pikachu_art.png');

-- --------------------------------------------------------

--
-- Table structure for table `cv10_users`
--

CREATE TABLE `cv10_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cv10_users`
--

INSERT INTO `cv10_users` (`user_id`, `email`, `password`, `privilege`) VALUES
(8, 'user8@example.com', 'password8', 2),
(9, 'user9@example.com', 'password9', 3),
(13, 'pikachu@pokemons.cz', '$2y$10$HgSk/EGePuCTQ7fOd1dRmuJCYDeeiUorW3vJdjB6B7Jb0/7ZIQKRW', 3),
(14, 'pikachu@pokemons.czk', '$2y$10$17Q2SjbC2Jx/DME4fxTnkeSTLjeS9dq3o.JO5RZPl4cIgchE2PTvG', 1),
(15, 'pikachu@pokemons.czkm', '$2y$10$xlKTR6FBsTzvZsKgXH4cuOdFuYiMmiTgHkEuOubpgNF8CNd/h/vP.', 1),
(16, 'pikachu@pokemons.czkml', '$2y$10$E6X2R8JYu7lj72I5oWQhcOmW3d/9Ncmu7nxUpr740GcsQ/R83dEZu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_characters`
--

CREATE TABLE `sp_characters` (
  `character_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `gold` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `hitpoints` int(11) NOT NULL,
  `luck` int(11) NOT NULL,
  `stamina` int(11) NOT NULL,
  `last_action_time` bigint(20) NOT NULL DEFAULT current_timestamp(),
  `progression` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_characters`
--

INSERT INTO `sp_characters` (`character_id`, `name`, `image`, `class`, `gold`, `level`, `xp`, `strength`, `hitpoints`, `luck`, `stamina`, `last_action_time`, `progression`, `user_id`) VALUES
(31, 'Shopper', 'img/warrior1f.jpg', 'Warrior', 90600, 22, 50, 100, 190, 100, 80, 1718308296, 2, 1986),
(34, 'Aiba', 'img/mage1f.jpg', 'Warrior', 2510, 14, 70, 30, 110, 20, 89, 1718364193, 2, 1),
(36, 'obhajoba', 'img/mage1m.jpg', 'Warrior', 98150, 11, 30, 30, 120, 30, 5, 1718356335, 2, 1994);

-- --------------------------------------------------------

--
-- Table structure for table `sp_dungeons`
--

CREATE TABLE `sp_dungeons` (
  `dungeon_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `min_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_dungeons`
--

INSERT INTO `sp_dungeons` (`dungeon_id`, `name`, `image`, `description`, `min_level`) VALUES
(1, 'The Dark Forest', 'img/forrestDungeon.jpg', 'A mysterious forest shrouded in darkness. Beware of the creatures lurking in the shadows.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sp_floors`
--

CREATE TABLE `sp_floors` (
  `floor_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `description` text NOT NULL,
  `xp` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `monster_id` int(11) DEFAULT NULL,
  `dungeon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_floors`
--

INSERT INTO `sp_floors` (`floor_id`, `number`, `description`, `xp`, `gold`, `monster_id`, `dungeon_id`) VALUES
(1, 1, 'This is the first floor of the dungeon. Beware of the monster!', 100, 50, 1, 1),
(2, 2, 'This is the second floor of the dungeon. The monster here is even scarier!', 100, 100, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_inventory`
--

CREATE TABLE `sp_inventory` (
  `character_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `is_equipped` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_inventory`
--

INSERT INTO `sp_inventory` (`character_id`, `item_id`, `is_equipped`) VALUES
(31, 2, 0),
(31, 3, 0),
(31, 4, 1),
(31, 6, 0),
(31, 9, 1),
(31, 11, 1),
(31, 12, 0),
(34, 1, 1),
(36, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_items`
--

CREATE TABLE `sp_items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `strength` int(11) NOT NULL,
  `hitpoints` int(11) NOT NULL,
  `luck` int(11) NOT NULL,
  `equipment_type` enum('Weapon','Armor','Legs','Trinket') DEFAULT NULL,
  `price_to_buy` int(11) NOT NULL,
  `price_to_sell` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_items`
--

INSERT INTO `sp_items` (`item_id`, `name`, `image`, `strength`, `hitpoints`, `luck`, `equipment_type`, `price_to_buy`, `price_to_sell`) VALUES
(1, 'Weapon 1', 'img/sword.png', 20, 10, 10, 'Weapon', 1000, 100),
(2, 'Weapon 2', 'img/sword.png', 20, 20, 20, 'Weapon', 2000, 200),
(3, 'Weapon 3', 'img/sword.png', 30, 30, 30, 'Weapon', 3000, 300),
(4, 'Armor 1', 'img/armor.webp', 10, 10, 10, 'Armor', 1000, 100),
(5, 'Armor 2', 'img/armor.webp', 20, 20, 20, 'Armor', 2000, 200),
(6, 'Armor 3', 'img/armor.webp', 30, 30, 30, 'Armor', 3000, 300),
(7, 'Legs 1', 'img/legs.svg', 10, 10, 10, 'Legs', 1000, 100),
(8, 'Legs 2', 'img/legs.svg', 20, 20, 20, 'Legs', 2000, 200),
(9, 'Legs 3', 'img/legs.svg', 30, 30, 30, 'Legs', 3000, 300),
(10, 'Trinket 1', 'img/necklace.jpg', 10, 10, 10, 'Trinket', 1000, 100),
(11, 'Trinket 2', 'img/necklace.jpg', 20, 20, 20, 'Trinket', 2000, 200),
(12, 'Trinket 3', 'img/necklace.jpg', 30, 30, 30, 'Trinket', 3000, 300),
(17, 'pikachu', 'img/sword.png', 5, 5, 5, 'Armor', 9999, 999),
(18, 'obhajoba', 'img/sword.png', 30, 40, 15, 'Weapon', 5000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `sp_monsters`
--

CREATE TABLE `sp_monsters` (
  `monster_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `level` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `hitpoints` int(11) NOT NULL,
  `luck` int(11) NOT NULL,
  `isDungeonMonster` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_monsters`
--

INSERT INTO `sp_monsters` (`monster_id`, `name`, `image`, `level`, `strength`, `hitpoints`, `luck`, `isDungeonMonster`) VALUES
(1, 'Weak Monster', 'img/questWraith.jpg', 1, 1, 50, 1, 0),
(2, 'Wraith', 'img/dungeonWraith.jpg', 50, 200, 200, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_quests`
--

CREATE TABLE `sp_quests` (
  `quest_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `xp` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `description` text NOT NULL,
  `stamina_cost` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_quests`
--

INSERT INTO `sp_quests` (`quest_id`, `name`, `xp`, `gold`, `description`, `stamina_cost`, `monster_id`) VALUES
(11, 'Quest 1', 100, 50, 'This is a description for Quest 1', 10, 1),
(12, 'Quest 2', 10, 100, 'This is a description for Quest 2', 6, 1),
(13, 'Quest 3', 100, 150, 'This is a description for Quest 3', 20, 1),
(14, 'Quest 4', 10, 200, 'This is a description for Quest 4', 15, 1),
(15, 'Quest 5', 10, 250, 'This is a description for Quest 5', 10, 1),
(16, 'Quest 6', 10, 300, 'This is a description for Quest 6', 10, 1),
(17, 'Quest 7', 10, 350, 'This is a description for Quest 7', 5, 1),
(18, 'Quest 8', 10, 400, 'This is a description for Quest 8', 15, 1),
(19, 'Quest 9', 10, 450, 'This is a description for Quest 9', 20, 1),
(20, 'Quest 10', 10, 500, 'This is a description for Quest 10', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sp_users`
--

CREATE TABLE `sp_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` int(11) NOT NULL,
  `isBanned` tinyint(1) DEFAULT 0,
  `github_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_users`
--

INSERT INTO `sp_users` (`user_id`, `email`, `password`, `privilege`, `isBanned`, `github_id`) VALUES
(1, 'pikachu@pokemons.cz', '$2y$10$DV5tvrAhdH67aTWCor80rO0YxMI1Ts7603yQ/ongZdGSr1lMzY5O6', 1, 0, NULL),
(1985, 'admin@admin.cz', '$2y$10$SGmAfMsvuMTUV4yfdKVBZeDT.JeaDQm3MciFMez3xZ8CWY5qNEX8m', 2, 0, NULL),
(1986, 'pikachu@pokemons.czk', '$2y$10$UOif66A8SQvc7rts0eJ9WOxRBvHme3yKeGHZpi/XZFOZpYX9Iiyw2', 1, 0, NULL),
(1987, 'pikachu@pokemons.czkm', '$2y$10$.HXfVsG.KXCAiHh/4BLiDO2quETnmQtUbUNn.7PeVTueJaj/cvuYS', 1, 0, NULL),
(1994, 'obhajoba@vse.cz', '$2y$10$AoJKepfQ6gGxUn8qDRSwBu44ralqFDaJJIjdYf2Cef0vNOBtsUUSO', 1, 0, NULL),
(1996, 'default@example.com', '', 1, 0, '107412763');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cv06_categories`
--
ALTER TABLE `cv06_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cv06_products`
--
ALTER TABLE `cv06_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_category_id` (`category_id`);

--
-- Indexes for table `cv06_slides`
--
ALTER TABLE `cv06_slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `cv08_goods`
--
ALTER TABLE `cv08_goods`
  ADD PRIMARY KEY (`good_id`);

--
-- Indexes for table `cv10_users`
--
ALTER TABLE `cv10_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sp_characters`
--
ALTER TABLE `sp_characters`
  ADD PRIMARY KEY (`character_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sp_dungeons`
--
ALTER TABLE `sp_dungeons`
  ADD PRIMARY KEY (`dungeon_id`);

--
-- Indexes for table `sp_floors`
--
ALTER TABLE `sp_floors`
  ADD PRIMARY KEY (`floor_id`),
  ADD KEY `monster_id` (`monster_id`),
  ADD KEY `dungeon_id` (`dungeon_id`);

--
-- Indexes for table `sp_inventory`
--
ALTER TABLE `sp_inventory`
  ADD PRIMARY KEY (`character_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `sp_items`
--
ALTER TABLE `sp_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `sp_monsters`
--
ALTER TABLE `sp_monsters`
  ADD PRIMARY KEY (`monster_id`);

--
-- Indexes for table `sp_quests`
--
ALTER TABLE `sp_quests`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `monster_id` (`monster_id`);

--
-- Indexes for table `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cv06_categories`
--
ALTER TABLE `cv06_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cv06_products`
--
ALTER TABLE `cv06_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cv06_slides`
--
ALTER TABLE `cv06_slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cv08_goods`
--
ALTER TABLE `cv08_goods`
  MODIFY `good_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `cv10_users`
--
ALTER TABLE `cv10_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sp_characters`
--
ALTER TABLE `sp_characters`
  MODIFY `character_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sp_dungeons`
--
ALTER TABLE `sp_dungeons`
  MODIFY `dungeon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_floors`
--
ALTER TABLE `sp_floors`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_items`
--
ALTER TABLE `sp_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sp_monsters`
--
ALTER TABLE `sp_monsters`
  MODIFY `monster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_quests`
--
ALTER TABLE `sp_quests`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1997;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cv06_products`
--
ALTER TABLE `cv06_products`
  ADD CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `cv06_categories` (`category_id`);

--
-- Constraints for table `sp_characters`
--
ALTER TABLE `sp_characters`
  ADD CONSTRAINT `sp_characters_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sp_users` (`user_id`);

--
-- Constraints for table `sp_floors`
--
ALTER TABLE `sp_floors`
  ADD CONSTRAINT `sp_floors_ibfk_1` FOREIGN KEY (`monster_id`) REFERENCES `sp_monsters` (`monster_id`),
  ADD CONSTRAINT `sp_floors_ibfk_2` FOREIGN KEY (`dungeon_id`) REFERENCES `sp_dungeons` (`dungeon_id`);

--
-- Constraints for table `sp_inventory`
--
ALTER TABLE `sp_inventory`
  ADD CONSTRAINT `sp_inventory_ibfk_1` FOREIGN KEY (`character_id`) REFERENCES `sp_characters` (`character_id`),
  ADD CONSTRAINT `sp_inventory_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `sp_items` (`item_id`);

--
-- Constraints for table `sp_quests`
--
ALTER TABLE `sp_quests`
  ADD CONSTRAINT `sp_quests_ibfk_1` FOREIGN KEY (`monster_id`) REFERENCES `sp_monsters` (`monster_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
