-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 01:24 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
  `Location` varchar(32) NOT NULL,
  `Shifts` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventshift`
--

CREATE TABLE `eventshift` (
  `EventID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL,
  `StudentID` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `sitecontent`
--

CREATE TABLE `sitecontent` (
  `whatItTakes` varchar(512) NOT NULL,
  `whatItTakes2` varchar(512) NOT NULL,
  `attention` varchar(512) NOT NULL,
  `aboutUs` varchar(512) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitecontent`
--

INSERT INTO `sitecontent` (`whatItTakes`, `whatItTakes2`, `attention`, `aboutUs`, `ID`) VALUES
('NHS seeks out students who have a dedication to serving their community. \r\nCharacter is another category NHS pays attention to regarding candidates. A student with high character adheres to high standards of honesty, is courteous to others, and has a clean disciplinary record. Avoid people and situations where you might get in trouble. Things like recreational drug use and underage drinking look bad on an NHS application.\r\nYou cannot simply apply to NHS cold. A faculty member at your school must nominate yo', '', ' This is an Example Alert! Welome new NHS members! Visit The community Event Tab to see upcoming events and manage those you apply to!', 'This is an Example About Us! Here at NHS we recognize outstanding high school students. More than just an honor roll, NHS serves to recognize those students who have demonstrated excellence in the areas of scholarship, service, leadership, and character. These characteristics have been associated with membership in the organization since its beginning in 1921.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentevent`
--

CREATE TABLE `studentevent` (
  `StudentID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(12) NOT NULL,
  `FirstName` varchar(12) NOT NULL,
  `LastName` varchar(12) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `HoursCompleted` float NOT NULL,
  `VicePresident` varchar(12) NOT NULL,
  `Position` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `Password`, `HoursCompleted`, `VicePresident`, `Position`) VALUES
(123456, 'Sahil', 'Patel', 'email@email.com', 'banana', 2, 'Miloni', 'Admin'),
(654321, 'Ben', 'Wagrez', 'email2@email.com', '', 3.5, 'Nic', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `studentshiftrequests`
--

CREATE TABLE `studentshiftrequests` (
  `EventID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `sitecontent`
--
ALTER TABLE `sitecontent`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `EventID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ShiftID` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
