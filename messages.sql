-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 01:58 PM
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `username` varchar(200) NOT NULL,
  `message` mediumtext DEFAULT NULL,
  `account` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `timestamp`, `username`, `message`, `account`) VALUES
(NULL, '2024-06-09 10:00:42', 'momon002', 'hahaha', 'momon002'),
(NULL, '2024-06-09 10:01:53', 'momon002', 'hahaha', 'momon002'),
(NULL, '2024-06-09 10:05:11', 'momon002', 'hahaha', 'momon002'),
(NULL, '2024-06-09 10:06:38', 'momon002', 'hahaha', 'momon002'),
(NULL, '2024-06-09 10:18:20', 'momon002', 'bonak', 'momon002'),
(NULL, '2024-06-09 10:32:42', 'momon002', 'reert', 'momon002'),
(NULL, '2024-06-09 10:54:40', 'momon002', 'qweqwe😉😵😤😤', 'werw'),
(NULL, '2024-06-09 10:57:08', 'momon002', 'qweqe😈', 'momon002'),
(NULL, '2024-06-09 12:21:07', 'momon002', 'sadas😧', 'admin'),
(NULL, '2024-06-09 12:22:29', 'momon002', '😔😢', 'momon002'),
(NULL, '2024-06-09 12:22:45', 'momon002', '😧😠', 'hjj'),
(NULL, '2024-06-09 14:46:42', 'momon002', '😢😣', 'momon002'),
(NULL, '2024-06-09 15:13:39', 'momon002', '😈😡', 'hjj'),
(NULL, '2024-06-09 15:14:53', 'momon002', 'Anu na sunod 😴😴', 'gino'),
(NULL, '2024-06-10 08:49:33', 'momon002', 'hahah😅', 'momon002'),
(NULL, '2024-06-10 09:02:04', 'momon002', '😦😚😓', 'momon002'),
(NULL, '2024-06-10 09:07:55', 'momon002', '😎', 'gino'),
(NULL, '2024-06-10 09:13:13', 'Mon', '😝😝😝', 'momon002'),
(NULL, '2024-06-10 09:14:43', 'Mon', 'Ano gagawin dun sa apat na box sa home', 'Maryuuuu'),
(NULL, '2024-06-10 09:59:58', 'Mon', 'Naka login kana?', 'Maryuuuu'),
(NULL, '2024-06-10 14:35:37', 'gino', 'sdfs', 'momon002'),
(NULL, '2024-06-10 14:36:46', 'momon002', 'anu sabi mo 😲😵', 'momon002'),
(NULL, '2024-06-10 15:38:48', 'Maryuuuu', 'Hindi ko alam😭', 'momon002'),
(NULL, '2024-06-10 17:22:49', 'momon002', '😇😇😎', 'group'),
(NULL, '2024-06-10 17:23:53', 'momon002', '😌🎉😓', 'group'),
(NULL, '2024-06-10 17:25:45', 'group', '😄😐😐', 'group'),
(NULL, '2024-06-10 17:27:33', 'group', '😵', 'group'),
(NULL, '2024-06-10 17:28:28', 'group', '😞😤😥', 'group'),
(NULL, '2024-06-10 21:45:33', 'momon002', 'Napipindot na un box pati un bilog na tapat nun', 'Maryuuuu'),
(NULL, '2024-06-11 02:39:04', 'group', 'eyyy', 'group'),
(NULL, '2024-06-11 02:39:27', 'group', 'Nagana monnn', 'group'),
(NULL, '2024-06-11 02:46:05', 'group', '😦😧😪', 'group'),
(NULL, '2024-06-11 02:46:15', 'group', '😚😭😭', 'group'),
(NULL, '2024-06-11 03:14:01', 'Silva', 'hello po hahaha\r\n', 'momon002'),
(NULL, '2024-06-11 03:14:38', 'group', 'Dito mario?', 'group'),
(NULL, '2024-06-11 03:14:46', 'Silva', 'ask ko lang po dun sa ihanda, if keri nyo po maglink ng for lindol? like nakalink sya sa phivolcs? or kahit san po na alert for earthquake?\r\n', 'momon002'),
(NULL, '2024-06-11 03:14:53', 'group', 'Nbhhvhh', 'group'),
(NULL, '2024-06-11 03:15:22', 'group', '😯😜😣', 'group'),
(NULL, '2024-06-11 03:17:09', 'group', 'angass', 'group'),
(NULL, '2024-06-11 03:17:13', 'group', 'angass', 'group'),
(NULL, '2024-06-11 03:18:46', 'Maryuuuu', 'oyy', 'Silva'),
(NULL, '2024-06-11 03:19:23', 'Silva', 'bat kita mo mario\r\n', 'momon002'),
(NULL, '2024-06-11 03:19:32', 'Silva', 'hooy', 'Maryuuuu'),
(NULL, '2024-06-11 03:26:27', 'collainesmrtbrgy', 'Say', 'Silva'),
(NULL, '2024-06-11 03:26:28', 'collainesmrtbrgy', 'Say', 'Silva'),
(NULL, '2024-06-11 03:26:36', 'collainesmrtbrgy', 'Hahahaha ', 'momon002'),
(NULL, '2024-06-11 03:39:00', 'group', 'try kop  i link sa phivolcs', 'group'),
(NULL, '2024-06-11 03:46:14', 'momon002', 'qweqwe', 'group'),
(NULL, '2024-06-11 03:58:49', 'momon002', 'kelan presentarion nyo', 'group'),
(NULL, '2024-06-11 04:09:58', 'momon002', 'D to account mario, dun sa recipent choose maryuu', 'Silva'),
(NULL, '2024-06-11 04:15:34', 'momon002', 'gaagawin ko un phivolcs, kailan presentation?', 'Silva'),
(NULL, '2024-06-11 04:18:38', 'momon002', '😎😎😎😎', 'momon002'),
(NULL, '2024-06-11 05:56:27', 'gino', 'June 22 daw', 'group'),
(NULL, '2024-06-11 05:58:17', 'momon002', '😦😧😧', 'momon002'),
(NULL, '2024-06-11 05:58:23', 'momon002', '😏😝😏', 'momon002'),
(NULL, '2024-06-11 06:09:32', 'Mon', 'Hello', 'momon002'),
(NULL, '2024-06-11 06:09:43', 'Mon', 'Hai😗', 'Nicko'),
(NULL, '2024-06-11 06:10:10', 'Mon', '😇😈😑', 'group'),
(NULL, '2024-06-11 07:26:21', 'momon002', '😗😍😍😕😚😕😠', 'momon002'),
(NULL, '2024-06-11 12:32:29', 'gino', 'kain guys', 'group'),
(NULL, '2024-06-17 05:24:25', 'momon002', '🌊may baha ', 'handa'),
(NULL, '2024-06-17 05:25:14', 'momon002', '🌋may volcanic ash po\r\n', 'handa'),
(NULL, '2024-06-17 12:37:24', 'momon002', '🫥', 'handa'),
(NULL, '2024-06-18 06:33:25', 'gino', 'Hee!!', 'handa'),
(NULL, '2024-06-18 06:33:58', 'gino', 'Hshhsk', 'admin'),
(NULL, '2024-06-22 17:33:56', 'werw', '😉😊', 'Mon'),
(NULL, '2024-06-22 17:34:22', 'werw', '😣', 'werw'),
(NULL, '2024-06-22 17:36:07', 'werw', '😉', 'Mon'),
(NULL, '2024-06-22 17:36:52', 'momon002', '😴', 'werw'),
(NULL, '2024-06-22 17:37:22', 'werw', '😴', 'momon002'),
(NULL, '2024-06-22 17:40:59', 'werw', '😷', 'Mon'),
(NULL, '2024-06-22 17:49:58', 'momon002', '😱', 'werw'),
(NULL, '2024-06-22 17:52:24', 'werw', '😇', 'momon002'),
(NULL, '2024-06-22 17:57:56', 'werw', '😤', 'werw'),
(NULL, '2024-06-22 18:00:48', 'werw', '😹', 'werw'),
(NULL, '2024-06-22 18:00:55', 'werw', '😸', 'momon002'),
(NULL, '2024-06-22 18:02:46', 'werw', '😷😵', 'momon002'),
(NULL, '2024-06-22 18:09:48', 'werw', '😝', 'momon002'),
(NULL, '2024-06-22 18:10:36', 'werw', '😢', 'momon002'),
(NULL, '2024-06-22 18:17:40', 'werw', '😰', 'admin'),
(NULL, '2024-06-22 18:21:40', 'momon002', '😷', 'admin'),
(NULL, '2024-06-22 18:29:39', 'werw', '😙', 'admin'),
(NULL, '2024-06-22 18:30:04', 'werw', '😟', 'admin'),
(NULL, '2024-06-22 18:38:43', 'admin', 'jj', 'momon002'),
(NULL, '2024-06-22 18:41:15', 'momon002', '😥', 'momon002'),
(NULL, '2024-06-22 18:43:56', 'Maryuuuu', 'sheesh', 'handa'),
(NULL, '2024-06-25 02:07:53', 'Silva', 'hii😅', 'handa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
