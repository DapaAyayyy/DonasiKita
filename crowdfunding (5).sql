-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2026 pada 16.24
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
-- Database: `crowdfunding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id_donasi` int(11) NOT NULL,
  `id_donatur` int(11) NOT NULL,
  `id_kampanye` int(11) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `tanggal_donasi` datetime DEFAULT current_timestamp(),
  `status_donasi` enum('pending','berhasil','gagal') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id_donasi`, `id_donatur`, `id_kampanye`, `id_metode`, `nominal`, `tanggal_donasi`, `status_donasi`) VALUES
(2, 1, 2, 1, 5000000.00, '2025-11-29 21:09:10', 'berhasil'),
(5, 4, 2, 1, 100000.00, '2025-11-30 09:33:02', 'berhasil'),
(6, 4, 2, 1, 100000.00, '2025-11-30 10:55:13', 'berhasil'),
(7, 4, 2, 1, 400000.00, '2025-11-30 11:47:50', 'berhasil'),
(8, 1, 2, 1, 400000.00, '2025-11-30 11:48:14', 'berhasil'),
(9, 1, 2, 1, 400000.00, '2025-11-30 11:48:26', 'gagal'),
(10, 1, 2, 2, 12000.00, '2025-11-30 11:51:08', 'berhasil'),
(11, 5, 2, 1, 1200000.00, '2025-11-30 11:54:37', 'berhasil'),
(12, 6, 18, 3, 100000.00, '2025-11-30 20:28:18', 'berhasil'),
(13, 4, 2, 3, 100000.00, '2025-12-01 08:52:08', 'berhasil'),
(14, 4, 17, 2, 106700.00, '2025-12-01 08:58:15', 'berhasil'),
(15, 6, 15, 2, 15000000.00, '2025-12-01 09:21:35', 'berhasil'),
(16, 4, 2, 3, 100000.00, '2025-12-01 11:48:00', 'berhasil'),
(17, 7, 2, 3, 1000000.00, '2025-12-02 17:12:07', 'berhasil'),
(18, 4, 2, 2, 120000.00, '2025-12-03 16:12:42', 'berhasil'),
(19, 4, 2, 2, 10000.00, '2025-12-03 16:17:10', 'berhasil'),
(22, 1, 19, 3, 10000000.00, '2025-12-03 20:36:08', 'berhasil'),
(25, 3, 21, 2, 100000.00, '2025-12-07 07:58:21', 'berhasil'),
(26, 4, 21, 1, 41300.00, '2025-12-08 03:31:19', 'berhasil'),
(27, 6, 21, 3, 1000000000.00, '2025-12-08 10:15:37', 'gagal'),
(28, 4, 2, 2, 100000.00, '2025-12-08 14:13:33', 'berhasil'),
(29, 4, 21, 2, 111111.00, '2025-12-16 15:06:58', 'gagal'),
(30, 4, 21, 2, 111111.00, '2025-12-16 15:09:11', 'gagal'),
(31, 4, 21, 1, 111111.00, '2025-12-16 15:09:18', 'berhasil'),
(32, 4, 21, 3, 10000.00, '2025-12-16 15:10:10', 'berhasil'),
(33, 9, 19, 1, 10000000.00, '2026-04-28 09:41:12', 'pending'),
(34, 1, 18, 1, 121212.00, '2026-04-28 10:38:18', 'berhasil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur`
--

