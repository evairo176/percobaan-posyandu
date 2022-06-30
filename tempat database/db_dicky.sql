-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 03:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dicky`
--

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_06_17_025906_create_users_table', 1),
(3, '2022_06_17_073011_add_role_to_users_table', 1),
(4, '2022_06_18_144645_create_tb_kategori_table', 1),
(5, '2022_06_18_144728_create_tb_subkategori_table', 1),
(6, '2022_06_18_144742_create_tb_attribut_table', 1),
(7, '2022_06_18_144818_create_tb_jawaban_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_attribut`
--

CREATE TABLE `tb_attribut` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_attribut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_form` enum('input','select','radio','checkbox','textarea') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_attribut`
--

INSERT INTO `tb_attribut` (`id`, `nama_attribut`, `jenis_form`, `created_at`, `updated_at`) VALUES
(211, 'ya', 'radio', '2022-06-24 06:28:16', '2022-06-24 06:28:16'),
(212, 'tidak', 'radio', '2022-06-24 06:28:26', '2022-06-24 06:28:26'),
(213, 'ml', 'input', '2022-06-24 06:28:36', '2022-06-24 06:28:36'),
(214, 'km', 'input', '2022-06-24 06:28:48', '2022-06-24 06:28:48'),
(215, 'kerja', 'checkbox', '2022-06-24 06:30:00', '2022-06-27 06:27:09'),
(216, 'detail', 'textarea', '2022-06-24 06:30:16', '2022-06-24 06:30:16'),
(217, 'kuliah', 'checkbox', '2022-06-27 06:27:21', '2022-06-27 06:27:21'),
(218, 'karyawan', 'checkbox', '2022-06-27 06:27:33', '2022-06-27 06:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data`
--

CREATE TABLE `tb_data` (
  `id` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pos` varchar(100) DEFAULT NULL,
  `blok` varchar(100) DEFAULT NULL,
  `rt_rw` varchar(20) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data`
--

INSERT INTO `tb_data` (`id`, `id_data`, `id_user`, `nama_pos`, `blok`, `rt_rw`, `kelurahan`, `kecamatan`, `kabupaten`) VALUES
(3, 1, 3, 'test', 'blok 1', '002 / 005', 'indrama', 'mayu', 'indramayu'),
(4, 1, 3, 'testdadad', '12312', '1212qeq', 'qeqeqeqeq', 'qeqeqe', 'qeqeq');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_subkategori` int(11) DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id`, `id_subkategori`, `id_data`, `jawaban`, `created_at`, `updated_at`) VALUES
(15, 69, 3, 'a:1:{i:211;s:3:\"211\";}', '2022-06-27 08:13:18', '2022-06-27 08:37:25'),
(16, 70, 3, 'a:1:{i:213;s:6:\"Test 1\";}', '2022-06-27 08:13:19', '2022-06-27 08:37:25'),
(17, 71, 3, 'a:1:{i:216;s:6:\"Test 2\";}', '2022-06-27 08:13:19', '2022-06-27 08:37:25'),
(18, 72, 3, 'a:2:{i:215;s:3:\"215\";i:217;s:3:\"217\";}', '2022-06-27 08:13:19', '2022-06-27 08:37:25'),
(19, 73, 3, 'a:1:{i:214;s:6:\"Test 2\";}', '2022-06-27 08:13:19', '2022-06-27 08:37:25'),
(20, 69, 4, 'a:1:{i:212;s:3:\"212\";}', '2022-06-27 08:14:57', '2022-06-27 08:18:27'),
(21, 70, 4, 'a:1:{i:213;s:6:\"Test 1\";}', '2022-06-27 08:14:57', '2022-06-27 08:18:27'),
(22, 71, 4, 'a:1:{i:216;s:6:\"Test 2\";}', '2022-06-27 08:14:57', '2022-06-27 08:18:27'),
(23, 72, 4, 'a:1:{i:215;s:3:\"215\";}', '2022-06-27 08:14:57', '2022-06-27 08:18:27'),
(24, 73, 4, 'a:1:{i:214;s:6:\"Test 2\";}', '2022-06-27 08:14:57', '2022-06-27 08:18:27'),
(30, 69, 1, 'a:1:{i:212;s:3:\"212\";}', '2022-06-28 05:15:14', '2022-06-28 05:16:55'),
(31, 70, 1, 'a:1:{i:213;s:6:\"Test 1\";}', '2022-06-28 05:15:14', '2022-06-28 05:16:55'),
(32, 71, 1, 'a:1:{i:216;s:6:\"Test 2\";}', '2022-06-28 05:15:14', '2022-06-28 05:16:55'),
(33, 72, 1, 'a:1:{i:215;s:3:\"215\";}', '2022-06-28 05:15:14', '2022-06-28 05:16:55'),
(34, 73, 1, 'a:1:{i:214;s:6:\"Test 2\";}', '2022-06-28 05:15:14', '2022-06-28 05:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Geografi', '2022-06-19 01:37:01', '2022-06-19 01:37:01'),
(2, 'Demografi', '2022-06-19 01:37:10', '2022-06-19 01:37:10'),
(3, 'Pembentukan', '2022-06-19 01:37:26', '2022-06-19 01:56:30'),
(4, 'Kepengurusan Posyandu', '2022-06-19 01:37:45', '2022-06-19 01:37:45'),
(5, 'Sarana Dan Prasarana', '2022-06-19 01:38:11', '2022-06-19 01:38:11'),
(6, 'Ketata Usahaan', '2022-06-19 01:38:23', '2022-06-19 01:38:23'),
(7, 'Pendanaan', '2022-06-19 01:38:32', '2022-06-19 01:38:32'),
(8, 'Kader', '2022-06-19 01:38:46', '2022-06-19 01:38:46'),
(10, 'Sasaran', '2022-06-19 01:39:36', '2022-06-19 01:39:36'),
(11, 'Kerja Sama Posyandu Dengan Dunia Usaha / Swasta', '2022-06-19 01:40:01', '2022-06-19 01:40:01'),
(12, 'Kegiatan Pokok', '2022-06-19 01:40:30', '2022-06-19 01:40:30'),
(13, 'Kegiatan Integrasi', '2022-06-19 01:40:45', '2022-06-19 01:40:45'),
(14, 'Kegiatan Pokok (jumlah)', '2022-06-19 01:41:43', '2022-06-19 01:41:43'),
(15, 'Kegiatan Integrasi (jumlah)', '2022-06-19 01:42:01', '2022-06-19 01:42:01'),
(16, 'Dampak Kegiatan (jumlah)', '2022-06-19 01:42:29', '2022-06-19 01:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkategori`
--

CREATE TABLE `tb_subkategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `urutan` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_subkategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_attribut` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_subkategori`
--

INSERT INTO `tb_subkategori` (`id`, `id_kategori`, `urutan`, `nama_subkategori`, `nama_attribut`, `created_at`, `updated_at`) VALUES
(69, 1, NULL, 'kuis 1 menggunakan radio', 'a:2:{i:0;s:3:\"211\";i:1;s:3:\"212\";}', '2022-06-24 06:31:08', '2022-06-24 06:31:08'),
(70, 2, NULL, 'jenis kuis 2 menggunakan input', 'a:1:{i:0;s:3:\"213\";}', '2022-06-24 06:34:20', '2022-06-24 06:34:20'),
(71, 3, NULL, 'jenis kuis 3 menggunakan textarea', 'a:1:{i:0;s:3:\"216\";}', '2022-06-24 06:53:10', '2022-06-24 06:53:10'),
(72, 4, NULL, 'jenis kuis 4 menggunakan', 'a:3:{i:0;s:3:\"215\";i:1;s:3:\"217\";i:2;s:3:\"218\";}', '2022-06-24 06:54:36', '2022-06-27 06:27:53'),
(73, 5, '1', 'jenis kuis 5 sembarang', 'a:1:{i:0;s:3:\"214\";}', '2022-06-27 06:58:12', '2022-06-28 04:35:54'),
(74, 5, '2', 'kuis sarana prasarana', 'a:1:{i:0;s:3:\"213\";}', '2022-06-28 05:20:04', '2022-06-28 05:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expired` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'petugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `gender`, `dob`, `phone`, `token`, `token_expired`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Dicki Prasetya', 'semenjakpetang176@gmail.com', '$2y$10$vjPEhhwAtEyoEz4M4HX8.OhoeZhtP7Pg.xki7xUHPny.R3uEpvfiu', 'default.jpg', 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'super-admin'),
(2, 'Petugas', 'coba1@gmail.com', '$2y$10$baVDaeR1SRV/UXk7vWthd.w/LuV5DUOrYRRmCfsTSmP51q7/HvEIi', 'default.jpg', 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'petugas'),
(3, 'admin', 'admin@admin.com', '$2y$10$hSoiqBtE82IWtguDgCl.nOiIEcFDzIpA0xkVHbCVOQ7R0uLqpnE2W', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-24 05:23:54', '2022-06-24 05:23:54', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_attribut`
--
ALTER TABLE `tb_attribut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_subkategori`
--
ALTER TABLE `tb_subkategori`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_attribut`
--
ALTER TABLE `tb_attribut`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_subkategori`
--
ALTER TABLE `tb_subkategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
