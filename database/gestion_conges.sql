-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 31 mai 2023 à 08:20
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_conges`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande_conge`
--

CREATE TABLE `demande_conge` (
  `id` int NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `valide` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_conge`
--

INSERT INTO `demande_conge` (`id`, `dateDebut`, `dateFin`, `comment`, `valide`, `type_id`, `user_id`) VALUES
(51, '2023-05-04', '2023-05-16', 'Je vous remercie d\'avoir accepté ma demande de congé.', 'oui', 2, 82),
(52, '2023-05-03', '2023-05-16', 'Je vous remercie d\'avoir accepté ma demande de congé.', 'non', 3, 83);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int NOT NULL,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `role`) VALUES
(1, 'Administrateur'),
(2, 'Chef de projet'),
(3, 'Employe');

-- --------------------------------------------------------

--
-- Structure de la table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int NOT NULL,
  `label_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nbr_jour` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_conge`
--

INSERT INTO `type_conge` (`id`, `label_type`, `nbr_jour`) VALUES
(1, 'Congé de présence parentale', 310),
(2, 'Congé annuel payé', 30),
(3, 'Congé maternité', 112),
(4, 'Congé paternité', 16),
(5, 'Congé pour mariage ou Pacs', 4),
(6, 'Congé pour le décès d\'un membre de la famille', 3),
(7, 'Réduction du temps de travail (RTT)', 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sexe` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gsm` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateMAJ` datetime DEFAULT NULL,
  `codeSS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cne` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dateIntegration` date DEFAULT NULL,
  `preavis` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dateDepart` date DEFAULT NULL,
  `id_profil` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `sexe`, `email`, `password`, `gsm`, `dateCreation`, `dateMAJ`, `codeSS`, `cne`, `dateIntegration`, `preavis`, `dateDepart`, `id_profil`) VALUES
(82, 'Mohamed ktira', 'Mr', 'mohamed.ktira@gmail.com', 'kmA0hPzhTSGrx/v3COSJUzdv9QxHsrrSEoYx8OudPk0=', '660661302', '2023-05-21 14:01:54', '2023-05-31 10:08:49', '25025aa', '0032aa', '2023-05-16', 'oui', '2023-05-20', 2),
(83, 'Ktr zineb', 'Mrs', 'zinebktr@gmail.com', 'V3DkWlH78GLmo3qapN/9YylyJlBkn5eycsY/B9DI9ik=', '660661300', '2023-05-21 15:15:39', '2023-05-31 10:09:22', '250250aa', '545454aa', '2023-05-11', 'oui', '2023-06-22', 3),
(84, 'med ktira', 'Mr', 'admin@med.com', 'L2kkHVq1bikigR0AWzSGWb3fb2m4Wtyif8blEwEfItw=', '660661300', '2023-05-31 10:13:07', '2023-05-31 10:18:42', '250250ee', '0032aaee', '2023-05-11', 'non', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demande_conge`
--
ALTER TABLE `demande_conge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_id` (`type_id`,`user_id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CNE` (`cne`),
  ADD KEY `id_profil` (`id_profil`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demande_conge`
--
ALTER TABLE `demande_conge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande_conge`
--
ALTER TABLE `demande_conge`
  ADD CONSTRAINT `FK_type_id` FOREIGN KEY (`type_id`) REFERENCES `type_conge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_id_profil` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
