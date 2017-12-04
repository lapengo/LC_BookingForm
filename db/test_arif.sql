-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 12:41 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_arif`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(5) NOT NULL,
  `nama_kamar` varchar(25) NOT NULL,
  `harga_kamar` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `harga_kamar`, `status`) VALUES
(1, 'Kamar 01', 150000, 0),
(2, 'Kamar 02', 2000000, 1),
(3, 'Kamar 03', 3500000, 0),
(4, 'Kamar 04', 1000000, 1),
(5, 'Kamar 05', 90000, 1),
(8, 'Kamar 08', 300, 1),
(9, 'Kamar 09', 90000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `no_identitas` varchar(25) NOT NULL,
  `nm_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `kamar_id` int(5) NOT NULL,
  `check_in` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `check_out` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `harga` int(10) NOT NULL,
  `status_transaksi` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_identitas`, `nm_customer`, `alamat`, `telp`, `kamar_id`, `check_in`, `check_out`, `harga`, `status_transaksi`) VALUES
(1, '1341324', 'arif lapengo', 'SMP NEGERI 2 DUMOGA - SULAWESI UTARA ( 95773 )\r\nMopuya Utara', '0215635918', 5, '2017-11-29 17:00:00', '2017-12-01 17:00:00', 0, 0),
(3, '1341324134f', 'adf', 'dfasdfadf', '245245', 8, '2017-11-29 17:00:00', '2017-12-01 17:00:00', 20, 1),
(4, '1341324134', 'Suryanto', 'dasfasdfasd', '081283191149', 5, '2017-11-29 17:00:00', '2017-12-02 17:00:00', 270000, 1),
(5, '1341324', 'arif lapengo', 'adfsafasdf', '081283191149', 8, '2017-11-30 17:00:00', '2017-12-04 17:00:00', 1200, 0),
(6, '1341324q', 'Arif Suryanto', 'dfasfadsf', '0215635918', 5, '2017-10-31 17:00:00', '2017-11-02 17:00:00', 180000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
