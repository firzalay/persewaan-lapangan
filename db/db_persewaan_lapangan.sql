-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 01:22 AM
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
-- Database: `db_persewaan_lapangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `tanggal_pesan` date NOT NULL DEFAULT current_timestamp(),
  `jam` time NOT NULL,
  `durasi_sewa` int(11) NOT NULL,
  `kategori_lapangan` varchar(50) NOT NULL,
  `jenis_lapangan` varchar(50) NOT NULL,
  `sewa_sepatu` varchar(20) DEFAULT NULL,
  `sewa_kostum` varchar(20) DEFAULT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `status_bayar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sewa`
--

INSERT INTO `tb_sewa` (`id`, `id_user`, `nama_pemesan`, `no_telepon`, `tanggal_pesan`, `jam`, `durasi_sewa`, `kategori_lapangan`, `jenis_lapangan`, `sewa_sepatu`, `sewa_kostum`, `total_bayar`, `status_bayar`) VALUES
(24, 4, 'Christian', '000909', '2024-03-26', '10:31:00', 2, 'Outdoor', 'Matras', '', '1', 'Rp 350.000', 'Belum Dikonfirmasi'),
(27, 4, 'Arda', '353453', '2024-03-27', '02:28:00', 2, 'Indoor', 'Reguler', '', '', 'Rp 600.000', 'Belum Dikonfirmasi'),
(28, 3, 'Fatah', '123456', '2024-03-27', '10:57:00', 2, 'Indoor', 'Reguler', '', '', 'Rp 600.000', 'Belum Dikonfirmasi'),
(29, 3, 'Fatahillah', '0223903488', '2024-03-27', '04:09:00', 2, 'Indoor', 'Matras', '', '', '500000', 'Belum Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin'),
(3, 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 'user'),
(4, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'user'),
(5, 'ardacantik', 'b8b4b727d6f5d1b61fff7be687f7970f', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
