-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 02:44 PM
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
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `d_ID` varchar(6) NOT NULL,
  `name` varchar(25) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `incentive` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`d_ID`, `name`, `loc`, `incentive`) VALUES
('001', 'ກວດສອບ', 'ຫາກະຊິຮູ້', '500000'),
('002', 'ຊັດມ້ຽນ', '່ຕັ່ງຢູ່ບ້ານ ຈອມທອງ', '200000');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `emp_ID` varchar(6) NOT NULL COMMENT 'ລະຫັດພະນັກງານ',
  `emp_name` varchar(25) NOT NULL COMMENT 'ຊື່ ແລະ ນາມສະກຸນ',
  `dateOfBirth` date NOT NULL COMMENT 'ວັນ ເດືອນ ປີເກີດ',
  `gender` char(4) NOT NULL COMMENT 'ເພດ',
  `address` varchar(255) NOT NULL COMMENT 'ທີ່ຢູ່',
  `language` varchar(255) DEFAULT NULL COMMENT 'ພາສາທີ່ເວົ້າໄດ້',
  `picture` varchar(50) NOT NULL COMMENT 'ຮູບພາບ',
  `incentive` decimal(10,0) DEFAULT NULL COMMENT 'ເງິນອຸດໜູນ',
  `grade` varchar(3) DEFAULT NULL COMMENT 'ຂັ້ນເງິນເດີນມາຈາກຕາຕະລາງsalary',
  `d_ID` varchar(6) NOT NULL COMMENT 'ລະຫັດພະແນກມາຈາກຕາຕະລາງDept'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`emp_ID`, `emp_name`, `dateOfBirth`, `gender`, `address`, `language`, `picture`, `incentive`, `grade`, `d_ID`) VALUES
('A001', 'ທ.ກ', '1998-02-27', 'ຊາຍ', 'ທ່າແຂກ', 'ອັງກິດ,ຈີນ,ຫວຽດ,ຝຣັ່ງ', '1672216318001.jpg', '200000', '2', '001'),
('A002', 'ຊື່ຫຍັງ', '2023-01-18', 'ຍິງ', 'thakhek', 'ອັງກິດ,ຝຣັ່ງ', '1673255075', '100000', '1', '002');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `grade` varchar(3) NOT NULL,
  `salary` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`grade`, `salary`) VALUES
('1', '12000000'),
('2', '10000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `name`, `tel`, `username`, `password`) VALUES
(1, 'ທ. ຄຳຕາ ພັນທາບຸນ', '2094244077', 'tar', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'ທ. ຄຳຕາ ພັນທາບຸນ', '2094244077', 'kham', '202cb962ac59075b964b07152d234b70'),
(5, 'ທ. ຄຳຕາ ພັນທາບຸນ', '2094244077', 'kham1', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'ທ. ຄຳຕາ ພັນທາບຸນ', '2094244077', 'kham11', 'b59c67bf196a4758191e42f76670ceba'),
(7, 'ທ. ຄຳຕາ ພັນທາບຸນ', '2094244077', 'kham111', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`d_ID`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_ID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`grade`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