CREATE TABLE `donatur` (
  `id_donatur` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donatur`
--

INSERT INTO `donatur` (`id_donatur`, `nama`, `email`, `password_hash`, `no_hp`, `alamat`, `tanggal_daftar`) VALUES
(1, 'Sultan Andara', 'sultan@gmail.com', 'pass123', '08123123123', 'Jaksel', '2025-11-29 21:09:10'),
(2, 'Orang Baik 1', 'baik1@gmail.com', 'pass123', '08123456001', 'embuh', '2025-11-29 21:09:10'),
(3, 'Mahasiswa Dermawan', 'mhs@gmail.com', 'pass123', '08123456002', 'no one know', '2025-11-29 21:09:10'),
(4, 'Daffa Ganteng', 'daffatest@gmail.com', 'admin12', '088888888899', 'test', '2025-11-29 22:54:20'),
(5, 'Absolute anon', 'daffatest1@gmail.com', 'admin123', '088888888887', 'Absolute Unknown', '2025-11-30 11:53:51'),
(6, 'Orang Baik', 'email@gmail.com', 'admin123', '0856767676767', 'Unnes', '2025-11-30 20:27:51'),
(7, 'orang gabut', 'gabut@gmail.com', 'gabut123', '0812345678', '', '2025-12-02 17:09:15'),
(9, 'Dapa Paku Payung', 'daffaazmi666@gmail.com', 'admin123', '088888888888', 'bebas', '2026-03-10 00:31:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal_feedback` datetime DEFAULT current_timestamp(),
  `id_donasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `komentar`, `tanggal_feedback`, `id_donasi`) VALUES
(1, 'Semoga dapat membantu mengurangi beban para keluarga yang terdampak (。・ω・。)', '2025-11-30 11:47:50', 7),
(3, 'Semoga dapat membantu mengurangi beban para keluarga yang terdampak (。・ω・。)', '2025-11-30 11:48:26', 8),
(5, 'Aku suka ayano', '2025-11-30 11:54:37', 11),
(6, 'test', '2025-11-30 20:28:18', 12),
(7, '\r\n67676767', '2025-12-01 08:52:08', 13),
(8, '67676767\r\n', '2025-12-01 08:58:15', 14),
(9, 'muaaat', '2025-12-01 09:21:35', 15),
(10, '676767', '2025-12-01 11:48:00', 16),
(11, 'cpat surut', '2025-12-02 17:12:07', 17),
(12, 'Semoga membantu', '2025-12-03 16:12:42', 18),
(14, 'Semoga bisa membantu anak muda..... \r\n(┬┬﹏┬┬)', '2025-12-07 07:58:21', 25),
(16, 'Semoga bisa membantu\r\n', '2025-12-08 14:13:33', 28),
(17, 'aaminnn', '2025-12-16 15:09:11', 30),
(18, 'aamiin', '2025-12-16 15:09:18', 31),
(19, 'test', '2025-12-16 15:10:10', 32),
(20, 'Semoga Bisa Membantu\r\n', '2026-04-28 09:41:12', 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kampanye_sosial`
--

CREATE TABLE `kampanye_sosial` (
  `id_kampanye` int(11) NOT NULL,
  `id_pengelola` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `judul_kampanye` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `target_donasi` decimal(15,2) NOT NULL,
  `terkumpul` decimal(15,2) DEFAULT 0.00,
  `foto_sampul` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` datetime DEFAULT current_timestamp(),
  `deadline` date NOT NULL,
  `status` enum('pending','aktif','selesai','dibatalkan') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kampanye_sosial`
--

INSERT INTO `kampanye_sosial` (`id_kampanye`, `id_pengelola`, `id_penerima`, `judul_kampanye`, `deskripsi`, `target_donasi`, `terkumpul`, `foto_sampul`, `tanggal_dibuat`, `deadline`, `status`) VALUES
(2, 1, 2, 'Darurat Banjir Desa Sukamaju', 'Kampanye ini dibuat untuk memenuhi kebutuhan logistik mendesak bagi warga Desa Sukamaju yang saat ini terdampak bencana banjir. Banyak keluarga kehilangan tempat tinggal, makanan, pakaian, serta akses terhadap air bersih. Kondisi di lapangan sangat memprihatinkan dan bantuan cepat diperlukan agar mereka dapat bertahan dalam masa darurat ini. Donasi Anda akan membantu menyediakan kebutuhan pokok seperti makanan siap saji, selimut, perlengkapan kebersihan, dan obat-obatan yang sangat mereka butuhkan.', 100000000.00, 3642000.00, 'banjir.jpg', '2025-11-29 21:09:10', '2025-12-31', 'aktif'),
(15, 1, 3, 'Bantuan Pengobatan Anak Penderita Penyakit Kronis', 'Kampanye ini ditujukan untuk membantu biaya pengobatan seorang anak dari keluarga kurang mampu yang tengah berjuang melawan penyakit kronis. Proses perawatan yang harus dijalani-mulai dari pemeriksaan rutin, pembelian obat-obatan, hingga tindakan medis lanjutan-memerlukan biaya besar yang tidak mampu ditanggung keluarga. Dukungan yang Anda berikan akan langsung digunakan untuk membiayai kebutuhan medisnya agar ia dapat memperoleh perawatan yang layak dan kesempatan untuk pulih. Setiap donasi memiliki arti besar dalam memperpanjang harapan dan menyelamatkan masa depannya.', 25000000.00, 27000000.00, 'pengobatan.jpg', '2025-11-30 11:35:47', '2025-12-31', 'selesai'),
(16, 1, 4, 'Renovasi Rumah Tidak Layak Huni untuk Keluarga Dhuafa', 'Kampanye ini dibuat untuk membantu sebuah keluarga kurang mampu yang tinggal di rumah tidak layak huni. Kondisi bangunan yang rusak parah-mulai dari atap bocor, dinding rapuh, hingga lantai yang tidak aman-menyebabkan mereka hidup dalam risiko setiap hari. Dana yang terkumpul akan digunakan untuk merenovasi rumah agar layak ditinggali, termasuk perbaikan struktur, penggantian atap, pengecatan, serta penyediaan kebutuhan dasar seperti pintu dan jendela. Dengan bantuan Anda, keluarga ini dapat tinggal di lingkungan yang aman, nyaman, dan lebih manusiawi.', 50000000.00, 22000000.00, 'renovasi_rumah.jpg', '2025-11-30 11:35:47', '2025-12-31', 'aktif'),
(17, 1, 5, 'Pengadaan Air Bersih untuk Desa Terdampak Kekeringan', 'Kampanye ini bertujuan untuk membantu warga desa yang sedang mengalami krisis air bersih akibat musim kemarau panjang. Banyak keluarga yang harus berjalan jauh hanya untuk mendapatkan sedikit air, sementara sebagian lainnya terpaksa menggunakan air tidak layak konsumsi. Melalui bantuan Anda, kami berupaya menyediakan solusi seperti pembangunan sumur bor, pengadaan toren air, atau pasokan air bersih sementara. Donasi Anda akan sangat membantu memastikan kebutuhan dasar masyarakat terpenuhi dan aktivitas sehari-hari dapat kembali berjalan dengan normal.', 30000000.00, 15106700.00, 'air_bersih.jpg', '2025-11-30 11:35:47', '2025-12-31', 'aktif'),
(18, 1, 6, 'Bantuan Darurat untuk Korban Tanah Longsor', 'Kampanye ini dibuat untuk memberikan bantuan darurat kepada warga yang terdampak bencana tanah longsor. Peristiwa ini menyebabkan rumah-rumah rusak, akses jalan tertutup, dan banyak keluarga harus mengungsi tanpa membawa barang-barang mereka. Dana yang terkumpul akan digunakan untuk menyediakan kebutuhan mendesak seperti makanan siap saji, selimut, perlengkapan kebersihan, air bersih, serta bantuan medis bagi korban luka. Partisipasi Anda akan membantu mempercepat pemulihan warga di masa sulit ini dan memberikan dukungan nyata bagi mereka yang kehilangan tempat tinggal.', 60000000.00, 42331212.00, 'longsor.jpg', '2025-11-30 11:35:47', '2025-12-31', 'aktif'),
(19, 1, 5, 'Bantuan Untuk Renovasi Sekolah di Pedesaan Kumuh', 'Kampanye ini dibuat untuk memberikan bantuan darurat kepada anak-anak yang membutuhkan sarana dan prasarana untuk menunjang pendidikan. Keadaan yang tidak memungkinkan membuat para anak-anak harus sekolah di tempat yang tidak layak. Dana yang terkumpul akan digunakan untuk menyediakan kebutuhan renovasi sekolah seperti atap, dinding, fasilitas sekolah, dan jaringan internet. Partisipasi Anda akan membantu memperkuat kualitas pendidikan dan memberikan dukungan nyata bagi mereka yang kekurangan pendidikan.', 90000000.00, 20000000.00, 'sampul_69303c85c8a721.79324774.jpeg', '2025-12-03 20:35:01', '2026-04-30', 'aktif'),
(21, 3, 9, 'Ayo Bantu Dapa Mewujudkan Mimpinya', 'Seorang mahasiswa bernama dapa tidak bisa membeli plushie karakter kesayangannya karena tidak memiliki uang, padahal dia sudah lama ingin membelinya. DAPATKAH KITA MEMBANTU MAHASISWA YANG MALANG INI????', 500000.00, 262411.00, 'sampul_6934d100cc7ef1.68012147.jpg', '2025-12-07 07:51:41', '2025-12-12', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_kampanye` int(11) NOT NULL,
  `id_pengelola` int(11) NOT NULL,
  `judul_laporan` varchar(200) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `file_lampiran` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_kampanye`, `id_pengelola`, `judul_laporan`, `isi_laporan`, `file_lampiran`, `tanggal_dibuat`) VALUES
(1, 2, 1, 'Donasi lagi woyyyyy', 'Masa baru 2 jt, tolong klik klik tombol donasinya le (╬▔皿▔)╯', 'laporan_1764554037___tateyama_ayano_kagerou_project_and_1_more_drawn_by_harino_harin0214__sample-6fb030d62342bf7cf21bd5bad1fa250e.jpg', '2025-12-01 08:53:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id_leaderboard` int(11) NOT NULL,
  `id_donatur` int(11) NOT NULL,
  `total_donasi` decimal(15,2) DEFAULT 0.00,
  `total_transaksi` int(11) DEFAULT 0,
  `level` varchar(50) DEFAULT 'Bronze'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `leaderboard`
--

INSERT INTO `leaderboard` (`id_leaderboard`, `id_donatur`, `total_donasi`, `total_transaksi`, `level`) VALUES
(1, 1, 16533212.00, 6, 'Gold'),
(2, 2, 50000.00, 1, 'Bronze'),
(3, 3, 120000.00, 2, 'Bronze'),
(4, 4, 1299111.00, 12, 'Silver'),
(5, 5, 1200000.00, 1, 'Silver'),
(6, 6, 15100000.00, 2, 'Gold'),
(7, 7, 1000000.00, 1, 'Silver'),
(9, 9, 0.00, 0, 'Bronze');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_metode` int(11) NOT NULL,
  `nama_metode` varchar(50) NOT NULL,
  `nomor_akun` varchar(50) NOT NULL,
  `status_aktif` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_metode`, `nama_metode`, `nomor_akun`, `status_aktif`) VALUES
(1, 'Transfer BCA', '1234567890', 'aktif'),
(2, 'GoPay', '08123456789', 'aktif'),
(3, 'QRIS', 'ID123456', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori_penerima` varchar(50) DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `deskripsi_kebutuhan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nama`, `kategori_penerima`, `alamat`, `no_hp`, `deskripsi_kebutuhan`) VALUES
(1, 'Panti Asuhan Kasih Ibu', 'Yayasan', 'Jl. Mawar No 10', '08111222333', 'Kebutuhan biaya sekolah dan makan anak panti'),
(2, 'Korban Banjir Desa A', 'Bencana', 'Desa Sukamaju', '08555666777', 'Kebutuhan logistik dan obat-obatan'),
(3, 'Anak Penderita Penyakit Kronis', 'Kesehatan', 'Alamat dirahasiakan', '081234567001', 'Bantuan biaya pengobatan dan perawatan'),
(4, 'Keluarga Dhuafa', 'Sosial', 'Lokasi Desa XYZ', '081234567002', 'Renovasi rumah tidak layak huni'),
(5, 'Desa Terdampak Kekeringan', 'Infrastruktur', 'Desa Harapan Jaya', '081234567003', 'Pengadaan air bersih dan sumur bor'),
(6, 'Korban Tanah Longsor', 'Bencana', 'Desa Maju Jaya', '081234567004', 'Bantuan darurat untuk korban longsor'),
(7, 'Sekolah Kumuh', 'Yayasan', 'https://maps.app.goo.gl/z5dfsCf6Qvn39jtM7', '0816735816251', ''),
(8, 'Pemerintah Indonesia', 'Yayasan', 'https://maps.app.goo.gl/7LAVdBdWQNFKoAKX8', '0816735816252', ''),
(9, 'Dapa Paku Payung', 'Individu', 'Pemalang', '086666666666', 'Aku mau plushie Hina hiks hiks');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengelola`
--

CREATE TABLE `pengelola` (
  `id_pengelola` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `role` enum('super_admin') NOT NULL DEFAULT 'super_admin',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengelola`
--

INSERT INTO `pengelola` (`id_pengelola`, `nama`, `email`, `password_hash`, `no_hp`, `role`, `status`) VALUES
(1, 'Admin Utama', 'admin@donasi.com', 'admin123', '08123456789', 'super_admin', 'aktif'),
(2, 'Admin Paris', 'paris@donasi.com', 'admin123', '08198765432', 'super_admin', 'aktif'),
(3, 'Admin Jaki', 'jaki@donasi.com', 'admin123', '081122334455', 'super_admin', 'aktif'),
(4, 'Admin Naila', 'naila@donasi.com', 'admin123', '081776655443', 'super_admin', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id_donasi`),
  ADD KEY `id_donatur` (`id_donatur`),
  ADD KEY `id_kampanye` (`id_kampanye`),
  ADD KEY `id_metode` (`id_metode`);

--
-- Indeks untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id_donatur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `fk_feedback_donasi` (`id_donasi`);

--
-- Indeks untuk tabel `kampanye_sosial`
--
ALTER TABLE `kampanye_sosial`
  ADD PRIMARY KEY (`id_kampanye`),
  ADD KEY `id_pengelola` (`id_pengelola`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_kampanye` (`id_kampanye`),
  ADD KEY `id_pengelola` (`id_pengelola`);

--
-- Indeks untuk tabel `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id_leaderboard`),
  ADD KEY `id_donatur` (`id_donatur`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_metode`);

--
-- Indeks untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- Indeks untuk tabel `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`id_pengelola`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kampanye_sosial`
--
ALTER TABLE `kampanye_sosial`
  MODIFY `id_kampanye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id_leaderboard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_metode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `id_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `donasi_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `donatur` (`id_donatur`),
  ADD CONSTRAINT `donasi_ibfk_2` FOREIGN KEY (`id_kampanye`) REFERENCES `kampanye_sosial` (`id_kampanye`),
  ADD CONSTRAINT `donasi_ibfk_3` FOREIGN KEY (`id_metode`) REFERENCES `metode_pembayaran` (`id_metode`);

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_donasi` FOREIGN KEY (`id_donasi`) REFERENCES `donasi` (`id_donasi`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kampanye_sosial`
--
ALTER TABLE `kampanye_sosial`
  ADD CONSTRAINT `kampanye_sosial_ibfk_1` FOREIGN KEY (`id_pengelola`) REFERENCES `pengelola` (`id_pengelola`),
  ADD CONSTRAINT `kampanye_sosial_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_kampanye`) REFERENCES `kampanye_sosial` (`id_kampanye`),
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`id_pengelola`) REFERENCES `pengelola` (`id_pengelola`);

--
-- Ketidakleluasaan untuk tabel `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `donatur` (`id_donatur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
