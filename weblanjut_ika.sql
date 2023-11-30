-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 07:43 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weblanjut_ika`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `deskripsi`, `user_id`) VALUES
(2, 'sepatu 1', 300000, 'mantul', 1),
(3, 'sepatu 2', 350000, 'produk ori', 1),
(4, 'sepatuu 3', 400000, 'importttt', 1),
(9, 'sepatuu 3', 400000, 'Kualitas sama', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telfon` varchar(15) NOT NULL,
  `metode_bayar` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `telfon`, `metode_bayar`, `alamat`, `catatan`) VALUES
(31, '1', '2', 'Debit', 'sakdhj', 'akshdk');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_item`
--

CREATE TABLE `transaksi_item` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_item`
--

INSERT INTO `transaksi_item` (`id`, `transaksi_id`, `produk_id`, `qty`, `total_harga`) VALUES
(1, 15, 4, 1, 400000),
(2, 16, 4, 1, 400000),
(3, 17, 4, 1, 400000),
(4, 18, 4, 1, 400000),
(5, 19, 4, 1, 400000),
(6, 19, 3, 1, 350000),
(7, 20, 4, 1, 400000),
(8, 20, 3, 1, 350000),
(9, 21, 4, 1, 400000),
(10, 21, 3, 1, 350000),
(11, 22, 4, 1, 400000),
(12, 22, 3, 1, 350000),
(13, 23, 4, 1, 400000),
(14, 23, 3, 1, 350000),
(15, 24, 4, 1, 400000),
(16, 24, 3, 1, 350000),
(17, 25, 4, 1, 400000),
(18, 25, 3, 1, 350000),
(19, 26, 4, 1, 400000),
(20, 26, 3, 1, 350000),
(21, 27, 4, 1, 400000),
(22, 27, 3, 1, 350000),
(23, 28, 4, 1, 400000),
(24, 28, 3, 1, 350000),
(25, 29, 4, 1, 400000),
(26, 29, 3, 1, 350000),
(27, 30, 4, 1, 400000),
(28, 30, 3, 1, 350000),
(29, 31, 4, 1, 400000),
(30, 31, 3, 1, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
