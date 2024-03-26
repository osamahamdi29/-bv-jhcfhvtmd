-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2021 at 06:00 PM
-- Server version: 10.3.27-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linklizq_egcash`
--

-- --------------------------------------------------------

--
-- Table structure for table `watched_video`
--

CREATE TABLE `watched_video` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `watched_video`
--

INSERT INTO `watched_video` (`id`, `video_id`, `user_id`, `date`) VALUES
(1, 1, 1, '2021-01-20 21:25:16'),
(2, 1, 2, '2021-01-20 22:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `youtube`
--

CREATE TABLE `youtube` (
  `id` int(11) NOT NULL,
  `url` text DEFAULT NULL,
  `points` bigint(20) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `title` text DEFAULT NULL,
  `subtitle` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `youtube`
--

INSERT INTO `youtube` (`id`, `url`, `points`, `duration`, `date`, `image`, `status`, `title`, `subtitle`) VALUES
(1, 'https://www.youtube.com/watch?v=NHOBnpg0IBo', 50, '2', '2021-01-20 01:24:03', 'mqdefault.jpeg', 1, 'test 2', 'test subtitle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `watched_video`
--
ALTER TABLE `watched_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube`
--
ALTER TABLE `youtube`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `watched_video`
--
ALTER TABLE `watched_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `youtube`
--
ALTER TABLE `youtube`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
