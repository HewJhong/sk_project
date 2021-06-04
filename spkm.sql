-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 09:36 AM
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
  `NoP` varchar(40) NOT NULL,
  `NoTel` varchar(13) NOT NULL,
  `Peranan` varchar(25) NOT NULL,
  `KataLaluan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`NoP`, `NoTel`, `Peranan`, `KataLaluan`) VALUES
('A01', '019-5533261', 'murid', '123'),
('A02', '019-5522262', 'murid', '123'),
('A03', '019-5533263', 'murid', '123'),
('root', '012-2222222', 'admin', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `perekodan`
--

CREATE TABLE `perekodan` (
  `IdRekod` varchar(50) NOT NULL,
  `Mar` varchar(3) NOT NULL,
  `Gred` varchar(2) NOT NULL,
  `Tar` varchar(20) NOT NULL,
  `NoP` varchar(50) NOT NULL,
  `IdTopik` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perekodan`
--

INSERT INTO `perekodan` (`IdRekod`, `Mar`, `Gred`, `Tar`, `NoP`, `IdTopik`) VALUES
('R001', '0', 'F', '28/05/2021', 'A01', 'T1'),
('R002', '50', 'D', '28/05/2021', 'A01', 'T2'),
('R003', '100', 'A', '28/05/2021', 'A02', 'T1'),
('R004', '100', 'A', '28/05/2021', 'A02', 'T2'),
('R005', '50', 'D', '28/05/2021', 'A03', 'T1');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `IdSoal` varchar(20) NOT NULL,
  `NoSoal` int(3) NOT NULL,
  `Soal` text NOT NULL,
  `Pilih` text NOT NULL,
  `Jaw` varchar(2) NOT NULL,
  `IdTopik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`IdSoal`, `NoSoal`, `Soal`, `Pilih`, `Jaw`, `IdTopik`) VALUES
('S001', 1, '1+1', '1', '0', 'T1'),
('S002', 1, '1+1', '2', '1', 'T1'),
('S003', 1, '1+1', '3', '0', 'T1'),
('S004', 1, '1+1', '4', '0', 'T1'),
('S005', 2, '2+5', '1', '0', 'T1'),
('S006', 2, '2+5', '3', '0', 'T1'),
('S007', 2, '2+5', '5', '0', 'T1'),
('S008', 2, '2+5', '7', '1', 'T1'),
('S009', 3, '1-1', '1', '0', 'T2'),
('S010', 3, '1-1', '2', '0', 'T2'),
('S011', 3, '1-1', '3', '0', 'T2'),
('S012', 3, '1-1', '0', '1', 'T2'),
('S013', 4, '10-1', '9', '1', 'T2'),
('S014', 4, '10-1', '8', '0', 'T2'),
('S015', 4, '10-1', '7', '0', 'T2'),
('S016', 4, '10-1', '6', '0', 'T2');

-- --------------------------------------------------------

--
-- Table structure for table `telefon`
--

CREATE TABLE `telefon` (
  `NoTel` varchar(50) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telefon`
--

INSERT INTO `telefon` (`NoTel`, `Nama`) VALUES
('012-2222222', 'Cikgu Firdaus'),
('019-5522262', 'Sim Sze Yu'),
('019-5533261', 'Teoh Zi Hong'),
('019-5533263', 'Soo Qi Ren');

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `IdTopik` varchar(100) NOT NULL,
  `Topik` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`IdTopik`, `Topik`) VALUES
('T1', 'Tambah'),
('T2', 'Tolak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NoP`,`NoTel`),
  ADD KEY `peranan` (`Peranan`),
  ADD KEY `katalaluan` (`KataLaluan`),
  ADD KEY `pengguna_ibfk_1` (`NoTel`),
  ADD KEY `NoP` (`NoP`);

--
-- Indexes for table `perekodan`
--
ALTER TABLE `perekodan`
  ADD PRIMARY KEY (`IdRekod`),
  ADD KEY `idtopik` (`IdTopik`),
  ADD KEY `nop` (`NoP`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`IdSoal`),
  ADD KEY `idtopik` (`IdTopik`);

--
-- Indexes for table `telefon`
--
ALTER TABLE `telefon`
  ADD PRIMARY KEY (`NoTel`),
  ADD KEY `notel` (`NoTel`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`IdTopik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`NoTel`) REFERENCES `telefon` (`notel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
