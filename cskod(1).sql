-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 02:57 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cskod`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id_absensi` int(11) UNSIGNED NOT NULL,
  `id_guru` int(11) NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpa') NOT NULL DEFAULT 'Hadir',
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id_absensi`, `id_guru`, `status`, `tanggal`, `keterangan`, `timestamp`) VALUES
(1, 2, 'Sakit', '2025-10-29', 'banget', '2025-10-29 03:59:03'),
(2, 1, 'Hadir', '2025-10-29', '', '2025-10-29 05:02:47'),
(4, 1, 'Alpa', '2025-10-30', '', '2025-10-30 01:02:09'),
(5, 2, 'Izin', '2025-10-30', 'l', '2025-10-30 01:02:09'),
(7, 1, 'Izin', '2025-11-05', '', '2025-11-05 03:45:39'),
(8, 4, 'Sakit', '2025-11-05', '', '2025-11-05 03:45:39'),
(9, 2, 'Hadir', '2025-11-05', '', '2025-11-05 03:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `email`, `no_telp`, `username`, `password`, `status`) VALUES
(1, 'Ali', 'Ali@ali.com', '098263729', 'Ali', 'AliAliAli', 'aktif'),
(2, 'Raib Estrini', 'Raib@raib.com', '085728187267', 'Raib', '$2y$10$5BBNPNLflBqfWyLSXe6IGeKheT0MTfIZ0EVopA35VGWcW8.yHdGCi', 'aktif'),
(4, 'Bibi GILL', 'GILL@gmail.com', '08327598303', 'GILL', '$2y$10$1dkeQAP/4wevuUBnV9j/fO/R2fei21U7xR5FoYNHDAxpzOpgY.lIa', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `tahun_ajaran` varchar(20) DEFAULT NULL,
  `id_guru_wali` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tahun_ajaran`, `id_guru_wali`) VALUES
