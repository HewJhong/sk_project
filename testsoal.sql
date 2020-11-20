-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 02:58 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `testsoal`
--

CREATE TABLE `testsoal` (
  `topik` varchar(100) NOT NULL,
  `soal` varchar(500) NOT NULL,
  `pilih` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testsoal`
--

INSERT INTO `testsoal` (`topik`, `soal`, `pilih`) VALUES
('fixed value', '1', '2'),
('fixed value', '2', '1'),
('fixed value', '3', '4'),
('fixed value', '4', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testsoal`
--
ALTER TABLE `testsoal`
  ADD PRIMARY KEY (`soal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
