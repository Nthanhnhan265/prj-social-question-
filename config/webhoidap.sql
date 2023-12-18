-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2023 at 07:07 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webhoidap`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` date DEFAULT NULL,
  `status` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_question` int DEFAULT NULL,
  `upvote` int DEFAULT NULL,
  `downvote` int DEFAULT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `author` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int NOT NULL,
  `marked_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
CREATE TABLE IF NOT EXISTS `hashtags` (
  `id_hashtag` int NOT NULL,
  `id_question` int DEFAULT NULL,
  PRIMARY KEY (`id_hashtag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `edited_at` date DEFAULT NULL,
  `author` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upvote` int DEFAULT '0',
  `downvote` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `type`, `created_at`, `edited_at`, `author`, `upvote`, `downvote`) VALUES
(2, 'what is the biggest river in the world?', 'question', '2023-12-17', '2023-12-17', 'nhan', 0, 0),
(3, 'how many days in a year? ', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 0),
(4, 'Why does it seem like everyone thinks they can code, but very few people actually have the skills necessary to be successful as software engineers and programmers?\r\n', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 0),
(5, 'How do top students study?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 0, 0),
(6, 'What are some must read books for people in their 20s?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 0, 0),
(7, 'How many people are there in the world?', 'question', '2023-12-18', '2023-12-18', 'van', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_hashtag`
--

DROP TABLE IF EXISTS `question_hashtag`;
CREATE TABLE IF NOT EXISTS `question_hashtag` (
  `id_hashtag` int NOT NULL,
  `id_question` int NOT NULL,
  PRIMARY KEY (`id_hashtag`,`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `author` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int NOT NULL,
  `shared_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_at` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firstname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `joined_at`, `description`, `firstname`, `lastname`, `avatar`) VALUES
('nhan', '$2y$10$Kij6wYl7Ielzm9orBrYv/.KpFBHeXkv0HFfQZ50uL2MYTHmWFmpS2', '2023-12-16', '', 'nhan', 'nhan', ''),
('nguyenvanb', '$2y$10$16BakbZl09i/y3eOHzOozu2yvb4xlyVk1.C50Z6DRG6D9ylR0xpwW', '2023-12-17', '', 'b', 'nguyen van', ''),
('toilanam', '$2y$10$mASeUakgFay2PDygJPzjHuBk7NnFTodIjjGqiJsEN4hflAboG3wtK', '2023-12-17', '', 'Nam', 'Nguyễn Thành', ''),
('van', '$2y$10$7V/ETBebRbw/ZPn1j5IZgOdzcki2H8jJWS8n2NZ494U3k14EJc/TO', '2023-12-18', '', 'van', 'van', '');

-- --------------------------------------------------------

--
-- Table structure for table `vote_answer`
--

DROP TABLE IF EXISTS `vote_answer`;
CREATE TABLE IF NOT EXISTS `vote_answer` (
  `id_answer` int NOT NULL,
  `usersname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vote_question`
--

DROP TABLE IF EXISTS `vote_question`;
CREATE TABLE IF NOT EXISTS `vote_question` (
  `id_question` int NOT NULL,
  `usersname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_question`,`usersname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
