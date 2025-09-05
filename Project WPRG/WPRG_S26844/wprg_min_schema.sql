
-- Minimal schema for SEM4_WPRG_FINAL_PROJECT
-- Creates required tables with reasonable types and constraints.

CREATE DATABASE IF NOT EXISTS `wprg_blog` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wprg_blog`;

CREATE TABLE IF NOT EXISTS `wprg_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('ADMIN','AUTHOR','USER') NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wprg_posts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` MEDIUMTEXT NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wprg_users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_posts_user` (`wprg_users_id`),
  CONSTRAINT `fk_posts_user` FOREIGN KEY (`wprg_users_id`) REFERENCES `wprg_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wprg_comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `wprg_posts_id` INT UNSIGNED NOT NULL,
  `wprg_users_id` INT UNSIGNED NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_comments_post` (`wprg_posts_id`),
  KEY `idx_comments_user` (`wprg_users_id`),
  CONSTRAINT `fk_comments_post` FOREIGN KEY (`wprg_posts_id`) REFERENCES `wprg_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comments_user` FOREIGN KEY (`wprg_users_id`) REFERENCES `wprg_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wprg_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `action` VARCHAR(255) NOT NULL,
  `user_id` INT UNSIGNED NULL,
  `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wprg_contact` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(190) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional: make the first registered user admin (manual step):
-- UPDATE wprg_users SET role='ADMIN' WHERE id=1;
