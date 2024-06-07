-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Úte 04. čen 2024, 16:31
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
-- Databáze: `fanm02`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `cv06_categories`
--

CREATE TABLE `cv06_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `cv06_categories`
--

INSERT INTO `cv06_categories` (`category_id`, `name`, `number`) VALUES
(1, 'Elektronika', 0),
(2, 'Sport', 1),
(3, 'Zahrada', 2),
(4, 'Auto-moto', 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `cv06_products`
--

CREATE TABLE `cv06_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `cv06_products`
--

INSERT INTO `cv06_products` (`product_id`, `name`, `category_id`, `price`, `img`) VALUES
(1, 'iPhone 15 Pro', 1, '28 790', 'https://image.alza.cz/products/RI047b1/RI047b1.jpg?width=500&height=500'),
(2, 'De\'Longhi Magnifica Compact ECAM', 1, '7 777', 'https://image.alza.cz/products/DELAK911/DELAK911.jpg?width=500&height=500'),
(3, 'Mikasa BV550C', 2, '1 989', 'https://image.alza.cz/products/SPTmik021/SPTmik021.jpg?width=500&height=500'),
(4, 'Yonex Mavis 350 žluté/střední', 2, '269', 'https://image.alza.cz/products/SPT376/SPT376.jpg?width=500&height=500'),
(5, 'FIELDMANN FZV 2004-E', 3, '2 299', 'https://image.alza.cz/products/BOJ108c/BOJ108c.jpg?width=500&height=500'),
(6, 'HAPPY GREEN Houpačka', 3, '2 049', 'https://image.alza.cz/products/HPG060b/HPG060b.jpg?width=500&height=500'),
(7, 'Altenzo Sports Comforter 205/55', 4, '1 160', 'https://image.alza.cz/products/AUPRze181/AUPRze181.jpg?width=500&height=500');

-- --------------------------------------------------------

--
-- Struktura tabulky `cv06_slides`
--

