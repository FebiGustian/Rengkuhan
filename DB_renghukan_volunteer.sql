-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2026 pada 06.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renghukan volunteer`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `ID_Akun` int(10) UNSIGNED NOT NULL,
  `Nama_Akun` varchar(100) NOT NULL,
  `Jenis_Akun` varchar(50) NOT NULL,
  `Posisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_rab`
--

CREATE TABLE `detail_rab` (
  `ID_Detail_RAB` int(10) UNSIGNED NOT NULL,
  `ID_RAB` int(10) UNSIGNED NOT NULL,
  `Nama_Kebutuhan` varchar(150) NOT NULL,
  `Harga_Satuan` decimal(15,2) NOT NULL,
  `Kuantitas` int(10) UNSIGNED NOT NULL,
  `Sub_Total` decimal(17,2) GENERATED ALWAYS AS (`Harga_Satuan` * `Kuantitas`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `ID_Jurnal_Umum` int(10) UNSIGNED NOT NULL,
  `ID_Pembayaran` int(10) UNSIGNED NOT NULL,
  `ID_Akun` int(10) UNSIGNED NOT NULL,
  `Nominal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `ID_Mandala` int(10) UNSIGNED NOT NULL,
  `Nama_Kegiatan` varchar(150) NOT NULL,
  `Tanggal_Kegiatan` date NOT NULL,
  `Kuota` int(10) UNSIGNED NOT NULL,
  `Deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mandala`
--

CREATE TABLE `mandala` (
  `ID_Mandala` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Jabatan` varchar(100) DEFAULT NULL,
  `No_Telpon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_Pembayaran` int(10) UNSIGNED NOT NULL,
  `ID_Pendaftaran` int(10) UNSIGNED NOT NULL,
  `Nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `Metode_Pembayaran` varchar(50) DEFAULT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `ID_Pendaftaran` int(10) UNSIGNED NOT NULL,
  `ID_Volunteer` int(10) UNSIGNED NOT NULL,
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `Tanggal_Pendaftaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rab`
--

CREATE TABLE `rab` (
  `ID_RAB` int(10) UNSIGNED NOT NULL,
  `ID_Kegiatan` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_total_anggaran_rab`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_total_anggaran_rab` (
`ID_RAB` int(10) unsigned
,`ID_Kegiatan` int(10) unsigned
,`Tanggal` date
,`Total_Anggaran` decimal(39,2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `volunteer`
--

CREATE TABLE `volunteer` (
  `ID_Volunteer` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `No_Telpon` varchar(20) DEFAULT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_total_anggaran_rab`
--
DROP TABLE IF EXISTS `view_total_anggaran_rab`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_anggaran_rab`  AS SELECT `r`.`ID_RAB` AS `ID_RAB`, `r`.`ID_Kegiatan` AS `ID_Kegiatan`, `r`.`Tanggal` AS `Tanggal`, coalesce(sum(`d`.`Sub_Total`),0.00) AS `Total_Anggaran` FROM (`rab` `r` left join `detail_rab` `d` on(`r`.`ID_RAB` = `d`.`ID_RAB`)) GROUP BY `r`.`ID_RAB`, `r`.`ID_Kegiatan`, `r`.`Tanggal` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`ID_Akun`);

--
-- Indeks untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD PRIMARY KEY (`ID_Detail_RAB`),
  ADD KEY `idx_detail_rab` (`ID_RAB`);

--
-- Indeks untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`ID_Jurnal_Umum`),
  ADD KEY `idx_jurnal_pembayaran` (`ID_Pembayaran`),
  ADD KEY `idx_jurnal_akun` (`ID_Akun`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`ID_Kegiatan`),
  ADD KEY `idx_kegiatan_mandala` (`ID_Mandala`);

--
-- Indeks untuk tabel `mandala`
--
ALTER TABLE `mandala`
  ADD PRIMARY KEY (`ID_Mandala`),
  ADD UNIQUE KEY `uq_mandala_email` (`Email`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_Pembayaran`),
  ADD KEY `idx_pembayaran_pendaftaran` (`ID_Pendaftaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`ID_Pendaftaran`),
  ADD KEY `idx_pendaftaran_volunteer` (`ID_Volunteer`),
  ADD KEY `idx_pendaftaran_kegiatan` (`ID_Kegiatan`);

--
-- Indeks untuk tabel `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`ID_RAB`),
  ADD UNIQUE KEY `uq_rab_kegiatan` (`ID_Kegiatan`);

--
-- Indeks untuk tabel `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`ID_Volunteer`),
  ADD UNIQUE KEY `uq_volunteer_email` (`Email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `coa`
--
ALTER TABLE `coa`
  MODIFY `ID_Akun` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  MODIFY `ID_Detail_RAB` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `ID_Jurnal_Umum` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `ID_Kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mandala`
--
ALTER TABLE `mandala`
  MODIFY `ID_Mandala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID_Pembayaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `ID_Pendaftaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rab`
--
ALTER TABLE `rab`
  MODIFY `ID_RAB` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `ID_Volunteer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD CONSTRAINT `fk_detail_rab_rab` FOREIGN KEY (`ID_RAB`) REFERENCES `rab` (`ID_RAB`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `fk_jurnal_coa` FOREIGN KEY (`ID_Akun`) REFERENCES `coa` (`ID_Akun`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jurnal_pembayaran` FOREIGN KEY (`ID_Pembayaran`) REFERENCES `pembayaran` (`ID_Pembayaran`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `fk_kegiatan_mandala` FOREIGN KEY (`ID_Mandala`) REFERENCES `mandala` (`ID_Mandala`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pendaftaran` FOREIGN KEY (`ID_Pendaftaran`) REFERENCES `pendaftaran` (`ID_Pendaftaran`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_pendaftaran_kegiatan` FOREIGN KEY (`ID_Kegiatan`) REFERENCES `kegiatan` (`ID_Kegiatan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pendaftaran_volunteer` FOREIGN KEY (`ID_Volunteer`) REFERENCES `volunteer` (`ID_Volunteer`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rab`
--
ALTER TABLE `rab`
  ADD CONSTRAINT `fk_rab_kegiatan` FOREIGN KEY (`ID_Kegiatan`) REFERENCES `kegiatan` (`ID_Kegiatan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