(1, 'X PPLG', '2025/2026', 4),
(2, 'XI PPLG', '2025/2026', 1),
(4, 'XI PPLG', '2024/2025', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `status_aktif` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `deskripsi`, `id_guru`, `status_aktif`) VALUES
(1, 'Bahasa Indonesia', 'Y', 2, 'aktif'),
(5, 'Matematika', 'U', 2, 'nonaktif'),
(6, 'Matematika', 'A', 2, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_materi` varchar(255) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipe_file` enum('pdf','video','gambar') DEFAULT 'pdf',
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `judul_materi`, `deskripsi`, `file_materi`, `id_pertemuan`, `updated_at`, `tipe_file`, `status`) VALUES
(1, 'Bumi', 'Serial Dunia Paralel', 'q', 1, '2025-11-02 10:01:48', 'pdf', 'aktif'),
(2, 'Bulan', 'Bulan', 'W', 2, '2025-11-02 10:01:48', 'pdf', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `materi_murid`
--

CREATE TABLE `materi_murid` (
  `id_materi_murid` int(11) UNSIGNED NOT NULL,
  `id_materi` int(11) UNSIGNED NOT NULL,
  `id_murid` int(11) UNSIGNED NOT NULL,
  `status` enum('Belum Selesai','Selesai') NOT NULL DEFAULT 'Belum Selesai',
  `completed_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20251105100005);

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` int(11) UNSIGNED NOT NULL,
  `nama_murid` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('aktif','lulus') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `nama_murid`, `email`, `no_telp`, `username`, `password`, `status`) VALUES
(2, 'Eliana', 'Eliana@Eliana.com', '00983627284', 'Eliana', 'Eliana', 'aktif'),
(3, 'Pukat', 'Pukat@pukat.com', '09738732', 'Pukat', 'Pukat', 'aktif'),
(4, 'Mata', 'Mata@gmail.com', '0930724983', 'Mata-Hana-Tara', '$2y$10$82d67KtxsjgGNQsXvx/Dqe3Fayu2TR7I4CElV/2AScQk8Mg3a/ZKW', 'lulus'),
(5, 'Hana', 'Hana@gmail.com', '-9480932157-', 'Hana-Tara-Hata', '$2y$10$oM98qQyIezmfZICMfH/I2uEZf56tdrdiVVi5Ufbo.kHxeSyINxbAm', 'lulus');

-- --------------------------------------------------------

--
-- Table structure for table `murid_kelas`
--

CREATE TABLE `murid_kelas` (
  `id` int(11) NOT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid_kelas`
--

INSERT INTO `murid_kelas` (`id`, `id_murid`, `id_kelas`) VALUES
(3, 2, 1),
(4, 4, 4),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `murid_mapel`
--

CREATE TABLE `murid_mapel` (
  `id` int(11) NOT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid_mapel`
--

INSERT INTO `murid_mapel` (`id`, `id_murid`, `id_mapel`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_submission` int(11) DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `tanggal_nilai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_murid`, `id_mapel`, `id_submission`, `nilai`, `tanggal_nilai`) VALUES
(1, 1, 1, 1, '100.00', '2025-10-28 11:59:45'),
(2, 2, 2, 2, '2.00', '2025-11-12 11:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) UNSIGNED NOT NULL,
  `id_murid` int(11) UNSIGNED NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_murid`, `pesan`, `link`, `is_read`, `created_at`) VALUES
(1, 1, '11', '1', 1, '2025-11-05 04:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `nama_pertemuan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertemuan`
--

INSERT INTO `pertemuan` (`id_pertemuan`, `nama_pertemuan`, `tanggal`, `id_mapel`) VALUES
(1, 'Serial dunia paralele', '2025-10-15', 1),
(2, 'serial trilogy', '2025-11-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) UNSIGNED NOT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `nama_sertifikat` varchar(100) DEFAULT NULL,
  `tanggal_diterbitkan` date DEFAULT NULL,
  `template_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id_mapel`, `nama_sertifikat`, `tanggal_diterbitkan`, `template_file`) VALUES
(1, 1, 'Bumi', '2025-10-01', 'aw'),
(2, 2, 'kere', '2025-11-10', 'HHHHHH');

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat_murid`
--

CREATE TABLE `sertifikat_murid` (
  `id_sertifikat_murid` int(11) UNSIGNED NOT NULL,
  `id_sertifikat` int(11) UNSIGNED NOT NULL,
  `id_murid` int(11) UNSIGNED NOT NULL,
  `tanggal_dikeluarkan` date NOT NULL,
  `status_validasi` enum('valid','invalid') NOT NULL DEFAULT 'valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sertifikat_murid`
--

INSERT INTO `sertifikat_murid` (`id_sertifikat_murid`, `id_sertifikat`, `id_murid`, `tanggal_dikeluarkan`, `status_validasi`) VALUES
(1, 2, 2, '2025-11-19', 'invalid');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id_submission` int(11) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `id_murid` int(11) DEFAULT NULL,
  `file_submission` varchar(255) DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `status` enum('Dikirim','Dinilai','Terlambat') DEFAULT 'Dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id_submission`, `id_tugas`, `id_murid`, `file_submission`, `tanggal_kirim`, `status`) VALUES
(1, 1, 1, '1', '2025-10-30 12:01:25', 'Dikirim'),
(2, 2, 2, '2', '2025-11-25 11:47:49', 'Terlambat');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `judul_tugas` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `judul_tugas`, `deskripsi`, `deadline`, `id_mapel`, `id_pertemuan`, `updated_at`, `status`) VALUES
(1, '1', '1', '2025-10-30 12:01:41', 1, 1, '2025-11-02 10:01:48', 'aktif'),
(2, '2', '2', '2025-11-20 11:48:30', 2, 2, '2025-11-05 11:48:52', 'tidak aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_murid`
--

CREATE TABLE `tugas_murid` (
  `id_tugas_murid` int(11) UNSIGNED NOT NULL,
  `id_tugas` int(11) UNSIGNED NOT NULL,
  `id_murid` int(11) UNSIGNED NOT NULL,
  `status` enum('Belum Dikerjakan','Selesai','Dinilai') NOT NULL DEFAULT 'Belum Dikerjakan',
  `file_jawaban` varchar(255) DEFAULT NULL,
  `nilai` int(5) DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tugas_murid`
--

INSERT INTO `tugas_murid` (`id_tugas_murid`, `id_tugas`, `id_murid`, `status`, `file_jawaban`, `nilai`, `submitted_at`, `created_at`) VALUES
(2, 2, 2, 'Selesai', '2', 2, '2025-11-27 11:48:58', '2025-11-05 04:49:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `fk_absensi_guru` (`id_guru`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `idx_id_pertemuan` (`id_pertemuan`);

--
-- Indexes for table `materi_murid`
--
ALTER TABLE `materi_murid`
  ADD PRIMARY KEY (`id_materi_murid`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `murid_kelas`
--
ALTER TABLE `murid_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `murid_mapel`
--
ALTER TABLE `murid_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_murid_mapel` (`id_murid`,`id_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`),
  ADD KEY `idx_id_mapel` (`id_mapel`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`);

--
-- Indexes for table `sertifikat_murid`
--
ALTER TABLE `sertifikat_murid`
  ADD PRIMARY KEY (`id_sertifikat_murid`),
  ADD KEY `fk_sertifikat_murid_sertifikat` (`id_sertifikat`),
  ADD KEY `fk_sertifikat_murid_murid` (`id_murid`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id_submission`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `tugas_murid`
--
ALTER TABLE `tugas_murid`
  ADD PRIMARY KEY (`id_tugas_murid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id_absensi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materi_murid`
--
ALTER TABLE `materi_murid`
  MODIFY `id_materi_murid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id_murid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `murid_kelas`
--
ALTER TABLE `murid_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `murid_mapel`
--
ALTER TABLE `murid_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sertifikat_murid`
--
ALTER TABLE `sertifikat_murid`
  MODIFY `id_sertifikat_murid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id_submission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tugas_murid`
--
ALTER TABLE `tugas_murid`
  MODIFY `id_tugas_murid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD CONSTRAINT `fk_absensi_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sertifikat_murid`
--
ALTER TABLE `sertifikat_murid`
  ADD CONSTRAINT `fk_sertifikat_murid_murid` FOREIGN KEY (`id_murid`) REFERENCES `murid` (`id_murid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sertifikat_murid_sertifikat` FOREIGN KEY (`id_sertifikat`) REFERENCES `sertifikat` (`id_sertifikat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