CREATE TABLE `cv06_slides` (
  `slide_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `cv06_slides`
--

INSERT INTO `cv06_slides` (`slide_id`, `title`, `product_id`, `img`) VALUES
(1, 'iPhone 15 Pro', 1, 'https://image.alza.cz/products/RI045b1/RI045b1-05.jpg?width=1400&height=1400'),
(2, 'De\'Longhi Magnifica Compact ECAM', 2, 'https://image.alza.cz/products/DELAK911/DELAK911-04.jpg?width=1400&height=1400'),
(3, 'HAPPY GREEN Houpačka', 6, 'https://static.onlineshop.cz/data/eshop_online/gallery/17/83508-4353958-os/zahradni-houpacka-happy-green-stripy-ii-4353958.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_dorms`
--

CREATE TABLE `sp_dorms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `address` varchar(510) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_dorms`
--

INSERT INTO `sp_dorms` (`id`, `name`, `school`, `address`) VALUES
(1, 'Kolej Blanice', 'Prague University of Economics and Business', 'Chemická 955 148 00 Praha 4'),
(2, 'Kolej Vltava', 'Prague University of Economics and Business', 'Chemická 953 148 00 Praha 4'),
(3, 'Rooseveltova kolej', 'Prague University of Economics and Business', 'Strojnická 1430/7 170 00 Praha 7'),
(4, 'Palachova kolej', 'Prague University of Economics and Business', 'Hartigova 93/198 130 00 Praha 3'),
(5, 'University hotel', 'Prague University of Economics and Business', 'Jeseniova 355/212 130 00 Praha 3'),
(6, 'Kolej Jarov II', 'Prague University of Economics and Business', 'Pod lipami 2603/43 130 00 Praha 3'),
(7, 'Eislerova kolej', 'Prague University of Economics and Business', 'V Zahrádkách 1953/67 130 00 Praha 3'),
(8, 'Thalerova kolej', 'Prague University of Economics and Business', 'Jeseniova 1954/210 130 00 Praha 3');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_meals`
--

CREATE TABLE `sp_meals` (
  `id` int(11) NOT NULL,
  `chef_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(510) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `pickup_dorm` int(11) NOT NULL,
  `pickup_room` varchar(255) DEFAULT NULL,
  `pickup_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` decimal(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_meals`
--

INSERT INTO `sp_meals` (`id`, `chef_id`, `title`, `description`, `photo_url`, `pickup_dorm`, `pickup_room`, `pickup_time`, `price`, `status`, `created_at`, `updated_at`) VALUES
(3, 15, 'Lemon-Dill Grilled Salmon with Garlic Mashed Potatoes and Sautéed Asparagus', 'Savor the flavors of a perfectly grilled salmon fillet, marinated in a zesty lemon-dill sauce, and served atop a bed of creamy garlic mashed potatoes. Accompanied by a side of crisp, sautéed asparagus spears and a drizzle of balsamic glaze, this meal offers a harmonious blend of savory and tangy notes, promising a delightful culinary experience.', 'uploads/listing/shot_60_390392.jpg', 6, '6516', '2024-06-03 17:59:43', '12.00', 1, '2024-06-01 07:17:42', '2024-06-01 07:17:42'),
(6, 15, 'Gourmet Cheeseburger with Truffle Fries and Chipotle Aioli', 'Indulge in the Ultimate Gourmet Cheeseburger, featuring a juicy, hand-pressed beef patty topped with melted aged cheddar, crispy bacon, and caramelized onions. Nestled in a toasted brioche bun with fresh lettuce, ripe tomato, and a dollop of creamy chipotle aioli, this burger is a symphony of flavor', 'uploads/listing/truffle-7x5-web-and-social.jpg', 6, '221c', '2024-06-25 21:19:00', '5.00', 1, '2024-06-03 16:13:23', '2024-06-03 16:13:23'),
(7, 15, 'Garlic Butter Shrimp Scampi with Linguine and Lemon Asparagus', 'Delight in the Garlic Butter Shrimp Scampi, featuring succulent shrimp sautéed in a rich garlic butter sauce, tossed with al dente linguine. Paired with lemon-infused asparagus spears, this meal offers a luxurious and flavorful seafood experience.', 'uploads/listing/1460737098-delish-asparagus-shrimp.jpg', 6, '123', '2024-06-24 21:04:00', '4.99', 1, '2024-06-03 16:56:19', '2024-06-03 16:56:19'),
(8, 15, 'Herb-Crusted Rack of Lamb with Rosemary Potatoes and Mint Peas', 'Savor the Herb-Crusted Rack of Lamb, perfectly roasted and seasoned with a blend of fresh herbs. Accompanied by crispy rosemary potatoes and sweet mint peas, this meal delivers a sophisticated and hearty culinary delight.', 'uploads/listing/hayfield20manor20recipe20image.jpg', 6, '450', '2024-07-11 19:00:00', '7.89', 1, '2024-06-03 16:57:16', '2024-06-03 16:57:16'),
(9, 15, 'Thai Green Curry Chicken with Jasmine Rice and Spring Rolls', 'Enjoy the Thai Green Curry Chicken, featuring tender chicken simmered in a fragrant green curry sauce with coconut milk, bamboo shoots, and bell peppers. Served with fluffy jasmine rice and crispy spring rolls, this meal offers an aromatic and spicy Thai experience.', 'uploads/listing/quick-thai-green-chicken-curry-c6f72ac9.jpg', 6, '12a', '2024-06-04 11:48:55', '8.54', 2, '2024-06-03 16:58:20', '2024-06-03 16:58:20'),
(10, 15, 'Beef Wellington with Truffle Mashed Potatoes and Glazed Carrots', 'Indulge in the classic Beef Wellington, a tender beef fillet wrapped in a puff pastry with mushroom duxelles and prosciutto. Paired with truffle mashed potatoes and honey-glazed carrots, this meal promises a rich and elegant dining experience.', 'uploads/listing/beef-wellington-for-two.jpg', 3, '320', '2024-06-19 19:00:00', '12.00', 1, '2024-06-03 16:59:07', '2024-06-03 16:59:07'),
(11, 15, 'Lemon Herb Grilled Salmon with Quinoa Salad and Roasted Brussels Sprouts', 'Savor the Lemon Herb Grilled Salmon, marinated in a zesty lemon herb sauce and grilled to perfection. Served alongside a refreshing quinoa salad and roasted Brussels sprouts, this meal offers a light yet satisfying burst of flavors.', 'uploads/listing/images.jpg', 8, '988', '2024-06-06 22:04:00', '16.84', 1, '2024-06-03 17:00:38', '2024-06-03 17:00:38'),
(12, 15, 'Chicken Parmesan with Spaghetti Marinara and Garlic Bread', 'Enjoy the classic Chicken Parmesan, featuring breaded chicken cutlets topped with marinara sauce and melted mozzarella. Paired with spaghetti marinara and a side of buttery garlic bread, this meal delivers an Italian comfort food favorite.', 'uploads/listing/Chicken-Parmesan-Show-Me-the-Yummy-Google-Thumb-Retina-1-opt.jpg', 7, '330', '2024-06-03 17:57:06', '9.99', 1, '2024-06-03 17:01:36', '2024-06-03 17:01:36'),
(13, 15, 'Miso-Glazed Cod with Sesame Rice and Stir-Fried Vegetables', 'Relish the Miso-Glazed Cod, a tender fillet marinated in a sweet and savory miso glaze. Served with sesame rice and a medley of stir-fried vegetables, this meal offers a delightful fusion of Asian-inspired flavors.', 'uploads/listing/kc-glazed-cod-superJumbo.jpg', 6, '654', '2024-06-21 17:03:00', '8.88', 1, '2024-06-03 17:03:22', '2024-06-03 17:03:22'),
(14, 15, 'Stuffed Bell Peppers with Couscous and Greek Yogurt Sauce', 'Delight in the Stuffed Bell Peppers, filled with a flavorful mixture of couscous, ground beef, tomatoes, and herbs. Served with a tangy Greek yogurt sauce, this meal provides a wholesome and hearty Mediterranean experience.', 'uploads/listing/1400x919-Stuffed-peppers-recipe-aaf8c419-903b-4b1b-9839-9916d36a17bc-0-1400x919.jpg', 3, '111', '2024-06-06 17:04:00', '4.98', 1, '2024-06-03 17:04:14', '2024-06-03 17:04:14'),
(15, 15, 'BBQ Pulled Pork Sandwich with Coleslaw and Baked Beans', 'Indulge in the BBQ Pulled Pork Sandwich, featuring slow-cooked pulled pork smothered in tangy BBQ sauce and topped with crunchy coleslaw. Served with a side of baked beans, this meal offers a mouthwatering blend of smoky and savory flavors.', 'uploads/listing/1000_F_240535740_pU7eplaiEM63uCP0d2FWlwzoR4u1sChY.jpg', 6, '12a', '2024-06-12 22:10:00', '3.59', 1, '2024-06-03 17:05:13', '2024-06-03 17:05:13'),
(16, 15, 'Vegetable Stir-Fry with Tofu and Jasmine Rice', 'Enjoy the Vegetable Stir-Fry, a colorful medley of fresh vegetables sautéed with tofu in a savory soy-ginger sauce. Paired with fluffy jasmine rice, this meal provides a light and nutritious vegetarian option bursting with flavor.', 'uploads/listing/BBA8BBCE-808E-4B84-85E8-4D063F6D8F63.jpg', 1, '901', '2024-06-21 17:06:00', '3.21', 1, '2024-06-03 17:06:29', '2024-06-03 17:06:29'),
(18, 16, 'Testing meal', 'meal for testing', NULL, 1, 'Pod schody u vchodu', '2024-06-11 16:39:00', '5.99', 1, '2024-06-04 12:36:01', '2024-06-04 12:36:01');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_messages`
--

CREATE TABLE `sp_messages` (
  `id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` varchar(510) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_messages`
--

INSERT INTO `sp_messages` (`id`, `meal_id`, `sender_id`, `receiver_id`, `content`, `sent_at`) VALUES
(1, 9, 15, 15, 'Hi, thanks for buying!', '2024-06-04 11:49:28'),
(2, 9, 15, 15, 'Hope you will enjoy my meal', '2024-06-04 11:49:47'),
(3, 9, 15, 15, 'Come around 13:45', '2024-06-04 11:50:04'),
(4, 9, 16, 15, 'Ok, will be there', '2024-06-04 11:50:10'),
(5, 9, 16, 15, 'Looking forward!', '2024-06-04 13:22:13'),
(6, 9, 16, 15, 'Me too!', '2024-06-04 13:56:17'),
(7, 9, 15, 15, 'Great', '2024-06-04 13:56:41');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_orders`
--

CREATE TABLE `sp_orders` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `filled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_orders`
--

INSERT INTO `sp_orders` (`id`, `buyer_id`, `seller_id`, `meal_id`, `filled_at`) VALUES
(1, 16, 15, 9, '2024-06-04 11:48:55');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_tokens`
--

CREATE TABLE `sp_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_tokens`
--

INSERT INTO `sp_tokens` (`id`, `email`, `token`, `created_at`, `expires_at`) VALUES
(1, 'shaltock@gmail.com', '0b04d36561115ec6669e8c16e563a1bfedea7bb680481ae4b5c4c2498866fd24', '2024-06-04 13:39:49', '2024-06-04 13:54:49');

-- --------------------------------------------------------

--
-- Struktura tabulky `sp_users`
--

CREATE TABLE `sp_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `dorm_id` int(11) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sp_users`
--

INSERT INTO `sp_users` (`id`, `username`, `email`, `passwordHash`, `dorm_id`, `photo_url`, `created_at`) VALUES
(15, 'test1', 'fanm02@vse.cz', '$2y$10$imV7dO/1hZOdNAaq.E7H6.0d43AfTDGP6t5rKHZls1ND3C0Cz7yoC', 6, 'uploads/profile/Tux.svg.png', '2024-05-30 12:27:27'),
(16, 'test2', 'shaltock@gmail.com', '$2y$10$vsiRD2y564.rtcbocmQXj.EpUzEwMeNWrEbub1tSiZUEcTNTy7KhO', 1, NULL, '2024-06-02 09:59:16');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `cv06_categories`
--
ALTER TABLE `cv06_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexy pro tabulku `cv06_products`
--
ALTER TABLE `cv06_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexy pro tabulku `cv06_slides`
--
ALTER TABLE `cv06_slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexy pro tabulku `sp_dorms`
--
ALTER TABLE `sp_dorms`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `sp_meals`
--
ALTER TABLE `sp_meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_chef_id` (`chef_id`),
  ADD KEY `FK_meals_pickup_dorm` (`pickup_dorm`);

--
-- Indexy pro tabulku `sp_messages`
--
ALTER TABLE `sp_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_meal_id` (`meal_id`),
  ADD KEY `FK_sender_id` (`sender_id`),
  ADD KEY `FK_receiver_id` (`receiver_id`);

--
-- Indexy pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_buyer_id` (`buyer_id`),
  ADD KEY `FK_seller_id` (`seller_id`),
  ADD KEY `FK_orders_meal_id` (`meal_id`);

--
-- Indexy pro tabulku `sp_tokens`
--
ALTER TABLE `sp_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tokens_email` (`email`);

--
-- Indexy pro tabulku `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cv06_categories`
--
ALTER TABLE `cv06_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `cv06_products`
--
ALTER TABLE `cv06_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `cv06_slides`
--
ALTER TABLE `cv06_slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `sp_dorms`
--
ALTER TABLE `sp_dorms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `sp_meals`
--
ALTER TABLE `sp_meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pro tabulku `sp_messages`
--
ALTER TABLE `sp_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pro tabulku `sp_tokens`
--
ALTER TABLE `sp_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `sp_meals`
--
ALTER TABLE `sp_meals`
  ADD CONSTRAINT `FK_chef_id` FOREIGN KEY (`chef_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_meals_pickup_dorm` FOREIGN KEY (`pickup_dorm`) REFERENCES `sp_dorms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sp_messages`
--
ALTER TABLE `sp_messages`
  ADD CONSTRAINT `FK_meal_id` FOREIGN KEY (`meal_id`) REFERENCES `sp_meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sender_id` FOREIGN KEY (`sender_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sp_orders`
--
ALTER TABLE `sp_orders`
  ADD CONSTRAINT `FK_buyer_id` FOREIGN KEY (`buyer_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_orders_meal_id` FOREIGN KEY (`meal_id`) REFERENCES `sp_meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `sp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sp_tokens`
--
ALTER TABLE `sp_tokens`
  ADD CONSTRAINT `FK_tokens_email` FOREIGN KEY (`email`) REFERENCES `sp_users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
