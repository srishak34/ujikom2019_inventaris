-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2019 at 06:29 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventaris_id` int(10) UNSIGNED NOT NULL,
  `peminjaman_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `inventaris_id`, `peminjaman_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50, '2019-02-13 21:29:03', '2019-02-13 21:29:03'),
(2, 1, 2, 15, '2019-02-13 23:34:50', '2019-02-13 23:34:50'),
(3, 1, 3, 35, '2019-02-13 23:45:55', '2019-02-13 23:45:55'),
(4, 1, 4, 54, '2019-02-14 18:35:48', '2019-02-14 18:35:48'),
(5, 1, 5, 20, '2019-02-14 18:36:05', '2019-02-14 18:36:05'),
(6, 1, 6, 22, '2019-02-14 18:36:18', '2019-02-14 18:36:18'),
(7, 1, 7, 21, '2019-02-14 18:36:31', '2019-02-14 18:36:31'),
(8, 1, 8, 50, '2019-02-14 19:34:02', '2019-02-14 19:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_id` int(10) UNSIGNED NOT NULL,
  `ruang_id` int(10) UNSIGNED NOT NULL,
  `kode_inventaris` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `nama`, `kondisi`, `keterangan`, `jumlah`, `jenis_id`, `ruang_id`, `kode_inventaris`, `petugas_id`, `created_at`, `updated_at`) VALUES
(1, 'Printer Cepat', 'Baik Sekali', 'Printer Cepat Milik Pasundan', '883', 1, 1, '123123123', 1, '2019-02-13 21:11:48', '2019-02-14 18:36:30'),
(2, 'Mouse', 'Sangatlah buruk', 'whatttt', '2000', 2, 2, '213123123123123123123', 1, '2019-02-26 21:44:52', '2019-02-26 21:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama_jenis`, `kode_jenis`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Besar', '12312312', 'untuk barang yang ukurannya besar', '2019-02-13 21:04:45', '2019-02-13 21:04:45'),
(2, 'Kecil', '1231231231', 'Untuk Ukuran Kecil', '2019-02-15 01:48:21', '2019-02-15 01:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'operator', NULL, NULL),
(3, 'peminjam', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_15_073311_create_petugas_table', 1),
(4, '2019_01_15_073751_create_level_table', 1),
(5, '2019_01_21_073454_create_inventaris_table', 2),
(6, '2019_01_21_073907_create_jenis_table', 2),
(7, '2019_01_21_074009_create_ruang_table', 2),
(8, '2019_01_21_074048_create_detail_pinjam_table', 2),
(9, '2019_01_21_074112_create_peminjaman_table', 2),
(10, '2019_01_21_074158_create_pegawai_table', 2),
(11, '2019_01_21_074048_create_detail_peminjaman_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `nip`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Raden Firli Rahmat Talilalamin', '12312312312312312312', 'Caket Masjid Agum', '2019-02-13 21:28:27', '2019-02-15 01:42:07'),
(2, 'Reva Diva Dimas', NULL, NULL, '2019-02-13 23:33:47', '2019-02-13 23:33:47'),
(3, 'Farhan Destu', NULL, NULL, '2019-02-13 23:44:29', '2019-02-13 23:44:29'),
(18, 'percobaan 7', '12312321311111111111', 'ikr>_<', '2019-02-19 18:44:50', '2019-02-19 18:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status_peminjaman` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tgl_pinjam`, `tgl_kembali`, `status_peminjaman`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(1, '2019-02-14', '2019-02-14', 'dikembalikan', 1, '2019-02-13 21:29:03', '2019-02-13 21:32:00'),
(2, '2019-02-14', '2019-02-14', 'dikembalikan', 2, '2019-02-13 23:34:50', '2019-02-13 23:47:04'),
(3, '2019-02-14', '2019-02-14', 'dikembalikan', 3, '2019-02-13 23:45:55', '2019-02-13 23:53:54'),
(4, '2019-02-15', NULL, 'dipinjam', 3, '2019-02-14 18:35:48', '2019-02-14 18:35:48'),
(5, '2019-02-15', NULL, 'dipinjam', 2, '2019-02-14 18:36:05', '2019-02-14 18:36:05'),
(6, '2019-02-15', NULL, 'dipinjam', 1, '2019-02-14 18:36:18', '2019-02-14 18:36:18'),
(7, '2019-02-15', NULL, 'dipinjam', 3, '2019-02-14 18:36:31', '2019-02-14 18:36:31'),
(8, '2019-02-15', NULL, 'pending', 3, '2019-02-14 19:34:02', '2019-02-14 19:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `nama_petugas`, `level_id`, `created_at`, `updated_at`) VALUES
(1, 'nash12', '$2y$10$XGDOenPAJYeLOkfR9DmPee4eMHUijgi8mg.KOO9m/Kc5xBpq42Nne', 'Anash Admin', 1, NULL, NULL),
(2, 'reva', '$2y$10$CHFnuL4p66J9kZtw1WjmsO2z9ZQ6ITCqYWqVHyPAXbR2a6TCXS7kC', 'Reva Diva Dimas', 2, '2019-02-13 23:33:47', '2019-02-13 23:33:47'),
(3, 'farhan', '$2y$10$lzV6T1FV7Zglv/ZThZMzzep2IphXqTrj53oqvDT3YV1.J7eg.FN.W', 'Farhan Destu', 3, '2019-02-13 23:44:29', '2019-02-13 23:44:29'),
(5, 'ezra', '$2y$10$nEARrj17BZxpo7ZuSY6g7.SKuDVAwjo0DCE3ws2CrH2CTfvjy90TG', 'Ezra Uzruth', 3, '2019-02-15 01:38:43', '2019-02-15 01:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_ruang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_ruang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama_ruang`, `kode_ruang`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Lab TEIND', '123123123', 'Ruangan Lab Jurusan Teknik Industri', '2019-02-13 21:10:07', '2019-02-13 21:10:07'),
(2, 'Lab 3', '21312312', 'Lab Komputer 3 SMK Pasundan 2 Cianjur', '2019-02-15 01:43:02', '2019-02-15 01:43:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaris_id` (`inventaris_id`),
  ADD KEY `peminjaman_id` (`peminjaman_id`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `ruang_id` (`ruang_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawai_id` (`pegawai_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`inventaris_id`) REFERENCES `inventaris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventaris_ibfk_3` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
