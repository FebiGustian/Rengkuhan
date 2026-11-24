-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2026 at 02:37 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rengkuhan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `ID_Akun` int(10) UNSIGNED NOT NULL,
  `Nama_Akun` varchar(100) NOT NULL,
  `Jenis_Akun` varchar(50) NOT NULL,
  `Posisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`ID_Akun`, `Nama_Akun`, `Jenis_Akun`, `Posisi`) VALUES
(1, 'Kas Operasional', 'Aset Lancar', 'Debit'),
(2, 'Bank BCA Rengkuhan', 'Aset Lancar', 'Debit'),
(3, 'Pendapatan Kontribusi Volunteer', 'Pendapatan', 'Kredit'),
(4, 'Pendapatan Donasi', 'Pendapatan', 'Kredit'),
(5, 'Beban Logistik & Konsumsi', 'Beban', 'Debit'),
(6, 'Beban Transportasi & Akomodasi', 'Beban', 'Debit');

-- --------------------------------------------------------

--
-- Table structure for table `detail_rab`
--

CREATE TABLE `detail_rab` (
  `ID_Detail_RAB` int(10) UNSIGNED NOT NULL,
  `ID_RAB` int(10) UNSIGNED NOT NULL,
  `Nama_Kebutuhan` varchar(150) NOT NULL,
  `Harga_Satuan` decimal(15,2) NOT NULL,
  `Kuantitas` int(10) UNSIGNED NOT NULL,
  `Sub_Total` decimal(17,2) GENERATED ALWAYS AS (`Harga_Satuan` * `Kuantitas`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_rab`
--

INSERT INTO `detail_rab` (`ID_Detail_RAB`, `ID_RAB`, `Nama_Kebutuhan`, `Harga_Satuan`, `Kuantitas`) VALUES
(1, 1, 'Paket Modul Belajar Siswa', 25000.00, 50),
(2, 1, 'Konsumsi & Snack Panitia/Volunteer', 20000.00, 35),
(3, 1, 'Sewa Kendaraan Operasional', 350000.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `ID_Jurnal_Umum` int(10) UNSIGNED NOT NULL,
  `ID_Pembayaran` int(10) UNSIGNED NOT NULL,
  `ID_Akun` int(10) UNSIGNED NOT NULL,
  `Nominal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `ID_Mandala` int(10) UNSIGNED NOT NULL,
  `Nama_Kegiatan` varchar(150) NOT NULL,
  `Kategori` varchar(50) NOT NULL DEFAULT 'Pendidikan',
  `Tanggal_Kegiatan` date NOT NULL,
  `Lokasi` varchar(100) NOT NULL DEFAULT 'Semarang',
  `Waktu` varchar(50) NOT NULL DEFAULT '09.00 - 12.00 WIB',
  `Penyelenggara` varchar(100) NOT NULL DEFAULT 'Ranah Rengkuh',
  `Kuota` int(10) UNSIGNED NOT NULL,
  `Biaya` decimal(15,2) NOT NULL DEFAULT 50000.00,
  `Deskripsi` text DEFAULT NULL,
  `Tujuan` text DEFAULT NULL,
  `Aktivitas` text DEFAULT NULL,
  `Persyaratan` text DEFAULT NULL,
  `Perlengkapan` text DEFAULT NULL,
  `Foto_Kegiatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`ID_Kegiatan`, `ID_Mandala`, `Nama_Kegiatan`, `Kategori`, `Tanggal_Kegiatan`, `Lokasi`, `Waktu`, `Penyelenggara`, `Kuota`, `Biaya`, `Deskripsi`, `Tujuan`, `Aktivitas`, `Persyaratan`, `Perlengkapan`, `Foto_Kegiatan`) VALUES
