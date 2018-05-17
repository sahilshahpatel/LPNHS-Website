-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 07:18 PM
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
  `Shifts` int(32) NOT NULL,
  `ReleaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `Description`, `StartDate`, `EndDate`, `Location`, `Shifts`, `ReleaseDate`) VALUES
(2, 'Sample Event 1', 'An example event', '2018-05-09', '2018-05-09', '600 Medinah Rd, Roselle, IL', 1, '2018-01-15'),
(3, 'Sample Event 2', 'Another example event', '2018-05-08', '2018-05-08', '500 W Bryn Mawr Ave, Roselle, IL', 1, '2018-02-10'),
(4, 'Sample Event 3', 'Another example event', '2018-02-16', '2018-02-16', '123 Example St, Bloomingdale, IL', 1, '2018-02-14'),
(5, 'Sample Event 4', 'Another example event', '2018-03-31', '2018-03-31', '321 Another Rd, Medinah, IL', 1, '2018-03-19');

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
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `passrecovertokens`
--

CREATE TABLE `passrecovertokens` (
  `Token` varchar(32) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `Expiration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL,
  `StudentID` int(12) DEFAULT NULL,
  `HoursConfirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionID`, `ShiftID`, `StudentID`, `HoursConfirmed`) VALUES
(3, 2, 654321, 1),
(4, 2, 123456, 0),
(5, 3, 123456, 0),
(6, 3, 654321, 0),
(7, 4, NULL, 0),
(8, 5, NULL, 0),
(9, 5, NULL, 0),
(10, 5, NULL, 0),
(11, 5, NULL, 0),
(12, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shiftcovers`
--

CREATE TABLE `shiftcovers` (
  `RequesterID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `CovererID` int(11) NOT NULL,
  `Agreed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `ShiftID` int(12) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `PositionsAvailable` int(12) NOT NULL,
  `EventID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`ShiftID`, `Date`, `StartTime`, `EndTime`, `PositionsAvailable`, `EventID`) VALUES
(2, '2018-01-27', '05:00:00', '06:30:00', 0, 2),
(3, '2018-02-14', '04:00:00', '05:00:00', 0, 3),
(4, '2018-02-16', '01:00:00', '02:00:00', 1, 4),
(5, '2018-03-31', '12:00:00', '14:00:00', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sitecontent`
--

CREATE TABLE `sitecontent` (
  `whatItTakes` varchar(1024) NOT NULL,
  `whatItTakes2` varchar(1024) NOT NULL,
  `appReqs` varchar(1024) NOT NULL,
  `attention` varchar(512) NOT NULL,
  `aboutUs` varchar(512) NOT NULL,
  `ID` int(11) NOT NULL,
  `frontImgCaption` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitecontent`
--

INSERT INTO `sitecontent` (`whatItTakes`, `whatItTakes2`, `appReqs`, `attention`, `aboutUs`, `ID`, `frontImgCaption`) VALUES
('NHS seeks out students who have a dedication to serving their community. \r\nCharacter is another category NHS pays attention to regarding candidates. A student with high character adheres to high standards of honesty, is courteous to others, and has a clean disciplinary record. Avoid people and situations where you might get in trouble. Things like recreational drug use and underage drinking look bad on an NHS application.\r\nYou cannot simply apply to NHS cold. A faculty member at your school must nominate yo', '', '', 'This is an Example Alert! Welome new NHS members! Visit The community Event Tab to see upcoming events and manage those you apply to!', 'This is an Example About Us! Here at NHS we recognize outstanding high school students. More than just an honor roll, NHS serves to recognize those students who have demonstrated excellence in the areas of scholarship, service, leadership, and character. These characteristics have been associated with membership in the organization since its beginning in 1921.', 1, 'Promoting appropriate recognition of students who reflect outstanding accomplishments in the areas of scholarship, leadership, character, and service.');

-- --------------------------------------------------------

--
-- Table structure for table `studentevent`
--

CREATE TABLE `studentevent` (
  `StudentID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentevent`
--

INSERT INTO `studentevent` (`StudentID`, `EventID`) VALUES
(654321, 2),
(123456, 3),
(0, 2),
(654321, 3);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(12) NOT NULL,
  `FirstName` varchar(12) NOT NULL,
  `LastName` varchar(12) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `HoursCompleted` float NOT NULL DEFAULT '0',
  `VicePresident` int(12) NOT NULL,
  `Position` varchar(16) NOT NULL DEFAULT 'Student',
  `Activated` tinyint(1) NOT NULL DEFAULT '0',
  `RecoveryQuestion` varchar(128) NOT NULL,
  `RecoveryAnswer` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `PasswordHash`, `HoursCompleted`, `VicePresident`, `Position`, `Activated`, `RecoveryQuestion`, `RecoveryAnswer`) VALUES
(0, 'James', 'Craig', 'jamcraig@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 0, 111111, 'Student', 0, '', ''),
(111111, 'Miloni', 'Shah', 'milshah@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 0, 111111, 'Vice President', 0, '', ''),
(123456, 'Sahil', 'Patel', 'sahpatel@students.lphs.org', '$2y$10$ZKOqPei2OfRec3wkhicjGuvxkF/ENL.9n4gZ0Y.j9RMvLURh00bCW', 6.5, 111111, 'Admin', 1, 'What is your mother\'s maiden name?', 'Shah'),
(186573, 'Tejas', 'Hullur', 'tejhullur@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 25, 111111, 'President', 0, '', ''),
(194567, 'John', 'Smith', 'johsmith@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 0, 111111, 'Student', 0, '', ''),
(196752, 'Jane', 'Doe', 'jandoe@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 0, 222222, 'Student', 0, '', ''),
(222222, 'Nic', 'Conry', 'nicconry@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 0, 222222, 'Vice President', 0, '', ''),
(654321, 'Ben', 'Wagrez', 'benwagrez@students.lphs.org', '$2y$10$3ngEZpbmj3bGILwUJUp.ouorOgXySkBBWVlMWSQF1S8K/MSYGlH5C', 3.5, 222222, 'Student', 0, '', '');

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
-- Dumping data for table `studentshiftrequests`
--

INSERT INTO `studentshiftrequests` (`EventID`, `StudentID`, `ShiftID`) VALUES
(5, 123456, 5),
(2, 123456, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `passrecovertokens`
--
ALTER TABLE `passrecovertokens`
  ADD PRIMARY KEY (`Token`);

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
  MODIFY `EventID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ShiftID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
