-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 02:27 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ade`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` int(11) NOT NULL,
  `agama` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2020-12-01', '2020-12-01'),
(2, 'Kristen', '2020-12-01', '2020-12-01'),
(3, 'Budha', '2020-12-01', '2020-12-01'),
(4, 'Hindu', '2020-12-03 20:16:48', '2020-12-03 20:16:48'),
(5, 'Konghucu', '2020-12-03 20:17:05', '2020-12-03 20:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `angkel`
--

CREATE TABLE `angkel` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(45) DEFAULT NULL,
  `id_penduduk` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkel`
--

INSERT INTO `angkel` (`id`, `no_kk`, `id_penduduk`, `status`, `created_at`, `updated_at`) VALUES
(5, '6062220212201688', '7', '1', '2020-12-02 18:03:15', '2020-12-02 18:03:15'),
(6, '6062220212201688', '8', '1', '2020-12-02 18:04:27', '2020-12-02 18:04:27'),
(7, '6062220212201688', '9', '1', '2020-12-02 18:05:09', '2020-12-02 18:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int(11) NOT NULL,
  `desa` varchar(45) DEFAULT NULL,
  `kecamatan` varchar(45) DEFAULT NULL,
  `kabupaten` varchar(45) DEFAULT NULL,
  `provinsi` varchar(45) DEFAULT NULL,
  `kepala_desa` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `nik_camat` varchar(45) DEFAULT NULL,
  `nama_camat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kepala_desa`, `created_at`, `updated_at`, `nik_camat`, `nama_camat`) VALUES
(1, 'Pademangan Barat', 'Pademangan', 'Jakarta Utara', 'DKI Jakarta', 'M. Ruspandi', '2020-12-01 23:29:07', '2020-12-03 20:27:23', '1287010212986848', 'Dr. Sartono WIjaya');

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(45) DEFAULT NULL,
  `nama_kepala_keluarga` varchar(45) DEFAULT NULL,
  `alamat_kkel` varchar(45) DEFAULT NULL,
  `rt` varchar(45) DEFAULT NULL,
  `rw` varchar(45) DEFAULT NULL,
  `kodepos` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id`, `no_kk`, `nama_kepala_keluarga`, `alamat_kkel`, `rt`, `rw`, `kodepos`, `created_at`, `updated_at`) VALUES
(2, '6062220212201688', 'Aqa', 'Jl. Pademangan No. 17', '03', '07', '12630', '2020-12-02 18:01:25', '2020-12-02 18:03:41');

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
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `nama_lengkap` varchar(45) DEFAULT NULL,
  `tgl_lahir` varchar(45) DEFAULT NULL,
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `jk` varchar(45) DEFAULT NULL,
  `gol_darah` varchar(45) DEFAULT NULL,
  `alamat` text,
  `agama` varchar(45) DEFAULT NULL,
  `pendidikan_terakhir` varchar(45) DEFAULT NULL,
  `status_hubungan_keluarga` varchar(45) DEFAULT NULL,
  `klmp_pekerjaan` varchar(45) DEFAULT NULL,
  `status_perkawinan` varchar(45) DEFAULT NULL,
  `no_telpn` varchar(45) DEFAULT NULL,
  `kewarganegaraan` varchar(45) DEFAULT NULL,
  `tgl_reg` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `deleted_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nik`, `nama_lengkap`, `tgl_lahir`, `tmp_lahir`, `jk`, `gol_darah`, `alamat`, `agama`, `pendidikan_terakhir`, `status_hubungan_keluarga`, `klmp_pekerjaan`, `status_perkawinan`, `no_telpn`, `kewarganegaraan`, `tgl_reg`, `email`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, '1287010212986847', 'Aqa', '1998-12-02', 'Depok', 'L', 'A', 'Jl. Pademangan No. 17', '1', 'diploma', 'ayah', 'Dokter', 'kawin', '0219934231', 'Indonesia', '2020-12-02 18:03:15', 'aqa@gmail.com', '4', '2020-12-02 18:03:15', '2020-12-02 18:03:16', NULL),
(8, '8108971412999347', 'Awa', '1999-12-14', 'Depok', 'P', 'A', 'Jl. Pademangan No. 17', '1', 'sma', 'ibu', 'IRT', 'kawin', '0219934234', 'Indonesia', '2020-12-02 18:04:27', 'awa@gmail.com', '5', '2020-12-02 18:04:27', '2020-12-02 18:04:27', NULL),
(9, '5439020909208713', 'Aea', '2020-09-09', 'Jakarta', 'L', 'A', 'Jl. Pademangan No. 17', '1', 'sd', 'anak', 'Siswa', 'belum_kawin', '0219934234', 'Indonesia', '2020-12-02 18:05:09', 'aea@gmail.com', '6', '2020-12-02 18:05:09', '2020-12-02 18:05:10', NULL);

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
(3, '{\"routelist\":[\"desa.index\",\"kategori.index\",\"kk.index\",\"penduduk.index\",\"pengguna.index\",\"role.index\"]}', 'admin', 'Administrator', '2020-12-02 08:31:05', '2020-12-02 08:45:35'),
(4, '{\"routelist\":[\"kk_user.index\"]}', 'user', 'User', '2020-12-02 08:31:31', '2020-12-02 18:41:47');

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
(1, 'Admin', 'admin@gmail.com', '3', '$2y$10$qBxmK/XA.HddRfJn.YKT4OMlK3fpYmhKS55uqJGZ6c3DNGyMd1qMO', 'IJn8NqNjwo7jAbe0c1dVl91qobjqwBXPGTXNr1ftWaG9gEbJ6eSp9a67DhSl', '2020-08-26 07:08:19', '2020-12-02 01:57:21'),
(4, 'Aqa', 'aqa@gmail.com', '4', '$2y$10$A/pZ1iyv9v8CNkBZTlNiAeGN0cue9Va7cevajs0C99creYT.gxoZe', 'feq6CW5MzDiHM61ZlrjtnD4tcADEFYWj22OZqffmpZ2bfKDWkWRMWSXy8YCL', '2020-12-02 11:03:16', '2020-12-02 11:03:16'),
(5, 'Awa', 'awa@gmail.com', '4', '$2y$10$LaQt5Z88PzP78ybMNynbIOLD6nFs2aoPrLNisJj3wf7kiAmII6XFS', NULL, '2020-12-02 11:04:27', '2020-12-02 11:04:27'),
(6, 'Aea', 'aea@gmail.com', '4', '$2y$10$GI0pC43IhwRFOm8CDx3Xju950L8vspBExLZrckWACIHTCPYMVbq.6', NULL, '2020-12-02 11:05:09', '2020-12-02 11:05:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `angkel`
--
ALTER TABLE `angkel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
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
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
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
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `angkel`
--
ALTER TABLE `angkel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
