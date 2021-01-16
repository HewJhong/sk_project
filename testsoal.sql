-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 08:30 AM
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
  `idsoal` varchar(20) NOT NULL,
  `nosoal` int(20) NOT NULL,
  `soal` text NOT NULL,
  `pilih` text NOT NULL,
  `jaw` varchar(10) NOT NULL,
  `idtopik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testsoal`
--

INSERT INTO `testsoal` (`idsoal`, `nosoal`, `soal`, `pilih`, `jaw`, `idtopik`) VALUES
('S001', 1, 's1', '1', '1', 'T1'),
('S002', 1, 's1', '2', '0', 'T1'),
('S003', 1, 's1', '3', '0', 'T1'),
('S004', 1, 's1', '4', '0', 'T1'),
('S005', 2, 's2', '1', '0', 'T1'),
('S006', 2, 's2', '2', '1', 'T1'),
('S007', 2, 's2', '3', '0', 'T1'),
('S008', 2, 's2', '4', '0', 'T1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testsoal`
--
ALTER TABLE `testsoal`
  ADD PRIMARY KEY (`idsoal`),
  ADD KEY `idtopik` (`idtopik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `testsoal`
--
ALTER TABLE `testsoal`
  ADD CONSTRAINT `testsoal_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
