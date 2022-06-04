-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 05. jun 2022 ob 00.16
-- Različica strežnika: 10.4.17-MariaDB
-- Različica PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `dosegrpt`
--
CREATE DATABASE IF NOT EXISTS `dosegrpt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dosegrpt`;

-- --------------------------------------------------------

--
-- Struktura tabele `doseg`
--

CREATE TABLE `doseg` (
  `IDu` int(11) DEFAULT NULL,
  `IDr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabele `repetitor`
--

CREATE TABLE `repetitor` (
  `IDr` int(11) NOT NULL,
  `ImeRep` varchar(50) DEFAULT NULL,
  `Fin` decimal(10,4) DEFAULT NULL,
  `Fout` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `repetitor`
--

INSERT INTO `repetitor` (`IDr`, `ImeRep`, `Fin`, `Fout`) VALUES
(1, 'Ljubljana center 2m', '144.9750', '145.5750'),
(2, 'Lisca 2m', '144.9750', '145.5750'),
(3, 'Malič (Celje, Laško) 2m', '144.9875', '145.5875'),
(4, 'Mohor 2m', '145.0125', '145.6125'),
(5, 'Stucinov hrib 2m', '145.0125', '145.0612'),
(6, 'Nanos 2m', '145.0250', '145.6250'),
(7, 'Kobla 2m', '145.0375', '145.6375'),
(8, 'Stare Sleme 2m', '145.0375', '145.6375'),
(9, 'Trdinov vrh 2m', '145.0500', '145.6500'),
(10, 'Kup(Podbrdo) 2m', '145.0500', '145.6500'),
(11, 'Korada 2m', '145.0750', '145.6750'),
(12, 'Uršlja gora  2m', '145.0750', '145.6750'),
(13, 'Kranjska Gora 2m', '145.0750', '145.6750'),
(14, 'Žagarski vrh 2m', '145.0875', '145.6875'),
(15, 'Mrzlica 2m', '145.1000', '145.7000'),
(16, 'Pečna reber (Postojna) 2m', '145.1125', '145.7125'),
(17, 'Vojsko 2m', '145.1250', '145.7250'),
(18, 'Pohorje - razgledni stolp 2m', '145.1250', '145.7250'),
(19, 'Jesenice 2m', '145.1250', '145.7250'),
(20, 'Veliki Brebrovnik (Ormož) 2m', '145.1375', '145.7375'),
(21, 'Grmada 2m', '145.1500', '145.7500'),
(22, 'Karlovica 2m', '145.1500', '145.7500'),
(23, 'Malija/Izola 2m', '145.1625', '145.7625'),
(24, 'Krim 2m', '145.1750', '145.7750'),
(25, 'Kanin 2m', '145.1875', '145.7875'),
(26, 'Spodnje Kraše (Mozirje) 2m', '145.1875', '145.7875'),
(27, 'Čretež (Krško) 2m', '145.1875', '145.7875'),
(28, 'Mirna gora 70cm', '431.0000', '438.6000'),
(29, 'Stare Slemene 70cm', '431.0250', '438.6250'),
(30, 'Krvavec 70cm', '431.0750', '438.6750'),
(31, 'Nanos 70cm', '431.1000', '438.7000'),
(32, 'Brežice 70cm', '431.1250', '438.7250'),
(33, 'Zg. Kocjan (Radenci) 70cm', '431.1250', '438.7250'),
(34, 'Trstelj(NG) 70cm', '431.1500', '438.7500'),
(35, 'Krim 70cm', '431.1750', '438.7750'),
(36, 'Radio Club Piran 70cm', '431.2000', '438.8000'),
(37, 'Boč 70cm', '431.2250', '438.8250'),
(38, 'Pečna reber (Postojna) 70cm', '431.2250', '438.8250'),
(39, 'Janče (Ljubljana) 70cm', '431.2750', '438.8750'),
(40, 'Korada 70cm', '431.2750', '438.8750'),
(41, 'Sv. Rok 70cm', '431.3000', '438.9000'),
(42, 'Celje Trnovlje 70cm', '431.3500', '438.9500'),
(43, 'Laze (Sevnica) 70cm', '431.4000', '439.0000'),
(44, 'Kobla 70cm', '431.4250', '439.0250'),
(45, 'Lisca 70cm', '431.4750', '439.0750'),
(46, 'Kum 70cm', '431.5250', '439.1250'),
(47, 'Mala Kopa 70cm', '431.5500', '439.1500'),
(48, 'Sv. Planina (Trbovlje) 70cm', '431.5750', '439.1750'),
(49, 'Čretež (Krško) 70cm', '431.6000', '439.2000'),
(50, 'Pohorje - (Maribor) 70cm', '431.6000', '439.2000'),
(51, 'Pohorje - (Razgledni stolp) 70cm', '431.6250', '439.2250'),
(52, 'Vojsko 70cm', '431.6250', '439.2250'),
(53, 'Zgonce (Velike Lasce) 70cm', '431.6500', '439.2500'),
(54, 'Mrzlica 70cm', '431.6750', '439.2750'),
(55, 'Malič (Celje, Laško) 70cm', '431.7000', '439.3000'),
(56, 'Strmec (Rogaška Slatina) 70cm', '431.7250', '439.3250'),
(57, 'Struška 70cm', '431.7250', '439.3250'),
(58, 'Stol 70cm', '431.8000', '439.4000'),
(59, 'Uršlja gora 70cm', '431.7750', '439.3750');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `IDu` int(11) NOT NULL,
  `KlicniZnak` varchar(10) DEFAULT NULL,
  `Lokator` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `doseg`
--
ALTER TABLE `doseg`
  ADD KEY `IDu` (`IDu`),
  ADD KEY `IDr` (`IDr`);

--
-- Indeksi tabele `repetitor`
--
ALTER TABLE `repetitor`
  ADD PRIMARY KEY (`IDr`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`IDu`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `repetitor`
--
ALTER TABLE `repetitor`
  MODIFY `IDr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `IDu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `doseg`
--
ALTER TABLE `doseg`
  ADD CONSTRAINT `doseg_ibfk_1` FOREIGN KEY (`IDu`) REFERENCES `uporabnik` (`IDu`),
  ADD CONSTRAINT `doseg_ibfk_2` FOREIGN KEY (`IDr`) REFERENCES `repetitor` (`IDr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
