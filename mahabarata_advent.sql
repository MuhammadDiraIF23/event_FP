-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2024 pada 10.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahabarata_advent`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `created_at`, `role`) VALUES
(1, '123', 'muhammaddira752@gmail.com', '$2y$10$QVQ2bo1.bOV5yCt3b6ZD3.2iLmgTMHC8u.PHHFtaSQbuwG.Maf0bS', '2024-11-09 09:01:52', 'user'),
(2, '123', 'nanda@gmail.com', '$2y$10$4xY5Lobu3NSoMmOwutZKV.rNS74AHG/XJ0JOjLpeHE94Ov6ke3xR.', '2024-11-09 09:13:40', 'user'),
(3, '089122678', 'Sadam@gmail.com', '$2y$10$It2812F7TgUtBkk71p3io.qwL8l2qJgmkwHAr69q7d2zUqv2R.h/q', '2024-11-10 03:48:11', 'user'),
(6, '', 'Mdira@gmail.com', '$2y$10$ybYxFWleQ/hR6WDHmiY4MuisQ1socOIpC5O/CVT5ePX/AR.IcCeoO', '2024-11-10 07:00:28', 'admin'),
(7, '', 'Naufal@gmail.com', '$2y$10$uhr0Mx46m1KSdlyWSY7gZe7iz42/R8tumAplDlZW0Vn8oYk6wAO.q', '2024-11-10 07:01:46', 'admin'),
(8, '', 'Nando@gmail.com', '$2y$10$dBYhYSWXZFUSldIFQ7Q2FOMjUdOPVf49tONH64tHByVcF4RLZS2IW', '2024-11-10 07:03:24', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
