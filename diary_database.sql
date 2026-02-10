-- Database: diary
-- Created for Diaryhea Journal Application
-- Import this file into phpMyAdmin
-- This is a unified database containing both users and journal entries

-- --------------------------------------------------------

-- Create Database
CREATE DATABASE IF NOT EXISTS `diary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `diary`;

-- --------------------------------------------------------

-- Table structure for table `users`

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `entries`

CREATE TABLE IF NOT EXISTS `entries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `Title` VARCHAR(255) NOT NULL,
  `entries` LONGTEXT NOT NULL,
  `imageName` VARCHAR(255),
  `imagePath` VARCHAR(500),
  `Time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Sample data (optional - remove if not needed)
-- INSERT INTO `users` (`email`, `password`) VALUES ('user@example.com', 'password123');

-- --------------------------------------------------------
