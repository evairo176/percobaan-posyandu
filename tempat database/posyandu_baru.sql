-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2022 pada 19.32
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posyandu_baru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `tb_attribut`
--

CREATE TABLE `tb_attribut` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_attribut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_attribut`
--

INSERT INTO `tb_attribut` (`id`, `nama_attribut`, `jenis_form`, `created_at`, `updated_at`) VALUES
(1, 'Jumlah RW', 'input', '2022-06-19 02:37:10', '2022-06-19 02:37:10'),
(2, 'Jumlah RT', 'input', '2022-06-19 02:45:52', '2022-06-19 02:45:52'),
(3, 'Jarak Terdekat ke Posyandu', 'input', '2022-06-19 02:46:19', '2022-06-19 02:46:19'),
(4, 'Jarak Terjauh ke Posyandu', 'input', '2022-06-19 02:46:39', '2022-06-19 02:46:39'),
(5, 'Polindes/Bidan Desa', 'input', '2022-06-19 02:53:27', '2022-06-19 02:53:27'),
(6, 'Puskesmas Pembantu', 'input', '2022-06-19 02:53:50', '2022-06-19 02:53:50'),
(7, 'Puskesmas', 'input', '2022-06-19 02:54:11', '2022-06-19 02:54:11'),
(8, 'Praktek Dokter', 'input', '2022-06-19 02:54:26', '2022-06-19 02:54:26'),
(9, 'Balai Pengobatan/Klinik', 'input', '2022-06-19 02:54:50', '2022-06-19 02:54:58'),
(10, 'Rumah Sakit', 'input', '2022-06-19 02:55:17', '2022-06-19 02:55:17'),
(11, 'Desa/Kelurahan', 'input', '2022-06-19 02:55:41', '2022-06-19 02:55:41'),
(12, 'Kecamatan', 'input', '2022-06-19 02:55:58', '2022-06-19 02:55:58'),
(13, 'Kabupaten/Kota', 'input', '2022-06-19 02:56:16', '2022-06-19 02:56:16'),
(14, 'Provinsi', 'input', '2022-06-19 02:56:29', '2022-06-19 02:56:29'),
(15, 'Jumlah Kepala Keluarga', 'input', '2022-06-19 02:57:17', '2022-06-19 02:57:17'),
(16, 'Jumlah Penduduk', 'input', '2022-06-19 02:57:55', '2022-06-19 02:57:55'),
(17, 'Jumlah Penduduk Laki-laki', 'input', '2022-06-19 02:58:20', '2022-06-19 02:58:20'),
(18, 'Jumlah Penduduk Perempuan', 'input', '2022-06-19 02:58:40', '2022-06-19 02:58:40'),
(19, 'Jumlah PUS', 'input', '2022-06-19 02:58:56', '2022-06-19 02:58:56'),
(20, 'Jumlah WUS', 'input', '2022-06-19 02:59:08', '2022-06-19 02:59:08'),
(21, 'Jumlah Ibu Hamil', 'input', '2022-06-19 03:01:25', '2022-06-19 03:01:25'),
(22, 'Jumlah Bayi 0 s/d 12 bulan', 'input', '2022-06-19 03:01:50', '2022-06-19 03:02:03'),
(23, 'Jumlah Balita 12 s/d 60 bulan', 'input', '2022-06-19 03:02:32', '2022-06-19 03:02:32'),
(24, 'Tanggal Musyawarah', 'input', '2022-06-19 03:03:16', '2022-06-19 03:03:16'),
(25, 'Peserta Musyawarah', 'input', '2022-06-19 03:03:41', '2022-06-19 03:03:41'),
(26, 'Materi Musyawarah', 'input', '2022-06-19 03:03:58', '2022-06-19 03:03:58'),
(27, 'Kesepakatan', 'textarea', '2022-06-19 03:04:17', '2022-06-19 03:04:17'),
(28, 'Lurah', 'input', '2022-06-19 03:05:07', '2022-06-19 03:05:07'),
(29, 'Nomor', 'input', '2022-06-19 03:05:25', '2022-06-19 03:05:25'),
(30, 'Tanggal', 'input', '2022-06-19 03:05:39', '2022-06-19 03:05:39'),
(31, 'Tentang', 'textarea', '2022-06-19 03:05:54', '2022-06-19 03:05:54'),
(32, 'Ketua', 'input', '2022-06-19 03:32:03', '2022-06-19 03:32:03'),
(33, 'Bendahara', 'input', '2022-06-19 03:32:18', '2022-06-19 03:32:18'),
(34, 'Seksi/Bidang', 'input', '2022-06-19 03:32:33', '2022-06-19 03:32:33'),
(47, 'Status', 'checkbox', '2022-06-19 03:36:33', '2022-06-19 03:36:33'),
(48, 'Tahun dibangun', 'input', '2022-06-19 03:37:10', '2022-06-19 03:37:10'),
(49, 'Keadaan', 'checkbox', '2022-06-19 03:37:24', '2022-06-19 03:37:24'),
(50, 'Luas', 'input', '2022-06-19 03:38:01', '2022-06-19 03:38:01'),
(51, 'Konstruksi', 'checkbox', '2022-06-19 03:38:16', '2022-06-19 03:38:16'),
(52, 'Sumber Dana Pembangunan', 'checkbox', '2022-06-19 03:38:31', '2022-06-19 03:38:31'),
(53, 'Dacin', 'checkbox', '2022-06-19 03:39:35', '2022-06-19 03:39:35'),
(54, 'Timbangan Bayi', 'checkbox', '2022-06-19 03:40:04', '2022-06-19 03:40:04'),
(55, 'Timbangan Injak', 'checkbox', '2022-06-19 03:40:56', '2022-06-19 03:40:56'),
(56, 'Pita LILA', 'checkbox', '2022-06-19 03:41:09', '2022-06-19 03:41:09'),
(57, 'Alat Ukur Tinggi Badan', 'checkbox', '2022-06-19 03:41:39', '2022-06-19 03:41:39'),
(58, 'Alat Ukur Panjang Badan', 'checkbox', '2022-06-19 03:42:30', '2022-06-19 03:42:30'),
(59, 'Alat Permainan Edukatif (APE)', 'checkbox', '2022-06-19 03:42:53', '2022-06-19 03:42:53'),
(60, 'Sarana Penyuluhan', 'checkbox', '2022-06-19 03:43:12', '2022-06-19 03:43:12'),
(61, 'Food Model', 'checkbox', '2022-06-19 03:43:25', '2022-06-19 03:43:25'),
(62, 'Mebelair', 'checkbox', '2022-06-19 03:43:37', '2022-06-19 03:43:37'),
(63, 'Papan Nama/Plang Posyandu', 'checkbox', '2022-06-19 03:43:59', '2022-06-19 03:43:59'),
(64, 'Buku-buku Register', 'checkbox', '2022-06-19 03:45:37', '2022-06-19 03:45:37'),
(65, 'Format Pelaporan', 'checkbox', '2022-06-19 03:45:52', '2022-06-19 03:45:52'),
(66, 'Kearsipan', 'checkbox', '2022-06-19 03:46:05', '2022-06-19 03:46:05'),
(67, 'Struktur Organisasi', 'checkbox', '2022-06-19 03:46:30', '2022-06-19 03:46:30'),
(68, 'Data Capaian Program', 'checkbox', '2022-06-19 03:46:54', '2022-06-19 03:46:54'),
(69, 'Data Kegiatan Tambahan', 'checkbox', '2022-06-19 03:47:11', '2022-06-19 03:47:11'),
(70, 'Dana Sehat', 'checkbox', '2022-06-19 03:47:29', '2022-06-19 03:47:29'),
(71, 'Bantuan Insidentil', 'checkbox', '2022-06-19 03:48:05', '2022-06-19 03:48:05'),
(72, 'Operasional Posyandu', 'checkbox', '2022-06-19 03:48:32', '2022-06-19 03:48:32'),
(73, 'Pengadaan sarana dan prasarana', 'checkbox', '2022-06-19 03:49:15', '2022-06-19 03:49:15'),
(80, 'CSR', 'checkbox', '2022-06-19 03:51:05', '2022-06-19 03:51:05'),
(81, 'Lain-lain', 'checkbox', '2022-06-19 03:51:27', '2022-06-19 03:51:27'),
(82, 'Jumlah Seluruhnya', 'input', '2022-06-19 03:52:29', '2022-06-19 03:52:29'),
(83, 'Kader Aktif', 'input', '2022-06-19 03:52:52', '2022-06-19 03:52:52'),
(84, 'Kader Terlatih', 'input', '2022-06-19 03:53:16', '2022-06-19 03:53:16'),
(85, 'Tingkat Pendidikan', 'checkbox', '2022-06-19 03:53:33', '2022-06-19 03:53:33'),
(106, 'Ibu Hamil', 'input', '2022-06-19 04:10:15', '2022-06-19 04:10:15'),
(107, 'Bayi', 'input', '2022-06-19 04:10:34', '2022-06-19 04:10:34'),
(108, 'Balita', 'input', '2022-06-19 04:10:51', '2022-06-19 04:10:51'),
(109, 'Pasangan Usia Subur', 'input', '2022-06-19 04:11:09', '2022-06-19 04:11:09'),
(110, 'Bina Keluarga Balita', 'input', '2022-06-19 04:12:16', '2022-06-19 04:12:16'),
(111, 'Bina Keluarga Remaja', 'input', '2022-06-19 04:12:32', '2022-06-19 04:12:32'),
(112, 'Bina Keluarga Lansia', 'input', '2022-06-19 04:12:52', '2022-06-19 04:12:52'),
(113, 'Balita Sasaran PAUD', 'input', '2022-06-19 04:13:13', '2022-06-19 04:13:13'),
(114, 'Kelompok UP2K', 'input', '2022-06-19 04:13:37', '2022-06-19 04:13:37'),
(115, 'Kelompok UPPKS', 'input', '2022-06-19 04:13:53', '2022-06-19 04:13:53'),
(116, 'Program/Kegiatan', 'checkbox', '2022-06-19 04:14:25', '2022-06-19 04:14:25'),
(117, 'Pendamping', 'checkbox', '2022-06-19 04:14:44', '2022-06-19 04:14:44'),
(118, 'Pendanaan', 'checkbox', '2022-06-19 04:14:55', '2022-06-19 04:14:55'),
(119, 'Pemeriksaan Ibu Hamil', 'checkbox', '2022-06-20 08:03:07', '2022-06-20 08:03:07'),
(120, 'Pemberian Tablet Fe Bumil', 'checkbox', '2022-06-20 08:03:28', '2022-06-20 08:04:45'),
(121, 'Pemberian Vitamin A Ibu Nifas', 'checkbox', '2022-06-20 08:03:50', '2022-06-20 08:03:50'),
(122, 'IMD', 'checkbox', '2022-06-20 08:08:37', '2022-06-20 08:08:37'),
(123, 'ASI Ekslusif', 'checkbox', '2022-06-20 08:08:56', '2022-06-20 08:08:56'),
(124, 'Penimbangan BayI dan Balita', 'checkbox', '2022-06-20 08:09:18', '2022-06-20 08:09:18'),
(125, 'PMT penyuluhan', 'checkbox', '2022-06-20 08:09:29', '2022-06-20 08:09:29'),
(126, 'Penanganan BGM dan GBR', 'checkbox', '2022-06-20 08:09:44', '2022-06-20 08:09:44'),
(127, 'Pemberian Vitamin A Balita', 'checkbox', '2022-06-20 08:10:05', '2022-06-20 08:10:05'),
(128, 'PMT Pemulihan', 'checkbox', '2022-06-20 08:10:20', '2022-06-20 08:10:20'),
(129, 'Pemberian Kapsul Lodium', 'checkbox', '2022-06-20 08:10:42', '2022-06-20 08:10:42'),
(130, 'BCG', 'checkbox', '2022-06-20 08:10:51', '2022-06-20 08:10:51'),
(131, 'DPT', 'checkbox', '2022-06-20 08:10:58', '2022-06-20 08:10:58'),
(132, 'Folio', 'checkbox', '2022-06-20 08:11:05', '2022-06-20 08:11:05'),
(133, 'Hepatitis', 'checkbox', '2022-06-20 08:11:15', '2022-06-20 08:11:15'),
(134, 'Campak', 'checkbox', '2022-06-20 08:11:25', '2022-06-20 08:11:25'),
(135, 'MOW', 'checkbox', '2022-06-20 08:11:42', '2022-06-20 08:11:42'),
(136, 'MOP', 'checkbox', '2022-06-20 08:11:50', '2022-06-20 08:11:50'),
(137, 'IUD', 'checkbox', '2022-06-20 08:11:56', '2022-06-20 08:11:56'),
(138, 'Suntik', 'checkbox', '2022-06-20 08:12:04', '2022-06-20 08:12:04'),
(139, 'Implan', 'checkbox', '2022-06-20 08:12:14', '2022-06-20 08:12:14'),
(140, 'Kondom', 'checkbox', '2022-06-20 08:12:19', '2022-06-20 08:12:19'),
(141, 'Penanggulangan Diare', 'checkbox', '2022-06-20 08:12:52', '2022-06-20 08:12:52'),
(142, 'PHBS Rumah Tangga', 'checkbox', '2022-06-20 08:13:10', '2022-06-20 08:13:10'),
(143, 'Paud (pos PAUD)', 'checkbox', '2022-06-20 08:14:38', '2022-06-20 08:14:38'),
(144, 'Jumlah Kelompok', 'input', '2022-06-20 08:14:53', '2022-06-20 08:16:02'),
(145, 'Jumlah Anggota', 'input', '2022-06-20 08:16:18', '2022-06-20 08:16:18'),
(146, 'Jenis Kegiatan', 'input', '2022-06-20 08:16:32', '2022-06-20 08:16:32'),
(147, 'Jumlah Modal Bergulir', 'input', '2022-06-20 08:16:58', '2022-06-20 08:16:58'),
(148, 'Traficking', 'checkbox', '2022-06-20 08:19:27', '2022-06-20 08:19:27'),
(149, 'Kekerasan Dalam Rumah Tangga', 'checkbox', '2022-06-20 08:19:42', '2022-06-20 08:19:42'),
(150, 'Perlindungan Perempuan Dan Anak', 'checkbox', '2022-06-20 08:20:06', '2022-06-20 08:20:06'),
(151, 'HIV/Aids', 'checkbox', '2022-06-20 08:20:25', '2022-06-20 08:20:25'),
(152, 'Pemeriksaan Ibu Hamil (K-1)', 'input', '2022-06-20 08:24:49', '2022-06-20 08:24:49'),
(153, 'Pemeriksaan Ibu Hamil (K-4)', 'input', '2022-06-20 08:26:09', '2022-06-20 08:26:09'),
(154, 'Pemberian Tablet Fe', 'input', '2022-06-20 08:26:27', '2022-06-20 08:26:27'),
(155, 'Inisiasi Menyusui Dini (IMD)', 'input', '2022-06-20 08:31:52', '2022-06-20 08:31:52'),
(156, 'Bayi dan Balita Sasaran Posyandu/S', 'input', '2022-06-20 08:33:19', '2022-06-20 08:33:19'),
(157, 'Balita Yang Memiliki KMS/K', 'input', '2022-06-20 08:33:37', '2022-06-20 08:33:37'),
(158, 'Bayi dan Balita datang ditimbang/D', 'input', '2022-06-20 08:34:06', '2022-06-20 08:34:06'),
(159, 'Bayi dan Balita yang BGM', 'input', '2022-06-20 08:34:27', '2022-06-20 08:34:27'),
(160, 'Bayi dan Balita Mendapat Vitamin A', 'input', '2022-06-20 08:34:54', '2022-06-20 08:34:54'),
(161, 'Mendapat PMT Penyuluhan', 'input', '2022-06-20 08:35:10', '2022-06-20 08:35:10'),
(162, 'HB 0 (HB 0)', 'input', '2022-06-20 08:45:30', '2022-06-20 08:45:30'),
(163, 'Polio I', 'input', '2022-06-20 08:46:00', '2022-06-20 08:46:00'),
(164, 'Polio II', 'input', '2022-06-20 08:46:08', '2022-06-20 08:46:08'),
(165, 'Polio III', 'input', '2022-06-20 08:46:19', '2022-06-20 08:46:19'),
(166, 'Polio IV', 'input', '2022-06-20 08:46:28', '2022-06-20 08:46:28'),
(167, 'DPT I', 'input', '2022-06-20 08:48:28', '2022-06-20 08:48:28'),
(168, 'DPT II', 'input', '2022-06-20 08:48:36', '2022-06-20 08:48:36'),
(169, 'DPT III', 'input', '2022-06-20 08:48:44', '2022-06-20 08:48:44'),
(170, 'TT I', 'input', '2022-06-20 08:49:03', '2022-06-20 08:49:03'),
(171, 'TT II', 'input', '2022-06-20 08:49:10', '2022-06-20 08:49:10'),
(172, 'TT III', 'input', '2022-06-20 08:49:17', '2022-06-20 08:49:17'),
(173, 'TT IV', 'input', '2022-06-20 08:49:29', '2022-06-20 08:49:29'),
(174, 'TT V', 'input', '2022-06-20 08:49:37', '2022-06-20 08:49:37'),
(175, 'Peserta KB Aktif (CU/PUS)', 'input', '2022-06-20 08:54:02', '2022-06-20 08:54:02'),
(176, 'Jumlah Balita Menderita Diare', 'input', '2022-06-20 08:55:08', '2022-06-20 08:55:08'),
(177, 'Jumlah Balita Yang Mendapat Oralit', 'input', '2022-06-20 08:55:24', '2022-06-20 08:55:24'),
(178, 'Persalinan Oleh Tenaga Kesehatan', 'input', '2022-06-20 08:55:48', '2022-06-20 08:55:48'),
(179, 'Pemberian ASI Eklsusif', 'input', '2022-06-20 08:56:10', '2022-06-20 08:56:10'),
(180, 'Menimbang Bayi Dan Balita Tiap Bulan', 'input', '2022-06-20 08:57:39', '2022-06-20 08:57:39'),
(181, 'Menggunakan Air Bersih', 'input', '2022-06-20 08:57:57', '2022-06-20 08:57:57'),
(182, 'Cuci Tangan Pakai Sabun', 'input', '2022-06-20 08:58:15', '2022-06-20 08:58:15'),
(183, 'Menggunakan Jamban Sehat', 'input', '2022-06-20 08:58:27', '2022-06-20 08:58:27'),
(184, 'Memberantas Jentik Nyamuk', 'input', '2022-06-20 08:58:42', '2022-06-20 08:58:42'),
(185, 'Makan Buah dan Sayur Setiap Hari', 'input', '2022-06-20 08:59:09', '2022-06-20 08:59:09'),
(186, 'Melakukan Aktifitas Fisik Setiap Hari', 'input', '2022-06-20 08:59:42', '2022-06-20 09:01:53'),
(187, 'Tidak Merokok didalam Rumah', 'input', '2022-06-20 09:02:00', '2022-06-20 09:02:48'),
(188, 'Jamban Keluarga', 'input', '2022-06-20 09:03:01', '2022-06-20 09:03:01'),
(189, 'SPAL', 'input', '2022-06-20 09:03:08', '2022-06-20 09:03:08'),
(190, 'Rumah Sehat', 'input', '2022-06-20 09:03:17', '2022-06-20 09:03:17'),
(191, 'Perkembangan Kelompok Aktif', 'input', '2022-06-20 09:04:01', '2022-06-20 09:04:01'),
(192, 'Perkembangan Anggota Aktif', 'input', '2022-06-20 09:04:19', '2022-06-20 09:04:19'),
(193, 'Perkembangan Jenis Kegiatan', 'input', '2022-06-20 09:04:37', '2022-06-20 09:04:37'),
(194, 'Perkembangan Modal Bergulir', 'input', '2022-06-20 09:04:53', '2022-06-20 09:04:53'),
(195, 'Penyuluhan Traficking', 'input', '2022-06-20 09:05:13', '2022-06-20 09:05:13'),
(196, 'Penyuluhan KDRT', 'input', '2022-06-20 09:05:25', '2022-06-20 09:05:25'),
(197, 'Penyuluhan Perlindungan Perempuan', 'input', '2022-06-20 09:05:44', '2022-06-20 09:05:44'),
(198, 'Penyuluhan HIV/Aids', 'input', '2022-06-20 09:05:57', '2022-06-20 09:05:57'),
(199, 'Penyuluhan', 'input', '2022-06-20 09:06:08', '2022-06-20 09:06:08'),
(200, 'Konseling Traficking', 'input', '2022-06-20 09:06:26', '2022-06-20 09:06:31'),
(201, 'Konseling KDRT', 'input', '2022-06-20 09:06:44', '2022-06-20 09:06:44'),
(202, 'Konseling Perlindungan Perempuan', 'input', '2022-06-20 09:06:59', '2022-06-20 09:06:59'),
(203, 'Konseling HIV/Aids', 'input', '2022-06-20 09:07:12', '2022-06-20 09:07:12'),
(204, 'Konseling', 'input', '2022-06-20 09:07:20', '2022-06-20 09:07:20'),
(205, 'Perkembangan Kelompok TOGA', 'input', '2022-06-20 09:08:00', '2022-06-20 09:08:00'),
(206, 'Perkembangan Kelompok Pertanian', 'input', '2022-06-20 09:08:15', '2022-06-20 09:08:15'),
(207, 'Perkembangan Kelompok Perternakan', 'input', '2022-06-20 09:08:32', '2022-06-20 09:08:32'),
(208, 'Perkembangan Kelompok Perikanan', 'input', '2022-06-20 09:08:46', '2022-06-20 09:08:46'),
(209, '1 tahun Terakhir', 'input', '2022-06-20 09:09:45', '2022-06-20 09:09:45'),
(210, 'Bayi dan Balita Naik Timbangan', 'input', '2022-06-20 09:28:25', '2022-06-20 09:28:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_subkategori` int(11) NOT NULL,
  `id_attribut` int(11) NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_kategori`
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
-- Struktur dari tabel `tb_subkategori`
--

CREATE TABLE `tb_subkategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_subkategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_attribut` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_subkategori`
--

