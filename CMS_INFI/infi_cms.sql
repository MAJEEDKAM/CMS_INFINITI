-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2019 at 08:46 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infi_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminreg`
--

CREATE TABLE `adminreg` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminreg`
--

INSERT INTO `adminreg` (`id`, `name`, `datetime`, `addedby`, `pass`) VALUES
(1, 'admin', 'June-06/27/19-2019 14:45:48', 'admin', 'admin'),
(2, 'abcde', 'June-06/27/19-2019 20:30:44', 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(1, 'June-06/27/19-2019 20:29:56', 'Technology', 'admin'),
(2, 'June-06/27/19-2019 20:30:04', 'Travels', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `status` varchar(10) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comments`, `status`, `post_id`) VALUES
(1, 'June-06/27/19-2019 20:42:37', 'maj', 'abcd@efdgt.com', 'asdffsdafsad dafsadsda', 'ON', 13);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `photos` varchar(400) NOT NULL,
  `dateTime` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `tag1` varchar(50) NOT NULL,
  `tag2` varchar(50) NOT NULL,
  `tag3` varchar(50) NOT NULL,
  `tag4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category`, `content`, `photos`, `dateTime`, `Author`, `Status`, `tag1`, `tag2`, `tag3`, `tag4`) VALUES
(13, 'submittion of posts11', 'Technology', 'fsdafasdsadsad dsfggsdgsdfgsdf fsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdffsdafasdsadsad dsfggsdgsdfgsdf', 'Capture3.PNG', 'June-06/27/19-2019 20:41:59', 'admin', 'published', '#QWERTY11', '#qwertyuw', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminreg`
--
ALTER TABLE `adminreg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminreg`
--
ALTER TABLE `adminreg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
