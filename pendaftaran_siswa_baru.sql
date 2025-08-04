-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 11:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_siswa_baru`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Alfa','Sakit') NOT NULL DEFAULT 'Alfa',
  `keterangan` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lokasi` point DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `siswa_id`, `semester`, `tanggal`, `status`, `keterangan`, `gambar`, `created_at`, `updated_at`, `lokasi`) VALUES
(1, 1, '1', '2024-09-16', 'Hadir', 'hadir', '0g0xFEhz1g.png', '2024-09-16 01:25:01', '2024-09-16 01:25:01', 0x000000000101000000ee77280af4ec5a40ddcd531d72631cc0),
(2, 1, '1', '2024-09-17', 'Hadir', 'saya hadir sedang di sekolah', '1jiUHdhmQN.png', '2024-09-16 20:12:12', '2024-09-16 20:12:12', 0x0000000001010000007461a417f5ec5a40b9bf7adcb7621cc0),
(3, 1, '1', '2024-09-18', 'Hadir', 'hadir hari ini', '50kJzmriqC.png', '2024-09-17 23:38:16', '2024-09-17 23:38:16', 0x000000000101000000655157c944e95a4006718040b8c71bc0),
(4, 3, '1', '2024-09-19', 'Hadir', 'ubay hadir', 'y0PTnnReoi.png', '2024-09-18 20:20:22', '2024-09-18 20:20:22', 0x0000000001010000001d554d10f5ec5a40b14f00c5c8621cc0),
(5, 6, '1', '2024-09-19', 'Sakit', 'hadir hari ini', 'jbS10tJZte.png', '2024-09-18 21:37:38', '2024-09-18 21:37:38', 0x000000000101000000b3f54b9ce7ec5a40f56156e2d6631cc0),
(6, 6, '1', '2024-09-24', 'Hadir', 'hadir hari ini', 'Cls7ozyc8I.png', '2024-09-23 19:22:24', '2024-09-23 19:22:24', 0x00000000010100000088635ddc46e75a403333333333b31bc0),
(7, 6, '1', '2024-10-07', 'Hadir', 'hadir', 'cfSHj80f3d.png', '2024-10-06 10:56:14', '2024-10-06 10:56:14', 0x00000000010100000043e21e4b1fed5a4091b41b7dcc671cc0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan_perkembangan_anak`
--

CREATE TABLE `catatan_perkembangan_anak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `dataakademik_id` bigint(20) UNSIGNED NOT NULL,
  `absensi_id` bigint(20) UNSIGNED NOT NULL,
  `kehadiran` int(11) NOT NULL DEFAULT 0,
  `catatan_khusus` text DEFAULT NULL,
  `tanggapan_orang_tua` text DEFAULT NULL,
  `tanggal_pencatatan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `date_akademik_paud`
--

CREATE TABLE `date_akademik_paud` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` bigint(20) UNSIGNED NOT NULL,
  `perkembangan_fisik` text DEFAULT NULL,
  `perkembangan_kognitif` text DEFAULT NULL,
  `perkembangan_sosial_emosional` text DEFAULT NULL,
  `perkembangan_bahasa` text DEFAULT NULL,
  `kegiatan_belajar` text NOT NULL,
  `semester` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `nilai_fisik` varchar(255) NOT NULL,
  `nilai_kognitif` varchar(255) NOT NULL,
  `nilai_sosial` varchar(255) NOT NULL,
  `nilai_bahasa` varchar(255) NOT NULL,
  `nilai_belajar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `date_akademik_paud`
--

INSERT INTO `date_akademik_paud` (`id`, `siswa_id`, `guru_id`, `perkembangan_fisik`, `perkembangan_kognitif`, `perkembangan_sosial_emosional`, `perkembangan_bahasa`, `kegiatan_belajar`, `semester`, `tahun_ajaran`, `nilai_fisik`, `nilai_kognitif`, `nilai_sosial`, `nilai_bahasa`, `nilai_belajar`, `created_at`, `updated_at`, `jumlah`, `grade`) VALUES
(1, 3, 5, 'kurang baik', 'baik', 'buruk', 'buruk', 'buruk sekali', '1', '2024/2025', '60', '60', '50', '50', '50', '2024-08-11 21:10:35', '2024-09-24 09:28:43', 53, 'D'),
(3, 1, 5, 'baik', 'baik', 'baik', 'baik', 'baik', '1', '2024/2025', '85', '80', '70', '75', '85', '2024-08-11 21:48:34', '2024-08-11 21:48:34', 79, 'B'),
(4, 2, 5, 'kurang baik', 'kurang baik', 'kurang baik', 'kurang baik', 'lebih ditingkatkan lagi', '1', '2024/2025', '75', '70', '70', '60', '70', '2024-08-14 20:03:46', '2024-08-27 21:32:52', 67, 'C'),
(5, 3, 5, 'baik sekali', 'baik sekali', 'baik sekali', 'baik sekali', 'baik sekali', '2', '2024/2025', '80', '80', '95', '90', '85', '2024-08-25 21:30:52', '2024-08-25 21:30:52', 87, 'A'),
(6, 1, 5, 'kurang baik', 'kurang baik', 'kurang baik', 'kurang baik', 'kurang baik', '2', '2024/2025', '60', '75', '78', '70', '80', '2024-08-25 21:35:06', '2024-08-25 21:35:06', 75, 'B'),
(7, 6, 5, 'bagus sekali', 'bagus sekali', 'bagus sekali', 'bagus sekali', 'bagus sekali', '1', '2025/2026', '80', '75', '75', '89', '87', '2024-09-18 21:35:57', '2025-01-18 10:32:14', 82, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `email`, `password`, `tgl_lahir`, `foto`, `jenkel`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, '2234892828', 'Guru 1', 'guru@gmail.com', '$2y$12$.5k.JyGUG.Xm.64fO7wOeORSSiEdr1cNzQ0MKP.JoQVkyv9KkUwj6', '1987-09-12', 'ZwTyfP2pTrnPpbWoLBPlacGIBTLcpy3rkBSEjmmo.png', 'Perempuan', 'kp babakan sari', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_07_07_132217_create_users_tabel', 1),
(2, '2024_07_07_132333_create_chace_tabel', 1),
(3, '2024_07_07_132425_create_jobs_tabel', 1),
(4, '2024_07_08_121003_add_role_to_users_table', 2),
(5, '2024_07_22_025747_create_siswa_table', 3),
(6, '2024_07_22_033022_add_nis_to_siswa_table', 3),
(7, '2024_08_08_025438_create_data_akademik_paud_table', 4),
(8, '2024_08_10_014253_create_data_akademik_pauds_table', 5),
(9, '2024_09_12_023742_create_absensi_table', 6),
(10, '2024_11_13_025416_table_catatan_perkembangan_anak', 7),
(11, '2024_11_13_025416_table_pembayaran', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orantua`
--

CREATE TABLE `orantua` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomertelepon` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orantua`
--

INSERT INTO `orantua` (`id`, `nik`, `nama`, `email`, `password`, `nomertelepon`, `foto`, `jenkel`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '4103499902222', 'jajang abdullah', 'jajang@gmail.com', '$2y$12$lPpTmd7/iuem1GYoAwG1jO5tJ3n26/7.HiPNIU/CismC4BqaY/0YC', '0873346718997', 'fVE1OprYb9MpfSzlDdJThgwSuUHE0e0sjlZFfqxF.jpg', 'Laki-Laki', 'jakarta, indonesia', NULL, NULL, '2024-08-07 18:18:15'),
(2, '410349982929', 'saipul', 'saipul@gmail.com', '$2y$12$g57zTYayqWo.J/DApZ5E7u0luvq4JsB7RyrkDCxApgNyC9vmCB8y2', '0837781919', '200ONA2W1sTFb4TLVLrxasy591FkujO0IbIKSX2n.jpg', 'Perempuan', 'jakarta', NULL, NULL, NULL),
(4, '41034999022990', 'humaira', 'humaira@gmail.com', '$2y$12$FvhC9pE1U8Iq9RUvHABDve7zq7VyIz40jHYK3LcD4.JnXTTVVFl1i', '08955478199', 'h0rEgXkynf8yDiVuHfYHm3K1TDmTbbKVtqBlbkO6.jpg', 'Perempuan', 'ciberem, kertasari', NULL, NULL, NULL),
(7, '2333449', 'habibul ahkam', 'haibubul@gmail.com', '$2y$12$27Uze4WYtVDoYBSk1JsiX.2wu/Yi8367fIFoXMfI0hhas7z/l.utu', '087553718880', 'Sk0XyGINNDFg8UK9se4DzFvVlqpHls31wd5cGJr3.jpg', 'Laki-Laki', 'kp babakan ancol, no 40', NULL, NULL, NULL),
(8, '3100078292929', 'mamah deti', 'mamahdeti@gmail.com', '$2y$12$6CtJQsSHtu/6wWZ08dnuqeWEJsviAIFJ0H0zc7tJDe/hvRA02lFMe', '085795138137', '4SXPA8m2Re4OSqTh2yYhuv4ov4xISfCWM78bIQ3D.jpg', 'Perempuan', 'kabupaten bandung, kecamatan pacet, desa mekarjaya RT01/RW01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `tanggal_tagihan` date DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('LUNAS','BELUM','MENUNGGU') NOT NULL DEFAULT 'BELUM',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R79CiFRSfryebNFaJRRF4eyZHA5SVC4oQUoonFin', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFZPMkI5dlRVV0pIejRzMlFxRU5WSDhpcFMySkMxbHNhdGJZYms1RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1752077846);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `usia` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `orangtua_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `tgl_lahir`, `usia`, `jenis_kelamin`, `foto`, `orangtua_id`, `created_at`, `updated_at`) VALUES
(1, '2024005890', 'khoerul', '2024-07-01', '5 tahun', 'Laki-Laki', 'y6hKQRUb9kjYllDjLcfONItx4q6ygfwHgPOZApiK.jpg', 1, NULL, NULL),
(2, '4190020', 'raina', '2024-07-24', '5 tahun', 'Perempuan', '3PVwss84xoVZpF3VsYq98q8GuFjByT8KbeTW9wz5.png', 2, NULL, NULL),
(3, '223100993', 'hanin', '2017-08-21', '4 tahun', 'Perempuan', '41R2IUfo0Qs8qbrxZHMVNQdMOnCu1XZU89OFmsOh.jpg', 4, NULL, NULL),
(6, '344949499', 'Rifansyah Hidayatullah', '2019-06-20', '5 tahun', 'Laki-Laki', '2oYtYweXyGxy1jtvFd2MWGIBJh4VMF4jgjN3MV5M.jpg', 7, NULL, NULL),
(7, '4103930300', 'Rifansyah Hidayatullah', '2018-09-12', '5 tahun', 'Perempuan', 'yXPihObiDW4oovOxiQdqoxA3Vj56cBf7aHrp3MfY.jpg', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `alamat`, `foto`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rakha Muhammad Nauval', 'rakha@gmail.com', NULL, '$2y$12$U3I/Jt0wRbHIfPZYVbVwJuJp8ERp86iLBnkSQa0b..qYsaP0Fl496', 'kabupaten bandung, kecamatan pacet, desa mekarsari RT01/RW01', 'UtLxJOlfsLGL9ReUhGllHOEGmfC0ST0DPPp2aRno.jpg', 'admin', NULL, '2024-07-09 07:56:30', '2024-07-09 07:56:30'),
(2, 'Rakha Muhammad Nauval', 'rakha33@gmail.com', NULL, '$2y$12$BQj2C1AIRz.RZcAoZDIY2ui8myZaBWLgjlvdIjL/cDMyvtvGFcJxS', 'Pasir Koja, Kota Bandung', '9vETjkZYkgkQOvdr7A0b3mEvGL1H5Tj2bOWNkmBm.jpg', 'admin', NULL, '2025-05-21 05:20:26', '2025-05-21 05:20:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `catatan_perkembangan_anak`
--
ALTER TABLE `catatan_perkembangan_anak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catatan_perkembangan_anak_siswa_id_foreign` (`siswa_id`),
  ADD KEY `catatan_perkembangan_anak_dataakademik_id_foreign` (`dataakademik_id`),
  ADD KEY `catatan_perkembangan_anak_absensi_id_foreign` (`absensi_id`);

--
-- Indexes for table `date_akademik_paud`
--
ALTER TABLE `date_akademik_paud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_akademik_paud_siswa_id_foreign` (`siswa_id`),
  ADD KEY `date_akademik_paud_guru_id_foreign` (`guru_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_nip_unique` (`nip`),
  ADD UNIQUE KEY `guru_email_unique` (`email`);

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
-- Indexes for table `orantua`
--
ALTER TABLE `orantua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orantua_nik_unique` (`nik`),
  ADD UNIQUE KEY `orantua_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `catatan_perkembangan_anak`
--
ALTER TABLE `catatan_perkembangan_anak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `date_akademik_paud`
--
ALTER TABLE `date_akademik_paud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orantua`
--
ALTER TABLE `orantua`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan_perkembangan_anak`
--
ALTER TABLE `catatan_perkembangan_anak`
  ADD CONSTRAINT `catatan_perkembangan_anak_absensi_id_foreign` FOREIGN KEY (`absensi_id`) REFERENCES `absensi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catatan_perkembangan_anak_dataakademik_id_foreign` FOREIGN KEY (`dataakademik_id`) REFERENCES `date_akademik_paud` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catatan_perkembangan_anak_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `date_akademik_paud`
--
ALTER TABLE `date_akademik_paud`
  ADD CONSTRAINT `date_akademik_paud_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `date_akademik_paud_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
