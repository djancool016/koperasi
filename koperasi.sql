-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2021 pada 19.23
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id_angt` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_kode` int(5) NOT NULL DEFAULT 1,
  `kode_angt` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_unit` int(3) NOT NULL,
  `tgl_msk` date NOT NULL DEFAULT current_timestamp(),
  `id_status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_anggota`
--

INSERT INTO `t_anggota` (`id_angt`, `id_kode`, `kode_angt`, `nama`, `id_unit`, `tgl_msk`, `id_status`) VALUES
(00003, 1, 'ANG00003', 'Dwi Julianto X', 11, '2021-04-21', 1),
(00004, 1, 'ANG00004', 'Test 2', 1, '2021-04-21', 1),
(00069, 1, 'ANG00069', 'Dwi Julianto', 3, '2021-04-26', 1),
(00070, 1, 'ANG00070', 'Dwi Julianto', 3, '2021-04-26', 1),
(00071, 1, 'ANG00071', 'Dwi Julianto', 2, '2021-04-26', 1),
(00072, 1, 'ANG00072', 'Luis Erik Adhila', 2, '2021-04-27', 1),
(00073, 1, 'ANG00073', 'Dwi Julianto', 3, '2021-04-27', 1),
(00074, 1, 'ANG00074', 'Luis Erik Adhila', 3, '2021-04-27', 1),
(00075, 1, 'ANG00075', 'Dwi Julianto', 2, '2021-04-27', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jenis_trans`
--

