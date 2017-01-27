-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Janvier 2017 à 18:04
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `renault`
--

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

CREATE TABLE `autorisation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `autorisation`
--

INSERT INTO `autorisation` (`id`, `libelle`, `valide`) VALUES
(1, 'droits d\'administration', 1),
(2, 'accès à l\'application', 1);

-- --------------------------------------------------------

--
-- Structure de la table `heure`
--

CREATE TABLE `heure` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idTypeHeure` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `rt` char(1) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `heure`
--

INSERT INTO `heure` (`id`, `idSalarie`, `idTypeHeure`, `datetime`, `rt`, `valide`) VALUES
(21, 2, 3, '2017-01-01 02:05:00', 't', 1),
(20, 1, 5, '2017-01-07 00:20:00', 't', 1),
(19, 1, 5, '2017-01-06 05:00:00', 't', 1),
(18, 1, 10, '2017-01-05 08:00:00', 't', 1),
(17, 1, 7, '2017-01-04 07:59:00', 't', 1),
(16, 1, 8, '2017-01-03 06:00:00', 't', 1),
(15, 1, 1, '2017-01-01 05:04:00', 't', 1),
(14, 1, 4, '2017-01-02 05:02:00', 't', 1),
(22, 1, 10, '2017-01-01 04:02:00', 'r', 1),
(23, 1, 4, '2017-01-09 05:02:00', 't', 1),
(24, 1, 8, '2017-01-10 06:00:00', 't', 1),
(25, 1, 7, '2017-01-11 07:59:00', 't', 1),
(26, 1, 10, '2017-01-12 08:00:00', 't', 1),
(27, 1, 5, '2017-01-13 05:00:00', 't', 1),
(28, 1, 5, '2017-01-14 00:20:00', 't', 1),
(29, 1, 4, '2017-01-16 05:02:00', 't', 1),
(30, 1, 8, '2017-01-17 06:00:00', 't', 1),
(31, 1, 7, '2017-01-18 07:59:00', 't', 1),
(32, 1, 10, '2017-01-19 08:00:00', 't', 1),
(33, 1, 5, '2017-01-20 05:00:00', 't', 1),
(34, 1, 5, '2017-01-21 00:20:00', 't', 1),
(35, 1, 4, '2017-01-23 05:02:00', 't', 1),
(36, 1, 8, '2017-01-24 06:00:00', 't', 1),
(37, 1, 7, '2017-01-25 07:59:00', 't', 1),
(38, 1, 10, '2017-01-26 08:00:00', 't', 1),
(39, 1, 5, '2017-01-27 05:00:00', 't', 1),
(40, 1, 5, '2017-01-28 00:20:00', 't', 1),
(41, 1, 1, '2017-01-02 01:01:00', 'r', 1),
(42, 1, 2, '2017-01-03 02:02:00', 'r', 1),
(43, 1, 3, '2017-01-04 03:03:00', 'r', 1),
(44, 1, 4, '2017-01-05 04:04:00', 'r', 1),
(45, 1, 10, '2017-01-06 05:05:00', 'r', 1),
(46, 1, 9, '2017-01-07 06:06:00', 'r', 1),
(47, 1, 6, '2017-01-08 07:07:00', 'r', 1),
(48, 1, 1, '2017-01-09 01:01:00', 'r', 1),
(49, 1, 2, '2017-01-10 02:02:00', 'r', 1),
(50, 1, 3, '2017-01-11 03:03:00', 'r', 1),
(51, 1, 4, '2017-01-12 04:04:00', 'r', 1),
(52, 1, 10, '2017-01-13 05:05:00', 'r', 1),
(53, 1, 9, '2017-01-14 06:06:00', 'r', 1),
(54, 1, 6, '2017-01-15 07:07:00', 'r', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `id` int(11) NOT NULL,
  `idService` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(40) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id`, `idService`, `nom`, `prenom`, `mdp`, `valide`) VALUES
(1, 1, 'gille', 'alexandre', '', 1),
(2, 1, 'deves', 'thierry', 'devthi', 1),
(3, 1, 'géraudie', 'guy', 'gerguy', 1),
(4, 1, 'gallerne', 'jean-luc', 'galjea', 1),
(5, 1, 'laporte', 'daniel', 'lapdan', 1),
(6, 1, 'mas', 'henri', 'mashen', 1),
(7, 1, 'mournetas', 'marie-pierre', 'moumar', 1),
(8, 1, 'rochais', 'david', 'rocdav', 1),
(9, 2, 'damion', 'david', 'damdav', 1),
(10, 2, 'goncalves pirès', 'joao', 'gonjoa', 1),
(11, 2, 'huchet', 'david', 'hucdav', 1),
(12, 2, 'magalhaes', 'tony', 'magton', 1),
(13, 2, 'mendes costa', 'mario', 'menmar', 1),
(14, 2, 'salle', 'françois', 'salfra', 1),
(15, 3, 'bordas', 'patricia', 'borpat', 1),
(16, 3, 'champeval', 'françoise', 'chafra', 1),
(17, 3, 'ribet', 'sylvie', 'ribsyl', 1),
(18, 4, 'longeot', 'bastien', 'lonbas', 1),
(19, 4, 'nadal', 'pascal', 'nadpas', 1),
(20, 4, 'sournat', 'christian', 'souchr', 1),
(21, 4, 'zérourou', 'yoan', 'zeryo', 1),
(22, 5, 'fleuret', 'klemens', 'flekle', 1),
(23, 5, 'lundy', 'mickael', 'lunmic', 1),
(24, 5, 'siriex', 'sébastien', 'sirseb', 1),
(25, 6, 'cheze', 'agnès', 'cheagn', 1),
(26, 6, 'foretnegre', 'laetitia', 'forlae', 1),
(27, 6, 'soulier', 'thierry', 'southi', 1),
(28, 6, 'tavé', 'isabelle', 'tavisa', 1),
(29, 6, 'valade', 'olivier', 'valoli', 1),
(30, 7, 'dessus bayle', 'boris', 'desbor', 1),
(31, 7, 'guindre', 'frederic', 'guifre', 1),
(32, 7, 'mouly', 'pierre', 'moupie', 1),
(33, 7, 'pereira', 'eric', 'pereri', 1),
(34, 7, 'pouyade', 'david', 'poudav', 1),
(35, 8, 'arvis', 'aurélie', 'arvaur', 1),
(36, 8, 'bezanger', 'sylvie', 'bezsyl', 1),
(37, 8, 'rigal', 'christian', 'rigchr', 1),
(38, 8, 'veyssiere', 'gilles', '', 1),
(39, 9, 'guilmard', 'fabien', 'guifab', 1),
(40, 10, 'vigneau', 'florent', 'vigflo', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie_autorisation`
--

CREATE TABLE `salarie_autorisation` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idAutorisation` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `salarie_autorisation`
--

INSERT INTO `salarie_autorisation` (`id`, `idSalarie`, `idAutorisation`, `valide`) VALUES
(1, 40, 1, 1),
(2, 40, 2, 1),
(3, 28, 2, 1),
(4, 16, 2, 1),
(5, 15, 2, 1),
(6, 4, 2, 1),
(7, 37, 2, 1),
(8, 11, 2, 1),
(9, 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `libelle`, `valide`) VALUES
(1, 'atelier', 1),
(2, 'carrosserie', 1),
(3, 'comptabilité', 1),
(4, 'mpr', 1),
(5, 'renault minute', 1),
(6, 'vn', 1),
(7, 'vn vendeurs', 1),
(8, 'vo', 1),
(9, 'vo vendeurs', 1),
(10, 'dir + c services', 1),
(11, 'salariés sortis', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeheure`
--

CREATE TABLE `typeheure` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `typeheure`
--

INSERT INTO `typeheure` (`id`, `libelle`, `valide`) VALUES
(1, 'Travail', 1),
(2, 'Paternité', 1),
(3, 'Maternité', 1),
(4, 'CP', 1),
(5, 'Férié', 1),
(6, 'Formation', 1),
(7, 'Récupération', 1),
(8, 'RTT', 1),
(9, 'Solidarité', 1),
(10, 'Maladie', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `autorisation`
--
ALTER TABLE `autorisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heure`
--
ALTER TABLE `heure`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `salarie_autorisation`
--
ALTER TABLE `salarie_autorisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeheure`
--
ALTER TABLE `typeheure`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `autorisation`
--
ALTER TABLE `autorisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `heure`
--
ALTER TABLE `heure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `salarie_autorisation`
--
ALTER TABLE `salarie_autorisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `typeheure`
--
ALTER TABLE `typeheure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
