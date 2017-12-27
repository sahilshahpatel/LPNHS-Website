-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2017 at 07:39 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhs_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(12) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Description` varchar(64) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Location` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `Description`, `StartDate`, `EndDate`, `Location`) VALUES
(1, 'TestEvent', 'This is a description', '2017-12-27', '2017-12-27', 'Here');

-- --------------------------------------------------------

--
-- Table structure for table `eventshift`
--

CREATE TABLE `eventshift` (
  `EventID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventshift`
--

INSERT INTO `eventshift` (`EventID`, `ShiftID`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionID`, `ShiftID`, `StudentID`) VALUES
(1, 1, 123456),
(2, 2, 654321);

-- --------------------------------------------------------

--
-- Table structure for table `shiftposition`
--

CREATE TABLE `shiftposition` (
  `ShiftID` int(12) NOT NULL,
  `PositionID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shiftposition`
--

INSERT INTO `shiftposition` (`ShiftID`, `PositionID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `ShiftID` int(12) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` varchar(12) NOT NULL,
  `EndTime` varchar(12) NOT NULL,
  `PositionsAvailable` int(12) NOT NULL,
  `EventID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`ShiftID`, `Date`, `StartTime`, `EndTime`, `PositionsAvailable`, `EventID`) VALUES
(1, '2017-12-27', '12:00', '1:00', 1, 1),
(2, '2017-12-27', '1:00', '2:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentposition`
--

CREATE TABLE `studentposition` (
  `StudentID` int(12) NOT NULL,
  `PositionID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentposition`
--

INSERT INTO `studentposition` (`StudentID`, `PositionID`) VALUES
(123456, 1),
(654321, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(12) NOT NULL,
  `FirstName` varchar(12) NOT NULL,
  `LastName` varchar(12) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `HoursCompleted` float NOT NULL,
  `VicePresident` varchar(12) NOT NULL,
  `Permissions` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `HoursCompleted`, `VicePresident`, `Permissions`) VALUES
(123456, 'Sahil', 'Patel', 'email@email.com', 2, 'Miloni', 'admin'),
(654321, 'Ben', 'Wagrez', 'email2@email.com', 3.5, 'Nic', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`ShiftID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ShiftID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
