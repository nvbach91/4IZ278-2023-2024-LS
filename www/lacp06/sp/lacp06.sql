-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 02:59 PM
-- Server version: 10.5.19-MariaDB-0+deb11u2
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lacp06`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT 0,
  `units` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `language` varchar(100) NOT NULL,
  `image` text NOT NULL DEFAULT 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg',
  `description` text NOT NULL,
  `pages` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `world_id` int(11) NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `author`, `price`, `discount`, `units`, `publish_date`, `language`, `image`, `description`, `pages`, `rating`, `publisher_id`, `genre_id`, `world_id`, `last_update`) VALUES
(2, 'Watchmen', 'Alan Moore', 19.99, 20, 80, '2023-05-20', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Watchmen je komiksová série, která se zabývá skupinou superhrdinů v alternativní verzi Spojených států.', 180, 5, 2, 1, 2, '2024-05-30 20:16:23'),
(3, 'Maus', 'Art Spiegelman', 12.5, 20, 120, '2022-10-10', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Maus je autobiografický komiks, který vypráví příběh autora a jeho otce jako myši přežívající holocaust.', 220, 4, 3, 2, 3, '0000-00-00 00:00:00'),
(4, 'V for Vendetta', 'Alan Moore', 18.99, 20, 90, '2024-05-25', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'V for Vendetta je dystopický komiks, který sleduje boj maskovaného revolucionáře proti totalitnímu režimu.', 200, 4, 1, 5, 2, '0000-00-00 00:00:00'),
(5, 'Sin City: Město hříchu', 'Frank Miller', 14.75, 20, 100, '2023-12-12', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Sin City je série komiksů, která se odehrává ve městě, kde korupce a násilí jsou na denním pořádku.', 160, 4, 1, 1, 4, '0000-00-00 00:00:00'),
(6, 'Hrdinové úsvitu', 'Alan Moore', 20, 0, 85, '2024-05-01', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Hrdinové úsvitu sledují skupinu superhrdinů v alternativní historii, kde druhá světová válka nikdy neskončila.', 250, 5, 2, 1, 3, '2024-05-25 21:18:19'),
(7, 'Hellboy: Semeno zkázy', 'Mike Mignola', 16.25, 0, 95, '2023-04-04', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Hellboy je démon, který bojuje proti nadpřirozeným hrozbám a ochraňuje lidstvo před temnými silami.', 180, 4, 3, 2, 2, '2024-05-24 11:16:07'),
(8, 'Sandman', 'Neil Gaiman', 17.99, 0, 75, '2022-06-06', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Sandman je komiksová série, která sleduje příběhy Endless, antropomorfních personifikací mytologických a literárních konceptů.', 300, 5, 1, 1, 1, '2024-05-24 11:16:07'),
(9, 'Preacher', 'Garth Ennis', 19.5, 0, 85, '2024-05-21', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Preacher vypráví příběh kazatele s nadlidskými schopnostmi, který hledá Boha, aby ho zodpověděl za jeho zločiny.', 240, 4, 1, 4, 4, '0000-00-00 00:00:00'),
(10, 'Astro City', 'Kurt Busiek', 15.99, 0, 90, '2023-07-30', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Astro City je komiksová série, která mapuje životy superhrdinů a obyčejných lidí ve fiktivním městě.', 200, 4, 3, 2, 3, '2024-05-24 11:16:07'),
(11, 'Saga', 'Brian K. Vaughan', 21.99, 0, 70, '2024-05-13', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Saga sleduje příběh mezihvězdné lásky mezi Alanaou a Markem, kteří jsou pronásledováni kvůli svému hybridnímu dítěti.', 350, 5, 1, 1, 4, '2024-05-25 21:16:17'),
(12, 'Bone', 'Jeff Smith', 18.75, 0, 95, '2023-11-05', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Bone sleduje příběh tří malých tvorů, Bonecousů, kteří se ocitnou v epickém dobrodružství ve Fantazijních zemích.', 400, 4, 2, 1, 2, '2024-05-24 11:16:07'),
(14, 'Y: Poslední muž', 'Brian K. Vaughan', 20.5, 0, 75, '2024-05-17', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Y: Poslední muž sleduje příběh Yoricka Browna, který je jediným přeživším mužem na planetě poté, co došlo k masovému vyhynutí mužů.', 300, 5, 1, 1, 2, '2024-05-25 21:15:33'),
(15, 'Locke & Key', 'Joe Hill', 17.25, 0, 85, '2024-05-06', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Locke & Key sleduje rodinu Lockeů, která objeví klíče s magickými schopnostmi v jejich rodinném domě, který ukrývá temné tajemství.', 280, 4, 2, 1, 1, '2024-05-25 21:15:55'),
(16, 'Invincible', 'Robert Kirkman', 19.99, 0, 90, '2023-04-15', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Invincible vypráví příběh mladého superhrdiny Marka Graysona, který zdědí schopnosti svého otce, největšího hrdiny Země.', 320, 5, 3, 2, 2, '2024-05-30 16:08:22'),
(17, 'Planetary', 'Warren Ellis', 15.5, 0, 95, '2022-09-20', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Planetary sleduje tajnou organizaci, která prozkoumává tajemství a neuvěřitelné události na planetě Zemi.', 270, 4, 1, 1, 3, '2024-05-24 11:16:07'),
(19, 'Scalped', 'Jason Aaron', 16.75, 0, 85, '2022-11-11', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Scalped sleduje příběh indiánského agenta Dashiella „Dash“ Bad Horse, který se vrací do rezervace Pine Ridge jako undercover agent FBI.', 250, 4, 3, 2, 2, '2024-05-24 11:16:07'),
(20, 'The Umbrella Academy', 'Gerard Way', 20.25, 0, 75, '2023-02-28', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'The Umbrella Academy sleduje rodinu superhrdinů, kteří se sjednotí, aby řešili záhadu smrti svého adoptivního otce a ochránili svět.', 280, 5, 5, 5, 1, '0000-00-00 00:00:00'),
(21, 'Saga o Swamp Thingovi', 'Alan Moore', 17.99, 0, 90, '2024-05-03', 'Čeština', 'https://www.obchod.crew.cz/im/coc/420/0/content/529394/1259852654.jpg', 'Saga o Swamp Thingovi sleduje příběh rostlinného monstra, které bylo kdysi člověkem, ale nyní bojuje za ochranu přírody.', 320, 4, 4, 3, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`order_id`, `book_id`, `units`, `price`) VALUES
(1, 17, 6, 15.5),
(2, 17, 1, 15.5),
(3, 15, 1, 17.25),
(4, 3, 1, 10),
(5, 3, 1, 10),
(6, 19, 1, 16.75),
(7, 17, 1, 15.5),
(8, 10, 1, 15.99),
(9, 10, 1, 15.99),
(10, 11, 1, 21.99),
(10, 9, 1, 19.5),
(11, 9, 1, 19.5);

-- --------------------------------------------------------

--
-- Table structure for table `cv06_categories`
--

CREATE TABLE `cv06_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv06_categories`
--

INSERT INTO `cv06_categories` (`category_id`, `name`, `number`) VALUES
(1, 'Electronics', 101),
(2, 'Books', 102),
(3, 'Furniture', 103),
(4, 'Shoes', 104);

-- --------------------------------------------------------

--
-- Table structure for table `cv06_products`
--

CREATE TABLE `cv06_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv06_products`
--

INSERT INTO `cv06_products` (`product_id`, `name`, `price`, `img`, `category_id`) VALUES
(1, 'Nike Air Stab', '600', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bmlrZXxlbnwwfHwwfHx8MA%3D%3D', 4),
(2, 'Lenovo Legion', '15000', 'https://p2-ofp.static.pub/fes/cms/2022/12/15/fqdylbqohxziq8sy5aesxrvkp2yt1f070420.png', 1),
(3, 'DUNE', '300', 'https://m.media-amazon.com/images/I/81TmnPZWb0L._AC_UF1000,1000_QL80_.jpg', 2),
(4, 'Chair', '1200', 'https://www.ikea.com/cz/en/images/products/klinten-chair-brown-kilanda-light-beige__1156101_pe886899_s5.jpg?f=s', 3),
(5, 'Nike Air Max', '2000', 'https://static.flexdog.cz/flexdog-f/products/images/af100e14-87b9-49c4-89e8-4690fd12f038.png?width=750&quality=70', 4),
(6, 'HP EliteBook', '20000', 'https://im9.cz/iR/importprodukt-orig/194/1943a0d62364ba156eac259791b2a3aa.jpg', 1),
(7, 'Nike Dunk', '1900', 'https://sectionstore.cz/wp-content/uploads/2023/02/Nike-Dunk-Low-Summit-White-Midnight-Navy.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cv06_slides`
--