(1, 2, 'Rengkuh Desa: Mengajar & Berbagi Inspirasi', 'Pendidikan', '2026-12-07', 'Semarang', '09.00 - 12.00 WIB', 'Ranah Rengkuh', 25, 50000.00, 'Program pengabdian masyarakat di Desa Sukamaju, mencakup sesi mengajar kreatif anak usia SD, workshop literasi digital sederhana, dan pembagian perlengkapan belajar.', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Peduli Alam: Tanam 500 Mangrove Pesisir', 'Pendidikan', '2026-12-21', 'Semarang', '09.00 - 12.00 WIB', 'Ranah Rengkuh', 40, 50000.00, 'Aksi nyata pelestarian lingkungan pesisir pantai utara dengan penanaman 500 bibit mangrove bersama komunitas pegiat lingkungan dan pemuda setempat.', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Dapur Sehat Rengkuhan: Nutrisi untuk Lansia', 'Pendidikan', '2027-01-02', 'Semarang', '09.00 - 12.00 WIB', 'Ranah Rengkuh', 20, 50000.00, 'Pendistribusian makanan bergizi dan pemeriksaan kesehatan dasar gratis bagi lansia di perkampungan pinggiran kota.', NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Ruang Rimbun: \"Menanam Bersama, Merawat Kebersamaan\"', 'Pendidikan', '2027-01-01', 'Semarang', '09.00 - 12.00 WIB', 'Ranah Rengkuh', 15, 50000.00, 'Pada kegiatan ini bla bla bla bla\r\n📍 Teras Lembang Agrowisata, Kab. Bandung Barat\r\n🗓️ Sabtu, 01 Januari 2027\r\n⏰ 09.00 WIB – selesai', NULL, NULL, NULL, NULL, 'kegiatan/LsNWTcZhOn0MukMnNuSTb4CO3g1jqwFdm66CF8ij.png');

-- --------------------------------------------------------

--
-- Table structure for table `mandala`
--

CREATE TABLE `mandala` (
  `ID_Mandala` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Jabatan` varchar(100) DEFAULT NULL,
  `No_Telpon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mandala`
--

INSERT INTO `mandala` (`ID_Mandala`, `Nama`, `Email`, `Password`, `Jabatan`, `No_Telpon`) VALUES
(1, 'Admin Ranah Rengkuh', 'admin@rengkuhan.org', '$2y$12$XvatR2wskR2Q4K9SgxoD4.SAGBdWhJkTnMjT/.jthrirG9Z/boAqu', 'Administrator', '081234567890'),
(2, 'Siti Rahmawati (Koordinator Program)', 'pengurus@rengkuhan.org', '$2y$12$bHk3lZkShqm/SDTUmJgZs.Tuutlpz74wx2k86BQkwUOEomnp1qSNC', 'Pengurus', '082198765432');

-- --------------------------------------------------------

--
-- Table structure for table `mandala_invitations`
--

CREATE TABLE `mandala_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_hash` varchar(64) NOT NULL,
  `created_by_mandala` int(10) UNSIGNED NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `used_by_mandala` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_17_031757_create_mandala_invitations_table', 1),
(5, '2026_11_23_000001_create_rengkuhan_core_tables', 2),
(6, '2026_11_23_000002_add_foto_kegiatan_to_kegiatan_table', 3),
(7, '2026_11_23_000003_add_figma_details_to_kegiatan_and_pendaftaran', 4);

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
  `ID_Pembayaran` int(10) UNSIGNED NOT NULL,
  `ID_Pendaftaran` int(10) UNSIGNED NOT NULL,
  `Nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `Metode_Pembayaran` varchar(50) DEFAULT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID_Pembayaran`, `ID_Pendaftaran`, `Nominal`, `Metode_Pembayaran`, `Status`) VALUES
(1, 1, 50000.00, 'QRIS', 'Lunas'),
(2, 2, 50000.00, 'Transfer Bank BCA', 'Menunggu Verifikasi'),
(3, 3, 50000.00, 'QRIS', 'Menunggu Verifikasi'),
(4, 4, 50000.00, 'QRIS', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `ID_Pendaftaran` int(10) UNSIGNED NOT NULL,
  `ID_Volunteer` int(10) UNSIGNED NOT NULL,
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `Tanggal_Pendaftaran` date NOT NULL,
  `Alamat` text DEFAULT NULL,
  `Motivasi` text DEFAULT NULL,
  `Pengalaman` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`ID_Pendaftaran`, `ID_Volunteer`, `ID_Kegiatan`, `Tanggal_Pendaftaran`, `Alamat`, `Motivasi`, `Pengalaman`) VALUES
(1, 1, 1, '2026-11-21', NULL, NULL, NULL),
(2, 2, 1, '2026-11-22', NULL, NULL, NULL),
(3, 1, 2, '2026-11-23', NULL, NULL, NULL),
(4, 1, 3, '2026-11-23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `ID_RAB` int(10) UNSIGNED NOT NULL,
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`ID_RAB`, `ID_Kegiatan`, `Tanggal`) VALUES
(1, 1, '2026-11-23'),
(2, 4, '2026-11-23');

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
('4LAFQAPRgSbhSapr1qNrYcQmC4okDkm3nh6O9NV7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJUMjI0VGJ6R3VCR0tZcjFWWGZRMGZaVDdUdWpraUFTS2dOZkJwTGNzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpblwvbWFuZGFsYSIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1795434375),
('5CSoYPDOr1fpSJzKh4RaSjn60kkBbpvznpt5h3JG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvWVNKNFNOZVRhY3lUaFg5c3JPYnFFZkJ1UVJDM1liajBjRjRCVGIyIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795437214),
('9wq9VRT5XeX2pb2NuwdP0L20rQOB9H9IBv8MDTag', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJaMmZVRTdhMjVQZFpRaG9Kc0w1VURock1rcUM1Q3NUWVhSNGhiMUZHIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC92b2x1bnRlZXIiLCJyb3V0ZSI6ImxvZ2luIn19', 1795437383),
('aRBX9OD5DsQ27fnjO6Wz23fSMz9IC3oCa8f87JdP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ0VTZtRjZ5Z2FMWGo2T0NaSFZUQ2hER0k4OTZjRXVWSDdScDUyWHVOIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795440086),
('b31duEeZWozapJJZpFvXSdF0kO69OcE6lLPb5MbG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJTYWJxSlEwNnBsWUE2RklBWFhaNXBZMzR0Q2REdTVSV0pYYTRvTFJVIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795434746),
('EksA4gS0LrGaxJNB59k48AjgBZSQ7s5kpzFS35Bd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI1eFlvdGRwbkVhc0RnbmhvejNXY1ZmbHZTUXBGOGxTNmNwSmd0MVMxIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC92b2x1bnRlZXIiLCJyb3V0ZSI6ImxvZ2luIn19', 1795434561),
('mEscYnlGf4uxAl33iZC48LiTOLUvtbd4kCqMZvvz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJiaVR2ZTk1THZ6NTI2eEN3bk9uY3ZuekNzd2VyUWlWaUdoWFBuNzJ0IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795434947),
('mYEcSXPrbUaIr6o1GbY0K0ZozECsdFM4RDTxrnoe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJqMXl6Y1k5SWdERmFVVFIwZGtpamlhYUo5djlyNFV3NllYeG5EdnBQIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795440896),
('qCb298CYYdfoTTTvRa3jWsg31TlvyRe2seJlcXDC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJTTmsxeVFOZ3d5UXhmNG9DUVNPNUlXYmF2djRkc21ueUcwN2J4V2ozIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795434839),
('QrFUlfQxemAatvUCb1I7DaqrgdbRkunPrZswu1Re', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJFSkhLZlhNV3ZHdEpwTXU1bzYxU2dSS016ZzdFeEN0QkNMWkFkeTNJIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC92b2x1bnRlZXIiLCJyb3V0ZSI6ImxvZ2luIn19', 1795435408),
('VJfhOHv9VKduFgvhrxA4Vn8TuzdkWMk5EUH8dSqg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJYRXFCQkNvTDNldWlJTmxqQW5KSUJMQWFwdllKdjI3N1BNczdMRDJuIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795434501),
('Wymu5rNJBpuahL9QV8TCTaYtgbqNGKqzNMEgasEl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIwU0tzdWhPRGVFS29hOTdrZ1VEREFVR0M0Yko5WXU2ZmZzdkFRWWt1IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC92b2x1bnRlZXIiLCJyb3V0ZSI6ImxvZ2luIn19', 1795435904),
('ZRVbXv8mQRaksTyhA6ojAVZfquhqCZJ3Fmsz6VTR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSU0hzY2FxWnl4VVVmbEhvdkJmaU9hZFdudUpZOWcyYllMd2hncU5RIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC9tYW5kYWxhIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1795435544),
('zWEzhhtxPvGUMuD0r5EU3dB8roAQ2wzuk05xyRI3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJzeUw3a2RZaEZTd3pVRVI5UGxuS2NMellQVE1laWVRUUNzSnpYamFnIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luXC92b2x1bnRlZXIiLCJyb3V0ZSI6ImxvZ2luIn19', 1795440842),
('ZxOERNJnxMqfeloHRDMUxSdUMWduSaoezDep3dsO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSWlZYcXRNWm5Xb0o3TVhnS2syT2V6Q3hVSmkxTjBMZnFjU0FaNjFUIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZFwvcGVuZ3VydXMiLCJyb3V0ZSI6InBlbmd1cnVzLmRhc2hib2FyZCJ9LCJhdXRoX3JvbGUiOiJtYW5kYWxhIiwiYXV0aF9pZCI6MiwiYXV0aF9uYW1lIjoiU2l0aSBSYWhtYXdhdGkgKEtvb3JkaW5hdG9yIFByb2dyYW0pIiwiYXV0aF9lbWFpbCI6InBlbmd1cnVzQHJlbmdrdWhhbi5vcmciLCJhdXRoX2phYmF0YW4iOiJQZW5ndXJ1cyJ9', 1795440940);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total_anggaran_rab`
-- (See below for the actual view)
--
CREATE TABLE `view_total_anggaran_rab` (
`ID_RAB` int(10) unsigned
,`ID_Kegiatan` int(10) unsigned
,`Tanggal` date
,`Total_Anggaran` decimal(39,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `ID_Volunteer` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `No_Telpon` varchar(20) DEFAULT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`ID_Volunteer`, `Nama`, `Password`, `No_Telpon`, `Email`) VALUES
(1, 'Firza Volunteer', '$2y$12$qNHjpLhpY4ALZ8lle1iG7eyenIFvZQ6AELGpK6NSgPMdmg4RZ.YGS', '082126136875', 'volunteer@rengkuhan.org'),
(2, 'Anisa Dian', '$2y$12$ZI/.NREEnNjzH3xvvq7a4e8VYj.vtaynfRGaeQlKilRVm4zXrOtVu', '081399887766', 'anisa@gmail.com');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`ID_Akun`);

--
-- Indexes for table `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD PRIMARY KEY (`ID_Detail_RAB`),
  ADD KEY `idx_detail_rab` (`ID_RAB`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`ID_Jurnal_Umum`),
  ADD KEY `idx_jurnal_pembayaran` (`ID_Pembayaran`),
  ADD KEY `idx_jurnal_akun` (`ID_Akun`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`ID_Kegiatan`),
  ADD KEY `idx_kegiatan_mandala` (`ID_Mandala`);

--
-- Indexes for table `mandala`
--
ALTER TABLE `mandala`
  ADD PRIMARY KEY (`ID_Mandala`),
  ADD UNIQUE KEY `uq_mandala_email` (`Email`);

--
-- Indexes for table `mandala_invitations`
--
ALTER TABLE `mandala_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mandala_invitations_code_hash_unique` (`code_hash`),
  ADD KEY `mandala_invitations_created_by_mandala_foreign` (`created_by_mandala`),
  ADD KEY `mandala_invitations_used_by_mandala_foreign` (`used_by_mandala`),
  ADD KEY `mandala_invitations_expires_at_index` (`expires_at`),
  ADD KEY `mandala_invitations_used_at_index` (`used_at`);

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
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_Pembayaran`),
  ADD KEY `idx_pembayaran_pendaftaran` (`ID_Pendaftaran`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`ID_Pendaftaran`),
  ADD KEY `idx_pendaftaran_volunteer` (`ID_Volunteer`),
  ADD KEY `idx_pendaftaran_kegiatan` (`ID_Kegiatan`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`ID_RAB`),
  ADD UNIQUE KEY `uq_rab_kegiatan` (`ID_Kegiatan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`ID_Volunteer`),
  ADD UNIQUE KEY `uq_volunteer_email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `ID_Akun` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_rab`
--
ALTER TABLE `detail_rab`
  MODIFY `ID_Detail_RAB` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `ID_Jurnal_Umum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `ID_Kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mandala`
--
ALTER TABLE `mandala`
  MODIFY `ID_Mandala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mandala_invitations`
--
ALTER TABLE `mandala_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_Pembayaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `ID_Pendaftaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `ID_RAB` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `ID_Volunteer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- Structure for view `view_total_anggaran_rab`
--
DROP TABLE IF EXISTS `view_total_anggaran_rab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_anggaran_rab`  AS SELECT `r`.`ID_RAB` AS `ID_RAB`, `r`.`ID_Kegiatan` AS `ID_Kegiatan`, `r`.`Tanggal` AS `Tanggal`, coalesce(sum(`d`.`Sub_Total`),0.00) AS `Total_Anggaran` FROM (`rab` `r` left join `detail_rab` `d` on(`r`.`ID_RAB` = `d`.`ID_RAB`)) GROUP BY `r`.`ID_RAB`, `r`.`ID_Kegiatan`, `r`.`Tanggal` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD CONSTRAINT `fk_detail_rab_rab` FOREIGN KEY (`ID_RAB`) REFERENCES `rab` (`ID_RAB`) ON UPDATE CASCADE;

--
-- Constraints for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `fk_jurnal_coa` FOREIGN KEY (`ID_Akun`) REFERENCES `coa` (`ID_Akun`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jurnal_pembayaran` FOREIGN KEY (`ID_Pembayaran`) REFERENCES `pembayaran` (`ID_Pembayaran`) ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `fk_kegiatan_mandala` FOREIGN KEY (`ID_Mandala`) REFERENCES `mandala` (`ID_Mandala`) ON UPDATE CASCADE;

--
-- Constraints for table `mandala_invitations`
--
ALTER TABLE `mandala_invitations`
  ADD CONSTRAINT `mandala_invitations_created_by_mandala_foreign` FOREIGN KEY (`created_by_mandala`) REFERENCES `mandala` (`ID_Mandala`) ON DELETE CASCADE,
  ADD CONSTRAINT `mandala_invitations_used_by_mandala_foreign` FOREIGN KEY (`used_by_mandala`) REFERENCES `mandala` (`ID_Mandala`) ON DELETE SET NULL;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pendaftaran` FOREIGN KEY (`ID_Pendaftaran`) REFERENCES `pendaftaran` (`ID_Pendaftaran`) ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_pendaftaran_kegiatan` FOREIGN KEY (`ID_Kegiatan`) REFERENCES `kegiatan` (`ID_Kegiatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pendaftaran_volunteer` FOREIGN KEY (`ID_Volunteer`) REFERENCES `volunteer` (`ID_Volunteer`) ON UPDATE CASCADE;

--
-- Constraints for table `rab`
--
ALTER TABLE `rab`
  ADD CONSTRAINT `fk_rab_kegiatan` FOREIGN KEY (`ID_Kegiatan`) REFERENCES `kegiatan` (`ID_Kegiatan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
