-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Feb 2025 pada 11.12
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_ukk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `penulis` varchar(250) NOT NULL,
  `penerbit` varchar(250) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `status` enum('tersedia','dipinjam') NOT NULL DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `cover`, `status`) VALUES
(6, 'kejuruan', 'prayoga', 'wiryawan', 2024, 'cover_67a17f9f69854.jpg', 'tersedia'),
(7, 'back end', 'alpin', 'pino', 2008, 'uploads/download (1).jpg', 'tersedia'),
(9, 'aku dan kamu', 'nandi', 'ambon', 20024, '67a1de91b7810.jpg', 'tersedia'),
(11, 'dia', 'prayoga', 'ahmat', 2015, '67a2b93589d48.jpg', 'tersedia'),
(12, 'au ah', 'wqedfwf', 'efrwrf', 2024, '67a30e94da434.jpg', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` enum('dipinjam','dikembalikan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(1, 17, 6, '2025-02-05', '2025-02-12', 'dipinjam'),
(2, 17, 6, '2025-02-05', '2025-02-12', 'dipinjam'),
(3, 17, 6, '2025-02-05', '2025-02-12', 'dipinjam'),
(4, 17, 6, '2025-02-05', '2025-02-12', 'dipinjam'),
(5, 15, 6, '2025-02-05', '2025-02-05', 'dikembalikan'),
(6, 17, 7, '2025-02-05', '2025-02-05', 'dikembalikan'),
(7, 18, 11, '2025-02-05', '2025-02-05', 'dikembalikan'),
(8, 17, 9, '2025-02-05', '2025-02-05', 'dikembalikan'),
(9, 18, 11, '2025-02-05', '2025-02-05', 'dikembalikan'),
(10, 17, 6, '2025-02-05', '2025-02-05', 'dikembalikan'),
(11, 17, 6, '2025-02-05', '2025-02-12', 'dipinjam'),
(12, 27, 7, '2025-02-05', '2025-02-12', 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nama_lengkap` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('admin','petugas','anggota','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`) VALUES
(15, 'pin', '$2y$10$XlMmST6akWUcagasIHcL6epFGvJlKXhisfKPsCooGXe', 'pin@gmail.com', 'pinokio', 'kaliangkrik', 'admin'),
(17, 'alpin', '', 'alpin@gmail.com', 'alpino', 'kaliangkrik', 'petugas'),
(18, 'apin', '', 'pino@gmail.com', 'pinko', 'kaliangkrik', 'anggota'),
(27, 'awan', '$2y$10$2kqVdf2e1tnIjoh9Fu1ed.0/622E2uIinW3M4q/jpmX', 'awan@gmail.com', 'awanan', 'kaliangkrik', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
