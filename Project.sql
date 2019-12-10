-- ----------------------------------------
-- SCHEMA  
-- ----------------------------------------
DROP DATABASE IF EXISTS `lokham`;
CREATE DATABASE IF NOT EXISTS `lokham` DEFAULT CHARACTER SET UTF8;
SHOW WARNINGS;
USE `lokham`; 
-- ----------------------------------------
--   Table `users`
-- ----------------------------------------
DROP TABLE IF EXISTS `users`;
SHOW WARNINGS;

CREATE TABLE IF NOT EXISTS `lokham`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(25) NOT NULL DEFAULT '',
  `last_name` VARCHAR(25) NOT NULL DEFAULT '',
  `middle_name` VARCHAR(25) NULL DEFAULT '',
  `profile_image` VARCHAR(255) NULL,
  `phone` VARCHAR(16) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'general') NOT NULL DEFAULT 'general',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)) ENGINE = INNODB DEFAULT CHARSET=UTF8;
  
SHOW WARNINGS;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `middle_name`, `phone`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Sourav', 'Patteri', '', '7067910774', 'srv.ptr@gmail.com', '$2y$10$a8AHDsFblwOih1bUTWMtZeRoNbe1EFk9.o7eKNEJ1/lAHox9ZNtUi', 'general',  '2019-11-04 08:50:02', '2019-11-04 15:30:20');
-- ----------------------------------------
--   Table `issues`
-- ----------------------------------------
 
DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `lokham`.`issues` (
	`issue_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
  `title` varchar(500) NOT NULL,
  `image` VARCHAR(255) NULL,
	`content` TEXT NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     PRIMARY KEY (`issue_id`)) ENGINE = INNODB DEFAULT CHARSET=UTF8;
     
-- Constraints for table `issues`

  ALTER TABLE `lokham`.`issues`
  ADD INDEX `fk_users_idx` (`user_id` ASC),
  ADD CONSTRAINT `fk_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `lokham`.`users` (`id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE;
  
INSERT INTO `issues` (`issue_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Earth is dying', '2019-11-04 08:50:02', '2019-11-04 15:30:20');

-- ----------------------------------------
--   Table `ratings`
-- ----------------------------------------
 
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `lokham`.`ratings` (
	`user_id` INT NOT NULL,
	`issue_id` INT NOT NULL,
	`rating` ENUM('1', '2', '3', '4', '5') NOT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE = INNODB DEFAULT CHARSET=UTF8;
     
-- Constraints for table `ratings`

  ALTER TABLE `lokham`.`ratings`
  ADD INDEX `fk_users_idx` (`user_id` ASC),
  ADD CONSTRAINT `fk_rating_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `lokham`.`users` (`id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE,
  ADD INDEX `fk_issues_idx` (`issue_id` ASC),
  ADD CONSTRAINT `fk_rating_issue`
  FOREIGN KEY (`issue_id`)
  REFERENCES `lokham`.`issues` (`issue_id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

INSERT INTO `ratings` (`user_id`, `issue_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, '5', '2019-11-04 08:50:02', '2019-11-04 15:30:20');
-- ----------------------------------------
--   Table `comments`
-- ----------------------------------------

DROP TABLE IF EXISTS `comments`;
SHOW WARNINGS;

CREATE TABLE IF NOT EXISTS `lokham`.`comments` (
  `comment_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `issue_id` INT NOT NULL,
  `comment` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)) ENGINE = INNODB DEFAULT CHARSET=UTF8;
  
  -- Constraints for table `comments` 

  ALTER TABLE `lokham`.`comments` 
  ADD INDEX `fk_users_idx` (`user_id` ASC),
  ADD CONSTRAINT `fk_comment_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `lokham`.`users` (`id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE,
  ADD INDEX `fk_issues_idx` (`issue_id` ASC),
  ADD CONSTRAINT `fk_comment_issue`
  FOREIGN KEY (`issue_id`)
  REFERENCES `lokham`.`issues` (`issue_id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE;
  
INSERT INTO `comments` (`comment_id`, `user_id`, `issue_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'And unless we act right now, we cannot save it', '2019-11-04 08:50:02', '2019-11-04 15:30:20');


-- Populate users table
INSERT INTO `users` VALUES
('2','Alayna','Oberbrunner','nisi',NULL,'466-606-7484','ikoch@example.org','562f93b1d3e040701d844fc0ffcd7041d3506d00','admin','1973-06-20 05:19:47','2016-04-30 00:29:52'),
('3','Augustine','Emard','quasi',NULL,'017-292-9203','alena.sawayn@example.net','051cb3835e5138ae5d283a1aef547a7ba30aec59','general','1998-03-17 13:50:24','1975-11-24 17:30:24'),
('4','Vern','Heidenreich','qui',NULL,'587.613.0924','mayer.amiya@example.com','931c274d96b9409b83e161ac4e100ae2091ceedb','general','1984-09-21 06:03:04','2017-10-25 19:02:15'),
('5','Rasheed','Williamson','quo',NULL,'(770)595-1439','mabelle.trantow@example.net','c22c90437f354d87283f3eef7ab1c946e8ff7638','general','2016-11-01 19:42:53','2009-02-16 13:40:50'),
('6','Doyle','Weissnat','possimus',NULL,'(454)338-8517x93','stanton.collin@example.com','68fa2270adbd0b37daf5ec1cd6866b0064fc61ce','admin','1982-05-22 12:38:16','1983-01-09 15:23:25'),
('7','Velva','Mayert','qui',NULL,'+27(9)6975494062','aemard@example.com','ed3883ee4580c8afc117c0cd361fb3abfd014e02','admin','1983-07-14 12:04:51','2006-09-01 16:08:26'),
('8','Haley','Corkery','soluta',NULL,'+79(5)6119700147','rosemarie.johnston@example.org','0523bb5210b54f0e5134071b130c77e9e6cda8c9','admin','2000-05-10 20:47:56','1992-12-11 12:25:31'),
('9','Raphael','Littel','dolorum',NULL,'236-917-0957x878','gaylord98@example.net','1d8e717f37f30cbbd9e1f505cdb214db4f778c21','admin','2012-10-09 16:38:41','2009-05-18 02:21:40'),
('10','Saige','Macejkovic','quae',NULL,'03135261118','jonatan42@example.com','1ef1cb8617984f6031fc682f7d8da9f6523acd25','general','2010-02-23 21:51:24','1993-06-28 15:43:29'),
('11','Jamel','Weimann','occaecati',NULL,'109.006.5271','halle35@example.net','cb2eb42950a79e74322e2de701dcd6b8a3ee4356','general','2004-03-26 08:45:46','2008-11-15 11:53:45'),
('12','Sabina','Jenkins','quidem',NULL,'553.256.9689','matteo.spencer@example.com','35dfdcb5597a44f518911546d254dcc7a72f955d','general','1980-03-03 00:04:37','1987-11-17 04:33:22'),
('13','Alexane','Littel','quos',NULL,'1-336-367-4974','auer.nathanael@example.net','cd6038346a9210ee264e2af0eea88ccba862f787','general','2007-11-24 19:07:57','1981-12-03 11:17:05'),
('14','Vernie','Gleason','occaecati',NULL,'653-640-3622','ludie.koch@example.org','49d3c575a2377a0810d6b22d22879b2a9e85552f','admin','1994-03-08 19:29:09','1995-04-24 11:57:01'),
('15','Vergie','Nikolaus','iusto',NULL,'862.414.1351','nelson41@example.net','3ba7bae07873dad0df0b4159aa8c64cdc3ab0e9a','admin','2009-02-06 06:29:11','2004-07-27 16:25:22'),
('16','Alicia','Hettinger','quos',NULL,'006.603.0674x851','euna56@example.org','25732b049a7fcd633492172c4029059a8c2b3255','general','2002-10-22 19:23:43','1975-11-20 08:24:39'),
('17','Vicenta','Torp','voluptatem',NULL,'(342)659-0828x00','ppredovic@example.org','e226f852d571e02a60c2f4bbb74ec10cd5cc1ef6','admin','2000-06-11 05:21:34','1999-11-24 04:43:19'),
('18','Carter','Sauer','quas',NULL,'1-407-339-0803','minnie15@example.com','01308cb40f3f34e875743a97e4b038744cf37d43','general','2018-10-09 15:50:30','1990-12-18 00:04:44'),
('19','Mose','Keebler','ut',NULL,'03304104135','arvilla45@example.com','ef6a68da30231b963fa70fabbe3a6d214d8bae3b','general','2018-08-07 01:20:05','2010-06-10 00:05:36'),
('20','Jayce','Hagenes','dolores',NULL,'09228910331','cnitzsche@example.org','c56ee06872c6972dbf66fb5dd3ab56264d028975','general','2003-05-27 06:40:43','1984-08-30 04:52:42'),
('21','Seamus','Nienow','quasi',NULL,'648-658-7211','hbeer@example.net','223c52598e28051bab4bc81e2432ec7dc4adb4c3','admin','1986-06-20 05:41:46','2003-05-02 17:56:31'),
('22','Selena','Marks','vero',NULL,'722-283-9326x702','thegmann@example.com','6bdbfdb0b72b05d7b8aea86faf9a06619eae878e','admin','2000-08-18 15:48:14','2010-04-25 08:37:08'),
('23','Hilton','Friesen','sequi',NULL,'1-003-399-3533x6','emard.zion@example.net','f4abc7789b032ce421fc728c8fe0a31cfff045b7','admin','1981-09-29 09:19:37','1976-12-13 05:01:04'),
('24','Jon','Windler','molestiae',NULL,'1-302-255-6968x0','jillian.zemlak@example.org','7c8e460260027197bb429644966c062ed22ad8e6','admin','2003-11-01 07:29:02','1980-04-08 20:27:10'),
('25','Felix','Towne','tenetur',NULL,'1-810-250-6913x7','bechtelar.avery@example.net','c140b26080288a40dd85c51ba96ce414510fdfab','admin','1997-08-15 06:26:15','2010-10-12 00:10:23'),
('26','Hank','Roberts','a',NULL,'03218968569','schultz.austyn@example.com','ba06c9ec8816e1f56d5b0034f9ce5e1cb3848610','admin','1992-02-24 20:41:42','1971-10-09 14:42:18'),
('27','Wilma','Schinner','et',NULL,'555-854-4100','tillman.luciano@example.com','79a1d43978e8f9c0a80b16d0cee837a7828f0bd3','admin','1994-04-29 16:19:26','1982-07-22 02:36:08'),
('28','Melyna','Stracke','soluta',NULL,'1-782-963-7757','kjacobi@example.com','7c23c1f0f73a60a67dda1910b6ffb501a9dad10c','general','1976-07-26 10:14:11','1988-10-21 05:21:38'),
('29','Guiseppe','Stoltenberg','exercitationem',NULL,'(471)857-9767x40','jarrod53@example.com','2358ddf7bcb2a84f38cb84feb87151067e8bce1a','admin','1992-03-15 06:13:09','1988-12-01 21:05:27'),
('30','Clemmie','Shanahan','esse',NULL,'(294)403-7621x29','heaney.malcolm@example.net','84cb106f10c4eca5af7f92597d02ebe1f35fc9e1','general','1978-12-10 16:24:50','2015-02-24 00:29:53'),
('31','Leora','Anderson','necessitatibus',NULL,'1-799-689-5221x0','okoepp@example.net','170384fd12ddb318f112dc5a1a8f59c9c6849603','admin','2014-09-08 15:12:59','1984-10-05 17:44:22'),
('32','Katherine','Morissette','et',NULL,'051.574.0145x653','maximillia.purdy@example.net','65b4f3ebe365adecf09c95d05f191ac82568cd4e','general','1993-03-05 21:14:40','1973-05-03 12:54:45'),
('33','Ava','Williamson','libero',NULL,'779.912.7318','johnnie29@example.net','b16b8e714ac0c00b5e2fc110fd46999485682467','general','1996-10-30 02:10:50','2000-06-13 23:43:30'),
('34','Arden','Gaylord','eum',NULL,'1-125-659-1960x4','yoshiko.reynolds@example.com','415c8b1d61fecab8eebf15e8e6f60b124dd874ee','admin','1971-07-20 22:42:48','2003-02-17 07:18:11'),
('35','Israel','Halvorson','sapiente',NULL,'095.788.0025','zoe.pagac@example.net','7695f9a3199a01c1f0f8990c7aa2ba3730ad7ff3','admin','1973-12-28 05:48:53','1972-12-27 23:19:46'),
('36','Mollie','Schmidt','adipisci',NULL,'(842)683-3044x25','moberbrunner@example.net','adfcdf8bddf87e74f378843051a0e23fbbc56bc0','general','2019-06-22 21:36:14','2006-05-11 21:25:18'),
('37','Candice','Ullrich','nesciunt',NULL,'(499)602-8776','felton.leffler@example.org','303c7e3ad1893defa0da05d7f7b76e4ccd2af591','general','2004-05-04 17:12:05','1990-12-20 11:47:07'),
('38','Coleman','Schimmel','dolore',NULL,'+78(8)8322400899','bechtelar.america@example.net','f9b3c3428844407a28f3e30c78322dfbea4d3a82','admin','2000-07-11 19:00:21','1978-08-31 20:13:23'),
('39','Destin','Jacobs','qui',NULL,'1-657-489-6273','mnikolaus@example.net','ed4513432979f19d7dde48b767fbeabdc7b218a2','admin','2005-05-16 00:55:02','1988-03-17 03:28:00'),
('40','Marcia','Runte','ut',NULL,'1-181-021-9537','graham.delphine@example.com','825a8b596a8694af7deb8b742d80307329bab748','admin','2015-12-02 23:54:31','1997-07-25 07:19:36'),
('41','Tillman','Pfeffer','id',NULL,'(055)401-6654','tbalistreri@example.net','abd84e33a7c1ec09f8ff9c1f25e39ab7c0431263','general','1984-11-16 14:18:18','2016-06-07 12:47:23'),
('42','Blanca','Dooley','expedita',NULL,'206-337-4272x309','natalia.schmeler@example.org','124eba6f9cadb6d2e15ed444855fd87666eb94a3','general','2007-06-19 15:16:21','2019-03-11 17:47:49'),
('43','Clovis','Stanton','expedita',NULL,'1-402-249-8347x1','sarah91@example.net','9d671ec0998e321fb2a8a8bcba7e8279f67ddca2','admin','2008-03-02 12:45:29','1984-07-06 09:16:43'),
('44','Makayla','Carter','et',NULL,'04076129452','oral71@example.net','2b620a307f6f4a9e8e6f6ab7ebe497d7978c3c52','admin','2010-07-24 06:10:55','1995-03-01 15:28:58'),
('45','Melyna','Kuhlman','blanditiis',NULL,'(807)547-5641x26','fkirlin@example.net','c9c14643b2114cf462f979264ab1cb8ae004b0a4','general','1991-10-04 07:16:42','1983-02-22 01:07:01'),
('46','Deven','Krajcik','vero',NULL,'1-311-546-2628x4','wilfrid99@example.net','9c1e59929fcce2df593d4abd71a792ff2fa0612f','admin','1974-08-31 11:42:54','1989-10-12 06:58:54'),
('47','Nellie','Lynch','quasi',NULL,'07259178515','rebeca.sawayn@example.net','aef9328883544dbeae5943fa933e3660d4f4f2ca','general','1972-08-19 15:35:27','2011-07-01 10:20:21'),
('48','Hassie','Borer','repellat',NULL,'(262)840-9044x25','maximillian.hand@example.net','15c2e0b326946cae55e2f4201cc7edac35ff3e9d','general','1971-04-13 18:59:42','2012-07-10 19:04:55'),
('49','Rowland','Green','minima',NULL,'00961425997','zfisher@example.com','2214dc231fc8ab80758422a3bc8ad9d34f9e9d4b','general','1994-11-13 12:13:43','1984-12-08 15:42:12'),
('50','Terence','Streich','eum',NULL,'1-460-362-2172','nschuster@example.org','059e2e99d041246f086329424276bbe49af798a5','admin','2002-05-07 10:40:07','2016-10-18 05:32:07'); 


-- issue table

INSERT INTO `issues` VALUES
('2','2','Dolor sequi dolores non laudantium est sed et.',NULL,'Alice could see it pop down a jar from one end to the rose-tree, she went on, looking anxiously about her. \'Oh, do let me help to undo it!\' \'I shall sit here,\' he said, turning to the company.','1986-05-29 11:12:22','1999-10-08 12:03:09'),
('3','3','Voluptas aperiam saepe repudiandae possimus.',NULL,'Mock Turtle had just succeeded in curving it down \'important,\' and some \'unimportant.\' Alice could not think of nothing better to say anything. \'Why,\' said the Hatter. \'It isn\'t mine,\' said the.','1984-07-17 03:39:13','1982-07-12 21:27:02'),
('4','4','Totam dolores pariatur et et.',NULL,'Cat, \'if you don\'t like the tone of great curiosity. \'It\'s a friend of minea Cheshire Cat,\' said Alice: \'where\'s the Duchess?\' \'Hush! Hush!\' said the youth, \'as I mentioned before, And have.','1995-11-26 10:05:01','2011-09-11 04:00:28'),
('5','5','Facere et quaerat aliquam reprehenderit.',NULL,'At last the Gryphon only answered \'Come on!\' and ran till she was up to Alice, that she did it at last, and managed to put the Lizard as she went on, \'\"--found it advisable to go and live in that.','2002-04-16 13:44:14','1988-01-18 17:59:23'),
('6','6','Perspiciatis est porro quaerat id ratione et.',NULL,'Duchess, who seemed too much of a water-well,\' said the Footman, and began smoking again. This time Alice waited a little, and then added them up, and began to cry again, for this curious child was.','2007-10-08 00:42:39','2017-01-25 11:38:13'),
('7','7','Quod earum aut molestiae dolores natus dolores.',NULL,'WHAT?\' said the King. Here one of them can explain it,\' said Alice. \'And ever since that,\' the Hatter were having tea at it: a Dormouse was sitting next to no toys to play with, and oh! ever so many.','1999-10-20 22:50:07','1971-06-04 16:38:51'),
('8','8','Quas ipsum ipsum rerum.',NULL,'Hatter. \'He won\'t stand beating. Now, if you wouldn\'t have come here.\' Alice didn\'t think that will be When they take us up and saying, \'Thank you, sir, for your interesting story,\' but she did not.','2019-11-24 18:20:14','1993-01-10 02:22:10'),
('9','9','Quos id sequi sit autem et.',NULL,'Do you think, at your age, it is I hate cats and dogs.\' It was high time you were or might have been changed in the house, and found herself in a soothing tone: \'don\'t be angry about it. And yet you.','2004-11-21 00:02:53','1988-10-12 03:44:02'),
('10','10','Quibusdam quas magni sunt asperiores quam tenetur officiis id.',NULL,'I don\'t care which happens!\' She ate a little wider. \'Come, it\'s pleased so far,\' thought Alice, \'shall I NEVER get any older than I am now? That\'ll be a walrus or hippopotamus, but then she heard.','1993-11-18 04:59:37','1996-04-03 20:51:07'),
('11','11','Rerum qui veniam accusamus qui.',NULL,'Alice desperately: \'he\'s perfectly idiotic!\' And she went on: \'But why did they live at the Queen, and in THAT direction,\' waving the other side of the tail, and ending with the tea,\' the Hatter and.','2003-12-22 05:04:39','2016-04-18 16:03:25'),
('12','12','Et provident illum ad cum doloremque distinctio reiciendis repudiandae.',NULL,'That\'s all.\' \'Thank you,\' said the Hatter, it woke up again with a sigh: \'it\'s always tea-time, and we\'ve no time to be ashamed of yourself for asking such a noise inside, no one listening, this.','1999-04-09 19:18:36','1976-09-08 23:51:33'),
('13','13','Dolores voluptatem rerum porro voluptatum a et quasi.',NULL,'Alice waited a little, half expecting to see some meaning in it, and found in it a very little! Besides, SHE\'S she, and I\'m sure _I_ shan\'t be able! I shall be a walrus or hippopotamus, but then she.','1985-10-15 01:55:24','2007-04-13 04:01:31'),
('14','14','Aperiam qui inventore sint ut vitae.',NULL,'Soo--oop! Soo--oop of the house opened, and a long way. So they couldn\'t see it?\' So she swallowed one of the room. The cook threw a frying-pan after her as she did not see anything that had a VERY.','2015-03-07 02:51:50','2003-08-05 04:24:49'),
('15','15','Nihil provident voluptas ex suscipit nam fuga temporibus.',NULL,'Panther received knife and fork with a knife, it usually bleeds; and she dropped it hastily, just in time to go, for the moment she appeared on the top of his shrill little voice, the name of nearly.','2010-07-06 12:08:34','1998-04-15 09:50:14'),
('16','16','Delectus eum dolorum quo eum aut.',NULL,'Why, she\'ll eat a little snappishly. \'You\'re enough to drive one crazy!\' The Footman seemed to Alice an excellent plan, no doubt, and very soon had to run back into the sky all the first to break.','2010-09-04 17:31:20','2007-02-28 12:19:47'),
('17','17','Neque quas nihil est ut vel.',NULL,'THEIR eyes bright and eager with many a strange tale, perhaps even with the game,\' the Queen said to Alice; and Alice guessed in a twinkling! Half-past one, time for dinner!\' (\'I only wish people.','1976-04-23 04:12:32','1971-07-17 09:43:45'),
('18','18','Repellendus ut suscipit et doloremque doloremque voluptatem a.',NULL,'He moved on as he spoke. \'UNimportant, of course, Alice could see it written down: but I hadn\'t drunk quite so much!\' said Alice, \'how am I to get through the doorway; \'and even if my head would go.','2013-12-27 12:42:07','2018-11-03 00:00:39'),
('19','19','Doloribus atque nulla ab quia dicta.',NULL,'March Hare and the White Rabbit, who said in a day is very confusing.\' \'It isn\'t,\' said the Hatter: \'let\'s all move one place on.\' He moved on as he fumbled over the wig, (look at the time she had.','1975-04-19 22:08:38','2019-11-03 23:48:57'),
('20','20','Qui qui facilis amet maxime.',NULL,'Dormouse fell asleep instantly, and neither of the day; and this time the Queen shrieked out. \'Behead that Dormouse! Turn that Dormouse out of court! Suppress him! Pinch him! Off with his head!\' she.','1975-10-24 12:31:12','1987-12-12 03:25:55'),
('21','21','Optio eum voluptas suscipit in.',NULL,'Alice looked at Alice. \'I\'M not a bit hurt, and she tried hard to whistle to it; but she stopped hastily, for the end of every line: \'Speak roughly to your tea; it\'s getting late.\' So Alice got up.','1976-10-02 10:56:03','2006-04-13 13:07:19'),
('22','22','Sint dicta eos aspernatur et perferendis.',NULL,'She did not come the same when I got up this morning? I almost wish I had not noticed before, and he says it\'s so useful, it\'s worth a hundred pounds! He says it kills all the things I used to it in.','1984-12-21 03:28:22','1988-02-26 09:49:57'),
('23','23','Rerum sapiente vitae enim blanditiis.',NULL,'Alice a good opportunity for making her escape; so she went on \'And how do you mean \"purpose\"?\' said Alice. \'Then you shouldn\'t talk,\' said the Gryphon, and the White Rabbit, who was peeping.','2011-04-13 00:41:33','2001-05-18 13:02:35'),
('24','24','Quia minima est nihil voluptas cupiditate inventore.',NULL,'French mouse, come over with diamonds, and walked off; the Dormouse sulkily remarked, \'If you please, sir--\' The Rabbit Sends in a trembling voice:-- \'I passed by his face only, she would catch a.','1994-07-20 02:38:30','2009-05-15 21:36:35'),
('25','25','Doloribus reprehenderit reprehenderit omnis illum.',NULL,'When the procession came opposite to Alice, flinging the baby joined):-- \'Wow! wow! wow!\' While the Duchess to play with, and oh! ever so many lessons to learn! No, I\'ve made up my mind about it;.','2012-08-19 17:30:40','2003-01-11 18:44:16'),
('26','26','Consectetur minima possimus vitae quam dolorem.',NULL,'Alice did not notice this last remark, \'it\'s a vegetable. It doesn\'t look like it?\' he said. \'Fifteenth,\' said the Lory, as soon as the soldiers remaining behind to execute the unfortunate.','2015-02-25 17:22:30','1994-07-07 18:08:40'),
('27','27','Eum recusandae aut ipsum nihil exercitationem voluptatem nulla saepe.',NULL,'Edgar Atheling to meet William and offer him the crown. William\'s conduct at first was moderate. But the snail replied \"Too far, too far!\" and gave a little different. But if I\'m Mabel, I\'ll stay.','2008-01-27 23:32:04','2017-10-26 05:14:21'),
('28','28','Aut qui in eos omnis ad aliquid.',NULL,'O Mouse!\' (Alice thought this a good many little girls of her ever getting out of sight before the trial\'s over!\' thought Alice. \'I\'m glad I\'ve seen that done,\' thought Alice. The King laid his hand.','1987-05-07 03:49:00','2015-03-17 03:42:18'),
('29','29','Tempora perspiciatis consectetur quidem eos quod amet sed eum.',NULL,'Alice\'s great surprise, the Duchess\'s voice died away, even in the middle, being held up by wild beasts and other unpleasant things, all because they WOULD go with the words \'EAT ME\' were.','1982-04-01 20:05:19','1979-07-06 09:45:04'),
('30','30','Voluptate qui est voluptates adipisci necessitatibus autem.',NULL,'ME.\' \'You!\' said the Hatter. He had been of late much accustomed to usurpation and conquest. Edwin and Morcar, the earls of Mercia and Northumbria, declared for him: and even Stigand, the patriotic.','2010-10-08 16:54:13','2004-08-19 19:06:24'),
('31','31','Rem facere culpa voluptatem id quam sapiente error enim.',NULL,'I\'m pleased, and wag my tail when it\'s angry, and wags its tail when I\'m pleased, and wag my tail when it\'s angry, and wags its tail about in the sea, though you mayn\'t believe it--\' \'I never was so.','1977-06-17 02:57:53','2008-05-10 05:52:31'),
('32','32','Enim dolor a quia et.',NULL,'Beau--ootiful Soo--oop! Soo--oop of the door opened inwards, and Alice\'s elbow was pressed so closely against her foot, that there was no time to be a walrus or hippopotamus, but then she walked.','2003-11-14 01:10:48','1979-10-19 13:30:13'),
('33','33','Cumque sit sunt dicta deserunt in tempora.',NULL,'Caterpillar. \'Well, perhaps not,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she squeezed herself up on tiptoe, and peeped over the jury-box with the bones and the turtles all advance!.','2009-09-14 01:26:43','2016-12-21 08:32:17'),
('34','34','Earum est tenetur fugit qui laborum ab molestiae.',NULL,'Miss, we\'re doing our best, afore she comes, to--\' At this moment Five, who had been (Before she had not noticed before, and she said to herself, and once she remembered trying to explain it is I.','2014-02-27 21:35:34','2005-07-14 22:59:49'),
('35','35','Eos ipsam corrupti ab est adipisci minima.',NULL,'It sounded an excellent opportunity for making her escape; so she sat down with her head!\' the Queen shrieked out. \'Behead that Dormouse! Turn that Dormouse out of its mouth again, and Alice looked.','2008-08-01 11:04:58','2013-10-29 14:39:30'),
('36','36','Consequuntur accusantium fuga perferendis facere rem labore nemo.',NULL,'Queen. An invitation from the sky! Ugh, Serpent!\' \'But I\'m not used to come yet, please your Majesty,\' said the Caterpillar called after her. \'I\'ve something important to say!\' This sounded.','2007-06-26 06:02:24','1998-07-19 06:43:35'),
('37','37','Accusantium natus ex aliquam ut voluptatibus sit aut.',NULL,'Time as well as if his heart would break. She pitied him deeply. \'What is his sorrow?\' she asked the Mock Turtle would be worth the trouble of getting up and beg for its dinner, and all that,\' said.','2008-12-23 12:21:18','2003-04-22 19:11:47'),
('38','38','Omnis praesentium libero quo ut.',NULL,'Gryphon, before Alice could not remember ever having heard of \"Uglification,\"\' Alice ventured to ask. \'Suppose we change the subject of conversation. \'Are you--are you fond--of--of dogs?\' The Mouse.','1978-05-11 03:07:34','1986-06-28 00:52:54'),
('39','39','Explicabo fugiat est odio beatae consequatur nam officia.',NULL,'Dormouse!\' And they pinched it on both sides of it, and yet it was written to nobody, which isn\'t usual, you know.\' He was looking at Alice for protection. \'You shan\'t be beheaded!\' said Alice, who.','2005-11-08 19:40:05','2000-07-08 10:14:28'),
('40','40','Atque aspernatur rerum quia quisquam excepturi omnis.',NULL,'The three soldiers wandered about for it, you know--\' She had quite a new pair of white kid gloves and a great many teeth, so she set to work very diligently to write with one foot. \'Get up!\' said.','2009-08-20 14:18:05','1987-06-24 17:21:00'),
('41','41','Qui quia quibusdam velit voluptates totam et quia.',NULL,'All the time at the mushroom (she had grown to her that she had expected: before she got to see that she was surprised to find herself still in sight, hurrying down it. There was a dead silence..','2010-06-20 09:10:03','1976-08-19 12:43:07'),
('42','42','Minima ipsum sed error minus.',NULL,'Alice \'without pictures or conversations in it, \'and what is the capital of Rome, and Rome--no, THAT\'S all wrong, I\'m certain! I must have been changed in the air, and came back again. \'Keep your.','1993-08-10 14:34:46','2009-06-21 11:09:52'),
('43','43','In est et voluptatem nam enim qui est.',NULL,'He only does it matter to me whether you\'re nervous or not.\' \'I\'m a poor man,\' the Hatter said, turning to Alice, she went on to himself in an undertone,.','2016-09-27 11:50:50','1975-04-20 17:12:19'),
('44','44','Autem dolor quidem repellendus natus a dolorem eligendi.',NULL,'Rabbit just under the door; so either way I\'ll get into the court, \'Bring me the truth: did you ever eat a little before she gave a look askance-- Said he thanked the whiting kindly, but he could.','2000-04-11 23:49:27','1980-03-20 13:33:58'),
('45','45','Aliquid sequi minima eaque iure ducimus.',NULL,'I can do no more, whatever happens. What WILL become of you? I gave her one, they gave him two, You gave us three or more; They all made of solid glass; there was no one to listen to me! When I used.','1980-12-17 09:37:13','1990-08-20 07:11:41'),
('46','46','Ratione distinctio deserunt et vel quia corporis dolor.',NULL,'On various pretexts they all spoke at once, with a cart-horse, and expecting every moment to be rude, so she felt sure she would catch a bat, and that\'s very like having a game of croquet she was.','1981-05-28 10:06:22','2013-10-13 21:55:13'),
('47','47','Dolor voluptatem aliquid minima ducimus quas.',NULL,'I\'m I, and--oh dear, how puzzling it all came different!\' Alice replied very readily: \'but that\'s because it stays the same words as before, \'and things are worse than ever,\' thought the poor little.','2019-01-04 06:42:42','2012-12-26 19:42:16'),
('48','48','Numquam alias deserunt rem laboriosam rerum qui veniam ab.',NULL,'Queen, \'Really, my dear, YOU must cross-examine the next witness. It quite makes my forehead ache!\' Alice watched the Queen was to find quite a large kitchen, which was sitting on a bough of a.','2018-09-26 18:43:03','1988-06-24 10:16:59'),
('49','49','Dolor eaque dolores accusamus occaecati ut inventore nam.',NULL,'I shall fall right THROUGH the earth! How funny it\'ll seem to dry me at all.\' \'In that case,\' said the Gryphon: \'I went to school every day--\' \'I\'VE been to her, still it was certainly too much.','1981-01-27 02:59:42','2019-07-26 09:15:14'),
('50','50','Voluptates voluptas saepe inventore debitis.',NULL,'Those whom she sentenced were taken into custody by the end of half those long words, and, what\'s more, I don\'t remember where.\' \'Well, it must be getting home; the night-air doesn\'t suit my.','1970-07-29 15:10:03','1970-08-22 21:02:48'); 



-- comment table


INSERT INTO `comments` VALUES
('2','2','29','Incidunt eos porro quo veritatis. Est fugiat cum recusandae qui autem eveniet. Ut corrupti ut magnam quas.','1994-04-24 17:47:34','2015-05-14 03:27:15'),
('3','3','29','Aliquid consequatur non numquam. Esse officiis nobis neque modi. Alias temporibus amet quasi magni aut enim.','2000-01-03 21:22:25','1971-09-11 03:19:46'),
('4','4','31','Tenetur similique dicta ex quaerat ad perspiciatis. Dolorem qui sed id. Iste nesciunt voluptas dignissimos ut quo occaecati.','1991-04-01 00:38:17','2001-03-30 05:07:30'),
('5','5','29','Iste laborum rerum nam fugit harum aliquam non. Illum qui doloribus ut quos ut similique itaque. Est quas nostrum minima unde. Veritatis id laudantium maiores.','1978-04-19 06:39:57','2002-05-16 08:45:29'),
('6','6','43','Rerum reprehenderit nisi voluptatem at. Dolor unde sunt in quos et quas. Deleniti suscipit magni architecto impedit expedita.','2012-06-27 10:03:57','1977-10-01 16:41:02'),
('7','7','40','Nihil expedita molestias voluptatum ut dolores. Saepe nostrum tempore accusantium reiciendis modi aspernatur. Similique sint est sint quaerat ipsam qui id vel. Tempore dolorem esse quibusdam est inventore sequi.','1994-12-01 19:02:24','2014-01-13 15:45:14'),
('8','8','16','Assumenda aliquid et magni consequatur ut. Ad amet inventore quae ut optio vel. Omnis fugiat labore sequi ab magni repellendus autem recusandae. Architecto eveniet expedita aut.','1977-08-11 22:59:06','1995-01-17 06:42:44'),
('9','9','23','Similique eius asperiores praesentium dolorum illum provident. Vel deleniti possimus ratione vitae fugit. Sequi placeat ratione et eos adipisci. Et deleniti natus adipisci quod aut omnis omnis.','1978-11-18 02:29:18','1986-01-09 07:40:22'),
('10','10','50','Veniam velit qui ab perspiciatis numquam enim magni. Doloribus mollitia asperiores est reiciendis est quidem nam. Sunt illum nobis ea. Modi eaque assumenda accusamus architecto qui laborum voluptatem illum.','1992-02-17 14:11:08','2003-05-26 11:45:55'),
('11','11','24','Numquam fuga quibusdam voluptatem et velit atque. Quia inventore sed rerum quaerat. Fugit et dolor quis non odit.','1976-02-19 01:17:43','2006-03-16 06:29:11'),
('12','12','47','Reiciendis porro fugiat totam aliquid aliquam eveniet aut. Excepturi dolore iure mollitia quos perspiciatis quod dignissimos. Ab nam in veritatis porro.','2017-04-09 23:50:31','1971-11-29 11:09:20'),
('13','13','50','Incidunt vero sit doloribus dolores aliquam quaerat. Ad cupiditate eaque laudantium doloribus sit. Enim qui officia culpa quo iusto aut ea.','2004-12-19 18:11:11','2009-05-09 16:53:07'),
('14','14','18','Est nihil laudantium quia error est ut quas eveniet. A sunt in fuga rerum natus sint. Voluptatem ab est dolore voluptatem dicta ut tempore.','1991-05-31 02:45:58','1983-10-22 11:00:07'),
('15','15','12','Totam numquam odio consequatur magnam. Eligendi perspiciatis quam assumenda sit sint. Quia sunt eaque dicta sint. Vel a libero deserunt totam reprehenderit nostrum.','2003-02-11 15:37:25','1994-04-03 05:18:01'),
('16','16','20','Qui voluptates excepturi fugiat architecto tempora vero architecto. Quis sed maxime soluta expedita. Numquam corrupti in voluptatem nobis. Est est temporibus non ipsa est illum dolor omnis.','1973-10-31 15:49:14','1975-01-05 03:46:42'),
('17','17','12','Vel facere assumenda quibusdam inventore ut. Soluta nesciunt est a ut molestias illum ut magnam. Rem dignissimos similique sit temporibus ab sed nihil. Veniam velit ex maxime optio velit harum.','1988-06-05 08:46:58','2002-09-13 12:51:47'),
('18','18','27','Harum hic sed cum consequuntur temporibus accusamus corrupti. Qui accusamus commodi mollitia voluptatem. Enim neque quaerat numquam enim ullam. Natus consequatur qui animi sint eos porro praesentium ab.','1970-11-30 20:54:10','1990-04-09 21:14:32'),
('19','19','6','Ipsum ex est aut sint. Perferendis eaque est nam quod quas in veritatis ullam. Unde maxime eaque porro magnam.','1996-06-01 22:59:30','1977-10-27 04:41:00'),
('20','20','36','Eaque aut laudantium sunt a. Totam dolor optio sit voluptatem aliquid debitis distinctio. Mollitia labore rem perspiciatis velit animi numquam ipsa.','2015-01-17 13:32:47','1991-02-13 11:08:21'),
('21','21','30','Veritatis quidem at illum voluptatum eligendi molestiae. Aperiam ut necessitatibus voluptas exercitationem. Et eos molestias atque id dignissimos. Natus est eligendi earum tempore doloremque. Et eligendi quisquam eaque sequi quasi vitae.','1971-03-07 20:41:13','1979-03-26 14:46:53'),
('22','22','35','Accusantium aperiam et deserunt et magni porro. Sunt laborum ab ex quibusdam omnis. Nisi et saepe dignissimos maxime tempora tempora velit quia. Qui tempora quisquam qui officiis sit. Necessitatibus voluptate repellendus libero odit perspiciatis.','2009-10-27 15:41:33','1986-10-23 07:34:21'),
('23','23','39','Perspiciatis quas officiis sint laboriosam exercitationem voluptatem. Possimus et reprehenderit alias amet. Et aut omnis commodi distinctio nemo. Maiores mollitia nostrum qui aliquam. Quaerat nam quaerat debitis voluptatem.','1971-12-12 15:38:44','1973-07-20 02:54:13'),
('24','24','34','Vero maxime dolorum architecto sed nulla aut illo dolorem. Dignissimos recusandae modi sed aut animi quasi. Sunt exercitationem et ullam sint minus et cum quam. Nostrum dolorem nesciunt et ut.','1983-02-05 11:18:47','2005-10-24 12:55:38'),
('25','25','42','Rerum facere commodi dignissimos voluptatem consequatur accusamus. Rerum ea unde dolores ut ducimus perspiciatis. Dignissimos aliquam est blanditiis assumenda cupiditate. Natus ratione alias sed quod error.','1995-12-24 23:23:15','2014-03-10 19:48:17'),
('26','26','26','Blanditiis rerum provident consequuntur rerum velit quia. Voluptatem expedita dolores dolor itaque eos sint velit. Rerum facilis rem maiores. Laudantium nobis voluptatem accusantium consequatur eos officia.','1979-08-22 20:21:23','2015-05-11 20:05:52'),
('27','27','29','Nihil accusantium est aperiam mollitia corrupti explicabo voluptatibus. Aut dolores alias dolore perspiciatis. Doloribus et est accusamus consequatur magnam. Minus exercitationem odit consequatur libero laborum minus.','1993-01-06 02:06:07','1980-04-25 22:30:21'),
('28','28','4','Amet iusto sapiente et repellendus consectetur est sapiente distinctio. Dolorem aut sint fugiat ut at quis. Quia quo ut assumenda accusantium ad. Et odit voluptatem placeat dolores et commodi.','1970-12-27 00:38:11','2012-09-08 09:28:41'),
('29','29','11','Asperiores maiores eius quo soluta asperiores molestiae dolores. Omnis inventore modi vel eaque repellendus non reiciendis deleniti. Mollitia ut numquam temporibus in. Reiciendis omnis est quia quis perferendis explicabo nulla nemo.','1976-12-21 15:13:08','1971-11-06 18:11:02'),
('30','30','36','Reprehenderit quos nobis iure quia est quia occaecati enim. Repellat cupiditate iure est est harum. Nobis unde incidunt veniam facere et praesentium recusandae.','2009-02-06 18:47:54','2002-03-12 22:42:08'),
('31','31','40','Nihil enim quod sed est magnam voluptas. Temporibus tempora ut impedit quia. Quia libero nisi et. Nihil sunt aut et animi ipsum.','1984-10-22 11:06:04','1973-08-05 09:18:27'),
('32','32','9','Earum quia praesentium velit non nostrum id. Omnis sapiente quia laborum officia laborum unde tenetur laborum. Eum ea tempora quos ut et.','2014-12-07 22:40:32','1979-01-06 03:53:41'),
('33','33','20','Nobis nobis distinctio nisi itaque autem nulla aliquid. Excepturi ex molestias et repudiandae nihil quam fuga. Exercitationem quasi cumque et molestias dicta. Cum veritatis quam quasi velit.','2018-10-23 19:54:51','1974-11-16 11:22:13'),
('34','34','6','Sed et inventore qui et. Est occaecati ut sint vero alias qui rerum. Dolores est fuga fugit atque ipsam voluptatem assumenda.','1975-10-15 13:33:42','1975-12-25 12:04:58'),
('35','35','3','Accusantium harum sint voluptas enim architecto consequatur. Pariatur libero quod velit molestias. Et voluptates et voluptatem praesentium magni voluptates culpa.','1977-01-09 07:17:47','2005-06-09 06:19:35'),
('36','36','24','Et est sunt amet animi. Expedita et tempore quo sint veniam. Maxime officiis quas hic vel sed incidunt quaerat corrupti. Soluta recusandae aut qui quo ducimus.','1987-12-20 17:34:42','2004-03-31 05:07:48'),
('37','37','8','Temporibus maiores harum deserunt esse et repellendus. Nobis et eius ut. Voluptas iure expedita odit quis quaerat ipsam.','1996-01-23 20:47:05','2019-04-21 11:52:19'),
('38','38','14','Ut neque aliquam ut ut ipsum cum minus. Omnis iste mollitia expedita ut et. Possimus facilis inventore quisquam aut repellendus temporibus molestiae et. Facere id quasi officia vitae. Quaerat soluta sint occaecati quae vel nisi.','2000-03-04 23:56:45','1976-06-20 05:12:44'),
('39','39','12','Ut excepturi ad quia molestiae. Incidunt nobis in maiores sit. Qui voluptatem et blanditiis enim quaerat omnis ut. Illum nemo magni aliquid vel.','1994-04-07 21:24:09','1979-07-29 19:01:28'),
('40','40','28','Consequatur et exercitationem porro omnis delectus vero. Quam omnis iusto illum. Suscipit corrupti ea quia qui omnis.','1997-10-20 06:17:56','1978-02-24 15:54:40'),
('41','41','34','Asperiores magnam quis officia aut et. Saepe dignissimos quisquam in enim eum voluptatem sed. Qui libero aspernatur eius porro ipsa iure.','1985-08-06 23:19:53','1994-07-16 12:03:52'),
('42','42','4','Aut qui reiciendis non natus ex dolores. Ea recusandae quis in pariatur sunt dolores provident. Consectetur et earum quisquam eligendi. Inventore modi unde in.','2013-10-07 07:19:50','2019-07-22 18:24:06'),
('43','43','50','Consequuntur eius ducimus minus eveniet. Corporis et soluta rerum. Quis quasi doloribus esse. Tempora ut dolor aliquid ut quisquam non.','1972-01-19 13:24:44','1995-07-03 14:38:48'),
('44','44','49','Accusantium ut eaque dolor molestiae molestiae aut id. Velit architecto ad dolorum illo. Ut beatae velit quia illo numquam quis id. Optio et qui earum et qui et corrupti.','2013-01-14 17:53:33','1983-07-03 06:11:00'),
('45','45','33','Et vitae aspernatur doloribus sed et. Rerum sit tempore culpa id aspernatur.','2008-01-11 12:52:05','1976-02-01 19:55:34'),
('46','46','48','Similique pariatur sint perspiciatis nihil deleniti hic necessitatibus. Quas incidunt officiis est vel. Occaecati cupiditate et eaque soluta illo et. Et asperiores vel molestiae consequatur eum temporibus.','2008-01-04 02:49:34','2000-07-20 08:14:04'),
('47','47','24','Molestias minus sit sunt natus fuga vitae doloribus. Dolores a consectetur cum veniam. Ad voluptatum iste ipsa excepturi vero eum ullam. Voluptas cumque enim totam aut eveniet qui in.','2006-08-20 00:28:56','1975-12-21 09:37:01'),
('48','48','11','Laboriosam eos maiores quis eos unde velit ut sit. Omnis rerum quas repudiandae harum inventore rerum. Est magni enim temporibus voluptas sit.','1973-07-20 08:09:11','1996-11-16 06:06:39'),
('49','49','30','Blanditiis voluptatum quos saepe laborum distinctio eligendi. Quidem possimus est non.','2006-04-26 20:26:59','2002-01-05 10:24:40'),
('50','50','10','Et pariatur voluptatem eligendi atque ut ad. Minima vel et delectus aliquid ea. Provident consequuntur quidem veritatis quis est. Quis aliquid consequuntur dicta odio autem nulla molestiae.','2000-06-16 06:40:25','1980-05-01 02:01:50'),
('51','1','6','Vero eos animi voluptatum voluptatum. Alias sed dolore recusandae harum. Temporibus est ut quibusdam. Non eum optio non cumque soluta cumque vel.','1992-10-08 22:51:57','1976-08-06 18:24:42'),
('52','2','10','Accusamus autem aut quod et. Quia eaque consequatur blanditiis nihil esse beatae. Ad laborum dignissimos ex quos blanditiis debitis quae. Non accusantium eum aliquid omnis.','2005-01-15 18:29:01','1980-12-03 16:24:49'),
('53','3','21','Aut corrupti voluptatem velit nobis molestias animi. Tenetur est in et itaque saepe voluptatem quod. Est fuga consequatur neque maxime dolor ipsa. Sint veniam molestiae minus.','1996-03-20 23:29:02','1983-09-02 06:53:44'),
('54','4','30','Aliquid mollitia molestias culpa est tempore. Qui ipsa officia suscipit nulla. Labore est omnis necessitatibus dicta voluptate et amet. Nobis et nemo nostrum rerum qui.','1991-08-18 05:02:59','1991-11-28 10:57:52'),
('55','5','5','Ut odit ut dicta qui quisquam adipisci nisi aliquam. Enim rem quasi qui et sit. Accusantium expedita ducimus nemo.','1978-11-08 04:40:36','1984-12-02 18:49:34'),
('56','6','42','Error qui porro vero sapiente. Mollitia soluta rerum laudantium delectus. Molestias ratione culpa saepe aperiam. Quaerat illum consequuntur ea temporibus quis.','2005-12-17 04:52:10','1985-04-28 08:48:46'),
('57','7','9','Repellendus amet mollitia quos ipsa assumenda enim rerum. Perferendis maiores quia et quis. Ut aliquid cumque laborum et ducimus iure eius. Ex perferendis alias tenetur et dolorem.','1974-07-02 09:13:46','1992-05-30 23:38:35'),
('58','8','50','Quod fugit error explicabo delectus veritatis rem. Et mollitia eius officiis sed nesciunt velit molestiae placeat. Magni excepturi eligendi quidem possimus voluptatem.','2015-03-30 16:11:27','1983-01-18 13:17:08'),
('59','9','46','At et eaque labore quibusdam debitis. Distinctio qui aliquid hic eum aut deserunt sapiente. Repudiandae excepturi voluptates commodi eos perferendis.','1981-05-31 04:24:04','2003-01-12 16:54:41'),
('60','10','49','Optio quia nulla corrupti porro sapiente velit velit commodi. Ut non nihil recusandae tempora dolore perferendis laboriosam facilis. Libero est est cupiditate ducimus earum sed. Ut rerum sunt incidunt molestias.','1979-08-21 22:24:22','1994-01-07 02:24:15'); 

