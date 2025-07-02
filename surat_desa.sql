-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2025 at 01:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `kode`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(3, 'SKTM', 'SURAT KETERANGAN TIDAK MAMPU', 'bagi orang yang tidak mampu', '2025-06-25 18:48:24', '2025-06-25 18:48:24'),
(4, 'SKD', 'SURAT KETERANGAN DOMOSILI', 'SURAT KETERANGAN DOMOSILI', '2025-06-25 18:58:47', '2025-06-25 18:58:47'),
(5, 'SKU', 'SURAT KETERANGAN USAHA', 'SURAT KETERANGAN USAHA', '2025-06-25 18:59:20', '2025-06-25 18:59:20'),
(7, 'SKDL', 'SURAT KETERANGAN DOMISILI LEMBAGA', 'SURAT KETERANGAN DOMISILI LEMBAGA', '2025-06-25 19:57:11', '2025-06-26 06:50:36'),
(8, 'SKC', 'SURAT KETERANGAN CERAI', 'sudah gakuat sama istri satu ini dan ingin ganti istri', '2025-06-26 07:16:04', '2025-06-26 07:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_25_122818_create_residents_table', 1),
(5, '2025_06_25_123117_create_jenis_surats_table', 1),
(6, '2025_06_25_123449_create_surat_pengajuans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED DEFAULT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `users_id`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_perkawinan`, `pekerjaan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `created_at`, `updated_at`) VALUES
(6, 5, '1234567891234567', 'Ijat', 'Sukabumi', '2003-07-02', 'L', 'Kp.Batununggul RT 001 RW 001 Desa Karangmekar Kec. Cimanggu Kab. Suakbumi Prov. Jawa Barat', 'Isalam', 'Kawin', 'Wiraswasta', 'Indonesia', 'Ajat', 'Inar', '2025-06-27 08:32:31', '2025-06-27 08:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kTs8O6oFzRcf9BvA4kunWoZ6w3hnhqRdesK6Srcg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3loS29SVVc5bVFWeWh5dUFHZHVIR2xRVlZKRkpmc0dHaXFyd3I3MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXJhdC1wZW5nYWp1YW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1751119134);

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengajuan`
--

CREATE TABLE `surat_pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_residents` bigint UNSIGNED NOT NULL,
  `id_jenis_surat` bigint UNSIGNED NOT NULL,
  `nomor_surat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_disetujui` date DEFAULT NULL,
  `status` enum('diajukan','diproses','ditolak','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_pengajuan`
--

INSERT INTO `surat_pengajuan` (`id`, `id_residents`, `id_jenis_surat`, `nomor_surat`, `tanggal_pengajuan`, `tanggal_disetujui`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(22, 6, 3, '001', '2025-06-27', '2025-06-27', 'selesai', 'Miskin Banyak Gaya', '2025-06-27 08:32:31', '2025-06-27 08:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('warga','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'warga',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$5U36O3v1CCLxbK1reOyRIOgZEO.k1u3kj.ATiKaB5ELiXvoaGSwSK', 'admin', '2025-06-25 06:17:23', '2025-06-25 06:17:23'),
(4, 'rezacn', '$2y$12$mO/sw.ZkeNNEQtqPKQ27xeUOalbeStgDVAeBnqlV0h6SvTPR31Cqe', 'warga', '2025-06-25 06:58:19', '2025-06-25 06:58:19'),
(5, 'ijat', '$2y$12$D8i2rS5gG5lpjbPhF5MgReo4tx46lCAFwEwc.INcatfw9Oh0Z0f9e', 'warga', '2025-06-26 18:46:01', '2025-06-27 03:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_surat_kode_unique` (`kode`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `residents_nik_unique` (`nik`),
  ADD KEY `residents_users_id_foreign` (`users_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `surat_pengajuan`
--
ALTER TABLE `surat_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_pengajuan_id_residents_foreign` (`id_residents`),
  ADD KEY `surat_pengajuan_id_jenis_surat_foreign` (`id_jenis_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_pengajuan`
--
ALTER TABLE `surat_pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `surat_pengajuan`
--
ALTER TABLE `surat_pengajuan`
  ADD CONSTRAINT `surat_pengajuan_id_jenis_surat_foreign` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_pengajuan_id_residents_foreign` FOREIGN KEY (`id_residents`) REFERENCES `residents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
