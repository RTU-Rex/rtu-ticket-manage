-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 01:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtu_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbfeedback`
--

CREATE TABLE `tbfeedback` (
  `id` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `feedback` varchar(1000) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbfeedback`
--

INSERT INTO `tbfeedback` (`id`, `name`, `feedback`, `dateCreated`) VALUES
(7, '', 'Good', '2023-04-25 19:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblaccess`
--

CREATE TABLE `tblaccess` (
  `id` int(11) NOT NULL,
  `accessName` varchar(300) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccess`
--

INSERT INTO `tblaccess` (`id`, `accessName`, `isActive`) VALUES
(1, 'Admin', 1),
(2, 'Technician', 1),
(3, 'OJT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblaccessmenu`
--

CREATE TABLE `tblaccessmenu` (
  `id` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `accessId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaccessmenu`
--

INSERT INTO `tblaccessmenu` (`id`, `menuId`, `accessId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 1, 2),
(7, 2, 2),
(9, 6, 2),
(12, 6, 1),
(13, 1, 3),
(14, 2, 3),
(15, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `id` int(11) NOT NULL,
  `Department` varchar(300) NOT NULL,
  `Office` varchar(300) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`id`, `Department`, `Office`, `dateCreated`, `createdBy`, `modifiedBy`, `dateModified`) VALUES
(1, 'Executive Officials Office', 'Office of the President', '2023-02-22 09:27:02', 1, NULL, NULL),
(2, 'Offices Under the OVPAA', 'Institute of Industrial Technology', '2023-02-22 09:27:02', 1, 2, '2023-03-25 17:52:17'),
(3, 'Executive Officials Office', 'Office of the Executive Vice President', '2023-02-23 07:18:51', 1, NULL, NULL),
(4, 'Executive Officials Office', 'Office of the Vice President for Planning and Development', '2023-02-23 07:22:31', 1, NULL, NULL),
(5, 'Executive Officials Office', 'Office of the Vice President for Academic Affairs', '2023-02-23 07:22:31', 1, NULL, NULL),
(6, 'Offices Under the OVPAA', 'Junior High School', '2023-02-23 07:22:31', 1, 2, '2023-03-25 14:20:16'),
(7, 'Offices Under the OVPAA', 'Senior High School', '2023-02-23 07:22:31', 1, NULL, NULL),
(8, 'Offices Under the OVPAA', 'College of Arts and Sciences', '2023-02-23 07:22:31', 1, NULL, NULL),
(9, 'Offices Under the OVPAA', 'High School', '2023-03-25 17:19:12', 2, NULL, NULL),
(10, 'Offices Under the OP', 'University Board Secretary', '2023-03-25 17:21:06', 2, NULL, NULL),
(11, 'Offices Under the OVPRIES', 'Research and Development Center', '2023-03-25 17:54:02', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblforgetpass`
--

CREATE TABLE `tblforgetpass` (
  `id` int(11) NOT NULL,
  `OTPCode` varchar(500) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `isValid` int(11) NOT NULL DEFAULT 1,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblforgetpass`
--

INSERT INTO `tblforgetpass` (`id`, `OTPCode`, `dateCreated`, `isValid`, `userId`) VALUES
(1, '150485', '2023-03-31 23:11:11', 1, 1),
(2, '814089', '2023-04-01 08:48:22', 1, 1),
(3, '702434', '2023-04-01 08:51:55', 1, 1),
(4, '160186', '2023-04-01 08:52:32', 1, 1),
(5, '273209', '2023-04-01 08:53:54', 1, 1),
(6, '519788', '2023-04-01 08:55:30', 1, 1),
(7, '852753', '2023-04-01 08:56:06', 1, 1),
(8, '163548', '2023-04-01 09:45:41', 1, 1),
(9, '242667', '2023-04-01 09:50:55', 1, 1),
(10, '999810', '2023-04-01 09:51:50', 1, 1),
(11, '574858', '2023-04-01 09:53:40', 1, 1),
(12, '679903', '2023-04-01 09:55:59', 1, 1),
(13, '522710', '2023-04-01 09:56:21', 1, 1),
(14, '918841', '2023-04-01 10:02:21', 1, 1),
(15, '690720', '2023-04-01 10:04:18', 1, 1),
(16, '857489', '2023-04-01 10:08:18', 1, 1),
(17, '461769', '2023-04-01 10:09:31', 1, 1),
(18, '731093', '2023-04-01 10:13:35', 1, 1),
(19, '593785', '2023-04-01 10:13:45', 1, 1),
(20, '544520', '2023-04-12 13:55:18', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblincident`
--

CREATE TABLE `tblincident` (
  `id` int(11) NOT NULL,
  `IncidentName` varchar(300) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblincident`
--

INSERT INTO `tblincident` (`id`, `IncidentName`, `isActive`) VALUES
(1, 'Hardware', 1),
(2, 'Software', 1),
(3, 'Network', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenu`
--

CREATE TABLE `tblmenu` (
  `id` int(11) NOT NULL,
  `menuName` varchar(400) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `Child` varchar(400) NOT NULL,
  `URL` varchar(700) NOT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `icon` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmenu`
--

INSERT INTO `tblmenu` (`id`, `menuName`, `isActive`, `Child`, `URL`, `orderBy`, `icon`) VALUES
(1, 'Dashboard', 1, 'Home', 'home.php', NULL, 'fas fa-fw fa-tachometer-alt'),
(2, 'Ticket', 1, 'Home', 'Ticket.php', NULL, 'fas fa-fw fa-solid fa-comment'),
(3, 'Access', 1, 'Administration', 'access.php', NULL, 'fas fa-fw fa-regular fa-address-book'),
(4, 'User', 1, 'Administration', 'user.php', NULL, 'fas fa-fw fa-solid fa-user'),
(5, 'Department', 1, 'Administration', 'Department.php', NULL, 'fas fa-fw fa-solid fa-briefcase'),
(6, 'Report', 1, 'Home', 'report.php', NULL, 'fas fa-fw fa-solid fa-database');

-- --------------------------------------------------------

--
-- Table structure for table `tblpriority`
--

CREATE TABLE `tblpriority` (
  `id` int(11) NOT NULL,
  `priorityName` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `isLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpriority`
--

INSERT INTO `tblpriority` (`id`, `priorityName`, `isActive`, `isLevel`) VALUES
(1, 'Critical', 1, 1),
(2, 'High', 1, 2),
(3, 'Moderate', 1, 3),
(4, 'Low', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblrecomend`
--

CREATE TABLE `tblrecomend` (
  `id` int(11) NOT NULL,
  `Name` varchar(400) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrecomend`
--

INSERT INTO `tblrecomend` (`id`, `Name`, `isActive`) VALUES
(1, 'Parts Replacement', 1),
(2, 'Unserviceable / To Be Surrendered', 1),
(3, 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE `tblstatus` (
  `id` int(11) NOT NULL,
  `statusName` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `isLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstatus`
--

INSERT INTO `tblstatus` (`id`, `statusName`, `isActive`, `isLevel`) VALUES
(1, 'In Progress', 1, 1),
(2, 'On Hold', 1, 2),
(3, 'Resolved', 1, 3),
(4, 'Closed', 1, 4),
(5, 'Open', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbltechshared`
--

CREATE TABLE `tbltechshared` (
  `id` int(11) NOT NULL,
  `ticketId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltechshared`
--

INSERT INTO `tbltechshared` (`id`, `ticketId`, `userId`) VALUES
(14, 52, 1),
(15, 52, 4),
(16, 52, 7),
(19, 51, 1),
(21, 49, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblticket`
--

CREATE TABLE `tblticket` (
  `Id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `empId` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `incident` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `contactType` varchar(100) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `fileAttach` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblticket`
--

INSERT INTO `tblticket` (`Id`, `email`, `name`, `empId`, `department`, `description`, `incident`, `DateCreated`, `modifiedBy`, `dateModified`, `priority`, `contactType`, `title`, `fileAttach`) VALUES
(43, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 2, 'testing all', 1, '2023-04-10 09:37:36', 5, '2023-04-25 11:08:39', 2, NULL, 'life cycle of ticket', NULL),
(44, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 7, 'Testng Message', 2, '2023-04-11 11:51:06', 2, '2023-04-24 20:38:38', 2, NULL, 'Testing Message', NULL),
(45, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 3, 'testing for notification', 1, '2023-04-12 15:57:28', NULL, NULL, NULL, NULL, 'testing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltickethistory`
--

CREATE TABLE `tbltickethistory` (
  `id` int(11) NOT NULL,
  `ticketId` int(11) NOT NULL,
  `technicianId` int(11) DEFAULT NULL,
  `ticketStatus` int(11) DEFAULT NULL,
  `ticketMessage` varchar(1000) DEFAULT NULL,
  `dateModified` datetime NOT NULL DEFAULT current_timestamp(),
  `modifiedFrom` varchar(200) DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `fileAttach` varchar(500) DEFAULT NULL,
  `recomend` int(11) DEFAULT NULL,
  `recomendDes` varchar(700) DEFAULT NULL,
  `property_number` varchar(500) DEFAULT NULL,
  `serial_number` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickethistory`
--

INSERT INTO `tbltickethistory` (`id`, `ticketId`, `technicianId`, `ticketStatus`, `ticketMessage`, `dateModified`, `modifiedFrom`, `modifiedBy`, `fileAttach`, `recomend`, `recomendDes`, `property_number`, `serial_number`) VALUES
(53, 43, 1, 1, 'Open Ticket assigning technician', '2023-04-10 09:39:44', NULL, 2, '1', 3, 'testing recomendation', '', ''),
(54, 43, 1, 3, 'Testing Resolved ticket', '2023-04-10 09:43:03', NULL, 1, '1', 3, 'Testing Resolved', '', ''),
(55, 43, 1, 4, 'CLosing', '2023-04-10 15:28:18', NULL, 2, '1', 1, 'Close', '', ''),
(56, 44, 1, 1, 'Testing to proceeds', '2023-04-11 12:15:58', NULL, 2, '1', 3, 'Testing recomendation', '', ''),
(57, 44, 1, 3, 'Testing Resolved', '2023-04-11 12:44:10', NULL, 1, '1', 2, '', '', ''),
(58, 48, 1, 1, 'Assign to', '2023-04-13 00:52:31', NULL, 2, '1', 1, '', '', ''),
(59, 47, 1, 1, 'Transfer to tonton', '2023-04-13 01:23:25', NULL, 2, '1', 1, '', '', ''),
(60, 48, 1, 3, 'Tontotn ksa testing', '2023-04-13 01:24:47', NULL, 1, '1', 2, '', '', ''),
(61, 47, 1, 3, 'AYUS na', '2023-04-13 01:38:15', NULL, 1, '1', 1, 'TALAGA NAMAN', '', ''),
(62, 49, 3, 1, 'Transfer to tonton', '2023-04-13 10:10:01', NULL, 2, '1', 1, '', '', ''),
(63, 46, 3, 1, 'Transfer to rejiekate', '2023-04-13 10:12:35', NULL, 2, '1', 1, '', '', ''),
(64, 45, 3, 1, 'Transfer to', '2023-04-13 10:14:07', NULL, 2, '1', 1, '', '', ''),
(65, 43, 1, 5, 'CLosing', '2023-04-13 11:25:37', NULL, 2, '1', 1, 'Close', '', ''),
(66, 43, 1, 1, 'Progress ulit', '2023-04-13 12:05:31', NULL, 2, '1', 1, 'Close', '', ''),
(67, 48, 1, 4, 'Tontotn ksa testing', '2023-04-13 12:23:53', NULL, 2, '1', 2, '', '', ''),
(68, 48, 1, 5, 'Tontotn ksa testing', '2023-04-13 12:24:21', NULL, 2, '1', 2, '', '', ''),
(69, 48, 1, 4, 'Tontotn ksa testing', '2023-04-13 12:28:56', NULL, 2, '1', 2, '', '', ''),
(70, 48, 1, 5, 'Tontotn ksa testing', '2023-04-13 12:29:16', NULL, 2, '1', 2, '', '', ''),
(71, 48, 1, 4, 'Tontotn ksa testing', '2023-04-13 12:34:08', NULL, 2, '1', 2, '', '', ''),
(72, 48, NULL, 5, 'Tontotn ksa testing', '2023-04-13 12:34:25', NULL, 2, '1', 2, '', '', ''),
(73, 47, 1, 4, 'AYUS na', '2023-04-24 17:41:32', NULL, 2, '1', 1, 'TALAGA NAMAN', '', ''),
(74, 44, 1, 4, 'Ticket is updated', '2023-04-24 20:38:38', NULL, 2, '1', NULL, NULL, '', ''),
(75, 48, NULL, 5, 'Ticket is updated', '2023-04-24 21:23:46', NULL, 2, '1', 0, '', '', ''),
(76, 48, 1, 1, 'Ticket is updated', '2023-04-24 21:26:08', NULL, 2, '1', 0, '', '', ''),
(77, 48, 1, 3, 'Tontotn ksa testing', '2023-04-24 21:29:09', NULL, 1, '1', 2, '', '', ''),
(78, 43, 1, 3, 'Testing Resolved ticket', '2023-04-24 21:47:53', NULL, 1, '1', 3, 'Testing Resolved', '', ''),
(79, 51, 1, 1, 'Ticket is updated', '2023-04-24 22:45:45', NULL, 2, '1', 0, '', '', ''),
(80, 51, 1, 3, 'This is now resolved', '2023-04-24 22:48:50', NULL, 1, '1', 1, 'tonsky reloved', '2011987', '09171828421'),
(81, 51, 1, 4, 'Ticket is updated', '2023-04-24 22:51:27', NULL, 2, '1', 0, '', '', ''),
(82, 51, NULL, 5, 'Ticket is updated', '2023-04-24 23:09:17', NULL, 2, '1', 0, '', '', ''),
(83, 51, 1, 1, 'Ticket is updated', '2023-04-24 23:11:18', NULL, 2, '1', 0, '', '', ''),
(84, 51, 1, 3, 'This is again resolved', '2023-04-24 23:25:40', NULL, 1, '1', 2, '', '', ''),
(85, 51, 1, 4, 'Ticket is updated', '2023-04-24 23:28:32', NULL, 2, '1', 0, '', '', ''),
(86, 51, 1, 4, 'Ticket is updated', '2023-04-24 23:28:52', NULL, 2, '1', 0, '', '', ''),
(87, 51, NULL, 5, 'Ticket is updated', '2023-04-24 23:29:11', NULL, 2, '1', 0, '', '', ''),
(88, 51, 1, 1, 'Ticket is updated', '2023-04-24 23:29:39', NULL, 2, '1', 0, '', '', ''),
(89, 51, 1, 3, 'Ticket is updated', '2023-04-24 23:30:38', NULL, 1, '1', 3, 'LOLOLOL', '', ''),
(90, 52, 4, 1, 'Ticket is updated', '2023-04-25 09:49:33', NULL, 5, '1', 0, '', '', ''),
(91, 52, 4, 3, 'Your ticket is now done', '2023-04-25 09:52:17', NULL, 4, '1', 3, 'replacement', '', ''),
(92, 52, 4, 4, 'Ticket is updated', '2023-04-25 10:01:14', NULL, 5, '1', 0, '', '', ''),
(93, 52, NULL, 5, 'Ticket is updated', '2023-04-25 10:01:57', NULL, 5, '1', 0, '', '', ''),
(94, 52, 1, 1, 'Pass to Ian', '2023-04-25 10:03:36', NULL, 5, '1', 0, '', '', ''),
(95, 52, 4, 1, 'Ticket is updated', '2023-04-25 10:04:14', NULL, 5, '1', 0, '', '', ''),
(96, 52, 4, 3, 'Your ticket is now resolved', '2023-04-25 10:04:51', NULL, 4, '1', 3, 'None', '4124123', '12312'),
(97, 52, 4, 3, 'tanks', '2023-04-25 10:05:17', 'requestor', NULL, '1', NULL, NULL, NULL, NULL),
(98, 52, 4, 4, 'tanks', '2023-04-25 10:05:27', NULL, 5, '1', 0, '', '', ''),
(99, 50, 4, 1, 'Ticket is updated', '2023-04-25 10:10:40', NULL, 5, '1', 0, '', '', ''),
(100, 50, 4, 3, 'Ticket Resolved with friends', '2023-04-25 10:11:27', NULL, 4, '1', 3, 'none', '', ''),
(101, 51, 1, 3, 'Ticket is updated', '2023-04-25 10:20:13', NULL, 5, '1', 3, 'LOLOLOL', '', ''),
(102, 43, NULL, 5, 'Ticket is updated', '2023-04-25 10:30:20', NULL, 5, '1', 0, '', '', ''),
(103, 51, 4, 1, 'Ticket is updated', '2023-04-25 10:31:02', NULL, 5, '1', 0, '', '', ''),
(104, 43, 4, 1, 'Ticket is updated', '2023-04-25 10:31:15', NULL, 5, '1', 0, '', '', ''),
(105, 51, 4, 3, 'GOOODSSSSSSSSSSSSSSSS', '2023-04-25 10:31:53', NULL, 4, '1', 3, 'none', '', ''),
(106, 43, 4, 1, 'Ticket is updated', '2023-04-25 11:08:39', NULL, 5, '1', 0, '', '', ''),
(107, 48, 1, 3, 'Ticket is updated', '2023-04-25 13:40:23', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(108, 53, 5, 1, 'Ticket is updated', '2023-04-25 13:43:41', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(109, 53, 5, 1, 'Ticket is updated', '2023-04-25 13:43:59', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(110, 50, 4, 3, 'ge', '2023-04-25 13:45:12', 'requestor', NULL, '1', NULL, NULL, NULL, NULL),
(111, 50, 4, 4, 'ge', '2023-04-25 13:46:17', NULL, 5, '1', NULL, 'NULL', 'NULL', 'NULL'),
(112, 48, 1, 3, 'Ticket is updated', '2023-04-25 13:48:52', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(113, 48, 1, 1, 'Ticket is updated', '2023-04-25 13:49:05', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(114, 51, 4, 3, 'Ticket is updated', '2023-04-25 13:50:02', NULL, 5, '1', 0, 'NULL', 'NULL', 'NULL'),
(115, 51, 4, 3, 'gagagaga', '2023-04-25 13:52:23', 'requestor', NULL, '1', NULL, NULL, NULL, NULL),
(116, 51, 4, 4, 'Ticket is updated', '2023-04-25 13:52:42', NULL, 5, '1', 0, '', '', ''),
(117, 49, 5, 1, 'Ticket is updated', '2023-04-25 13:53:08', NULL, 5, '1', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `contactNumber` varchar(50) DEFAULT NULL,
  `accessId` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `dateModified` datetime DEFAULT NULL,
  `isOJT` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `email`, `password`, `dateCreated`, `createdBy`, `modifiedBy`, `firstName`, `lastName`, `contactNumber`, `accessId`, `isActive`, `dateModified`, `isOJT`) VALUES
(3, 'rejiekate@gmail.com', '$2y$10$EYgTjXc8F8OHZ/ATRGEuRe8BNWu2RhKecupt8fXC0Ya4um.jJHnLq', '2023-03-25 15:42:40', 2, 2, 'Rejie', '', '09171828421', 1, 1, '2023-04-24 23:50:22', 0),
(4, 'ian@gmail.com', '$2y$10$/0WBqz5snW0XFWxBdnx0gezjrZejrT07uq9JFQ0eYKXL.H8ShQEiG', '2023-03-25 16:26:26', 2, 2, 'Iantot', '', '09171828421', 2, 1, '2023-04-24 23:57:22', 1),
(5, 'leo@gmail.com', '$2y$10$ioCWJRVhcu2VUrw7p3TVT.f7lW0MExDTB.4uf0Bknj8qu613Dw4UC', '2023-03-25 16:28:31', 2, 5, 'Leo', 'Jocoy', '09171828421', 2, 1, '2023-04-25 13:22:57', 1),
(6, 'rzjhambas@rtu.edu.ph', '$2y$10$ZQSG6CcHSfTt3SVwWGDoxuZ0fqsOkZ6ZKAOO5OLD3VCVX4N/29N.q', '2023-03-25 17:51:05', 2, NULL, 'Zhandrex', 'Ambas', '09171828421', 1, 1, NULL, 0),
(7, 'iphone@gmail.com', '$2y$10$Qf.R2YVZlKmamp2lhup6GOofvfGKmWRxukgt8S9YXqpeLRmozf/kS', '2023-04-24 23:58:24', 2, 5, 'Mark', 'Cruz', '09171828421', 2, 1, '2023-04-25 13:36:26', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbfeedback`
--
ALTER TABLE `tbfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblaccess`
--
ALTER TABLE `tblaccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblaccessmenu`
--
ALTER TABLE `tblaccessmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblforgetpass`
--
ALTER TABLE `tblforgetpass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblincident`
--
ALTER TABLE `tblincident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpriority`
--
ALTER TABLE `tblpriority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrecomend`
--
ALTER TABLE `tblrecomend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstatus`
--
ALTER TABLE `tblstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltechshared`
--
ALTER TABLE `tbltechshared`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblticket`
--
ALTER TABLE `tblticket`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbltickethistory`
--
ALTER TABLE `tbltickethistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbfeedback`
--
ALTER TABLE `tbfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblaccess`
--
ALTER TABLE `tblaccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblaccessmenu`
--
ALTER TABLE `tblaccessmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblforgetpass`
--
ALTER TABLE `tblforgetpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblincident`
--
ALTER TABLE `tblincident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmenu`
--
ALTER TABLE `tblmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblpriority`
--
ALTER TABLE `tblpriority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblrecomend`
--
ALTER TABLE `tblrecomend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblstatus`
--
ALTER TABLE `tblstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbltechshared`
--
ALTER TABLE `tbltechshared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblticket`
--
ALTER TABLE `tblticket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbltickethistory`
--
ALTER TABLE `tbltickethistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
