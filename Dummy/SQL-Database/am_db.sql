-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 09:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `am_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `device` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `specs` varchar(255) NOT NULL,
  `serialno` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `device`, `brand`, `specs`, `serialno`) VALUES
(2, 'Laptop', 'ASUS', '14-inch FHD 1920x1080 Anti-Glare Nano Edge display featuring an ultra-narrow bezel with anti-glare coating, Powered by the Intel Dual-Core Celeron N4020 Processor (4M Cache, up to 2.8 GHz), FHD display with a durable 180-degree hinge, 4GB LPDDR4 RAM, 128G', 1234567),
(3, 'Computer', 'ACER', 'CORE I7-12700 (2.1GHZ), 8GB DDR4 3200, 1TB+256GB SSD, 23.8\" KA242Y (F02AKA242Y), WINDOWS 11, GT1030 2GB, OFFICE H&S', 3213216),
(4, 'Mouse', 'LENOVO', 'Full Size Wireless Computer Mouse for PC, Laptop and Computer with Windows, 2.4 GHz Nano USB Receiver, Ambidextrous Design, 12 Months Battery Life, Color: Graphite Grey', 2213221),
(5, 'Keyboard', 'COLIKES', 'Computer Keyboard Wired, Plug Play USB Keyboard, Low Profile Chiclet Keys, Large Number Pad, Caps Indicators, Foldable Stands, Spill-Resistant, Anti-Wear Letters for Windows Mac PC Laptop, Full Size', 5464569),
(7, 'Headphone', 'SONY', 'Weighing Approx. 5.4 g x 2, Neodymium magnet, 20Hz-20,000Hz (44.1kHz sampling) Frequency, Waterproof, Charging time: Approx. 2.5hrs (USB Chargeable)', 7896543);

-- --------------------------------------------------------

--
-- Table structure for table `reqdev`
--

CREATE TABLE `reqdev` (
  `id` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `specs` varchar(255) NOT NULL,
  `serialno` varchar(255) NOT NULL,
  `currentdate` date NOT NULL,
  `daterel` date NOT NULL,
  `status` enum('Pending','Deployed','Returned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reqdev`
--

INSERT INTO `reqdev` (`id`, `agent`, `device`, `brand`, `specs`, `serialno`, `currentdate`, `daterel`, `status`) VALUES
(27, 'Russelle Supnet', 'Computer', 'ACER', 'CORE I7-12700 (2.1GHZ), 8GB DDR4 3200, 1TB+256GB SSD, 23.8', '3213216', '2023-12-13', '2023-12-15', 'Deployed'),
(28, 'Russelle Supnet', 'Laptop', 'ASUS', '14-inch FHD 1920x1080 Anti-Glare Nano Edge display featuring an ultra-narrow bezel with anti-glare coating, Powered by the Intel Dual-Core Celeron N4020 Processor (4M Cache, up to 2.8 GHz), FHD display with a durable 180-degree hinge, 4GB LPDDR4 RAM, 128G', '1234567', '2023-12-13', '2023-12-16', 'Deployed'),
(29, 'Russelle Supnet', 'Mouse', '', '', '', '2023-12-13', '0000-00-00', 'Pending'),
(30, 'Russelle Supnet', 'Keyboard', '', '', '', '2023-12-13', '0000-00-00', 'Pending'),
(31, 'Edwardo Diaz', 'Headphone', '', '', '', '2023-12-13', '0000-00-00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('Admin','IT Staff','Agent','Supervisor') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `name`) VALUES
(64, 'Admin', 'Mark13', '$2y$10$IeF9vBE4b0ug08usyN9bpexLmiQH.7WxSAtHm2SgLJSQpjCJcc28S', 'Mark Duhig'),
(65, 'IT Staff', 'Jude13', '$2y$10$U4vG1V4vOp02X9BY74yqr.g2wlOKuPFKfJ1WHglar0iQn6x/qQqcS', 'Jude Michael Duhig'),
(66, 'Agent', 'Russ69', '$2y$10$T6jjBGAsBIsEjPVOgMmlfebVEIBfDSX/HJg8PID/TlxXYRK6U0zfi', 'Russelle Supnet'),
(67, 'Agent', 'Dward09', '$2y$10$17fon2Ly/HV9xEB6XNZBT.xxobdsn9QTiMPO6MVFgKP/hO992UDWu', 'Edwardo Diaz'),
(68, 'IT Staff', 'Asha30', '$2y$10$xO./esSulwcN.StJSiyuKO./lZEbU0UIcWiy2REiTs.MBBQBPNELe', 'Asha Alessandra Falcon'),
(69, 'Supervisor', 'Wenzy06', '$2y$10$CM8KsFCqb4GLG44mE299kO9w.DaZnUgMTG26us8VN3Uj0NRlyQTxm', 'Renz Bolivar'),
(70, 'Supervisor', 'Demo13', '$2y$10$oPbLFTCFgX/PBqFdbjc2Qu3bEt2hFdnx4FtsTklB5qvOV.LCnhC46', 'Democritus John');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reqdev`
--
ALTER TABLE `reqdev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reqdev`
--
ALTER TABLE `reqdev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
