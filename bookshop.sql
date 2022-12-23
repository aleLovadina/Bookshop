-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 04:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `dettaglio_ordine`
--

CREATE TABLE `dettaglio_ordine` (
  `nordine` int(11) NOT NULL,
  `idprodotto` int(11) NOT NULL,
  `ncopie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ordine`
--

CREATE TABLE `ordine` (
  `nordine` int(11) NOT NULL,
  `data_ora` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `stato` varchar(20) NOT NULL DEFAULT 'inserito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prodotto`
--

CREATE TABLE `prodotto` (
  `idProdotto` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `autore` varchar(50) DEFAULT NULL,
  `editore` varchar(50) DEFAULT NULL,
  `prezzo` decimal(10,2) DEFAULT 0.00,
  `fotografia` varchar(50) NOT NULL,
  `giacenza` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prodotto`
--

INSERT INTO `prodotto` (`idProdotto`, `titolo`, `autore`, `editore`, `prezzo`, `fotografia`, `giacenza`) VALUES
(1, 'Corso di informatica', 'Formichi', 'Zanichelli', '29.90', '../homepage/Tulips.jpg', 123),
(2, 'Linguaggio Python', 'Lorenzi', 'Atlas', '25.00', '../homepage/Penguins.jpg', 123),
(11, 'Avventure 2', NULL, NULL, '40.00', '../homepage/Desert.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `indirizzo` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ruolo` varchar(10) NOT NULL DEFAULT '"user"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`username`, `password`, `nome`, `cognome`, `indirizzo`, `email`, `ruolo`) VALUES
('admin', 'admin', NULL, NULL, NULL, NULL, 'admin'),
('mberton', 'mberton', NULL, NULL, NULL, NULL, 'user'),
('mbertuola', 'mbertuola', NULL, NULL, NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dettaglio_ordine`
--
ALTER TABLE `dettaglio_ordine`
  ADD PRIMARY KEY (`nordine`,`idprodotto`),
  ADD KEY `idprodotto` (`idprodotto`);

--
-- Indexes for table `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`nordine`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`idProdotto`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ordine`
--
ALTER TABLE `ordine`
  MODIFY `nordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dettaglio_ordine`
--
ALTER TABLE `dettaglio_ordine`
  ADD CONSTRAINT `dettaglio_ordine_ibfk_1` FOREIGN KEY (`idprodotto`) REFERENCES `prodotto` (`idProdotto`),
  ADD CONSTRAINT `dettaglio_ordine_ibfk_2` FOREIGN KEY (`nordine`) REFERENCES `ordine` (`nordine`);

--
-- Constraints for table `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utente` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
