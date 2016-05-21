-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2016 at 02:16 AM
-- Server version: 5.6.28
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JukeJoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `jukejoint_database`
--

CREATE TABLE IF NOT EXISTS `jukejoint_database` (
  `id` int(11) NOT NULL,
  `song_name` varchar(40) CHARACTER SET ascii NOT NULL,
  `artist_name` varchar(40) CHARACTER SET ascii NOT NULL,
  `duration` time NOT NULL,
  `youtube_url` varchar(50) CHARACTER SET ascii NOT NULL,
  `video_id` varchar(50) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jukejoint_database`
--

INSERT INTO `jukejoint_database` (`id`, `song_name`, `artist_name`, `duration`, `youtube_url`, `video_id`) VALUES
(0, 'Hello', 'Adele', '00:06:06', 'https://www.youtube.com/watch?v=YQHsXMglC9A', 'YQHsXMglC9A'),
(1, 'Don''t Let Me Down ft Daya', 'The Chainsmokers ', '00:03:29', 'https://www.youtube.com/watch?v=qMH0Xglh7GA', 'qMH0Xglh7GA'),
(2, 'Hymn For The Weekend', 'Coldplay', '00:04:20', 'https://www.youtube.com/watch?v=YykjpeuMNEk', 'YykjpeuMNEk'),
(3, 'I Took A Pill In Ibiza', 'Mike Posner', '00:04:39', 'https://www.youtube.com/watch?v=41GZVVcxQps', '41GZVVcxQps'),
(4, '7 Years', 'Lukas Graham ', '00:03:59', 'https://www.youtube.com/watch?v=LHCob76kigA', 'LHCob76kigA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jukejoint_database`
--
ALTER TABLE `jukejoint_database`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
