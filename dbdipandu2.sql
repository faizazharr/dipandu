-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 02:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdipandu2`
--

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE `anak` (
  `id` int(10) NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `umur` varchar(10) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `id_keluarga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anak`
--

INSERT INTO `anak` (`id`, `nama_anak`, `tanggal_lahir`, `umur`, `nik`, `id_keluarga`) VALUES
(17, 'ica', '2021-05-06', '1 Bulan ', '1111111111111', 1),
(23, 'ira', '2021-02-09', '4 Bulan ', '1234123412341234', 1),
(24, 'sera', '2021-02-02', '4 Bulan ', '3421234341212342341', 2);

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `id_penulis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `body`, `penulis`, `gambar`, `created_at`, `id_penulis`) VALUES
(40, 'Artikel Posiandu 2', 'Posyandu merupakan salah satu bentuk Upaya Kesehatan Berbasis Masyarakat (UKBM) yang dikelola dan diselenggarakan dari, oleh, untuk dan bersama masyarakat dalam penyelenggaraan pembangunan kesehatan guna memberdayakan masyarakat dan memberikan kemudahan kepada masyarakat dalam memperoleh pelayanan kesehatan dasar', 'bidan', 'sedang_1524801163posyandu.jpg', '2021-04-13', 4),
(41, 'Artikel Posiandu 3', 'Posyandu merupakan salah satu bentuk Upaya Kesehatan Berbasis Masyarakat (UKBM) yang dikelola dan diselenggarakan dari, oleh, untuk dan bersama masyarakat dalam penyelenggaraan pembangunan kesehatan guna memberdayakan masyarakat dan memberikan kemudahan kepada masyarakat dalam memperoleh pelayanan kesehatan dasar', 'bidan', 'sedang_1524801163posyandu_1.jpg', '2021-04-13', 4);

-- --------------------------------------------------------

--
-- Table structure for table `detail_imunisasi`
--

