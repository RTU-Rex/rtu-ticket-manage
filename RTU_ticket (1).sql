-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2023 at 08:56 AM
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
(3, 'OJT', 1);

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
(19, '593785', '2023-04-01 10:13:45', 1, 1);

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
(3, 'Access', 1, 'Administration', 'access.php', NULL, 'fas fa-fw fa-regular fa-address-book'),
(4, 'User', 1, 'Administration', 'user.php', NULL, 'fas fa-fw fa-solid fa-user'),
(5, 'Department', 1, 'Administration', 'Department.php', NULL, 'fas fa-fw fa-solid fa-briefcase'),
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
(26, 'tonton.norombaba@accenture.com', 'Tonton norombaba', '4714', 1, 'testing 10101111 tonton', 1, '2023-02-23 09:12:19', 2, '2023-03-22 20:22:45', 1, NULL, 'testing', NULL),
(27, 'tonton.norombaba@accenture.com', 'Tonton norombaba', '4714', 8, 'dssdgrtertereyty', 3, '2023-02-23 09:14:13', NULL, NULL, 1, NULL, 'testing', NULL),
(28, 'tonton.norombaba@accenture.com', 'Tonton norombaba', '4714', 7, 'kajskjsakffdfdds', 2, '2023-02-23 09:21:46', NULL, NULL, 2, NULL, 'testing', NULL),
(29, 'tonton.norombaba@accenture.com', 'Tonton norombaba', '47145', 8, 'tonton norombaba', 2, '2023-03-02 21:12:00', NULL, '2023-03-22 18:37:27', 3, NULL, 'testing', NULL),
(30, 'rejiekate@gmail.com', 'Tonton norombaba', '47141', 2, 'life cycle of ticket', 1, '2023-03-25 17:38:11', 2, '2023-03-25 17:41:52', 1, NULL, 'life cycle of ticket', NULL),
(31, 'regiekate@gmail.com', 'Regie Kate Regulto', '4567', 1, 'Testing', 2, '2023-03-25 23:34:47', 2, '2023-03-26 02:11:11', 2, NULL, 'Testing', NULL),
(32, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'lefi cycle of ticket', 1, '2023-04-01 11:19:53', 2, '2023-04-04 17:44:07', 2, NULL, 'life cycle of ticket', NULL),
(33, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'life cycle of ticket', 1, '2023-04-01 11:22:44', 2, '2023-04-04 17:32:01', 4, NULL, 'life cycle of ticket', NULL),
(34, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'ldsadasd asfas\ndasdasdasd daskdsadji dnasdjisajdisad sdjasdnsdnw\nsdnsadksaidsandskadnksajiwjewndksadnksa kdsnkskskasdksa', 1, '2023-04-01 11:26:36', 2, '2023-04-04 17:44:23', 3, NULL, 'life cycle of ticket', NULL),
(35, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'asdasdasdasxsds\ndasdasdas\nsadasdasde dnksanksnnack ksndskadnksadiasid\nksdkskadnksandkasdkiwiqiweqwdsadnas\nsadasdasdndkqwekw dksakdjaskdjisadjqwsdsakddjsa\ndsadjsad', 1, '2023-04-01 11:30:27', 2, '2023-04-04 17:44:37', 3, NULL, 'testing', NULL),
(36, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'testingk dnaskd nxksdjkasjdkw', 1, '2023-04-01 13:14:04', 2, '2023-04-04 17:45:17', 2, NULL, 'life cycle of ticket', NULL),
(37, 'tonnorombaba@gmail.com', 'Tonton norombaba', '', 1, 'life cycle ticket', 1, '2023-04-01 13:16:35', 2, '2023-04-04 17:17:04', 1, NULL, 'testing', NULL),
(38, 'tonnorombaba@gmail.com', 'Rejie Kate Regulto', '4714', 1, 'asfasfafafafasafs sdaswer', 1, '2023-04-01 13:18:19', 2, '2023-04-04 17:46:47', 2, NULL, 'asdsadas', NULL),
(39, 'tonnorombaba@gmail.com', 'Tonton norombaba', '4714', 1, 'life cycle', 1, '2023-04-01 13:25:30', NULL, NULL, NULL, NULL, 'life cycle of ticket', NULL),
(40, 'tonnorombaba@gmail.com', 'Rejie Kate Regulto', '4714', 1, 'sdasdsa dnasnd ksdjasdo kcaksjdas. kjaskdiw. sda. ksdjsiajdid sdasjdidnaskdnsa', 1, '2023-04-01 17:51:43', NULL, NULL, NULL, NULL, 'life cycle of ticket', NULL),
(41, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 1, 'dsjfjdsjfs. dfdsfd dfdsf', 2, '2023-04-05 11:18:12', NULL, NULL, NULL, NULL, 'life cycle of ticket', NULL),
(42, 'tonnorombaba@gmail.com', 'Tonton norombaba', '2010-119871', 1, 'dasd dsndjasd ndaksdkas mnxnskjdiw mdnkasd', 1, '2023-04-05 11:31:54', NULL, NULL, NULL, NULL, 'testing', NULL);

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
  `fileAttach` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblTicketHistory`
--

INSERT INTO `tblTicketHistory` (`id`, `ticketId`, `technicianId`, `ticketStatus`, `ticketMessage`, `dateModified`, `modifiedFrom`, `modifiedBy`, `fileAttach`) VALUES
(1, 27, NULL, 1, 'dsadasd', '2023-03-01 00:32:37', 'requestor', NULL, '1'),
(2, 27, NULL, 1, 'dsasdasfdfd', '2023-03-01 00:44:24', 'requestor', NULL, '1'),
(3, 27, 2, 3, 'djsadkhaksjd', '2023-03-01 01:38:06', 'admin', 1, NULL),
(4, 27, NULL, 5, 'fdsgfsagfdagaf', '2023-03-01 01:41:24', 'requestor', NULL, '1'),
(5, 27, 1, 4, 'gjhkjkjkjk', '2023-03-02 21:08:35', 'admin', 2, '1'),
(6, 29, 1, 1, 'any update', '2023-03-02 21:12:25', 'admin', 2, '1'),
(7, 26, 1, 1, 'tesitijdsijdas', '2023-03-22 23:11:39', NULL, 2, '1'),
(8, 26, 1, 5, 'tontonton', '2023-03-22 23:51:30', NULL, 1, '1'),
(9, 26, 1, 1, '', '2023-03-22 23:52:35', NULL, 2, '1'),
(10, 26, 1, 2, '', '2023-03-22 23:53:22', NULL, 1, '1'),
(13, 26, 1, 1, 'transfer to someone', '2023-03-23 11:19:05', NULL, 2, '1'),
(14, 26, 1, 1, 'Any update', '2023-03-23 11:22:41', 'requestor', NULL, '1'),
(15, 28, 1, 1, 'Assignment', '2023-03-25 12:11:32', NULL, 2, '1'),
(16, 27, 1, 5, 'Open naten', '2023-03-25 14:21:27', NULL, 2, '1'),
(17, 27, 1, 4, 'Close ulit naten', '2023-03-25 14:22:44', NULL, 2, '1'),
(18, 30, 1, 1, 'assigning', '2023-03-25 17:43:01', NULL, 2, '1'),
(19, 30, 1, 3, 'Chenme', '2023-03-25 17:44:18', NULL, 1, '1'),
(20, 30, 1, 4, 'Closing the ticket', '2023-03-25 17:46:01', NULL, 2, '1'),
(21, 27, 1, 5, 'try', '2023-03-25 17:56:57', NULL, 2, '1'),
(22, 27, 1, 4, 'close', '2023-03-25 22:15:47', NULL, 2, '1'),
(23, 26, 1, 3, 'tonton', '2023-03-25 22:16:53', NULL, 1, '1'),
(24, 26, 1, 1, 'testing', '2023-03-26 01:52:10', NULL, 2, '1'),
(32, 31, 4, 1, 'testing', '2023-03-26 02:10:51', NULL, 2, '1'),
(33, 26, 1, 5, 'testing', '2023-03-26 02:23:08', NULL, 2, '1'),
(34, 26, 1, 1, '', '2023-03-26 02:24:23', NULL, 2, '1'),
(35, 29, 1, 1, 'testing', '2023-04-01 13:58:18', 'requestor', NULL, '1'),
(36, 26, 1, 3, 'djkasjd djsakdj cjsaidsaidij jkdjkas kjksdjidnncn kdjskdjaskdasnksajskck', '2023-04-01 14:52:37', NULL, 1, '1'),
(37, 29, 1, 3, 'testing', '2023-04-01 14:54:40', NULL, 1, '1'),
(38, 28, 1, 3, 'reskdkas. dasdasf sdasfdgdsg sdasdasdas', '2023-04-01 14:56:55', NULL, 1, '1'),
(39, 39, 1, 1, 'kdsjksa. ksdjksa dksadjiwjdnskadj sdsadsa', '2023-04-01 15:03:12', NULL, 2, '1'),
(40, 38, 1, 1, 'dasdas sdsad sd sdsadewqer sdsaxas', '2023-04-01 15:03:39', NULL, 2, '1'),
(41, 39, 1, 3, 'dasdsa dlkasdiow ksdsksad', '2023-04-01 15:04:23', NULL, 1, '1'),
(42, 38, 1, 3, 'djajsdjks sdjisajdi sdajsdiwi sdjnisdiwqquei', '2023-04-01 17:22:17', NULL, 1, '1'),
(43, 35, 1, 1, 'eqweqw sdassac sasdasd sdasd sdasd', '2023-04-01 17:27:51', NULL, 2, '1'),
(44, 34, 1, 1, 'sdasdsadsa', '2023-04-01 17:28:12', NULL, 2, '1'),
(45, 34, 1, 3, 'dasdsafd ldsalldsoa ksdjaksj dnsakdnkw', '2023-04-01 17:29:00', NULL, 1, '1'),
(46, 35, 1, 3, 'dasd fadf fasfaserq fasxcdffhty vxcdfast', '2023-04-01 17:39:59', NULL, 1, '1'),
(47, 40, 1, 1, 'jskdjasd ksdaksjd. dkaskdjaskd kxsakjdwe ksk kajdsasdw kdjsajdwqn ksdksajdwq', '2023-04-01 17:52:52', NULL, 2, '1'),
(48, 40, 3, 3, 'dsaasd ndasdowoq  sn ksdjasw dksajdjqwjiwdsak. sammamakxi dkasdjiwqnsdksadw kskskiwkskks', '2023-04-01 17:54:10', NULL, 1, '1'),
(50, 36, 1, 1, 'tontonto. sdksadk sdasder sdasasew', '2023-04-04 17:15:57', NULL, 2, '1'),
(51, 33, 4, 1, 'Tontont ksajdkaso cnns kakkaw. ksdas skska an', '2023-04-04 17:39:06', NULL, 2, '1');

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
(2, 'tonton.norombaba3@gmail.com', '$2y$10$EYgTjXc8F8OHZ/ATRGEuRe8BNWu2RhKecupt8fXC0Ya4um.jJHnLq', '2023-02-22 10:44:44', 1, 2, 'Tonton', 'Norombaba', '09171828421', 1, 1, '2023-03-25 17:50:23'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblIncident`
--
ALTER TABLE `tblIncident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblMenu`
--
ALTER TABLE `tblMenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblPriority`
--
ALTER TABLE `tblPriority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblStatus`
--
ALTER TABLE `tblStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblTicket`
--
ALTER TABLE `tblTicket`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tblTicketHistory`
--
ALTER TABLE `tblTicketHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