CREATE TABLE `cv06_slides` (
  `slide_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv06_slides`
--

INSERT INTO `cv06_slides` (`slide_id`, `title`, `img`) VALUES
(1, 'Slide background 1', 'https://i0.wp.com/www.saevus.in/wp-content/uploads/2019/07/Blog-Feature-Image-size.png?fit=900%2C350&ssl=1'),
(2, 'Slide background 2', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6Hlia_vRMiaopE6n-xLk2_DTBK6SiSQqt-R_gCUjtNw&s'),
(3, 'Slide background 3', 'https://thebungeestore.com/wp-content/uploads/2023/04/patricia-serna-fOgyHkEkaOY-unsplash-900x350.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cv08_goods`
--

CREATE TABLE `cv08_goods` (
  `good_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT '\'\'',
  `img` text DEFAULT '\'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png\'',
  `last_edit` datetime NOT NULL,
  `user_edit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv08_goods`
--

INSERT INTO `cv08_goods` (`good_id`, `name`, `price`, `description`, `img`, `last_edit`, `user_edit`) VALUES
(102, 'Mauris vel', '303.57', 'non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(103, 'orci. Ut sagittis', '989.80', 'ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(104, 'ad', '539.02', 'Integer in', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(105, 'ultrices', '682.18', 'Duis risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec, euismod in, dolor. Fusce feugiat. Lorem ipsum', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(106, 'iaculis', '466.72', 'Donec', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(107, 'imperdiet dictum', '907.65', 'eu, placerat', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(108, 'Morbi vehicula. Pellentesque', '961.53', 'nisl sem, consequat nec, mollis vitae, posuere at, velit. Cras lorem lorem, luctus ut, pellentesque eget, dictum', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(109, 'adipiscing elit.', '118.18', 'a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(110, 'ultrices,', '753.65', 'et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(111, 'dapibus', '298.65', 'eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(112, 'gravida', '475.17', 'at, nisi. Cum sociis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(113, 'Proin', '751.60', 'dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(114, 'eu', '289.52', 'arcu. Aliquam', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(115, 'amet ante. Vivamus', '503.70', 'nascetur ridiculus mus. Proin vel arcu eu odio', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(116, 'vulputate, risus', '873.27', 'Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere vulputate, lacus.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(117, 'dolor vitae dolor.', '562.84', 'justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(118, 'ante', '815.41', 'Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(119, 'vulputate, risus a', '103.18', 'Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(120, 'neque tellus, imperdiet', '381.10', 'odio a purus. Duis elementum, dui quis accumsan convallis, ante lectus convallis est,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(121, 'Donec vitae', '634.03', 'Donec tempor, est ac mattis semper, dui lectus rutrum urna, nec luctus felis purus ac tellus. Suspendisse sed dolor. Fusce mi lorem, vehicula et,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(122, 'dui, semper', '180.31', 'faucibus lectus, a sollicitudin orci sem eget', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(123, 'nec, cursus', '920.17', 'dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(124, 'in consequat', '555.58', 'convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(125, 'nunc est,', '949.36', 'est tempor bibendum. Donec felis orci, adipiscing non, luctus sit', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(126, 'fermentum vel,', '105.21', 'molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(127, 'odio', '981.03', 'Cras dolor dolor, tempus non, lacinia at,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(128, 'semper.', '409.80', 'vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec, euismod', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(129, 'vestibulum lorem,', '800.77', 'Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(130, 'penatibus', '497.28', 'mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(131, 'nec, eleifend', '281.21', 'urna, nec luctus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(132, 'Nullam', '121.15', 'ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(133, 'ac orci.', '898.32', 'Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(134, 'lorem ut', '377.39', 'est arcu ac', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(135, 'commodo at,', '76.20', 'vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(136, 'pede blandit congue.', '983.54', 'ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(137, 'dictum', '488.08', 'In condimentum. Donec at arcu. Vestibulum ante ipsum primis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(138, 'non magna. Nam', '092.69', 'Morbi quis urna. Nunc quis arcu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(139, 'eu, accumsan', '495.07', 'mattis ornare, lectus ante dictum mi,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(140, 'consectetuer', '986.72', 'egestas a, scelerisque sed,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(141, 'convallis convallis', '842.09', 'iaculis nec, eleifend non, dapibus rutrum, justo. Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(142, 'nisi nibh lacinia', '217.35', 'Cras dolor dolor, tempus non, lacinia at, iaculis quis,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(143, 'eu', '424.64', 'dictum placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(144, 'tellus eu augue', '633.88', 'risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(145, 'lorem', '517.43', 'Etiam bibendum fermentum metus. Aenean sed pede nec ante blandit viverra. Donec', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(146, 'neque. Nullam nisl.', '278.32', 'ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(147, 'interdum', '557.82', 'mattis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(148, 'magna', '292.20', 'augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(149, 'id enim. Curabitur', '010.24', 'scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(150, 'lobortis,', '240.13', 'aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(151, 'purus. Maecenas libero', '466.42', 'amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(152, 'mi lorem,', '531.45', 'fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(153, 'Curabitur dictum. Phasellus', '405.78', 'enim non nisi. Aenean eget metus. In nec orci. Donec nibh. Quisque nonummy ipsum non arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(154, 'metus', '255.63', 'eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(155, 'non nisi. Aenean', '940.91', 'sit amet ante. Vivamus non lorem vitae odio', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(156, 'vehicula. Pellentesque', '854.63', 'luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(157, 'ultrices. Duis volutpat', '613.94', 'orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(158, 'eu arcu.', '083.37', 'in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(159, 'scelerisque scelerisque dui.', '830.90', 'sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(160, 'blandit enim', '221.80', 'luctus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(161, 'erat vel', '344.41', 'eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(162, 'mi', '913.31', 'dui augue', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(163, 'molestie arcu.', '593.74', 'dolor, tempus non, lacinia at, iaculis quis, pede. Praesent eu dui. Cum sociis natoque penatibus et magnis', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(164, 'luctus ut,', '386.86', 'non, luctus sit amet, faucibus ut,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(165, 'semper pretium', '915.68', 'cursus. Nunc mauris', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(166, 'faucibus lectus, a', '391.13', 'ut, nulla. Cras eu tellus eu augue porttitor interdum. Sed auctor odio a purus.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(167, 'vel', '586.22', 'metus. Aenean sed pede nec ante blandit viverra. Donec tempus, lorem fringilla ornare placerat, orci lacus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(168, 'euismod urna.', '082.05', 'vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(169, 'posuere', '786.80', 'magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(170, 'velit', '055.50', 'neque. Morbi quis urna. Nunc quis arcu vel quam', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(171, 'augue', '450.82', 'sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(172, 'sem ut', '341.45', 'viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(173, 'Cras eu', '193.96', 'interdum feugiat. Sed nec metus facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(174, 'Donec porttitor tellus', '578.25', 'dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(175, 'enim', '168.52', 'sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(176, 'euismod in, dolor.', '488.10', 'id, libero. Donec consectetuer', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(177, 'pulvinar', '565.23', 'Aliquam vulputate ullamcorper magna. Sed eu eros. Nam consequat dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(178, 'mauris eu', '202.97', 'pede blandit congue. In scelerisque scelerisque dui.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(179, 'pede', '085.48', 'auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(180, 'lacus,', '120.03', 'odio tristique', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(181, 'augue ut lacus.', '730.81', 'lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(182, 'lobortis mauris. Suspendisse', '147.09', 'parturient montes, nascetur ridiculus mus. Proin vel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(183, 'sapien', '143.38', 'Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(184, 'Mauris blandit enim', '481.83', 'libero est, congue a, aliquet vel, vulputate eu, odio. Phasellus at augue id ante dictum cursus. Nunc mauris elit, dictum eu, eleifend nec, malesuada ut, sem. Nulla interdum. Curabitur', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(186, 'Sed eu eros.', '981.39', 'et, lacinia vitae, sodales at, velit. Pellentesque', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(187, 'lorem, sit', '471.87', 'dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed,', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(188, 'non enim. Mauris', '142.20', 'facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(189, 'sociosqu', '308.91', 'placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(190, 'aliquam,', '631.88', 'id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(192, 'Aliquam', '902.05', 'dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(193, 'luctus', '920.19', 'placerat, augue. Sed molestie. Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris ut quam', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(213, 'Aliquam', '902', 'dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0),
(214, 'Aliquam', '888', 'dapibus id, blandit at, nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cv10_users`
--

CREATE TABLE `cv10_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privileges` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv10_users`
--

INSERT INTO `cv10_users` (`user_id`, `email`, `password`, `privileges`) VALUES
(1, 'user2@gmail.com', '$2y$10$V/oM41YBMJ9YBWY018dDae/n4vT.QcECLaIjf3eoPwHIUd6dBOBxO', 2),
(2, 'user1@gmail.com', '$2y$10$03rAgG686MHSZ5h0tHSIsOiX3BGq6iRJc89xduB4hmCf4.M.igYKK', 1),
(3, 'user3@gmail.com', '$2y$10$V5.UWGqRtp2f9hy.loZddOU4jkrp9MDNFOM0XS/aRB02eaEQ5CpC2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`, `description`, `image`, `last_update`) VALUES
(1, 'Fantasy', 'Fantasy je literární žánr, který se odehrává v imaginárních světech, plných magie, dobrodružství a nadpřirozených bytostí. Tyto světy často obsahují různé druhy ras, jako jsou lidé, elfové, trpaslíci, skřeti a další fantastické bytosti. Hlavními motivy fantasy jsou často epické dobrodružství, konflikty mezi dobrem a zlem, a cesta hrdinů, kteří čelí různým zkouškám a nebezpečím. Mezi nejznámější autory tohoto žánru patří J.R.R. Tolkien s Pánem prstenů, J.K. Rowlingová s Harry Potterem, a George R.R. Martin s Písní ledu a ohněm. Fantasy přináší čtenářům únik do světů plných kouzel a dobrodružství, kde jsou možnosti neomezené a jenom fantazie je jedinou hranicí.', 'https://logowik.com/content/uploads/images/colored-dragon5638.logowik.com.webp', '0000-00-00 00:00:00'),
(2, 'Superhrdinské', 'Superhrdinský žánr se točí kolem postav s nadlidskými schopnostmi, bojujících proti zlu a chránících svět. Tyto postavy často získají své schopnosti v důsledku neobvyklých událostí, jako jsou vědecké experimenty nebo nadpřirozené dědictví. Hrdinové mají typicky charakteristické kostýmy a masky, reprezentující symbol jejich boje za spravedlnost a udržování tajemství. Příběhy se často odehrávají v moderním světě a čelí morálním dilematům a osobním zkouškám. Týmové formace jsou běžné, a hrdinové často spolupracují, aby porazili nadpřirozené hrozby a zachránili lidstvo.', 'https://1000logos.net/wp-content/uploads/2017/06/Superman-Logo.png', '0000-00-00 00:00:00'),
(3, 'Horror', 'Hororový žánr se snaží vyvolat strach a napětí prostřednictvím nadpřirozených prvků, děsivých postav a temných prostředí. Příběhy často zahrnují upíry, vlkodlaky, duchy nebo sériové vrahy, kteří terorizují hlavní postavy v opuštěných domech, lesích nebo jiných strašidelných místech. Cílem hororu je vyvolat emoce hrůzy a úzkosti u publika pomocí děsivých scén, nečekaných zvratů a temné atmosféry.', 'https://img.freepik.com/premium-vector/scary-skull-face-vector-illustration_498048-167.jpg', '0000-00-00 00:00:00'),
(4, 'Mysteriozní', 'Mysteriozní žánr je plný tajemných zápletek, nečekaných zvratů a nevysvětlitelných událostí. Postavy se často snaží odhalit skrytou pravdu za podivnými jevy a tajemnými okolnostmi. Atmosféra je naplněna tajemstvím a nejistotou, držící čtenáře nebo diváka v napětí až do samotného konce.', 'https://images-platform.99static.com//m4X6Scy_qdPcSCeVSXN-DzGO8uw=/257x278:2242x2265/fit-in/500x500/projects-files/109/10900/1090090/e0692e26-9285-4f19-9b7d-52bfec988f10.png', '0000-00-00 00:00:00'),
(5, 'Science Fiction', 'Vědecko-fantastický (sci-fi) žánr je plný imaginárních technologií, cestování vesmírem a alternativních realit. Příběhy často zkoumají budoucnost, cizí civilizace a různé možnosti, jak by se mohl svět vyvíjet. Hlavními motivy jsou technologický pokrok, lidská expanze do vesmíru a setkání s mimozemskými formami života. Sci-fi nabízí čtenářům a divákům únik do světa plného možností a nových horizontů, přičemž často klade otázky naší vlastní existence a budoucnosti.', 'https://s3.us-east-1.amazonaws.com/cdn.designcrowd.com/blog/Top%2010%20Logos%20of%20The%20Most%20Popular%20Sci-Fi%20Films/StarTrek.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `overall_price` float NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `timestamp`, `overall_price`, `state`) VALUES
(1, 4, '2024-05-28 20:20:56', 93, 'Zaplaceno'),
(2, 4, '2024-05-28 20:23:35', 15.5, 'Zaplaceno'),
(3, 4, '2024-05-28 23:55:18', 17.25, 'Zaplaceno'),
(4, 4, '2024-05-28 23:56:31', 10, 'Zaplaceno'),
(5, 4, '2024-05-28 23:57:45', 10, 'Zaplaceno'),
(6, 4, '2024-05-28 23:59:49', 16.75, 'Zaplaceno'),
(7, 4, '2024-05-29 00:02:37', 15.5, 'Zaplaceno'),
(8, 4, '2024-05-29 00:59:59', 15.99, 'Zaplaceno'),
(9, 4, '2024-05-29 01:49:16', 15.99, 'Zaplaceno'),
(10, 9, '2024-05-30 18:02:54', 41.49, 'Zaplaceno'),
(11, 10, '2024-05-30 18:10:36', 19.5, 'Zaplaceno');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `description`, `image`, `last_update`) VALUES
(1, 'DC Comics', 'DC Comics je jedno z největších a nejstarších amerických komiksových nakladatelství, známé pro své ikonické superhrdiny jako jsou Batman, temný rytíř chránící Gotham City, Superman, nejsilnější hrdina s nadlidskými schopnostmi, a Wonder Woman, amazonská válečnice s božskými silami. DC Comics vytváří příběhy plné dobrodružství, morálních dilemat a epických bojů mezi dobrem a zlem, často zasazené do jejich sdíleného vesmíru, kde hrdinové spolupracují jako členové Justice League, aby chránili svět před různými hrozbami.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/DC_Comics_logo.svg/1200px-DC_Comics_logo.svg.png', '2024-05-30 16:09:32'),
(2, 'Marvel Comics', 'Marvel Comics je jedno z nejvýznamnějších amerických komiksových nakladatelství, známé pro své rozsáhlé univerzum plné superhrdinů. Mezi nejznámější postavy patří Spider-Man, mladík s pavoučími schopnostmi, Iron Man, génius v brnění, a Captain America, supersoldát z druhé světové války. Marvel vytváří příběhy, které často kombinují akci, drama a humor, zasazené do sdíleného vesmíru, kde se hrdinové setkávají a spolupracují jako členové týmů, jako jsou Avengers nebo X-Men, aby chránili svět před různými hrozbami a padouchy.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/Marvel-Comics-Logo.svg/1280px-Marvel-Comics-Logo.svg.png', '0000-00-00 00:00:00'),
(3, 'Valiant Comics', 'Valiant Comics je americké komiksové nakladatelství známé pro své sdílené univerzum a originální superhrdiny. Mezi nejznámější postavy patří Bloodshot, voják s nanotechnologií, X-O Manowar, mimozemský válečník v brnění, a Harbinger, tým mladých superlidí s telepatickými schopnostmi. Valiant Comics se vyznačuje realistickými příběhy a komplexními postavami, které často čelí hlubokým morálním dilematům a spolupracují proti společným hrozbám.', 'https://upload.wikimedia.org/wikipedia/commons/f/f3/Valiant_Comics_logo_%28April_2012%29.svg', '0000-00-00 00:00:00'),
(4, 'Dark Horse Comics', 'Dark Horse Comics je americké komiksové nakladatelství známé pro svou rozmanitou paletu žánrů a tvůrčí svobody. Firma je známa nejen pro vydávání komiksů, ale také pro adaptace filmů, her a knih. Mezi nejznámější tituly patří &quot;Hellboy&quot;, o démonovi s lidmi jako vlastníkem, &quot;Sin City&quot;, temným noirovým thrillerem od Franka Millera, a &quot;Star Wars&quot; komiksy předtím, než byla licence převedena na Marvel. Dark Horse se vyznačuje propracovanými příběhy a originálními koncepty, což je dělá oblíbeným vydavatelem pro fanoušky komiksů hledajících něco odlišného od mainstreamu.', 'https://upload.wikimedia.org/wikipedia/en/thumb/f/f8/Dark_Horse_Comics_logo.svg/1200px-Dark_Horse_Comics_logo.svg.png', '0000-00-00 00:00:00'),
(5, 'Image Comics', 'Image Comics je nezávislé americké komiksové nakladatelství založené v roce 1992 umělci a spisovateli. Je známé pro originální a nezávislé tituly, které zahrnují různorodé žánry od superhrdinů po sci-fi a horory. Mezi nejznámější patří &quot;Spawn&quot;, &quot;The Walking Dead&quot; a &quot;Saga&quot;. Image Comics poskytuje tvůrcům větší kontrolu nad jejich pracemi a je oblíbenou destinací pro originální a experimentální komiksy.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Image_Comics_logo.svg/452px-Image_Comics_logo.svg.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `privileges` int(3) NOT NULL DEFAULT 1,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `privileges`, `token`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$YONNKV3LE9hXPf7/SvOaPeoFjQRZnt8y7akcOxmF07gwiqYT0VEZ.', 3, NULL),
(4, 'Pavlis', 'paja.lacina@gmail.com', NULL, 1, '113389183248999187403'),
(7, 'Petr', 'petr@gmail.com', '$2y$10$0SWw1i4Gk4sIhsZI8GAE5.Ze8xW/XpI7VMcmd8Yq97niaC1rjP.vS', 1, NULL),
(9, 'nguv03', 'nguv03@vse.cz', '$2y$10$BkOSZjGo8Sje9tGofd8RHO4wrqfWPkDALIqE9oW.9rhlLeR4fnmhi', 1, NULL),
(10, 'Nguyen Viet Bach', 'nvbach91@gmail.com', NULL, 1, '109373061699120364195');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `book_id`) VALUES
(2, 17),
(4, 11),
(9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `world`
--

CREATE TABLE `world` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `world`
--

INSERT INTO `world` (`id`, `name`, `description`, `image`, `last_update`) VALUES
(1, 'Marvel Universe', 'Marvel svět je plný superhrdinů a superpadouchů, kteří se potýkají s různými hrozbami a zachraňují svět před zkázou. Mezi nejznámější hrdiny patří Spider-Man, mladík s pavoučími schopnostmi, Iron Man, geniální vynálezce v bojovém obleku, a Thor, bůh hromu. Ti se často spojují do týmů, jako jsou Avengers, aby čelili ještě větším výzvám a zachránili vesmír před temnými silami, jako je Thanos nebo Loki.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Marvel_Logo.svg/2560px-Marvel_Logo.svg.png', '2024-05-31 10:29:56'),
(2, 'DC Universe', 'DC svět, známý také jako DC Universe, je další fiktivní vesmír, kde se odehrávají příběhy superhrdinů a padouchů vytvořených společností DC Comics. Tento svět je plný legendárních postav, které bojují za spravedlnost a ochranu světa. Mezi nejznámější hrdiny patří Batman, temný rytíř s bohatým arzenálem vynálezů a schopností, Superman, silný a nezranitelný hrdina s nadlidskými schopnostmi, a Wonder Woman, princezna bojovnice s božskými mocemi. Ti se často spojují do týmů, jako jsou Justice League, aby čelili hrozbám, které by jednotlivě nemohli zvládnout, a zachránili svět před zkázou.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/DCUniverse.svg/1056px-DCUniverse.svg.png', '0000-00-00 00:00:00'),
(3, 'Středozem (Pán Prstenů)', 'Středozem je fantastický svět vytvořený J.R.R. Tolkienem, který je známý zejména díky jeho epické fantasy trilogii Pán prstenů. Tento svět je plný magie, dobrodružství a různorodých ras, jako jsou lidé, elfové, trpaslíci, hobiti a skřeti. Středozem je domovem mnoha legendárních míst, jako je Přístav měst, Mordor, Lothlórien a Mlžné hory. Příběh sleduje skupinu hrdinů v jejich snaze zničit Jedno Prsten, mocný artefakt, který by mohl přinést zkázu celému světu, a porazit temného pána Saurona. Cestou čelí nejrůznějším nebezpečím, zkouškám a hledají spojence, aby zachránili Středozem před temnou mocí.', 'https://upload.wikimedia.org/wikipedia/de/c/ce/Middle_of_Middle-earth_Logo.jpg', '0000-00-00 00:00:00'),
(4, 'Star Wars', 'Star Wars je epický sci-fi vesmír vytvořený Georgem Lucasem, který sleduje nekonečný konflikt mezi Světlem a Temnotou v galaxii daleko, daleko pryč. Tento svět je obýván různými druhy bytostí, jako jsou lidé, wookieové, droidi a různé mimozemské rasy. Centrálními postavami jsou Jedi rytíři, kteří ovládají Sílu a bojují za mír a spravedlnost, a Sithové, kteří touží po moci a ovládání galaxie. Příběh sleduje osudy postav jako je Luke Skywalker, mladík, který se stane poslední nadějí pro Jedi řád, princezna Leia Organa, rebelka bojující proti Tyranskému Impériu, a Darth Vader, temný lord Sithů. V průběhu série se odehrávají bitvy mezi Imperiální flotilou a Rebel Alliance, přičemž je na hraně osudu osudu galaxie.', 'https://logowik.com/content/uploads/images/528_star_wars.jpg', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `world_id` (`world_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

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
  ADD KEY `category_id` (`category_id`);

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
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `world`
--
ALTER TABLE `world`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cv06_categories`
--
ALTER TABLE `cv06_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv06_products`
--
ALTER TABLE `cv06_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cv06_slides`
--
ALTER TABLE `cv06_slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cv08_goods`
--
ALTER TABLE `cv08_goods`
  MODIFY `good_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `cv10_users`
--
ALTER TABLE `cv10_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `world`
--
ALTER TABLE `world`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`world_id`) REFERENCES `world` (`id`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