CREATE TABLE `detail_imunisasi` (
  `id` int(10) NOT NULL,
  `id_anak` int(10) DEFAULT NULL,
  `id_imunisasi` int(11) DEFAULT NULL,
  `is_imunisasi` tinyint(1) DEFAULT NULL,
  `vitamin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_imunisasi`
--

INSERT INTO `detail_imunisasi` (`id`, `id_anak`, `id_imunisasi`, `is_imunisasi`, `vitamin`) VALUES
(116, 17, 55, 0, NULL),
(121, 23, 55, 1, ''),
(122, 17, 56, 0, NULL),
(123, 23, 56, 0, NULL),
(124, 24, 55, 0, NULL),
(125, 24, 56, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `imunisasi`
--

CREATE TABLE `imunisasi` (
  `id` int(11) NOT NULL,
  `nama_imunisasi` varchar(255) NOT NULL,
  `tanggal_imunisasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imunisasi`
--

INSERT INTO `imunisasi` (`id`, `nama_imunisasi`, `tanggal_imunisasi`) VALUES
(55, 'camp', '2021-06-18'),
(56, 'gajah', '2021-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id` int(10) NOT NULL,
  `no_kk` varchar(255) DEFAULT NULL,
  `bapak` varchar(255) DEFAULT NULL,
  `ibu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id`, `no_kk`, `bapak`, `ibu`) VALUES
(1, '231123123123', 'supratman', 'pari'),
(2, '123213321', 'wahyu', 'putri');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id` int(10) NOT NULL,
  `id_anak` int(10) DEFAULT NULL,
  `berat` int(255) NOT NULL,
  `tinggi` int(255) NOT NULL,
  `lingkarbadan` int(255) NOT NULL,
  `lingkarkepala` int(255) NOT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `id_posyandu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id`, `id_anak`, `berat`, `tinggi`, `lingkarbadan`, `lingkarkepala`, `umur`, `id_posyandu`) VALUES
(26, 17, 12, 12, 12, 12, '1 Bulan ', 14),
(28, 23, 12, 12, 12, 12, '4 Bulan ', 14),
(29, 24, 12, 12, 12, 12, '4 Bulan ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `penyuluhan`
--

CREATE TABLE `penyuluhan` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyuluhan`
--

INSERT INTO `penyuluhan` (`id`, `kegiatan`, `date`, `catatan`) VALUES
(57, 'db', '2021-06-10', 'qwerrrrr');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(10) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `id_pengirim` int(10) NOT NULL,
  `id_penerima` int(10) NOT NULL,
  `role` int(10) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `tanggal`, `pesan`, `id_pengirim`, `id_penerima`, `role`, `nama_pengirim`) VALUES
(4, '2021/04/14', 'Ini pesan pertama ke bidan.', 1, 2, 4, 'Mariam'),
(5, '2021/04/14', 'Ini pesan kedua ke bidan.', 1, 2, 4, 'Mariam'),
(6, '2021/04/14', 'Ini pesan pertama ke orangtua.', 4, 1, 2, 'bidan'),
(7, '2021/04/14', 'Ini pesan jubaedah ke bidan.', 33, 2, 4, 'Jubaedah'),
(8, '2021/04/14', 'Haloo jubaedah.', 4, 33, 2, 'bidan'),
(9, '2021/04/14', 'Ini pesan ke 3.', 1, 2, 4, 'Mariam'),
(10, '2021/04/25', 'Halo bro', 42, 1, 2, 'bidan');

-- --------------------------------------------------------

--
-- Table structure for table `posyandu`
--

CREATE TABLE `posyandu` (
  `id` int(11) NOT NULL,
  `tanggal_posiandu` date NOT NULL,
  `hari` varchar(255) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posyandu`
--

INSERT INTO `posyandu` (`id`, `tanggal_posiandu`, `hari`, `waktu_mulai`, `waktu_selesai`) VALUES
(14, '2021-06-16', 'Rabu', '06:29:00', '15:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_alamat` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_nik` varchar(255) NOT NULL,
  `id_keluarga` int(10) DEFAULT NULL,
  `level` int(10) NOT NULL,
  `is_parent` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_email`, `user_name`, `user_password`, `user_alamat`, `user_phone`, `user_nik`, `id_keluarga`, `level`, `is_parent`) VALUES
(1, 'ortu@gmail.com', 'Mariamm', '12345678', 'Sukapura', '081222790899', '3276022501920003', 1, 4, 1),
(2, 'admin@gmail.com', 'admina', '12345678', 'Sukapura', '', '3271046504930002', NULL, 1, 0),
(3, 'kader@gmail.com', 'kader', '12345678', 'Sukapura', '081233790896', '3271046504930004', NULL, 3, 0),
(33, 'ortu2@gmail.com', 'Jubaedah', '12345678', 'Sukapura', '', '3271046504930114', 2, 4, 1),
(34, 'ortu3@gmail.com', 'Leni Marlina', '12345678', 'Sukapura', '', '3276046501920099', NULL, 4, 1),
(42, 'bidan@gmail.com', 'bidanww', '12345678', 'Sukapura', '08123321232', '3271246504930003', NULL, 2, 0),
(43, 'dadang@gmail.com', 'dadang', '12345678', 'sukapura', '081222789089', '5376046501920003', 1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_notif`
--

CREATE TABLE `user_notif` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_notif` int(11) DEFAULT NULL,
  `is_read` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keluarga` (`id_keluarga`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_imunisasi`
--
ALTER TABLE `detail_imunisasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anak` (`id_anak`),
  ADD KEY `detail_imunisasi_ibfk_2` (`id_imunisasi`);

--
-- Indexes for table `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_posyandu` (`id_posyandu`),
  ADD KEY `pemeriksaan_ibfk_3` (`id_anak`);

--
-- Indexes for table `penyuluhan`
--
ALTER TABLE `penyuluhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posyandu`
--
ALTER TABLE `posyandu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keluarga` (`id_keluarga`);

--
-- Indexes for table `user_notif`
--
ALTER TABLE `user_notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_notif` (`id_notif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anak`
--
ALTER TABLE `anak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `detail_imunisasi`
--
ALTER TABLE `detail_imunisasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `imunisasi`
--
ALTER TABLE `imunisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penyuluhan`
--
ALTER TABLE `penyuluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posyandu`
--
ALTER TABLE `posyandu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anak`
--
ALTER TABLE `anak`
  ADD CONSTRAINT `anak_ibfk_1` FOREIGN KEY (`id_keluarga`) REFERENCES `keluarga` (`id`);

--
-- Constraints for table `detail_imunisasi`
--
ALTER TABLE `detail_imunisasi`
  ADD CONSTRAINT `detail_imunisasi_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_imunisasi_ibfk_2` FOREIGN KEY (`id_imunisasi`) REFERENCES `imunisasi` (`id`);

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_posyandu`) REFERENCES `posyandu` (`id`),
  ADD CONSTRAINT `pemeriksaan_ibfk_3` FOREIGN KEY (`id_anak`) REFERENCES `anak` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_keluarga`) REFERENCES `keluarga` (`id`);

--
-- Constraints for table `user_notif`
--
ALTER TABLE `user_notif`
  ADD CONSTRAINT `user_notif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_notif_ibfk_2` FOREIGN KEY (`id_notif`) REFERENCES `notifikasi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
