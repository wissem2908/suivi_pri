-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 juil. 2025 à 16:40
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `suivi_pri`
--

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

CREATE TABLE `direction` (
  `id_dir` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`id_dir`, `name`, `description`, `created_at`, `is_active`) VALUES
(1, 'Direction Générale', '', '2025-06-16 09:05:02', 1),
(2, 'Direction de l\'administration et des finances', '', '2025-06-16 09:03:50', 1),
(3, 'Direction des réseaux et des systèmes d\'information géographiques', '', '2025-06-16 09:03:50', 1),
(4, 'Direction des études générales et de la prospective', '', '2025-06-16 09:04:49', 1),
(5, 'Direction de la maîtrise d\'ouvrage  et des programmes de réalisations urbaines', '', '2025-06-16 09:04:49', 1);

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dir` int(11) NOT NULL,
  `sous_dir` int(11) NOT NULL,
  `poste` int(11) NOT NULL,
  `date_hire` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`employee_id`, `nom`, `prenom`, `email`, `dir`, `sous_dir`, `poste`, `date_hire`, `created_at`, `is_active`) VALUES
(13, 'MEDDOUR', 'Hocine', '', 2, 1, 2, NULL, '2025-06-25 14:07:19', 1),
(14, 'REZAOUI', 'Hanane', '', 2, 1, 3, NULL, '2025-06-25 14:08:41', 1),
(15, 'SEMMACHE', 'Azeddine', '', 2, 1, 4, NULL, '2025-06-25 14:09:03', 1),
(16, 'SIAR', 'Amina', '', 2, 2, 1, NULL, '2025-06-25 14:10:32', 1),
(17, 'MEDJELEKH', 'Fouzia', '', 2, 2, 3, NULL, '2025-06-25 14:10:52', 1),
(18, 'BENDAIKHA', 'Adel', '', 2, 3, 6, NULL, '2025-06-25 14:11:39', 1),
(19, 'BENTAMEUR', 'Djamel', '', 2, 3, 7, NULL, '2025-06-25 14:12:02', 1),
(20, 'Benazzouz', 'SAAD', '', 2, 3, 7, NULL, '2025-06-25 14:12:42', 1),
(21, 'CHAOUCHE', 'Sofiane', '', 2, 3, 8, NULL, '2025-06-25 14:13:27', 1),
(22, 'DALOUCHE', 'Brahim', '', 2, 3, 8, NULL, '2025-06-25 14:13:51', 1),
(23, 'BELLALI', 'Smail', '', 2, 3, 8, NULL, '2025-06-25 14:14:27', 1),
(24, 'YOUBI', 'Assia', '', 2, 3, 9, NULL, '2025-06-25 14:14:58', 1),
(25, 'CHADLI', 'Fatima', '', 2, 3, 9, NULL, '2025-06-25 14:15:21', 1),
(26, 'SID ALI Mebarek', 'Imene', '', 3, 4, 10, NULL, '2025-06-25 14:17:14', 1),
(27, 'MAHIOUT', 'Essaid', '', 3, 4, 15, NULL, '2025-06-25 14:18:01', 1),
(28, 'OMRI', 'Wissem', '', 3, 4, 17, NULL, '2025-06-25 14:18:42', 1),
(29, 'MEHIDI', 'Salim', '', 3, 4, 18, NULL, '2025-06-25 14:19:29', 1),
(30, 'GUESSAB', 'Mohamed Lamine', '', 3, 16, 11, NULL, '2025-06-25 14:20:14', 1),
(31, 'BOUAM', 'Rim', '', 3, 15, 11, NULL, '2025-06-25 14:20:58', 1),
(32, 'SELLAMI', 'Dounya', '', 3, 15, 12, NULL, '2025-06-25 14:21:28', 1),
(33, 'GHOUBOUBA', 'Selma', '', 3, 15, 13, NULL, '2025-06-25 14:21:54', 1),
(34, 'MESSAOUDENE', 'Med', '', 3, 15, 14, NULL, '2025-06-25 14:22:29', 1),
(35, 'BENLARBI', 'Walid', '', 3, 15, 14, NULL, '2025-06-25 14:22:53', 1),
(36, 'ABBACI', 'Tahar Rassem', '', 3, 15, 14, NULL, '2025-06-25 14:23:18', 1),
(37, 'CHAIB', 'Naziha', '', 3, 15, 14, NULL, '2025-06-25 14:23:41', 1),
(38, 'KENNOUCHE', 'Samir', '', 1, 8, 23, NULL, '2025-06-25 14:24:27', 1),
(39, 'MOUFFOK', 'Samira', '', 1, 8, 24, NULL, '2025-06-25 14:24:54', 1),
(40, 'BOUDJELLAB', 'Akila', '', 1, 8, 22, NULL, '2025-06-25 14:25:21', 1),
(41, 'AMARA ', 'Djohra', '', 4, 13, 20, NULL, '2025-06-25 14:28:19', 1),
(42, 'LEBSAIRA ', 'Siham', '', 4, 14, 21, NULL, '2025-06-25 14:29:06', 1),
(43, 'KASDALI ', 'Nesrine', '', 5, 11, 13, NULL, '2025-06-26 08:58:51', 1),
(44, 'ZEGUIR ', 'Hadjer', '', 5, 11, 13, NULL, '2025-06-26 09:00:03', 1),
(45, 'BOUMAIZA ', 'Yasmine', '', 2, 17, 5, NULL, '2025-06-26 09:04:56', 1),
(46, 'EL HAOUTI ', 'Nassima', '', 4, 18, 22, NULL, '2025-06-26 09:13:09', 1);

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id_poste` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id_poste`, `name`, `description`, `created_at`, `is_active`) VALUES
(1, 'Sous -Directeur Ressources Humaines et Formation ', '', '2025-06-16 11:02:06', 1),
(2, 'Sous -Dirceteur Comptabilité et Finance', '', '2025-06-22 12:33:58', 1),
(3, 'Cadre Administratif ', '', '2025-06-22 12:34:36', 1),
(4, 'Cadre Financier ', '', '2025-06-25 13:57:17', 1),
(5, 'Secrétaire de Direction ', '', '2025-06-25 13:57:17', 1),
(6, 'Chauffeur-Achteur -Dimarcheur ', '', '2025-06-25 13:57:17', 1),
(7, 'Chauffeur Principal ', '', '2025-06-25 13:57:17', 1),
(8, 'Chauffeur', '', '2025-06-25 13:57:17', 1),
(9, 'Agent d\'Entretien ', '', '2025-06-25 13:57:17', 1),
(10, 'Sous -Directrice des  Réseaux Informatique ', '', '2025-06-25 14:00:04', 1),
(11, 'Chef de Projet Principal ', '', '2025-06-25 14:00:04', 1),
(12, 'Chef de Projet Qualité', '', '2025-06-25 14:00:04', 1),
(13, 'Architecte', '', '2025-06-25 14:00:04', 1),
(14, 'Ingénieur SIG ', '', '2025-06-25 14:00:04', 1),
(15, 'Ingénieur en Informatique SIG ', '', '2025-06-25 14:00:04', 1),
(17, 'Cadre Administratif Chargée de la Numérisation ', '', '2025-06-25 14:00:04', 1),
(18, 'Gestionnaire d\'Application ', '', '2025-06-25 14:00:04', 1),
(19, 'Chargé d\'étude Principal ', '', '2025-06-25 14:00:04', 1),
(20, 'Sous Directrice de la Normalisation Urbaine ', '', '2025-06-25 14:01:24', 1),
(21, 'Sous -Directrice de la Réglementation ', '', '2025-06-25 14:01:24', 1),
(22, 'Secrétaire du Directeur Général ', '', '2025-06-25 14:01:24', 1),
(23, 'Assistant du Directeur Général Chargé de l\'Audit', '', '2025-06-25 14:01:24', 1),
(24, 'Assistante DG Chargé de la Communication de la Publication et de la Coopération ', '', '2025-06-25 14:01:24', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pri`
--

