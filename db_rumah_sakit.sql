-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2024 pada 09.23
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rumah_sakit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `telp_admin` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `telp_admin`, `username`, `password`) VALUES
(1, 'Lutfi Ariski', '089635715403', 'lutfi', '$2y$10$yGu7M6Nf/iJtGgfwhDEv/u.rAYAIPY..tGEzrn3AqUZfV226ShXDS'),
(4, 'Amanda Risu', '087711223344', 'amanda', '$2y$10$7zkjZ6qTgOFfyXBeRlf/IOC1LK0nBf2dD8TFgWaNFVI.rI4JwKEgG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `telp_dokter` varchar(15) NOT NULL,
  `spesialis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `telp_dokter`, `spesialis`) VALUES
(1, 'Aldo Hermawan', '085810727518', 'Umum'),
(2, 'Yasmin', '081212341235', 'Gigi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `telp_pasien` varchar(15) NOT NULL,
  `penyakit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `id_dokter`, `nama_pasien`, `jenis_kelamin`, `telp_pasien`, `penyakit`) VALUES
(1, 1, 'Andri', 'Laki-laki', '087808675313', 'Demam berdarah'),
(2, 1, 'Aisyah', 'Perempuan', '08989435796', 'Asam lambung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `lama_nginap` int(11) NOT NULL,
  `pembayaran` enum('Belum Dibayar','Lunas') NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_ruangan`, `id_pasien`, `lama_nginap`, `pembayaran`, `tanggal`, `id_admin`) VALUES
(3, 2, 1, 4, 'Lunas', '2023-06-03', 1),
(4, 1, 2, 3, 'Belum Dibayar', '2023-06-03', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `jenis_ruangan` varchar(50) NOT NULL,
  `harga_permalam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruangan`, `jenis_ruangan`, `harga_permalam`) VALUES
(1, 'ICU', 3000000),
(2, 'Perawatan Umum', 500000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_ruangan` (`id_ruangan`,`id_pasien`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD CONSTRAINT `tb_pasien_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `tb_dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`id_ruangan`) REFERENCES `tb_ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