CREATE TABLE `t_jenis_trans` (
  `id_jenis_trans` int(3) NOT NULL,
  `jenis_trans` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_jenis_trans`
--

INSERT INTO `t_jenis_trans` (`id_jenis_trans`, `jenis_trans`) VALUES
(1, 'Pokok'),
(2, 'Wajib'),
(3, 'Sukarela');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kode`
--

CREATE TABLE `t_kode` (
  `id_kode` int(5) NOT NULL,
  `kode` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kode`
--

INSERT INTO `t_kode` (`id_kode`, `kode`, `deskripsi`) VALUES
(1, 'ANG', 'Anggota'),
(2, 'SIM', 'Simpan'),
(3, 'INV/S/', 'Invoice Transaksi Simpan'),
(4, 'INV/A/', 'Invoice Transaksi Angsuran'),
(5, 'PJM', 'Kode Pinjaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pinjam`
--

CREATE TABLE `t_pinjam` (
  `id_pinj` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_kode` int(3) NOT NULL DEFAULT 5,
  `kode_pinj` varchar(15) NOT NULL,
  `kode_angt` varchar(15) NOT NULL,
  `tgl_pinj` date NOT NULL DEFAULT current_timestamp(),
  `pinj` int(11) NOT NULL,
  `bunga_pinj` int(11) NOT NULL,
  `jml_bunga_pinj` int(11) NOT NULL,
  `tenor` int(11) NOT NULL,
  `angs_ke` int(11) NOT NULL,
  `jml_angs` int(11) NOT NULL,
  `jml_pinj` int(11) NOT NULL,
  `jml_msk` int(11) NOT NULL,
  `sisa_pinj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pinjam`
--

INSERT INTO `t_pinjam` (`id_pinj`, `id_kode`, `kode_pinj`, `kode_angt`, `tgl_pinj`, `pinj`, `bunga_pinj`, `jml_bunga_pinj`, `tenor`, `angs_ke`, `jml_angs`, `jml_pinj`, `jml_msk`, `sisa_pinj`) VALUES
(00001, 5, 'PJM00001', 'ANG00003', '2021-04-26', 1000000, 5, 50000, 10, 0, 105000, 1050000, 0, 1050000),
(00002, 5, 'PJM00002', 'ANG00004', '2021-04-27', 1250000, 5, 62500, 10, 1, 131250, 1312500, 200000, 1112500),
(00003, 5, 'PJM00003', 'ANG00004', '2021-04-27', 1250000, 5, 62500, 10, 1, 131250, 1312500, 120000, 1192500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_simpan`
--

CREATE TABLE `t_simpan` (
  `id_simpan` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_kode` int(5) NOT NULL DEFAULT 2,
  `kode_simpan` varchar(10) NOT NULL,
  `kode_angt` varchar(15) NOT NULL,
  `pokok` int(11) NOT NULL,
  `wajib` int(11) NOT NULL,
  `sukarela` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_simpan`
--

INSERT INTO `t_simpan` (`id_simpan`, `id_kode`, `kode_simpan`, `kode_angt`, `pokok`, `wajib`, `sukarela`, `jumlah`) VALUES
(00002, 2, 'SIM00002', 'ANG00004', 600000, 10000, 0, 610000),
(00038, 2, 'SIM00038', 'ANG00003', 0, 5000, 1000000, 1005000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_status`
--

CREATE TABLE `t_status` (
  `id_status` int(3) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_status`
--

INSERT INTO `t_status` (`id_status`, `status`, `keterangan`) VALUES
(1, 'Aktif', ''),
(2, 'Tidak Aktif', ''),
(3, 'Lancar', ''),
(4, 'Lunas', ''),
(5, 'Macet', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_trans_angs`
--

CREATE TABLE `t_trans_angs` (
  `id_trans` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_kode` int(3) NOT NULL DEFAULT 4,
  `kode_trans_angs` varchar(15) NOT NULL,
  `kode_pinj` varchar(15) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp(),
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_trans_angs`
--

INSERT INTO `t_trans_angs` (`id_trans`, `id_kode`, `kode_trans_angs`, `kode_pinj`, `tgl`, `nominal`) VALUES
(00006, 4, 'INV/A/00006', 'PJM00003', '2021-04-30 16:03:27', 120000),
(00008, 4, 'INV/A/00008', 'PJM00002', '2021-04-30 16:39:14', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_trans_simp`
--

CREATE TABLE `t_trans_simp` (
  `id_trans` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_kode` int(5) NOT NULL DEFAULT 3,
  `kode_trans_simp` varchar(15) NOT NULL,
  `kode_simpan` varchar(15) NOT NULL,
  `id_jenis_trans` int(3) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT current_timestamp(),
  `nominal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_trans_simp`
--

INSERT INTO `t_trans_simp` (`id_trans`, `id_kode`, `kode_trans_simp`, `kode_simpan`, `id_jenis_trans`, `tgl`, `nominal`) VALUES
(000001, 3, 'INV/S/000001', 'SIM00002', 1, '2021-04-26 15:21:05', 100000),
(000002, 3, 'INV/S/000002', 'SIM00002', 2, '2021-04-26 15:21:53', 5000),
(000007, 3, 'INV/S/000007', 'SIM00038', 2, '2021-04-26 16:39:28', 5000),
(000008, 3, 'INV/S/000008', 'SIM00038', 3, '2021-04-26 16:41:13', 1000000),
(000009, 3, 'INV/S/000009', 'SIM00002', 2, '2021-04-26 16:41:39', 5000),
(000010, 3, 'INV/S/000010', 'SIM00002', 1, '2021-04-30 03:47:11', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_unit`
--

CREATE TABLE `t_unit` (
  `id_unit` int(3) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_unit`
--

INSERT INTO `t_unit` (`id_unit`, `unit`, `keterangan`) VALUES
(1, 'RT', ''),
(2, 'Satpam', ''),
(3, 'FT', ''),
(4, 'FTP', ''),
(5, 'FPsi', ''),
(6, 'Yayasan', ''),
(7, 'BAAK', ''),
(8, 'LPPM', ''),
(9, 'UPT Kon', ''),
(10, 'BAUK', ''),
(11, 'FTIK', ''),
(12, 'Rektor', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id_angt`),
  ADD UNIQUE KEY `kode_angt` (`kode_angt`),
  ADD KEY `id_kode` (`id_kode`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `t_jenis_trans`
--
ALTER TABLE `t_jenis_trans`
  ADD PRIMARY KEY (`id_jenis_trans`);

--
-- Indeks untuk tabel `t_kode`
--
ALTER TABLE `t_kode`
  ADD PRIMARY KEY (`id_kode`);

--
-- Indeks untuk tabel `t_pinjam`
--
ALTER TABLE `t_pinjam`
  ADD PRIMARY KEY (`id_pinj`),
  ADD UNIQUE KEY `kode_pinj` (`kode_pinj`),
  ADD KEY `kode_angt` (`kode_angt`);

--
-- Indeks untuk tabel `t_simpan`
--
ALTER TABLE `t_simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD UNIQUE KEY `kode_simpan` (`kode_simpan`),
  ADD KEY `kode_angt` (`kode_angt`),
  ADD KEY `id_kode` (`id_kode`);

--
-- Indeks untuk tabel `t_status`
--
ALTER TABLE `t_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `t_trans_angs`
--
ALTER TABLE `t_trans_angs`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `id_kode` (`id_kode`),
  ADD KEY `kode_pinj` (`kode_pinj`);

--
-- Indeks untuk tabel `t_trans_simp`
--
ALTER TABLE `t_trans_simp`
  ADD PRIMARY KEY (`id_trans`),
  ADD UNIQUE KEY `kode_trans_simp` (`kode_trans_simp`),
  ADD KEY `kode_simpan` (`kode_simpan`),
  ADD KEY `id_jenis_trans` (`id_jenis_trans`),
  ADD KEY `id_kode` (`id_kode`);

--
-- Indeks untuk tabel `t_unit`
--
ALTER TABLE `t_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id_angt` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `t_jenis_trans`
--
ALTER TABLE `t_jenis_trans`
  MODIFY `id_jenis_trans` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_kode`
--
ALTER TABLE `t_kode`
  MODIFY `id_kode` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_pinjam`
--
ALTER TABLE `t_pinjam`
  MODIFY `id_pinj` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_simpan`
--
ALTER TABLE `t_simpan`
  MODIFY `id_simpan` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `t_status`
--
ALTER TABLE `t_status`
  MODIFY `id_status` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_trans_angs`
--
ALTER TABLE `t_trans_angs`
  MODIFY `id_trans` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `t_trans_simp`
--
ALTER TABLE `t_trans_simp`
  MODIFY `id_trans` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_unit`
--
ALTER TABLE `t_unit`
  MODIFY `id_unit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD CONSTRAINT `t_anggota_ibfk_1` FOREIGN KEY (`id_kode`) REFERENCES `t_kode` (`id_kode`),
  ADD CONSTRAINT `t_anggota_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `t_unit` (`id_unit`),
  ADD CONSTRAINT `t_anggota_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `t_status` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `t_pinjam`
--
ALTER TABLE `t_pinjam`
  ADD CONSTRAINT `t_pinjam_ibfk_1` FOREIGN KEY (`kode_angt`) REFERENCES `t_anggota` (`kode_angt`);

--
-- Ketidakleluasaan untuk tabel `t_simpan`
--
ALTER TABLE `t_simpan`
  ADD CONSTRAINT `t_simpan_ibfk_1` FOREIGN KEY (`kode_angt`) REFERENCES `t_anggota` (`kode_angt`),
  ADD CONSTRAINT `t_simpan_ibfk_2` FOREIGN KEY (`id_kode`) REFERENCES `t_kode` (`id_kode`);

--
-- Ketidakleluasaan untuk tabel `t_trans_angs`
--
ALTER TABLE `t_trans_angs`
  ADD CONSTRAINT `t_trans_angs_ibfk_1` FOREIGN KEY (`id_kode`) REFERENCES `t_kode` (`id_kode`),
  ADD CONSTRAINT `t_trans_angs_ibfk_2` FOREIGN KEY (`kode_pinj`) REFERENCES `t_pinjam` (`kode_pinj`);

--
-- Ketidakleluasaan untuk tabel `t_trans_simp`
--
ALTER TABLE `t_trans_simp`
  ADD CONSTRAINT `t_trans_simp_ibfk_1` FOREIGN KEY (`kode_simpan`) REFERENCES `t_simpan` (`kode_simpan`),
  ADD CONSTRAINT `t_trans_simp_ibfk_2` FOREIGN KEY (`id_kode`) REFERENCES `t_kode` (`id_kode`),
  ADD CONSTRAINT `t_trans_simp_ibfk_3` FOREIGN KEY (`id_jenis_trans`) REFERENCES `t_jenis_trans` (`id_jenis_trans`),
  ADD CONSTRAINT `t_trans_simp_ibfk_4` FOREIGN KEY (`id_kode`) REFERENCES `t_kode` (`id_kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
