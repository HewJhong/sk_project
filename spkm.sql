-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 04:32 AM
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
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nop` varchar(100) NOT NULL,
  `notel` varchar(50) NOT NULL,
  `peranan` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nop`, `notel`, `peranan`, `password`) VALUES
('adf', '013-1234123', 'murid', 'test'),
('ok', '013-9999999', 'murid', 'test'),
('root', '012-2222222', 'admin', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `idsoal` varchar(50) NOT NULL,
  `nosoal` int(10) NOT NULL,
  `soal` varchar(100) NOT NULL,
  `idpilih` varchar(50) NOT NULL,
  `jaw` int(11) NOT NULL,
  `pilih` int(11) NOT NULL,
  `idtopik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `telefon`
--

CREATE TABLE `telefon` (
  `notel` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telefon`
--

INSERT INTO `telefon` (`notel`, `nama`) VALUES
('012-2222222', 'Cikgu'),
('013-1234123', 'adf'),
('013-9999999', 'ok');

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
('S1', 0, '5+3', '5', '0', 'T3'),
('S2', 0, '5+3', '6', '0', 'T3'),
('S3', 0, '5+3', '7', '0', 'T3'),
('S4', 0, '5+3', '8', '1', 'T3'),
('S5', 1, '4+7', '10', '0', 'T3'),
('S6', 1, '4+7', '9', '0', 'T3'),
('S7', 1, '4+7', '8', '0', 'T3'),
('S8', 1, '4+7', '11', '1', 'T3');

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `idtopik` varchar(100) NOT NULL,
  `topik` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`idtopik`, `topik`) VALUES
('T1', 'tambah'),
('T2', 'tolak'),
('T3', 'Haiya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nop`,`notel`),
  ADD KEY `notel` (`notel`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`idsoal`,`idpilih`);

--
-- Indexes for table `telefon`
--
ALTER TABLE `telefon`
  ADD PRIMARY KEY (`notel`),
  ADD KEY `notel` (`notel`);

--
-- Indexes for table `testsoal`
--
ALTER TABLE `testsoal`
  ADD PRIMARY KEY (`idsoal`),
  ADD KEY `idtopik` (`idtopik`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`idtopik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`notel`) REFERENCES `telefon` (`notel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testsoal`
--
ALTER TABLE `testsoal`
  ADD CONSTRAINT `testsoal_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
