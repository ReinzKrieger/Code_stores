-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2020 pada 07.51
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminlte`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` varchar(25) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('1', 'Perabotan'),
('2', 'Entertainment'),
('3', 'Kipas'),
('4', 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `description` text NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `description`, `category`) VALUES
('5ef83cdf61062', 'Kulkas 1', 4000000, '5ef83cdf61062.png', 'Kulkas Dingin', 'Perabotan'),
('5ef84a1f3e50d', 'Kulkas 2', 3000000, '5ef84a1f3e50d.png', 'Kulkas Dingin Sekali', 'Perabotan'),
('5ef84bc31cfd8', 'Kulkas 3', 1600000, '5ef84bc31cfd8.png', 'Kulkas Sangat Dingin Sekali', 'Perabotan'),
('5ef84bed12355', 'Kipas Angin 1', 200000, '5ef84bed12355.jpg', 'Kipas Angin 1', 'Kipas'),
('5ef84c09593e8', 'Kipas Angin 2', 150000, '5ef84c09593e8.jpg', 'Kipas Angin 2', 'Kipas'),
('5ef84c1cc8936', 'Kipas Angin 3', 300000, '5ef84c1cc8936.jpg', 'Kipas Angin 3', 'Kipas'),
('5ef84ca83cd5f', 'Televisi 1', 4000000, '5ef84ca83cd5f.png', 'Televisi 1', 'Entertainment'),
('5ef84cbee50d3', 'Televisi 2', 5000000, '5ef84cbee50d3.png', 'Televisi 2', 'Entertainment'),
('5ef84ce02eaee', 'Televisi 3', 3000000, '5ef84ce02eaee.png', 'Televisi 3', 'Entertainment'),
('5ef84d0232bff', 'Rice Cooker 1', 500000, '5ef84d0232bff.jpg', 'Rice Cooker 1', 'Perabotan'),
('5ef84d1ae9732', 'Rice Cooker 2', 450000, '5ef84d1ae9732.jpg', 'Rice Cooker 2', 'Perabotan'),
('5ef84e0e8c52b', 'Rice Cooker 3', 550000, '5ef84e0e8c52b.jpg', 'Rice Cooker 3', 'Perabotan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `role_id`, `is_active`) VALUES
(1, 'Fahmi Ihza Nugroho', 'fahmiihza90@gmail.com', 'reinne', '170566afb86b37c41b3ead102e4d7315', 1, 1),
(2, 'Hinelle', 'famztrooper90@gmail.com', 'Hinelia', 'da16b4a6a379d21f344b8d56fcf2828e', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
