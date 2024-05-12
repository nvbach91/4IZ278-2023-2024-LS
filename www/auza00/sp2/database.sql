CREATE TABLE `users` (
  `user_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(255),
  `password` varchar(255),
  `email` varchar(255)
);

CREATE TABLE `spots` (
  `spot_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` integer NOT NULL,
  `username` varchar(255),
  `title` varchar(255),
  `description` text,
  `coordinatesX` double,
  `coordinatesY` double,
  `category` varchar(255),
  `image_id` varchar(255),
  `created_at` datetime
);

CREATE TABLE `likes` (
  `spot_id` integer NOT NULL,
  `user_id` integer NOT NULL,
  `date` datetime
);

CREATE TABLE `comments` (
  `comment_id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `spot_id` integer NOT NULL,
  `user_id` integer NOT NULL,
  `date` datetime,
  `text` text
);

ALTER TABLE `spots` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `likes` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `likes` ADD FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE;

ALTER TABLE `comments` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `comments` ADD FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE;

/*CREATE TABLE `spots_comments` (
  `spot_id` integer,
  `comment_id` integer,
  CONSTRAINT `spots_comments_pk` PRIMARY KEY (`spot_id`, `comment_id`)
);

ALTER TABLE `spots_comments` ADD CONSTRAINT `FK_spot` FOREIGN KEY (`spot_id`) REFERENCES `spots` (`spot_id`) ON DELETE CASCADE;
ALTER TABLE `spots_comments` ADD CONSTRAINT `FK_comment` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`);

*/