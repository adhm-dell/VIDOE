-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 06:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Movie'),
(2, 'Music'),
(3, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `logo` varchar(100) DEFAULT NULL,
  `user_id` int(100) NOT NULL,
  `subscribers` int(100) NOT NULL,
  `cover_photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `creation_date`, `logo`, `user_id`, `subscribers`, `cover_photo`) VALUES
(1, 'The Explainer', '2024-05-07', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\logo\\663a2ba557d69images.jpeg', 1, 0, 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\cover photos\\663a2ba557d65wallpapersden.com_76996-1920x1080.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(100) NOT NULL,
  `content` varchar(200) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(100) NOT NULL,
  `video_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(10) NOT NULL,
  `user_id` int(50) NOT NULL,
  `video_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) NOT NULL,
  `content` varchar(200) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `user_id` int(50) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `description`, `user_id`, `creation_date`) VALUES
(1, 'Mobiles', 'csacsacscdcsa', 1, '2024-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `country` varchar(20) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `channel_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `country`, `profile_pic`, `channel_id`) VALUES
(1, 'adhm_salah', '123456', 'adhmdoma11@gmail.com', 'egypt', '', NULL),
(2, 'andrew', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'andrew@gmail.com', '', 'Rectangle 1 copy 4.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descreption` text NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp(),
  `thumbnail` varchar(100) DEFAULT NULL,
  `file_path` varchar(100) NOT NULL,
  `channel_id` int(50) DEFAULT NULL,
  `watches` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `num_of_reports` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `descreption`, `upload_date`, `thumbnail`, `file_path`, `channel_id`, `watches`, `category_id`, `num_of_reports`) VALUES
(6, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\663836c76a247Rectangle 1 copy 4.png', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\663836c76a241videoplayback.mp4', NULL, 0, 1, 0),
(7, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\663837be3f64bRectangle 1 copy 4.png', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\663837be3f645videoplayback.mp4', NULL, 0, 1, 0),
(8, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\663837d1a4719', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\663837d1a4716videoplayback.mp4', NULL, 0, 1, 0),
(9, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\663837e549b6c', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\663837e549b68', NULL, 0, 1, 0),
(10, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\663838e49db76', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\663838e49db70', NULL, 0, 1, 0),
(11, 'test', 'test', '2024-05-06', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Thumbnails\\6638394e40e72Rectangle 1 copy 4.png', 'C:\\xampp\\htdocs\\VIDOE\\View\\assets\\Videos\\6638394e40e6dvideoplayback.mp4', NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE `video_category` (
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_playlist`
--

CREATE TABLE `video_playlist` (
  `video_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(10) NOT NULL,
  `user_id` int(50) NOT NULL,
  `video_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `video_category`
--
ALTER TABLE `video_category`
  ADD PRIMARY KEY (`video_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `video_playlist`
--
ALTER TABLE `video_playlist`
  ADD KEY `video_id` (`video_id`),
  ADD KEY `playlist_id` (`playlist_id`) USING BTREE;

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `video_id` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`),
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `video_category`
--
ALTER TABLE `video_category`
  ADD CONSTRAINT `video_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `video_category_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

--
-- Constraints for table `video_playlist`
--
ALTER TABLE `video_playlist`
  ADD CONSTRAINT `video_playlist_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  ADD CONSTRAINT `video_playlist_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
