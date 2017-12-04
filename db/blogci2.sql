-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 09:35 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogci2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `fullname` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `detailAddress` text NOT NULL,
  `userID` int(5) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`fullname`, `telp`, `detailAddress`, `userID`, `picture`) VALUES
('Arif Lapengo', '', '', 22, NULL),
('', '', '', 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCategory` int(5) NOT NULL,
  `nameCategory` varchar(100) DEFAULT NULL,
  `is_parents` int(5) DEFAULT NULL,
  `slug_ctg` varchar(100) DEFAULT NULL,
  `statuscategori` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `idcomment` int(5) NOT NULL,
  `tittleComment` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statuscomments` int(2) DEFAULT NULL,
  `userID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `idLevels` int(5) NOT NULL,
  `nameLevels` varchar(15) NOT NULL,
  `statuslevels` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`idLevels`, `nameLevels`, `statuslevels`) VALUES
(1, 'admins', 1),
(2, 'teknisi', 0),
(3, 'viewer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `idnews` int(5) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `ctgID` int(5) DEFAULT NULL,
  `news` longtext NOT NULL,
  `previewPic` varchar(255) NOT NULL,
  `createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(5) DEFAULT NULL,
  `statusnews` int(2) DEFAULT NULL,
  `slug_news` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(5) NOT NULL,
  `levelID` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `createdate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updatedate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `logindate` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `tokenme` varchar(255) DEFAULT NULL,
  `statususers` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `levelID`, `username`, `password`, `email`, `createdate`, `updatedate`, `logindate`, `tokenme`, `statususers`) VALUES
(22, 1, 'salahuddin171174', 'ec8aa71523cc411b9b32f09277524f3a', 'ariflapengo@gmail.com', '2017-11-26 23:59:23', '0000-00-00 00:00:00', '2017-11-28 18:58:30', 'invalite', 0),
(23, 1, 'salahuddin171193', '71ebc650441e1e32e9a3df4521e1f57e', 'ariflapengao@gmail.com', '2017-11-28 05:50:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'j8JdRbSXTOKs7NlP', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `userID` (`userID`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCategory`) USING BTREE;

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idcomment`),
  ADD KEY `userID` (`userID`) USING BTREE;

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`idLevels`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idnews`),
  ADD KEY `userIDpr` (`userID`),
  ADD KEY `ctgID` (`ctgID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`),
  ADD KEY `levelID` (`levelID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCategory` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `idcomment` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `idLevels` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `idnews` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `userIDfr` FOREIGN KEY (`userID`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `ctgID` FOREIGN KEY (`ctgID`) REFERENCES `category` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userIDpr` FOREIGN KEY (`userID`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `levelID` FOREIGN KEY (`levelID`) REFERENCES `levels` (`idLevels`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
