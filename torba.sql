-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 04:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `torba`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(6) NOT NULL,
  `ime_prezime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_uloga` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime_prezime`, `email`, `sifra`, `id_uloga`) VALUES
(41, 'Pera Peric', 'peraperic@gmail.com', 'pera', 1),
(44, 'Miodrag Petrusic', 'miodrag@gmail.com', 'miodrag', 2),
(46, 'Lora Loric', 'lora@gmail.com', 'lora', 2),
(48, 'jovana jovic', 'jovana@gmail.com', 'jovana', 2),
(49, 'test', 'test', 'test', 2),
(50, 'ana@gmail.com', 'ana', 'ana', 2),
(51, 'pavle@gmail.com', 'pavle', 'pavle', 2),
(52, 'Kristina', 'kristina@gmail.com', 'kristina', 2),
(53, 'Ana Stojkovic', 'stojkovic@gmail.com', 'stojkovic', 2),
(54, 'Maja Colovic', 'colovic@gmail.com', 'colovic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `id` int(6) NOT NULL,
  `id_prodavac` int(6) NOT NULL,
  `id_kupac` int(6) NOT NULL,
  `id_torba` int(6) NOT NULL,
  `rezervacija` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `cena` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`id`, `id_prodavac`, `id_kupac`, `id_torba`, `rezervacija`, `datum`, `cena`) VALUES
(159, 41, 46, 53, 'Gandijeva 55. Night bag. 01152365', '2021-09-15', 30),
(171, 41, 46, 55, 'Mekenzijeva 5. Spring bag. 36056', '2021-09-12', 300),
(173, 41, 52, 55, 'Ljutice Bogdana 2; 0653255678', '2021-09-13', 100),
(174, 41, 52, 54, 'Koce Kapetana 32, Sky bag, 0642250363', '2021-09-15', 30),
(176, 41, 53, 53, 'Kneza Milosa 64, Night bag, 0642250363', '2021-09-15', 19),
(177, 41, 54, 55, 'Kralja Milana 24, Spring bag, 065966421', '2021-09-15', 23);

-- --------------------------------------------------------

--
-- Table structure for table `torba`
--

CREATE TABLE `torba` (
  `id` int(6) NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `torba`
--

INSERT INTO `torba` (`id`, `naziv`, `opis`) VALUES
(52, 'Loco Baroco', 'Pink platnena torba'),
(53, 'Night bag', 'Crna platnena torbica'),
(54, 'Sky bag', 'Nebo plava platnena torbica'),
(55, 'Spring bag', 'Zuta platnena torbica');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(6) NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'prodavac'),
(2, 'kupac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga_fk` (`id_uloga`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontrolor_fk` (`id_kupac`),
  ADD KEY `vlasnik_fk` (`id_prodavac`),
  ADD KEY `vozilo_fk` (`id_torba`);

--
-- Indexes for table `torba`
--
ALTER TABLE `torba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `torba`
--
ALTER TABLE `torba`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `uloga_fk` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `kontrolor_fk` FOREIGN KEY (`id_kupac`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `vlasnik_fk` FOREIGN KEY (`id_prodavac`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `vozilo_fk` FOREIGN KEY (`id_torba`) REFERENCES `torba` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
