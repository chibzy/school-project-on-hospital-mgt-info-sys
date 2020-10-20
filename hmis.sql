-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2017 at 04:11 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sn` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sn`, `username`, `psw`) VALUES
(1, 'info@hmis.edu', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `illness_history`
--

CREATE TABLE `illness_history` (
  `sn` int(10) NOT NULL,
  `date` varchar(15) NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL,
  `patient_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `illness_history`
--

INSERT INTO `illness_history` (`sn`, `date`, `diagnosis`, `treatment`, `patient_id`) VALUES
(2, '02/16/2017', 'typhoid', 'amoxcin', '12');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `sn` int(20) NOT NULL,
  `name` text NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `patient_type` varchar(20) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `rdate` varchar(15) NOT NULL,
  `passport` text NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`sn`, `name`, `dob`, `gender`, `patient_type`, `patient_id`, `rdate`, `passport`, `phone`) VALUES
(1, 'Ede chinonye', '12/3/1996', 'Male', 'Out patient', '12', '02/16/2017', 'pics/12.jpg', '0808753894');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `illness_history`
--
ALTER TABLE `illness_history`
  ADD KEY `sn` (`sn`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD KEY `sn` (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `illness_history`
--
ALTER TABLE `illness_history`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
