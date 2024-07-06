-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 01:57 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21660325_mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `timestamp_column` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `filename`, `username`, `timestamp_column`) VALUES
(1, 'drugs.webp', 'Momon', '2024-06-06 19:42:57'),
(2, 'firstaid.jpg', 'Momon', '2024-06-06 19:44:32'),
(3, 'drill.jpg', 'Momon', '2024-06-06 19:46:08'),
(4, 'output-onlinepngtools (8).png', 'Momon', '2024-06-06 19:48:05'),
(5, 'output-onlinepngtools (5).png', 'Momon', '2024-06-06 19:49:18'),
(6, 'search.png', 'Momon', '2024-06-06 19:50:47'),
(7, 'heart.png', 'Momon', '2024-06-06 20:06:48'),
(8, '', 'Momon', '2024-06-07 05:41:28'),
(9, 'inbound1434193814748700000.jpg', 'Momon', '2024-06-07 05:41:47'),
(10, '399840749_720174836275244_250754574403918690_n.png', 'Momon', '2024-06-07 06:19:18'),
(11, 'logo.png', 'Momon', '2024-06-07 06:19:47'),
(12, '373371795_990107692204311_2570065496471939493_n (1).jpg', 'Momon', '2024-06-07 07:18:43'),
(13, '', 'Momon', '2024-06-07 08:11:10'),
(14, 'home.png', 'Momon', '2024-06-07 08:11:51'),
(15, '', 'Momon', '2024-06-07 08:12:58'),
(16, '', 'Momon', '2024-06-07 08:15:50'),
(17, '', 'Momon', '2024-06-07 08:15:58'),
(18, '', 'Momon', '2024-06-07 08:16:41'),
(19, '', 'Momon', '2024-06-07 08:16:53'),
(20, 'heart.png', 'Momon', '2024-06-07 08:17:17'),
(21, 'inbound6607058536579294722.jpg', 'Momon', '2024-06-07 08:34:42'),
(22, 'inbound742756526168354272.jpg', 'Momon', '2024-06-07 09:53:46'),
(23, 'inbound5623613766321012492.jpg', 'Momon', '2024-06-07 12:27:50'),
(24, '239d5705-2336-4a2c-8908-71449406c119~2.jpg', 'momon002', '2024-06-09 03:55:32'),
(25, '17179053636673011709266744948258.jpg', 'momon002', '2024-06-09 03:57:01'),
(26, '3x3.jpg', 'werw', '2024-06-09 09:16:29'),
(27, 'inbound5905468576215662508.jpg', 'momon002', '2024-06-09 15:05:32'),
(28, '', 'Maryuuuu', '2024-06-10 15:37:16'),
(29, '', 'Maryuuuu', '2024-06-10 15:37:28'),
(30, '', 'Maryuuuu', '2024-06-11 02:29:02'),
(31, '', 'Silva', '2024-06-11 02:34:47'),
(32, 'K8roaH.webp', 'Silva', '2024-06-11 02:35:21'),
(33, 'inbound1887733939286429078.jpg', 'Mon', '2024-06-11 06:08:47'),
(34, 'inbound205757468080280384.jpg', 'momon002', '2024-06-12 11:58:58'),
(35, '', 'Maryuuuu', '2024-06-13 13:21:18'),
(36, 'Screenshot_2024-06-13-00-39-41-79_40deb401b9ffe8e1df2f1cc5ba480b12.jpg', 'Maryuuuu', '2024-06-13 13:22:33'),
(37, 'inbound1040684382115720417.jpg', 'momon002', '2024-06-17 13:28:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
