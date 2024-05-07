-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 sep. 2023 à 18:28
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_client`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `e_mail`, `mot_de_passe`, `photo`) VALUES
(1, 'admin@admin', 'admin', '');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `e-mail` varchar(40) NOT NULL,
  `telephone` int(11) NOT NULL,
  `adress` varchar(40) NOT NULL,
  `type_client` varchar(40) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `mot_de_passe` varchar(40) NOT NULL,
  `etatc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `e-mail`, `telephone`, `adress`, `type_client`, `photo`, `mot_de_passe`, `etatc`) VALUES
(40, 'ameni', 'zarraa', 'ahmed@ahmed', 2511555, 'tunis', 'ste', 'profile_64ad3b2aa66eb.jpg', 'aziz', 'client'),
(65, 'alela', 'mohssen', 'zz@zz', 25414555, 'tunis', 'individu', '', '', ''),
(71, 'Mami', '', 'aaa@shsh', 0, '', '', '', '', ''),
(79, 'kilani', 'ahmed', 'aa@aa', 44444, 'djerba', 'ste', '', 'aqj0rq1r', ''),
(97, 'aliii', 'ahmed', 'ali@ali', 555, 'djerba', 'individu', 'profile_64b7bbda504db.jpg', '', ''),
(138, 'hhhh', '', 'bbbbb@ggg.com', 0, '', '', '', 'i9aebfjz', 'devis'),
(140, 'jakob', 'ahmed', 'aliii@jilani', 74185, 'djerba', 'individu', '', 'azee', 'client'),
(144, 'moncef', 'azer', 'moncef@monccef', 777777777, '', '', '', '', 'devis'),
(145, 'Mami', '', 'ahmed@ali', 0, '', '', '', 'iymc9gv9', 'devis'),
(146, 'ali', '', 'ahmedali@gmail.com', 0, '', '', '', '', 'devis'),
(147, 'monceff', '', 'moncefali@gmail.com', 0, '', '', '', 'ood62ytc', 'devis'),
(148, 'Mami', '', 'test2@gmail.com', 0, '', '', '', '', 'devis'),
(149, 'Mami', '', 'test@gmail.com', 0, '', '', '', '', 'devis'),
(150, 'ali', 'azer', 'aloulou@aloulou', 24111, 'djerba', 'individu', '', 'ahkgqie3', 'client'),
(155, 'jpjp', '', 'jpjp@jojo', 0, '', '', '', 'tmkeoich', 'devis'),
(157, 'jojo', 'ahmed', 'jojo@jiji.com', 125411, '', '', '', 'jojo', 'client'),
(160, 'zzz', '', 'zzz@zzz.com', 0, '', '', '', '', 'devis'),
(161, 'ali', '', 'ali@ali.com', 0, '', '', '', '', 'devis'),
(163, 'azer', '', 'azermami8@gmail.com', 0, '', '', '', 'u9c2kbvk', 'devis'),
(164, 'ahmed', '', 'azer00860@gmail.com', 0, '', '', '', '0zv5qj4r', 'devis');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_d` date NOT NULL,
  `date_f` date NOT NULL,
  `etat` varchar(40) NOT NULL,
  `prix` int(11) NOT NULL,
  `descriptif` text NOT NULL,
  `cahier_charge` varchar(100) NOT NULL,
  `proposition_prix` varchar(100) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `date_creation`, `date_d`, `date_f`, `etat`, `prix`, `descriptif`, `cahier_charge`, `proposition_prix`, `id_client`, `id_projet`) VALUES
(6, '2023-06-07', '2023-06-01', '2023-06-23', 'client', 10000, 'kkk.pdf', 'lll.pdf', 'kkk.pdf', 40, 51),
(17, '2023-07-06', '0000-00-00', '0000-00-00', 'client', 1000, 'aaaaaaaaaa', '', '', 65, 51),
(86, '2023-07-19', '0000-00-00', '0000-00-00', 'client', 30000, 'http://localhost/gestion_client/document/cours_php_part1.pdf', 'http://localhost/gestion_client/document/TP_tableaux_php.pdf', '', 97, 51),
(106, '2023-07-31', '0000-00-00', '0000-00-00', 'client', 14000, 'http://localhost/gestion_client/document/cours_php_part1.pdf', 'http://localhost/gestion_client/document/exercice_quiz.pdf', '', 40, 55),
(136, '2023-08-13', '0000-00-00', '0000-00-00', 'client', 50000, 'http://localhost/gestion_client/document/TP_tableaux_php.pdf', 'http://localhost/gestion_client/document/TP_tableaux_php.pdf', '', 150, 31),
(141, '2023-08-21', '0000-00-00', '0000-00-00', 'encour', 14, 'http://localhost/gestion_client/document/BD_PHP.pdf', 'http://localhost/gestion_client/document/exercice_quiz.pdf', '', 155, 64),
(147, '2023-08-28', '0000-00-00', '0000-00-00', 'client', 100, 'http://localhost/gestion_client/document/traitement_formulaire.pdf', 'http://localhost/gestion_client/document/cours_php_part1.pdf', '', 157, 64),
(156, '2023-09-07', '0000-00-00', '0000-00-00', 'devis', 0, 'kzkekzke', '', '', 160, 66),
(158, '2023-09-08', '0000-00-00', '0000-00-00', 'devis', 0, 'je veux suivre réseau sociaux', '', '', 161, 64),
(159, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 14000, 'http://localhost/gestion_client/document/BD_PHP.pdf', 'http://localhost/gestion_client/document/traitement_formulaire.pdf', '', 40, 51),
(161, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 5000, 'http://localhost/gestion_client/document/cours_php_part1.pdf', 'http://localhost/gestion_client/document/exercice_quiz.pdf', '', 163, 55),
(162, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 140, 'http://localhost/gestion_client/document/exercice_quiz.pdf', 'http://localhost/gestion_client/document/exercice_quiz.pdf', '', 164, 31),
(163, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 5000, 'http://localhost/gestion_client/document/exercice_quiz.pdf', 'http://localhost/gestion_client/document/traitement_formulaire.pdf', '', 40, 55),
(164, '2023-09-08', '0000-00-00', '0000-00-00', 'devis', 0, 'php ahah', '', '', 164, 31),
(165, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 200, 'http://localhost/gestion_client/document/TP_tableaux_php.pdf', 'http://localhost/gestion_client/document/TP_tableaux_php.pdf', '', 40, 31),
(166, '2023-09-08', '0000-00-00', '0000-00-00', 'encour', 1000, 'http://localhost/gestion_client/document/traitement_formulaire.pdf', 'http://localhost/gestion_client/document/traitement_formulaire.pdf', '', 40, 66);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `modaliter_paiement` enum('espèce','cheque') NOT NULL DEFAULT 'espèce',
  `tranche` int(11) NOT NULL,
  `date_paiement` date NOT NULL,
  `id_demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `modaliter_paiement`, `tranche`, `date_paiement`, `id_demande`) VALUES
(19, 'espèce', 1050, '2023-06-08', 6),
(35, 'espèce', 100, '2023-06-20', 6),
(36, 'cheque', 150, '2023-07-03', 6),
(54, 'espèce', 2498, '2023-07-21', 6),
(56, 'espèce', 5000, '2023-07-25', 86),
(57, 'espèce', 1000, '2023-07-28', 17),
(60, 'espèce', 5, '2023-08-03', 6),
(62, 'espèce', 3000, '2023-08-03', 106),
(63, 'espèce', 11000, '2023-08-03', 106),
(64, 'espèce', 4000, '2023-08-13', 136),
(65, 'espèce', 25, '2023-08-28', 147),
(66, 'espèce', 140, '2023-08-31', 6),
(67, 'espèce', 55, '2023-09-08', 6);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `libelle`) VALUES
(31, 'php'),
(51, 'html'),
(55, 'mobil'),
(64, 'Suivie réseau sociaux'),
(65, 'SCO'),
(66, 'Refonte site web');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_demande` (`id_demande`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
