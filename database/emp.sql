-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 10:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `emp_ID` varchar(6) NOT NULL COMMENT 'ລະຫັດພະນັກງານ',
  `emp_name` varchar(25) NOT NULL COMMENT 'ຊື່ ແລະ ນາມສະກຸນ',
  `dateOfBirth` date NOT NULL COMMENT 'ວັນ ເດືອນ ປີເກີດ',
  `gender` char(1) NOT NULL COMMENT 'ເພດ',
  `address` varchar(255) NOT NULL COMMENT 'ທີ່ຢູ່',
  `language` varchar(255) DEFAULT NULL COMMENT 'ພາສາທີ່ເວົ້າໄດ້',
  `picture` varchar(50) NOT NULL COMMENT 'ຮູບພາບ',
  `incentive` decimal(7,0) DEFAULT NULL COMMENT 'ເງິນອຸດໜູນ',
  `grade` int(3) DEFAULT NULL COMMENT 'ຂັ້ນເງິນເດີນມາຈາກຕາຕະລາງsalary',
  `d_ID` varchar(6) NOT NULL COMMENT 'ລະຫັດພະແນກມາຈາກຕາຕະລາງDept'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
