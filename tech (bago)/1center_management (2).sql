-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 03:28 AM
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
-- Database: `center_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `status` enum('active','inactive','relaunch','pending') NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `name`, `location`, `manager`, `status`, `image`, `created_at`) VALUES
(1, 'Lalakay Senior High School Stand Alone Tech4ED Center', 'Brgy. Lalakay, Lalakay Senior High School Stand Alone, Los Baños, Laguna', 'PEEJAY C. NAVAREZ', 'relaunch', 'brgy lalakay.jpg', '2025-01-10 02:56:18'),
(2, 'Brgy. Malaya Nagcarlan Tech4ED Center', 'Brgy. Malaya, Nagcarlan, Laguna', 'Isagani Urrete', 'pending', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(3, 'Mamatid Elementary School', 'Brgy. Mamatid, Mamatid Elementary School, Cabuyao, Laguna', 'Unverified', 'relaunch', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(4, 'Mamatid Senior High School', 'Brgy. Mamatid, Mamatid Senior High School, Cabuyao, Laguna', 'Unverified', 'inactive', 'images.jpg', '2025-01-10 02:56:19'),
(5, 'South Marinig Elementary School', 'Brgy. Marinig, South Marinig Elementary School, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(6, 'Pittland Elementary School', 'Brgy. Pittland, Pittland Elementary School, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(7, 'Cabuyao ALS Tech4Ed Center', 'Brgy. Poblacion 2, DepED Cabuyao City ALS, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(8, 'Cabuyao Internation High School', 'Brgy. Poblacion 3, Cabuyao Integrated National High School', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(9, 'Pulong Sta. Cruz NHS Tech4ED Center', 'Brgy. Pulong Sta. Cruz, Pulong Sta. Cruz National High School, City of Santa Rosa, Laguna', 'JOHN DOMINIC ONG GABRIEL', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(10, 'Sala Elementary School', 'Brgy. Sala, Sala Elementary School, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(11, 'Biñan City Senior Highschool - Sto Tomas Tech4ED Center', 'Brgy. Santo Tomas, Binan City Senior Highschool - Sto Tomas Campus', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(12, 'Sinalhan National High School Tech4ED Center', 'BRGY. SINALHAN, SINALHAN NATIONAL HIGH SCHOOL, CITY OF SANTA ROSA, LAGUNA', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(13, 'Southville 1 Elementary School', 'Brgy. Southville 1, Southville 1 Elementary School Tech4ED Center, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(14, 'Liceo De Santo Tomas De Aquinas Tech4ED Center', 'Brgy. Sto. Tomas. Biñan City, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:19'),
(15, 'Tadlac Elementary School Tech4ED Center', 'Brgy. Tadlak, Tadlak Elementary School', 'LERMA BAUTISTA', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(16, 'Brgy. Taytay Nagcarlan Tech4ED Center', 'Brgy. Taytay, Nagcarlan, Laguna', 'Dynise Angeles', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(17, 'Los Banos National High School Poblacion Tech4ED Center', 'Brgy. Timugan, Los Baños NHS Poblacion', 'Rowell E. Mendoza', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(18, 'San Pablo City Library Tech4ED Center', 'City Library, Capitol Compound San Pablo City, Laguna', 'Rona Remojo', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(19, 'Paaralan ng Pagibig at Pagasa Tech4Ed Center', 'Computer Laboratory', 'rubylita batolinnao flores', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(20, 'San Pablo Public Library (ALS)', 'Dlmp Cmpd, P-4, San Roque, San Pablo, Laguna', 'Unverified', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(21, 'Rizal Tech4Ed Center', 'F. Arban St, Brgy Paule 2, Rizal, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(22, 'Siniloan School of Applied Techonologies Tech4ED Center', 'G-Redor St. Pandeño, Siniloan, Laguna', 'Jose Rodriguez', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(23, 'San Pedro Relocation Center National High School - Main', 'Imelda Ave. Old Tenant', 'ALENIIE B. DUALAN', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(24, 'ASP -LAGUNA CHAPTER TECH4ED CENTER', 'Intan', 'Catherine Lopez', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(25, 'J.P. Rizal Ave., Brgy. Tagapo, Santa Rosa City, Laguna', 'Brgy. Sala, Sala Elementary School, Cabuyao, Laguna', 'JCINSP MARVI A DIAZ', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(26, 'Ang Kariton Klasrum ni Katoto Mobile Tech4ED Center', 'J.P. RIZAL ST, BRGY 4, QUINALE, PAETE, LAGUNA', 'Rowell Ybañez', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(27, 'LSPU-Siniloan Campus Tech4ED Center', 'L. de Leon Street, Siniloan, 4019 Laguna', 'Dr. Archieval M. Jain', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(28, 'Santa Rosa Manpower Training and Tech4ED Center', 'LM Subdivision', 'Kaisen Marquita Medina', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(29, 'Los Baños LGU, Tech4ED Center', 'Manila S Rd. Corner Jamboree Rd', 'Unverified', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(30, 'Yukos Elementary School - Annex Tech4Ed Center', 'Montserrat Subd. Brgy. Yukos, Purok 5, Nagcarlan, Laguna', 'Mylen Callos', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(31, 'Pagsanjan E Center Office Tech4Ed Center', 'MUNICIPAL BUILDING, J.P. RIZAL STREET, POBLACION 1, PAGSANJAN', 'Bon Quismundo', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(32, 'Nagcarlan ALS Senior Citizens Tech4Ed Center', 'Municipal Compound, Avenida Rizal, Poblacion II, Nagcarlan, Laguna', 'Aurora Caringal', 'inactive', 'Yellow and Red Modern 3D City Delivery Service Facebook Post (4).png', '2025-01-10 02:56:20'),
(33, 'LGU Alaminos Laguna Tech4ED Center', 'Municipal Government of Alaminos Laguna 2nd floor Multi-Purpose Building D.Fandiño St. Barangay Poblacion III Alaminos, Laguna', 'Mark D. Royo', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:20'),
(34, 'San Antonio Elementary School Tech4ED Center', 'National Highway, San Antonio, Los Banos', 'AIRIZ L. OAFERICUA', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(35, 'Southville 4 NHS Tech4ED Center', 'Phase II, Southville IV, Brgy. Caingin, CITY OF SANTA ROSA, Laguna', 'Emerson Baldonado', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(36, 'Pulo National High School', 'Pulo National High School, Pulo, Cabuyao City, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(37, 'BJMP Calamba City Jail Male Dormitory Tech4ED Center', 'Purok 2 Barangay Turbina Calamba City Laguna', 'JOI Jesieca Nuylan', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(38, 'Malinta Elementary School Tech4Ed Center', 'PUROK 2, MALINTA, LOS BAÑOS', 'SHERYL O. CASILI', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(39, 'Brgy. Banilad Tech4ed Center', 'Purok 3, Banilad, Nagcarlan, Laguna', 'Esmeralda B.Sollorano', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(40, 'Aplaya NHS Tech4ED Center', 'Purok 3, Brgy. Aplaya, Aplaya National High School', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(41, 'Luisiana Municipal Library Tech4ED Center', 'Zone 8', 'Oliver Peraz', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(42, 'Luisiana Municipal Library Tech4ED Center', 'Zone 8', 'Oliver Peraz', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(43, 'San Juan Elementary School', 'Brgy. Wawa, San Juan, Batangas', 'David Olayon', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 02:56:21'),
(44, 'Sto. Domingo National High School Tech4ED Center', '3rd floor ICT Room', 'Unverified', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(45, 'Tadlac Elementary School Tech4ED Center', 'Brgy. Tadlak, Tadlak Elementary School', 'LERMA BAUTISTA', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(46, 'Tuntungin-Putho National High School Tech4ED Center', 'Apitong St., Tuntungin-Putho, Los Banos, Laguna', 'Jerry D. Allovida', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(47, 'Victoria Elementary School Tech4ED Center', 'Unverified', 'Eriberto B. Rebong', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(48, 'Yukos Elementary School - Annex Tech4Ed Center', 'Montserrat Subd. Brgy. Yukos, Purok 5, Nagcarlan, Laguna', 'Mylen Callos', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(49, 'Alaminos Central Elementary School Tech4ED Center', 'Unverified', 'Grace Aliangan', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(50, 'ALS Bay Central Elementary School Tech4ED Center', 'Unverified', 'Myra De Castro Padrid', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(51, 'ALS Binan Division Tech4ED Center', 'Unverified', 'Marchy Joy Sanchez', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(52, 'ALS Cavinti Tech4ED Center', 'Unverified', 'Marijane Castro', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(53, 'ALS Famy Elementary School Tech4ED Center', 'Unverified', 'Bernardita Lamis', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(54, 'ALS Mabitac Elementary School Tech4ED Center', 'Unverified', 'Gemma Ponce', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(55, 'ALS Paete Elementary School Tech4ED Center', 'Unverified', 'Catherine Dalisay', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(56, 'ALS Pakil Elementary School Tech4ED Center', 'Unverified', 'Almir F. Enriquez', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(57, 'ALS Rizal Elementary School Tech4ED Center', 'Unverified', 'Lorena L. Sumague', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(58, 'ALS San Pedro District Tech4ED Center', 'Unverified', 'Corazon P. Aracan', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(59, 'ALS Sta. Maria Elementary School Tech4ED Center', 'Unverified', 'Christian O. Roxas', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(60, 'ALS-ANA KALANG Tech4ED Center', 'Unverified', 'Ricardo Callos', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(61, 'Anarias Laico Memorial Elementary School Tech4ED Center', 'Unverified', 'Teresa P. Obmerga', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(62, 'Ang Kariton Klasrum ni Katoto Mobile Tech4ED Center', 'J.P. Rizal St, Brgy. 4, Quinale, Paete, Laguna', 'Rowell Ybañez', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(63, 'Aplaya NHS Tech4ED Center', 'Purok 3, Brgy. Aplaya, Aplaya National High School', 'Freddierick Fernando', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(64, 'Aplaya NHS-APEX Tech4ED Center', 'Tatlong Hari St.', 'Gregorio Jr Toriffel Rico', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(65, 'ASP -Laguna Chapter Tech4ed Center', 'Intan', 'Catherine Lopez', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(66, 'Bahay Tuluyan Tech4Ed Foundation Inc. Tech4Ed Center', 'Unverified', 'Anna Liza Aliwalas', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(67, 'Balibago NHS Tech4ED Center', 'Brgy. Balibago, Balibago National High School', 'Mariecris Belbestre Hinay', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(68, 'Bambang Elementary School Tech4ED Center', 'Brgy. Bambang, Bambang Elementary School', 'Maria Jasmin I. Rosell', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(69, 'Bayog Elementary School Tech4ED Center', 'Unverified', 'Rochel Lopez Deangkinay', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(70, 'Bayog Elementary School Tech4ED Center', 'Unverified', 'Venus Fae C. Navarez', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(71, 'Bernaldo N. Calara Stand Alone Senior High School Tech4ED Center', 'Unverified', 'Clarissa Almazan', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(72, 'Biñan City Senior Highschool - Sto Tomas Tech4ED Center', 'Brgy. Santo Tomas, Binan City Senior Highschool - Sto Tomas Campus', 'Unverified', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(73, 'Biñan Integrated National HighSchool Tech4ED Center', 'Biñan Integrated National High School Tech4ED Center', 'Unverified', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(74, 'BJMP Calamba City Jail Male Dormitory Tech4ED Center', 'Purok 2 Barangay Turbina Calamba City Laguna', 'JOI Jesieca Nuylan', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(75, 'BJMP Los Baños Municipal Jail Tech4Ed Center', 'Tech4ed center', 'SJO1 Eileen C Bonavente', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(76, 'BJMP Santa Rosa City Jail - FD Tech4ED Center', 'J.P. Rizal Ave., Brgy. Tagapo, Santa Rosa City, Laguna', 'Jcinsp Marvi A Diaz', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(77, 'BJMP Sta. Cruz District Jail Tech4ED Center', 'tech4ed center separate bldg', 'JO1 Elizer B Gawagao', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(78, 'BJMP Sta. Rosa City Jail Tech4Ed Center', 'BJMP Sta Rosa District Jail Male Dormitory', 'JOI Jaemi D. Valles', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(79, 'Brgy Bañadero Tech4ED Center', 'Barangay Hall, Barangay Bañadero Calamba City Laguna', 'Jeremy M. Hacutina', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(80, 'Brgy Tala Hall Tech4ED Center', 'Unverified', 'Unverified', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(81, 'Brgy. Banilad Tech4ed Center', 'Purok 3, Banilad, Nagcarlan, Laguna', 'Esmeralda B.Sollorano', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(82, 'Brgy. Buboy Nagcarlan Tech4ED Center', 'Unverified', 'Ana Myriel C. Sombillla', 'active', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(83, 'Brgy. Limao Tech4ED Center', 'Unverified', 'Eddie Sanchez Sr.', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(84, 'Brgy. Malaya Nagcarlan Tech4ED Center', 'Brgy. Malaya, Nagcarlan, Laguna', 'Isagani Urrete', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(85, 'Brgy. San Fransisco Nagcarlan Tech4ed Center', 'San Francisco', 'Riojoie Matienzo', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(86, 'Brgy. Taytay Nagcarlan Tech4ED Center', 'Brgy. Taytay, Nagcarlan, Laguna', 'Dynise Angeles', 'inactive', 'path_to_image.jpg', '2025-01-10 02:57:22'),
(87, 'San Pedro Relocation Center National High School - Main', 'Imelda Ave. Old Tenant', 'ALENIIE B. DUALAN', 'active', '', '2025-01-10 03:00:14'),
(88, 'Santa Cruz Elementary School Tech4ED Center', 'Unverified', 'Nomer Aguado', 'inactive', '', '2025-01-10 03:00:14'),
(89, 'Santa Rosa Manpower Training and Tech4ED Center', 'LM Subdivision', 'Kaisen Marquita Medina', 'inactive', '', '2025-01-10 03:00:14'),
(90, 'Santa Rosa Science & Technology HS Tech4ED Center', 'Rizal St.', 'Marlene Imperial Tabaosares', 'inactive', '', '2025-01-10 03:00:14'),
(91, 'SDO (ALS) Tech4ED Center', 'Rizal St.', 'Venson Tuazon Cosio', 'inactive', '', '2025-01-10 03:00:14'),
(92, 'SDO Santa Rosa City Tech4ED Center', 'Rizal Blvd.', 'Jason Fabella', 'inactive', '', '2025-01-10 03:00:14'),
(93, 'Servitech Tech4ED Center', 'Unverified', 'Unverified', 'active', '', '2025-01-10 03:00:14'),
(94, 'Sinalhan National High School Tech4ED Center', 'BRGY. SINALHAN, SINALHAN NATIONAL HIGH SCHOOL, CITY OF SANTA ROSA, LAGUNA', 'Unverified', 'inactive', '', '2025-01-10 03:00:14'),
(95, 'Siniloan Elementary School Tech4ED Center', 'Unverified', 'Delza Mena', 'inactive', '', '2025-01-10 03:00:14'),
(96, 'Siniloan School of Applied Techonologies Tech4ED Center', 'G-Redor St. Pandeño, Siniloan, Laguna', 'Jose Rodriguez', 'inactive', '', '2025-01-10 03:00:14'),
(97, 'Sinipian Elementary School Tech4ED Center', 'Purok 3, Brgy. Sinipian, Nagcarlan, Laguna', 'Arlene Coroza', 'inactive', '', '2025-01-10 03:00:14'),
(98, 'Pulong Sta. Cruz NHS Tech4ED Center', 'Brgy. Pulong Sta. Cruz, Pulong Sta. Cruz National High School, City of Santa Rosa, Laguna', 'JOHN DOMINIC ONG GABRIEL', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 03:05:45'),
(99, 'Rizal Tech4Ed Center', 'F. Arban St, Brgy Paule 2, Rizal, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 03:05:45'),
(100, 'Sala Elementary School', 'Brgy. Sala, Sala Elementary School, Cabuyao, Laguna', 'Unverified', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 03:05:45'),
(101, 'San Antonio Elementary School Tech4ED Center', 'National Highway, San Antonio, Los Banos', 'AIRIZ L. OAFERICUA', 'active', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 03:05:45'),
(102, 'San Juan Central Elementary School Tech4ED Center', 'Unverified', 'Flordeliza A. Cacalda', 'inactive', 'C:\\xampp\\htdocs\\tech\\images\\aaa.png', '2025-01-10 03:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female','others') NOT NULL,
  `contact` varchar(15) NOT NULL,
  `position` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'images/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `age`, `gender`, `contact`, `position`, `email`, `password`, `role`, `image`) VALUES
(2, 'ken', 'ken', 'ken', 28, 'female', '09172345678', 'Sales Manager', 'ken@gmail.com', 'ken123', 'user', 'images/default.png'),
(3, 'bryan', 'bry', 'bry', 35, 'male', '09173456789', 'Technician', 'bry@gmail.com', 'bry123', 'user', 'images/default.png'),
(4, 'lian', 'lian', 'lian', 30, 'male', '92018298380', 'Administrator', 'lian@gmail.com', 'lian123', 'admin', 'images/brgy lalakay.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
