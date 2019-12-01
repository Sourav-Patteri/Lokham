-- ----------------------------------------
-- SCHEMA  
-- ----------------------------------------
DROP DATABASE IF EXISTS `lokham`;
CREATE DATABASE IF NOT EXISTS `lokham` DEFAULT CHARACTER SET utf8;
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
  `phone` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'general') NOT NULL DEFAULT 'general',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;
  
SHOW WARNINGS;

-- ----------------------------------------
--   Table `issues`
-- ----------------------------------------
 
DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `lokham`.`issues` (
	`issue_id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`content` TEXT NOT NULL DEFAULT '',
	`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
     PRIMARY KEY (`issue_id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;
     
-- Constraints for table `issues`

  ALTER TABLE `lokham`.`issues`
  ADD INDEX `fk_users_idx` (`user_id` ASC),
  ADD CONSTRAINT `fk_user`
  FOREIGN KEY (`user_id`)
  REFERENCES `lokham`.`users` (`id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE;



INSERT INTO `users` (`id`, `first_name`, `last_name`, `middle_name`, `phone`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Sourav', 'Patteri', '', '7067910774', 'srv.ptr@gmail.com', '$2y$10$a8AHDsFblwOih1bUTWMtZeRoNbe1EFk9.o7eKNEJ1/lAHox9ZNtUi', 'general',  '2019-11-04 08:50:02', '2019-11-04 15:30:20');
