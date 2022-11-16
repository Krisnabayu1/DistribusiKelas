-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2022 pada 03.01
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
-- Database: `phpcrud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `sesi_jam` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam`
--

INSERT INTO `jam` (`id_jam`, `sesi_jam`) VALUES
(1, '07.00'),
(2, '08.30'),
(3, '10.30'),
(4, '13.00'),
(5, '14.30'),
(6, '16.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kloter`
--

CREATE TABLE `kloter` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `Kelas` varchar(50) NOT NULL,
  `tutor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kloter`
--

INSERT INTO `kloter` (`id`, `nama`, `jam`, `Kelas`, `tutor`) VALUES
(1, 'Basic Speaking', '07.00', 'Rostov', 'Ms Rindu'),
(2, 'Speaking 1', '07.00', 'Rostov', 'Mr Zul'),
(3, 'Speaking 4', '07.00', 'Grozny', 'Ms tia'),
(4, 'Speaking 4 (Integrated)', '08.30', 'Kazan', 'Mr Zul'),
(5, 'Reading for IELTS', '14.30', 'ST. Petersburg', 'Ms Eti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kloter` varchar(50) NOT NULL,
  `notelp` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama`, `id_kloter`, `notelp`, `alamat`) VALUES
(81, 'lala', 'Basic Speaking', '089767856473', 'sukabumi'),
(82, 'lulu', 'Basic Speaking', '089767856473', 'sukapura'),
(83, 'lili', 'Basic Speaking', '089767856473', 'Papua'),
(84, 'lia', 'Basic Speaking', '089767856473', 'Nugini'),
(85, 'lisa', 'Basic Speaking', '089767856473', 'Kidul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` varchar(11) NOT NULL,
  `nama_ruangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`) VALUES
('A001', 'Rostov'),
('A002', ' Kazan'),
('A003', 'ST. Petersburg'),
('A004', 'Grozny');

-- --------------------------------------------------------

--
-- Struktur dari tabel `speaking1`
--

CREATE TABLE `speaking1` (
  `jam` varchar(50) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `tutor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `nama_subject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subject`
--

INSERT INTO `subject` (`id_subject`, `nama_subject`) VALUES
(1001, 'Basic Speaking'),
(1002, 'Speaking 1'),
(1003, 'Speaking 2'),
(1004, 'Speaking 3'),
(1005, 'Speaking 4 (Integrated)'),
(1006, 'Speaking for IELTS 1'),
(1007, 'Speaking for IELTS 2'),
(1008, 'Speaking for IELTS 3'),
(1009, 'Public Speaking '),
(1010, 'Grammar for Speaking'),
(1011, 'Job Interview'),
(2001, 'Vocabulary in Use 1'),
(2002, 'Vocabulary in Use 2'),
(2003, 'Vocabulary In Use 3'),
(2004, 'Vocabulary for IELTS'),
(2005, 'Vocabulary for TOEFL'),
(3001, 'Pronunciation 1'),
(3002, 'Pronunciation 2'),
(4001, 'Basic Listening'),
(4002, 'Listening'),
(4003, 'Listening for IELTS'),
(4004, 'Listening for TOEFL 1'),
(4005, 'Listening for TOEFL 2'),
(5001, 'Grammar 1'),
(5002, 'Grammar 2'),
(5003, 'Grammar for Writing 1'),
(5004, 'Grammar for Writing 2'),
(5005, 'Grammar for TOEFL 1'),
(5006, 'Grammar for TOEFL 2'),
(5007, 'Grammar for IELTS 1'),
(5008, 'Grammar for IELTS 2'),
(6001, 'Academic Writing 1'),
(6002, 'Academic Writing 2'),
(6003, 'Business Writing (IELTS GT)'),
(6004, 'Pre-Writing IELTS'),
(6005, 'Writing for IELTS 1'),
(6006, 'Writing for IELTS 2'),
(6007, 'Scholarship Essay'),
(7001, 'Basic Reading'),
(7002, 'Intermediate Reading'),
(7003, 'Reading for IELTS'),
(7004, 'Reading for TOEFL 1'),
(7005, 'Reading for TOEFL 2'),
(8001, 'TOEFL Scoring'),
(8002, 'IELTS Scoring');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int(255) NOT NULL,
  `tutor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `tutor`) VALUES
(11, 'Mr Badar'),
(12, 'Ms Rindu'),
(13, 'Mr Zul'),
(15, 'Ms Eti');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `kloter`
--
ALTER TABLE `kloter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`);

--
-- Indeks untuk tabel `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_tutor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kloter`
--
ALTER TABLE `kloter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
