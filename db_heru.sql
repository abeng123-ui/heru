-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2021 at 02:48 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_heru`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `jenis_brg` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis_brg`) VALUES
(1, 'Alat Tulis'),
(2, 'Elektronik'),
(3, 'Bahan Cair'),
(4, 'Obat');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `kode_brg` varchar(15) DEFAULT NULL,
  `jumlah` varchar(15) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `unit`, `kode_brg`, `jumlah`, `tgl_masuk`) VALUES
(1, 'Administrasi Umum', '6', '1', '2021-01-15'),
(2, 'Administrasi Umum', '1', '10', '2021-01-13'),
(3, 'Administrasi Umum', '2', '10', '2021-01-14'),
(4, 'Administrasi Umum', '3', '20', '2021-01-14'),
(5, 'Administrasi Umum', '4', '30', '2021-01-14'),
(6, 'Administrasi Umum', '5', '20', '2021-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `kode_brg` varchar(15) DEFAULT NULL,
  `jumlah` varchar(15) DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `unit`, `kode_brg`, `jumlah`, `tgl_keluar`) VALUES
(1, 'Jurusan', '5', '1', '2021-01-15'),
(2, 'Jurusan', '2', '3', '2021-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `kode_brg` int(15) DEFAULT NULL,
  `id_jenis` int(15) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `tgl_permintaan` date DEFAULT NULL,
  `nama_pemohon` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id`, `unit`, `kode_brg`, `id_jenis`, `jumlah`, `tgl_permintaan`, `nama_pemohon`, `status`) VALUES
(1, 'Jurusan', 1, 1, 2, '2021-01-15', 'Heru', 2),
(2, 'Jurusan', 2, 2, 3, '2021-01-15', 'Heru', 1),
(3, 'Jurusan', 5, 4, 1, '2021-01-15', 'Heru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `route_access_list` text,
  `role_code` varchar(45) DEFAULT NULL,
  `role_name` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `route_access_list`, `role_code`, `role_name`, `created_at`, `updated_at`) VALUES
(3, '{\"routelist\":[\"jenis_barang.list\",\"pemasukan.list\",\"pengeluaran.list\",\"pengguna.list\",\"pengguna.create\",\"pengguna.edit\",\"permintaan.list\",\"role.list\",\"role.create\",\"role.edit\",\"stok_barang.list\",\"stok_barang.create\"]}', 'admin', 'Administrasi Umum', '2020-12-02 08:31:05', '2021-01-14 07:34:42'),
(4, '{\"routelist\":[\"permintaan.jurusan.list\",\"permintaan.jurusan.create\",\"stok_barang.list\",\"permintaan.jurusan.cetak_bpp\"]}', 'jurusan', 'Jurusan', '2020-12-02 08:31:31', '2021-01-14 07:49:35'),
(5, '{\"routelist\":[\"pemasukan.list\",\"pengeluaran.list\",\"permintaan.list\",\"permintaan.edit\",\"permintaan.setuju\",\"permintaan.tidak_setuju\",\"stok_barang.list\"]}', 'subag', 'Sub Bagian Umum', '2021-01-14 07:34:08', '2021-01-14 07:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `stokbarang`
--

CREATE TABLE `stokbarang` (
  `id` int(11) NOT NULL,
  `kode_brg` int(15) DEFAULT NULL,
  `id_jenis` int(15) DEFAULT NULL,
  `nama_brg` varchar(225) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `stok` int(15) DEFAULT NULL,
  `keluar` int(15) DEFAULT NULL,
  `sisa` int(15) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `pj` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stokbarang`
--

INSERT INTO `stokbarang` (`id`, `kode_brg`, `id_jenis`, `nama_brg`, `satuan`, `stok`, `keluar`, `sisa`, `tgl_masuk`, `pj`) VALUES
(1, 1, 1, 'Pulpen', 'pack', 10, 0, 10, '2021-01-13', 'Administrasi Umum'),
(2, 2, 2, 'AC', 'pcs', 10, 3, 7, '2021-01-14', 'Administrasi Umum'),
(3, 3, 1, 'Pensil', 'pack', 20, 0, 20, '2021-01-14', 'Administrasi Umum'),
(4, 4, 3, 'Tinta Spidol', 'botol', 30, 0, 30, '2021-01-14', 'Administrasi Umum'),
(5, 5, 4, 'Betadine', 'pack', 20, 1, 19, '2021-01-15', 'Administrasi Umum'),
(6, 6, 2, 'TV', 'pcs', 1, 0, 1, '2021-01-15', 'Administrasi Umum');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrasi Umum', 'admin@gmail.com', '3', '$2y$10$GOiQzWz4iDUwgunzjjs/..xKa/T6e.cIzKZByBRqfs6kBOilaCGYW', 'UU4oGRBWojNl9YhZuCw5gifXjRdpL2QiZEcToLuYNTwjsk3FwAzHdY6gGjcN', '2020-08-26 07:08:19', '2021-01-14 00:47:57'),
(4, 'Heru', 'jurusan@gmail.com', '4', '$2y$10$lkyGFNtQA7bBQEYbFsVEcO0pscX29HMbvlaX9a1cJf3fKu4aQVL7u', 'oJIEMzIQd1czWFQBzTBlZltewy2g4jjQjdFBQPn4yFGNdswafcx4iICgyHXz', '2020-12-02 11:03:16', '2021-01-14 00:53:59'),
(5, 'Pegawai Subag', 'subag@gmail.com', '5', '$2y$10$ArDsKWZdy.hYsDJwYBNaseBBispt1eaImYC8an3/t52wSSSjBOqVO', 'W0s8Dto3ORk357fpd2bUHnLqUT2bJW096fi6NtJDinwAY1PoI14bL6DubSgF', '2021-01-14 00:27:59', '2021-01-15 00:52:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stokbarang`
--
ALTER TABLE `stokbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stokbarang`
--
ALTER TABLE `stokbarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
