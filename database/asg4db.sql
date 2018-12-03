-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2018 at 12:17 AM
-- Server version: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asg4db`
--

-- --------------------------------------------------------

--
-- Table structure for table `PVS`
--

CREATE TABLE `PVS` (
  `pv_id` int(11) NOT NULL,
  `pv_name` varchar(250) NOT NULL,
  `pv_photo` varchar(150) NOT NULL,
  `pv_address` varchar(250) NOT NULL,
  `pv_coordinate_x` varchar(200) NOT NULL,
  `pv_coordinate_y` varchar(200) NOT NULL,
  `pv_operator` varchar(25) NOT NULL,
  `pv_date` varchar(15) NOT NULL,
  `pv_description` varchar(200) NOT NULL,
  `pv_power` varchar(20) NOT NULL,
  `pv_annual_production` varchar(20) NOT NULL,
  `pv_co2_avoided` varchar(20) NOT NULL,
  `pv_reimbursement` varchar(20) NOT NULL,
  `pv_solar_panel_module` varchar(50) NOT NULL,
  `pv_azimuth_angl` varchar(50) NOT NULL,
  `pv_inclination_angl` varchar(50) NOT NULL,
  `pv_communication` varchar(50) NOT NULL,
  `pv_inverter` varchar(50) NOT NULL,
  `pv_sensors` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PVS`
--

INSERT INTO `PVS` (`pv_id`, `pv_name`, `pv_photo`, `pv_address`, `pv_coordinate_x`, `pv_coordinate_y`, `pv_operator`, `pv_date`, `pv_description`, `pv_power`, `pv_annual_production`, `pv_co2_avoided`, `pv_reimbursement`, `pv_solar_panel_module`, `pv_azimuth_angl`, `pv_inclination_angl`, `pv_communication`, `pv_inverter`, `pv_sensors`) VALUES
(270, 'PVTest1withImage', 'pv270.jpeg', 'Address of pv1', '34.63998735603', '32.964477539063', 'Operator pv1', '2018-12-02', 'Description of pv1 with image', '24', '12', '54', '34', 'Solar panel modules pv1', 'Azimuth angle pv1', 'Inclination angle pv1', 'Communication pv1', 'Inverter pv1', 'No pv1'),
(271, 'PvTestNic', '', 'Address of pv2', '35.135633017927', '33.291320800781', 'Operator pv2', '2018-10-17', 'Description of pv2', '53', '34', '51', '43', 'Solar panel modules pv2', 'Azimuth angle pv2', 'Inclination angle pv2', 'Communication pv2', 'Inverter pv2', 'Sensor pv2');

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `username` varchar(15) NOT NULL,
  `password` binary(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PVS`
--
ALTER TABLE `PVS`
  ADD PRIMARY KEY (`pv_id`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PVS`
--
ALTER TABLE `PVS`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
