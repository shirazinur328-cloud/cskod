-- SQL INSERT statements for sample data (assuming correct schema after migration)

-- Sample data for 'pertemuan' table
INSERT INTO `pertemuan` (`id_mapel`, `judul_pertemuan`, `deskripsi`, `waktu_mulai`, `link_meeting`, `created_at`) VALUES
(1, 'Pengantar Bahasa Indonesia', 'Pertemuan pertama membahas dasar-dasar Bahasa Indonesia.', '2025-11-10 09:00:00', 'https://meet.google.com/abc-defg-hij', NOW()),
(1, 'Tata Bahasa dan Ejaan', 'Mempelajari kaidah tata bahasa dan ejaan yang benar.', '2025-11-17 10:00:00', NULL, NOW()),
(1, 'Diskusi Sastra', 'Diskusi mengenai karya sastra pilihan.', '2025-11-24 11:00:00', 'https://zoom.us/j/123456789', NOW());

-- Sample data for 'materi' table
-- Note: 'konten' is used instead of 'deskripsi', 'urutan' and 'created_at' are included.
INSERT INTO `materi` (`id_mapel`, `judul_materi`, `konten`, `file_materi`, `urutan`, `created_at`) VALUES
(1, 'Pengenalan Kata Benda', 'Materi ini membahas tentang definisi, jenis-jenis, dan contoh kata benda dalam Bahasa Indonesia.', NULL, 1, NOW()),
(1, 'Struktur Kalimat Efektif', 'Pelajari bagaimana menyusun kalimat yang efektif, jelas, dan mudah dipahami.', 'struktur_kalimat.pdf', 2, NOW()),
(1, 'Latihan Menulis Paragraf', 'Panduan dan latihan untuk menulis paragraf yang koheren dan padu.', NULL, 3, NOW());

-- Sample data for 'tugas' table
-- Note: 'deskripsi' and 'created_at' are included.
INSERT INTO `tugas` (`id_mapel`, `judul_tugas`, `deskripsi`, `deadline`, `created_at`) VALUES
(1, 'Tugas 1: Identifikasi Kata Benda', 'Identifikasi 10 kata benda dari teks yang diberikan dan kelompokkan berdasarkan jenisnya.', '2025-12-15 23:59:59', NOW()),
(1, 'Tugas 2: Perbaikan Kalimat', 'Perbaiki 5 kalimat yang tidak efektif menjadi kalimat yang lebih baik.', '2025-12-20 23:59:59', NOW()),
(1, 'Tugas 3: Esai Singkat', 'Tulis esai singkat (minimal 200 kata) tentang pentingnya menjaga kebersihan lingkungan.', '2026-01-05 23:59:59', NOW());
