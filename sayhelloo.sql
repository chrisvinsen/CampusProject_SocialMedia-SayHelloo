-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 03:03 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sayhelloo`
--

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `username_connection` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `creator_username` varchar(100) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `images` varchar(5000) DEFAULT NULL,
  `total_likes` int(11) DEFAULT NULL,
  `total_comments` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `creator_username`, `content`, `images`, `total_likes`, `total_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(191, 'vinsen', 'Hello World!', '', 4, 0, '2020-03-26 01:53:37', NULL, NULL),
(192, 'vinsen', 'vinsen just updated the profile photo!', 'aaaal.png', 4, NULL, '2020-03-26 01:53:51', NULL, NULL),
(193, 'vinsen', 'vinsen just updated the cover photo!', '3.jpg', 4, NULL, '2020-03-26 01:53:58', NULL, NULL),
(194, 'vinsen', 'I like this website.', '', 3, 0, '2020-03-26 01:54:18', NULL, NULL),
(195, 'delvin', 'I like this websiteee very much', '', 3, 3, '2020-03-26 01:55:16', NULL, NULL),
(196, 'delvin', 'delvin just updated the profile photo!', 'aa.jpg', 3, NULL, '2020-03-26 01:55:23', NULL, NULL),
(197, 'delvin', 'delvin just updated the cover photo!', '1.jpg', 2, NULL, '2020-03-26 01:55:28', NULL, NULL),
(198, 'michael', 'michael just updated the cover photo!', '2.jpg', 2, NULL, '2020-03-26 01:56:52', NULL, NULL),
(199, 'michael', 'I Like this website.. Say Hellooo eveyone', '', 2, 1, '2020-03-26 01:57:05', NULL, NULL),
(200, 'velix', 'velix just updated the cover photo!', '3.jpg', 1, NULL, '2020-03-26 01:58:10', NULL, NULL),
(201, 'velix', 'Hii everyone.. I Like this website &lt;3', '', 1, 1, '2020-03-26 01:58:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `commenter` varchar(100) NOT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`no`, `post_id`, `commenter`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(57, 197, 'delvin', 'Hi everyone', '2020-03-26 01:55:45', NULL, NULL),
(58, 201, 'velix', 'Hii', '2020-03-26 01:58:58', NULL, NULL),
(59, 200, 'velix', 'Seaaa', '2020-03-26 01:59:14', NULL, NULL),
(60, 199, 'velix', 'I like this too', '2020-03-26 01:59:25', NULL, NULL),
(61, 195, 'velix', 'i like it too', '2020-03-26 02:00:15', NULL, NULL),
(62, 195, 'velix', 'hii', '2020-03-26 02:00:56', NULL, NULL),
(63, 195, 'velix', 'wkwkwk', '2020-03-26 02:01:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `no` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username_liker` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`no`, `post_id`, `username_liker`, `created_at`, `updated_at`, `deleted_at`) VALUES
(119, 191, 'vinsen', '2020-03-26 01:53:40', NULL, NULL),
(120, 193, 'vinsen', '2020-03-26 01:54:01', NULL, NULL),
(121, 192, 'vinsen', '2020-03-26 01:54:02', NULL, NULL),
(122, 197, 'delvin', '2020-03-26 01:55:36', NULL, NULL),
(123, 196, 'delvin', '2020-03-26 01:55:54', NULL, NULL),
(124, 194, 'delvin', '2020-03-26 01:55:56', NULL, NULL),
(125, 195, 'delvin', '2020-03-26 01:55:57', NULL, NULL),
(126, 193, 'delvin', '2020-03-26 01:55:59', NULL, NULL),
(127, 192, 'delvin', '2020-03-26 01:56:01', NULL, NULL),
(128, 191, 'delvin', '2020-03-26 01:56:02', NULL, NULL),
(129, 199, 'michael', '2020-03-26 01:57:07', NULL, NULL),
(130, 198, 'michael', '2020-03-26 01:57:09', NULL, NULL),
(131, 196, 'michael', '2020-03-26 01:57:18', NULL, NULL),
(132, 195, 'michael', '2020-03-26 01:57:18', NULL, NULL),
(133, 194, 'michael', '2020-03-26 01:57:20', NULL, NULL),
(134, 193, 'michael', '2020-03-26 01:57:23', NULL, NULL),
(135, 191, 'michael', '2020-03-26 01:57:25', NULL, NULL),
(136, 192, 'michael', '2020-03-26 01:57:26', NULL, NULL),
(137, 201, 'velix', '2020-03-26 01:58:29', NULL, NULL),
(138, 200, 'velix', '2020-03-26 01:58:31', NULL, NULL),
(139, 199, 'velix', '2020-03-26 01:58:32', NULL, NULL),
(140, 198, 'velix', '2020-03-26 01:58:34', NULL, NULL),
(141, 197, 'velix', '2020-03-26 01:58:36', NULL, NULL),
(142, 196, 'velix', '2020-03-26 01:58:38', NULL, NULL),
(143, 195, 'velix', '2020-03-26 01:58:41', NULL, NULL),
(144, 194, 'velix', '2020-03-26 01:58:42', NULL, NULL),
(145, 193, 'velix', '2020-03-26 01:58:46', NULL, NULL),
(146, 192, 'velix', '2020-03-26 01:58:48', NULL, NULL),
(147, 191, 'velix', '2020-03-26 01:58:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `password` varchar(10000) NOT NULL,
  `photo_profile` varchar(1000) DEFAULT NULL,
  `cover_image` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `connection` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `first_name`, `last_name`, `birth_date`, `gender`, `password`, `photo_profile`, `cover_image`, `description`, `connection`, `created_at`, `updated_at`, `deleted_at`) VALUES
('delvin', 'Delvin', 'Chianardi', '2000-10-17', 'M', '88584f8f630d94e118070aa12ba34797', 'aa.jpg', '1.jpg', NULL, 0, '2020-03-26 01:54:53', '2020-03-26 01:54:53', NULL),
('michael', 'michael', 'tuesden', '2000-10-17', 'M', 'e20feeb94096147ab0acd18228afb104', NULL, '2.jpg', NULL, 0, '2020-03-26 01:56:34', '2020-03-26 01:56:34', NULL),
('velix', 'velix', 'halim', '2000-12-12', 'F', '316758caa4ff042ddb0573fcd96df9dc', NULL, '3.jpg', NULL, 0, '2020-03-26 01:57:52', '2020-03-26 01:57:52', NULL),
('vinsen', 'Christianto', 'Vinsen', '2000-10-17', 'M', '5c9c3d08ea04ae228f756dc844091758', 'aaaal.png', '3.jpg', NULL, 0, '2020-03-26 01:53:13', '2020-03-26 01:53:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `creator_username` (`creator_username`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`no`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `username_commenter` (`commenter`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`no`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `username_liker` (`username_liker`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`creator_username`) REFERENCES `user` (`username`);

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_comments_ibfk_2` FOREIGN KEY (`commenter`) REFERENCES `user` (`username`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`username_liker`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
