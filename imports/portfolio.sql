-- Create the database
CREATE DATABASE IF NOT EXISTS portfolio;

-- Switch to the created database
USE portfolio;

-- users table
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `about` TEXT NULL,
  `experience` TEXT NULL,
  `skills` TEXT NULL,
  `contact` TEXT NULL,
  `custom1` TEXT NULL,
  `custom2` TEXT NULL,
  `custom3` TEXT NULL,
  PRIMARY KEY (`id`));