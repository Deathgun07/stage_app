-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 déc. 2024 à 14:36
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
-- Base de données : `ifsm_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en cours de validation','en attente','en cours','interrompue','terminée','suspendu') NOT NULL DEFAULT 'en cours de validation',
  `id_etudiant` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id`, `date`, `statut`, `id_etudiant`, `id_offre`) VALUES
(2, '2024-12-20', 'suspendu', 52, 0),
(3, '2024-12-20', 'en cours de validation', 53, 0),
(4, '2024-12-20', 'en attente', 51, 0),
(5, '2024-12-26', 'en cours de validation', 54, 0);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `code`, `nom`) VALUES
(1, 'BTS2/IDA', 'BTS 2 OPTION INFORMATIQUE DEVELOPPEUR D\'APPLICATIONS'),
(2, 'BTS2/RHCOM', 'BTS 2 OPTION RESSOURCES HUMAINES ET COMMUNICATION'),
(3, 'BTS2/AD', 'BTS 2 OPTION ASSISTANAT DE DIRECTION'),
(4, 'BTS2/RIT', 'BTS 2 OPTION RESEAUX INFORMATIQUES ET TELECOMS');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID_Entreprise` int(11) NOT NULL,
  `Nom` varchar(150) NOT NULL,
  `Adresse` text DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Nom_Responsable` varchar(100) DEFAULT NULL,
  `Secteur_Activite` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date` varchar(15) NOT NULL,
  `sexe` varchar(2) NOT NULL,
  `email` varchar(150) NOT NULL,
  `commune` varchar(50) NOT NULL,
  `quartier` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `filiere` varchar(100) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `section` int(11) NOT NULL,
  `commune_1` varchar(50) NOT NULL,
  `commune_2` varchar(50) NOT NULL,
  `commune_3` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `cv` text NOT NULL,
  `statut` varchar(50) NOT NULL,
  `diplome` varchar(20) NOT NULL,
  `date_diplome` varchar(20) NOT NULL,
  `etablissement` varchar(150) NOT NULL,
  `solde` int(11) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `matricule`, `nom`, `prenom`, `date`, `sexe`, `email`, `commune`, `quartier`, `phone`, `phone_2`, `classe`, `filiere`, `niveau`, `section`, `commune_1`, `commune_2`, `commune_3`, `photo`, `cv`, `statut`, `diplome`, `date_diplome`, `etablissement`, `solde`, `mot_de_passe`) VALUES
(51, '20E56585', 'Kouassi', 'Flora Rose Monde', '28/11/1999', 'F', 'manager@example.com', 'Abobo', 'Colatier', '0555889977', '0102354488', 'BTS2/IDA', 'IDA', 'BTS2', 1, 'marcory', 'port-bouet', 'plateau', 'upload/photo/67659a0140030_Annotation 2024-12-19 131221.png', 'upload/pdf/67659a0140a0c_Fichier 8.pdf', 'Etudiant(e)', 'BAC', '08/07/2020', 'G.S FUSOS COURS SOCIAUX D&#039;ABOBO', 0, ''),
(52, '20E65239', 'Coulibaly', 'Yvan', '12/04/2000', 'M', 'manager@example.com', 'Cocody', 'Angré chateaux', '0555889977', '0102354488', 'BTS2/IDA', 'IDA', 'BTS2', 1, 'treichville', 'koumassi', 'adjame', 'upload/photo/6766dd547fb26_Annotation 2024-12-12 130154.png', 'upload/pdf/6766dd547ff4c_Fichier 1.pdf', 'Etudiant(e)', 'BAC', '08/07/2020', 'G.S FUSOS COURS SOCIAUX D&#039;ABOBO', 20000, ''),
(53, '20E12358', 'Dion', 'Aude', '05/12/2005', 'F', 'dion@gmail.com', 'Adjamé', '220 logements', '0506332211', '0172668899', 'BTS2/IDA', 'IDA', 'BTS2', 1, 'abobo', 'attecoube', 'adjame', 'upload/photo/6765886039e13_IMG-20230228-WA0014.jpg', 'upload/pdf/676588603a39c_Fichier 5.pdf', 'Etudiant(e)', 'BAC', '08/07/2020', 'COLLEGE LES PINGUOINS D&#039;ABOBO', -1, ''),
(54, '20E25565', 'Fany', 'Claude', '11/08/1997', 'M', 'fany@gmail.com', 'Abobo', 'Sogephia', '0789675645', '0103456789', 'BTS2/IDA', 'IDA', 'BTS2', 1, 'marcory', 'plateau', 'port-bouet', 'upload/photo/676dde8c3dc26_IMG_20241222_195634.jpg', 'upload/pdf/676dde8c3e2ba_9782352470632.pdf', 'Etudiant(e)', 'Baccalauréat', '12/08/2022', 'Lycée classique d&#039;abidjan', -1, '');

-- --------------------------------------------------------

--
-- Structure de la table `offredestage`
--

CREATE TABLE `offredestage` (
  `id` int(11) NOT NULL,
  `intitule` varchar(150) NOT NULL,
  `lieu` text NOT NULL,
  `niveau` text NOT NULL,
  `description` text DEFAULT NULL,
  `competences_Requises` text DEFAULT NULL,
  `duree` varchar(50) DEFAULT NULL,
  `date_publication` date NOT NULL DEFAULT current_timestamp(),
  `nombre` int(11) NOT NULL,
  `occupe` int(11) NOT NULL,
  `statut` enum('publiée','en cours','clôturée') DEFAULT 'publiée',
  `id_demandeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `phone_2` varchar(12) NOT NULL,
  `adresse` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `code`, `name`, `phone`, `phone_2`, `adresse`, `created`) VALUES