CREATE TABLE `pri` (
  `id_pri` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `period` varchar(20) NOT NULL,
  `respect_objectif` float DEFAULT NULL,
  `qualite_travail` float DEFAULT NULL,
  `organisation` float NOT NULL,
  `disponibilite` float NOT NULL,
  `total` float NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pri`
--

INSERT INTO `pri` (`id_pri`, `id_employee`, `period`, `respect_objectif`, `qualite_travail`, `organisation`, `disponibilite`, `total`, `is_active`, `created_at`) VALUES
(204, 13, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(205, 14, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(206, 15, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(207, 16, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(208, 17, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(209, 18, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(210, 19, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(211, 20, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(212, 21, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(213, 22, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(214, 23, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(215, 24, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(216, 25, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(217, 26, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(218, 27, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(219, 28, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(220, 29, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(221, 30, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(222, 31, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(223, 32, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(224, 33, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(225, 34, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(226, 35, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(227, 36, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(228, 37, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(229, 38, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(230, 39, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(231, 40, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(232, 41, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(233, 42, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(234, 43, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(235, 44, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(236, 45, '05-2025', 0, 0, 0, 0, 0, 0, '2025-06-26 09:13:43'),
(237, 46, '05-2025', 4, 6, 0, 0, 10, 0, '2025-06-26 09:13:43'),
(238, 13, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(239, 14, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(240, 15, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(241, 16, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(242, 17, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(243, 18, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(244, 19, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(245, 20, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(246, 21, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(247, 22, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(248, 23, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(249, 24, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(250, 25, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(251, 26, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(252, 27, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(253, 28, '06-2025', 5, 2, 0, 0, 7, 0, '2025-06-30 10:26:50'),
(254, 29, '06-2025', 0, 1, 4, 0, 5, 0, '2025-06-30 10:26:50'),
(255, 30, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(256, 31, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(257, 32, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(258, 33, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(259, 34, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(260, 35, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(261, 36, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(262, 37, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(263, 38, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(264, 39, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(265, 40, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(266, 41, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(267, 42, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(268, 43, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(269, 44, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(270, 45, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(271, 46, '06-2025', 0, 0, 0, 0, 0, 0, '2025-06-30 10:26:50'),
(272, 13, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(273, 14, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(274, 15, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(275, 16, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(276, 17, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(277, 18, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(278, 19, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(279, 20, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(280, 21, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(281, 22, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(282, 23, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(283, 24, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(284, 25, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(285, 26, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(286, 27, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(287, 28, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(288, 29, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(289, 30, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(290, 31, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(291, 32, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(292, 33, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(293, 34, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(294, 35, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(295, 36, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(296, 37, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(297, 38, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(298, 39, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(299, 40, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(300, 41, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(301, 42, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(302, 43, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(303, 44, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(304, 45, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28'),
(305, 46, '07-2025', 0, 0, 0, 0, 0, 1, '2025-07-01 10:34:28');

-- --------------------------------------------------------

--
-- Structure de la table `sous_direction`
--

CREATE TABLE `sous_direction` (
  `id_sous_direction` int(11) NOT NULL,
  `id_dir` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sous_direction`
--

INSERT INTO `sous_direction` (`id_sous_direction`, `id_dir`, `name`, `description`, `created_at`, `is_active`) VALUES
(1, 2, 'Sous direction des finances et de la comptabilité', '', '2025-06-16 09:22:17', 1),
(2, 2, 'Sous direction des ressources humaines et de la formation ', '', '2025-06-16 09:22:59', 1),
(3, 2, 'Sous direction des moyens généraux', '', '2025-06-16 09:22:59', 1),
(4, 3, 'Sous direction des réseaux informatiques', '', '2025-06-16 09:31:01', 1),
(8, 1, 'Secraitariat', '', '2025-06-25 13:30:33', 1),
(9, 5, 'Sous direction des programmes d\'intervention sur le tissus ancien', '', '2025-06-25 13:31:30', 1),
(10, 5, 'Sous direction des zones spécifiques', '', '2025-06-25 13:31:30', 1),
(11, 5, 'Sous direction de l\'assistance à la maîtrise d\'ouvrage', '', '2025-06-25 13:31:45', 1),
(12, 4, 'Sous direction de la prospective territoriale', '', '2025-06-25 13:43:38', 1),
(13, 4, 'Sous direction de la normalisation Urbaine', '', '2025-06-25 13:44:46', 1),
(14, 4, 'Sous direction de la réglementation', '', '2025-06-25 13:44:46', 1),
(15, 3, 'Sous direction des systèmes d\'information géographiques', '', '2025-06-25 13:52:02', 1),
(16, 3, 'Sous direction de la banque de données, de la documentation et des archives', '', '2025-06-25 13:52:02', 1),
(17, 2, 'daf', '', '2025-06-26 09:01:53', 1),
(18, 4, 'degp', '', '2025-06-26 09:02:33', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `employee_id`, `username`, `password`, `role`, `created_at`, `last_login`, `is_active`) VALUES
(5, 28, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '2025-06-26 08:04:07', '2025-07-01 10:23:00', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id_dir`);

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `dir` (`dir`),
  ADD KEY `sous_dir` (`sous_dir`),
  ADD KEY `poste` (`poste`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id_poste`);

--
-- Index pour la table `pri`
--
ALTER TABLE `pri`
  ADD PRIMARY KEY (`id_pri`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Index pour la table `sous_direction`
--
ALTER TABLE `sous_direction`
  ADD PRIMARY KEY (`id_sous_direction`),
  ADD KEY `id_dir` (`id_dir`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `direction`
--
ALTER TABLE `direction`
  MODIFY `id_dir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `pri`
--
ALTER TABLE `pri`
  MODIFY `id_pri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT pour la table `sous_direction`
--
ALTER TABLE `sous_direction`
  MODIFY `id_sous_direction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dir`) REFERENCES `direction` (`id_dir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`sous_dir`) REFERENCES `sous_direction` (`id_sous_direction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`poste`) REFERENCES `poste` (`id_poste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pri`
--
ALTER TABLE `pri`
  ADD CONSTRAINT `pri_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sous_direction`
--
ALTER TABLE `sous_direction`
  ADD CONSTRAINT `sous_direction_ibfk_1` FOREIGN KEY (`id_dir`) REFERENCES `direction` (`id_dir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
