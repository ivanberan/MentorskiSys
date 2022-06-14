-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 12:15 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mentorski`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` enum('mentor','student') NOT NULL,
  `status` enum('none','redovni','izvanredni') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `email`, `password`, `role`, `status`) VALUES
(1, 'mentor@oss.hr', '$2y$10$1SHubXN9y9sMnnLLuRPEbOyHh2xzeCpDBM8ioJgIGLuohOivnh7q6', 'mentor', 'none'),
(2, 'red@oss.hr', '$2y$10$1SHubXN9y9sMnnLLuRPEbOyHh2xzeCpDBM8ioJgIGLuohOivnh7q6', 'student', 'redovni'),
(3, 'izv@oss.hr', '$2y$10$1SHubXN9y9sMnnLLuRPEbOyHh2xzeCpDBM8ioJgIGLuohOivnh7q6', 'student', 'izvanredni'),
(4, 'ja@oss.hr', '$2y$10$yY.kT5t0zK45qO2ZBqTmCu1pFKfeGgrUhFIzd2kVlsJuDu3iE6nz.', 'student', 'redovni'),
(5, 'ivan@iv.an', '$2y$10$JSYMJFAlN6D2k36hJEXNP.o/Qp.4dTV6ZQC8w0auEzu6I1c.Tw026', 'mentor', 'none'),
(6, 'ivaan@iv.an', '$2y$10$yuH8DPnnfcbBL5wEaC0o8.6w8R/.ay2xUIiIEsdpcoWbDlU0wOXU2', 'student', 'izvanredni'),
(7, 'mentor2@iv.an', '$2y$10$ixyK6YbmDiDHj8sI8ejrd.Sa0uyvk45H60QAnxDVqL7p315aA5Vf2', 'mentor', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

CREATE TABLE `predmeti` (
  `course_id` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseCode` varchar(16) NOT NULL,
  `courseProgram` text NOT NULL,
  `coursePoints` int(11) NOT NULL,
  `sem_regular` int(11) NOT NULL,
  `sem_irregular` int(11) NOT NULL,
  `elective` enum('da','ne') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`course_id`, `courseName`, `courseCode`, `courseProgram`, `coursePoints`, `sem_regular`, `sem_irregular`, `elective`) VALUES
(1, 'Linearna algebra', 'SIT001', 'Program nije unesen', 5, 1, 1, 'ne'),
(2, 'Fizika', 'SIT002', 'Program nije unesen', 6, 1, 3, 'ne'),
(3, 'Osnove elektrotehnike', 'SIT003', 'Program nije unesen', 6, 1, 1, 'ne'),
(4, 'Digitalna i mikroprocesorska tehnika', 'SIT004', 'Program nije unesen', 7, 1, 2, 'ne'),
(5, 'Uporaba računala', 'SIT005', 'Program nije unesen', 4, 1, 1, 'ne'),
(6, 'Engleski jezik 1', 'SIT006', 'Program nije unesen', 2, 1, 1, 'ne'),
(7, 'Analiza 1', 'SIT007', 'adadasfgasdgadfas', 8, 2, 2, 'da'),
(8, 'Osnove elektronike', 'SIT008', 'Program nije unesen', 6, 2, 2, 'ne'),
(9, 'Arhitektura i organizacija digitalnih računala', 'SIT009', 'Program nije unesen', 7, 2, 3, 'ne'),
(10, 'Uvod u programiranje', 'SIT010', 'Program nije unesen', 8, 2, 3, 'ne'),
(11, 'Engleski jezik 2', 'SIT011', 'Program nije unesen', 2, 2, 2, 'ne'),
(12, 'Primijenjena i numerička matematika', 'SIT012', 'Program nije unesen', 6, 3, 4, 'ne'),
(13, 'Programske metode i apstrakcije', 'SIT013', 'Program nije unesen', 8, 3, 4, 'ne'),
(14, 'Baze podataka', 'SIT014', 'Program nije unesen', 6, 3, 5, 'ne'),
(15, 'Informacijski sustavi', 'SIT015', 'Program nije unesen', 6, 3, 4, 'ne'),
(16, 'Tehnički Engleski jezik', 'SIT016', 'Program nije unesen', 4, 3, 5, 'ne'),
(17, 'Računalne mreže', 'SIT017', 'Program nije unesen', 5, 4, 5, 'ne'),
(18, 'Operacijski sustavi', 'SIT018', 'Program nije unesen', 5, 4, 5, 'ne'),
(19, 'Strukture podataka i algoritmi', 'SIT019', 'Program nije unesen', 5, 4, 6, 'da'),
(20, 'Objektno programiranje', 'SIT020', 'Program nije unesen', 5, 4, 6, 'da'),
(21, 'Baze podataka 2', 'SIT021', 'Program nije unesen', 5, 4, 6, 'da'),
(22, 'Mrežne usluge i programiranje', 'SIT022', 'Program nije unesen', 5, 4, 6, 'da'),
(23, 'Arhitektura osobnih računala', 'SIT023', 'Program nije unesen', 5, 4, 6, 'da'),
(24, 'Projektiranje i upravljanje računalnim mrežama', 'SIT024', 'Program nije unesen', 5, 4, 6, 'da'),
(25, 'Projektiranje informacijskih sustava', 'SIT025', 'Program nije unesen', 5, 4, 6, 'da'),
(26, 'Informatizacija poslovanja', 'SIT026', 'Program nije unesen', 5, 4, 6, 'da'),
(27, 'Ekonomika i organizacija poduzeća', 'SIT027', 'Program nije unesen', 2, 5, 7, 'ne'),
(28, 'Analiza 2', 'SIT028', 'Program nije unesen', 6, 5, 7, 'ne'),
(29, 'Industrijska praksa', 'SIT029', 'Program nije unesen', 2, 5, 7, 'ne'),
(30, 'Arhitektura poslužiteljskih računala', 'SIT030', 'Program nije unesen', 5, 5, 7, 'da'),
(31, 'Sigurnost računala i podataka', 'SIT031', 'Program nije unesen', 5, 5, 7, 'da'),
(32, 'Programski alati na UNIX računalima', 'SIT032', 'Program nije unesen', 5, 5, 7, 'da'),
(33, 'Napredno Windows programiranje', 'SIT033', 'Program nije unesen', 5, 5, 7, 'da'),
(34, 'Objektno orijentirano modeliranje', 'SIT034', 'Program nije unesen', 5, 5, 7, 'da'),
(35, 'Programiranje u Javi', 'SIT035', 'Program nije unesen', 5, 5, 7, 'da'),
(36, 'Programiranje na Internetu', 'SIT036', 'Program nije unesen', 5, 5, 7, 'da'),
(37, 'Elektroničko poslovanje', 'SIT037', 'Program nije unesen', 5, 5, 7, 'da'),
(38, 'Diskretna matematika', 'SIT038', 'Program nije unesen', 6, 6, 8, 'ne'),
(39, 'Upravljanje poslužiteljskim računalima', 'SIT039', 'Program nije unesen', 5, 6, 8, 'da'),
(40, 'Programiranje u C#', 'SIT040', 'Program nije unesen', 5, 6, 8, 'da'),
(41, 'Društveni informacijski sustavi', 'SIT041', 'Program nije unesen', 5, 6, 8, 'da'),
(42, 'Oblikovanje Web stranica', 'SIT042', 'Program nije unesen', 5, 6, 8, 'da'),
(43, 'Vođenje projekata i dokumentacija', 'SIT043', 'Program nije unesen', 5, 6, 8, 'da'),
(44, 'Informatizacija proizvodnje', 'SIT044', 'Program nije unesen', 5, 6, 8, 'da'),
(45, 'Analiza i obrada podataka', 'SIT045', 'Program nije unesen', 5, 6, 8, 'da'),
(46, 'Njemački jezik', 'SSZP40', 'Program nije unesen', 4, 6, 8, 'da'),
(47, 'Talijanski jezik', 'SSZP50', 'Program nije unesen', 4, 6, 8, 'da'),
(48, 'Završni rad', 'SIT046', 'Program nije unesen', 8, 6, 8, 'ne'),
(59, 'asd', 'asd', 'ads', 54, 2, 5, 'da');

-- --------------------------------------------------------

--
-- Table structure for table `upisi`
--

CREATE TABLE `upisi` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upisi`
--

INSERT INTO `upisi` (`user_id`, `course_id`, `status`) VALUES
(2, 19, 'enrolled'),
(2, 17, 'enrolled'),
(2, 38, 'enrolled'),
(2, 45, 'enrolled'),
(3, 3, ''),
(3, 13, ''),
(3, 1, ''),
(3, 6, ''),
(3, 19, ''),
(3, 48, 'enrolled'),
(3, 24, 'enrolled'),
(2, 21, 'enrolled'),
(2, 21, 'enrolled'),
(3, 27, 'enrolled'),
(3, 8, 'enrolled'),
(3, 2, 'enrolled'),
(3, 2, 'enrolled'),
(3, 8, 'enrolled'),
(4, 28, 'enrolled'),
(4, 7, 'enrolled'),
(4, 23, 'enrolled'),
(4, 14, 'enrolled'),
(4, 30, 'enrolled'),
(2, 15, 'enrolled'),
(6, 21, 'enrolled'),
(6, 28, 'enrolled'),
(6, 45, 'enrolled'),
(6, 9, 'enrolled'),
(6, 23, 'enrolled'),
(6, 30, 'enrolled'),
(6, 14, 'enrolled'),
(6, 4, 'enrolled'),
(2, 28, 'enrolled'),
(2, 30, 'enrolled'),
(4, 2, 'enrolled'),
(4, 9, 'enrolled'),
(4, 45, 'enrolled'),
(2, 23, 'enrolled'),
(2, 14, 'enrolled'),
(2, 59, 'passed'),
(2, 7, 'enrolled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `kod` (`courseCode`);

--
-- Indexes for table `upisi`
--
ALTER TABLE `upisi`
  ADD KEY `student_id` (`user_id`),
  ADD KEY `predmet_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `predmeti`
--
ALTER TABLE `predmeti`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `upisi`
--
ALTER TABLE `upisi`
  ADD CONSTRAINT `upisi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `upisi_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `predmeti` (`course_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
