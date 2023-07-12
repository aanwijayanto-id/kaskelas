-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jul 2023 pada 21.19
-- Versi server: 8.0.33
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaskelas_awpro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_balance`
--

CREATE TABLE `db_balance` (
  `id_balance` int NOT NULL,
  `type` int NOT NULL,
  `id_category` int DEFAULT NULL,
  `nominal` varchar(255) NOT NULL,
  `id_user` int DEFAULT NULL,
  `keterangan` text,
  `date_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_category`
--

CREATE TABLE `db_category` (
  `id_category` int NOT NULL,
  `category` varchar(255) NOT NULL,
  `ket_category` text,
  `type_cat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_role`
--

CREATE TABLE `db_role` (
  `id_role` int NOT NULL,
  `role` varchar(25) NOT NULL,
  `pengguna` int NOT NULL,
  `data_kas` int NOT NULL,
  `laporan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `db_role`
--

INSERT INTO `db_role` (`id_role`, `role`, `pengguna`, `data_kas`, `laporan`) VALUES
(1, 'administrator', 1, 1, 1),
(2, 'sekretaris', 0, 1, 1),
(3, 'siswa', 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_users`
--

CREATE TABLE `db_users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `db_users`
--

INSERT INTO `db_users` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'System Admin', 'admin@domain.com', 'logo-squere.png', '$2y$10$Mlha.BrszbalkrYt8POgVO2MtcUZoSqLhxCIml.kTQPXLhdz5BS0S', 1, 1, '2020-12-14 08:00:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_balance`
--
ALTER TABLE `db_balance`
  ADD PRIMARY KEY (`id_balance`),
  ADD KEY `category` (`id_category`),
  ADD KEY `user` (`id_user`);

--
-- Indeks untuk tabel `db_category`
--
ALTER TABLE `db_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `db_role`
--
ALTER TABLE `db_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `db_balance`
--
ALTER TABLE `db_balance`
  MODIFY `id_balance` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `db_category`
--
ALTER TABLE `db_category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `db_role`
--
ALTER TABLE `db_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `db_users`
--
ALTER TABLE `db_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `db_balance`
--
ALTER TABLE `db_balance`
  ADD CONSTRAINT `category` FOREIGN KEY (`id_category`) REFERENCES `db_category` (`id_category`) ON DELETE SET NULL,
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `db_users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `db_users`
--
ALTER TABLE `db_users`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `db_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
