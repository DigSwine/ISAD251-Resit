-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: proj-mysql.uopnet.plymouth.ac.uk
-- Generation Time: Aug 20, 2020 at 03:47 PM
-- Server version: 8.0.16
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isad251_mwilsonslider`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Appointment_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Family_ID` int(11) NOT NULL,
  `Appointment_Location` varchar(225) NOT NULL,
  `Appointment_Time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Appointment_Date` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Appointment_Note` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`Appointment_ID`, `Member_ID`, `Family_ID`, `Appointment_Location`, `Appointment_Time`, `Appointment_Date`, `Appointment_Note`) VALUES
(28, 1, 1, 'Dentist', '12:00', '09/08/2020', 'No note has been made'),
(30, 6, 1, 'Doctors', '14:30', '09/08/2020', 'No note has been made'),
(57, 3, 1, 'Doctors', '12:00', '04/08/2020', 'No note has been made'),
(61, 3, 1, 'Doctors', '12:00', '17/09/2020', 'No note has been made');

-- --------------------------------------------------------

--
-- Table structure for table `deadlines`
--

CREATE TABLE `deadlines` (
  `Deadline_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Family_ID` int(11) NOT NULL,
  `Deadline_Name` varchar(225) NOT NULL,
  `Deadline_DueTime` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Deadline_DueDate` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Deadline_Note` varchar(225) NOT NULL,
  `Deadline_Completed` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deadlines`
--

INSERT INTO `deadlines` (`Deadline_ID`, `Member_ID`, `Family_ID`, `Deadline_Name`, `Deadline_DueTime`, `Deadline_DueDate`, `Deadline_Note`, `Deadline_Completed`) VALUES
(1, 3, 1, 'History', '12:00', '20/09/2020', 'No note has been made', 'No'),
(6, 6, 1, 'Art', '13:00', '20/09/2020', 'No note has been made', 'No'),
(8, 3, 1, 'ICT', '10:00', '20/09/2020', 'No note has been made', 'Yes'),
(12, 3, 1, 'Art', '13:00', '20/09/2020', 'No note has been made', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `familys`
--

CREATE TABLE `familys` (
  `Family_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `familys`
--

INSERT INTO `familys` (`Family_ID`, `Member_ID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Member_ID` int(11) NOT NULL,
  `Family_ID` int(11) NOT NULL,
  `Member_Name` varchar(225) NOT NULL,
  `Member_Role` varchar(225) NOT NULL,
  `Member_Username` varchar(225) NOT NULL,
  `Member_Password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Member_ID`, `Family_ID`, `Member_Name`, `Member_Role`, `Member_Username`, `Member_Password`) VALUES
(1, 1, 'Jeff', 'Parent', 'Test', 'Test'),
(2, 2, 'Dylon', 'Parent', 'Testing', 'Testing'),
(3, 1, 'Katrise', 'Child', 'Test1', 'Test1'),
(4, 2, 'Bob', 'Child', 'Testing1', 'Testing1'),
(6, 1, 'Sophie', 'Child', 'Test2', 'Test2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `FK_MembID` (`Member_ID`),
  ADD KEY `FK_FamiID` (`Family_ID`);

--
-- Indexes for table `deadlines`
--
ALTER TABLE `deadlines`
  ADD PRIMARY KEY (`Deadline_ID`),
  ADD KEY `FK_MembeID` (`Member_ID`),
  ADD KEY `FK_FamilID` (`Family_ID`);

--
-- Indexes for table `familys`
--
ALTER TABLE `familys`
  ADD PRIMARY KEY (`Family_ID`,`Member_ID`) USING BTREE;

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Member_ID`) USING BTREE,
  ADD KEY `Family_ID` (`Family_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Appointment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `deadlines`
--
ALTER TABLE `deadlines`
  MODIFY `Deadline_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `familys`
--
ALTER TABLE `familys`
  MODIFY `Family_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Member_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_MembID` FOREIGN KEY (`Member_ID`) REFERENCES `members` (`Member_ID`);

--
-- Constraints for table `deadlines`
--
ALTER TABLE `deadlines`
  ADD CONSTRAINT `FK_MembeID` FOREIGN KEY (`Member_ID`) REFERENCES `members` (`Member_ID`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`Family_ID`) REFERENCES `familys` (`Family_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
