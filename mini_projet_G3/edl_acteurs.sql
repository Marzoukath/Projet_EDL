-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2024 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edl_acteurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACTEURS`
--

CREATE TABLE `ACTEURS` (
  `id` int(11) NOT NULL,
  `NOM` text NOT NULL,
  `PRENOMS` varchar(20) NOT NULL,
  `DATE_NAISSANCE` date NOT NULL,
  `LIEU_NAISSANCE` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `EMAIL` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `DIPLOME` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `BANQUE` varchar(200) NOT NULL,
  `RIB` varchar(100) NOT NULL,
  `PDF_CIN` varchar(200) NOT NULL DEFAULT 'file',
  `PDF_RIB` varchar(100) NOT NULL DEFAULT 'file'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `ACTEURS`
--

INSERT INTO `ACTEURS` (`id`, `NOM`, `PRENOMS`, `DATE_NAISSANCE`, `LIEU_NAISSANCE`, `EMAIL`, `DIPLOME`, `BANQUE`, `RIB`, `PDF_CIN`, `PDF_RIB`) VALUES
(2, 'AGBODJA', 'Marzoukath', '2004-04-10', 'Bassila', 'marzoukathagbodja@gmail.com', 'BAC', 'Ecobank', '1234567899999990', 'storage/CNI_1234567899999990.pdf', ''),
(5, 'MAZOU', 'Marzouk', '2002-03-05', 'Cotonou', 'mazoumarzouk@gmail.com', 'BAC', 'Bank of Africa', '1234567899', 'storage/CNI_1234567899.pdf', ''),
(10, 'BATOKO', 'Chahida', '2002-03-05', 'Cotonou', 'batokochahida@gmail.com', 'BAC', 'Bank of Africa', '12345678900', 'storage/CNI_12345678900.pdf', ''),
(11, 'NDA', 'Marzoukath', '2002-03-05', 'Cotonou', 'batokochida@gmail.com', 'BAC', 'Bank of Africa', '1234567890987', 'storage/CNI_1234567890987.pdf', ''),
(15, 'NDA', 'Marzoukath', '2002-03-05', 'Cotonou', 'batokocWRETYUda@gmail.com', 'BAC', 'Bank of Africa', '1234567890987000', 'storage/RIB_1234567890987000.pdf', 'storage/RIB_1234567890987000.pdf'),
(23, 'AGBODJA', 'Marzoukath', '2024-05-10', 'Parakou', 'lorychatigre@gmail.com', 'BAC', 'Bank of Africa', '1456789', 'storage/RIB_1456789.pdf', 'storage/RIB_1456789.pdf'),
(31, 'N\'DA', 'Marzoukath', '2024-06-13', 'Parakou', 'marzououuubodja@gmail.com', 'Master', 'UBA', '345666666666667000', 'storage/CNI_345666666666667000.pdf', 'storage/RIB_345666666666667000.pdf'),
(36, 'BATOKO', 'Marzoukath', '2024-06-13', 'Parakou', 'z@gmail.com', 'Master', 'Orabank', '14529', 'storage/CNI_14529.pdf', 'storage/RIB_14529.pdf'),
(38, 'AGBODJA', 'Marzoukath', '2024-06-13', 'Parakou', 'martyiuopooiuoi@gmail.com', 'Master', 'Ecobank', '1111', 'storage/CNI_1111.pdf', 'storage/RIB_1111.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(1, 'AGBODJA', 'Marzoukath', 'marzoukathagbodja@gmail.com', 'motdepasse123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACTEURS`
--
ALTER TABLE `ACTEURS`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RIB` (`RIB`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ACTEURS`
--
ALTER TABLE `ACTEURS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
