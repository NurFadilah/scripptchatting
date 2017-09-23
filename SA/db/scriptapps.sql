-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2017 at 01:19 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scriptapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatting`
--

CREATE TABLE IF NOT EXISTS `chatting` (
`no` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` char(30) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `pesan_masuk` text NOT NULL,
  `pesan_keluar` text NOT NULL,
  `waktu_kirim` datetime NOT NULL,
  `email_pengirim` char(50) NOT NULL,
  `status` int(1) NOT NULL,
  `kategori` int(1) NOT NULL,
  `key` char(75) NOT NULL,
  `banyak_tambahan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `key`
--

CREATE TABLE IF NOT EXISTS `key` (
  `isnKontak` char(30) NOT NULL,
  `myisn` char(20) NOT NULL,
  `key` char(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `key`
--

INSERT INTO `key` (`isnKontak`, `myisn`, `key`) VALUES
('', '1597795430', 'd41d8cd98f00b204e9800998ecf8427e'),
('1223195036', '1597795430', 'bca0904175ef3ca7ae02f62f28f359f0'),
('1597795430', '1223195036', 'bca0904175ef3ca7ae02f62f28f359f0');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE IF NOT EXISTS `kontak` (
  `isnKontak` char(30) NOT NULL,
  `nama` char(30) NOT NULL,
  `gambar` char(30) NOT NULL,
  `qrcode` char(30) NOT NULL,
  `online` char(30) NOT NULL,
  `active` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`isnKontak`, `nama`, `gambar`, `qrcode`, `online`, `active`) VALUES
('1223195036', 'Nur Fadilla Hilda', 'dila.jpg', '', 'online', ''),
('1597795430', 'Aida Halimatusadiah', 'aida.jpg', '', 'online', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `isnKontak` char(10) NOT NULL,
  `nama` char(30) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `email` char(40) NOT NULL,
  `username` char(30) NOT NULL,
  `password` char(75) NOT NULL,
  `telepon` char(14) NOT NULL,
  `qrcode` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`isnKontak`, `nama`, `gambar`, `email`, `username`, `password`, `telepon`, `qrcode`) VALUES
('1223195036', 'Nur Fadilla Hilda', 'dila.jpg', 'dila@gmail.com', 'dila', '35862fcf105f1aaa0b4f29ca71b96236', '089655629792', ''),
('1597795430', 'Aida Halimatusadiah', 'aida.jpg', 'aida.uin@gmail.com', 'aida', '2991a6ba1f1420168809c49ed39dba8b', '089655629793', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatting`
--
ALTER TABLE `chatting`
 ADD PRIMARY KEY (`no`);

--
-- Indexes for table `key`
--
ALTER TABLE `key`
 ADD PRIMARY KEY (`isnKontak`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
 ADD PRIMARY KEY (`isnKontak`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`isnKontak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatting`
--
ALTER TABLE `chatting`
MODIFY `no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
