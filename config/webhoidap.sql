-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2023 at 07:13 AM
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
  `id_answer` int NOT NULL AUTO_INCREMENT,
  `author` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` date DEFAULT NULL,
  `edited_at` date NOT NULL,
  `status` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_question` int DEFAULT NULL,
  `upvote` int DEFAULT '0',
  `downvote` int DEFAULT '0',
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id_answer`, `author`, `content`, `created_at`, `edited_at`, `status`, `id_question`, `upvote`, `downvote`) VALUES
(4, 'nhan', 'helop', '2023-12-21', '2023-12-21', 'ok', 9, NULL, NULL),
(3, 'nhan', '2', '2023-12-21', '2023-12-22', 'edited', 9, NULL, NULL),
(5, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', NULL, 0, 0),
(6, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', NULL, 0, 0),
(7, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(8, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(9, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(10, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(11, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(12, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(13, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(14, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(15, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(16, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(17, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 23, 0, 0),
(18, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(19, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0),
(20, 'nhan', '', '2023-12-22', '2023-12-22', 'answer', 9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `question_id` int NOT NULL,
  `marked_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`question_id`,`marked_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`question_id`, `marked_by`, `created_at`) VALUES
(22, 'nhan', '2023-12-21'),
(3, 'nhan', '2023-12-20'),
(7, 'nhan', '2023-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
CREATE TABLE IF NOT EXISTS `hashtags` (
  `id_hashtag` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_hashtag`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`id_hashtag`, `name`) VALUES
(1, 'geography'),
(2, 'study'),
(3, 'mountain'),
(12, 'Boostrap'),
(10, 'Programming'),
(11, 'HTML'),
(9, 'world'),
(13, 'JQuery'),
(14, 'Android Studio'),
(15, 'a'),
(16, 'b'),
(17, 'c'),
(18, 'dd2');

-- --------------------------------------------------------

--
-- Table structure for table `hashtag_question`
--

DROP TABLE IF EXISTS `hashtag_question`;
CREATE TABLE IF NOT EXISTS `hashtag_question` (
  `id_hashtag` int NOT NULL,
  `id_question` int NOT NULL,
  PRIMARY KEY (`id_hashtag`,`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hashtag_question`
--

INSERT INTO `hashtag_question` (`id_hashtag`, `id_question`) VALUES
(1, 7),
(1, 9),
(2, 9),
(3, 9),
(9, 7),
(9, 9),
(10, 17),
(10, 22),
(10, 23),
(11, 17),
(11, 22),
(12, 17),
(12, 22),
(13, 17),
(13, 22),
(14, 23),
(15, 7),
(16, 7),
(17, 7),
(18, 7);

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `type`, `created_at`, `edited_at`, `author`, `upvote`, `downvote`) VALUES
(9, 'Where is the highest mountain in the world', 'question', '2023-12-18', '2023-12-18', 'nhan', 1, 1),
(2, 'what is the biggest river in the world?', 'question', '2023-12-17', '2023-12-17', 'nhan', 0, 0),
(3, 'how many days in a year? ', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 1),
(4, 'Why does it seem like everyone thinks they can code, but very few people actually have the skills necessary to be successful as software engineers and programmers?\r\n', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 0),
(5, 'How do top students study?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 1, 0),
(6, 'What are some must read books for people in their 20s?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 0, 0),
(7, 'How many people are there in the world?', 'question', '2023-12-18', '2023-12-18', 'van', 0, 1),
(23, 'How to use Recyclerview in Android Studio?  ', 'question', '2023-12-21', '2023-12-21', 'nhan', 0, 1),
(22, 'How to use HTML,Boostrap and Jquery to create a Front-End website?\r\n\r\n', 'question', '2023-12-21', '2023-12-21', 'nhan', 1, 0);

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
  `username` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_question`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vote_question`
--

INSERT INTO `vote_question` (`id_question`, `username`, `type`) VALUES
(22, 'nhan', 'upvote'),
(5, 'nhan', 'upvote'),
(23, 'nhan', 'downvote'),
(3, 'nhan', 'downvote'),
(9, 'nhan', 'downvote'),
(9, 'nguyenvanb', 'upvote'),
(7, 'nhan', 'downvote');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
