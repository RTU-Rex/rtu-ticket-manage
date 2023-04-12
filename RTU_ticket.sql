-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2023 at 08:12 AM
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
-- Database: `RTU_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbFeedback`
--

CREATE TABLE `tbFeedback` (
  `id` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `feedback` varchar(1000) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbFeedback`
--

INSERT INTO `tbFeedback` (`id`, `name`, `feedback`, `dateCreated`) VALUES
(1, 'Tonton norombaba', '', '2023-02-22 12:17:42'),
(2, 'Tonton norombaba', 'nothing more nothing less', '2023-02-22 12:19:31'),
(3, 'Tonton norombaba', 'gjgjgj', '2023-02-22 20:35:59'),
(4, 'Tonton norombaba', 'gsfgfgdfhdf', '2023-03-02 21:16:56'),
(5, 'Tonton norombaba', 'testing', '2023-03-25 17:38:51'),
(6, 'Tonton norombaba', 'tontdsoasod', '2023-04-01 13:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblAccess`
--

CREATE TABLE `tblAccess` (
  `id` int(11) NOT NULL,
  `accessName` varchar(300) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblAccess`
--

INSERT INTO `tblAccess` (`id`, `accessName`, `isActive`) VALUES
(1, 'Admin', 1),
(2, 'Technician', 1),
(3, 'OJT', 1),
(5, 'TEsting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblAccessMenu`
--

CREATE TABLE `tblAccessMenu` (
  `id` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `accessId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblAccessMenu`
--

INSERT INTO `tblAccessMenu` (`id`, `menuId`, `accessId`) VALUES
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
-- Table structure for table `tblDepartment`
--

CREATE TABLE `tblDepartment` (
  `id` int(11) NOT NULL,
  `Department` varchar(300) NOT NULL,
  `Office` varchar(300) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblDepartment`
--

INSERT INTO `tblDepartment` (`id`, `Department`, `Office`, `dateCreated`, `createdBy`, `modifiedBy`, `dateModified`) VALUES
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
-- Table structure for table `tblForgetPass`
--

CREATE TABLE `tblForgetPass` (
  `id` int(11) NOT NULL,
  `OTPCode` varchar(500) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `isValid` int(11) NOT NULL DEFAULT 1,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblForgetPass`
--

INSERT INTO `tblForgetPass` (`id`, `OTPCode`, `dateCreated`, `isValid`, `userId`) VALUES
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
-- Table structure for table `tblIncident`
--

CREATE TABLE `tblIncident` (
  `id` int(11) NOT NULL,
  `IncidentName` varchar(300) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblIncident`
--

INSERT INTO `tblIncident` (`id`, `IncidentName`, `isActive`) VALUES
(1, 'Hardware', 1),
(2, 'Software', 1),
(3, 'Netwrok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblMenu`
--

CREATE TABLE `tblMenu` (
  `id` int(11) NOT NULL,
  `menuName` varchar(400) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `Child` varchar(400) NOT NULL,
  `URL` varchar(700) NOT NULL,
  `orderBy` int(11) DEFAULT NULL,
  `icon` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblMenu`
--

INSERT INTO `tblMenu` (`id`, `menuName`, `isActive`, `Child`, `URL`, `orderBy`, `icon`) VALUES
(1, 'Dashboard', 1, 'Home', 'home.php', NULL, 'fas fa-fw fa-tachometer-alt'),
(2, 'Ticket', 1, 'Home', 'Ticket.php', NULL, 'fas fa-fw fa-solid fa-comment'),
(3, 'Access', 1, 'Adminatration', 'access.php', NULL, 'fas fa-fw fa-regular fa-address-book'),
(4, 'User', 1, 'Adminatration', 'user.php', NULL, 'fas fa-fw fa-solid fa-user'),
(5, 'Department', 1, 'Adminatration', 'Department.php', NULL, 'fas fa-fw fa-solid fa-briefcase'),
(6, 'Report', 1, 'Home', 'report.php', NULL, 'fas fa-fw fa-solid fa-database');

-- --------------------------------------------------------

--
-- Table structure for table `tblPriority`
--

CREATE TABLE `tblPriority` (
  `id` int(11) NOT NULL,
  `priorityName` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `isLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblPriority`
--

INSERT INTO `tblPriority` (`id`, `priorityName`, `isActive`, `isLevel`) VALUES
(1, 'Critical', 1, 1),
(2, 'High', 1, 2),
(3, 'Moderate', 1, 3),
(4, 'Low', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblRecomend`
--

CREATE TABLE `tblRecomend` (
  `id` int(11) NOT NULL,
  `Name` varchar(400) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblRecomend`
--

INSERT INTO `tblRecomend` (`id`, `Name`, `isActive`) VALUES
(1, 'Parts Replacement', 1),
(2, 'Unserviceable / To Be Surrendered', 1),
(3, 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblStatus`
--

CREATE TABLE `tblStatus` (
  `id` int(11) NOT NULL,
  `statusName` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1,
  `isLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblStatus`
--

INSERT INTO `tblStatus` (`id`, `statusName`, `isActive`, `isLevel`) VALUES
(1, 'In Progress', 1, 1),
(2, 'On Hold', 1, 2),
(3, 'Resolved', 1, 3),
(4, 'Closed', 1, 4),
(5, 'Open', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblTicket`
--

CREATE TABLE `tblTicket` (
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
-- Dumping data for table `tblTicket`
--

INSERT INTO `tblTicket` (`Id`, `email`, `name`, `empId`, `department`, `description`, `incident`, `DateCreated`, `modifiedBy`, `dateModified`, `priority`, `contactType`, `title`, `fileAttach`) VALUES
(43, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 2, 'testing all', 1, '2023-04-10 09:37:36', NULL, NULL, NULL, NULL, 'life cycle of ticket', NULL),
(44, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 7, 'Testng Message', 2, '2023-04-11 11:51:06', NULL, NULL, NULL, NULL, 'Testing Message', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblTicketHistory`
--

CREATE TABLE `tblTicketHistory` (
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
-- Dumping data for table `tblTicketHistory`
--

INSERT INTO `tblTicketHistory` (`id`, `ticketId`, `technicianId`, `ticketStatus`, `ticketMessage`, `dateModified`, `modifiedFrom`, `modifiedBy`, `fileAttach`, `recomend`, `recomendDes`) VALUES
(53, 43, 1, 1, 'Open Ticket assigning technician', '2023-04-10 09:39:44', NULL, 2, '1', 3, 'testing recomendation'),
(54, 43, 1, 3, 'Testing Resolved ticket', '2023-04-10 09:43:03', NULL, 1, '1', 3, 'Testing Resolved'),
(55, 43, 1, 4, 'CLosing', '2023-04-10 15:28:18', NULL, 2, '1', 1, 'Close'),
(56, 44, 1, 1, 'Testing to proceeds', '2023-04-11 12:15:58', NULL, 2, '1', 3, 'Testing recomendation'),
(57, 44, 1, 3, 'Testing Resolved', '2023-04-11 12:44:10', NULL, 1, '1', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
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
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`id`, `email`, `password`, `dateCreated`, `createdBy`, `modifiedBy`, `firstName`, `lastName`, `contactNumber`, `accessId`, `isActive`, `dateModified`) VALUES
(1, 'tonnorombaba@gmail.com', '$2y$10$hExqT5/0IPw4OIncf0LBv.wj1IiZgQ3w6ext608HFDccDSCrXrUA.', '2023-02-12 12:52:31', 1, 1, 'Tonton', 'Norombaba', '09171828421', 2, 1, '2023-04-01 10:14:59'),
(2, 'tonton.norombaba3@gmail.com', '$2y$10$J2Zna1rCATwe1CqNVO206uyjw.IWaadDOMegLfJZip2Vu9Scgic8e', '2023-02-22 10:44:44', 1, 2, 'Tonton', 'Norombaba', '09171828421', 1, 1, '2023-04-11 11:17:25'),
(3, 'rejiekate@gmail.com', '$2y$10$EYgTjXc8F8OHZ/ATRGEuRe8BNWu2RhKecupt8fXC0Ya4um.jJHnLq', '2023-03-25 15:42:40', 2, NULL, 'Rejie Kate', 'Regulto', '09171828421', 3, 1, NULL),
(4, 'ian@gmail.com', '$2y$10$/0WBqz5snW0XFWxBdnx0gezjrZejrT07uq9JFQ0eYKXL.H8ShQEiG', '2023-03-25 16:26:26', 2, NULL, 'Ian', 'Regulton', '09171828421', 2, 1, NULL),
(5, 'leo@gmail.com', '$2y$10$ioCWJRVhcu2VUrw7p3TVT.f7lW0MExDTB.4uf0Bknj8qu613Dw4UC', '2023-03-25 16:28:31', 2, NULL, 'Leo', 'Jocoy', '09171828421', 1, 1, NULL),
(6, 'Rafael@gmail.com', '$2y$10$ZQSG6CcHSfTt3SVwWGDoxuZ0fqsOkZ6ZKAOO5OLD3VCVX4N/29N.q', '2023-03-25 17:51:05', 2, NULL, 'Rafeal', 'ewan', '09171828421', 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbFeedback`
--
ALTER TABLE `tbFeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblAccess`
--
ALTER TABLE `tblAccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblAccessMenu`
--
ALTER TABLE `tblAccessMenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblDepartment`
--
ALTER TABLE `tblDepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblForgetPass`
--
ALTER TABLE `tblForgetPass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblIncident`
--
ALTER TABLE `tblIncident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblMenu`
--
ALTER TABLE `tblMenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblPriority`
--
ALTER TABLE `tblPriority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblRecomend`
--
ALTER TABLE `tblRecomend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblStatus`
--
ALTER TABLE `tblStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblTicket`
--
ALTER TABLE `tblTicket`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblTicketHistory`
--
ALTER TABLE `tblTicketHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbFeedback`
--
ALTER TABLE `tbFeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblAccess`
--
ALTER TABLE `tblAccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblAccessMenu`
--
ALTER TABLE `tblAccessMenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblDepartment`
--
ALTER TABLE `tblDepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblForgetPass`
--
ALTER TABLE `tblForgetPass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblIncident`
--
ALTER TABLE `tblIncident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblMenu`
--
ALTER TABLE `tblMenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblPriority`
--
ALTER TABLE `tblPriority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblRecomend`
--
ALTER TABLE `tblRecomend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblStatus`
--
ALTER TABLE `tblStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblTicket`
--
ALTER TABLE `tblTicket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblTicketHistory`
--
ALTER TABLE `tblTicketHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
