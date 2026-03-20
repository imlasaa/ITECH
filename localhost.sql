-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2026 at 04:10 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itech`
--
CREATE DATABASE IF NOT EXISTS `itech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `itech`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@itech.ac.id', '$2y$12$ylyXoujClEUJ5mmFDhSRee2T5Vlv.9e9a2Gc2vPQPiirZ2SJ8QryS', NULL, '2026-03-11 02:13:38', '2026-03-11 05:18:10');

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
-- Table structure for table `daftar_ulang`
--

CREATE TABLE `daftar_ulang` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `surat_pernyataan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_keterangan_sehat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kartu_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_berkas` enum('pending','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_berkas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_ulang`
--

INSERT INTO `daftar_ulang` (`id`, `user_id`, `surat_pernyataan`, `pas_foto`, `surat_keterangan_sehat`, `kartu_keluarga`, `status_berkas`, `catatan_berkas`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'daftar-ulang/pas-foto/8thxgokfCI9KZjGfac7n2JcciOELobVomNY22F25.jpg', NULL, 'daftar-ulang/kk/HwuxEMvYaeBggvsX6PUOmhLp6wgKrt9wFdTey5HB.jpg', 'diterima', NULL, '2026-03-10 23:17:03', '2026-03-11 06:40:25'),
(2, 5, NULL, 'daftar-ulang/pas-foto/S0rJzTRGrKvgvaMbBR8RZhX4MeedA6qH2imJNysP.jpg', NULL, NULL, 'diterima', NULL, '2026-03-16 18:11:40', '2026-03-16 20:14:53'),
(3, 7, NULL, 'daftar-ulang/pas-foto/cHtjSfbLXTZ5JfZvnEEapTR2g4oah0Av6GwrVEIf.jpg', NULL, NULL, 'diterima', NULL, '2026-03-16 23:51:22', '2026-03-16 23:52:00'),
(4, 8, NULL, 'daftar-ulang/pas-foto/6Pc2D8S98BhTDJNVw3bThKf7V2RgMQ7jYowGmY0Y.jpg', NULL, NULL, 'diterima', NULL, '2026-03-17 00:59:47', '2026-03-17 01:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `data_pribadi`
--

CREATE TABLE `data_pribadi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pribadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `provinsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ortu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_ortu` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pribadi`
--

INSERT INTO `data_pribadi` (`id`, `user_id`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `email_pribadi`, `alamat`, `provinsi`, `kota`, `kode_pos`, `asal_sekolah`, `tahun_lulus`, `nama_ortu`, `pekerjaan_ortu`, `no_hp_ortu`, `program_studi_id`, `created_at`, `updated_at`) VALUES
(2, 3, '1234567891012131', 'lasa', 'batang', '2004-08-31', 'P', 'Islam', '085894387984', 'lasa@gmail.com', 'Jalan Swadaya I', 'Prov. D.K.I. Jakarta', 'Kota Adm. Jakarta Selatan', '12510', 'smk 65', '2026', 'rosa', 'bisnis', '085894387984', 1, '2026-03-10 21:33:03', '2026-03-19 07:24:04'),
(3, 5, '1234567891512131', 'makoto', 'Kota Adm. Jakarta Selatan', '2007-08-31', 'L', 'Islam', '085894387982', 'makoto@gmail.com', 'Jalan Swadaya I', 'Prov. D.K.I. Jakarta', 'Kota Adm. Jakarta Selatan', '12510', 'smk 65', '2026', 'rosa', 'bisnis', '085894387980', 3, '2026-03-16 18:08:12', '2026-03-19 07:23:42'),
(5, 7, '1234567894212131', 'Irish', 'Kota Adm. Jakarta Selatan', '2006-08-31', 'P', 'Islam', '085894387989', 'iris@gmail.com', 'Jalan Swadaya I', 'Prov. D.K.I. Jakarta', 'Kota Adm. Jakarta Selatan', '12510', 'smk 65', '2026', 'rosa', 'bisnis', '085894387989', 3, '2026-03-16 23:09:32', '2026-03-16 23:17:23'),
(6, 8, '1234567899876543', 'sukuna', 'Kota Adm. Jakarta Selatan', '0777-03-23', 'L', 'Islam', '085894387984', 'sukunarajakutukan@gmail.com', 'Jalan Swadaya I', 'Prov. D.K.I. Jakarta', 'Kota Adm. Jakarta Selatan', '12510', 'smk 65', '2000', 'yuji itadori', 'pemburu kutukan', '0899999999', 2, '2026-03-17 00:53:18', '2026-03-19 07:23:28'),
(9, 11, NULL, 'Roth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2026-03-18 08:48:16', '2026-03-18 08:48:16'),
(11, 12, NULL, 'Lionel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-03-19 01:27:58', '2026-03-19 01:27:58'),
(12, 13, '1234572831012130', 'Rena', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2026-03-19 03:07:44', '2026-03-19 03:07:44'),
(13, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2026-03-19 07:51:01', '2026-03-19 07:51:01'),
(14, 15, '5567678778777788', 'aim fov', 'Kota Adm. Jakarta Selatan', '1999-03-07', 'L', 'Islam', '085894387984', 'aimfov444@gmail.com', 'Jalan Swadaya I', 'Prov. D.K.I. Jakarta', 'Kota Adm. Jakarta Selatan', '12510', NULL, NULL, NULL, NULL, NULL, 1, '2026-03-19 08:06:00', '2026-03-19 08:06:29');

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
-- Table structure for table `hasil_ujian`
--

CREATE TABLE `hasil_ujian` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_soal` int NOT NULL DEFAULT '0',
  `jawaban_benar` int NOT NULL DEFAULT '0',
  `jawaban_salah` int NOT NULL DEFAULT '0',
  `nilai` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status` enum('lulus','tidak_lulus','belum_dinilai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_dinilai',
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_ujian`
--

INSERT INTO `hasil_ujian` (`id`, `user_id`, `total_soal`, `jawaban_benar`, `jawaban_salah`, `nilai`, `status`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(2, 3, 10, 8, 2, 80.00, 'lulus', '2026-03-11 05:56:23', '2026-03-11 05:57:38', '2026-03-10 22:56:23', '2026-03-10 22:57:38'),
(3, 5, 14, 9, 5, 64.29, 'lulus', '2026-03-17 01:09:09', '2026-03-17 01:10:39', '2026-03-16 18:09:09', '2026-03-16 18:10:39'),
(5, 7, 15, 10, 5, 66.67, 'tidak_lulus', '2026-03-17 06:41:14', '2026-03-17 06:42:30', '2026-03-16 23:41:14', '2026-03-18 09:51:55'),
(10, 8, 15, 10, 5, 66.67, 'lulus', '2026-03-17 07:53:50', '2026-03-17 07:57:21', '2026-03-17 00:53:50', '2026-03-17 00:57:21'),
(11, 8, 15, 0, 0, 0.00, 'lulus', '2026-03-17 07:53:52', '2026-03-17 08:23:52', '2026-03-17 00:53:52', '2026-03-18 05:42:59'),
(15, 11, 15, 0, 0, 0.00, 'lulus', '2026-03-18 15:48:34', '2026-03-18 15:48:43', '2026-03-18 08:48:34', '2026-03-18 08:49:45'),
(17, 12, 15, 0, 0, 0.00, 'tidak_lulus', '2026-03-19 09:00:38', '2026-03-19 09:00:45', '2026-03-19 02:00:38', '2026-03-19 02:02:06'),
(18, 13, 15, 0, 0, 0.00, 'lulus', '2026-03-19 10:07:55', '2026-03-19 10:08:02', '2026-03-19 03:07:55', '2026-03-19 03:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_ujian`
--

CREATE TABLE `jawaban_ujian` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `soal_ujian_id` bigint UNSIGNED NOT NULL,
  `jawaban` enum('a','b','c','d','e') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jawaban_ujian`
--

INSERT INTO `jawaban_ujian` (`id`, `user_id`, `soal_ujian_id`, `jawaban`, `is_correct`, `created_at`, `updated_at`) VALUES
(11, 3, 10, 'e', 1, '2026-03-10 22:56:23', '2026-03-10 22:56:36'),
(13, 3, 7, 'a', 0, '2026-03-10 22:56:23', '2026-03-10 22:56:57'),
(14, 3, 3, 'c', 1, '2026-03-10 22:56:23', '2026-03-10 22:57:05'),
(15, 3, 1, 'a', 1, '2026-03-10 22:56:23', '2026-03-10 22:57:08'),
(16, 3, 8, 'c', 1, '2026-03-10 22:56:23', '2026-03-10 22:57:12'),
(17, 3, 4, 'b', 1, '2026-03-10 22:56:23', '2026-03-10 22:57:18'),
(18, 3, 2, 'a', 0, '2026-03-10 22:56:23', '2026-03-10 22:57:21'),
(19, 3, 6, 'a', 1, '2026-03-10 22:56:24', '2026-03-10 22:57:24'),
(20, 3, 9, 'b', 1, '2026-03-10 22:56:24', '2026-03-10 22:57:31'),
(21, 5, 7, 'a', 0, '2026-03-16 18:09:09', '2026-03-16 18:09:23'),
(22, 5, 11, 'a', 1, '2026-03-16 18:09:09', '2026-03-16 18:09:34'),
(23, 5, 1, 'a', 1, '2026-03-16 18:09:09', '2026-03-16 18:09:40'),
(24, 5, 12, 'a', 0, '2026-03-16 18:09:09', '2026-03-16 18:09:44'),
(25, 5, 6, 'a', 1, '2026-03-16 18:09:10', '2026-03-16 18:09:48'),
(26, 5, 15, 'a', 0, '2026-03-16 18:09:10', '2026-03-16 18:09:54'),
(27, 5, 4, 'b', 1, '2026-03-16 18:09:10', '2026-03-16 18:09:59'),
(28, 5, 9, 'b', 1, '2026-03-16 18:09:10', '2026-03-16 18:10:02'),
(29, 5, 13, 'c', 1, '2026-03-16 18:09:10', '2026-03-16 18:10:09'),
(30, 5, 2, 'a', 0, '2026-03-16 18:09:10', '2026-03-16 18:10:13'),
(31, 5, 8, 'c', 1, '2026-03-16 18:09:10', '2026-03-16 18:10:19'),
(32, 5, 10, 'a', 0, '2026-03-16 18:09:11', '2026-03-16 18:10:23'),
(33, 5, 3, 'c', 1, '2026-03-16 18:09:11', '2026-03-16 18:10:29'),
(34, 5, 14, 'b', 1, '2026-03-16 18:09:11', '2026-03-16 18:10:34'),
(49, 7, 7, 'a', 0, '2026-03-16 23:41:14', '2026-03-16 23:41:19'),
(50, 7, 11, 'a', 1, '2026-03-16 23:41:14', '2026-03-16 23:41:26'),
(51, 7, 13, 'c', 1, '2026-03-16 23:41:14', '2026-03-16 23:41:30'),
(52, 7, 12, 'a', 0, '2026-03-16 23:41:14', '2026-03-16 23:41:35'),
(53, 7, 8, 'c', 1, '2026-03-16 23:41:15', '2026-03-16 23:41:43'),
(54, 7, 3, 'c', 1, '2026-03-16 23:41:15', '2026-03-16 23:41:46'),
(55, 7, 14, 'b', 1, '2026-03-16 23:41:15', '2026-03-16 23:41:54'),
(56, 7, 1, 'a', 1, '2026-03-16 23:41:15', '2026-03-16 23:41:57'),
(57, 7, 6, 'a', 1, '2026-03-16 23:41:15', '2026-03-16 23:42:01'),
(58, 7, 9, 'b', 1, '2026-03-16 23:41:15', '2026-03-16 23:42:04'),
(59, 7, 15, 'a', 0, '2026-03-16 23:41:15', '2026-03-16 23:42:07'),
(60, 7, 4, 'b', 1, '2026-03-16 23:41:15', '2026-03-16 23:42:10'),
(61, 7, 16, 'a', 1, '2026-03-16 23:41:16', '2026-03-16 23:42:13'),
(62, 7, 10, 'a', 0, '2026-03-16 23:41:16', '2026-03-16 23:42:17'),
(63, 7, 2, 'a', 0, '2026-03-16 23:41:16', '2026-03-16 23:42:24'),
(97, 8, 2, 'a', 0, '2026-03-17 00:53:52', '2026-03-17 00:54:05'),
(98, 8, 4, 'b', 1, '2026-03-17 00:53:52', '2026-03-17 00:54:30'),
(99, 8, 16, 'a', 1, '2026-03-17 00:53:52', '2026-03-17 00:54:43'),
(100, 8, 11, 'a', 1, '2026-03-17 00:53:53', '2026-03-17 00:55:00'),
(101, 8, 7, 'a', 0, '2026-03-17 00:53:53', '2026-03-17 00:55:16'),
(102, 8, 9, 'b', 1, '2026-03-17 00:53:53', '2026-03-17 00:55:26'),
(103, 8, 8, 'c', 1, '2026-03-17 00:53:53', '2026-03-17 00:55:38'),
(104, 8, 13, 'c', 1, '2026-03-17 00:53:53', '2026-03-17 00:55:45'),
(105, 8, 1, 'a', 1, '2026-03-17 00:53:53', '2026-03-17 00:56:00'),
(106, 8, 15, 'a', 0, '2026-03-17 00:53:53', '2026-03-17 00:56:16'),
(107, 8, 3, 'c', 1, '2026-03-17 00:53:53', '2026-03-17 00:56:25'),
(108, 8, 6, 'a', 1, '2026-03-17 00:53:53', '2026-03-17 00:56:40'),
(109, 8, 10, 'a', 0, '2026-03-17 00:53:53', '2026-03-17 00:56:52'),
(110, 8, 12, 'a', 0, '2026-03-17 00:53:54', '2026-03-17 00:57:05'),
(111, 8, 14, 'b', 1, '2026-03-17 00:53:54', '2026-03-17 00:57:13'),
(157, 11, 11, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(158, 11, 15, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(159, 11, 13, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(160, 11, 3, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(161, 11, 4, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(162, 11, 9, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(163, 11, 14, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(164, 11, 16, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(165, 11, 12, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(166, 11, 6, NULL, 0, '2026-03-18 08:48:34', '2026-03-18 08:48:34'),
(167, 11, 8, NULL, 0, '2026-03-18 08:48:35', '2026-03-18 08:48:35'),
(168, 11, 10, NULL, 0, '2026-03-18 08:48:35', '2026-03-18 08:48:35'),
(169, 11, 2, NULL, 0, '2026-03-18 08:48:35', '2026-03-18 08:48:35'),
(170, 11, 7, NULL, 0, '2026-03-18 08:48:35', '2026-03-18 08:48:35'),
(171, 11, 1, NULL, 0, '2026-03-18 08:48:35', '2026-03-18 08:48:35'),
(187, 12, 1, NULL, 0, '2026-03-19 02:00:38', '2026-03-19 02:00:38'),
(188, 12, 8, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(189, 12, 7, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(190, 12, 9, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(191, 12, 3, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(192, 12, 12, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(193, 12, 6, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(194, 12, 10, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(195, 12, 2, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(196, 12, 4, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(197, 12, 14, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(198, 12, 15, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(199, 12, 16, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(200, 12, 11, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(201, 12, 13, NULL, 0, '2026-03-19 02:00:39', '2026-03-19 02:00:39'),
(202, 13, 6, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(203, 13, 9, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(204, 13, 1, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(205, 13, 8, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(206, 13, 16, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(207, 13, 2, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(208, 13, 13, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(209, 13, 11, NULL, 0, '2026-03-19 03:07:55', '2026-03-19 03:07:55'),
(210, 13, 12, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(211, 13, 15, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(212, 13, 3, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(213, 13, 14, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(214, 13, 4, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(215, 13, 7, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56'),
(216, 13, 10, NULL, 0, '2026-03-19 03:07:56', '2026-03-19 03:07:56');

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
-- Table structure for table `mahasiswa_aktif`
--

CREATE TABLE `mahasiswa_aktif` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_studi_id` bigint UNSIGNED NOT NULL,
  `tahun_masuk` year NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa_aktif`
--

INSERT INTO `mahasiswa_aktif` (`id`, `user_id`, `nim`, `program_studi_id`, `tahun_masuk`, `pas_foto`, `created_at`, `updated_at`) VALUES
(1, 3, 'ITECH20260001', 1, '2026', 'daftar-ulang/pas-foto/8thxgokfCI9KZjGfac7n2JcciOELobVomNY22F25.jpg', '2026-03-11 06:40:25', '2026-03-11 06:40:25'),
(7, 5, 'ITECH20260002', 3, '2026', 'daftar-ulang/pas-foto/S0rJzTRGrKvgvaMbBR8RZhX4MeedA6qH2imJNysP.jpg', '2026-03-16 20:14:53', '2026-03-16 20:14:53'),
(8, 7, 'ITECH20260003', 3, '2026', 'daftar-ulang/pas-foto/cHtjSfbLXTZ5JfZvnEEapTR2g4oah0Av6GwrVEIf.jpg', '2026-03-16 23:52:00', '2026-03-16 23:52:00'),
(9, 8, 'ITECH20260004', 2, '2026', 'daftar-ulang/pas-foto/6Pc2D8S98BhTDJNVw3bThKf7V2RgMQ7jYowGmY0Y.jpg', '2026-03-17 01:00:18', '2026-03-17 01:00:18'),
(10, 13, 'ITECH20260005', 3, '2026', NULL, '2026-03-19 03:09:44', '2026-03-19 03:09:44');

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_03_09_054532_create_admins_table', 1),
(4, '2026_03_09_054544_create_program_studis_table', 1),
(5, '0001_01_01_000000_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_tes`
--

CREATE TABLE `nomor_tes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nomor_tes` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomor_tes`
--

INSERT INTO `nomor_tes` (`id`, `user_id`, `nomor_tes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'ITECH-2026-000001', 1, '2026-03-10 18:44:59', '2026-03-10 18:44:59'),
(2, 2, 'ITECH-2026-000002', 1, '2026-03-10 18:45:21', '2026-03-10 18:45:21'),
(3, 3, 'ITECH-2026-000003', 1, '2026-03-10 19:46:16', '2026-03-10 19:46:16'),
(4, 4, 'ITECH-2026-000004', 1, '2026-03-11 09:41:24', '2026-03-11 09:41:24'),
(5, 5, 'ITECH-2026-000005', 1, '2026-03-12 01:22:24', '2026-03-12 01:22:24'),
(6, 6, 'ITECH-2026-000006', 1, '2026-03-16 20:48:31', '2026-03-16 20:48:31'),
(7, 7, 'ITECH-2026-000007', 1, '2026-03-16 22:35:08', '2026-03-16 22:35:08'),
(8, 8, 'ITECH-2026-000008', 1, '2026-03-17 00:45:01', '2026-03-17 00:45:01'),
(9, 9, 'ITECH-2026-000009', 1, '2026-03-17 05:25:40', '2026-03-17 05:25:40'),
(10, 10, 'ITECH-2026-000010', 1, '2026-03-17 05:57:27', '2026-03-17 05:57:27'),
(11, 11, 'ITECH-2026-000011', 1, '2026-03-18 07:12:41', '2026-03-18 07:12:41'),
(12, 12, 'ITECH-2026-000012', 1, '2026-03-19 01:25:18', '2026-03-19 01:25:18'),
(13, 13, 'ITECH-2026-000013', 1, '2026-03-19 03:06:44', '2026-03-19 03:06:44'),
(14, 14, 'ITECH-2026-000014', 1, '2026-03-19 07:51:01', '2026-03-19 07:51:01'),
(15, 15, 'ITECH-2026-000015', 1, '2026-03-19 08:01:38', '2026-03-19 08:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jumlah` decimal(15,2) NOT NULL DEFAULT '500000.00',
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `user_id`, `jumlah`, `metode_pembayaran`, `nama_pengirim`, `tanggal_transfer`, `bukti_transfer`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 500000.00, 'Transfer Bank Mandiri', 'lasa', '2026-03-11', NULL, NULL, 'diterima', '2026-03-10 23:17:21', '2026-03-11 06:40:25'),
(2, 5, 500000.00, 'Transfer Bank Mandiri', 'makoto', '2026-03-17', NULL, NULL, 'diterima', '2026-03-16 18:11:52', '2026-03-16 20:14:53'),
(3, 7, 500000.00, 'Transfer Bank Mandiri', 'Irish', '2026-03-17', NULL, NULL, 'diterima', '2026-03-16 23:51:32', '2026-03-16 23:52:00'),
(4, 8, 500000.00, 'Transfer Bank Mandiri', 'sukuna', '2026-03-17', NULL, NULL, 'diterima', '2026-03-17 00:59:56', '2026-03-17 01:00:18'),
(5, 13, 500000.00, 'Transfer Bank Mandiri', 'Rena', '2026-03-19', NULL, NULL, 'diterima', '2026-03-19 03:09:29', '2026-03-19 03:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `program_studis`
--

CREATE TABLE `program_studis` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_prodi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studis`
--

INSERT INTO `program_studis` (`id`, `kode_prodi`, `nama_prodi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TI', 'Teknik Informatika', 'Program studi yang fokus pada pengembangan perangkat lunak, kecerdasan buatan, dan teknologi informasi terkini.', '2026-03-11 01:42:06', '2026-03-11 01:42:06'),
(2, 'SI', 'Sistem Informasi', 'Mempelajari analisis, perancangan, dan implementasi sistem informasi untuk mendukung proses bisnis.', '2026-03-11 01:42:06', '2026-03-11 01:42:06'),
(3, 'KM', 'Kesehatan Masyarakat', 'Program studi yang mempersiapkan tenaga profesional di bidang kesehatan masyarakat dan promosi kesehatan.', '2026-03-11 01:42:06', '2026-03-11 01:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian`
--

CREATE TABLE `soal_ujian` (
  `id` bigint UNSIGNED NOT NULL,
  `soal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_e` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kunci_jawaban` enum('a','b','c','d','e') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal_ujian`
--

INSERT INTO `soal_ujian` (`id`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `kunci_jawaban`, `created_at`, `updated_at`) VALUES
(1, 'Apa kepanjangan dari HTML?', 'Hyper Text Markup Language', 'High Text Markup Language', 'Hyper Tabular Markup Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'a', '2026-03-11 02:13:39', '2026-03-11 02:13:39'),
(2, 'Manakah yang termasuk bahasa pemrograman?', 'HTML', 'CSS', 'JavaScript', 'XML', 'JSON', 'c', '2026-03-11 02:13:39', '2026-03-11 02:13:39'),
(3, 'Apa fungsi dari CSS?', 'Membuat struktur halaman web', 'Menambah interaktivitas', 'Mengatur tampilan halaman web', 'Menyimpan data', 'Menghubungkan ke database', 'c', '2026-03-11 02:13:39', '2026-03-11 02:13:39'),
(4, 'Laravel adalah framework berbasis...', 'Python', 'PHP', 'Java', 'Ruby', 'JavaScript', 'b', '2026-03-11 02:13:39', '2026-03-11 02:13:39'),
(6, 'Apa kepanjangan dari HTML?', 'Hyper Text Markup Language', 'High Text Markup Language', 'Hyper Tabular Markup Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'a', '2026-03-11 02:13:45', '2026-03-11 02:13:45'),
(7, 'Manakah yang termasuk bahasa pemrograman?', 'HTML', 'CSS', 'JavaScript', 'XML', 'JSON', 'c', '2026-03-11 02:13:45', '2026-03-11 02:13:45'),
(8, 'Apa fungsi dari CSS?', 'Membuat struktur halaman web', 'Menambah interaktivitas', 'Mengatur tampilan halaman web', 'Menyimpan data', 'Menghubungkan ke database', 'c', '2026-03-11 02:13:45', '2026-03-11 02:13:45'),
(9, 'Laravel adalah framework berbasis...', 'Python', 'PHP', 'Java', 'Ruby', 'JavaScript', 'b', '2026-03-11 02:13:45', '2026-03-11 02:13:45'),
(10, 'Database management system yang sering digunakan dengan Laravel adalah...', 'MySQL', 'MongoDB', 'PostgreSQL', 'SQLite', 'Semua benar', 'e', '2026-03-11 02:13:45', '2026-03-11 02:13:45'),
(11, 'Apa kepanjangan dari HTML?', 'Hyper Text Markup Language', 'High Text Markup Language', 'Hyper Tabular Markup Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'a', '2026-03-11 07:13:36', '2026-03-11 07:13:36'),
(12, 'Manakah yang termasuk bahasa pemrograman?', 'HTML', 'CSS', 'JavaScript', 'XML', 'JSON', 'c', '2026-03-11 07:13:36', '2026-03-11 07:13:36'),
(13, 'Apa fungsi dari CSS?', 'Membuat struktur halaman web', 'Menambah interaktivitas', 'Mengatur tampilan halaman web', 'Menyimpan data', 'Menghubungkan ke database', 'c', '2026-03-11 07:13:36', '2026-03-11 07:13:36'),
(14, 'Laravel adalah framework berbasis...', 'Python', 'PHP', 'Java', 'Ruby', 'JavaScript', 'b', '2026-03-11 07:13:36', '2026-03-11 07:13:36'),
(15, 'Database management system yang sering digunakan dengan Laravel adalah...', 'MySQL', 'MongoDB', 'PostgreSQL', 'SQLite', 'Semua benar', 'e', '2026-03-11 07:13:36', '2026-03-11 07:13:36'),
(16, '1+1', '2', '5', '3', '0', '4', 'a', '2026-03-16 23:40:54', '2026-03-16 23:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_studi_id` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `password`, `program_studi_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Lasa', 'lasa@gmail.com', '$2y$12$3momjTOaiPQx72J3ae/ZP.xQWlnzmFjvGI1/qUxRtX3vFy9W25nO2', 1, NULL, '2026-03-10 19:46:16', '2026-03-19 07:24:04'),
(4, 'Anneth', 'anneth@gmail.com', '$2y$12$nS4KuUv95H/fTQoKS8VoXuTO3r9sKHtjfQVsKkpii5zPpLtdEWd3i', 2, NULL, '2026-03-11 09:41:24', '2026-03-19 07:24:28'),
(5, 'Makoto', 'makoto@gmail.com', '$2y$12$hGnLZz4U2NFkYfMvuO79tOoXn7BPbZOXOFN6VwBWrHHLzyaPvV2pO', 3, NULL, '2026-03-12 01:22:24', '2026-03-19 07:23:42'),
(7, 'Irish', 'Irish@gmail.com', '$2y$12$CaMXzs2.QA5VYvtAzBabZuwR/I3Q6yb9XaByR/lxyGfSeujAajinK', 3, NULL, '2026-03-16 22:35:08', '2026-03-16 22:35:08'),
(8, 'Sukuna', 'suknarajakutukan@gmail.com', '$2y$12$6AkpX1Q.FryWd3gZpb/OFujX6lj8PW0l3Gl3pIHmZ0KyEBnl8RE3u', 2, NULL, '2026-03-17 00:45:01', '2026-03-19 07:23:28'),
(11, 'Roth', 'Roth@gmail.com', '$2y$12$RsfC8wAZ8bBJywiQIB9mGemi0tuTVw1UECCxxCmOvagCVVpFZd8dO', 2, NULL, '2026-03-18 07:12:41', '2026-03-18 07:12:41'),
(12, 'Lionel', 'Lionel@gmail.com', '$2y$12$IKGKYHx7sPyKpj14WElJweDNqocNWZSL1DWf271Ir/fvBeoHIZ6yK', 1, NULL, '2026-03-19 01:25:17', '2026-03-19 01:25:17'),
(13, 'Rena', 'Rena@gmail.com', '$2y$12$pHmIDyOHW6L2o.ymvMu1tudWxgdYkEzwuOyMkCOguXGnJePogMdOS', 3, NULL, '2026-03-19 03:06:44', '2026-03-19 03:06:44'),
(14, 'Asa', 'asa@gmail.com', '$2y$12$r4Ir3L3sq8WQ7kwjmeUURO9.GU6/df5hTmDmt0k0QszFhzNAsVrTm', 2, NULL, '2026-03-19 07:51:01', '2026-03-19 07:51:01'),
(15, 'aim fov', 'aimfov444@gmail.com', '$2y$12$U4zP8qp0YeUHE1C3ruyVqeWRN2Or4Qc09THmM6OPtweBnftAeaeqa', 1, NULL, '2026-03-19 08:01:38', '2026-03-19 08:01:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daftar_ulang_user_id_unique` (`user_id`),
  ADD KEY `idx_status_berkas` (`status_berkas`);

--
-- Indexes for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_pribadi_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `data_pribadi_nik_unique` (`nik`),
  ADD KEY `data_pribadi_program_studi_id_foreign` (`program_studi_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_ujian_user_id_foreign` (`user_id`);

--
-- Indexes for table `jawaban_ujian`
--
ALTER TABLE `jawaban_ujian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jawaban_ujian_user_id_soal_ujian_id_unique` (`user_id`,`soal_ujian_id`),
  ADD KEY `jawaban_ujian_soal_ujian_id_foreign` (`soal_ujian_id`);

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
-- Indexes for table `mahasiswa_aktif`
--
ALTER TABLE `mahasiswa_aktif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_aktif_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `mahasiswa_aktif_nim_unique` (`nim`),
  ADD KEY `mahasiswa_aktif_program_studi_id_foreign` (`program_studi_id`),
  ADD KEY `idx_prodi_tahun` (`program_studi_id`,`tahun_masuk`),
  ADD KEY `idx_nim` (`nim`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_tes`
--
ALTER TABLE `nomor_tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayaran_user_id_unique` (`user_id`);

--
-- Indexes for table `program_studis`
--
ALTER TABLE `program_studis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_studis_kode_prodi_unique` (`kode_prodi`);

--
-- Indexes for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_program_studi_id_foreign` (`program_studi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jawaban_ujian`
--
ALTER TABLE `jawaban_ujian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa_aktif`
--
ALTER TABLE `mahasiswa_aktif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nomor_tes`
--
ALTER TABLE `nomor_tes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program_studis`
--
ALTER TABLE `program_studis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD CONSTRAINT `daftar_ulang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD CONSTRAINT `data_pribadi_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_pribadi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD CONSTRAINT `hasil_ujian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban_ujian`
--
ALTER TABLE `jawaban_ujian`
  ADD CONSTRAINT `jawaban_ujian_soal_ujian_id_foreign` FOREIGN KEY (`soal_ujian_id`) REFERENCES `soal_ujian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ujian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa_aktif`
--
ALTER TABLE `mahasiswa_aktif`
  ADD CONSTRAINT `mahasiswa_aktif_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_aktif_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studis` (`id`);
--
-- Database: `itech_pmb`
--
CREATE DATABASE IF NOT EXISTS `itech_pmb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `itech_pmb`;
--
-- Database: `pmb`
--
CREATE DATABASE IF NOT EXISTS `pmb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pmb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `camaba`
--

CREATE TABLE `camaba` (
  `id` int NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `camaba`
--

INSERT INTO `camaba` (`id`, `no_pendaftaran`, `nama`, `email`, `no_hp`, `password`, `jurusan`, `status`, `created_at`, `nilai`) VALUES
(2, 'PMB20269506', 'asa dd', 'asa0dood@gmail.com', '085894387984', '47bce5c74f589f4867dbd57e9ca9f808', 'Sistem Informasi', 'aktif', '2026-02-24 01:44:31', NULL),
(4, 'PMB20263700', 'dele', 'adel@gmail.com', '088296857270', '96e79218965eb72c92a549dd5a330112', 'Informatika', 'aktif', '2026-02-24 04:45:33', NULL),
(5, 'PMB20268592', 'siswa', 'siswi@gmail.com', '9858', '47bce5c74f589f4867dbd57e9ca9f808', 'Sistem Informasi', 'aktif', '2026-02-24 12:34:49', NULL),
(6, 'PMB20261253', 'siswa', 'siswa@gmail.com', '0858', '47bce5c74f589f4867dbd57e9ca9f808', 'Sistem Informasi', 'aktif', '2026-02-24 13:28:33', 100),
(7, 'PMB20261502', 're', 're@gmail.com', '01', '9f6e6800cfae7749eb6c486619254b9c', 'Sistem Informasi', 'aktif', '2026-02-24 13:38:20', NULL),
(8, 'PMB20265666', 'vi', 'vi@gmail.com', '02', '47bce5c74f589f4867dbd57e9ca9f808', 'Sistem Informasi', 'aktif', '2026-02-24 13:52:04', 89),
(9, 'PMB20265442', 'mahasiswi', 'mahasiswi@gmail.com', '0858943', '47bce5c74f589f4867dbd57e9ca9f808', 'Sistem Informasi', 'aktif', '2026-02-26 14:12:57', 100);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_ulang`
--

CREATE TABLE `daftar_ulang` (
  `id` int NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `jalur_masuk` varchar(50) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nominal_bayar` int NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `ijazah` varchar(255) NOT NULL,
  `pas_foto` varchar(255) NOT NULL,
  `status_verifikasi` enum('menunggu','terverifikasi','ditolak') DEFAULT 'menunggu',
  `nim` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daftar_ulang`
--

INSERT INTO `daftar_ulang` (`id`, `no_pendaftaran`, `nik`, `tanggal_lahir`, `alamat`, `program_studi`, `jalur_masuk`, `asal_sekolah`, `nominal_bayar`, `tanggal_bayar`, `bukti_transfer`, `ktp`, `ijazah`, `pas_foto`, `status_verifikasi`, `nim`, `created_at`) VALUES
(2, 'PMB20265666', '121144', '2007-08-31', 'jl', 'Sistem Informasi', 'Ujian', 'smk', 5000000, '2026-08-31', 'uploads/bukti/1771947746_3.jpg', '', '', '', 'terverifikasi', '2026SI001', '2026-02-24 15:42:26'),
(3, 'PMB20261253', '12345678', '0205-08-31', 'jakarta selatan, indonesia', 'Sistem Informasi', 'Ujian', 'smk 65', 5000000, '2026-02-26', '', '', '', 'uploads/foto/1772114634_WhatsApp Image 2026-02-26 at 9.03.04 PM.jpeg', 'terverifikasi', '2026SI002', '2026-02-26 14:03:54'),
(4, 'PMB20265442', '11111', '2007-08-31', 'Jakarta Indonesia', 'Sistem Informasi', 'Ujian', 'smk 65', 5000000, '2026-02-26', '', '', '', 'uploads/foto/1772115280_WhatsApp Image 2026-02-26 at 9.03.04 PM.jpeg', 'terverifikasi', '2026SI003', '2026-02-26 14:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` varchar(255) NOT NULL,
  `opsi_b` varchar(255) NOT NULL,
  `opsi_c` varchar(255) NOT NULL,
  `opsi_d` varchar(255) NOT NULL,
  `opsi_e` varchar(255) NOT NULL,
  `jawaban` char(1) NOT NULL COMMENT 'A,B,C,D,E',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `mata_pelajaran`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `created_at`) VALUES
(2, 'Matematika', 'Akar kuadrat dari 144 adalah?', '11', '12', '13', '14', '15', 'B', '2026-02-24 03:45:36'),
(3, 'Bahasa Indonesia', 'Kata baku dari \"ijin\" adalah?', 'ijin', 'izin', 'idzin', 'ijin', 'izinn', 'B', '2026-02-24 03:45:36'),
(4, 'Bahasa Indonesia', 'Sinonim kata \"bahagia\" adalah?', 'sedih', 'senang', 'marah', 'kecewa', 'cemas', 'B', '2026-02-24 03:45:36'),
(5, 'Bahasa Inggris', '\"Saya sedang makan\" dalam bahasa Inggris adalah?', 'I am eating', 'I eat', 'I ate', 'I will eat', 'I have eaten', 'A', '2026-02-24 03:45:36'),
(6, 'Bahasa Inggris', 'What is the English word for \"meja\"?', 'Chair', 'Table', 'Book', 'Door', 'Window', 'B', '2026-02-24 03:45:36'),
(7, 'Pengetahuan Umum', 'Ibukota Indonesia adalah?', 'Bandung', 'Surabaya', 'Jakarta', 'Medan', 'Bali', 'C', '2026-02-24 03:45:36'),
(8, 'Pengetahuan Umum', 'Gunung tertinggi di dunia adalah?', 'Kilimanjaro', 'Everest', 'Merapi', 'Bromo', 'Krakatau', 'B', '2026-02-24 03:45:36'),
(9, 'Logika', 'Jika hari ini Senin, maka 3 hari lagi adalah?', 'Kamis', 'Rabu', 'Selasa', 'Jumat', 'Sabtu', 'A', '2026-02-24 03:45:36'),
(10, 'Matematika', 'Berapa sisi kubus?', '4', '6', '8', '10', '12', 'B', '2026-02-24 03:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id` int NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `soal_id` int NOT NULL,
  `jawaban` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id`, `no_pendaftaran`, `soal_id`, `jawaban`) VALUES
(1, 'PMB20266677', 1, 'A'),
(2, 'PMB20266677', 2, 'A'),
(3, 'PMB20266677', 3, 'B'),
(4, 'PMB20266677', 4, 'B'),
(5, 'PMB20266677', 5, 'A'),
(6, 'PMB20266677', 6, 'B'),
(7, 'PMB20266677', 7, 'C'),
(8, 'PMB20266677', 8, 'B'),
(9, 'PMB20266677', 9, 'A'),
(10, 'PMB20266677', 10, 'a'),
(11, 'PMB20263700', 1, 'A'),
(12, 'PMB20263700', 2, 'B'),
(13, 'PMB20263700', 3, 'B'),
(14, 'PMB20263700', 4, 'B'),
(15, 'PMB20263700', 5, 'A'),
(16, 'PMB20263700', 6, 'B'),
(17, 'PMB20263700', 7, 'C'),
(18, 'PMB20263700', 8, 'B'),
(19, 'PMB20263700', 9, 'A'),
(20, 'PMB20263700', 10, ''),
(21, 'PMB20269506', 2, 'B'),
(22, 'PMB20269506', 3, 'B'),
(23, 'PMB20269506', 4, 'B'),
(24, 'PMB20269506', 5, 'A'),
(25, 'PMB20269506', 6, 'B'),
(26, 'PMB20269506', 7, 'C'),
(27, 'PMB20269506', 8, 'B'),
(28, 'PMB20269506', 9, 'A'),
(29, 'PMB20269506', 10, ''),
(30, 'PMB20265666', 2, 'B'),
(31, 'PMB20265666', 3, ''),
(32, 'PMB20265666', 4, 'B'),
(33, 'PMB20265666', 5, 'A'),
(34, 'PMB20265666', 6, 'B'),
(35, 'PMB20265666', 7, 'C'),
(36, 'PMB20265666', 8, 'B'),
(37, 'PMB20265666', 9, 'A'),
(38, 'PMB20265666', 10, 'B'),
(39, 'PMB20261253', 2, 'B'),
(40, 'PMB20261253', 3, 'B'),
(41, 'PMB20261253', 4, 'B'),
(42, 'PMB20261253', 5, 'A'),
(43, 'PMB20261253', 6, 'B'),
(44, 'PMB20261253', 7, 'C'),
(45, 'PMB20261253', 8, 'B'),
(46, 'PMB20261253', 9, 'A'),
(47, 'PMB20261253', 10, 'B'),
(48, 'PMB20265442', 2, 'B'),
(49, 'PMB20265442', 3, 'B'),
(50, 'PMB20265442', 4, 'B'),
(51, 'PMB20265442', 5, 'A'),
(52, 'PMB20265442', 6, 'B'),
(53, 'PMB20265442', 7, 'C'),
(54, 'PMB20265442', 8, 'B'),
(55, 'PMB20265442', 9, 'A'),
(56, 'PMB20265442', 10, 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `camaba`
--
ALTER TABLE `camaba`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik` (`no_pendaftaran`,`soal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `camaba`
--
ALTER TABLE `camaba`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Database: `pmb_itech`
--
CREATE DATABASE IF NOT EXISTS `pmb_itech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pmb_itech`;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_ulangs`
--

CREATE TABLE `daftar_ulangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `surat_pernyataan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_keterangan_sehat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kartu_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_berkas` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pribadis`
--

CREATE TABLE `data_pribadis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `program_studi_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pribadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` year NOT NULL,
  `nama_ortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_ortu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_ortu` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `hasil_ujians`
--

CREATE TABLE `hasil_ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_benar` int NOT NULL DEFAULT '0',
  `total_salah` int NOT NULL DEFAULT '0',
  `nilai` int NOT NULL DEFAULT '0',
  `status` enum('lulus','tidak_lulus','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_ujians`
--

CREATE TABLE `jawaban_ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `hasil_ujian_id` bigint UNSIGNED NOT NULL,
  `soal_ujian_id` bigint UNSIGNED NOT NULL,
  `jawaban` enum('a','b','c','d','e') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_benar` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_aktifs`
--

CREATE TABLE `mahasiswa_aktifs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `program_studi_id` bigint UNSIGNED NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` year NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_03_01_110603_add_role_to_users_table', 2),
(6, '2026_03_01_130610_create_program_studis_table', 3),
(7, '2026_03_01_130645_create_data_pribadis_table', 3),
(8, '2026_03_01_130714_create_soal_ujians_table', 3),
(9, '2026_03_01_130731_create_hasil_ujians_table', 3),
(10, '2026_03_01_130745_create_jawaban_ujians_table', 3),
(11, '2026_03_01_130758_create_daftar_ulangs_table', 3),
(12, '2026_03_01_130811_create_pembayarans_table', 3),
(13, '2026_03_01_130839_create_mahasiswa_aktifs_table', 3),
(14, '2026_03_01_131026_add_program_studi_id_to_data_pribadis_table', 3);

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
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `daftar_ulang_id` bigint UNSIGNED NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status_pembayaran` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_studis`
--

CREATE TABLE `program_studis` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_prodi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studis`
--

INSERT INTO `program_studis` (`id`, `kode_prodi`, `nama_prodi`, `jenjang`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TI', 'Teknik Informatika', 'S1', NULL, '2026-03-01 06:13:32', '2026-03-01 06:13:32'),
(2, 'SI', 'Sistem Informasi', 'S1', NULL, '2026-03-01 06:13:32', '2026-03-01 06:13:32'),
(3, 'KM', 'Kesehatan Masyarakat', 'S1', NULL, '2026-03-01 06:13:32', '2026-03-01 06:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujians`
--

CREATE TABLE `soal_ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_e` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kunci_jawaban` enum('a','b','c','d','e') COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi_menit` int NOT NULL DEFAULT '60',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin ITECH', 'admin@itech.ac.id', NULL, '$2y$10$kQXKQWVe1X8zc.fJWO/QveXL1d4B7rtsciaRs87yC/h8LjYsKuRKK', NULL, '2026-03-01 05:34:33', '2026-03-01 05:34:33', 'admin'),
(7, 'lasa', 'lasa@gmail.com', NULL, '$2y$10$93SFBwiNZNkT040eZ9HKQeaHgkapC0r.ZiFtT7yt.ESe8/u5zhcPy', NULL, '2026-03-02 20:40:41', '2026-03-02 20:40:41', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_ulangs`
--
ALTER TABLE `daftar_ulangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_ulangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `data_pribadis`
--
ALTER TABLE `data_pribadis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_pribadis_nik_unique` (`nik`),
  ADD KEY `data_pribadis_user_id_foreign` (`user_id`),
  ADD KEY `data_pribadis_program_studi_id_foreign` (`program_studi_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_ujians_user_id_foreign` (`user_id`);

--
-- Indexes for table `jawaban_ujians`
--
ALTER TABLE `jawaban_ujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_ujians_hasil_ujian_id_foreign` (`hasil_ujian_id`),
  ADD KEY `jawaban_ujians_soal_ujian_id_foreign` (`soal_ujian_id`);

--
-- Indexes for table `mahasiswa_aktifs`
--
ALTER TABLE `mahasiswa_aktifs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_aktifs_nim_unique` (`nim`),
  ADD KEY `mahasiswa_aktifs_user_id_foreign` (`user_id`),
  ADD KEY `mahasiswa_aktifs_program_studi_id_foreign` (`program_studi_id`);

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
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_daftar_ulang_id_foreign` (`daftar_ulang_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `program_studis`
--
ALTER TABLE `program_studis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_studis_kode_prodi_unique` (`kode_prodi`);

--
-- Indexes for table `soal_ujians`
--
ALTER TABLE `soal_ujians`
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
-- AUTO_INCREMENT for table `daftar_ulangs`
--
ALTER TABLE `daftar_ulangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_pribadis`
--
ALTER TABLE `data_pribadis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_ujians`
--
ALTER TABLE `jawaban_ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa_aktifs`
--
ALTER TABLE `mahasiswa_aktifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_studis`
--
ALTER TABLE `program_studis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal_ujians`
--
ALTER TABLE `soal_ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_ulangs`
--
ALTER TABLE `daftar_ulangs`
  ADD CONSTRAINT `daftar_ulangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_pribadis`
--
ALTER TABLE `data_pribadis`
  ADD CONSTRAINT `data_pribadis_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studis` (`id`),
  ADD CONSTRAINT `data_pribadis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  ADD CONSTRAINT `hasil_ujians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban_ujians`
--
ALTER TABLE `jawaban_ujians`
  ADD CONSTRAINT `jawaban_ujians_hasil_ujian_id_foreign` FOREIGN KEY (`hasil_ujian_id`) REFERENCES `hasil_ujians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ujians_soal_ujian_id_foreign` FOREIGN KEY (`soal_ujian_id`) REFERENCES `soal_ujians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa_aktifs`
--
ALTER TABLE `mahasiswa_aktifs`
  ADD CONSTRAINT `mahasiswa_aktifs_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studis` (`id`),
  ADD CONSTRAINT `mahasiswa_aktifs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_daftar_ulang_id_foreign` FOREIGN KEY (`daftar_ulang_id`) REFERENCES `daftar_ulangs` (`id`) ON DELETE CASCADE;
--
-- Database: `tes`
--
CREATE DATABASE IF NOT EXISTS `tes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `tes`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
