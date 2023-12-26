-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 20, 2023 lúc 05:03 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webhoidap`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id_answer` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `status` char(30) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookmarks`
--

CREATE TABLE `bookmarks` (
  `author` char(20) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `marked_by` char(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hashtags`
--

CREATE TABLE `hashtags` (
  `id_hashtag` int(11) NOT NULL,
  `id_question` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `edited_at` date DEFAULT NULL,
  `author` char(20) NOT NULL,
  `upvote` int(11) DEFAULT 0,
  `downvote` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
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
-- Cấu trúc bảng cho bảng `question_hashtag`
--

CREATE TABLE `question_hashtag` (
  `id_hashtag` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shares`
--

CREATE TABLE `shares` (
  `author` char(20) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `shared_by` char(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `joined_at` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `joined_at`, `avatar`) VALUES
(1, 'nhan', 'nhan', 'nhan', '$2y$10$Kij6wYl7Ielzm9orBrYv/.KpFBHeXkv0HFfQZ50uL2MYTHmWFmpS2', '2023-12-16', 'thobaymau.jpg'),
(2, 'nguyenvanb', 'b', 'nguyen van', '$2y$10$16BakbZl09i/y3eOHzOozu2yvb4xlyVk1.C50Z6DRG6D9ylR0xpwW', '2023-12-17', 'thobaymau.jpg'),
(3, 'toilanam', 'Nam', 'Nguyễn Thành', '$2y$10$mASeUakgFay2PDygJPzjHuBk7NnFTodIjjGqiJsEN4hflAboG3wtK', '2023-12-17', 'thobaymau.jpg'),
(4, 'van', 'van', 'van', '$2y$10$7V/ETBebRbw/ZPn1j5IZgOdzcki2H8jJWS8n2NZ494U3k14EJc/TO', '2023-12-18', 'thobaymau.jpg'),
(22, 'quanhoang', 'nguyen', 'hoang quan', '$2y$10$AMo.RY35ML/KxYwZmEdlhO20IxnFSkLIkQtx17kRMAQGPHMtWYiBK', '20/12/2023 10:56:27pm', 'thobaymau.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote_answer`
--

CREATE TABLE `vote_answer` (
  `id_answer` int(11) NOT NULL,
  `usersname` char(20) DEFAULT NULL,
  `type` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote_question`
--

CREATE TABLE `vote_question` (
  `id_question` int(11) NOT NULL,
  `usersname` char(20) NOT NULL,
  `type` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_answer`);

--
-- Chỉ mục cho bảng `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`question_id`);

--
-- Chỉ mục cho bảng `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`id_hashtag`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `question_hashtag`
--
ALTER TABLE `question_hashtag`
  ADD PRIMARY KEY (`id_hashtag`,`id_question`);

--
-- Chỉ mục cho bảng `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`question_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vote_answer`
--
ALTER TABLE `vote_answer`
  ADD PRIMARY KEY (`id_answer`);

--
-- Chỉ mục cho bảng `vote_question`
--
ALTER TABLE `vote_question`
  ADD PRIMARY KEY (`id_question`,`usersname`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
