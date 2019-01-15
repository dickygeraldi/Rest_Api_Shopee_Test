-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2019 pada 14.18
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exchange_currencies`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `exchange_rate`
--

CREATE TABLE `exchange_rate` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `rate` float NOT NULL,
  `deleted_at` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `exchange_rate`
--

INSERT INTO `exchange_rate` (`id`, `date`, `rate`, `deleted_at`, `user_id`, `track_id`) VALUES
(25, '2018-07-01', 0.98732, NULL, 1, 1),
(26, '2018-07-02', 1.23849, NULL, 1, 1),
(27, '2018-07-03', 1.74783, NULL, 1, 1),
(28, '2018-07-04', 1.63542, NULL, 1, 1),
(30, '2018-07-05', 1.74623, NULL, 1, 1),
(31, '2018-07-06', 1.56734, NULL, 1, 1),
(32, '2018-07-07', 1.89742, NULL, 1, 1),
(34, '2018-07-01', 0.98312, NULL, 1, 6),
(35, '2018-07-02', 0.93842, NULL, 1, 6),
(36, '2018-07-03', 0.98321, NULL, 1, 6),
(37, '2018-07-04', 1.98342, NULL, 1, 6),
(38, '2018-07-05', 1.8394, NULL, 1, 6),
(39, '2018-07-06', 1.98342, NULL, 1, 6),
(40, '2018-07-07', 1.8394, NULL, 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `from` varchar(3) NOT NULL,
  `to` varchar(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delete_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `track`
--

INSERT INTO `track` (`id`, `from`, `to`, `user_id`, `delete_at`) VALUES
(1, 'GBP', 'USD', 1, NULL),
(3, 'IDR', 'IDR', 2, NULL),
(6, 'JPY', 'IDR', 1, NULL),
(7, 'USD', 'GBP', 9, NULL),
(13, 'IDR', 'IDR', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`email`, `nama`, `id`, `password`, `token`) VALUES
('dickygeraldi@gmail.com', 'Dicky', 1, '0ba71dbf22876cb22600d1d55d304f9d', '91dd45c24ce1bb473c5ec66029f9b640'),
('dickygeraldi1@gmail.com', 'Dicky1', 2, '31a43db0e5541ad470cd08ff674a9d49', ''),
('ganisyusuf2397@gmail.com', 'Ganis', 3, 'f4755f4a8ac1b202b82681211e4f30d0', ''),
('gm.yusuf@gigel.id', 'Ganis', 4, '8ced56f9db000b5799c14efa3d2f1745', ''),
('gm@gigel.id', 'Ganis', 5, '8ced56f9db000b5799c14efa3d2f1745', ''),
('yuu@gmail.com', 'Ganis', 6, '8ced56f9db000b5799c14efa3d2f1745', ''),
('Dickygeraldi21@gmail.com', 'nd', 7, '8ced56f9db000b5799c14efa3d2f1745', ''),
('dk@gmail.com', 'eqw', 8, 'c487ed6e5d432f16de3f2d3001ced48a', ''),
('ganis@gmail.com', 'cantik', 9, 'b73da79256a519688bb2a905597d82e6', '9d1354aff89425f5dfc9c5c436515324');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `exchange_rate`
--
ALTER TABLE `exchange_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `exchange_rate`
--
ALTER TABLE `exchange_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
