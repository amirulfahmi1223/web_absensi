-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Des 2022 pada 00.43
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` char(13) NOT NULL,
  `nisn` int(12) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `jk` varchar(120) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `absen` int(5) NOT NULL,
  `tgl_absen` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_absen`
--

INSERT INTO `tb_absen` (`id_absen`, `nisn`, `nama_siswa`, `jk`, `id_kelas`, `absen`, `tgl_absen`) VALUES
('A19122022001', 59223933, 'AMIRUL MUKMININ', 'Laki-Laki', 1, 12, '2022-12-19 02:55:26'),
('A20122022002', 59223933, 'AMIRUL MUKMININ', 'Laki-Laki', 1, 12, '2022-12-20 00:14:16'),
('A20122022006', 62152919, 'ALEX SISWATO', 'Laki-Laki', 9, 12, '2022-12-20 08:40:48'),
('A20122022008', 59223933, 'AMIRUL MUKMININ', 'Laki-Laki', 1, 12, '2022-12-20 10:14:46'),
('A20122022009', 28362537, 'NADIA MILIANA', 'Perempuan', 8, 23, '2022-12-20 11:52:43'),
('A20122022010', 2147483647, 'ABDULLAH IHFAR', 'Laki-Laki', 7, 1, '2022-12-20 11:55:06'),
('A21122022011', 28362537, 'NADIA MILIANA', 'Perempuan', 8, 23, '2022-12-20 23:46:04'),
('A21122022012', 2339280, 'M.AMIRUL FAHMI', 'Laki-Laki', 6, 18, '2022-12-20 23:54:42'),
('A22122022013', 2339280, 'M.AMIRUL FAHMI', 'Laki-Laki', 6, 18, '2022-12-22 01:59:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `level` enum('Admin','Guru') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `email`, `password`, `foto`, `level`) VALUES
(5, 'M.AMIRUL FAHMI', 'amirulfahmi148@gmail.com', '123', '63a65caebe09d.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `logo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `jurusan`, `logo`) VALUES
(1, 'XI RPL', 'REKAYASA PERANGKAT LUNAK', '639d317b04824.jpg'),
(2, 'XI TP', 'TEKNIK PENGELESAN', '639d34b41d9e4.jpeg'),
(6, 'XI GP', 'GEOLOGI PERTAMBANGAN', '639d322a94a69.jpeg'),
(7, 'XI APH', 'PERHOTELAN', '639d35104987c.jpeg'),
(8, 'XI TB', 'TATA BOGA', '639d353dc1d98.jpeg'),
(9, 'XI ATR', 'AGROBISNIS TERNAK RUMINANSIA', '639d35613771f.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` int(14) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `absen` int(5) NOT NULL,
  `gambar` varchar(120) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nama_siswa`, `id_kelas`, `absen`, `gambar`, `jk`, `tanggal_lahir`, `alamat`, `status`, `password`) VALUES
(59223933, 'M.AMIRUL FAHMI', 1, 18, '63a6500995d1e.jpg', 'Laki-Laki', '2005-06-09', 'BOJONEGORO', 1, 'SMKN42022001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
