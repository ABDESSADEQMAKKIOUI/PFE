-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 24 juin 2023 à 19:11
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_a` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `type_a` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `formation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id`, `date_a`, `heure`, `type_a`, `nom`, `formation`) VALUES
(1, '2023-06-08', '12:00:00', 'etudiant', 'ABDESSADEQ  EL MAKKIOUI', 'HTML'),
(2, '2023-06-08', '12:00:00', 'formateur', 'BALMANE', 'JAVA'),
(3, '2023-06-10', '15:00:00', 'etudiant', 'IBTISSAM BALMANE', 'Pharmacie'),
(4, '2023-06-10', '12:00:00', 'formateur', ' EL MAKKIOUI', 'Pharmacie');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin1', 'password1');

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `contenu` text,
  `date` date DEFAULT NULL,
  `secretaire_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `secretaire_id` (`secretaire_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `certificat`
--

DROP TABLE IF EXISTS `certificat`;
CREATE TABLE IF NOT EXISTS `certificat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_c` date DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `formation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`nom`),
  KEY `formation_id` (`formation`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `certificat`
--

INSERT INTO `certificat` (`id`, `date_c`, `nom`, `formation`) VALUES
(5, '2023-06-03', 'IBTISSAM', 'HTML'),
(6, '2023-06-03', 'IBTISSAM', 'HTML'),
(7, '2023-06-03', 'IBTISSAM', 'JAVA'),
(8, '2023-06-04', 'ABDESSADEQ', 'Pharmacie'),
(9, '2023-06-04', 'ABDESSADEQ', 'JAVA'),
(10, '2023-06-03', 'ZAKKARIA', 'HTML'),
(11, '2023-06-10', 'ZAKKARIA', 'PHYTHON'),
(12, '2023-06-03', 'ZINEB', 'Pharmacie'),
(13, '2023-06-08', 'ABDELHAKIM', 'PHYTHON');

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`id`, `nom`) VALUES
(4, 'group2'),
(3, 'group1'),
(5, 'G1'),
(6, 'A1'),
(7, 'A3'),
(8, 'B6');

-- --------------------------------------------------------

--
-- Structure de la table `class_etudiant`
--

