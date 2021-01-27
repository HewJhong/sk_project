-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 04:09 AM
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
-- Table structure for table `perekodan`
--

CREATE TABLE `perekodan` (
  `idrekod` varchar(50) NOT NULL,
  `mar` varchar(50) NOT NULL,
  `gred` varchar(50) NOT NULL,
  `tar` varchar(50) NOT NULL,
  `nop` varchar(50) NOT NULL,
  `idtopik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perekodan`
--

INSERT INTO `perekodan` (`idrekod`, `mar`, `gred`, `tar`, `nop`, `idtopik`) VALUES
('R001', '100', 'A', '17/01/2021', 'adf', 'T1'),
('R002', '100', 'A', '17/01/2021', 'adf', 'T6'),
('R003', '100', 'A', '17/01/2021', 'ok', 'T1'),
('R004', '100', 'A', '18/01/2021', 'adf', 'T7');

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `idsoal` varchar(20) NOT NULL,
  `nosoal` int(20) NOT NULL,
  `soal` text NOT NULL,
  `pilih` text NOT NULL,
  `jaw` varchar(10) NOT NULL,
  `idtopik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`idsoal`, `nosoal`, `soal`, `pilih`, `jaw`, `idtopik`) VALUES
('S001', 1, '1+0=', '1', '1', 'T1'),
('S002', 1, '1+0=', '3', '0', 'T1'),
('S003', 1, '1+0=', '5', '0', 'T1'),
('S004', 1, '1+0=', '7', '0', 'T1'),
('S005', 2, '1+1=', '1', '0', 'T1'),
('S006', 2, '1+1=', '4', '0', 'T1'),
('S007', 2, '1+1=', '6', '0', 'T1'),
('S008', 2, '1+1=', '2', '1', 'T1'),
('S009', 3, 'Berikut merupakan arah mata angin utama kecuali:', 'Utara', '0', 'T6'),
('S010', 3, 'Berikut merupakan arah mata angin utama kecuali:', 'Selatan', '0', 'T6'),
('S011', 3, 'Berikut merupakan arah mata angin utama kecuali:', 'Timur Laut', '1', 'T6'),
('S012', 3, 'Berikut merupakan arah mata angin utama kecuali:', 'Timur', '0', 'T6'),
('S013', 4, 'x+5=7', '3', '0', 'T7'),
('S014', 4, 'x+5=7', '1', '0', 'T7'),
('S015', 4, 'x+5=7', '2', '1', 'T7'),
('S016', 4, 'x+5=7', '4', '0', 'T7'),
('S017', 5, 'a=b+2 a=2c b? ', '2c+2', '1', 'T7'),
('S018', 5, 'a=b+2 a=2c b? ', '1', '0', 'T7'),
('S019', 5, 'a=b+2 a=2c b? ', '2c+1', '0', 'T7'),
('S020', 5, 'a=b+2 a=2c b? ', '3', '0', 'T7');

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
('T1', 'Tambah'),
('T2', 'Tolak'),
('T3', 'Revisi'),
('T4', 'Tambah / Tolak'),
('T5', 's1'),
('T6', 'Geografi'),
('T7', 'Algebra');

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
-- Indexes for table `perekodan`
--
ALTER TABLE `perekodan`
  ADD PRIMARY KEY (`idrekod`),
  ADD KEY `idtopik` (`idtopik`),
  ADD KEY `nop` (`nop`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`idsoal`),
  ADD KEY `idtopik` (`idtopik`);

--
-- Indexes for table `telefon`
--
ALTER TABLE `telefon`
  ADD PRIMARY KEY (`notel`),
  ADD KEY `notel` (`notel`);

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
-- Constraints for table `perekodan`
--
ALTER TABLE `perekodan`
  ADD CONSTRAINT `perekodan_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`),
  ADD CONSTRAINT `perekodan_ibfk_2` FOREIGN KEY (`nop`) REFERENCES `pengguna` (`nop`);

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`idtopik`) REFERENCES `topik` (`idtopik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