(1, 'IFSM COCODY', 'IFSM COCODY BVD LATRILLE', '0757251542', '', 'IFSM COCODY, Ilot 18, Abidajn, Côte d\'ivoire', '2024-12-16 13:13:57'),
(2, 'IFSM ABOBO CCDO', 'IFSM ABOBO CAMP COMMANDO', '0708556699', '', '', '2024-12-16 13:13:57'),
(3, 'IFSM ANGRE', 'IFSM ANGRE MAHOU', '0102335588', '', '', '2024-12-16 13:13:57'),
(4, 'IFSM ADJAME', 'IFSM ADJAME 220 LOGEMENT', '0555070401', '', '', '2024-12-16 13:15:49'),
(5, 'IFSM MARAHOUE', 'IFSM ABOBO MARAHOUE', '0708556699', '', '', '2024-12-16 13:15:49'),
(6, 'IFSM KOUMASSI', 'IFSM KOUMASSI', '0757251542', '', '', '2024-12-16 13:20:47'),
(7, 'IFSM ABOBO BAOULE', 'IFSM ABOBO BAOULE', '0708556699', '', '', '2024-12-16 13:20:47'),
(8, 'IFSM YOPOUGON', 'IFSM YOPOUGON TOIT ROUGE', '0102335588', '', '', '2024-12-16 13:20:47'),
(9, 'IFSM ANDOKOI', 'IFSM YOPOUGON ANDOKOI', '0506987855', '', '', '2024-12-16 13:20:47'),
(10, 'IFSM ANYAMA', 'IFSM ANYAMA', '0757251542', '', '', '2024-12-16 13:21:26');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `ID_Stage` int(11) NOT NULL,
  `Date_Debut` date NOT NULL,
  `Date_Fin` date NOT NULL,
  `Statut` enum('en cours','terminé','validé') DEFAULT 'en cours',
  `Rapport` text DEFAULT NULL,
  `ID_Etudiant` int(11) NOT NULL,
  `ID_Tuteur` int(11) NOT NULL,
  `ID_Entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `ID_Tuteur` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Fonction` enum('enseignant','entreprise') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `statut` enum('Administrateur','Entreprise','Super administrateur','Commercial(e)','Responsable') NOT NULL,
  `photo` text NOT NULL,
  `email` text NOT NULL,
  `mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `statut`, `photo`, `email`, `mot_de_passe`) VALUES
(1, 'KARAMOKO', 'ABOU LANDRY', 'Administrateur', 'upload/photo/default.png', 'abou@gmail.com', '0000'),
(2, 'YAO', 'ALPHONSE', 'Responsable', 'upload/photo/default.png', 'yao@gmail.com', '0000'),
(3, 'KOUADIO', 'ANNIECE LAURE', 'Commercial(e)', 'upload/photo/default.png', 'kouadio@gmail.com', '0000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID_Entreprise`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offredestage`
--
ALTER TABLE `offredestage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`ID_Stage`),
  ADD KEY `ID_Etudiant` (`ID_Etudiant`),
  ADD KEY `ID_Tuteur` (`ID_Tuteur`),
  ADD KEY `ID_Entreprise` (`ID_Entreprise`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`ID_Tuteur`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID_Entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `offredestage`
--
ALTER TABLE `offredestage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `ID_Stage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `ID_Tuteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `offredestage`
--
ALTER TABLE `offredestage`
  ADD CONSTRAINT `offredestage_ibfk_1` FOREIGN KEY (`id_demandeur`) REFERENCES `entreprise` (`ID_Entreprise`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`ID_Etudiant`) REFERENCES `etudiant` (`ID`),
  ADD CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`ID_Tuteur`) REFERENCES `tuteur` (`ID_Tuteur`),
  ADD CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`ID_Entreprise`) REFERENCES `entreprise` (`ID_Entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