DROP TABLE IF EXISTS `class_etudiant`;
CREATE TABLE IF NOT EXISTS `class_etudiant` (
  `class_id` int NOT NULL,
  `etudiant_id` int NOT NULL,
  PRIMARY KEY (`class_id`,`etudiant_id`),
  KEY `etudiant_id` (`etudiant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `class_formateur`
--

DROP TABLE IF EXISTS `class_formateur`;
CREATE TABLE IF NOT EXISTS `class_formateur` (
  `class_id` int NOT NULL,
  `formateur_id` int NOT NULL,
  PRIMARY KEY (`class_id`,`formateur_id`),
  KEY `formateur_id` (`formateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `class_formateur`
--

INSERT INTO `class_formateur` (`class_id`, `formateur_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 3),
(7, 5),
(8, 6);

-- --------------------------------------------------------

--
-- Structure de la table `class_formations`
--

DROP TABLE IF EXISTS `class_formations`;
CREATE TABLE IF NOT EXISTS `class_formations` (
  `class_id` int NOT NULL,
  `formation_id` int NOT NULL,
  PRIMARY KEY (`class_id`,`formation_id`),
  KEY `formation_id` (`formation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `class_formations`
--

INSERT INTO `class_formations` (`class_id`, `formation_id`) VALUES
(2, 4),
(3, 4),
(4, 4),
(5, 8),
(6, 9),
(7, 12),
(8, 10);

-- --------------------------------------------------------

--
-- Structure de la table `emploidutemp`
--

DROP TABLE IF EXISTS `emploidutemp`;
CREATE TABLE IF NOT EXISTS `emploidutemp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `enseignant` varchar(50) DEFAULT NULL,
  `salle` varchar(50) DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `formation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `formation_id` (`formation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `emploidutemp`
--

INSERT INTO `emploidutemp` (`id`, `enseignant`, `salle`, `jour`, `heure_debut`, `heure_fin`, `class_id`, `formation_id`) VALUES
(1, ' EL MAKKIOUI', 'SALLE1', '2023-05-03', '17:17:00', '18:17:00', 4, 4),
(2, ' EL MAKKIOUI', 'SALLE_N1', '2023-06-10', '12:00:00', '12:00:00', 4, 8),
(3, 'BALMANE', 'SALLE_N2', '2023-06-10', '10:00:00', '12:00:00', 3, 9),
(4, 'OULDLAADAM', 'SALLE_N1', '2023-06-11', '13:15:00', '14:15:00', 5, 12),
(5, ' maazouzi', 'SALLE_N2', '2023-06-08', '10:15:00', '12:15:00', 4, 10),
(6, ' EL MAKKIOUI', 'SALLE_N2', '2023-06-08', '13:20:00', '15:20:00', 7, 9),
(7, 'GHAYOUBI', 'SALLE_N2', '2023-06-08', '12:20:00', '14:20:00', 8, 10),
(8, 'OULDLAADAM', 'SALLE_N1', '2023-06-08', '15:00:00', '17:00:00', 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `first_name`, `last_name`, `gender`, `birthday`, `contact`, `email`, `address`, `username`, `password`) VALUES
(6, 'IBTISSAM', 'BALMANE', 'Female', '2003-02-01', '0689357894', 'balmaneibtissam@gmail.com', 'HAY ELWALAA CASABLANCA', 'etudiant1', 'password1'),
(3, 'ABDESSADEQ', 'EL MAKKIOUI', 'Male', '2023-05-09', '0766337343', 'abdessadeq.elmakkioui20@gmail.com', 'molayrachid', 'etudiant2', 'password2'),
(4, 'ZAKKARIA', 'OULDLAADAM', 'Male', '2001-01-05', '0633482358', 'zakariaoudlaadam@gmail.com', 'SBATA  NR2 CASABLANCA', 'etudiant3', 'password3'),
(7, 'ZINEB', 'MAAZOUZI', 'Female', '2003-05-02', '0699101804', 'elmazouzyzineb@gmail.com', 'SIDI MOUMEN CASABLANCA', 'etudiant4', 'password4'),
(8, 'ABDELHAKIM ', 'GHAYOUBI', 'Male', '2001-09-02', '0658495562', 'abdelhakimghayoubi@gmail.com', 'SIDI-OUTHMAN CASABLANCA', 'etudiant5', 'password5');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `formation_id` int DEFAULT NULL,
  `formateur_id` int DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `secretaire_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formation_id` (`formation_id`),
  KEY `formateur_id` (`formateur_id`),
  KEY `class_id` (`class_id`),
  KEY `secretaire_id` (`secretaire_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE IF NOT EXISTS `formateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tele` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `nom`, `prenom`, `email`, `tele`, `username`, `password`) VALUES
(1, ' EL MAKKIOUI', 'ABDESSADEQ', 'abdessadeq.elmakkioui20@gmail.com', '0699101804', 'formateur1', 'password1'),
(2, ' maazouzi', 'zineb', 'elmazouzyzineb@gmail.com', '0766337343', 'formateur2', 'password2'),
(3, 'BALMANE', 'IBTISSAM', 'balmaneibtissam@gmail.com', '0639697094', 'formateur3', 'password3'),
(4, 'ELMAKKIOUI', 'ABDELHADI', 'abdelmakkioui200@gmail.com', '0766337343', 'formateur4', 'password4'),
(5, 'OULDLAADAM', 'ZAKKARIA', 'zakariaoudlaadam@gmail.com', '0643791050', 'formateur5', 'password5'),
(6, 'GHAYOUBI', 'ABDELHAKIM', 'abdelhakimghayoubi@gmail.com', '0643791050', 'formateur6', 'password6');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `date_f` date DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `nom`, `date_f`, `domain`, `prix`, `duree`, `description`) VALUES
(8, 'HTML', '2023-06-14', 'Informatique et technologie', '1600.00', 45, 'Cette formation permet aux participants d\'acquérir les connaissances nécessaires pour créer et structurer des pages web.'),
(9, 'JAVA', '2023-06-09', 'Informatique et technologie', '1700.00', 56, 'La formation Java est un programme d\'apprentissage qui vise à enseigner les fondamentaux du langage de programmation Java'),
(10, 'Pharmacie', '2023-06-10', 'Santé et médecine', '2000.00', 47, 'La formation en pharmacie est un programme d\'études destiné à former des professionnels de la santé dans le domaine pharmaceutique'),
(12, 'PHYTHON', '2023-06-03', 'Informatique et technologie', '2000.00', 56, 'La formation Python est un programme d\'apprentissage qui vise à enseigner les bases du langage de programmation Python');

-- --------------------------------------------------------

--
-- Structure de la table `formation_formateur`
--

DROP TABLE IF EXISTS `formation_formateur`;
CREATE TABLE IF NOT EXISTS `formation_formateur` (
  `formation_id` int NOT NULL,
  `formateur_id` int NOT NULL,
  PRIMARY KEY (`formation_id`,`formateur_id`),
  KEY `formateur_id` (`formateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formation_formateur`
--

INSERT INTO `formation_formateur` (`formation_id`, `formateur_id`) VALUES
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 3),
(11, 1),
(12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valeurs` float DEFAULT NULL,
  `etudiant` varchar(50) DEFAULT NULL,
  `formation` varchar(50) DEFAULT NULL,
  `formateur` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etudiant_id` (`etudiant`),
  KEY `examen_id` (`formation`),
  KEY `formateur_id` (`formateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `valeurs`, `etudiant`, `formation`, `formateur`) VALUES
(1, NULL, NULL, 'HTML', 'BALMANE'),
(2, 20, 'BALMANE', 'html', 'ZAKARIA'),
(3, 20, 'BALMANE', 'JAVA', 'ABDESSADEQ EL MAKKIOUI');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prix` decimal(10,2) DEFAULT NULL,
  `date_p` date DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `formation_id` int DEFAULT NULL,
  `etudiant_id` int DEFAULT NULL,
  `secretaire_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formation_id` (`formation_id`),
  KEY `etudiant_id` (`etudiant_id`),
  KEY `secretaire_id` (`secretaire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `prix`, `date_p`, `remark`, `formation_id`, `etudiant_id`, `secretaire_id`) VALUES
(1, '1700.00', '2023-06-10', 'paiement complet ', 8, 3, 1),
(2, '1700.00', '2023-06-04', 'paiement complet ', 8, 3, 1),
(3, '2000.00', '2023-06-04', 'paiement complet ', 12, 4, 1),
(4, '2000.00', '2023-06-04', 'paiement complet ', 12, 7, 1),
(5, '1700.00', '2023-06-04', 'paiement complet ', 9, 8, 1),
(6, '1600.00', '2023-06-09', 'paiement complet ', 8, 4, 1),
(7, '2000.00', '2023-06-03', 'paiement complet ', 10, 3, 1),
(8, '2000.00', '2023-06-08', 'paiement complet ', 10, 6, 1),
(9, '1600.00', '2023-06-09', 'paiement complet ', 8, 6, 3),
(10, '1600.00', '2023-06-03', 'paiement complet ', 8, 3, 3),
(11, '1600.00', '2023-06-03', 'paiement complet ', 8, 4, 3),
(12, '1600.00', '2023-06-10', 'paiement complet ', 8, 7, 3),
(13, '1700.00', '2023-06-03', 'paiement complet ', 9, 3, 3),
(14, '1700.00', '2023-06-09', 'paiement complet ', 9, 8, 3),
(15, '1700.00', '2023-06-16', 'paiement complet ', 10, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) DEFAULT NULL,
  `date_r` date DEFAULT NULL,
  `message` text,
  `formateur_id` int DEFAULT NULL,
  `etudiant_id` int DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `formateur_id` (`formateur_id`),
  KEY `etudiant_id` (`etudiant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `subject`, `date_r`, `message`, `formateur_id`, `etudiant_id`, `email`) VALUES
(1, 'reclamation', '2023-05-20', 'this is the first ', 1, NULL, 'abdessadeq.elmakkioui20@gmail.com'),
(2, 'reclamation', '2023-05-20', 'this is the first ', 1, NULL, 'abdessadeq.elmakkioui20@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

DROP TABLE IF EXISTS `ressource`;
CREATE TABLE IF NOT EXISTS `ressource` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `type_r` varchar(50) DEFAULT NULL,
  `secretaire_id` int DEFAULT NULL,
  `prix` varchar(50) NOT NULL,
  `date_ajoute` date NOT NULL,
  `remarque` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `secretaire_id` (`secretaire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id`, `nom`, `type_r`, `secretaire_id`, `prix`, `date_ajoute`, `remarque`) VALUES
(6, 'SALLE_N1', 'salle', NULL, '...................', '0000-00-00', 'Pour les formation d\'informatique'),
(5, 'P3', 'projecteur', NULL, '1600', '2023-06-03', 'Pour les formation d\'informatique'),
(7, 'SALLE_N2', 'salle', NULL, '...................', '0000-00-00', 'Pour les formation de  santé et médecine '),
(8, 'P2', 'projecteur', NULL, '1400', '2023-06-02', 'Pour les formations de  santé et médecine '),
(9, 'P1', 'projecteur', NULL, '1700', '2023-06-01', 'Pour les formations de  mathématique');

-- --------------------------------------------------------

--
-- Structure de la table `secretaires`
--

DROP TABLE IF EXISTS `secretaires`;
CREATE TABLE IF NOT EXISTS `secretaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `secretaires`
--

INSERT INTO `secretaires` (`id`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `username`, `password`) VALUES
(2, 'MAAZOUZI', 'ZINEB', 'elmazouzyzineb@gmail.com', '0766337343', 'SIDI MOUMEN CASABLANCA', 'secretaire1', 'password1'),
(3, 'EL MAKKIOUI', 'ABDESSADEQ', 'abdelmakkioui200@gmail.com', '0766337343', 'HAY ELWALAA CASABLANCA', NULL, NULL),
(4, 'BALMANE', 'IBTISSAM', 'balmaneibtissam@gmail.com', '0639697094', 'HAY ELWALAA CASABLANCA', NULL, NULL),
(5, 'OULDLAADAM', 'ZAKKARIA', 'zakariaoudlaadam@gmail.com', '0643791050', 'SBATA  NR2 CASABLANCA', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
