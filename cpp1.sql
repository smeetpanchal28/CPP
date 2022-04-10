-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 09:25 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `deleted`) VALUES
(1, 'Microsoft', 0),
(2, 'Cimpress', 0),
(3, 'Oracle', 0),
(4, 'Morgan Stanley', 0),
(5, 'Interactive Brokers', 0),
(6, 'Logistics Now', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_d`
--

CREATE TABLE `company_d` (
  `id` int(11) NOT NULL,
  `json_type` varchar(30000) NOT NULL,
  `attach` varchar(255) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_d`
--

INSERT INTO `company_d` (`id`, `json_type`, `attach`, `deleted`) VALUES
(1, '{\"ref_no\":\"1\",\"doa\":\"1\",\"doc\":\"1\",\"policy\":\"1\",\"salary\":\"1\",\"description\":\"jbvisgnoirdt onrigomersjmgoer goensrgoiekjrg efogneojrgmpoerg erognveorgeporngerkg psrngmeorgmperkg veofgmeoprsgmegmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm.1\",\"address\":\"1\",\"placement_for\":\"1\",\"eligible\":\"1\",\"branches\":\"1\",\"register\":\"1\",\"ldr\":\"1\",\"selection\":\"1\",\"dop\":\"1\",\"tor\":\"1\",\"vtr\":\"1\",\"visiting\":\"1\",\"count_visiting\":\"1\",\"cp\":\"1\",\"p_for_kjscit\":\"1\",\"place_location\":\"1\",\"instruction\":\"1\"}', '{\"1\":\"Somaiya_logo.png\"}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `company_id` int(11) NOT NULL,
  `refer_no` varchar(255) NOT NULL,
  `date_of_annoucement` varchar(255) NOT NULL,
  `date_of_campus` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `address` varchar(255) NOT NULL,
  `placement_for_ug_pg` varchar(255) NOT NULL,
  `eligiblity` varchar(255) NOT NULL,
  `branches` varchar(255) NOT NULL,
  `register_link` varchar(255) NOT NULL,
  `last_date_to_register` varchar(255) NOT NULL,
  `selection_mode` varchar(1000) NOT NULL,
  `date_of_ppt` varchar(255) NOT NULL,
  `time_to_report` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `visting` varchar(255) NOT NULL,
  `company_apperance` int(11) NOT NULL,
  `pool_campus` varchar(255) NOT NULL,
  `campus_kjseit` varchar(255) NOT NULL,
  `location_to_placed` varchar(255) NOT NULL,
  `instruction` varchar(1000) NOT NULL,
  `attachemnets` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `interests` varchar(255) NOT NULL,
  `about_me` varchar(500) NOT NULL,
  `education_details` varchar(1000) NOT NULL,
  `projects` varchar(500) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_d`
--
ALTER TABLE `company_d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company_d`
--
ALTER TABLE `company_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
