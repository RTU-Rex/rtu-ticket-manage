-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 12:04 PM
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
(1, 'heheh', '', '2023-02-22 12:17:42'),
(2, 'ako to', 'nothing more nothing less', '2023-02-22 12:19:31'),
(3, 'test', 'gjgjgj', '2023-02-22 20:35:59'),
(4, 'test', 'gsfgfgdfhdf', '2023-03-02 21:16:56'),
(5, 'test', 'testing', '2023-03-25 17:38:51'),
(6, 'test2', 'tontdsoasod', '2023-04-01 13:37:06');

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
(3, 'OJT', 1),
(5, 'TEsting', 0);

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
(9, 'Offices Under the OVPAA', 'College of Business, Entrepreneurship and Accountancy', '2023-03-25 17:19:12', 2, 2, '2023-04-13 00:16:16'),
(10, 'Offices Under the OP', 'University Board Secretary', '2023-03-25 17:21:06', 2, NULL, NULL),
(11, 'Offices Under the OVPRIES', 'Research and Development Center', '2023-03-25 17:54:02', 2, NULL, NULL),
(12, 'Executive Officials Office', 'Office of the Vice President for Research, Innovation, and Extension Services', '2023-04-13 00:05:27', 2, NULL, NULL),
(13, 'Executive Officials Office', 'Office of the Vice President for Finance and Administration', '2023-04-13 00:06:43', 2, NULL, NULL),
(14, 'Offices Under the OP', 'Chief Executive Assistant', '2023-04-13 00:08:06', 2, NULL, NULL),
(15, 'Offices Under the OP', 'Office of the Legal Affairs', '2023-04-13 00:08:21', 2, NULL, NULL),
(16, 'Offices Under the OP', 'Internal Audit Services Center', '2023-04-13 00:08:34', 2, NULL, NULL),
(17, 'Offices Under the OEVP', 'Office of the Campus Director', '2023-04-13 00:13:18', 2, NULL, NULL),
(18, 'Offices Under the OEVP', 'Management Information Center', '2023-04-13 00:13:46', 2, NULL, NULL),
(19, 'Offices Under the OEVP', 'University Data Protection Center', '2023-04-13 00:13:56', 2, NULL, NULL),
(20, 'Offices Under the OEVP', 'University Center for International Linkages and External Affairs', '2023-04-13 00:14:12', 2, NULL, NULL),
(21, 'Offices Under the OVPPD', 'Quality Management System Center', '2023-04-13 00:14:42', 2, NULL, NULL),
(22, 'Offices Under the OVPPD', 'University Planning Center', '2023-04-13 00:14:50', 2, NULL, NULL),
(23, 'Offices Under the OVPPD', 'Quality Assurance Center', '2023-04-13 00:14:58', 2, NULL, NULL),
(24, 'Offices Under the OVPAA', 'College of Education', '2023-04-13 00:16:57', 2, NULL, NULL),
(25, 'Offices Under the OVPAA', 'College of Engineering and Architecture', '2023-04-13 00:17:03', 2, NULL, NULL),
(26, 'Offices Under the OVPAA', 'Institute of Human Kinetics', '2023-04-13 00:17:14', 2, NULL, NULL),
(27, 'Offices Under the OVPAA', 'College of Graduate Studies', '2023-04-13 00:17:24', 2, NULL, NULL),
(28, 'Offices Under the OVPAA', 'Institute of Flexible Learning and Digital Education', '2023-04-13 00:17:37', 2, NULL, NULL),
(29, 'Offices Under the OVPAA', 'Office of Student Affairs and Services', '2023-04-13 00:17:47', 2, NULL, NULL),
(30, 'Offices Under the OVPAA', 'Center for National Service Training Program', '2023-04-13 00:17:58', 2, NULL, NULL),
(31, 'Offices Under the OVPAA', 'Cooperative Education Center', '2023-04-13 00:18:09', 2, NULL, NULL),
(32, 'Offices Under the OVPAA', 'Evaluation Office', '2023-04-13 00:18:16', 2, NULL, NULL),
(33, 'Offices Under the OVPAA', 'Curriculum and Instructional Resources Development Center', '2023-04-13 00:18:24', 2, NULL, NULL),
(34, 'Offices Under the OVPAA', 'Alumni Relations and Placement Office', '2023-04-13 00:18:34', 2, NULL, NULL),
(35, 'Offices Under the OVPAA', 'University Center for Review and Related Instructions', '2023-04-13 00:18:44', 2, NULL, NULL),
(36, 'Offices Under the OVPAA', 'University Learning Resource Center', '2023-04-13 00:18:51', 2, NULL, NULL),
(37, 'Offices Under the OVPAA', 'Scholarship and Grant Office', '2023-04-13 00:18:59', 2, NULL, NULL),
(38, 'Offices Under the OVPAA', 'Guidance and Counseling Services Center', '2023-04-13 00:19:07', 2, NULL, NULL),
(39, 'Offices Under the OVPAA', 'Center for Student Affairs', '2023-04-13 00:19:14', 2, NULL, NULL),
(40, 'Offices Under the OVPAA', 'Medical and Dental Services Center', '2023-04-13 00:19:21', 2, NULL, NULL),
(41, 'Offices Under the OVPAA', 'Student Records and Admission Center', '2023-04-13 00:19:28', 2, NULL, NULL),
(42, 'Offices Under the OVPAA', 'Sports and Development Wellness Center', '2023-04-13 00:19:34', 2, NULL, NULL),
(43, 'Offices Under the OVPRIES', 'Extension and Community Services Center', '2023-04-13 00:20:08', 2, NULL, NULL),
(44, 'Offices Under the OVPRIES', 'Intellectual Property Management Center', '2023-04-13 00:20:15', 2, NULL, NULL),
(45, 'Offices Under the OVPRIES', 'Gender Studies and Development Center', '2023-04-13 00:20:21', 2, 2, '2023-04-13 00:20:50'),
(46, 'Offices Under the OVPRIES', 'Mushroom and Biotech Research Development Center', '2023-04-13 00:20:29', 2, 2, '2023-04-13 00:21:08'),
(47, 'Offices Under the OVPRIES', 'Urban Agriculture Research and Development Center', '2023-04-13 00:20:38', 2, NULL, NULL),
(48, 'Offices Under the OVPRIES', 'Technology Transfer and Business Development Center', '2023-04-13 00:21:25', 2, NULL, NULL),
(49, 'Offices Under the OVPRIES', 'Center for Astronomy Research and Development', '2023-04-13 00:21:34', 2, NULL, NULL),
(50, 'Offices Under the OVPRIES', 'Center for Data Science and Smart Analytics', '2023-04-13 00:21:44', 2, NULL, NULL),
(51, 'Offices Under the OVPRIES', 'Futures Thinking and Innovation Center', '2023-04-13 00:21:52', 2, NULL, NULL),
(52, 'Offices Under the OVPRIES', 'Center for Natural Sciences and Environment Research', '2023-04-13 00:21:59', 2, NULL, NULL),
(53, 'Offices Under the OVPFA', 'Administrative Services Center', '2023-04-13 00:22:28', 2, NULL, NULL),
(54, 'Offices Under the OVPFA', 'Center for Financial Management Services', '2023-04-13 00:22:46', 2, NULL, NULL),
(55, 'Offices Under the OVPFA', 'Human Resource Development Center', '2023-04-13 00:22:55', 2, NULL, NULL),
(56, 'Offices Under the OVPFA', 'Center for Culture, Arts and Events', '2023-04-13 00:23:05', 2, NULL, NULL),
(57, 'Offices Under the OVPFA', 'Center for Facilities Management Services', '2023-04-13 00:23:20', 2, NULL, NULL),
(58, 'Offices Under the OVPFA', 'Accounting Office', '2023-04-13 00:23:37', 2, NULL, NULL),
(59, 'Offices Under the OVPFA', 'Budget Management Office', '2023-04-13 00:23:45', 2, NULL, NULL),
(60, 'Offices Under the OVPFA', 'Records Management Office', '2023-04-13 00:23:54', 2, NULL, NULL),
(61, 'Offices Under the OVPFA', 'Resource Generation and Auxillary Services', '2023-04-13 00:24:02', 2, NULL, NULL),
(62, 'Offices Under the OVPFA', 'Business Affairs Office', '2023-04-13 00:24:09', 2, NULL, NULL),
(63, 'Offices Under the OVPFA', 'Civil Security Office', '2023-04-13 00:24:16', 2, NULL, NULL),
(64, 'Offices Under the OVPFA', 'Cash and Disbursement Office', '2023-04-13 00:24:23', 2, NULL, NULL),
(65, 'Offices Under the OVPFA', 'Supply and Property Management Office', '2023-04-13 00:24:30', 2, NULL, NULL),
(66, 'Offices Under the OVPFA', 'Janitorial and Grounds Services', '2023-04-13 00:24:38', 2, NULL, NULL),
(67, 'Offices Under the OVPFA', 'Buildings and Facilities Maintenance', '2023-04-13 00:24:46', 2, NULL, NULL),
(68, 'Offices Under the OVPFA', 'Infrastructure Planning and Management Office', '2023-04-13 00:24:54', 2, NULL, NULL),
(69, 'Offices Under the OVPFA', 'Disaster Risk Reduction and Management Office', '2023-04-13 00:25:00', 2, NULL, NULL);

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
(45, 'rzjhambas@rtu.edu.ph', 'Rey Zhandrex Ambas', '2019-302123', 1, 'Tae', 1, '2023-04-12 16:12:52', 2, '2023-04-12 19:41:46', 1, NULL, 'Need installation', NULL),
(46, 'zhandrex24@gmail.com', 'Rey Zhandrex Ambas', '2019-302123', 8, 'hahahaha', 2, '2023-04-12 19:49:41', 2, '2023-04-12 20:11:20', 4, NULL, 'Broken Pc', NULL),
(47, 'asdasdasgasg@gmail.com', 'asdasda', '2019-302123', 5, 'asdasdasd', 1, '2023-04-12 20:07:43', 2, '2023-04-12 20:08:11', 2, NULL, 'asdasdsa', NULL),
(49, 'hahaha@gmail.com', 'Rey Zhandrex Ambas', '2019-302123', 4, 'asdasdas', 1, '2023-04-12 20:35:16', 2, '2023-04-16 14:34:04', 2, NULL, 'Need installation', NULL),
(51, 'zhandrex24@gmail.com', 'Rey Zhandrex Ambas', '2019-302123', 4, 'asdasd', 1, '2023-04-12 22:25:47', 2, '2023-04-13 11:41:06', 4, NULL, 'Need installation', NULL),
(53, 'zhandrex24@gmail.com', 'Teddy', '2019-302123', 1, 'I need treats', 1, '2023-04-13 11:41:46', 2, '2023-04-13 11:42:12', 1, NULL, 'Treats', NULL),
(54, 'hahaha@gmail.com', 'Teddyballs', '2019-302123', 22, 'need food', 1, '2023-04-13 12:15:11', 2, '2023-04-16 14:34:56', 1, NULL, 'kain', NULL),
(56, 'rzjhambas@rtu.edu.ph', 'Rey Zhandrex Ambas', '2019-302123', 1, 'kjbkjhkjhkj', 2, '2023-04-13 14:02:59', 2, '2023-04-13 14:03:48', 2, NULL, 'Need installation', NULL),
(82, 'tonton.norombaba3@gmail.com', 'Rey Zhandrex Ambas', '2019-302123', 1, 'asdasd', 1, '2023-04-16 14:15:27', NULL, NULL, NULL, NULL, 'asdasd', NULL),
(83, 'rzjhambas@rtu.edu.ph', 'Marcial Belleza', 'D-11-12-123', 25, 'Lakas ng tagas', 1, '2023-04-16 17:16:23', 2, '2023-04-16 17:17:40', 1, NULL, 'Butitis', NULL),
(84, 'zhandrex24@gmail.com', 'Leo Batumbakal', 'd-12-32-111', 9, 'Taeng yan', 1, '2023-04-16 17:38:13', 2, '2023-04-16 17:41:33', 2, NULL, 'bafin', NULL);

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
  `recomendDes` varchar(700) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickethistory`
--

INSERT INTO `tbltickethistory` (`id`, `ticketId`, `technicianId`, `ticketStatus`, `ticketMessage`, `dateModified`, `modifiedFrom`, `modifiedBy`, `fileAttach`, `recomend`, `recomendDes`) VALUES
(53, 43, 1, 1, 'Open Ticket assigning technician', '2023-04-10 09:39:44', NULL, 2, '1', 3, 'testing recomendation'),
(54, 43, 1, 3, 'Testing Resolved ticket', '2023-04-10 09:43:03', NULL, 1, '1', 3, 'Testing Resolved'),
(55, 43, 1, 4, 'CLosing', '2023-04-10 15:28:18', NULL, 2, '1', 1, 'Close'),
(56, 44, 1, 1, 'Testing to proceeds', '2023-04-11 12:15:58', NULL, 2, '1', 3, 'Testing recomendation'),
(57, 44, 1, 3, 'Testing Resolved', '2023-04-11 12:44:10', NULL, 1, '1', 2, ''),
(58, 44, 1, 1, 'asdasdasd', '2023-04-12 14:23:28', NULL, 2, '1', 1, ''),
(59, 44, 1, 4, 'asdasdasdsad', '2023-04-12 14:23:41', NULL, 2, '1', 2, ''),
(60, 44, 1, 3, 'asdasdasd', '2023-04-12 14:24:03', NULL, 2, '1', 2, ''),
(61, 44, 1, 3, 'asdasdasd', '2023-04-12 15:40:49', NULL, 2, '1', 1, ''),
(62, 45, 7, 1, 'Your ticket is accepted.', '2023-04-12 16:15:57', NULL, 2, '1', 1, ''),
(63, 45, 7, 3, 'Goods na', '2023-04-12 16:17:16', NULL, 7, '1', 3, 'Goods'),
(64, 45, 7, 4, 'yeyeye', '2023-04-12 16:18:42', NULL, 2, '1', 3, 'Goods na'),
(65, 45, 7, 3, 'Nice one', '2023-04-12 16:19:01', NULL, 2, '1', 3, 'Goods na'),
(66, 45, 7, 3, 'Ginawa ko naman ang lahat', '2023-04-12 19:40:32', NULL, 2, '1', 3, 'Good to go'),
(67, 46, 7, 1, 'Ticket is now in progress', '2023-04-12 20:01:30', NULL, 2, '1', 1, ''),
(68, 47, 7, 1, 'Ako ay may lobo', '2023-04-12 20:08:42', NULL, 2, '1', 1, ''),
(69, 47, 7, 3, 'inayos ko pinasok ko', '2023-04-12 20:09:27', NULL, 7, '1', 3, 'Good job'),
(70, 48, 7, 1, 'kunin mo na', '2023-04-12 20:20:22', NULL, 2, '1', 1, ''),
(71, 44, 1, 4, 'goods', '2023-04-12 20:20:50', NULL, 2, '1', 1, ''),
(72, 48, 1, 1, 'sayo na', '2023-04-12 20:21:43', NULL, 7, '1', 1, ''),
(73, 44, 1, 4, 'gago', '2023-04-12 20:23:30', 'requestor', NULL, '1', NULL, NULL),
(74, 44, 1, 4, 'hahahahaha', '2023-04-12 20:50:57', 'requestor', NULL, '1', NULL, NULL),
(75, 46, 7, 3, 'Technician To dapat maisave message nya sa admin', '2023-04-12 21:18:00', NULL, 7, '1', 3, 'nonono'),
(76, 49, 7, 1, 'Assinged', '2023-04-12 22:04:21', NULL, 2, '1', 1, ''),
(77, 49, 7, 3, 'Installed os', '2023-04-12 22:05:39', NULL, 7, '1', 3, 'Goods'),
(78, 50, 7, 1, 'In progress', '2023-04-12 22:07:47', NULL, 2, '1', 1, ''),
(79, 45, 7, 3, 'asdasdasd', '2023-04-12 22:12:46', 'requestor', NULL, '1', NULL, NULL),
(80, 49, 7, 4, 'closed', '2023-04-12 22:15:35', NULL, 2, '1', 1, ''),
(81, 49, 7, 5, 'your ticket is now open', '2023-04-12 22:18:08', NULL, 2, '1', 1, ''),
(82, 45, 7, 4, 'closed', '2023-04-13 00:38:01', NULL, 2, '1', 1, ''),
(83, 46, 7, 4, 'asdasdas', '2023-04-13 00:38:09', NULL, 2, '1', 1, ''),
(84, 49, 7, 4, 'bouikjb', '2023-04-13 00:38:31', NULL, 2, '1', 1, ''),
(85, 51, 5, 1, 'assigned to jocoy', '2023-04-13 10:17:38', NULL, 2, '1', 1, ''),
(86, 51, 5, 3, 'Printed the colored', '2023-04-13 10:19:10', NULL, 5, '1', 3, 'N/A'),
(87, 51, 5, 3, 'Your ticket is now resolved', '2023-04-13 10:19:49', NULL, 2, '1', 3, 'N/A'),
(88, 51, 5, 4, 'Your ticket is now resolved', '2023-04-13 10:20:10', NULL, 2, '1', 3, 'N/A'),
(89, 51, 5, 5, 'Your ticket is now resolved', '2023-04-13 10:31:14', NULL, 2, '1', 3, 'N/A'),
(90, 51, 5, 1, 'Your ticket is now resolved', '2023-04-13 10:31:38', NULL, 2, '1', 3, 'N/A'),
(91, 51, 5, 4, 'Your ticket is now resolved', '2023-04-13 10:32:10', NULL, 2, '1', 3, 'N/A'),
(92, 51, 5, 5, 'Your ticket is now resolved', '2023-04-13 10:45:10', NULL, 2, '1', 3, 'N/A'),
(93, 47, 7, 3, 'hello', '2023-04-13 10:47:50', NULL, 3, '1', 3, 'Good job'),
(94, 47, 7, 1, 'hahahaha', '2023-04-13 10:48:57', NULL, 3, '1', 3, 'Good job'),
(95, 47, 7, 1, 'gegegege', '2023-04-13 11:03:41', 'requestor', NULL, '1', NULL, NULL),
(96, 51, 5, 1, 'hello', '2023-04-13 11:06:51', NULL, 2, '1', 3, 'N/A'),
(97, 51, 5, 1, 'hi', '2023-04-13 11:07:12', 'requestor', NULL, '1', NULL, NULL),
(98, 45, 7, 5, 'reopen', '2023-04-13 11:39:58', NULL, 2, '1', 1, ''),
(99, 45, 7, 4, 'reopen', '2023-04-13 11:40:29', NULL, 2, '1', 1, ''),
(100, 51, 5, 3, 'hihehe', '2023-04-13 11:43:49', NULL, 5, '1', 3, 'hehehe'),
(101, 53, 5, 1, 'assigned to jocoiy', '2023-04-13 11:55:39', NULL, 2, '1', 1, ''),
(102, 53, 5, 3, 'I gave treats', '2023-04-13 11:56:19', NULL, 5, '1', 3, 'Busog na'),
(103, 53, 5, 4, 'Your ticket is now resolved I will close this now you may contact for reopening of tickets if the problem occured again', '2023-04-13 11:57:20', NULL, 2, '1', 3, 'Busog na'),
(104, 53, 5, 5, 'Your ticket is opened', '2023-04-13 11:57:59', NULL, 2, '1', 3, 'Busog na'),
(105, 53, 3, 2, 'I will escalate the ticket to my co-technician', '2023-04-13 11:59:02', NULL, 5, '1', 3, 'Busog na'),
(106, 53, 3, 3, 'I gave treats', '2023-04-13 12:00:14', NULL, 3, '1', 3, 'Busog na'),
(107, 53, 3, 5, 'I gave treats', '2023-04-13 12:05:21', NULL, 2, '1', 3, 'Busog na'),
(108, 53, 3, 4, 'I gave treats', '2023-04-13 12:05:31', NULL, 2, '1', 3, 'Busog na'),
(109, 53, 3, 5, 'ticket open', '2023-04-13 12:06:02', NULL, 2, '1', 3, 'Busog na'),
(110, 53, 5, 2, 'pass to jokoy', '2023-04-13 12:06:31', NULL, 3, '1', 3, 'Busog na'),
(111, 54, 5, 1, 'sayo na to', '2023-04-13 12:15:47', NULL, 2, '1', 1, ''),
(112, 54, 5, 3, 'resolved', '2023-04-13 12:19:42', NULL, 5, '1', 1, ''),
(113, 55, 5, 1, 'Your ticket is now in progress and assigned to Jocoy', '2023-04-13 13:15:37', NULL, 2, '1', 1, ''),
(114, 55, 5, 3, 'RESET ROUTER', '2023-04-13 13:18:15', NULL, 5, '1', 3, 'GOODS'),
(115, 55, 5, 3, 'Close', '2023-04-13 13:19:27', NULL, 2, '1', 3, 'GOODS'),
(116, 55, 5, 4, 'Close', '2023-04-13 13:19:49', NULL, 2, '1', 3, 'GOODS'),
(117, 55, 5, 3, 'Close', '2023-04-13 13:20:29', NULL, 2, '1', 3, 'GOODS'),
(118, 55, 5, 3, 'Close', '2023-04-13 13:21:41', NULL, 2, '1', 3, 'GOODS'),
(119, 55, 5, 3, 'Close', '2023-04-13 13:22:01', NULL, 2, '1', 3, 'GOODS'),
(120, 55, 5, 3, 'Reset Router', '2023-04-13 13:24:01', NULL, 2, '1', 3, 'GOODS'),
(121, 55, 5, 3, 'nasan na', '2023-04-13 13:42:29', 'requestor', NULL, '1', NULL, NULL),
(122, 56, 5, 1, 'hahahahaha', '2023-04-13 14:04:15', NULL, 2, '1', 1, ''),
(123, 53, 5, 3, 'GOODS NA', '2023-04-13 16:45:30', NULL, 2, '1', 3, 'Goods'),
(124, 53, 5, 3, 'GOODS NA', '2023-04-13 16:46:13', NULL, 2, '1', 3, 'Goods'),
(125, 53, 5, 3, 'GOODS NA', '2023-04-13 16:47:01', NULL, 2, '1', 3, 'Goods'),
(126, 53, 5, 3, 'GOODS NA', '2023-04-13 16:47:31', NULL, 2, '1', 3, 'Goods'),
(127, 53, 5, 3, 'GOODS NA', '2023-04-13 16:59:50', NULL, 2, '1', 3, 'Goods'),
(128, 53, 5, 5, 'GOODS NA', '2023-04-13 17:01:54', NULL, 2, '1', 3, 'Goods'),
(129, 51, NULL, 5, 'hihehe', '2023-04-13 17:12:29', NULL, 2, '1', 3, 'hehehe'),
(130, 49, NULL, 5, 'open again', '2023-04-13 17:15:47', NULL, 2, '1', 1, ''),
(131, 49, 7, 1, 'Assign to you', '2023-04-16 14:36:05', NULL, 2, '1', 1, ''),
(132, 56, 5, 2, 'hahahahaha', '2023-04-16 16:31:36', NULL, 5, '1', 1, ''),
(133, 56, 5, 1, 'hahahahaha', '2023-04-16 16:32:02', NULL, 2, '1', 1, ''),
(134, 45, 7, 4, 'reopen', '2023-04-16 16:38:07', NULL, 2, '1', 1, ''),
(135, 56, 5, 3, 'TAPOS KA NA KAIBIGAN', '2023-04-16 16:46:28', NULL, 5, '1', 3, 'WALA'),
(136, 56, 5, 4, 'TAPOS KA NA KAIBIGAN', '2023-04-16 16:47:04', NULL, 2, '1', 3, 'WALA'),
(137, 46, NULL, 5, 'asdasdas', '2023-04-16 16:52:27', NULL, 2, '1', 1, ''),
(138, 53, 5, 1, 'gagagag', '2023-04-16 16:52:48', NULL, 2, '1', 3, 'Goods'),
(139, 46, NULL, 5, 'asdasdas', '2023-04-16 16:54:00', NULL, 2, '1', 1, ''),
(140, 45, NULL, 5, 'reopen', '2023-04-16 17:03:09', NULL, 2, '1', 1, ''),
(141, 45, 1, 4, 'reopen', '2023-04-16 17:03:38', NULL, 2, '1', 1, ''),
(142, 46, 1, 4, 'asdasdas', '2023-04-16 17:03:43', NULL, 2, '1', 1, ''),
(143, 51, 1, 4, 'hihehe', '2023-04-16 17:03:47', NULL, 2, '1', 3, 'hehehe'),
(144, 54, 5, 4, 'resolved', '2023-04-16 17:03:51', NULL, 2, '1', 1, ''),
(145, 82, 1, 4, 'closed', '2023-04-16 17:04:17', NULL, 2, '1', 1, ''),
(146, 53, 5, 1, 'sana goods pa', '2023-04-16 17:05:01', NULL, 2, '1', 3, 'Goods'),
(147, 49, 7, 4, 'Assign to you', '2023-04-16 17:05:11', NULL, 2, '1', 1, ''),
(148, 55, 5, 3, 'gaga', '2023-04-16 17:06:45', 'requestor', NULL, '1', NULL, NULL),
(149, 53, 5, 1, 'enge', '2023-04-16 17:08:32', 'requestor', NULL, '1', NULL, NULL),
(150, 53, 5, 3, 'gave treats', '2023-04-16 17:08:54', NULL, 2, '1', 3, 'hahaha'),
(151, 53, 5, 4, 'close ko na', '2023-04-16 17:09:59', NULL, 2, '1', 3, 'hahaha'),
(152, 53, NULL, 5, 'open ko ulit', '2023-04-16 17:10:25', NULL, 2, '1', 3, 'hahaha'),
(153, 53, 5, 1, 'Assign ko kay Jocoy', '2023-04-16 17:12:08', NULL, 2, '1', 3, 'hahaha'),
(154, 53, 5, 3, 'Resolved ko na boss', '2023-04-16 17:12:33', NULL, 5, '1', 3, 'bigyan ko ulit treats'),
(155, 53, 5, 4, 'close ko na ulit', '2023-04-16 17:13:15', NULL, 2, '1', 3, 'bigyan ko ulit treats'),
(156, 83, 5, 1, 'pakigawa agad pls', '2023-04-16 17:18:40', NULL, 2, '1', 1, ''),
(157, 83, 5, 3, 'gawa ko na', '2023-04-16 17:23:10', NULL, 5, '1', 1, ''),
(158, 83, 5, 1, 'gogogo', '2023-04-16 17:26:38', NULL, 2, '1', 1, ''),
(159, 83, 5, 3, 'resolve ko ulit', '2023-04-16 17:30:01', NULL, 5, '1', 2, ''),
(160, 83, 5, 4, 'resolve ko ulit', '2023-04-16 17:37:44', NULL, 2, '1', 2, ''),
(161, 84, 5, 1, 'solve mo na', '2023-04-16 17:39:39', NULL, 2, '1', 1, ''),
(162, 84, 5, 1, 'solve mo na', '2023-04-16 17:46:58', NULL, 2, '1', 1, ''),
(163, 84, 5, 2, 'solved', '2023-04-16 17:47:52', NULL, 5, '1', 1, ''),
(164, 84, 5, 1, 'pasa ko sayo', '2023-04-16 17:48:07', NULL, 2, '1', 1, ''),
(165, 84, 5, 3, 'gege tapos ko na', '2023-04-16 17:49:08', NULL, 5, '1', 1, ''),
(166, 84, 5, 4, 'gege tapos ko na', '2023-04-16 18:02:58', NULL, 2, '1', 1, '');

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
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `email`, `password`, `dateCreated`, `createdBy`, `modifiedBy`, `firstName`, `lastName`, `contactNumber`, `accessId`, `isActive`, `dateModified`) VALUES
(1, 'marcialbelleza@gmail.com', '$2y$10$hExqT5/0IPw4OIncf0LBv.wj1IiZgQ3w6ext608HFDccDSCrXrUA.', '2023-02-12 12:52:31', 1, 1, 'Marcial', 'Belleza', '09171828421', 2, 1, '2023-04-01 10:14:59'),
(2, 'rzjhambas@rtu.edu.ph', '$2y$10$5RngMjC9YD8Jg2QVlovuOOryhCp1SH7VU1FbXDbadB3WJJe1HbTZC', '2023-02-22 10:44:44', 1, 2, 'Rex', 'Joseph', '09171828421', 1, 1, '2023-04-13 00:34:50'),
(3, 'rejiekate@gmail.com', '$2y$10$EYgTjXc8F8OHZ/ATRGEuRe8BNWu2RhKecupt8fXC0Ya4um.jJHnLq', '2023-03-25 15:42:40', 2, 2, 'Rejie Kate', 'Regulto', '09171828421', 2, 1, '2023-04-13 11:58:55'),
(4, 'ian@gmail.com', '$2y$10$/0WBqz5snW0XFWxBdnx0gezjrZejrT07uq9JFQ0eYKXL.H8ShQEiG', '2023-03-25 16:26:26', 2, NULL, 'Ian', 'Regulton', '09171828421', 2, 1, NULL),
(5, 'leo@gmail.com', '$2y$10$ioCWJRVhcu2VUrw7p3TVT.f7lW0MExDTB.4uf0Bknj8qu613Dw4UC', '2023-03-25 16:28:31', 2, 2, 'Leo', 'Jocoy', '09171828421', 2, 1, '2023-04-13 10:18:08'),
(6, 'Rafael@gmail.com', '$2y$10$ZQSG6CcHSfTt3SVwWGDoxuZ0fqsOkZ6ZKAOO5OLD3VCVX4N/29N.q', '2023-03-25 17:51:05', 2, NULL, 'Rafeal', 'ewan', '09171828421', 1, 1, NULL),
(7, 'reyzhandrexjosephambas@gmail.com', '$2y$10$6VsDsyVHoOLf/9C5RD.9Luu3E6SD41uV/BNax5uG7tFKZj0LNlp82', '2023-04-12 16:15:11', 2, 7, 'Rey ZhandrexJoseph', 'Ambas', '09050971474', 2, 1, '2023-04-12 23:14:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
-- AUTO_INCREMENT for table `tblticket`
--
ALTER TABLE `tblticket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbltickethistory`
--
ALTER TABLE `tbltickethistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