INSERT INTO `tb_subkategori` (`id`, `id_kategori`, `nama_subkategori`, `nama_attribut`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wilayah Pelayanan', 'a:2:{i:0;s:9:\"Jumlah RW\";i:1;s:9:\"Jumlah RT\";}', '2022-06-19 01:47:12', '2022-06-20 07:19:49'),
(2, 1, 'Orbitasi Sasaran Posyandu', 'a:2:{i:0;s:26:\"Jarak Terdekat ke Posyandu\";i:1;s:25:\"Jarak Terjauh ke Posyandu\";}', '2022-06-19 01:49:44', '2022-06-20 07:20:04'),
(3, 1, 'Orbitasi ke Pusat Pemerintahan', 'a:6:{i:0;s:19:\"Polindes/Bidan Desa\";i:1;s:18:\"Puskesmas Pembantu\";i:2;s:9:\"Puskesmas\";i:3;s:14:\"Praktek Dokter\";i:4;s:23:\"Balai Pengobatan/Klinik\";i:5;s:11:\"Rumah Sakit\";}', '2022-06-19 01:50:17', '2022-06-20 07:20:47'),
(4, 1, 'Orbitasi ke Fasilitas Kesehatan', 'a:4:{i:0;s:14:\"Desa/Kelurahan\";i:1;s:9:\"Kecamatan\";i:2;s:14:\"Kabupaten/Kota\";i:3;s:8:\"Provinsi\";}', '2022-06-19 01:52:52', '2022-06-20 10:11:41'),
(5, 2, 'Data Umum Penduduk', 'a:6:{i:0;s:22:\"Jumlah Kepala Keluarga\";i:1;s:15:\"Jumlah Penduduk\";i:2;s:25:\"Jumlah Penduduk Laki-laki\";i:3;s:25:\"Jumlah Penduduk Perempuan\";i:4;s:10:\"Jumlah PUS\";i:5;s:10:\"Jumlah WUS\";}', '2022-06-19 01:53:08', '2022-06-20 10:11:19'),
(6, 2, 'Sasaran Posyandu', 'a:3:{i:0;s:16:\"Jumlah Ibu Hamil\";i:1;s:26:\"Jumlah Bayi 0 s/d 12 bulan\";i:2;s:29:\"Jumlah Balita 12 s/d 60 bulan\";}', '2022-06-19 01:53:20', '2022-06-20 10:10:58'),
(10, 3, 'Musyawarah Pembentukan', 'a:4:{i:0;s:18:\"Tanggal Musyawarah\";i:1;s:18:\"Peserta Musyawarah\";i:2;s:17:\"Materi Musyawarah\";i:3;s:11:\"Kesepakatan\";}', '2022-06-19 01:57:24', '2022-06-20 10:10:21'),
(11, 3, 'Keputusan Lurah / Kepala Desa', 'a:3:{i:0;s:5:\"Nomor\";i:1;s:7:\"Tanggal\";i:2;s:7:\"Tentang\";}', '2022-06-19 01:57:43', '2022-06-20 10:10:03'),
(12, 4, 'Posyandu Multifungsi', 'a:3:{i:0;s:5:\"Ketua\";i:1;s:9:\"Bendahara\";i:2;s:12:\"Seksi/Bidang\";}', '2022-06-19 02:00:20', '2022-06-20 10:09:27'),
(13, 4, 'Kelompok Kegiatan Pokok', 'a:3:{i:0;s:5:\"Ketua\";i:1;s:9:\"Bendahara\";i:2;s:12:\"Seksi/Bidang\";}', '2022-06-19 02:00:43', '2022-06-20 10:09:18'),
(14, 4, 'Kelompok Kegiatan BKB', 'a:3:{i:0;s:5:\"Ketua\";i:1;s:9:\"Bendahara\";i:2;s:12:\"Seksi/Bidang\";}', '2022-06-19 02:01:12', '2022-06-20 10:09:09'),
(15, 4, 'Kelompok Kegiatan Bidang Pendidikan/PAUD', 'a:3:{i:0;s:5:\"Ketua\";i:1;s:9:\"Bendahara\";i:2;s:12:\"Seksi/Bidang\";}', '2022-06-19 02:01:45', '2022-06-20 10:08:44'),
(16, 4, 'Kelompok Kegiatan Bidang Ekonomi/UP2K/UPPKS', 'a:3:{i:0;s:5:\"Ketua\";i:1;s:9:\"Bendahara\";i:2;s:12:\"Seksi/Bidang\";}', '2022-06-19 02:02:32', '2022-06-20 10:08:33'),
(17, 5, 'Gedung', 'a:6:{i:0;s:6:\"Status\";i:1;s:14:\"Tahun dibangun\";i:2;s:7:\"Keadaan\";i:3;s:4:\"Luas\";i:4;s:10:\"Konstruksi\";i:5;s:23:\"Sumber Dana Pembangunan\";}', '2022-06-19 02:04:00', '2022-06-20 10:06:46'),
(18, 5, 'Alat Kelengkapan', 'a:11:{i:0;s:5:\"Dacin\";i:1;s:14:\"Timbangan Bayi\";i:2;s:15:\"Timbangan Injak\";i:3;s:9:\"Pita LILA\";i:4;s:22:\"Alat Ukur Tinggi Badan\";i:5;s:23:\"Alat Ukur Panjang Badan\";i:6;s:29:\"Alat Permainan Edukatif (APE)\";i:7;s:17:\"Sarana Penyuluhan\";i:8;s:10:\"Food Model\";i:9;s:8:\"Mebelair\";i:10;s:25:\"Papan Nama/Plang Posyandu\";}', '2022-06-19 02:04:14', '2022-06-20 10:05:58'),
(19, 6, 'Administrasi Posyandu', 'a:3:{i:0;s:18:\"Buku-buku Register\";i:1;s:16:\"Format Pelaporan\";i:2;s:22:\"Data Kegiatan Tambahan\";}', '2022-06-19 02:04:33', '2022-06-20 10:04:38'),
(20, 6, 'Visualisasi Data', 'a:3:{i:0;s:19:\"Struktur Organisasi\";i:1;s:20:\"Data Capaian Program\";i:2;s:22:\"Data Kegiatan Tambahan\";}', '2022-06-19 02:04:50', '2022-06-20 10:04:19'),
(21, 7, 'Swadaya Masyarakat', 'a:2:{i:0;s:10:\"Dana Sehat\";i:1;s:18:\"Bantuan Insidentil\";}', '2022-06-19 02:05:17', '2022-06-20 10:03:58'),
(22, 7, 'APBdes', 'a:2:{i:0;s:20:\"Operasional Posyandu\";i:1;s:30:\"Pengadaan sarana dan prasarana\";}', '2022-06-19 02:05:34', '2022-06-20 10:03:37'),
(23, 7, 'Bantuan Pemerintah Kabupaten/Kota', 'a:2:{i:0;s:20:\"Operasional Posyandu\";i:1;s:30:\"Pengadaan sarana dan prasarana\";}', '2022-06-19 02:05:57', '2022-06-20 10:03:26'),
(24, 7, 'Bantuan Pemerintah Provinsi', 'a:2:{i:0;s:20:\"Operasional Posyandu\";i:1;s:30:\"Pengadaan sarana dan prasarana\";}', '2022-06-19 02:06:18', '2022-06-20 10:03:18'),
(25, 7, 'Bantuan Pemerintah', 'a:2:{i:0;s:20:\"Operasional Posyandu\";i:1;s:30:\"Pengadaan sarana dan prasarana\";}', '2022-06-19 02:06:32', '2022-06-20 10:03:06'),
(26, 7, 'Bantuan Dunia Usaha', 'a:2:{i:0;s:3:\"CSR\";i:1;s:9:\"Lain-lain\";}', '2022-06-19 02:06:55', '2022-06-20 10:01:54'),
(27, 8, 'Jumlah Kader', 'a:4:{i:0;s:17:\"Jumlah Seluruhnya\";i:1;s:11:\"Kader Aktif\";i:2;s:14:\"Kader Terlatih\";i:3;s:18:\"Tingkat Pendidikan\";}', '2022-06-19 02:07:22', '2022-06-20 10:01:31'),
(28, 8, 'Kegiatan Pokok', 'a:4:{i:0;s:17:\"Jumlah Seluruhnya\";i:1;s:11:\"Kader Aktif\";i:2;s:14:\"Kader Terlatih\";i:3;s:18:\"Tingkat Pendidikan\";}', '2022-06-19 02:07:38', '2022-06-20 10:01:16'),
(29, 8, 'Bina Keluarga Balita', 'a:4:{i:0;s:17:\"Jumlah Seluruhnya\";i:1;s:11:\"Kader Aktif\";i:2;s:14:\"Kader Terlatih\";i:3;s:18:\"Tingkat Pendidikan\";}', '2022-06-19 02:08:00', '2022-06-20 10:00:59'),
(30, 8, 'PAUD', 'a:4:{i:0;s:17:\"Jumlah Seluruhnya\";i:1;s:11:\"Kader Aktif\";i:2;s:14:\"Kader Terlatih\";i:3;s:18:\"Tingkat Pendidikan\";}', '2022-06-19 02:08:12', '2022-06-20 10:00:45'),
(31, 8, 'UP2K/UPPKS', 'a:4:{i:0;s:17:\"Jumlah Seluruhnya\";i:1;s:11:\"Kader Aktif\";i:2;s:14:\"Kader Terlatih\";i:3;s:18:\"Tingkat Pendidikan\";}', '2022-06-19 02:08:29', '2022-06-20 10:00:31'),
(32, 8, 'Lain-lain', 'a:1:{i:0;s:9:\"Lain-lain\";}', '2022-06-19 02:08:44', '2022-06-20 09:44:00'),
(33, 10, 'Kegiatan Pokok', 'a:4:{i:0;s:9:\"Ibu Hamil\";i:1;s:4:\"Bayi\";i:2;s:6:\"Balita\";i:3;s:19:\"Pasangan Usia Subur\";}', '2022-06-19 02:09:25', '2022-06-20 09:43:50'),
(34, 10, 'Bina Keluarga Sejahtera', 'a:3:{i:0;s:20:\"Bina Keluarga Balita\";i:1;s:20:\"Bina Keluarga Remaja\";i:2;s:20:\"Bina Keluarga Lansia\";}', '2022-06-19 02:09:51', '2022-06-20 09:43:25'),
(35, 10, 'PAUD', 'a:1:{i:0;s:19:\"Balita Sasaran PAUD\";}', '2022-06-19 02:10:03', '2022-06-20 09:42:22'),
(36, 10, 'UP2K/UPPKS', 'a:2:{i:0;s:13:\"Kelompok UP2K\";i:1;s:14:\"Kelompok UPPKS\";}', '2022-06-19 02:10:15', '2022-06-20 09:41:35'),
(37, 11, 'Dunia Usaha/Swasta', 'a:3:{i:0;s:16:\"Program/Kegiatan\";i:1;s:10:\"Pendamping\";i:2;s:9:\"Pendanaan\";}', '2022-06-19 02:11:31', '2022-06-20 09:41:06'),
(38, 11, 'Lembaga Kemasyarakatan/LSM', 'a:3:{i:0;s:16:\"Program/Kegiatan\";i:1;s:10:\"Pendamping\";i:2;s:9:\"Pendanaan\";}', '2022-06-19 02:11:54', '2022-06-20 09:40:44'),
(39, 12, 'KIA', 'a:5:{i:0;s:21:\"Pemeriksaan Ibu Hamil\";i:1;s:25:\"Pemberian Tablet Fe Bumil\";i:2;s:29:\"Pemberian Vitamin A Ibu Nifas\";i:3;s:3:\"IMD\";i:4;s:12:\"ASI Ekslusif\";}', '2022-06-19 02:13:16', '2022-06-20 09:40:18'),
(40, 12, 'Gizi', 'a:6:{i:0;s:27:\"Penimbangan BayI dan Balita\";i:1;s:14:\"PMT penyuluhan\";i:2;s:22:\"Penanganan BGM dan GBR\";i:3;s:26:\"Pemberian Vitamin A Balita\";i:4;s:13:\"PMT Pemulihan\";i:5;s:23:\"Pemberian Kapsul Lodium\";}', '2022-06-19 02:13:28', '2022-06-20 09:39:50'),
(41, 12, 'Immunisasi', 'a:5:{i:0;s:3:\"BCG\";i:1;s:3:\"DPT\";i:2;s:5:\"Folio\";i:3;s:9:\"Hepatitis\";i:4;s:6:\"Campak\";}', '2022-06-19 02:13:43', '2022-06-20 09:39:11'),
(42, 12, 'Keluarga Berencana', 'a:6:{i:0;s:3:\"MOW\";i:1;s:3:\"MOP\";i:2;s:3:\"IUD\";i:3;s:6:\"Suntik\";i:4;s:6:\"Implan\";i:5;s:6:\"Kondom\";}', '2022-06-19 02:14:03', '2022-06-20 09:38:34'),
(43, 12, 'Penanggulangan Diare', 'a:1:{i:0;s:20:\"Penanggulangan Diare\";}', '2022-06-19 02:14:21', '2022-06-20 09:38:01'),
(44, 12, 'PHBS Rumah Tangga', 'a:1:{i:0;s:17:\"PHBS Rumah Tangga\";}', '2022-06-19 02:14:41', '2022-06-20 09:37:12'),
(45, 13, 'Bina Keluarga Sejahtera', 'a:3:{i:0;s:20:\"Bina Keluarga Balita\";i:1;s:20:\"Bina Keluarga Remaja\";i:2;s:20:\"Bina Keluarga Lansia\";}', '2022-06-19 02:15:16', '2022-06-20 09:33:38'),
(46, 13, 'PAUD (pos paud)', 'a:1:{i:0;s:15:\"Paud (pos PAUD)\";}', '2022-06-19 02:15:43', '2022-06-20 09:32:48'),
(47, 13, 'UP2K/UPPKS', 'a:4:{i:0;s:15:\"Jumlah Kelompok\";i:1;s:14:\"Jumlah Anggota\";i:2;s:14:\"Jenis Kegiatan\";i:3;s:21:\"Jumlah Modal Bergulir\";}', '2022-06-19 02:16:00', '2022-06-20 09:32:27'),
(48, 13, 'Informasi dan Konseling', 'a:4:{i:0;s:10:\"Traficking\";i:1;s:28:\"Kekerasan Dalam Rumah Tangga\";i:2;s:31:\"Perlindungan Perempuan Dan Anak\";i:3;s:8:\"HIV/Aids\";}', '2022-06-19 02:16:18', '2022-06-20 09:31:53'),
(49, 13, 'Pelayanan lainya', '', '2022-06-19 02:16:36', '2022-06-19 02:16:36'),
(50, 14, 'KIA', 'a:6:{i:0;s:29:\"Pemberian Vitamin A Ibu Nifas\";i:1;s:12:\"ASI Ekslusif\";i:2;s:27:\"Pemeriksaan Ibu Hamil (K-1)\";i:3;s:27:\"Pemeriksaan Ibu Hamil (K-4)\";i:4;s:19:\"Pemberian Tablet Fe\";i:5;s:28:\"Inisiasi Menyusui Dini (IMD)\";}', '2022-06-19 02:16:58', '2022-06-20 09:30:15'),
(51, 14, 'Gizi', 'a:7:{i:0;s:14:\"PMT penyuluhan\";i:1;s:34:\"Bayi dan Balita Sasaran Posyandu/S\";i:2;s:26:\"Balita Yang Memiliki KMS/K\";i:3;s:34:\"Bayi dan Balita datang ditimbang/D\";i:4;s:24:\"Bayi dan Balita yang BGM\";i:5;s:34:\"Bayi dan Balita Mendapat Vitamin A\";i:6;s:30:\"Bayi dan Balita Naik Timbangan\";}', '2022-06-19 02:17:08', '2022-06-20 09:29:14'),
(52, 14, 'Immunisasi', 'a:9:{i:0;s:3:\"BCG\";i:1;s:11:\"HB 0 (HB 0)\";i:2;s:7:\"Polio I\";i:3;s:8:\"Polio II\";i:4;s:9:\"Polio III\";i:5;s:8:\"Polio IV\";i:6;s:5:\"DPT I\";i:7;s:6:\"DPT II\";i:8;s:7:\"DPT III\";}', '2022-06-19 02:17:16', '2022-06-20 09:27:18'),
(53, 14, 'Immunisasi Ibu Hamil', 'a:5:{i:0;s:4:\"TT I\";i:1;s:5:\"TT II\";i:2;s:6:\"TT III\";i:3;s:5:\"TT IV\";i:4;s:4:\"TT V\";}', '2022-06-19 02:17:35', '2022-06-20 09:26:33'),
(54, 14, 'Keluarga Berencana', 'a:7:{i:0;s:3:\"MOW\";i:1;s:3:\"MOP\";i:2;s:3:\"IUD\";i:3;s:6:\"Suntik\";i:4;s:6:\"Implan\";i:5;s:6:\"Kondom\";i:6;s:25:\"Peserta KB Aktif (CU/PUS)\";}', '2022-06-19 02:17:51', '2022-06-20 09:25:58'),
(55, 14, 'Penanggulangan Diare', 'a:2:{i:0;s:29:\"Jumlah Balita Menderita Diare\";i:1;s:34:\"Jumlah Balita Yang Mendapat Oralit\";}', '2022-06-19 02:18:05', '2022-06-20 09:24:15'),
(56, 14, 'PHBS Rumah Tangga', 'a:9:{i:0;s:32:\"Persalinan Oleh Tenaga Kesehatan\";i:1;s:22:\"Pemberian ASI Eklsusif\";i:2;s:36:\"Menimbang Bayi Dan Balita Tiap Bulan\";i:3;s:22:\"Menggunakan Air Bersih\";i:4;s:23:\"Cuci Tangan Pakai Sabun\";i:5;s:24:\"Menggunakan Jamban Sehat\";i:6;s:25:\"Memberantas Jentik Nyamuk\";i:7;s:32:\"Makan Buah dan Sayur Setiap Hari\";i:8;s:27:\"Tidak Merokok didalam Rumah\";}', '2022-06-19 02:18:27', '2022-06-20 09:23:33'),
(57, 14, 'Sanitasi', 'a:3:{i:0;s:11:\"Rumah Sakit\";i:1;s:15:\"Jamban Keluarga\";i:2;s:4:\"SPAL\";}', '2022-06-19 02:18:40', '2022-06-20 09:22:03'),
(58, 15, 'Bina Keluarga Sejahtera', 'a:3:{i:0;s:20:\"Bina Keluarga Balita\";i:1;s:20:\"Bina Keluarga Remaja\";i:2;s:20:\"Bina Keluarga Lansia\";}', '2022-06-19 02:19:16', '2022-06-20 09:21:36'),
(59, 15, 'PAUD', 'a:1:{i:0;s:15:\"Paud (pos PAUD)\";}', '2022-06-19 02:19:31', '2022-06-20 09:21:18'),
(60, 15, 'UP2K/UPPKS', 'a:4:{i:0;s:14:\"Jenis Kegiatan\";i:1;s:27:\"Perkembangan Kelompok Aktif\";i:2;s:26:\"Perkembangan Anggota Aktif\";i:3;s:27:\"Perkembangan Modal Bergulir\";}', '2022-06-19 02:19:40', '2022-06-20 09:21:02'),
(61, 15, 'Informasi dan Konseling', 'a:10:{i:0;s:21:\"Penyuluhan Traficking\";i:1;s:15:\"Penyuluhan KDRT\";i:2;s:33:\"Penyuluhan Perlindungan Perempuan\";i:3;s:19:\"Penyuluhan HIV/Aids\";i:4;s:10:\"Penyuluhan\";i:5;s:20:\"Konseling Traficking\";i:6;s:14:\"Konseling KDRT\";i:7;s:32:\"Konseling Perlindungan Perempuan\";i:8;s:18:\"Konseling HIV/Aids\";i:9;s:9:\"Konseling\";}', '2022-06-19 02:19:50', '2022-06-20 09:18:33'),
(62, 15, 'Pemanfaatan Pekarangan', 'a:4:{i:0;s:26:\"Perkembangan Kelompok TOGA\";i:1;s:31:\"Perkembangan Kelompok Pertanian\";i:2;s:33:\"Perkembangan Kelompok Perternakan\";i:3;s:31:\"Perkembangan Kelompok Perikanan\";}', '2022-06-19 02:20:11', '2022-06-20 09:16:20'),
(64, 16, 'Kasus Kematian Ibu Melahirkan', 'a:1:{i:0;s:16:\"1 tahun Terakhir\";}', '2022-06-19 02:20:56', '2022-06-20 09:14:07'),
(65, 16, 'Kasus Kematian Bayi Neo Natal', 'a:1:{i:0;s:16:\"1 tahun Terakhir\";}', '2022-06-19 02:21:20', '2022-06-20 09:14:00'),
(66, 16, 'Kasus Kematian Bayi 1 - 12 bulan', 'a:1:{i:0;s:16:\"1 tahun Terakhir\";}', '2022-06-19 02:21:43', '2022-06-20 09:13:49'),
(67, 16, 'Kasus Kematian Balita 13 - 60 bulan', 'a:1:{i:0;s:16:\"1 tahun Terakhir\";}', '2022-06-19 02:22:04', '2022-06-20 09:56:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `gender`, `dob`, `phone`, `token`, `token_expired`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Dicki Prasetya', 'semenjakpetang176@gmail.com', '$2y$10$vjPEhhwAtEyoEz4M4HX8.OhoeZhtP7Pg.xki7xUHPny.R3uEpvfiu', 'default.jpg', 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'super-admin'),
(2, 'Petugas', 'coba1@gmail.com', '$2y$10$baVDaeR1SRV/UXk7vWthd.w/LuV5DUOrYRRmCfsTSmP51q7/HvEIi', 'default.jpg', 'Laki-Laki', NULL, NULL, NULL, NULL, NULL, NULL, 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tb_attribut`
--
ALTER TABLE `tb_attribut`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_subkategori`
--
ALTER TABLE `tb_subkategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_attribut`
--
ALTER TABLE `tb_attribut`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_subkategori`
--
ALTER TABLE `tb_subkategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
