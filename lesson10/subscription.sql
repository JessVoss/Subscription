-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2020 at 08:03 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subscription`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE `auth_users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(41) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `firstName`, `lastName`, `email`, `username`, `password`) VALUES
(0, 'Jessica', 'Voss', 'voss18@mail.nmc.edu', 'voss18', 'Cooper#1'),
(1, 'jude', 'waren', 'whatever@hotmail.com', 'waren39', 'ThePassword');

-- --------------------------------------------------------

--
-- Table structure for table `fitnessgroup`
--

CREATE TABLE `fitnessgroup` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(25) DEFAULT NULL,
  `Zipcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fitnessgroup`
--

INSERT INTO `fitnessgroup` (`ID`, `Name`, `City`, `State`, `Zipcode`) VALUES
(1, 'Munson Running Club', 'Traverse City', 'Mi', 49684),
(2, 'Munson Biking Club', 'Traverse City', 'Mi', 49684),
(3, 'Otsego Running Club', 'Gaylord', 'Mi', 49735),
(4, 'Kalkaska Running Club', 'Kalkaska', 'Mi', 49746),
(5, 'Kalkaska Biking Club', 'Kalkaska', 'Mi', 49746),
(6, 'Munson Softball Club', 'Travers City', 'Mi', 49684),
(7, 'Otsego Softball Club', 'Gaylord', 'Mi', 49735),
(8, 'Kalkaska Softball Club', 'Kalkaska', 'Mi', 49746),
(9, 'Otsego Biking Club', 'Gaylord', 'Mi', 49735);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `Department` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`ID`, `FirstName`, `LastName`, `Email`, `Phone`, `Department`) VALUES
(13, 'Scooby', 'Doo', 'whichever@hotmail.com', '2312876988', 'EVS'),
(14, 'Jess', 'Voss', 'jess_wolf_24@homtail.com', '2312856598', 'MPI');

-- --------------------------------------------------------

--
-- Table structure for table `participantgroup`
--

CREATE TABLE `participantgroup` (
  `FitnessGroupID` int(11) DEFAULT NULL,
  `ParticipantID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fitnessgroup`
--
ALTER TABLE `fitnessgroup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fitnessgroup`
--
ALTER TABLE `fitnessgroup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
