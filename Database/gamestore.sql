-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 10:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id_detail` int(12) NOT NULL,
  `id_user` char(255) NOT NULL,
  `id_games` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id_detail`, `id_user`, `id_games`) VALUES
(1, 'USER1', '1666358418783'),
(2, 'USER1', '1666358418784'),
(3, 'USER1', '1666358418786'),
(4, 'USER2', '1666358418781'),
(5, 'USER2', '1666358418782'),
(6, 'USER3', '1666358418787'),
(7, 'USER3', '1666358418788'),
(8, 'USER4', '1666358418785'),
(9, 'USER4', '1666358418789');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id_game` char(255) NOT NULL,
  `judul` char(100) NOT NULL,
  `genre` char(50) NOT NULL,
  `price` int(12) NOT NULL,
  `image` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id_game`, `judul`, `genre`, `price`, `image`) VALUES
('1666358418781', 'Call Of Duty MW', 'Action, Shooter', 800000, 'CODMW.jpg'),
('1666358418782', 'Elden Ring', 'Action, RPG', 820000, 'ER.jpg'),
('1666358418783', 'Final Fantasy 7', 'Action, RPG', 850000, 'FF7R.jpg'),
('1666358418784', 'God Of War Ragnarok', 'Action, RPG', 800000, 'GOWR.jpg'),
('1666358418785', 'MotoGP 22', 'Racing', 500000, 'MG22.jpg'),
('1666358418786', 'Persona 4 Golden', 'RPG', 300000, 'P4G.png'),
('1666358418787', 'Persona 5 Royal', 'RPG', 800000, 'P5R.jpg'),
('1666358418788', 'Resident Evil Village', 'Action, Shooter', 700000, 'REVIII.jpg'),
('1666358418789', 'Story Of Seasons POOT', 'Simulation', 600000, 'SOSPOOT.jpg'),
('1750526223723172', 'Spider-Man', 'Action, Adventure', 750000, '6381825bc2aaf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `address` varchar(255) NOT NULL,
  `web` enum('Web','Surat Kabar','Teman','Internet') NOT NULL,
  `pesan` text NOT NULL,
  `role` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `gender`, `address`, `web`, `pesan`, `role`) VALUES
('ADMIN', 'ADMIN', 'ADMIN@gmail.com', 'Admin1@3$5^7*9)', 'L', '-', 'Web', 'This is Admin', 'ADMIN'),
('USER1', 'Agil Fikriawan', 'Agil_Fikriawan@gmail.com', '200209502011', 'L', 'Makassar', 'Web', 'Sangat keren', 'USER'),
('USER2', 'Muh. Dzaky Fazari Thalib', 'Muh.Dzaky_Fazari_Thalib@gmail.com', '200209502075', 'L', 'Makassar', 'Surat Kabar', 'Sangat keren', 'USER'),
('USER3', 'Indah Wulan Sari', 'Indah_Wulan_Sari@gmail.com', '200209500036', 'P', 'Makassar', 'Teman', 'Sangat keren', 'USER'),
('USER4', 'Mukhlisah', 'Mukhlisah@gmail.com', '200209502061', 'P', 'Makassar', 'Internet', 'Sangat keren', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_games` (`id_games`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id_detail` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`id_games`) REFERENCES `games` (`id_game`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
