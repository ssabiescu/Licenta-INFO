-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2025 at 06:48 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smiletrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `programari`
--

DROP TABLE IF EXISTS `programari`;
CREATE TABLE IF NOT EXISTS `programari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pacient` int NOT NULL,
  `nume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `medic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_programare` date DEFAULT NULL,
  `ora_programare` time DEFAULT NULL,
  `detalii` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('in_asteptare','confirmata','anulata') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'in_asteptare',
  `data_creare` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pacient` (`id_pacient`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programari`
--

INSERT INTO `programari` (`id`, `id_pacient`, `nume`, `prenume`, `telefon`, `email`, `medic`, `data_programare`, `ora_programare`, `detalii`, `status`, `data_creare`) VALUES
(58, 67, 'Vasile', 'Ciprian', '0725489654', 'vasilecipry777@gmail.com', 'Dima Ioana', '2025-06-20', '14:00:00', 'Doresc un detartraj profesional', 'confirmata', '2025-06-19 14:22:16'),
(59, 65, 'Conac', 'Madalina', '0755483291', 'conac@gmail.com', 'Mihai Radu', '2025-06-21', '19:55:00', 'Am nevoie de o extractie', 'confirmata', '2025-06-19 14:23:02'),
(60, 66, 'Ciui', 'Bogdan', '0748945612', 'ciui.bgd@gmail.com', 'Popescu Andrei', '2025-06-19', '20:14:00', '', 'confirmata', '2025-06-19 14:23:37'),
(61, 66, 'Ciui', 'Bogdan', '0748945612', 'ciui.bgd@gmail.com', 'Popescu Andrei', '2025-06-20', '21:27:00', 'Control rutina', 'confirmata', '2025-06-19 14:23:53'),
(63, 70, 'Sabiescu', 'Ovidiu', '0725489654', 'ovidiu.sabiescu24@gmail.com', 'Ionescu Maria', '2025-06-17', '14:30:00', 'Doresc un consult general', 'confirmata', '2025-06-19 14:34:45'),
(65, 68, 'Sabiescu', 'Sebastian', '0724840942', 'sebastian.sabiescu9@gmail.com', 'Dima Ioana', '2025-06-25', '14:00:00', 'Doresc un consult general.', 'confirmata', '2025-06-23 12:53:22'),
(67, 68, 'Sabiescu', 'Sebastian', '0724840942', 'sebastian.sabiescu9@gmail.com', 'Mihai Radu', '2025-06-12', '20:05:00', 'pentru uml test', 'in_asteptare', '2025-06-25 14:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `recenzii`
--

DROP TABLE IF EXISTS `recenzii`;
CREATE TABLE IF NOT EXISTS `recenzii` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pacient` int NOT NULL,
  `id_medic` int NOT NULL,
  `comentariu` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int DEFAULT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `recenzii`
--

INSERT INTO `recenzii` (`id`, `id_pacient`, `id_medic`, `comentariu`, `rating`, `data`) VALUES
(1, 0, 55, 'Foarte profesionist, recomand cu încredere!', 5, '2025-05-19 19:03:15'),
(2, 2, 56, 'ok', 5, '2025-05-19 19:03:15'),
(18, 65, 57, 'Empatic și atent, mi-a explicat tot pas cu pas.', 5, '2025-06-19 17:29:35'),
(3, 3, 57, 'Un pic grăbit, dar tratamentul a fost bun.', 4, '2025-05-19 19:03:15'),
(5, 53, 56, 'este okay', 5, '2025-05-19 19:30:24'),
(6, 53, 56, 'este okay', 4, '2025-05-19 19:30:33'),
(7, 53, 56, 'O să revin cu siguranță', 5, '2025-05-19 19:33:03'),
(16, 67, 56, 'Servicii de calitate, fără durere și cu multă răbdare. Recomand cu încredere!', 5, '2025-06-19 17:26:47'),
(17, 67, 56, 'Foarte mulțumit', 5, '2025-06-19 17:27:15'),
(19, 65, 57, 'Fără durere, super ok', 5, '2025-06-19 17:29:44'),
(20, 66, 60, 'Un profesionist desăvârșit. ', 5, '2025-06-19 17:30:24'),
(21, 66, 60, 'Anii de experiență isi spun cuvantul. recomand.', 5, '2025-06-19 17:30:36'),
(22, 70, 62, 'M-am simtit de parca am venit la o prietenă. Recomand tuturor', 5, '2025-06-19 17:36:17'),
(23, 70, 62, 'Nu am simtit durere, sunt multumit', 5, '2025-06-19 17:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE IF NOT EXISTS `utilizatori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parola` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('pacient','medic','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pacient',
  `data_inregistrare` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `nume`, `prenume`, `email`, `telefon`, `parola`, `rol`, `data_inregistrare`) VALUES
(34, 'Smiletrack', 'Admin', 'smiletrack@gmail.com', '0724840942', '$2y$10$GvQ1HbDnCyY7GqpbQXiwD.kGkCpErkzH8LEADEtZwB7mLk6MXlPa2', 'admin', '2025-03-26 15:08:54'),
(56, 'Dima', 'Ioana', 'dima@gmail.com', '0712345678', '$2y$10$7YBFlw8PCftMj.w/Ipa7nuQUiLSCsqRo4PslLeoTJhIJ91jVKz1Be', 'medic', '2025-05-09 14:39:36'),
(57, 'Mihai', 'Radu', 'mihai@gmail.com', '0712345678', '$2y$10$ZQ9n5DQfU3Jz.j1oTwqYTux14pn/TS5kw7fAMgNwgEJFlMp4Ku/Ui', 'medic', '2025-05-09 14:39:52'),
(60, 'Popescu', 'Andrei', 'popescu@gmail.com', '0712345678', '$2y$10$tZwy6YveFT.XhVgUX1t9V.XEp0LbWHbJClh2.bJOg38K7ZzojFU.2', 'medic', '2025-06-19 13:21:00'),
(62, 'Ionescu', 'Maria', 'ionescu@gmail.com', '0712345678', '$2y$10$WIvPcPHsHC7dZXoG3xuSs.7/iRvFcQlRda4A5rjAQ/v5/ekDzwUwe', 'medic', '2025-06-19 13:37:35'),
(63, 'Matei', 'Elena', 'matei@gmail.com', '0712345678', '$2y$10$H/WB3QYzZFFtOtSsVCGGV.AwgA67mmO/z/b3ptQeqXQ0aTA/p.38W', 'medic', '2025-06-19 13:38:09'),
(65, 'Conac', 'Madalina', 'conac@gmail.com', '0755483291', '$2y$10$mD9tE7SUH/wqgLJ4vu6LE.VBv8czB5CF7UB21d/B4j8eaZyBwLqwS', 'pacient', '2025-06-19 14:19:08'),
(66, 'Ciui', 'Bogdan', 'ciui.bgd@gmail.com', '0748945612', '$2y$10$vx5HZjqgOIcCe1RqnWWyGuWmSMj8UMVGwaYcOIQ7GIxN6EForZzkC', 'pacient', '2025-06-19 14:19:31'),
(67, 'Vasile', 'Ciprian', 'vasilecipry777@gmail.com', '0725489654', '$2y$10$BZQWH8SfnPRImML2u2cdj.QxMzRwVGn51LeAql1586XDCAYKMlmbS', 'pacient', '2025-06-19 14:19:53'),
(68, 'Sabiescu', 'Sebastian', 'sebastian.sabiescu9@gmail.com', '0724840942', '$2y$10$R8oezX2DKohvUuv9HSbCZOKcijm8.f22YPrQ9FX4h4HVGyhtV0Zyi', 'pacient', '2025-06-19 14:20:11'),
(70, 'Sabiescu', 'Ovidiu', 'ovidiu.sabiescu24@gmail.com', '0725489654', '$2y$10$QXzcN4B0BG/xeAywL5vkB.7.cRKAMsINpMvdQ45AF/8qTy18zVl2O', 'pacient', '2025-06-19 14:34:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
