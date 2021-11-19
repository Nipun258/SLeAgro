-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 09:48 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurancesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `strBankCode` varchar(4) NOT NULL,
  `strBankName` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`strBankCode`, `strBankName`) VALUES
('0030', 'Swiss Bank'),
('0100', 'Rural Bank'),
('1021', 'Swiss National Bank'),
('1022', 'HongKong And Shanhai Bank'),
('4814', 'National Housing development Authority'),
('7010', 'Bank of Ceylon'),
('7038', 'Standard Chartered Bank'),
('7047', 'Citi Bank N.A.'),
('7056', 'Commercial Bank'),
('7074', 'Habib Bank Ltd.'),
('7083', 'Hatton National Bank'),
('7092', 'Hongkong & Shanghai Bank'),
('7108', 'Indian Bank'),
('7117', 'Indian Overseas Bank'),
('7135', 'Peoples Bank'),
('7144', 'State Bank of India'),
('7153', 'Mashreq Bank PSC'),
('7162', 'Nations Trust Bank'),
('7205', 'Deutsche Bank (Asia)'),
('7214', 'NDB Bank'),
('7269', 'Muslim Commercial Bank'),
('7278', 'Sampath Bank'),
('7287', 'Seylan Bank'),
('7296', 'Public Bank'),
('7302', 'Union Bank'),
('7311', 'Pan Asia Bank'),
('7320', 'Korea Exchange Bank'),
('7339', 'Societe Generale'),
('7445', 'Bank of Nova Scotia'),
('7454', 'DFCC BANK PLC'),
('7481', 'Cargills Bank'),
('7719', 'National Savings Bank'),
('7728', 'SANASA DEVELOPMNET BANK'),
('7737', 'HDFC BANK'),
('7746', 'Citizens Development Business Finance PLC'),
('7755', 'REGIONAL DEVELOPMENT BANK'),
('7764', 'STATE MORTGAGE & INS'),
('7898', 'Merchant Bank of Srilanka (MBSL)'),
('8004', 'Central Bank of Sri Lanka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`strBankCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
