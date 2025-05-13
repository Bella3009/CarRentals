-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 0.0.0.0
-- Generation Time: Apr 13, 2025 at 06:23 PM
-- Server version: 9.2.0
-- PHP Version: 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rentals_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `CarMaintenance`
--

CREATE TABLE `CarMaintenance` (
  `MaintenanceID` int NOT NULL,
  `CarID_FK` int NOT NULL,
  `Date` date DEFAULT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `Cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CarMaintenance`
--

INSERT INTO `CarMaintenance` (`MaintenanceID`, `CarID_FK`, `Date`, `Description`, `Cost`) VALUES
(1, 6, '2024-01-24', 'Major service', 1500.00),
(2, 1, '2024-02-27', 'Minor Service', 450.00),
(3, 1, '2024-02-05', 'Gasket Repair, hydraulics leak fixed.', 650.00),
(4, 2, '2023-11-23', 'Inspection and minor service', 5500.00);

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `CarID` int NOT NULL,
  `Make` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Model` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Year` year DEFAULT NULL,
  `LicensePlate` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`CarID`, `Make`, `Model`, `Image`, `Year`, `LicensePlate`, `Status`) VALUES
(1, 'BMW', '5 Series', 'images/bmw.png', '2010', 'CRY123', 'Available'),
(2, 'Ferrari', 'F8 Berlinetta', 'images/ferrari_sports.png', '2023', 'CRY124', 'Available'),
(3, 'Ferrari', 'Spyder', 'images/ferrari.png', '2023', 'CRY125', 'Available'),
(4, 'Kia', 'Sorrento', 'images/kia.png', '2022', 'CRY126', 'Available'),
(5, 'Mercedes', 'S-Class', 'images/mercedes.png', '2020', 'CRY127', 'Available'),
(6, 'Volkswagen', 'VW Transporter', 'images/VW_van.png', '1970', 'CRY128', 'Available'),
(8, 'Ferrari', 'PuroSangue', 'images/ferrari purosangue.png', '2018', 'CRY999', 'not available');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `LicenseNumber` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Address` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--

CREATE TABLE `Employees` (
  `EmployeeID` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Employees`
--

INSERT INTO `Employees` (`EmployeeID`, `Name`, `Role`, `Phone`, `Email`, `password`) VALUES
(1, 'Joseph Borg', 'Manager', '21432234', 'jb@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(2, 'Philip Vella', 'Manager', '21222333', 'pv@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(3, 'Raquel Borg', 'Clerk', '21333444', 'rb@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(4, 'Jason Cutajar', 'Clerk', '21666777', 'jc@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(5, 'Roberta Vella', 'Manager', '21888888', 'rv@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(6, 'Donald Cauchi', 'Clerk', '21999888', 'dc@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.'),
(7, 'Ivan Cardona', 'Clerk', '21555444', 'ic@rentals.com', '$2y$12$9FunwcHoce12nvgPbRwzaujuUVaWGbEbSWM/hNOQ7U0jTJenPxbk.');

-- --------------------------------------------------------

--
-- Table structure for table `RentalLocations`
--

CREATE TABLE `RentalLocations` (
  `LocationID` int NOT NULL,
  `Address` text COLLATE utf8mb4_general_ci,
  `Phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ManagerID_FK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RentalLocations`
--

INSERT INTO `RentalLocations` (`LocationID`, `Address`, `Phone`, `ManagerID_FK`) VALUES
(1, 'Triq il-pitkali, Attard.\r\n', '21222333', 2),
(2, 'Triq il-Kbira, Valletta.', '21432234', 1),
(3, 'Triq Principali, Naxxar', '21888999', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Rentals`
--

CREATE TABLE `Rentals` (
  `RentalID` int NOT NULL,
  `CustomerID_FK` int NOT NULL,
  `CarID_FK` int NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `ActualReturnDate` date DEFAULT NULL,
  `DailyRate` decimal(10,2) DEFAULT NULL,
  `TotalCost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CarMaintenance`
--
ALTER TABLE `CarMaintenance`
  ADD PRIMARY KEY (`MaintenanceID`),
  ADD KEY `CarID_FK` (`CarID_FK`);

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`CarID`),
  ADD UNIQUE KEY `LicensePlate` (`LicensePlate`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `RentalLocations`
--
ALTER TABLE `RentalLocations`
  ADD PRIMARY KEY (`LocationID`),
  ADD KEY `ManagerID_FK` (`ManagerID_FK`);

--
-- Indexes for table `Rentals`
--
ALTER TABLE `Rentals`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `CustomerID_FK` (`CustomerID_FK`),
  ADD KEY `CarID_FK` (`CarID_FK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CarMaintenance`
--
ALTER TABLE `CarMaintenance`
  MODIFY `MaintenanceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `CarID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Employees`
--
ALTER TABLE `Employees`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `RentalLocations`
--
ALTER TABLE `RentalLocations`
  MODIFY `LocationID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Rentals`
--
ALTER TABLE `Rentals`
  MODIFY `RentalID` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CarMaintenance`
--
ALTER TABLE `CarMaintenance`
  ADD CONSTRAINT `carmaintenance_ibfk_1` FOREIGN KEY (`CarID_FK`) REFERENCES `Cars` (`CarID`);

--
-- Constraints for table `RentalLocations`
--
ALTER TABLE `RentalLocations`
  ADD CONSTRAINT `rentallocations_ibfk_1` FOREIGN KEY (`ManagerID_FK`) REFERENCES `Employees` (`EmployeeID`);

--
-- Constraints for table `Rentals`
--
ALTER TABLE `Rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`CustomerID_FK`) REFERENCES `Customers` (`CustomerID`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`CarID_FK`) REFERENCES `Cars` (`CarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
